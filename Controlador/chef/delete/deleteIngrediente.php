<?php
require_once "../../../Modelo/connect.php";
if(isset($_POST['borrar']))
{
    if(trim(empty($_POST['insumo'])))
    {
        $estado = false;
        $mensaje = 'no hay ingredientes';
        $estado = array('estado' => $estado, 'mensaje' => $mensaje);
        echo json_encode($estado);
        exit();
    }
    $torta = $_POST['torta'];
    $insumo = $_POST['insumo'];
    $sql = "DELETE FROM receta WHERE id_torta='$torta' AND id_ins='$insumo'";
    if(mysqli_query($conn,$sql))
    {
        $estado = true;
        $mensaje = 'borrado con exito';
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