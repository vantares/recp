<?
require('/usr/share/php/fpdf/fpdf.php');

$pdf=new FPDF('P','mm', array(255, 352));
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

if ($_REQUEST['idacta']) {
     	$pdf->Image('./imgs/acta_apertura.png', 55, 23, 164.85,259.08 );
	$pdf->SetY(44);
	$pdf->SetX(115);
	$pdf->Cell(0,0,'Matagalpa');
	$pdf->SetY(143);
        $pdf->SetX(95);
	$pdf->Cell(0,0,'Matagalpa');
	$pdf->SetY(154);
        $pdf->SetX(95);
	$pdf->Cell(0,0,'Matagalpa');
	$pdf->SetY(176);
        $pdf->SetX(90);
	$pdf->Cell(0,0,'Nacimientos');
	$pdf->SetY(186);
        $pdf->SetX(158);
	$pdf->Cell(0,0,'258');
	$pdf->sety(208);
	$pdf->setx(157);
	$pdf->Cell(0,0,'diez');
	$pdf->sety(219);
	$pdf->setx(85);
	$pdf->Cell(0,0,'Junio');
	$pdf->sety(219);
	$pdf->setx(170);
	$pdf->Cell(0,0,'siete');
	$pdf->sety(275);
	$pdf->setx(70);
	$pdf->Cell(0,0,'Carlos Romero Lugo');
	$pdf->sety(275);
        $pdf->setx(155);
        $pdf->Cell(0,0,'Luis Solis Borge');

}
$pdf->Output();
?>
