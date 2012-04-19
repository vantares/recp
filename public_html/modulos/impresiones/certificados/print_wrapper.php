<?
header("Content-type:application/pdf");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
require('/usr/share/php/fpdf/fpdf.php');
include_once('../../../common.inc.php'); 
include_once('../../../../classes/function.numeros.php'); 

if ($_REQUEST['action'] == 'imprimir') {
  switch ($_REQUEST['tipo']) {
    case 'matrimonio':
      $pdf=new FPDF('P','mm', array(215, 277));
      $pdf->SetFont('Arial','',12);
      break;
    case 'defuncion':
      $pdf=new FPDF('P','mm', array(215, 277));
      $pdf->SetFont('Arial','',12);
      break;
    case 'nacimiento':
      $pdf=new FPDF('P','mm', array(215, 329));
      $pdf->SetFont('Arial','',12);
      break;
    case 'divorcio':
      $pdf=new FPDF('P','mm', array(215, 329));
      $pdf->SetFont('Arial','',12);
            break;
    default:
      break;
  }
}

include("certification_data.php");

$pdf->Output();
?>
