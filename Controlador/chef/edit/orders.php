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
    if($_POST['nombre'] != null && $_POST['cedula'] != null && $_POST['numero'] != null && $_POST['fecha'] != null){
        $sql = "UPDATE ordenes SET nombre_comprador = '" . trim($_POST['nombre']) .  "' , cedula_comprador = '" . trim($_POST['cedula']) . "', numero_comprador = '" . trim($_POST['numero']) . "', fecha_orden = '" . trim($_POST['fecha']) . "'  WHERE id_orden = '" . $_POST['id'] . "'";
        if($conn->query($sql)){
            echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Orden editada',
            showConfirmButton: false,
            timer: 3000
          })
         </script>";

         $sec = "2";  
         header("Refresh: $sec , url = ../../../vista/chef/orders.php");
        exit();

        }
        else{
            echo "<script>alert('Inconvenientes para realizar el proceso')</script>";
            header("Refresh:0 , url =../../../vista/chef/orders.php");
            exit();

        }
    }
    else{
        echo "<script>alert('Por favor diligencia todos los campos')</script>";
        header("Refresh:0 , url = ../../../vista/chef/orders.php");
        exit();

    }
    mysqli_close($conn);
?>
 </body>
    </html>
   