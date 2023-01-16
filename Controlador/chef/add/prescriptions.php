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
    if( $_POST['torta'] != null && $_POST['insumo'] != null && $_POST['cantidad'] != null && $_POST['unidad'] != null){
        $sql = "INSERT INTO receta (id_torta,id_ins,can_ins,id_uni) VALUES ('". trim($_POST['torta']). "','". trim($_POST['insumo']). "','". trim($_POST['cantidad']). "','". trim($_POST['unidad']). "')";
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
         header("Refresh: $sec , url = ../../../vista/chef/prescriptions.php");
        exit();

        }
        else{
            echo "<script>alert('Operacion fallida')</script>";
            header("Refresh:0 , url = ../../../vista/chef/prescriptions.php");
            exit();

        }
    }
    else{
        echo "<script>alert('Porfavor completa los campos')</script>";
        header("Refresh:0 , url = ../../../vista/chef/prescriptions.php");
        exit();

    }
    mysqli_close($conn);
?>
  </body>
    </html>