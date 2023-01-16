<?php
    session_start();
    require_once "../../../Modelo/connect.php";
  
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>
<body>
    <?php
if($_POST['email'] != null && $_POST['usuario'] != null && $_POST['contraseña'] != null && $_POST['id_privilegio'] != null){
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $password= $_POST['contraseña'];
    $privilegio = $_POST['id_privilegio'];
    $id         = $_POST['id'];
    $sql = "UPDATE usuario SET email= '$email',usuario= '$usuario', password= '$password', id_privilegio='$privilegio' WHERE id_usuario='$id'";
        if($conn->query($sql)){
            echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Usuario editado',
            showConfirmButton: false,
            timer: 3000
          })
         </script>";

         $sec = "2";  
         header("Refresh: $sec , url = ../../../vista/admin/user.php");
        exit();

        }
        else{
            echo "<script>alert('Inconvenientes para realizar el proceso')</script>";
            header("Refresh:0 , url =../../../vista/admin/user.php");
            exit();

        }
    }
    else{
        echo "<script>alert('Por favor diligencia todos los campos')</script>";
        header("Refresh:0 , url = ../../../vista/admin/user.php");
        exit();

    }
    mysqli_close($conn);
?>
 </body>
    </html>