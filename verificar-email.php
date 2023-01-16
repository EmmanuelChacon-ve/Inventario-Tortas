<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./Vista/img/LOGOv.png" type="image/x-icon">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>cambio de password</title>
</head>
<body>
    
</body>
</html>

<?php
    include "./Modelo/connect.php";
    $msg = '';
    if(isset($_GET['token']))
    {
        if(empty(trim($_GET['token'])))
        {
            header("Refresh:0, url= ./index.html");
        }
        $token = $_GET['token'];
        $query = "SELECT codigo FROM usuario WHERE codigo='$token' LIMIT 1";
        $query = mysqli_query($conn,$query);
        if(mysqli_num_rows($query) > 0)
        {
            $query = "SELECT usuario FROM usuario WHERE codigo='$token' LIMIT 1";
            $query = mysqli_query($conn,$query);
            $request = mysqli_fetch_array($query,MYSQLI_ASSOC);
            $username = $request['usuario'];
            $query = mysqli_query($conn, "UPDATE usuario SET codigo='' WHERE codigo='$token'");
            if($query){
                if(isset($_GET['validacion'])){
                    header("Refresh:0 , url = ./cambioPassword.html?usuario=$username");
                    exit();
                }
                echo "<script>
                Swal.fire(
                    'Excelente',
                    'correo validado con exito',
                  ).then(() => window.close());
                </script>";
                exit();
            }
        }else
        {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'este token no existe',
              }).then(() => location.replace('./'));
            </script>";
        }
    }else
    {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'no tienes acceso',
          }).then(() => location.replace('./'));
        </script>";
    }
    echo $msg;
    mysqli_close($conn);
?>