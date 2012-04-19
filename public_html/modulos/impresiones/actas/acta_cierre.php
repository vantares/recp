<?
require('/usr/share/php/fpdf/fpdf.php');

$pdf=new FPDF('P','mm', array(266,346 ));
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

if ($_REQUEST['idacta']) {
     	$pdf->Image('./imgs/acta_de_cierre.png', 57, 22, 161.29,253.63 );
	$pdf->SetY(41);
	$pdf->SetX(105);
	$pdf->Cell(0,0,'Matagalpa');
	$pdf->SetY(139);
        $pdf->SetX(95);
	$pdf->Cell(0,0,'Matagalpa');
	$pdf->SetY(149);
        $pdf->SetX(100);
	$pdf->Cell(0,0,'Matagalpa');
	$pdf->SetY(167);
        $pdf->SetX(97);
	$pdf->Cell(0,0,'Defuncion');
	$pdf->SetY(176);
        $pdf->SetX(153);
	$pdf->Cell(0,0,'100');
	$pdf->sety(185);
	$pdf->setx(70);
	$pdf->Cell(0,0,'50');
	$pdf->sety(185);
	$pdf->setx(190);
	$pdf->Cell(0,0,'siete');
	$pdf->sety(208);
	$pdf->setx(155);
	$pdf->Cell(0,0,'cuatro');
	$pdf->sety(223);
	$pdf->setx(88);
	$pdf->Cell(0,0,'Abril');
	$pdf->sety(223);
	$pdf->setx(170);
	$pdf->Cell(0,0, 'Nueve');
	$pdf->sety(269);
	$pdf->setx(65);
	$pdf->Cell(0,0,'Carlos Romero Lugo');
        $pdf->sety(269);
	$pdf->setx(150);
        $pdf->Cell(0,0,'Luis Solis Borge');

}
$pdf->Output();
?>
