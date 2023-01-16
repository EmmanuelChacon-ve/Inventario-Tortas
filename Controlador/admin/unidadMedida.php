<?php
require_once("../../modelo/connect.php");

$sql = 'SELECT * FROM unidades ORDER BY id_uni ASC';
$sql = mysqli_query($conn,$sql);
$data = [];

while ($item = mysqli_fetch_array($sql)){
    $data[] = [
        'id' => $item['id_uni'],
        'descripcion' => $item['des_uni'],
    ];
}

echo json_encode($data);
?>