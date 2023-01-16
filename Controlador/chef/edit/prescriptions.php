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
    if($_POST['torta'] != null && $_POST['insumo'] != null && $_POST['cantidad'] != null && $_POST['unidad'] != null){
        $sql = "UPDATE receta SET id_torta = '" . trim($_POST['torta']) .  "' , id_ins = '" . trim($_POST['insumo']) . "', can_ins = '" . trim($_POST['cantidad']) . "', id_uni = '" . trim($_POST['unidad']) . "'  WHERE id_tortas = '" . $_POST['id'] . "'";
        if($conn->query($sql)){
            echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Producto editado',
            showConfirmButton: false,
            timer: 3000
          })
         </script>";

         $sec = "2";  
         header("Refresh: $sec , url = ../../../vista/chef/prescriptions.php");
        exit();

        }
        else{
            echo "<script>alert('Inconvenientes para realizar el proceso')</script>";
            header("Refresh:0 , url =../../../vista/chef/prescriptions.php");
            exit();

        }
    }
    else{
        echo "<script>alert('Por favor diligencia todos los campos')</script>";
        header("Refresh:0 , url = ../../../vista/chef/presciptions.php");
        exit();

    }
    mysqli_close($conn);
?>
 </body>
    </html>
   