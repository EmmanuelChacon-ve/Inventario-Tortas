<?php
require_once('../../modelo/connect.php');

$sql_fetch_todos = "SELECT * FROM tortas ORDER BY id_torta ASC";
$query = mysqli_query($conn, $sql_fetch_todos);
$data = [];

while ($item = mysqli_fetch_array($query)){
    $data[] = [
        'id' => $item['id_torta'],
        'nombre' => $item['des_torta']
    ];
}

$sql_fetch_todos = "SELECT * FROM insumos ORDER BY id_ins ASC";
$query = mysqli_query($conn, $sql_fetch_todos);
$data2 = [];

while ($item = mysqli_fetch_array($query)){
    $data2[] = [
        'id' => $item['id_ins'],
        'nombre' => $item['des_ins'],
        'unidad' => $item['id_uni']
    ];
}


$sql_fetch_todos = "SELECT * FROM unidades ORDER BY id_uni ASC";
$query = mysqli_query($conn, $sql_fetch_todos);
$data3 = [];

while ($item = mysqli_fetch_array($query)){
    $data3[] = [
        'id' => $item['id_uni'],
        'nombre' => $item['des_uni'],
    ];
}
$sql_fetch_todos = "SELECT * FROM receta ORDER BY id_tortas ASC";
$query = mysqli_query($conn, $sql_fetch_todos);
$data4 = [];

while ($item = mysqli_fetch_array($query)){
    $data4[] = [
        'id' => $item['id_torta'],
        'nombre' => $item['id_ins'],
        'cantidad' => $item['can_ins']
    ];
}

$dataTotal[] = [
    'tortas' => $data,
    'insumos'=> $data2,
    'des_insumos' =>$data3,
    'receta' =>$data4
];

echo json_encode($dataTotal);

?>