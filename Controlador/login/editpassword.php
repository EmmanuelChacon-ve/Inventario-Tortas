<?php
require_once "../../Modelo/connect.php";
$mensaje = '';
if(isset($_POST['password']) And isset($_POST['cfpassword']))
{
    $password = $_POST['password'];
    $cfpass   = $_POST['cfpassword'];
    if(empty(trim($password)) Or empty(trim($cfpass)))
    {
        $mensaje = 'por favor rellene ambos campos';
        $salida = array('estado' =>false, 'mensaje'=>$mensaje);
        echo json_encode($salida);
        exit();
    }
    $usuario = $_POST['usuario'];
    $query = "SELECT * FROM usuario WHERE usuario='$usuario' LIMIT 1";
    $query = mysqli_query($conn,$query);
    if(mysqli_num_rows($query)=== 1)
    {
        $row = mysqli_fetch_assoc($query);
        if(empty($row['codigo']))
        {
            $password = md5($password);
            $query = mysqli_query($conn, "UPDATE usuario SET password='$password' WHERE usuario='$usuario'");
            if($query){
                $mensaje = 'contrasena cambiada con exito';
                $salida = array('estado' =>true, 'mensaje'=>$mensaje);
                echo json_encode($salida);
                exit();
            }else{
                $mensaje = 'ah ocurrido un error';
                $salida = array('estado' =>false, 'mensaje'=>$mensaje,'usuario' => $username);
                echo json_encode($salida);
                exit();
            }

        }else{
                $mensaje = 'verifique su correo';
                $salida = array('estado' =>false, 'mensaje'=>$mensaje,'usuario' => $username);
                echo json_encode($salida);
                exit();
            }
    }else
    {
        $mensaje = 'usuario no conseguido. Por favor no modifique el url';
        $salida = array('estado' =>false, 'mensaje'=>$mensaje, 'reload'=>true);
        echo json_encode($salida);
    }
}

?>