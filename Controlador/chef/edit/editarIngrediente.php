<?php
require_once "../../../Modelo/connect.php";
if(isset($_POST['edit']))
{
    if(empty(trim($_POST['cantidad'])))
    {
        $estado = false;
        $mensaje = 'llene la medida por favor';
        $estado = array('estado' => $estado, 'mensaje' => $mensaje);
        echo json_encode($estado);
        exit();
    }
    $cantidad = $_POST['cantidad'];
    $torta    = $_POST['torta'];
    $insumo   = $_POST['insumo'];
    $sql = "UPDATE receta SET can_ins= '$cantidad' WHERE id_torta='$torta' AND id_ins='$insumo'";
    if($conn->query($sql))
    {
        $estado = true;
        $mensaje = 'cambiado con exito';
        $estado = array('estado' => $estado, 'mensaje' => $mensaje);
        echo json_encode($estado);
        exit();
    }else
    {
        $estado = false;
        $mensaje = 'ah ocurrido un error';
        $estado = array('estado' => $estado, 'mensaje' => $mensaje);
        echo json_encode($estado);
        exit();
    }
}

?>