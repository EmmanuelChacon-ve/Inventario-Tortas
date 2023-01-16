
<?php
    if(trim($_POST['username'])== null|| trim($_POST['password']) == null){
        echo "<script>alert('Por favor diligencia los campos correspondientes')</script>";
        header("Refresh:0 , url = ../index.html");
        exit();
    }
    else
    {
        //  require_once "../Modelo/conexion.php";
        //  $username = mysqli_real_escape_string($conn,$_POST['username']);
        //  $password = mysqli_real_escape_string($conn,md5($_POST['password']));
        //  $sql = "SELECT usuario,password FROM usuario WHERE usuario ='". $username ."' and password = '".$password."'";
        //  $query = mysqli_query($conn,$sql);
        //  echo json_encode($query);
        //  $result = mysqli_fetch_array($query , MYSQLI_ASSOC);
        //  if(!$result){
        //      echo "<script>alert('Usuario o Contraseña Inválida')</script>";
        //      header("Refresh:0 , url = logout.php");
        //      exit();

        //  }
        //  else{
        //      session_start();
        //      $_SESSION['username'] = $result['username'];
        //      header("Location: ../vista/list.php");
        //      session_write_close();
        //  }
        require_once "../../Modelo/connect.php";
        $usuario  = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,md5($_POST['password']));

        $query = "SELECT * FROM usuario WHERE usuario='$usuario' AND password='$password' LIMIT 1";
        $query = mysqli_query($conn,$query);
        if(mysqli_num_rows($query)=== 1)
        {
            $request = mysqli_fetch_array($query,MYSQLI_ASSOC);
            $username = $request['usuario'];
            $row = mysqli_fetch_assoc($query);

            if(empty($row['codigo'])){
                $mensaje = 'usuario ingresado con exito';
                $salida = array('estado' =>true, 'mensaje'=>$mensaje,'usuario' => $username);
                //probando
                session_start();
                $_SESSION['username'] = $request['usuario'];
                //probando
                echo json_encode($salida);
                exit();
            }else{
                $mensaje = 'verifique su correo';
                $salida = array('estado' =>false, 'mensaje'=>$mensaje,'usuario' => $username);
                echo json_encode($salida);
                exit();
            }

        }else
        {
            $mensaje = 'correo o contrasena no concuerdan';
            $salida = array('estado' =>false, 'mensaje'=>$mensaje);
            echo json_encode($salida);
            exit();
        }
    }
    mysqli_close($conn);
?>