<?php
$pdf->SetAutoPageBreak(false, 10);
$pdf->AddPage();
//$pdf->SetFont('Arial','',12);
//$data = new inscripcionTable();
//$data->readEnv();
$ini_y=30;
$ini_x=0;

#INSCRIPCIONES DE DEFUNCION
if ($data->request['idinscripcion']) {
	//print_r($data->request);
	$rows = $data->readDataSQL("SELECT d.*, hv.*, ins.*, ac.folio, ac.partida, ac.fecha, t.numero FROM defuncion d INNER JOIN hechovital hv ON d.iddefuncion=hv.idhechovital INNER JOIN inscripcion ins ON hv.idhechovital= ins.idinscripcion LEFT JOIN acta ac ON ac.idinscripcion= ins.idinscripcion INNER JOIN tomo t ON t.idtomo=ac.idtomo WHERE ac.idinscripcion='" . $data->request['idinscripcion'] ."'");
	$row = $rows[0];
	//print_r($row);
    //$pdf->Image('./imgs/acta-defuncion.png', 24, 15, 226.91,321.56 );
	/* datos del municipio y acta */
	$pdf->SetY($ini_y + 20);
	$pdf->SetX($ini_x + 130);
	$pdf->Cell(0,0,'MATAGALPA');
	$pdf->SetY($ini_y + 8);
	$pdf->SetX($ini_x + 225);
	$pdf->Cell(0,0,$row['numero']);
	$pdf->SetY($ini_y + 15);
	$pdf->SetX($ini_x + 225);
	$pdf->Cell(0,0,$row['folio']);
	$pdf->SetY($ini_y + 20);
	$pdf->SetX($ini_x + 230);
	$pdf->Cell(0,0,$row['partida']);
	$pdf->SetY($ini_y + 25);
	$pdf->SetX($ini_x + 225);
	$fecha_acta= new Datetime($row['fecha']);
	$pdf->Cell(0,0,$fecha_acta->format('d/m/Y'));
	/* nombre del inscrito */
	$pdf->SetY($ini_y + 37);
	$pdf->SetX($ini_x + 40);
	$pdf->Cell(0,0,strtoupper($row['inscrito1nombre1']));
	$pdf->SetX($ini_x + 96);
	$pdf->Cell(0,0,strtoupper($row['inscrito1nombre2']));
	$pdf->SetX($ini_x + 155);
	$pdf->Cell(0,0,strtoupper($row['inscrito1apellido1']));
	$pdf->SetX($ini_x + 213);
	$pdf->Cell(0,0,strtoupper($row['inscrito1apellido1']));
	/* lugar y fecha inscripcion linea1 */
	$pdf->SetY($ini_y + 48);
	$pdf->SetX($ini_x + 45);
	$pdf->Cell(0,0,strtoupper($row['ciudadinscripcion']));
	$pdf->SetX($ini_x + 190);
	$pdf->Cell(0,0,strtoupper($row['municipioinscripcion']));
	/* lugar y fecha inscripcion linea2 */
	$pdf->SetY($ini_y + 55);
	$pdf->SetX($ini_x + 80);
	$pdf->Cell(0,0,strtoupper($row['departamentoinscripcion']));
	$pdf->SetX($ini_x + 150);
	$fecha_inscripcion= new DateTime($row['fecha']);
	$fecha_inscripcion_parts= getdate($fecha_inscripcion->getTimestamp());
	$prt_fecha_inscripcion=number2str($fecha_inscripcion->format('g'));
	$prt_fecha_inscripcion.=" CON ". number2str($fecha_inscripcion_parts['minutes']);
	$pdf->Cell(0,0,$prt_fecha_inscripcion);
	$pdf->SetX($ini_x + 225);
	$pdf->Cell(0,0,utf8_decode(($fecha_inscripcion_parts['hours']>12)?'TARDE':'MAÑANA'));
	/* lugar y fecha inscripcion linea3 */
	$pdf->SetY($ini_y + 60);
	$pdf->SetX($ini_x + 55);
	$prt_dia_inscripcion= number2str($fecha_inscripcion_parts['mday']);
	$pdf->Cell(0,0,$prt_dia_inscripcion);
	$pdf->SetX($ini_x + 125);
	$pdf->Cell(0,0,strtoupper(strftime('%B',$fecha_inscripcion->getTimestamp())));
	$pdf->SetX($ini_x + 223);
	$pdf->Cell(0,0,number2str($fecha_inscripcion->format('y')));
	/* datos del compareciente linea 1 */
	$pdf->SetY($ini_y + 73);
	$pdf->SetX($ini_x + 40);
	$pdf->Cell(0,0,strtoupper($row['compareciente1nombre']));
	$pdf->SetX($ini_x + 175);
	$pdf->Cell(0,0,number2str($row['compareciente1edad']));
	/* datos del compareciente linea 2 */
	$pdf->SetY($ini_y + 88);
	$pdf->SetX($ini_x + 40);
	$pdf->Cell(0,0,strtoupper($row['compareciente1oficio']));
	$pdf->SetX($ini_x + 82);
	$pdf->Cell(0,0,'estado_civil');
	$pdf->SetX($ini_x + 133);
	//$pdf->SetFont('Arial','',8);
	//$pdf->MultiCell(70,3.0,strtoupper($row['compareciente1domicilio']));
	//$pdf->SetFont('Arial','',12);
	//$pdf->Cell(0,0,$row['compareciente1domicilio']);
	$pdf->Cell(0,0,strtoupper('Matagalpa'));
	$pdf->SetX($ini_x + 217);
	$pdf->Cell(0,0,strtoupper($row['compareciente1cedula']));
	/* fecha defuncion linea 1 */
	$pdf->SetY($ini_y + 100);
	$pdf->SetX($ini_x + 77);
	$fecha_defuncion= new DateTime($row['fechadefuncion']);
	$fecha_defuncion_parts= getdate($fecha_defuncion->getTimestamp());
	$prt_hora_defuncion=number2str($fecha_defuncion->format('g'));
	$prt_hora_defuncion.=" CON ". number2str($fecha_defuncion_parts['minutes']);
	$pdf->Cell(0,0,$prt_hora_defuncion);
	$pdf->SetX($ini_x + 197);
	$pdf->Cell(0,0,utf8_decode(($fecha_defuncion_parts['hours']>12)?'TARDE':'MAÑANA'));
	/* fecha defuncion linea 2 */
	$pdf->SetY($ini_y + 105);
	$pdf->SetX($ini_x + 55);
	$prt_dia_defuncion= number2str($fecha_defuncion_parts['mday']);
	$pdf->Cell(0,0,$prt_dia_defuncion);
	$pdf->SetX($ini_x + 130);
	$pdf->Cell(0,0,strtoupper(strftime('%B',$fecha_defuncion->getTimestamp())));
	$pdf->SetX($ini_x + 213);
	$pdf->Cell(0,0,number2str($fecha_defuncion->format('y')));
	/* datos de fallecido linea 1 */
	$pdf->SetY($ini_y + 120);
	$pdf->SetX($ini_x + 40);
	$def_full_name= array($row['inscrito1nombre1'],$row['inscrito1nombre2'], $row['inscrito1apellido1'], $row['inscrito1apellido2']) ;
	$pdf->Cell(0,0,strtoupper(implode(" ",$def_full_name)));
	//$pdf->Cell(0,0,$row['inscrito1nombre1'].' '. $row['inscrito1nombre2'] .' '. $row['inscrito1apellido1'] .' '. $row['inscrito1apellido2']);
	$pdf->SetX($ini_x + 170);
	$pdf->Cell(0,0,number2str($row['edadfallecido' ]));
	/* datos de fallecido linea 2 */
	$pdf->SetY($ini_y + 135);
	if ($row['sexoinscrito'] <> 'f') {
  	  $pdf->SetX($ini_x + 60);
	  $pdf->Cell(0,0,'X');
        } else {
	  $pdf->SetX($ini_x + 80);
   	  $pdf->Cell(0,0,'X');

        }
	$pdf->SetX($ini_x + 100);
	$pdf->Cell(0,0,strtoupper($row['oficiofallecido']));
	$pdf->SetX($ini_x + 152);
	$pdf->Cell(0,0,strtoupper($row['estado_civil']));
	//$pdf->SetFont('Arial','',8);
	//$pdf->SetY($ini_y + 155);
	$pdf->SetX($ini_x + 153);
	#$pdf->Cell(0,0,$row['domiciliofallecido']);
 	$domiciliofallecido = $row['domiciliofallecido'];
	//$pdf->MultiCell(85,2.7,$domiciliofallecido);
	$pdf->Cell(0,0,strtoupper('Matagalpa'));
	//$pdf->SetFont('Arial','',12);
	$pdf->SetY($ini_y + 147);
	$pdf->SetX($ini_x + 40);
	$pdf->Cell(0,0,strtoupper($row['nacionalidadfallecido']));
	$pdf->SetX($ini_x + 103);
	$pdf->Cell(0,0,strtoupper($row['cedulafallecido']));
	$pdf->SetX($ini_x + 163);
	$pdf->Cell(0,0,strtoupper($row['causamuerte']));
	/* datos del conyuge  */
	$pdf->SetY($ini_y + 161);
	$pdf->SetX($ini_x + 40);
	$pdf->Cell(0,0,strtoupper($row['conyugenombre']));
	$pdf->SetX($ini_x + 170);
	$pdf->Cell(0,0,'edad_conyuge');
	/* lugar de nacimiento del fallecido */
	$pdf->SetY($ini_y + 182);
	$pdf->SetX($ini_x + 40);
	$pdf->Cell(0,0,strtoupper($row['ciudadnacimiento']));
	$pdf->SetX($ini_x + 92);
	$pdf->Cell(0,0,strtoupper($row['municipionacimiento']));
	$pdf->SetX($ini_x + 158);
	$pdf->Cell(0,0,strtoupper($row['departamentonacimiento']));
	$pdf->SetX($ini_x + 219);
	$pdf->Cell(0,0,strtoupper($row['paisnacimiento']));
	/* lugar de nacimiento del fallecido */
	$pdf->SetY($ini_y + 188);
	$pdf->SetX($ini_x + 48);
	$fecha_nacimiento= new DateTime($row['fechanacimiento']);
	$fecha_nacimiento_parts= getdate($fecha_nacimiento->getTimestamp());
	$prt_dia_nacimiento= number2str($fecha_nacimiento_parts['mday']);
	$pdf->Cell(0,0,$prt_dia_nacimiento);
	$pdf->SetX($ini_x + 130);
	$pdf->Cell(0,0,strtoupper(strftime('%B',$fecha_nacimiento->getTimestamp())));
	$pdf->SetX($ini_x + 185);
	$pdf->Cell(0,0,number2str($fecha_nacimiento->format('Y')));
	/* nombres de los padres */
	// Fix fron here
	$pdf->SetY($ini_y + 205);
	$pdf->SetX($ini_x + 82);
	$pdf->Cell(0,0,strtoupper($row['padrenombre']));
	$pdf->SetX($ini_x + 180);
	$pdf->Cell(0,0,strtoupper($row['nombremadre']));
	/* fallecido en el extranjero */
	$pdf->SetY($ini_y + 227);
	$pdf->SetX($ini_x + 100);
	$fallecido_extrangero= "                              ";
	$fallecido_extrangero.=substr($row['enextranjero'],0,220);
	$pdf->MultiCell(224,7.0,$fallecido_extrangero);
	/* datos adicionales */
	$pdf->SetY($ini_y + 240);
	$pdf->SetX($ini_x + 85);
	$adicionales= "                            ";
	$adicionales.= $row['datosadicionales'];
	$pdf->MultiCell(224,7.0,$adicionales);
	/* Observaciones  */
	$pdf->SetY($ini_y + 262);
	$pdf->SetX($ini_x + 75);
	$observaciones=  "                       ";
	$observaciones.= $row['observaciones'];
	$pdf->MultiCell(224,7.0,$observaciones);
	/* compareciente */
	$pdf->SetY($ini_y + 280);
	$pdf->SetX($ini_x + 90);
	$pdf->Cell(0,0,strtoupper($row['compareciente1nombre']));
	/* registrador y secretario */
	$pdf->SetY($ini_y + 290);
	$pdf->SetX($ini_x + 45);
	$pdf->Cell(0,0,$row['nombreregistrador']);
	$pdf->SetX($ini_x + 190);
	$pdf->Cell(0,0,$row['nombresecretario']);

	$nac_vc=315;
	$pdf->SetY($ini_y + $nac_vc);
	$pdf->SetX($ini_x + 70);
	$pdf->Cell(0,0,$row['lugarinscripcionnacimiento']);
	$pdf->SetY($ini_y + $nac_vc);
	$pdf->SetX($ini_x + 147);
	$pdf->Cell(0,0,$row['tomoinscripcionnacimiento']);
	$pdf->SetX($ini_x + 180);
	$pdf->Cell(0,0,$row['folioinscripcionnacimiento']);
	$pdf->SetX($ini_x + 217);
	$pdf->Cell(0,0,$row['partidainscripcionnacimiento']);
	$pdf->SetY($ini_y + $nac_vc);
	$pdf->SetX($ini_x + 250);
	$fecha_nacimiento= new DateTime($row['fechanacimiento']);
	$pdf->Cell(0,0,$fecha_nacimiento->format('Y'));
}
?>
