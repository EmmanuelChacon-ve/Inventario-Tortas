
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
    if( $_POST['torta'] != null && $_POST['cantidad'] != null){
        $sql = "INSERT INTO tandas (id_torta,can_pie) VALUES ('". trim($_POST['torta']). "','". trim($_POST['cantidad']). "')";
        if($conn->query($sql)){
            echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Tanda Agregada',
            showConfirmButton: false,
            timer: 3000
          })
         </script>";

         $sec = "2";  
         header("Refresh: $sec , url = ../../../vista/chef/sales.php");
        exit();

        }
        else{
            echo "<script>alert('Operacion fallida')</script>";
            header("Refresh:0 , url = ../../../vista/chef/sales.php");
            exit();

        }
    }
    else{
        echo "<script>alert('Porfavor completa los campos')</script>";
        header("Refresh:0 , url = ../../../vista/chef/sales.php");
        exit();

    }
    mysqli_close($conn);
?>
  </body>
    </html>