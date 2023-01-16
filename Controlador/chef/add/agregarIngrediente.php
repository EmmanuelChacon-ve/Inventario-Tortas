<?php
require_once "../../../Modelo/connect.php";
if(isset($_POST['submit']))
{
    if(empty($_POST['idMedida']) or empty($_POST['cantidad']))
    {
        $estado = false;
        $mensaje = 'No pueden haber espacios en blanco';
        $estado = array('estado' => $estado, 'mensaje' => $mensaje);
        echo json_encode($estado);
        exit();
    }
    $torta = $_POST['torta'];
    $insumo = $_POST['insumo'];
    $cantidad = $_POST['cantidad'];
    $idUnidad = $_POST['idMedida'];
    $query = "INSERT INTO receta (id_torta,id_ins,can_ins,id_uni) VALUES ('$torta','$insumo','$cantidad','$idUnidad')";
    $query = mysqli_query($conn,$query);
    if($query)
    {
        $estado = true;
        $mensaje = 'Agregado con exito';
        $estado = array('estado' => $estado, 'mensaje' => $mensaje);
        echo json_encode($estado);
        exit();
    }else
    {
        $estado = false;
        $mensaje = 'ah ocurrido un error intentalo mas tarde';
        $estado = array('estado' => $estado, 'mensaje' => $mensaje);
        echo json_encode($estado);
        exit();
    }
}
?>