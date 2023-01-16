<?php

require_once ('../../Controlador/fpdf/fpdf.php');
require_once "../../Modelo/connect.php";

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    //$this->image('../img/logo.png', 150, 1, 60); // X, Y, Tamaño
    $this->Ln(20);
    // Arial bold 15
    $this->SetFont('Arial','B',20);
  
    // Movernos a la derecha
    $this->Cell(60);

    // Título
    $this->Cell(70,10,'Tabla de Ordenes ',0,0,'C');
    // Salto de línea
   
    $this->Ln(30);
    $this->SetFont('Arial','B',10);
    $this->SetX(8);
    $this->Cell(19,10,'Id usuario',1,0,'C',0);
    $this->Cell(64,10,'email',1,0,'C',0);
    $this->Cell(38,10,'Usuario',1,0,'C',0);
    $this->Cell(38,10,'Contraseña',1,0,'C',0);
    $this->Cell(38,10,'Rol',1,1,'C',0);
    // $this->Cell(27,10,'Telefono',1,0,'C',0);
    // $this->Cell(27,10,'Password',1,0,'C',0);
    // $this->Cell(40,10,'Fecha',1,0,'C',0);
    // $this->Cell(30,10,'Rol',1,1,'C',0);
	

  
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
  
    $this->Cell(0,10,utf8_decode('Página') .$this->PageNo().'/{nb}',0,0,'C');
   //$this->SetFillColor(223, 229,235);
    //$this->SetDrawColor(181, 14,246);
    //$this->Ln(0.5);
}
}


// $conexion=mysqli_connect("localhost","root","","r_user");
$sql_fetch_todos = "SELECT id_usuario,email,usuario,password,id_privilegio FROM usuario";
$resultado = mysqli_query($conn, $sql_fetch_todos);

$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
//$pdf->SetWidths(array(10, 30, 27, 27, 20, 20, 20, 20, 22));
while ($row=$resultado->fetch_assoc()) {

    $pdf->SetX(8);

    $pdf->Cell(19,10,$row['id_usuario'],1,0,'C',0);
    $pdf->Cell(64,10,utf8_decode($row['email']),1,0,'C',0);
    $pdf->Cell(38,10,utf8_decode($row['usuario']),1,0,'C',0);
    $pdf->Cell(38,10,$row['password'],1,0,'C',0);
    $pdf->Cell(38,10,$row['id_privilegio'],1,1,'C',0);
	// $pdf->Cell(27,10,$row['telefono'],1,0,'C',0);
    // $pdf->Cell(27,10,$row['password'],1,0,'C',0);
    // $pdf->Cell(40,10,$row['fecha'],1,0,'C',0);
    // $pdf->Cell(30,10,$row['rol'],1,1,'C',0);
	


} 


	$pdf->Output();
?>