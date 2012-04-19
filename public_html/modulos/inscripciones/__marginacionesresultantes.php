<?php 

/* configuracion de tipos de inscripciones que se afectan unas a otras  */
/*
   1 | Nacimientos
   3 | Defunciones
   2 | Matrimonios
   4 | Reposicion Nacimiento
   5 | Reposicion Defuncion
   8 | Reposicion Matrimonio
   7 | Inscripciones Varias
   6 | Disolucion Vinculo Matrimonial
 */
/*
   $marginaciones= array(
   "Defunciones"=>array("Nacimientos","Reposicion Nacimiento","Matrimonios","Reposicion Matrimonio"),
   "Matrimonios"=>array("Nacimientos","Reposicion Nacimiento"),
   "Reposicion Defuncion"=>array("Nacimientos","Reposicion Nacimiento","Matrimonios","Reposicion Matrimonio"),
   "Reposicion Matrimonio"=>array("Nacimientos","Reposicion Nacimiento"),
   "Disolucion Vinculo Matrimonial"=>array("Nacimientos","Reposicion Nacimiento","Matrimonios","Reposicion Matrimonio"),
   "Inscripciones Varias"=>array(
   "reconocimiento"=>array("Nacimientos","Reposicion Nacimiento"),
   "declaracion mayoria edad"=>array("Nacimientos","Reposicion Nacimiento"),
   "anulacion de asientos registrales"=>array("Inscripcion"),
   "rectificacion de partida nacimiento"=>array("Nacimientos","Reposicion Nacimiento"),
   "guarda"=>array("Nacimientos","Reposicion Nacimiento"),
   "emancipacion"=>array("Nacimientos","Reposicion Nacimiento"),
   "declararacion ausencia"=>array("Nacimientos","Reposicion Nacimiento"),
   "interdiccion"=>array("Nacimientos","Reposicion Nacimiento"),
   "posesion notoria estado"=>array("Nacimientos","Reposicion Nacimiento"),
   "identificacion notarial"=>array("Nacimientos","Reposicion Nacimiento")
   )
   );
 */
/* verificacion de la existencia de los registros a afectar */
$inscripcion= new inscripcion();
$acta= new acta();
//lugar por defecto del registro
$lugar_registro="Matagalpa";

$inscripcionesafectadas= array();

$rubro= $libroregistralbd->getNomRubro();
//TODO: en lugar de llamar al nacimeinto poner directamante el id del acta en caso de que sea un a resposicion de nacimiento.

