<html lang="en">
<head>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cantarell:ital,wght@1,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./Vista/css/logins.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="icon" href="./Vista/img/LOGOv.png" type="image/x-icon">
        <title>Tortas Kady</title>
    </head>
</head>
<body>

    <div class="container">
        <div class="registro">
            <div class="titulo">
                <img src="./vista/img/LOGOv.png" alt="logo de la empresa" >
            </div>
          

        </div>
        <div class="register"> 
            <div class="decoracion-register"></div>
            <div class="form-container">
                <div class="alert">
                    <div class="mensaje error"></div>
                </div>


    
        <form action="./olvido.php" method="POST">
            <div class = "form">
                <div class="section">
                    <h1>Ingresar</h1>
                  </div>
            <div class="form__container">
                <input type="text" name="email" placeholder=" " required class="form__input"> 
                <label for="email" class="form__label">Email</label>
                
              </div> 
            <input type="submit" value="enviar" class="submit" name="submit">
            <a href="./index.html" ><button type="button" class="submit">Volver</button></a>
        </form>
    </div>
</div>
    
</body>
</html>

<?php
require "./Modelo/connect.php";
session_start();
// if (isset($_SESSION['username'])) {
//     header("Location: ./vista/list.php");
//     exit();
// }

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "./Controlador/login/PHPMailer-master/src/PHPMailer.php";
require "./controlador/login/PHPMailer-master/src/SMTP.php";
require "./controlador/login/PHPMailer-master/src/Exception.php";

$msg = "";

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $token = mysqli_real_escape_string($conn, md5(rand()));
    $query =  "SELECT * FROM usuario WHERE email='{$email}'";
    if (mysqli_num_rows(mysqli_query($conn,$query)) > 0) {
        $query = mysqli_query($conn, "UPDATE usuario SET codigo='{$token}' WHERE email='{$email}'");
        if ($query) {
            $query =  "SELECT * FROM usuario WHERE email='{$email}'";
            $queryC = mysqli_query($conn,$query);
            $request = mysqli_fetch_array($queryC,MYSQLI_ASSOC);
            $username = $request['usuario'];
            $clave = true;
            $mail = new PHPMailer(true);
            try{
                $mail->isSMTP(); //rotocolo de envio
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true; //logearse de forma segura
                $mail->Username = 'tortaskady@gmail.com';
                $mail->Password = 'phgdxrdkyculwjft';
                $mail->SMTPSecure = 'tls'; //formato de incriptacion
                $mail->Port       = 587;

                //datos del gmail

                $mail->setFrom('tortaskady@gmail.com','Tortas Kady');
                $mail->addAddress($email,'user');
                $mail->isHTML(true);
                $mail->Subject = 'Queremos mantenerte al tanto con tu cuenta';
                $mail->Body    = "<h1>Saludos de Tortas Kady</h1>
                <p> Apreciado '$username' Hemos escuchado que has perdido tu contrasena pero no te preocupes con el siguiente link tendras acceso a tu cuenta</p><br>
                <a href='http://localhost/proyecto-final/verificar-email.php?token=$token&validacion=$clave'>click para verificar</a>";
                $mail->send();
            }catch(Exception $e){
              echo "<script>
              Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'ah ocurrido un error intentalo mas tarde',
              }).then(() => location.replace('./'));
              </script>";
              exit();
            }

            echo "<script>
            Swal.fire(
                'Te hemos enviado un correo!',
              ).then(() => location.replace('./'));
            </script>";
}else{
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'ah ocurrido un error intentalo mas tarde',
    }).then(() => location.replace('./'));
    </script>";
    exit();
}
}else
{
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'correo no encontrado',
    }).then(() => location.replace('./login.html'));
    </script>";
    exit();
}
}

?>