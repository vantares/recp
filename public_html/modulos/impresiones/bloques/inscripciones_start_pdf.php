<?php
//header("Content-type:application/pdf");
//header("Cache-Control: no-cache");
//header("Pragma: no-cache");
require('/usr/share/php/fpdf/fpdf.php');
//$pdf=new FPDF('P','mm', array(255, 352));


if ($_REQUEST['action'] == 'imprimir') {
	switch ($_REQUEST['tipo']) {
		case 'matrimonio':
			$pdf=new FPDF('P','mm', array(279, 349));
			break;
		case 'defuncion':
			$pdf=new FPDF('P','mm', array(278, 370));
			break;
		case 'nacimiento':
			$pdf=new FPDF('P','mm', array(279, 367));
			break;
		case 'disolucionmatrimonio':
			$pdf=new FPDF('P','mm', array(269, 355));
			break;
		case 'inscripcionvaria':
			$pdf=new FPDF('P','mm', array(266,346 ));
			break;
		default:
			break;
	}
}

//print_r($pdf);
//$pdf->SetAutoPageBreak(false, 10);
//$pdf->AddPage();
/*
 * antes de imprimir cualqueir texto se debe establecer la fuente
 * o el documento sera invalido
 */
$pdf->SetFont('Arial','',12);
//$data = new inscripcionTable();
//$data->readEnv();
?>
