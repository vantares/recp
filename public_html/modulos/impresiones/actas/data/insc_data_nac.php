<?php
$pdf->SetAutoPageBreak(false, 10);
$pdf->AddPage();
//$pdf->SetFont('Arial','',12);
//$pdf->SetFont('Roman','',12);
//$pdf->SetFont('Arial','',12);
//$pdf->SetTextColor(20,20,20);
//$pdf->SetTextColor(50,50,50);
$pdf->SetTopMargin(0);
//$pdf->SetLeftMargin(-20);

$ini_y=0;
$ini_x=0;

//$data = new inscripcionTable();
//$data->readEnv();

if ($data->request['idinscripcion']) {
	$rows = $data->readDataSQL("SELECT n.*, hv.*, ins.*, ac.idtomo, ac.folio, ac.partida, ac.fecha, t.numero FROM nacimiento n INNER JOIN hechovital hv ON n.idnacimiento=hv.idhechovital INNER JOIN inscripcion ins ON hv.idhechovital= ins.idinscripcion LEFT JOIN acta ac ON ac.idinscripcion= ins.idinscripcion INNER JOIN tomo t on t.idtomo=ac.idtomo WHERE ac.idinscripcion='" . $data->request['idinscripcion'] ."'");
        $row = $rows[0];
	//print_r($row);
    //$pdf->Image('./imgs/acta_nacimiento_frente.jpg', 44,23, 222.50,328.17 );
	/* Municipio y datos registrales del acta */
	$pdf->SetY($ini_y + 36);
	$pdf->SetX($ini_x + 127);
	$pdf->Cell(0,0,strtoupper('Matagalpa'));
	$pdf->SetY($ini_y + 25);
	$pdf->SetX($ini_x + 220);
	$pdf->Cell(0,0,$row['numero']);
	$pdf->SetY($ini_y + 31);
	$pdf->SetX($ini_x + 220);
	$pdf->Cell(0,0,$row['folio']);
	$pdf->SetY($ini_y + 38);
	$pdf->SetX($ini_x + 225);
	$pdf->Cell(0,0,$row['partida']);
	$pdf->SetY($ini_y + 45);
	$pdf->SetX($ini_x + 220);
	$fecha_acta= new Datetime($row['fecha']);
	$pdf->Cell(0,0,$fecha_acta->format('d/m/Y'));
	/* Datos del inscrito */
	$pdf->SetY($ini_y + 57);
	$pdf->SetX($ini_x + 35);
	$pdf->Cell(0,0,strtoupper($row['inscrito1nombre1']));
	$pdf->SetX($ini_x + 90);
	$pdf->Cell(0,0,strtoupper($row['inscrito1nombre2']));
	$pdf->SetX($ini_x + 145);
	$pdf->Cell(0,0,strtoupper($row['inscrito1apellido1']));
	$pdf->SetX($ini_x + 200);
	$pdf->Cell(0,0,strtoupper($row['inscrito1apellido2']));
	/* lugar de registro linea 1 */
	$pdf->SetY($ini_y + 68);
	$pdf->SetX($ini_x + 40);
	$pdf->Cell(0,0,strtoupper($row['ciudadinscripcion']));
	$pdf->SetX($ini_x + 165);
	$pdf->Cell(0,0,strtoupper($row['municipioinscripcion']));
	/* fecha de registro linea 1*/
	$pdf->SetY($init_y + 75);
	$pdf->SetX($ini_x + 70);
	$pdf->Cell(0,0,strtoupper($row['departamentoinscripcion']));
	$pdf->SetX($ini_x + 122);
	$fecha_inscripcion= new DateTime($row['fecha']);
	$fecha_inscripcion_parts= getdate($fecha_inscripcion->getTimestamp());
	$prt_fecha_inscripcion=number2str($fecha_inscripcion->format('g'));
	$prt_fecha_inscripcion.=" CON ". number2str($fecha_inscripcion_parts['minutes']);
	$pdf->Cell(0,0,$prt_fecha_inscripcion);
	$pdf->SetX($ini_x + 215);
	$pdf->Cell(0,0,iconv("UTF-8", "ISO-8859-1",($fecha_inscripcion_parts['hours']>12)?'TARDE':'MAÑANA'));
	/* fecha inscripcion linea 2 */
	$pdf->SetY($init_y + 82);
	$pdf->SetX($ini_x + 50);
	$prt_dia_inscripcion= number2str($fecha_inscripcion_parts['mday']);
	$pdf->Cell(0,0,$prt_dia_inscripcion);
	$pdf->SetX($ini_x + 130);
	$pdf->Cell(0,0,strtoupper(strftime('%B',$fecha_inscripcion->getTimestamp())));
	$pdf->SetX($ini_x + 197);
	$pdf->Cell(0,0,number2str($fecha_inscripcion->format('y')));
	/* nombre copareciente linea 1 */
	$pdf->SetY($init_y + 98);
	$pdf->SetX($ini_x + 35);
	$pdf->Cell(0,0,strtoupper($row['compareciente1nombre']));
	$pdf->SetX($ini_x + 170);
	$pdf->Cell(0,0,number2str($row['compareciente1edad']));
	/* copareciente linea 2 */
	$pdf->SetY($ini_y + 113);
	$pdf->SetX($ini_x + 35);
	$pdf->Cell(0,0,strtoupper($row['compareciente1oficio']));
	$pdf->SetX($ini_x + 93);
	//$pdf->SetFont('Arial','',8);
	//$pdf->MultiCell(70,3.0,strtoupper($row['compareciente1domicilio']));
	//$pdf->Cell(0,0,strtoupper($row['compareciente1domicilio']));
	$pdf->Cell(0,0,strtoupper('Matagalpa'));
	//$pdf->SetFont('Arial','',12);
	$pdf->SetX($ini_x + 160);
	$pdf->Cell(0,0,strtoupper($row['compareciente1nacionalidad']));
	$pdf->SetX($ini_x + 210);
	$pdf->Cell(0,0,strtoupper($row['compareciente1cedula']));
	/* compareciente 2 linea 1 */
	$pdf->SetY($ini_y + 128);
	$pdf->SetX($ini_x + 35);
	$pdf->Cell(0,0,strtoupper($row['compareciente2nombre']));
	$pdf->SetX($ini_x + 170);
	$pdf->Cell(0,0,number2str($row['compareciente2edad']));
	/* compareciente 2 linea 2 */
	$pdf->SetY($ini_y + 142);
	$pdf->SetX($ini_x + 35);
	$pdf->Cell(0,0,strtoupper($row['compareciente2oficio']));
	$pdf->SetX($ini_x + 93);
	//$pdf->SetFont('Arial','',8);
	//$pdf->MultiCell(70,3.0,strtoupper($row['compareciente1domicilio']));
	$pdf->Cell(0,0,strtoupper('Matagalpa'));
	//$pdf->SetFont('Arial','',12);
	//$pdf->Cell(0,0,'Domicilio');
	$pdf->SetX($ini_x + 160);
	$pdf->Cell(0,0,strtoupper($row['compareciente2nacionalidad']));
	$pdf->SetX($ini_x + 210);
	$pdf->Cell(0,0,strtoupper($row['compareciente2cedula']));
	/* nacimiento fecha linea 1 */
	$pdf->SetY($ini_y + 155);
	$pdf->SetX($ini_x + 70);
	$fecha_nacimiento= new DateTime($row['fechanacimiento']);
	$fecha_nacimiento_parts= getdate($fecha_nacimiento->getTimestamp());
	$prt_hora_nacimiento=number2str($fecha_nacimiento->format('g'));
	$prt_hora_nacimiento.=" CON ". number2str($fecha_nacimiento_parts['minutes']);
	$pdf->Cell(0,0,$prt_hora_nacimiento);
	$pdf->SetX($ini_x + 192);
	$pdf->Cell(0,0,utf8_decode(($fecha_nacimiento_parts['hours']>12)?'TARDE':'MAÑANA'));
	/* nacimiento fecha linea 2 */
	$pdf->SetY($ini_y + 162);
	$pdf->SetX($ini_x + 48);
	$prt_dia_nacimiento= number2str($fecha_nacimiento_parts['mday']);
	$pdf->Cell(0,0,$prt_dia_nacimiento);
	$pdf->SetX($ini_x + 130);
	$pdf->Cell(0,0,strtoupper(strftime('%B',$fecha_nacimiento->getTimestamp())));
	$pdf->SetX($ini_x + 205);
	$pdf->Cell(0,0,number2str($fecha_nacimiento->format('y')));
	/* lugar nacimiento */
	$pdf->SetY($ini_y + 172);
	$pdf->SetX($ini_x + 35);
	$pdf->Cell(0,0,strtoupper($row['ciudadnacimiento']));
	$pdf->SetX($ini_x + 93);
	$pdf->Cell(0,0,strtoupper($row['municipionacimiento']));
	$pdf->SetX($ini_x + 158);
	$pdf->Cell(0,0,strtoupper($row['departamentonacimiento']));
	$pdf->SetX($ini_x + 205);
	$pdf->Cell(0,0,strtoupper($row['paisnacimiento']));
	/* nacido nombre */
	$pdf->SetY($ini_y + 186);
	$pdf->SetX($ini_x + 58);
	$nac_full_name= array($row['inscrito1nombre1'],$row['inscrito1nombre2'], $row['inscrito1apellido1'], $row['inscrito1apellido2']) ;
	$pdf->Cell(0,0,strtoupper(implode(" ",$nac_full_name)));
	$pdf->SetX($ini_x + 230);
	$sexo= $row['sexoinscrito'];
	$pdf->Cell(0,0,($sexo=="m")?"X":"");
	$pdf->SetX($ini_x + 245);
	$pdf->Cell(0,0,($sexo=="f")?"X":"");
	/* datos del padre1 linea 1 */
	$pdf->SetY($ini_y + 200);
	$pdf->SetX($ini_x + 35);
	$pdf->Cell(0,0,strtoupper($row['padrenombre']));
	$pdf->SetX($ini_x + 168);
	$pdf->Cell(0,0,number2str($row['edadpadre']));
	/* datos del padre1 linea 2 */
	$pdf->SetY($ini_y + 218);
	$pdf->SetX($ini_x + 35);
	$pdf->Cell(0,0,strtoupper($row['oficiopadre']));
	$pdf->SetX($ini_x + 80);
	//$pdf->Cell(0,0,strtoupper($row['domiciliopadre']));
	$pdf->Cell(0,0,strtoupper('Matagalpa'));
	$pdf->SetX($ini_x + 158);
	$pdf->Cell(0,0,strtoupper($row['nacionalidadpadre']));
	$pdf->SetX($ini_x + 210);
	$pdf->Cell(0,0,strtoupper($row['cedulapadre']));
	/* datos del padre1 linea 1 */
	$pdf->SetY($ini_y + 228);
	$pdf->SetX($ini_x + 35);
	$pdf->Cell(0,0,strtoupper($row['nombremadre']));
	$pdf->SetX($ini_x + 168);
	$pdf->Cell(0,0,number2str($row['edadmadre']));
	/* datos del padre1 linea 2 */
	$pdf->SetY($ini_y + 242);
	$pdf->SetX($ini_x + 35);
	$pdf->Cell(0,0,strtoupper($row['oficiomadre']));
	$pdf->SetX($ini_x + 80);
	//$pdf->Cell(0,0,strtoupper($row['domiciliomadre']));
	$pdf->Cell(0,0,strtoupper('Matagalpa'));
	$pdf->SetX($ini_x + 158);
	$pdf->Cell(0,0,strtoupper($row['nacionalidadpadre']));
	$pdf->SetX($ini_x + 210);
	$pdf->Cell(0,0,strtoupper($row['cedulamadre']));
	/* Nacido en extranjero  */
	$pdf->SetY($ini_y + 251);
	$pdf->SetX($ini_x + 30);
	//$nac_ext= 'observaciones deben de ser suficientemente largos como para  probar imprimir en varias lineas de este documento den pdf, sera suficiente?';	
	$nac_ext= "                                     ";
	$nac_ext.=substr($row['enextranjero'],0,220);
	$pdf->MultiCell(220,6.0,$nac_ext);
	/* Datos adicionales */
	$pdf->SetY($ini_y + 263);
	$pdf->SetX($ini_x + 30);
	// $adicionales= 'observaciones deben de ser suficientemente largos como para  probar imprimir en varias lineas de este documento den pdf, sera suficiente?';	
	$adicionales= "                              ";
	$adicionales.= $row['datosadicionales'];
	$pdf->MultiCell(220,6.0,$adicionales);
	/* Observaciones */
	$pdf->SetY($ini_y + 275);
	$pdf->SetX($ini_x + 30);
	//$observaciones= 'observaciones deben de ser suficientemente largos como para  probar imprimir en varias lineas de este documento den pdf, sera suficiente?';	
	$observaciones=  "                         ";
	$observaciones.= $row['observaciones'];
	//$pdf->MultiCell(228,5.5,$observaciones);
	$pdf->MultiCell(220,6.0,$observaciones);
	/* nombres de los comparecientes */
	$pdf->SetY($ini_y + 321);
	$pdf->SetX($ini_x + 40);
	$pdf->Cell(0,0,strtoupper($row['compareciente1nombre']));
	$pdf->SetX($ini_x + 175);
	$pdf->Cell(0,0,strtoupper($row['compareciente2nombre']));
	/*nombres de registrador y secretario */
	$pdf->SetY($ini_y + 333);
	$pdf->SetX($ini_x + 40);
	$pdf->Cell(0,0,$row['nombreregistrador']);
	$pdf->SetX($ini_x + 175);
	$pdf->Cell(0,0,$row['nombresecretario']);

	#pagina de atras

	$pdf->AddPage();
	$ini_y=0;
	$ini_x=8;
	/* Notas marginales */
	//$pdf->SetTopMargin(8);
	//$pdf->SetLeftMargin(0);
	//$pdf->Image('./imgs/acta_nacimiento_atras.jpg', 12,31, 222.50,328.17);
	//$pdf->Image('./imgs/acta_nacimiento_atras.jpg', 0,31, 222.50,328.17);
	$pdf->SetY($ini_y + 15);
	//$pdf->SetX($ini_x + 13);
	$pdf->SetX($ini_x + 1);


	$notasmarginales= $data->readDataSQL("SELECT cuerpo FROM notamarginal WHERE idinscripcion=" . $data->request['idinscripcion']." ORDER BY fechamarginacion DESC LIMIT 5");
	$mod_civil="                                                         ";
	if(sizeof($notasmarginales)>0){
		foreach($notasmarginales as $notamarginal){
			$modificaciones[]= $notamarginal['cuerpo'];
		}
		$mod_civil.= utf8_decode(implode(PHP_EOL,$modificaciones));
	}
	//$mod_civil= 'observaciones deben de ser suficientemente largos como para  probar imprimir en varias lineas de este documento den pdf, sera suficiente?';
	$pdf->MultiCell(223,6.8,$mod_civil);
	/* Datos de la defuncion */
	$def_vc= 325;
	$pdf->SetY($ini_y + $def_vc);
	$pdf->SetX($ini_x + 25);
	$pdf->Cell(0,0,strtoupper($row['lugarinscripciondefuncion']));
	$pdf->SetX($ini_x + 126);
	$pdf->Cell(0,0,$row['tomoinscripciondefuncion']);
	$pdf->SetX($ini_x + 155);
	$pdf->Cell(0,0,$row['folioinscripciondefuncion']);
	$pdf->SetX($ini_x + 189);
	$pdf->Cell(0,0,$row['partidainscripciondefuncion']);
	$pdf->SetX($ini_x + 207);
	$pdf->Cell(0,0,$row['anyoinscripciondefuncion']);
}
?>
