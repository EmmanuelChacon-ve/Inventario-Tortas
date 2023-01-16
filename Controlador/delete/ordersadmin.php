
<?php
    session_start();
    require_once "../../Modelo/connect.php";
    if ($_SESSION['username'] == null){
        echo "<script>alert('Favor ingresar con tus credenciales')</script>";
        header("Refresh:0 , url = ../../index.html");
        exit();
    }
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
     $delete_num = $_GET['id'];
     $sql_delete =  "SELECT * FROM ordenes WHERE id_orden = '$delete_num'";
    $query_delete = mysqli_query($conn,$sql_delete);
    if(!$query_delete){  
    
        echo "<script>
        Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'La Orden No Puso Ser Eliminada',
        text: 'Verifica que no esté relacionado con alguna otra tabla (TANDAS)',
        showConfirmButton: false,
        timer: 5000
      })
     </script>";

     $sec = "4";  
     header("Refresh: $sec , url = ../../vista/admin/orders.php");
    exit();
    }
    $sql_delet = "UPDATE ordenes SET estado='I' WHERE  id_orden = '  $delete_num  ' ";
    $query_dele = mysqli_query($conn,$sql_delet);
    if($query_dele){
        
        echo "<script>
        Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Orden Eliminada',
        showConfirmButton: false,
        timer: 3000
      })
     </script>";

     $sec = "2";  
     header("Refresh: $sec , url = ../../Vista/admin/orders.php");
    exit();

    }
    mysqli_close($conn);


?>
</body>
</html>