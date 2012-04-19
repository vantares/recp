<?
header("Content-type:application/pdf");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
require('/usr/share/php/fpdf/fpdf.php');

//setlocale(LC_TIME, "es_ES");
//date_default_timezone_set('America/Managua');

include_once('../../../common.inc.php'); 
include_once('../../../../classes/function.numeros.php'); 
//$pdf=new FPDF('P','mm', array(269, 355));
$pdf=new FPDF('P','mm', array(269, 355));
//$pdf->SetMargins(float left, float top [, float right])
$pdf->SetAutoPageBreak(false, 10);
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

$data = new inscripcionTable();
$data->readEnv();


if ($data->request['idinscripcion']) {
	$rows = $data->readDataSQL("SELECT d.*, aj.*, ins.*, ac.idtomo, ac.folio, ac.partida, ac.fecha, t.numero FROM disolucionmatrimonio d INNER JOIN actojuridico aj ON d.iddisolucionmatrimonio=aj.idactojuridico INNER JOIN inscripcion ins ON aj.idactojuridico= ins.idinscripcion LEFT JOIN acta ac ON ac.idinscripcion= ins.idinscripcion INNER JOIN tomo t ON t.idtomo=ac.idtomo WHERE ac.idinscripcion='". $data->request['idinscripcion'] ."'");
        $row = $rows[0];
	$numtostr= array("numero");
     	//$pdf->Image('./imgs/acta_disolucion_matrimonio.png', 27,16, 228.94,324.61 );
     	$pdf->Image('./imgs/acta_disolucion_matrimonio.jpg', 27,16, 228.94,324.61 );
	$pdf->SetY(34);
	$pdf->SetX(105);
	$pdf->Cell(0,0,strtoupper('Matagalpa'));
	$pdf->SetY(24);
	$pdf->SetX(220);
	$pdf->Cell(0,0,$row['tomomatrimonio']);
	$pdf->SetY(30);
	$pdf->SetX(220);
	$pdf->Cell(0,0,$row['foliomatrimonio']);
	$pdf->SetY(36);
	$pdf->SetX(225);
	$pdf->Cell(0,0,$row['partidamatrimonio']);
	$pdf->SetY(43);
	$pdf->SetX(220);
	$fecha_acta= new Datetime($row['fecha']);
	$pdf->Cell(0,0,$fecha_acta->format('d/m/Y'));
	$pdf->SetY(57);
	$pdf->SetX(30);
	$pdf->Cell(0,0,strtoupper($row['inscrito1nombre1']));
	$pdf->Sety(57);
	$pdf->SetX(90);
	$pdf->Cell(0,0,strtoupper($row['inscrito1nombre2']));
	$pdf->Sety(57);
	$pdf->SetX(145);
	$pdf->Cell(0,0,strtoupper($row['inscrito1apellido1']));
	$pdf->Sety(57);
	$pdf->SetX(205);
	$pdf->Cell(0,0,strtoupper($row['inscrito1apellido2']));
	$pdf->Sety(78);
	$pdf->SetX(30);
	$pdf->Cell(0,0,strtoupper($row['inscrito2nombre1']));
	$pdf->Sety(78);
	$pdf->SetX(90);
	$pdf->Cell(0,0,strtoupper($row['inscrito2nombre2']));
	$pdf->Sety(78);
	$pdf->SetX(145);
	$pdf->Cell(0,0,strtoupper($row['inscrito2apellido1']));
	$pdf->Sety(78);
	$pdf->SetX(205);
	$pdf->Cell(0,0,strtoupper($row['inscrito2apellido2']));
	$pdf->SetY(89);
	$pdf->SetX(35);
	$pdf->Cell(0,0,strtoupper($row['ciudadinscripcion']));
	$pdf->Sety(89);
	$pdf->SetX(163);
	$pdf->Cell(0,0,strtoupper($row['municipioinscripcion']));
	$pdf->SetY(95);
	$pdf->SetX(63);
	$pdf->Cell(0,0,strtoupper($row['departamentoinscripcion']));
	$pdf->SetY(95);
	$pdf->SetX(122);
	$fecha_inscripcion= new DateTime($row['fecha']);
	$fecha_inscripcion_parts= getdate($fecha_inscripcion->getTimestamp());
	$prt_fecha_inscripcion=number2str($fecha_inscripcion->format('g'));
	$prt_fecha_inscripcion.=" CON ". number2str($fecha_inscripcion_parts['minutes'])." MINUTOS";
	$pdf->Cell(0,0,$prt_fecha_inscripcion);
	$pdf->SetY(95);
	$pdf->SetX(220);
	$pdf->Cell(0,0,utf8_decode(($fecha_inscripcion_parts['hours']>12)?'TARDE':'MAÑANA'));
	$pdf->SetY(103);
	$pdf->SetX(45);
	$prt_dia_inscripcion= number2str($fecha_inscripcion_parts['mday']);
	$pdf->Cell(0,0,$prt_dia_inscripcion);
	$pdf->SetY(103);
	$pdf->SetX(115);
	//$prt_mes_dictamen= $fecha_inscripcion_parts['month'];
	//$pdf->Cell(0,0,$fecha_inscripcion->format('F'));
	$pdf->Cell(0,0,strtoupper(strftime('%B',$fecha_inscripcion->getTimestamp())));
	$pdf->SetY(103);
	$pdf->SetX(220);
	$pdf->Cell(0,0,number2str($fecha_inscripcion->format('y')));
	$pdf->SetY(120);
	$pdf->SetX(30);
	$pdf->Cell(0,0,strtoupper($row['compareciente1nombre']));
	$pdf->SetY(120);
	$pdf->SetX(173);
	$pdf->Cell(0,0,number2str($row['compareciente1edad']));
	$pdf->SetY(134);
	$pdf->SetX(30);
	$pdf->Cell(0,0,strtoupper($row['compareciente1oficio']));
	$pdf->SetX(77);
	//TODO: hay ke agregar este campo en formatos de entrada de informacion de las actas porke no esta
	$pdf->Cell(0,0,strtoupper($row['compareciente1estadocivil']));
	$pdf->SetX(128);
	$pdf->Cell(0,0,strtoupper($row['compareciente1domicilio']));
	$pdf->SetX(218);
	$pdf->Cell(0,0,strtoupper($row['compareciente1nacionalidad']));
	$pdf->SetX(215);
	$pdf->Cell(0,0,strtoupper($row['compareciente1cedula']));
	$pdf->SetY(154);
	$pdf->SetX(30);
	$pdf->Cell(0,0,strtoupper($row['jueznotario']));
	$pdf->SetY(154);
	$pdf->SetX(160);
	$pdf->Cell(0,0,strtoupper($row['nombrejuzgado']));
	$pdf->SetY(154);
	$pdf->SetX(212);
	$pdf->Cell(0,0,strtoupper($row['lugarjuzgado']));
	$pdf->SetY(174);
	$pdf->SetX(42);
	$fecha_dictamen= new DateTime($row['fechadictament']);
	$fecha_dictamen_parts= getdate($fecha_dictamen->getTimestamp());
	$prt_hora_dictamen=number2str($fecha_dictamen->format('g'));
	$prt_hora_dictamen.=" CON ". number2str($fecha_dictamen_parts['minutes'])." MINUTOS";
	$pdf->Cell(0,0,$prt_hora_dictamen);
	$pdf->SetY(174);
	$pdf->SetX(120);
	$pdf->Cell(0,0,utf8_decode(($fecha_dictamen_parts['hours']>12)?'TARDE':'MAÑANA'));
	$pdf->SetY(174);
	$pdf->SetX(175);
	$prt_dia_dictamen= number2str($fecha_dictamen_parts['mday']);
	$pdf->Cell(0,0,$prt_dia_dictamen);
	$pdf->SetY(181);
	$pdf->SetX(50);
	//$pdf->Cell(0,0,$row['fechadictament']);
	$pdf->Cell(0,0,strtoupper(strftime('%B',$fecha_dictamen->getTimestamp())));
	$pdf->SetY(181);
	$pdf->SetX(210);
	//$pdf->Cell(0,0,$row['fechadictament']);
	$pdf->Cell(0,0,number2str($fecha_dictamen->format('y')));
	$pdf->SetY(199);
	$pdf->SetX(30);
	$pdf->Cell(0,0,strtoupper($row['inscrito1nombre1']. "  " .$row['inscrito1nombre2']. "  " .$row['inscrito1apellido1']. "  " .$row['inscrito1apellido2']));
	$pdf->SetY(199);
	$pdf->SetX(173);
	$pdf->Cell(0,0,number2str($row['conyuge1edad']));
	$pdf->SetY(213);
	$pdf->SetX(30);
	$pdf->Cell(0,0,strtoupper($row['conyuge1oficio']));
	$pdf->SetX(80);
	$pdf->Cell(0,0,strtoupper($row['conyuge1domicilio']));
	$pdf->SetX(175);
	$pdf->Cell(0,0,strtoupper($row['conyuge1nacionalidad']));
	$pdf->SetX(218);
	$pdf->Cell(0,0,strtoupper($row['conyuge1cedula']));
	$pdf->SetY(228);
	$pdf->SetX(30);
	$pdf->Cell(0,0,strtoupper($row['inscrito2nombre1']. "  " .$row['inscrito2nombre2']. "  " .$row['inscrito2apellido1'].",   " .$row['inscrito2apellido2']));
	$pdf->SetY(228);
	$pdf->SetX(173);
	$pdf->Cell(0,0,number2str($row['conyuge2edad']));
	$pdf->SetY(243);
	$pdf->SetX(30);
	$pdf->Cell(0,0,strtoupper($row['conyuge2oficio']));
	$pdf->SetX(80);
	$pdf->Cell(0,0,strtoupper($row['conyuge2domicilio']));
	$pdf->SetX(175);
	$pdf->Cell(0,0,strtoupper($row['conyuge2nacionalidad']));
	$pdf->SetX(218);
	$pdf->Cell(0,0,strtoupper($row['conyuge2cedula']));
	$pdf->SetY(258);
	$pdf->SetX(30);
	/*
	$hijos_procreados= 'observaciones deben de ser suficientemente largos como para  probar imprimir en varias lineas de este documento den pdf, sera suficiente?';
	$guarda= new guardaTable();
	$guardados= $guarda->readDataFilter("guarda.idinscripcion=".$row['idinscripcion']);
	if(sizeof($guardados)>0){
		foreach($guardados as $hijo){
			$hijos_procreados.=$hijo['nombrereconocido'];
		}
	}
	*/
	//--------------------------
	$guarda= new guardaTable();
	$guardados= $guarda->readDataFilter("guarda.idinscripcion=".$row['idinscripcion']);
	if(sizeof($guardados)>0){
		$cell_h= 5;
		foreach($guardados as $hijo){
		//$i=0;
		//do{
			$pdf->SetX(30);
			$fecha_nac= new DateTime($hijo['fechanacimiento']);
			$pdf->Cell(90,$cell_h,$hijo['nombrereconocido'],0,0);
			$pdf->Cell(80,$cell_h,$fecha_nac->format('d/m/Y'),0,0);
			$pdf->Cell(58,$cell_h,$hijo['lugarnacimiento'],0,0);
			$pdf->Ln();
			$pdf->Cell(228,2,"",0,0);
			$pdf->Ln();
		//$i++;}while($i<12);
		}
	}

	//-------------------------
	$pdf->MultiCell(226,6.0,$hijos_procreados);
	#pagina de atras
	$pdf->AddPage();
	//$pdf->Image('./imgs/acta_disolucion_matrimonio_atras.png', 11,18, 228.94,324.61);
	$pdf->Image('./imgs/acta_disolucion_matrimonio_atras.jpg', 11,18, 228.94,324.61);
	$pdf->SetY(29);
	$pdf->SetX(15);
	$pdf->Cell(0,0,strtoupper($row['custodionombre']));
	$pdf->SetY(49);
	$pdf->SetX(15);
	$pdf->Cell(0,0,strtoupper(utf8_decode(mb_strtoupper(number2str($row['pensionalimenticia'],'UTF-8')))));
	$pdf->SetY(49);
	$pdf->SetX(215);
	$pdf->Cell(0,0,$row['pensionalimenticia']);
	$pdf->SetY(59);
	$pdf->SetX(139);
	$rustico= ($row['tipoinmuebleafectado']=="rustico")?"X":"";
	$pdf->Cell(0,0,$rustico);
	$pdf->SetY(59);
	$pdf->SetX(189);
	$urbano= ($row['tipoinmuebleafectado']=="urbano")?"X":"";
	$pdf->Cell(0,0,$urbano);
	$pdf->SetY(71);
	$pdf->SetX(46);
	$pdf->Cell(0,0,($row['asientoregistroinmueble']>0)?$row['asientoregistroinmueble']:'');
	$pdf->SetY(71);
	$pdf->SetX(132);
	$pdf->Cell(0,0,($row['tomoregistroinmueble']>0)?$row['tomoregistroinmueble']:"");
	$pdf->SetY(71);
	$pdf->SetX(176);
	$pdf->Cell(0,0,($row['folioregistroinmueble']>0)?$row['folioregistroinmueble']:"");
	$pdf->SetY(71);
	$pdf->SetX(212);
	$pdf->Cell(0,0,($row['partidaregistroinmueble']>0)?$row['partidaregistroinmueble']:"");
	$pdf->SetY(78);
	$pdf->SetX(175);
	$pdf->Cell(0,0,strtoupper((!empty($row['lugarregistroinmueble'])?$row['lugarregistroinmueble']:"")));
	$pdf->SetY(91);
	$pdf->SetX(42);
	$pdf->Cell(0,0,strtoupper(!empty($row['propietarioinmueble'])?$row['propietarioinmueble']:""));
	$pdf->SetY(113);
	$pdf->SetX(15);
	$disolucion_extranjero= $row['enextranjero'];
	$pdf->MultiCell(226,6.0,$disolucion_extranjero);
	$pdf->SetY(127);
	$pdf->SetX(47);
	$datos_adicionales=$row['datosadicionales'];
	$pdf->MultiCell(194,6.0,$datos_adicionales);
	$pdf->SetY(155);
	$pdf->SetX(15);
	$observaciones= $row['observaciones'];
	$pdf->MultiCell(226,6.5,$observaciones);
	$pdf->SetY(199);
	$pdf->SetX(15);
	$mod_civil= '';
	$notasmarginales= $data->readDataSQL("SELECT cuerpo FROM notamarginal WHERE idinscripcion=" . $data->request['idinscripcion']." ORDER BY fechamarginacion DESC LIMIT 3");
		if(sizeof($notasmarginales)>0){
		foreach($notasmarginales as $notamarginal){
			$modificaciones[]= $notamarginal['cuerpo'];
		}
		$mod_civil= utf8_decode(implode(PHP_EOL,$modificaciones));
	}
	//$mod_civil= 'marginaciones ....aqui van';
	$pdf->MultiCell(226,6.0,$mod_civil);
	//$pdf->MultiCell(226,6.0,$mod_civil,1);
	$pdf->SetY(276);
	$pdf->SetX(85);
	$pdf->Cell(0,0,$row['compareciente1nombre']);
	$pdf->SetY(295);
	$pdf->SetX(20);
	$pdf->Cell(0,0,$row['nombreregistrador']);
	$pdf->SetY(295);
	$pdf->SetX(160);
	$pdf->Cell(0,0,$row['nombresecretario']);
	$pdf->SetY(311);
	$pdf->SetX(38);
	//$pdf->Cell(0,0,'Nacimiento');
	$pdf->SetY(318);
	$pdf->SetX(43);
	//$pdf->Cell(0,0,'Conyuge Varon');
	$pdf->SetY(325);
	$pdf->SetX(38);
	$pdf->Cell(0,0,strtoupper($row['conyuge1lugarinscripcion']));
	$pdf->SetY(325);
	$pdf->SetX(124);
	$pdf->Cell(0,0,$row['conyuge1tomoinscripcion']);
	$pdf->SetY(325);
	$pdf->SetX(160);
	$pdf->Cell(0,0,$row['conyuge1folioinscripcion']);
	$pdf->SetY(325);
	$pdf->SetX(200);
	$pdf->Cell(0,0,$row['conyuge1partidainscripcion']);
	$pdf->SetY(325);
	$pdf->SetX(230);
	$pdf->Cell(0,0,$row['conyuge1anyoinscripcion']);
	$pdf->SetY(333);
	$pdf->SetX(43);
	//$pdf->Cell(0,0,'Conyuge Mujer');
	$nlt= 339;
	$pdf->SetY($nlt);
	$pdf->SetX(38);
	$pdf->Cell(0,0,strtoupper($row['conyuge2lugarinscripcion']));
	$pdf->SetY($nlt);
	$pdf->SetX(124);
	$pdf->Cell(0,0,$row['conyuge2tomoinscripcion']);
	$pdf->SetY($nlt);
	$pdf->SetX(160);
	$pdf->Cell(0,0,$row['conyuge2folioinscripcion']);
	$pdf->SetY($nlt);
	$pdf->SetX(200);
	$pdf->Cell(0,0,$row['conyuge2partidainscripcion']);
	$pdf->SetY($nlt);
	$pdf->SetX(230);
	$pdf->Cell(0,0,$row['conyuge2anyoinscripcion']);

	#$pdf->SetY(337);
	#$pdf->SetX(38);
	#$pdf->Cell(0,0,'Ciudad_inscrita');
	#$pdf->SetY(337);
	#$pdf->SetX(125);
	#$pdf->Cell(0,0,'Tomo');
	#$pdf->SetY(337);
	#$pdf->SetX(160);
	#$pdf->Cell(0,0,'folio');
	#$pdf->SetY(337);
	#$pdf->SetX(200);
	#$pdf->Cell(0,0,'Partida');
	#$pdf->SetY(337);
	#$pdf->SetX(230);
	#$pdf->Cell(0,0,'Fecha');
	
 	
}
$pdf->Output();
?>

