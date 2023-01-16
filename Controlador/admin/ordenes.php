<?php
require_once("../../modelo/connect.php");

$sql = 'SELECT * FROM usuario ORDER BY id_usuario ASC';
$sql = mysqli_query($conn,$sql);
$data = [];

while ($item = mysqli_fetch_array($sql)){
    $data[] = [
        'id' => $item['id_usuario'],
        'descripcion' => $item['usuario'],
    ];
}

echo json_encode($data);
?>