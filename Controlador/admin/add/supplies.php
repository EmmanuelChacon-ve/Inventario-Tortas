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
        $sql = "INSERT INTO insumos (des_ins,id_uni,exi_min,exi_max,can_disp) VALUES ('". trim($_POST['insumo']). "','". trim($_POST['unidad'])."', '". trim($_POST['max'])."', '". trim($_POST['min'])."', '". trim($_POST['cantidad'])."')";
   

        if($conn->query($sql)){
            echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Insumo Agregado',
            showConfirmButton: false,
            timer: 3000
          })
         </script>";

         $sec = "2";  
         header("Refresh: $sec , url = ../../../vista/admin/supplies.php");
        exit();
        }
        else{
            echo "<script>alert('Operacion fallida')</script>";
            header("Refresh:0 , url = ../../../vista/admin/supplies.php");
            exit();

        }
    }
    else{
        echo "<script>alert('Porfavor completa los campos')</script>";
        header("Refresh:0 , url = ../../../vista/admin/supplies.php");
        exit();

    }
    mysqli_close($conn);
?>
   </body>
    </html>
   