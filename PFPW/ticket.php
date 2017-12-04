<?php
$hostname='localhost';
$username='root';
$contraseña='';
$database='test2';
$conexion = mysqli_connect($hostname, $username, $contraseña, $database);

include 'plantilla.php';
//require 'conexion.php';
//require 'C:\xampp\htdocs\pdf\fpfd\fpdf.php';
$query = "SELECT tarjeta,cantidad,total FROM pedidos where correo_usuario ='prueba@prueba.com'";

//$resultado =$mysqli->query($query);
$resultado=mysqli_query($conexion, $query);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

//encabezado
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12); //arial negrita 12
$pdf->Cell(70,6,'TARJETA',1,0,'C',1);
//$pdf->Cell(70,6,'LLAVERO',1,0,'C',1);
$pdf->Cell(70,6,'CANTIDAD',1,0,'C',1);
$pdf->Cell(70,6,'TOTAL',1,1,'C',1);

//
 $pdf->SetFont('Arial','',10); //arial normal 10
 while ($row = $resultado->fetch_assoc()) {
 $pdf->Cell(70,6,$row['tarjeta'],1,0,'C',1);
 //$pdf->Cell(70,6,$row['llavero'],1,0,'C',1);
 $pdf->Cell(70,6,$row['cantidad'],1,0,'C',1);
 $pdf->Cell(70,6,$row['total'],1,1,'C',1);
 }

$pdf->Output();
?>