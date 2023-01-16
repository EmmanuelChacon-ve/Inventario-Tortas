
<?php
    function getUrl(int $privilegio)
    {
        $url = '';
        if($privilegio == 1)
        {
            return $url = 'Vista/admin/inicio.html';
        }else if($privilegio == 2)
        {
            //aqui va usuario
            return $url = 'Vista/user/inicio.html';
        }else if($privilegio == 3)
        {
            return $url = 'Vista/chef/inicio.html';
        }
    }

    if(trim($_POST['username'])== null|| trim($_POST['password']) == null){
        echo "<script>alert('Por favor diligencia los campos correspondientes')</script>";
        header("Refresh:0 , url = ../index.html");
        exit();
    }
    else
    {
        require_once "../../Modelo/connect.php";
        $usuario  = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);

        $query = "SELECT * FROM usuario WHERE usuario='$usuario' AND password='$password' LIMIT 1";
        $query = mysqli_query($conn,$query);
        if(mysqli_num_rows($query)=== 1)
        {
            $request = mysqli_fetch_array($query,MYSQLI_ASSOC);
            $privilegio = $request['id_privilegio'];
            $username = $request['usuario'];
            $row = mysqli_fetch_assoc($query);

            if(empty($row['codigo'])){
                $mensaje = 'usuario ingresado con exito';
                //probando
                session_start();
                $_SESSION['username'] = $request['usuario'];
                $_SESSION['id_usuario'] = $request['id_usuario'];
                //probando
                $url = getUrl(intval($privilegio));
                $salida = array('estado' =>true, 'mensaje'=>$mensaje,'usuario' => $username,'newUrl' => $url);
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