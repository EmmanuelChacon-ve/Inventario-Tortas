<?php
    session_start();
    require_once "../../Modelo/connect.php";
    if($_SESSION['username'] == null){
        echo "<script>alert('Please login.')</script>";
        header("Refresh:0 , url = ../../index.html");
        exit();
    
        }
        $usuario = $_SESSION['id_usuario'];
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
    if( $_POST['nombre'] != null && $_POST['cedula'] != null && $_POST['numero'] != null  ){
        $sql = "INSERT INTO ordenes (id_usuario,nombre_comprador,cedula_comprador,numero_comprador) VALUES ( '". trim($usuario). "','". trim($_POST['nombre']). "','". trim($_POST['cedula']). "','". trim($_POST['numero']). "')";
        if($conn->query($sql)){
            echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Producto Agregado',
            showConfirmButton: false,
            timer: 3000
          })
         </script>";

         $sec = "2";  
         header("Refresh: $sec , url = ../../vista/user/form.php");
        exit();

        }
        else{
            echo "<script>alert('Operacion fallida')</script>";
            header("Refresh:0 , url = ../../vista/user/form.php");
            exit();

        }
    }
    else{
        echo "<script>alert('Porfavor completa los campos')</script>";
        header("Refresh:0 , url = ../../vista/user/form.php");
        exit();

    }
    mysqli_close($conn);
?>
  </body>
    </html>