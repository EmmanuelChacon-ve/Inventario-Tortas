<?php
require_once("../../modelo/connect.php");

$sql = 'SELECT * FROM tortas ORDER BY id_torta ASC';
$sql = mysqli_query($conn,$sql);
$data = [];

while ($item = mysqli_fetch_array($sql)){
    $data[] = [
        'id' => $item['id_torta'],
        'descripcion' => $item['des_torta'],
    ];
}

echo json_encode($data);
?>