switch($rubro){
		case 'Disolucion Vinculo Matrimonial':
				/* obtener datos de las inscripciones de nacimiento o reposicion de nacimento de los conyuges*/		
				$datosinscripcion= array();

				/*obtener datos de inscripcion de matrimonio*/
				$inscripcion_matrimonio= new inscripcion();
				$idlastinscripcion=$InscripcionLast;
				$disolucion = $disolucionmatrimonio->getDisolucionmatrimonio($idlastinscripcion);
				$idmatrimonio = $disolucion->getIdMatrimonio();
				if(!empty($idmatrimonio)){
						$inscripcionesafectadas[]= array("idinscripcion"=>$idmatrimonio,"tipoinscripcion"=>"Matrimonios","url"=>"/modulos/inscripciones/editmatrimonio?id=".$idmatrimonio);
						//agregando la disolucion correspondiente
						$disolucionrel= new disolucionTable();
						$disolucionrel->request['iddisolucionmatrimonio']= $idlastinscripcion;
						$disolucionrel->request['idinscripcion']= $idmatrimonio;
						$disolucionrel->addRecord();
						//agregar aca datos de la marginacion 
						$notamarginal_disolucion= new notamarginal();
						$notamarginal_disolucion->request['idinscripcion']= $idmatrimonio;
						$notamarginal_disolucion->request['actomodificador']= $rubro;
						$notamarginal_disolucion->request['lugarinscripcion']= $lugar_registro;
						$notamarginal_disolucion->request['libroinscripcion']= $rubro;
						$notamarginal_disolucion->request['tomoinscripcion']= $_REQUEST['idtomo'];
						$notamarginal_disolucion->request['folioinscripcion']= $_REQUEST['folio'];
						$notamarginal_disolucion->request['partidainscripcion']= $_REQUEST['partida'];
						//requiere del anyo en ke se llevo el registro causa esto un error a registrar la nota marginal
						$tomo= new tomo();
						$tomoinscripcion= $tomo->getTomo($_REQUEST['idtomo']);
						$notamarginal_disolucion->request['anyoinscripcion']= $tomoinscripcion->request['anyo'];

						$notamarginal_disolucion->request['modificacion']= "Disolucion del Vinculo Matrimonial";
						$notamarginal_disolucion->request['cuerpo']= "Divorcio";
						$notamarginal_disolucion->request['inscripcionmodificadora']=  $disolucion->request['iddisolucionmatrimonio'];
						$asientonota = new asientoregistral();
						$_REQUEST['fecha'] = date('Y-m-d');
						$asientonota->readEnv();
						$asientonota->addRecord();
						$notamarginal_disolucion->request['idnotamarginal'] = $asientonota->getlastId();
						$notamarginal_disolucion->addrecord();

				}

				//insertar las notas marginales correspondientes a cada inscripcion
				if(strnatcasecmp($disolucion->request['conyuge1lugarinscripcion'],$lugar_registro)){
						$datosinscripcion['tomo']= $disolucion->request['conyuge1tomoinscripcion'];
						$datosinscripcion['folio']= $disolucion->request['conyuge1folioinscripcion'];
						$datosinscripcion['partida']= $disolucion->request['conyuge1partidainscripcion'];
						//print_r($disolucion->request); print_r($datosinscripcion);
						// agregar el tomo a la consulta para conocer el numero de tomo porke solo se conoce en el acta el id del tomo.
						$lista_actas= $acta->readDataSQL("SELECT a.* FROM acta a inner join nacimiento i ON a.idinscripcion=i.idnacimiento inner join tomo t on t.idtomo=a.idtomo WHERE t.numero=".$datosinscripcion['tomo']." and a.folio=".$datosinscripcion['folio']." and a.partida=".$datosinscripcion['partida']."");


						if(sizeof($lista_actas)>0){
								//$inscripcion_nacimiento_conyuge1= new inscripcion();
								$inscripcionesafectadas[]= array("idinscripcion"=>$lista_actas[0]['idinscripcion'],"tipoinscripcion"=>"Nacimientos","url"=>"/modulos/inscripciones/editnacimiento?id=".$lista_actas[0]['idinscripcion']);

								$nacimientos = new nacimiento();
								$nacimiento= $nacimientos->getNacimiento($lista_actas[0]['idinscripcion']);
								$nacimiento->request['lugarinscripciondefuncion'] = $lugar_registro;
								$nacimiento->request['folioinscripciondefuncion'] = $_REQUEST['folio'];
								$nacimiento->request['tomoinscripciondefuncion'] = $_REQUEST['idtomo']; 
								$nacimiento->request['partidainscripciondefuncion'] = $_REQUEST['partida'];
								$arrayaux = explode('-',$_REQUEST['fechadefuncion']);
								$nacimiento->request['anyoinscripciondefuncion'] = $arrayaux[0]; 
								$nacimiento->updateRecord();
								//agregar aca datos de la marginacion 
								$notamarginal_defuncion= new notamarginal();
								$notamarginal_defuncion->request['idinscripcion']= $nacimiento->request['idnacimiento'];
								$notamarginal_defuncion->request['actomodificador']= "Disolucion del vinculo matrimonial";
								$notamarginal_defuncion->request['lugarinscripcion']= $lugar_registro;
								$notamarginal_defuncion->request['libroinscripcion']= $rubro;
								$notamarginal_defuncion->request['tomoinscripcion']= $_REQUEST['idtomo'];
								$notamarginal_defuncion->request['folioinscripcion']= $_REQUEST['folio'];
								$notamarginal_defuncion->request['partidainscripcion']= $_REQUEST['partida'];
								//requiere del anyo en ke se llevo el registro causa esto un error a registrar la nota marginal
								$tomo= new tomo();
								$tomoinscripcion= $tomo->getTomo($_REQUEST['idtomo']);
								$notamarginal_defuncion->request['anyoinscripcion']= $tomoinscripcion->request['anyo'];

								$notamarginal_defuncion->request['modificacion']= "Defuncion";
								$notamarginal_defuncion->request['cuerpo']= "Defuncion";
								$notamarginal_defuncion->request['inscripcionmodificadora']= $defuncion->request['iddefuncion'];
								$asientonota = new asientoregistral();
								$_REQUEST['fecha'] = date('Y-m-d');
								$asientonota->readEnv();
								$asientonota->addRecord();
								$notamarginal_defuncion->request['idnotamarginal'] = $asientonota->getlastId();
								$notamarginal_defuncion->addrecord();
						}
				}
				unset($lista_actas);

				if(strnatcasecmp($disolucion->request['conyuge2lugarinscripcion'],$lugar_registro)){
						$datosinscripcion['tomo']= $disolucion->request['conyuge2tomoinscripcion'];
						$datosinscripcion['folio']= $disolucion->request['conyuge2folioinscripcion'];
						$datosinscripcion['partida']= $disolucion->request['conyuge2partidainscripcion'];
						$lista_actas= $acta->readDataSQL("SELECT a.* FROM acta a inner join nacimiento i ON a.idinscripcion=i.idnacimiento inner join tomo t on t.idtomo=a.idtomo WHERE t.numero=".$datosinscripcion['tomo']." and a.folio=".$datosinscripcion['folio']." and a.partida=".$datosinscripcion['partida']."");


						if(sizeof($lista_actas)>0){
								//$inscripcion_nacimiento_conyuge1= new inscripcion();
								$inscripcionesafectadas[]= array("idinscripcion"=>$lista_actas[0]['idinscripcion'],"tipoinscripcion"=>"Nacimientos","url"=>"/modulos/inscripciones/editnacimiento?id=".$lista_actas[0]['idinscripcion']);

								$nacimientos = new nacimiento();
								$nacimiento= $nacimientos->getNacimiento($lista_actas[0]['idinscripcion']);
								$nacimiento->request['lugarinscripciondefuncion'] = $lugar_registro;
								$nacimiento->request['folioinscripciondefuncion'] = $_REQUEST['folio'];
								$nacimiento->request['tomoinscripciondefuncion'] = $_REQUEST['idtomo']; 
								$nacimiento->request['partidainscripciondefuncion'] = $_REQUEST['partida'];
								$arrayaux = explode('-',$_REQUEST['fechadefuncion']);
								$nacimiento->request['anyoinscripciondefuncion'] = $arrayaux[0]; 
								$nacimiento->updateRecord();
								//agregar aca datos de la marginacion 
								$notamarginal_defuncion= new notamarginal();
								$notamarginal_defuncion->request['idinscripcion']= $nacimiento->request['idnacimiento'];
								$notamarginal_defuncion->request['actomodificador']= "Disolucion del vinculo matrimonial";
								$notamarginal_defuncion->request['lugarinscripcion']= $lugar_registro;
								$notamarginal_defuncion->request['libroinscripcion']= $rubro;
								$notamarginal_defuncion->request['tomoinscripcion']= $_REQUEST['idtomo'];
								$notamarginal_defuncion->request['folioinscripcion']= $_REQUEST['folio'];
								$notamarginal_defuncion->request['partidainscripcion']= $_REQUEST['partida'];
								//requiere del anyo en ke se llevo el registro causa esto un error a registrar la nota marginal
								$tomo= new tomo();
								$tomoinscripcion= $tomo->getTomo($_REQUEST['idtomo']);
								$notamarginal_defuncion->request['anyoinscripcion']= $tomoinscripcion->request['anyo'];

								$notamarginal_defuncion->request['modificacion']= "Defuncion";
								$notamarginal_defuncion->request['cuerpo']= "Defuncion";
								$notamarginal_defuncion->request['inscripcionmodificadora']= $defuncion->request['iddefuncion'];
								$asientonota = new asientoregistral();
								$_REQUEST['fecha'] = date('Y-m-d');
								$asientonota->readEnv();
								$asientonota->addRecord();
								$notamarginal_defuncion->request['idnotamarginal'] = $asientonota->getlastId();
								$notamarginal_defuncion->addrecord();
						}
				}

				/* obtener datos de inscripcion de hijos a reconocer o por otogar la garda */
				$lista_inscripcion_guarda= new inscripcion();

				/*Obteniendo datos del matrimonio relacionado*/

				break;
		case 'Reposicion Matrimonios':
				//establecer nombre de clase y metodo a invocar se procede igual en en el caso de las defunciones.
				$classname="reposicionmatrimonio";
				$getmethodname="getReposicionmatrimonio";
		case 'Matrimonios':
				//TODO: completar, remplazar disolucion por matrimonio
				/* obtener datos de las inscripciones de nacimiento o reposicion de nacimento de los conyuges*/		
				$classname=(!isset($classname))?"matrimonio":$classname;
				$getmethodname=(!isset($methodname))?"getMatrimonio":$methodname;
				$matrimonios= new $classname();
				$idlastinscripcion=$InscripcionLast;

				$matrimonio= $matrimonios->$getmethodname($idlastinscripcion);

				$datosinscripcion= array();

				/*obtener datos de inscripcion de matrimonio*/
				/*$inscripcion_matrimonio= new inscripcion();
				$idlastinscripcion=$InscripcionLast;*/
				//insertar las notas marginales correspondientes a cada inscripcion
				if(strnatcasecmp($matrimonio->request['conyuge1lugarinscripcion'],$lugar_registro)){
						$datosinscripcion['tomo']= $matrimonio->request['conyuge1tomoinscripcion'];
						$datosinscripcion['folio']= $matrimonio->request['conyuge1folioinscripcion'];
						$datosinscripcion['partida']= $matrimonio->request['conyuge1partidainscripcion'];
						//print_r($disolucion->request); print_r($datosinscripcion);
						// agregar el tomo a la consulta para conocer el numero de tomo porke solo se conoce en el acta el id del tomo.
						$lista_actas= $acta->readDataSQL("SELECT a.* FROM acta a inner join nacimiento i ON a.idinscripcion=i.idnacimiento inner join tomo t on t.idtomo=a.idtomo WHERE t.numero=".$datosinscripcion['tomo']." and a.folio=".$datosinscripcion['folio']." and a.partida=".$datosinscripcion['partida']."");


						if(sizeof($lista_actas)>0){
								//$inscripcion_nacimiento_conyuge1= new inscripcion();
								$inscripcionesafectadas[]= array("idinscripcion"=>$lista_actas[0]['idinscripcion'],"tipoinscripcion"=>"Nacimientos","url"=>"/modulos/inscripciones/editnacimiento?id=".$lista_actas[0]['idinscripcion']);

								$nacimientos = new nacimiento();
								$nacimiento= $nacimientos->getNacimiento($lista_actas[0]['idinscripcion']);
								//agregar aca datos de la marginacion 
								$notamarginal= new notamarginal();
								$notamarginal->request['idinscripcion']= $nacimiento->request['idnacimiento'];
								$notamarginal->request['actomodificador']= "Union Matrimonial";
								$notamarginal->request['lugarinscripcion']= $lugar_registro;
								$notamarginal->request['libroinscripcion']= $rubro;
								$notamarginal->request['tomoinscripcion']= $_REQUEST['idtomo'];
								$notamarginal->request['folioinscripcion']= $_REQUEST['folio'];
								$notamarginal->request['partidainscripcion']= $_REQUEST['partida'];
								//requiere del anyo en ke se llevo el registro causa esto un error a registrar la nota marginal
								$tomo= new tomo();
								$tomoinscripcion= $tomo->getTomo($_REQUEST['idtomo']);
								$notamarginal->request['anyoinscripcion']= $tomoinscripcion->request['anyo'];

								$notamarginal->request['modificacion']= "Matricicio";
								$notamarginal->request['cuerpo']= "Se Matricidiaron";
								$notamarginal->request['inscripcionmodificadora']= $idlastinscripcion;
								$asientonota = new asientoregistral();
								$_REQUEST['fecha'] = date('Y-m-d');
								$asientonota->readEnv();
								$asientonota->addRecord();
								$notamarginal->request['idnotamarginal'] = $asientonota->getlastId();
								$notamarginal->addrecord();
						}
				}
				unset($lista_actas);

				if(strnatcasecmp($disolucion->request['conyuge2lugarinscripcion'],$lugar_registro)){
						$datosinscripcion['tomo']= $matrimonio->request['conyuge2tomoinscripcion'];
						$datosinscripcion['folio']= $matrimonio->request['conyuge2folioinscripcion'];
						$datosinscripcion['partida']= $matrimonio->request['conyuge2partidainscripcion'];
						$lista_actas= $acta->readDataSQL("SELECT a.* FROM acta a inner join nacimiento i ON a.idinscripcion=i.idnacimiento inner join tomo t on t.idtomo=a.idtomo WHERE t.numero=".$datosinscripcion['tomo']." and a.folio=".$datosinscripcion['folio']." and a.partida=".$datosinscripcion['partida']."");


						if(sizeof($lista_actas)>0){
								//$inscripcion_nacimiento_conyuge1= new inscripcion();
								$inscripcionesafectadas[]= array("idinscripcion"=>$lista_actas[0]['idinscripcion'],"tipoinscripcion"=>"Nacimientos","url"=>"/modulos/inscripciones/editnacimiento?id=".$lista_actas[0]['idinscripcion']);

								$nacimientos = new nacimiento();
								$nacimiento= $nacimientos->getNacimiento($lista_actas[0]['idinscripcion']);
								//agregar aca datos de la marginacion 
								$notamarginal= new notamarginal();
								$notamarginal->request['idinscripcion']= $nacimiento->request['idnacimiento'];
								$notamarginal->request['actomodificador']= "Union Matrimonial";
								$notamarginal->request['lugarinscripcion']= $lugar_registro;
								$notamarginal->request['libroinscripcion']= $rubro;
								$notamarginal->request['tomoinscripcion']= $_REQUEST['idtomo'];
								$notamarginal->request['folioinscripcion']= $_REQUEST['folio'];
								$notamarginal->request['partidainscripcion']= $_REQUEST['partida'];
								//requiere del anyo en ke se llevo el registro causa esto un error a registrar la nota marginal
								$tomo= new tomo();
								$tomoinscripcion= $tomo->getTomo($_REQUEST['idtomo']);
								$notamarginal->request['anyoinscripcion']= $tomoinscripcion->request['anyo'];

								$notamarginal->request['modificacion']= "Matricicio";
								$notamarginal->request['cuerpo']= "Se Matricidiaron";
								$notamarginal->request['inscripcionmodificadora']= $idlastinscripcion;
								$asientonota = new asientoregistral();
								$_REQUEST['fecha'] = date('Y-m-d');
								$asientonota->readEnv();
								$asientonota->addRecord();
								$notamarginal->request['idnotamarginal'] = $asientonota->getlastId();
								$notamarginal->addrecord();
						}
				}
				break;
		case 'Reposicion Defuncion':
				$classname="reposiciondefuncion";
				$getmethodname="getReposiciondefuncion";
		case 'Defunciones':
				/* obtener inscripcion de nacimiento del inscrito */
				$classname=(!isset($classname))?"inscripcionvaria":$classname;
				$getmethodname=(!isset($methodname))?"getReposiciondefuncion":$methodname;
				$defunciones= new $classname();
				$idlastinscripcion=$InscripcionLast;

				$defuncion= $defunciones->$getmethodname($idlastinscripcion);
				if(strnatcasecmp($defuncion->request['lugarinscripcionnacimiento'],$lugar_registro)){
						//corregir, por alguna razon no esta reconociendo el lugar de registro
						$datosinscripcion['tomo']= $defuncion->request['tomoinscripcionnacimiento'];
						$datosinscripcion['folio']= $defuncion->request['folioinscripcionnacimiento'];
						$datosinscripcion['partida']= $defuncion->request['partidainscripcionnacimiento'];
						// agregar el tomo a la consulta para conocer el numero de tomo porke solo se conoce en el acta el id del tomo.
						$lista_actas= $acta->readDataSQL("SELECT a.* FROM acta a inner join nacimiento i ON a.idinscripcion=i.idnacimiento inner join tomo t on t.idtomo=a.idtomo WHERE t.numero=".$datosinscripcion['tomo']." and a.folio=".$datosinscripcion['folio']." and a.partida=".$datosinscripcion['partida']."");

						if(sizeof($lista_actas)>0){
								//$inscripcion_nacimiento_conyuge1= new inscripcion();
								$inscripcionesafectadas[]= array("idinscripcion"=>$lista_actas[0]['idinscripcion'],"tipoinscripcion"=>"Nacimientos","url"=>"/modulos/inscripciones/editnacimiento?id=".$lista_actas[0]['idinscripcion']);
								//TODO: cargar un nacimiento o reposicion de nacimiento segun corresponda (getinscripcion y obtener el rubro)
								$nacimientos = new nacimiento();
								$nacimiento= $nacimientos->getNacimiento($lista_actas[0]['idinscripcion']);
								//agregar aca datos de la marginacion 
								$notamarginal= new notamarginal();
								$notamarginal->request['idinscripcion']= $nacimiento->request['idnacimiento'];
								$notamarginal->request['actomodificador']= $_REQUEST['tipootrainscripcion'];
								$notamarginal->request['lugarinscripcion']= $lugar_registro;
								$notamarginal->request['libroinscripcion']= $rubro;
								$notamarginal->request['tomoinscripcion']= $_REQUEST['idtomo'];
								$notamarginal->request['folioinscripcion']= $_REQUEST['folio'];
								$notamarginal->request['partidainscripcion']= $_REQUEST['partida'];
								//requiere del anyo en ke se llevo el registro causa esto un error a registrar la nota marginal
								$tomo= new tomo();
								$tomoinscripcion= $tomo->getTomo($_REQUEST['idtomo']);
								$notamarginal->request['anyoinscripcion']= $tomoinscripcion->request['anyo'];

								$notamarginal->request['modificacion']= "Defuncion";
								$notamarginal->request['cuerpo']= "Defuncion";
								$notamarginal->request['inscripcionmodificadora']= $idlastinscripcion;
								$asientonota = new asientoregistral();
								$_REQUEST['fecha'] = date('Y-m-d');
								$asientonota->readEnv();
								$asientonota->addRecord();
								$notamarginal->request['idnotamarginal'] = $asientonota->getlastId();
								$notamarginal->addrecord();
						}
				}
				break;

		case 'Inscripciones Varias':
				/* obtener inscripcion de nacimiento del inscrito */
				$classname="inscripcionvaria";
				$getmethodname="getInscripcionvaria";
				$inscripcionesvarias= new $classname();
				$idlastinscripcion=$InscripcionLast;

				$inscripcionvaria= $inscripcionesvarias->$getmethodname($idlastinscripcion);
				if(strnatcasecmp($inscripcionvaria->request['lugarinscripcionnacimiento'],$lugar_registro)){
						//corregir, por alguna razon no esta reconociendo el lugar de registro
						$datosinscripcion['tomo']= $inscripcionvaria->request['tomoinscripcionnacimiento'];
						$datosinscripcion['folio']= $inscripcionvaria->request['folioinscripcionnacimiento'];
						$datosinscripcion['partida']= $inscripcionvaria->request['partidainscripcionnacimiento'];
						// agregar el tomo a la consulta para conocer el numero de tomo porke solo se conoce en el acta el id del tomo.
						$lista_actas= $acta->readDataSQL("SELECT a.* FROM acta a inner join nacimiento i ON a.idinscripcion=i.idnacimiento inner join tomo t on t.idtomo=a.idtomo WHERE t.numero=".$datosinscripcion['tomo']." and a.folio=".$datosinscripcion['folio']." and a.partida=".$datosinscripcion['partida']."");

						if(sizeof($lista_actas)>0){
								//$inscripcion_nacimiento_conyuge1= new inscripcion();
								$inscripcionesafectadas[]= array("idinscripcion"=>$lista_actas[0]['idinscripcion'],"tipoinscripcion"=>"Nacimientos","url"=>"/modulos/inscripciones/editnacimiento?id=".$lista_actas[0]['idinscripcion']);
								$nacimientos = new nacimiento();
								$nacimiento= $nacimientos->getNacimiento($lista_actas[0]['idinscripcion']);
								//agregar aca datos de la marginacion 
								$notamarginal= new notamarginal();
								$notamarginal->request['idinscripcion']= $nacimiento->request['idnacimiento'];
								$notamarginal->request['actomodificador']= $_REQUEST['tipootrainscripcion'];
								$notamarginal->request['lugarinscripcion']= $lugar_registro;
								$notamarginal->request['libroinscripcion']= $rubro;
								$notamarginal->request['tomoinscripcion']= $_REQUEST['idtomo'];
								$notamarginal->request['folioinscripcion']= $_REQUEST['folio'];
								$notamarginal->request['partidainscripcion']= $_REQUEST['partida'];
								//requiere del anyo en ke se llevo el registro causa esto un error a registrar la nota marginal
								$tomo= new tomo();
								$tomoinscripcion= $tomo->getTomo($_REQUEST['idtomo']);
								$notamarginal->request['anyoinscripcion']= $tomoinscripcion->request['anyo'];

								$notamarginal->request['modificacion']= $_REQUEST['tipootrainscripcion'];
								$notamarginal->request['cuerpo']= $_REQUEST['tipootrainscripcion'];
								$notamarginal->request['inscripcionmodificadora']= $idlastinscripcion;
								$asientonota = new asientoregistral();
								$_REQUEST['fecha'] = date('Y-m-d');
								$asientonota->readEnv();
								$asientonota->addRecord();
								$notamarginal->request['idnotamarginal'] = $asientonota->getlastId();
								$notamarginal->addrecord();
						}
				}
				break;
		default:

				break;
}
/* calculo de registros relacionados para inscripciones de tipo especifico */
$textmessage="";
foreach($inscripcionesafectadas as $id=>$data){
		$textmessage.="<br/>Para verificar o asentar la modificaci&oacute;n en el ".$data['tipoinscripcion']." correspondiente haga click <a href=\"".$data['url']."\"> aca</a><br/>";
}

?>
