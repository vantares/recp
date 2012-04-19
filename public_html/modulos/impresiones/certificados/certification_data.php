<?php
if ($_REQUEST['action'] == 'imprimir') {
	//$data = new inscripcionTable();
	//$data->readEnv();
	//print_r($data);
	//echo "hola";
	switch ($_REQUEST['tipo']) {
		case 'matrimonio':
			$pdf->AddPage();
			$ini_y=0;
			$ini_x=0;
			$pdf->SetFont('Arial','',12);
			$pdf->Image('./imgs/certificado-martrimonio.jpg', 6, 12, 196, 252);
			if ($data->request['idinscripcion']) {
				$confirm= $data->getVar("SELECT inscripcion.tipoinscripcion FROM inscripcion WHERE inscripcion.idinscripcion= ". $data->request['idinscripcion']);
				if($confirm=='Matrimonios'){
					$rows = $data->readDataSQL("SELECT m.*, aj.*, ins.*, ac.idtomo, ac.folio, ac.partida, t.numero FROM matrimonio m INNER JOIN actojuridico aj ON m.idmatrimonio=aj.idactojuridico INNER JOIN inscripcion ins ON aj.idactojuridico= ins.idinscripcion LEFT JOIN acta ac ON ac.idinscripcion= ins.idinscripcion INNER JOIN tomo t on t.idtomo=ac.idtomo WHERE ac.idinscripcion='" . $data->request['idinscripcion'] ."'");
				}
				elseif($confirm=='Reposicion Matrimonio'){
					$rows = $data->readDataSQL("SELECT m.*, aj.*, ins.*, ac.idtomo, ac.folio, ac.partida, t.numero FROM reposicionmatrimonio m INNER JOIN actojuridico aj ON m.idreposicionmatrimonio=aj.idactojuridico INNER JOIN inscripcion ins ON aj.idactojuridico= ins.idinscripcion LEFT JOIN acta ac ON ac.idinscripcion= ins.idinscripcion INNER JOIN tomo t on t.idtomo=ac.idtomo WHERE ac.idinscripcion='" . $data->request['idinscripcion'] ."'");
				}
				$row = $rows[0];
				$pdf->SetY($ini_y + 54);
				$pdf->SetX($ini_x + 83);
				$pdf->Cell(0,0,strtoupper('Matagalpa'));
				//#$pdf->Cell(0,0,strtoupper($confirm));
				$pdf->SetY($ini_y + 61);
				$pdf->SetX($ini_x + 45);
				$pdf->Cell(0,0,strtoupper('Matagalpa'));
				$pdf->SetX($ini_x + 165);
				$fecha_acta= new Datetime($row['fecha']);
				$pdf->Cell(0,0,number2str($fecha_acta->format('Y')));
				$pdf->SetY($ini_y + 95);
				$pdf->SetX($ini_y + 23);
				$pdf->Cell(0,0,strtoupper($row['inscrito1apellido1']." ".$row['inscrito1apellido2']));
				$pdf->SetX($ini_x + 115);
				$pdf->Cell(0,0,strtoupper($row['inscrito1nombre1']." ".$row['inscrito1nombre2']));
				$pdf->SetY($ini_y + 115);
				$pdf->SetX($ini_x + 23);
				$pdf->Cell(0,0,strtoupper($row['conyuge1oficio']));
				$pdf->SetX($ini_x + 115);
				$pdf->Cell(0,0,strtoupper($row['conyuge1nacionalidad']));
				$pdf->SetY($ini_y + 132);
				$pdf->SetX($ini_x + 23);
				$pdf->Cell(0,0,strtoupper($row['inscrito2apellido1']." ".$row['inscrito2apellido2']));
				$pdf->SetX($ini_x + 115);
				$pdf->Cell(0,0,strtoupper($row['inscrito2nombre1']." ".$row['inscrito2nombre2']));
				$pdf->SetY($ini_y + 150);
				$pdf->SetX($ini_x + 23);
				$pdf->Cell(0,0,strtoupper($row['conyuge2oficio']));
				$pdf->SetX($ini_x + 115);
				$pdf->Cell(0,0,strtoupper($row['conyuge2nacionalidad']));
				$pdf->SetY($ini_y + 170);
				$pdf->SetX($ini_x + 85);
				$pdf->Cell(0,0,strtoupper($row['municipioinscripcion']));
				$pdf->SetY($ini_y + 177);
				$pdf->SetX($ini_x + 40);
				$pdf->Cell(0,0,strtoupper($row['departamentoinscripcion']));
				$pdf->SetY($ini_y + 184);
				$pdf->SetX($ini_x + 20);
				$fecha_inscripcion= new DateTime($row['fecha']);
				$fecha_inscripcion_parts= getdate($fecha_inscripcion->getTimestamp());
				$prt_dia_inscripcion= number2str($fecha_inscripcion_parts['mday']);
				$pdf->Cell(0,0,$prt_dia_inscripcion);
				$pdf->SetX($ini_x + 75);
				$pdf->Cell(0,0,strtoupper(strftime('%B',$fecha_inscripcion->getTimestamp())));
				$pdf->SetX($ini_x + 140);
				$pdf->Cell(0,0,number2str($fecha_inscripcion->format('y')));
				$pdf->SetY($ini_y + 190);
				$pdf->SetX($ini_x + 45);
				$pdf->Cell(0,0,$row['partida']);
				$pdf->SetX($ini_x + 112);
				$pdf->Cell(0,0,$row['numero']);
				$pdf->SetX($ini_x + 160);
				$pdf->Cell(0,0,$row['folio']);
				$pdf->SetY($ini_y + 202);
				$observaciones=  "                         ";
				$observaciones = 'Nombre de los hijos debe de ser un texto suficiente mente largo como para  probar imprimir en varias lineas de este documento den pdf, sera suficiente?';
				$observaciones.= $row['observaciones'];
				$pdf->MultiCell(184.5,6.5,$observaciones);
				$pdf->SetY($ini_y + 232);
				$pdf->SetX($ini_x + 125);
				$pdf->Cell(0,0,strtoupper('Matagalpa'));
				$pdf->SetY($ini_y + 239);
				$pdf->SetX($ini_x + 78);
				$fecha_emision= new DateTime();
				$fecha_emision_parts= getdate($fecha_emision->getTimestamp());
				$prt_dia_emision= number2str($fecha_emision_parts['mday']);
				$pdf->Cell(0,0,$prt_dia_emision);
				$pdf->SetX($ini_x + 147);
				$pdf->Cell(0,0,strtoupper(strftime('%B',$fecha_emision->getTimestamp())));
				$pdf->SetY($ini_y + 246);
				$pdf->SetX($ini_x + 25);
				$pdf->Cell(0,0,number2str($fecha_inscripcion->format('y')));
			}
			//agregar datos del regostrador y secretario de turno
			//#print_r("imprimiendo matrimonio");
			break;
		case 'defuncion':
			$pdf->AddPage();
			$ini_y=0;
			$ini_x=0;
			$pdf->Image('./imgs/certificado-defuncion.jpg', 8, 11,201,266);
			if ($data->request['idinscripcion']) {
				$confirm= $data->getVar("SELECT inscripcion.tipoinscripcion FROM inscripcion WHERE inscripcion.idinscripcion= ". $data->request['idinscripcion']);
				if($confirm=='Defunciones'){
					$rows = $data->readDataSQL("SELECT d.*, hv.*, ins.*, ac.folio, ac.partida, ac.fecha, t.numero FROM defuncion d INNER JOIN hechovital hv ON d.iddefuncion=hv.idhechovital INNER JOIN inscripcion ins ON hv.idhechovital= ins.idinscripcion LEFT JOIN acta ac ON ac.idinscripcion= ins.idinscripcion INNER JOIN tomo t ON t.idtomo=ac.idtomo WHERE ac.idinscripcion='" . $data->request['idinscripcion'] ."'");
				}
				elseif($confirm=='Reposicion Defuncion'){
					$rows = $data->readDataSQL("SELECT d.*, hv.*, ins.*, ac.folio, ac.partida, ac.fecha, t.numero FROM reposiciondefuncion d INNER JOIN reposicionhechovital hv ON d.idreposiciondefuncion=hv.idreposicionhechovital INNER JOIN inscripcion ins ON hv.idreposicionhechovital= ins.idinscripcion LEFT JOIN acta ac ON ac.idinscripcion= ins.idinscripcion INNER JOIN tomo t ON t.idtomo=ac.idtomo WHERE ac.idinscripcion='" . $data->request['idinscripcion'] ."'");
				}
				$row = $rows[0];
				$pdf->SetY($ini_x + 57);
				$pdf->SetX($ini_x + 95);
				$pdf->Cell(0,0,strtoupper($row['municipioinscripcion']));
				$pdf->SetY(65);
				$pdf->SetX(52);
				$pdf->Cell(0,0,strtoupper($row['departamentoinscripcion']));
				$pdf->SetY(63);
				$pdf->SetX(13);
				$fecha_inscripcion= new DateTime($row['fecha']);
				$fecha_inscripcion_parts= getdate($fecha_inscripcion->getTimestamp());
				$anyo_inscripcion= "	                                                                                                                             ";
				$anyo_inscripcion.= number2str($fecha_inscripcion_parts['year']);
				$pdf->MultiCell(190,7.0,$anyo_inscripcion);
				/*$pdf->SetY(74);
				  $pdf->SetX(13);
				  $pdf->Cell(0,0,'dos mil once');*/
				$pdf->SetY(90);
				$pdf->SetX(30);
				//nombre inscrito
				$pdf->Cell(0,0,strtoupper($row['inscrito1apellido1']));
				$pdf->SetX(64);
				$pdf->Cell(0,0,strtoupper($row['inscrito1apellido1']));
				$pdf->SetX(119);
				$pdf->Cell(0,0,strtoupper($row['inscrito1nombre1']));
				$pdf->SetX(158);
				$pdf->Cell(0,0,strtoupper($row['inscrito1nombre2']));
				//end nombre inscrito
				//#$pdf->Cell(0,0,'Maribel de los angeles fonseca blandon');
				$pdf->SetY(103);
				$pdf->SetX(50);
				$fecha_defuncion= new DateTime($row['fechadefuncion']);
				$fecha_defuncion_parts= getdate($fecha_defuncion->getTimestamp());
				$pdf->Cell(0,0,strtoupper(strftime('%A',$fecha_defuncion->getTimestamp())));
				$pdf->SetX(128);
				$pdf->Cell(0,0,strtoupper(strftime('%B',$fecha_defuncion->getTimestamp())));
				$pdf->SetY(112);
				$pdf->SetX(13);
				$pdf->Cell(0,0,number2str($fecha_defuncion->format('Y')));
				$pdf->SetY(121);
				$pdf->SetX(48);
				$pdf->Cell(0,0,strtoupper($row['municipionacimiento']));
				$pdf->SetX(149);
				$pdf->Cell(0,0,strtoupper($row['departamentonacimiento']));
				$pdf->SetY(139);
				$pdf->SetX(89);
				$pdf->Cell(0,0,strtoupper($row['padrenombre']));
				$pdf->SetY(148);
				$pdf->SetX(89);
				$pdf->Cell(0,0,strtoupper($row['nombremadre']));
				$pdf->SetY(157);
				$pdf->SetX(55);
				$pdf->Cell(0,0,$row['partida']);
				$pdf->SetX(119);
				$pdf->Cell(0,0,$row['numero']);
				$pdf->SetX(181);
				$pdf->Cell(0,0,$row['folio']);
				$pdf->SetY(165);
				$pdf->SetX(95);
				$pdf->Cell(0,0,strtoupper($row['municipioinscripcion']));
				$pdf->SetY(174);
				$pdf->SetX(55);
				$pdf->Cell(0,0,strtoupper($row['departamentoinscripcion']));
				$pdf->SetY(180);
				$pdf->SetX(43);
				$observaciones.= $row['observaciones'];
				$pdf->MultiCell(165.5,8.0,$observaciones);
				$pdf->SetY(237);
				$pdf->SetX(19);
				$pdf->Cell(0,0,'Matagalpa');
				$pdf->SetX(105);
				$fecha_emision= new DateTime();
				$fecha_emision_parts= getdate($fecha_emision->getTimestamp());
				$prt_dia_emision= number2str($fecha_emision_parts['mday']);
				$pdf->Cell(0,0,$prt_dia_emision);
				$pdf->SetX(170);
				$pdf->Cell(0,0,strtoupper(strftime('%B',$fecha_emision->getTimestamp())));
				$pdf->SetY(245);
				$pdf->SetX(120);
				$pdf->Cell(0,0,number2str($fecha_inscripcion->format('y')));
				$pdf->SetY(256);
				$pdf->SetX(20);
				//$pdf->Cell(0,0,'Juan Rios');
				//$pdf->SetX(150);
				//$pdf->Cell(0,0,'Maribel  Fonseca');
			}
			break;
		case 'nacimiento':
			$pdf->AddPage();
			$ini_y=0;
			$ini_x=0;
			//print_r($data);
			$pdf->Image('./imgs/certificado-nacimiento-version2.jpg', 9, 13,198,267);
			//$pdf->Image('./imgs/certificado-defuncion.jpg', 8, 11,201,266);
			if ($data->request['idinscripcion']) {
				$confirm= $data->getVar("SELECT inscripcion.tipoinscripcion FROM inscripcion WHERE inscripcion.idinscripcion= '". $data->request['idinscripcion']."'");
				if($confirm=='Nacimientos'){
					$rows = $data->readDataSQL("SELECT n.*, hv.*, ins.*, ac.idtomo, ac.folio, ac.partida, ac.fecha, t.numero, t.anyo FROM nacimiento n INNER JOIN hechovital hv ON n.idnacimiento=hv.idhechovital INNER JOIN inscripcion ins ON hv.idhechovital= ins.idinscripcion LEFT JOIN acta ac ON ac.idinscripcion= ins.idinscripcion INNER JOIN tomo t on t.idtomo=ac.idtomo WHERE ac.idinscripcion='" . $data->request['idinscripcion'] ."'");
				}
				elseif($confirm=='Reposicion Nacimiento'){
					$rows = $data->readDataSQL("SELECT n.*, hv.*, ins.*, ac.idtomo, ac.folio, ac.partida, ac.fecha, t.numero, t.anyo FROM reposicionnacimiento n INNER JOIN reposicionhechovital hv ON n.idreposicionnacimiento=hv.idreposicionhechovital INNER JOIN inscripcion ins ON hv.idreposicionhechovital= ins.idinscripcion LEFT JOIN acta ac ON ac.idinscripcion= ins.idinscripcion INNER JOIN tomo t on t.idtomo=ac.idtomo WHERE ac.idinscripcion='" . $data->request['idinscripcion'] ."'");
				}
				$row = $rows[0];
				$pdf->SetY($ini_y + 57);
				$pdf->SetX($ini_x + 45);
				$pdf->Cell(0,0,strtoupper($row['tipoinscripcion']));
				$pdf->SetY($ini_y + 64);
				$pdf->SetX($ini_x + 12);
				$pdf->Cell(0,0,strtoupper('Matagalpa'));
				$pdf->SetY($ini_y + 64);
				$pdf->SetX($ini_x + 130);
				$pdf->Cell(0,0,strtoupper($row['departamentoinscripcion']));
				$pdf->SetY($ini_y + 71);
				$pdf->SetX($ini_x + 16);
				$anyo_inscripcion= number2str($row['anyo']);
				//$anyo_inscripcion= number2str(1975);
				$pdf->Cell(0,0,strtoupper($anyo_inscripcion));
				//nombre inscrito
				$pdf->SetY($ini_y + 92);
				$pdf->SetX($ini_x + 30);
				$pdf->Cell(0,0,strtoupper($row['inscrito1nombre1']));
				$pdf->SetX($ini_x + 64);
				$pdf->Cell(0,0,strtoupper($row['inscrito1nombre2']));
				$pdf->SetX($ini_x + 119);
				$pdf->Cell(0,0,strtoupper($row['inscrito1apellido1']));
				$pdf->SetX($ini_x + 158);
				$pdf->Cell(0,0,strtoupper($row['inscrito1apellido1']));
				//fecha nacimiento
				$pdf->SetY($ini_y + 115);
				$pdf->SetX($ini_x + 27);
				$fecha_nacimiento= new DateTime($row['fechanacimiento']);
				$fecha_nacimiento_parts= getdate($fecha_nacimiento->getTimestamp());
				$prt_hora_nacimiento=number2str($fecha_nacimiento->format('g'));
				$prt_hora_nacimiento.=" CON ". number2str($fecha_nacimiento_parts['minutes']);
				$pdf->Cell(0,0,strtolower($prt_hora_nacimiento));
				$pdf->SetY($ini_y + 115);
				$pdf->SetX($ini_x + 150);
				$pdf->Cell(0,0,utf8_decode(($fecha_nacimiento_parts['hours']>12)?'TARDE':'MAÑANA'));
				$pdf->SetY($ini_y + 122);
				$pdf->SetX($ini_x + 20);
				$prt_dia_nacimiento = strtoupper(strftime('%A',$fecha_nacimiento->getTimestamp()));
				$prt_dia_nacimiento .=" ". number2str($fecha_nacimiento_parts['mday']);
				$pdf->Cell(0,0,$prt_dia_nacimiento);
				$pdf->SetX($ini_x + 120);
				$pdf->Cell(0,0,strtoupper(strftime('%B',$fecha_nacimiento->getTimestamp())));
				$pdf->SetX($ini_x + 10);
				$pdf->SetY($ini_y + 118);
				$anyo_inscripcion= "               	                                                                                                                   ";
				$anyo_inscripcion.= number2str($fecha_nacimiento->format('Y'));
				//$anyo_inscripcion.= number2str(7348);
				$pdf->MultiCell(195,7,$anyo_inscripcion);
				//sexo del inscrito
				$pdf->SetY($ini_y + 129);
				$pdf->SetX($ini_x + 101);
				$sexo= $row['sexoinscrito'];
				$pdf->Cell(0,0,($sexo=="f")?"X":"");
				//$pdf->Cell(0,0,"X");
				$pdf->SetX($ini_x + 119);
				$pdf->Cell(0,0,($sexo=="m")?"X":"");
				//$pdf->Cell(0,0,"X");
				$pdf->SetY($ini_y + 136);
				$pdf->SetX($ini_x + 35);
				$pdf->Cell(0,0,strtoupper($row['municipionacimiento']));
				$pdf->SetX($ini_x + 133);
				$pdf->Cell(0,0,strtoupper($row['departamentonacimiento']));
				//datos de padres
				$pdf->SetY($ini_y + 143);
				$pdf->SetX($ini_x + 71);
				$pdf->Cell(0,0,strtoupper($row['padrenombre']));
				$pdf->SetY($ini_y + 150);
				$pdf->SetX($ini_x + 100);
				$pdf->Cell(0,0,strtoupper($row['cedulapadre']));
				$pdf->SetY($ini_y + 157);
				$pdf->SetX($ini_x + 71);
				$pdf->Cell(0,0,strtoupper($row['nombremadre']));
				$pdf->SetY($ini_y + 164);
				$pdf->SetX($ini_x + 100);
				$pdf->Cell(0,0,strtoupper($row['cedulamadre']));
				//fecha de inscripcion
				$pdf->Sety($ini_y + 171);
				$pdf->SetX($ini_x + 35);
				$fecha_inscripcion= new DateTime($row['fecha']);
				$fecha_inscripcion_parts= getdate($fecha_inscripcion->getTimestamp());
				$prt_fecha_inscripcion=number2str($fecha_inscripcion->format('g'));
				$prt_fecha_inscripcion.=" CON ". number2str($fecha_inscripcion_parts['minutes']);
				$pdf->Cell(0,0,strtolower($prt_fecha_inscripcion));
				$pdf->SetX($ini_x + 150);
				$pdf->Cell(0,0,utf8_decode(($fecha_inscripcion_parts['hours']>12)?'TARDE':'MAÑANA'));
				$pdf->SetY($ini_y + 179);
				$pdf->SetX($ini_x + 15);
				$prt_dia_inscripcion= number2str($fecha_inscripcion_parts['mday']);
				$pdf->Cell(0,0,$prt_dia_inscripcion);
				$pdf->SetX($ini_x + 100);
				$pdf->Cell(0,0,strtoupper(strftime('%B',$fecha_inscripcion->getTimestamp())));
				$pdf->SetX($ini_x + 10);
				$pdf->SetY($ini_x + 176);
				$anyo_inscripcion= "               	                                                                                                                            ";
				$anyo_inscripcion.=number2str($fecha_inscripcion->format('Y'));
				//$anyo_inscripcion.= number2str(7348);
				$pdf->MultiCell(195,7,$anyo_inscripcion);
				$pdf->SetY($ini_y + 186);
				$pdf->SetX($ini_x + 120);
				$pdf->Cell(0,0,$row['tipoinscripcion']);
				//datos registrales
				$pdf->SetY($ini_y + 193);
				$pdf->SetX($ini_x + 40);
				$pdf->Cell(0,0,$row['partida']);
				$pdf->SetX($ini_x + 90);
				$pdf->Cell(0,0,$row['folio']);
				$pdf->SetX($ini_x + 168);
				$pdf->Cell(0,0,$row['numero']);
				$pdf->SetY($ini_y + 197);
				$pdf->SetX($ini_x + 10);
				$observaciones=  "                         ";
				$observaciones.= $row['observaciones'];
				$pdf->MultiCell(195,6.8,$observaciones);
				//fecha de emision
				$pdf->SetY($ini_y + 243);
				$pdf->SetX($ini_x + 148);
				$fecha_emision= new DateTime();
				$fecha_emision_parts= getdate($fecha_emision->getTimestamp());
				$prt_dia_emision= number2str($fecha_emision_parts['mday']);
				$pdf->Cell(0,0,$prt_dia_emision);
				$pdf->SetY($ini_y + 250);
				$pdf->SetX($ini_x + 30);
				$pdf->Cell(0,0,strtoupper(strftime('%B',$fecha_emision->getTimestamp())));
				$pdf->SetX($ini_x + 124);
				$pdf->Cell(0,0,number2str($fecha_inscripcion->format('y')));

			}
			break;
		case 'divorcio':
			$pdf->AddPage();
			$ini_y=0;
			$ini_x=0;
			$pdf->Image('./imgs/certificado-disolucion-matrimonio.png', 9, 13,198,307);
			if ($data->request['idinscripcion']) {
				$rows = $data->readDataSQL("SELECT d.*, aj.*, ins.*, ac.idtomo, ac.folio, ac.partida, ac.fecha, t.numero, t.anyo FROM disolucionmatrimonio d INNER JOIN actojuridico aj ON d.iddisolucionmatrimonio=aj.idactojuridico INNER JOIN inscripcion ins ON aj.idactojuridico= ins.idinscripcion LEFT JOIN acta ac ON ac.idinscripcion= ins.idinscripcion INNER JOIN tomo t ON t.idtomo=ac.idtomo WHERE ac.idinscripcion='". $data->request['idinscripcion'] ."'");
				$row = $rows[0];
				$pdf->SetY($ini_y + 63);
				$pdf->SetX($ini_x + 155);
				$pdf->Cell(0,0,strtoupper($row['municipioinscripcion']));
				$pdf->SetY($ini_y + 71);
				$pdf->SetX($ini_x + 85);
				$pdf->Cell(0,0,strtoupper($row['departamentoinscripcion']));
				$pdf->SetY($ini_y + 74);
				$pdf->SetX($ini_x + 10);
				//$pdf->SetX(155);
				$anyo_inscripcion= "  	                                                                                                                   ";
				//$anyo_inscripcion.= number2str(1943);
				//$anyo_inscripcion.= number2str(2011);
				$anyo_inscripcion.= number2str($row['anyo']);
				$pdf->MultiCell(195,7.5,strtoupper($anyo_inscripcion));
				$pdf->SetY($ini_y + 93);
				$pdf->SetX(30);
				$pdf->Cell(0,0,$row['partidamatrimonio']);
				$pdf->SetX($ini_x + 95);
				$pdf->Cell(0,0,$row['foliomatrimonio']);
				$pdf->SetX($ini_x + 153);
				$pdf->Cell(0,0,$row['tomomatrimonio']);
				$pdf->SetY($ini_y + 100);
				$pdf->SetX($ini_x + 20);
				$pdf->Cell(0,0,strtoupper($row['municipioinscripcion']));
				$pdf->SetX($ini_x + 135);
				$pdf->Cell(0,0,strtoupper($row['departamentoinscripcion']));
				$pdf->SetY($ini_y + 107);
				$pdf->SetX($ini_x + 27);
				$fecha_inscripcion= new DateTime($row['fecha']);
				$fecha_inscripcion_parts= getdate($fecha_inscripcion->getTimestamp());
				$pdf->Cell(0,0,strtoupper(strftime('%A',$fecha_inscripcion->getTimestamp())));
				$pdf->SetX($ini_x + 85);
				$pdf->Cell(0,0,strtoupper(strftime('%B',$fecha_inscripcion->getTimestamp())));
				$pdf->SetX($ini_x + 145);
				$pdf->Cell(0,0,number2str($fecha_inscripcion->format('y')));
				$pdf->SetY($ini_y + 122);
				$pdf->SetX($ini_x + 20);
				$pdf->Cell(0,0,$row['compareciente1nombre']);
				$pdf->SetY($ini_y + 129);
				$pdf->SetX($ini_x + 25);
				$pdf->Cell(0,0,number2str($row['compareciente1edad']));
				$pdf->SetX($ini_x + 94);
				$pdf->Cell(0,0,strtoupper($row['compareciente1oficio']));
				$pdf->SetY($ini_y + 136);
				$pdf->SetX($ini_x + 25);
				$pdf->Cell(0,0,strtoupper($row['compareciente1estadocivil']));
				$pdf->SetX($ini_x + 82);
				$pdf->Cell(0,0,strtoupper($row['compareciente1domicilio']));
				$pdf->SetY($ini_y + 144);
				$pdf->SetX($ini_x + 40);
				$pdf->Cell(0,0,strtoupper('Disolucion del vinculo matrimonial'));
				$pdf->SetY($ini_y + 151);
				$pdf->SetX($ini_x + 40);
				$pdf->Cell(0,0,strtoupper($row['jueznotario']));
				$pdf->SetY($ini_y + 158);
				$pdf->SetX($ini_x + 65);
				$pdf->Cell(0,0,strtoupper($row['nombrejuzgado']));
				$pdf->SetY($ini_y + 165);
				$pdf->SetX($ini_x + 35);
				$fecha_dictamen= new DateTime($row['fechadictament']);
				$fecha_dictamen_parts= getdate($fecha_dictamen->getTimestamp());
				$prt_hora_dictamen=number2str($fecha_dictamen->format('g'));
				//$prt_hora_dictamen.=" CON ". number2str($fecha_dictamen_parts['minutes'])." MINUTOS";
				$pdf->Cell(0,0,$prt_hora_dictamen);
				$pdf->SetX($ini_y + 95);
				$pdf->Cell(0,0,utf8_decode(($fecha_dictamen_parts['hours']>12)?'TARDE':'MAÑANA'));
				$pdf->SetX($ini_x + 150);
				$pdf->Cell(0,0,strtoupper(strftime('%A',$fecha_dictamen->getTimestamp())));
				$pdf->SetY($ini_y + 173);
				$pdf->SetX($ini_x + 38);
				$pdf->Cell(0,0,strtoupper(strftime('%B',$fecha_dictamen->getTimestamp())));
				$pdf->SetX($ini_x + 100);
				$pdf->Cell(0,0,number2str($fecha_dictamen->format('Y')));
				$pdf->SetY($ini_y + 179);
				$pdf->SetX($ini_x + 90);
				$pdf->Cell(0,0,$row['conyuge1nombre']);
				$pdf->SetY($ini_y + 187);
				$pdf->SetX($ini_x + 25);
				$pdf->Cell(0,0,$row['conyuge2nombre']);
				$pdf->SetY($ini_y + 191);
				$pdf->SetX($ini_x + 12);
				$hijos = '                       ';
				$guarda= new guardaTable();
				$guardados= $guarda->readDataFilter("guarda.idinscripcion=".$row['idinscripcion']);
				if(sizeof($guardados)>0){
					foreach($guardados as $hijo){
						$hijos_procreados[]=$hijo['nombrereconocido'];
					}
					$hijos .=implode(", ",$hijos_procreados) ;
				}

				$pdf->MultiCell(183.5,6.7,$hijos);
				$pdf->SetY($ini_y + 216);
				$pdf->SetX($ini_x + 93);
				$pdf->Cell(0,0,strtoupper($row['custodionombre']));
				$pdf->SetY($ini_y + 223);
				$pdf->SetX($ini_x + 110);
				$pdf->Cell(0,0,$row['pensionalimenticia']);
				$pdf->SetY($ini_y + 231);
				$pdf->SetX($ini_x + 35);
				$pdf->Cell(0,0,strtoupper(utf8_decode(mb_strtoupper(number2str($row['pensionalimenticia'],'UTF-8')))));
				$pdf->SetY($ini_y + 238);
				$pdf->SetX($ini_x + 45);
				$pdf->Cell(0,0,'que dato del acta va aca?');
				$pdf->SetY($ini_y + 242);
				$pdf->SetX($ini_x + 13);
				$observaciones = '                 ';
				$observaciones .= strtoupper($row['observaciones']);
				$pdf->MultiCell(183.5,6.7,$observaciones);
				$pdf->SetY($ini_y + 267);
				$pdf->SetX($ini_x + 167);
				$pdf->Cell(0,0,'Matagalpa');
				$pdf->SetY($ini_y + 275);
				$pdf->SetX($ini_x + 25);
				$fecha_emision= new DateTime();
				$fecha_emision_parts= getdate($fecha_emision->getTimestamp());
				$prt_dia_emision= number2str($fecha_emision_parts['mday']);
				$pdf->Cell(0,0,$prt_dia_emision." DIAS");
				$pdf->SetX($ini_x + 95);
				$pdf->Cell(0,0,strtoupper(strftime('%B',$fecha_emision->getTimestamp())));
				$pdf->SetY($ini_y + 282);
				$pdf->SetX($ini_x + 35);
				$pdf->Cell(0,0,number2str($fecha_inscripcion->format('y')));
				//$pdf->SetY(309);
				//$pdf->SetX(25);
				//$pdf->Cell(0,0,'Juan Carlos');
				//$pdf->SetX(150);
				//$pdf->Cell(0,0,'Maribel Fonseca');
				//print_r("imprimiendo nacimiento");
			}
			break;
		default:
			//print_r("no especificada");
			break;
	}
}
?>
