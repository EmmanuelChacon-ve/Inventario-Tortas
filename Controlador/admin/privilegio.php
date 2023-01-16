<?php
require_once("../../modelo/connect.php");

$sql = 'SELECT * FROM privilegios ORDER BY id ASC';
$sql = mysqli_query($conn,$sql);
$data = [];

while ($item = mysqli_fetch_array($sql)){
    $data[] = [
        'id' => $item['id'],
        'descripcion' => $item['tipo_privilegio'],
    ];
}

echo json_encode($data);
?>