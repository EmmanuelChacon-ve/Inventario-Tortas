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
    if($_POST['insumo'] != null && $_POST['unidad'] != null && $_POST['max'] != null && $_POST['min'] != null && $_POST['cantidad'] != null){
        $sql = "UPDATE insumos SET des_ins = '" . trim($_POST['insumo']) .  "' , id_uni = '" . trim($_POST['unidad']) . "', exi_max = '" . trim($_POST['max']) . "' , exi_min = '" . trim($_POST['min']) . "', can_disp = '" . trim($_POST['cantidad']) . "' WHERE id_ins = '" . $_POST['id'] . "'";
        if($conn->query($sql)){
            echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Insumo editado',
            showConfirmButton: false,
            timer: 3000
          })
         </script>";

         $sec = "2";  
         header("Refresh: $sec , url = ../../../vista/admin/supplies.php");
        exit();

        }
        else{
            echo "<script>alert('Inconvenientes para realizar el proceso')</script>";
            header("Refresh:0 , url =../../../vista/admin/supplies.php");
            exit();

        }
    }
    else{
        echo "<script>alert('Por favor diligencia todos los campos')</script>";
        header("Refresh:0 , url = ../../../vista/admin/supplies.php");
        exit();

    }
    mysqli_close($conn);
?>
 </body>
    </html>
   