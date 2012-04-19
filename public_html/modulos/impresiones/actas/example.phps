<?php
require('/usr/share/php/fpdf/fpdf.php');
#require('fpdf.php');

$pdf=new FPDF('P','mm', array(215, 279));
$pdf->AddPage();
$pdf->Image('./frente.jpg', 0, 0, 215, 279);
$pdf->SetFont('Arial','',12);
$pdf->SetY(28);
$pdf->SetX(25);
$pdf->Cell(40,20,'Javier');
$pdf->SetY(28);
$pdf->SetX(65);
$pdf->Cell(40,20,'Ernesto');
$pdf->AddPage();
$pdf->Image('./atras.jpg', 0, 0, 215, 279);
$pdf->SetY(25);
$pdf->SetX(25);
$pdf->Cell(40,20,'Comentarios');
$pdf->Output();
