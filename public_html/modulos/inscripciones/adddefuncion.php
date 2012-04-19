<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);      
if($usuario->checkCredenciales(array('Inscripciones'))) { 
		$libroregistral = new libroregistral();
		$libroregistralbd = $libroregistral->getLibroByRubro('Defunciones');
		$smarty->assign('template','inscripciones/defuncion.tpl');
		if($libroregistralbd) {
				$arrayTomos = $libroregistralbd->getTomosAbiertos();
				if(!$arrayTomos) {
						$smarty->assign('notice', '<b>error:<b> No existe tomos abiertos asegurese de que existe el libro registral y que tiene algun tomo abierto');
						$smarty->assign('class','errornotice'); 
						$smarty->display('layout.tpl'); 
						die;
				} 
		} else {
				$smarty->assign('notice', '<b>error:<b> No existe definido el libro registral para este tipo de inscripcion');
				$smarty->assign('class','errornotice'); 
				$smarty->display('layout.tpl'); 
				die;    
		}     
		$tomos = new tomo();
		$esprimero = true;
		$perfil = new Perfil();
		$perfilbd = $perfil->getPerfil($usuario->request['idperfil']);      
		if((isset($_POST['salvar'])) && ($_POST['salvar'] == 'salvar')) {
				$error = false;
				//Asiento la defuncion
				$asiento = new asientoregistral();
				$_REQUEST['fecha'] = date('Y-m-d');
				$asiento->readEnv();
				try {
						$asiento->addRecord();
				}
				catch (Asiento $e) {
						$mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
						$error = true;
				} 
				if(!$error) {        
						//Actualizo Incripcion
						$inscripcion = new inscripcion();
						$_REQUEST['idinscripcion'] =  $asiento->getlastId();
						$_REQUEST['tipoinscripcion'] =  'Defunciones';
						$_REQUEST['numeroserie'] =  $inscripcion->getLastNoserie() + 1;
						$_REQUEST['ciudadinscripcion'] = $perfilbd->getParametro('Ciudad');
						$_REQUEST['municipioinscripcion'] = $perfilbd->getParametro('Municipio');
						$_REQUEST['departamentoinscripcion'] = $perfilbd->getParametro('Departamento');
						$_REQUEST['paisinscripcion'] = $perfilbd->getParametro('Pais');
						$inscripcion->readEnv();
						try {
								$inscripcion->addRecord();
						}
						catch (Inscripcion $e) {
								$mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
								$error = true;
						} 
						if(!$error) {
								$InscripcionLast = $inscripcion->getlastId();
								$arrayPersonas = array('compareciente1','madre','padre','fallecido');
								$_REQUEST['madrecedula'] = $_REQUEST['cedulamadre'];
								$_REQUEST['padrecedula'] = $_REQUEST['cedulapadre'];  
								$_REQUEST['madrenombre'] = $_REQUEST['nombremadre'];                
								$_REQUEST['fallecidocedula'] = $_REQUEST['cedulafallecido'];                
								//Actualizo Persona asociadas a la inscripcion
								foreach($arrayPersonas as $valor) {
										$persona = new persona();
										$Id = ($_REQUEST[$valor.'cedula'] != '')  ? $persona->getIdByCedula($_REQUEST[$valor.'cedula']) : $persona->getIdByName($_REQUEST[$valor.'nombre']);
										if($Id) {                 
												$participacion = new participacionTable();
												$_REQUEST['idinscripcion'] = $InscripcionLast;
												$_REQUEST['idpersona'] = $Id; 
												switch($valor) {
														case 'compareciente1':
														case 'compareciente2':
																$forma = 'Compareciente';
																break;
																break; 
														case 'madre':
														case 'padre':
																$forma = 'Padre';
																break;
														case 'fallecido':
																unset($forma);
																break;
																break; 
												}
												//TODO: agergar participacion para el fallecido, actualmente no se ingresa el registro de fallecido en la tabla de participaciones.
												$exist =  $participacion->readRecord($_REQUEST['idpersona'],$_REQUEST['idinscripcion']);
												if(!$exist) {
														if(isset($forma)){
																$_REQUEST['formaparticipacion'] = $forma;
														}
														else{
																$_REQUEST['formaparticipacion'] = NULL;
														}
														$participacion->readEnv();
														$participacion->addRecord();    
												} else {
														$_REQUEST['formaparticipacion'] = $exist['formaparticipacion'].' '.$forma;
														$participacion->readEnv();
														$participacion->updateRecord();                       
												} 
										}  
								}      
								//Actualizo Datos Registrales
								$acta = new acta();
								$_REQUEST['fecha'] = $_REQUEST['fechainscripcion'];
								$_REQUEST['idinscripcion'] = $InscripcionLast; 
								$acta->readEnv();
								try { 
										$acta->addRecord();
								}
								catch (Inscripcion $e) {
										$mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
										$error = true;
								} 
								if(!$error) {            
										//Actualizo Hecho vital
										$hechovital = new hechovital();
										$_REQUEST['idhechovital'] = $InscripcionLast;
										$hechovital->readEnv();
										try {
												$hechovital->addRecord();
										}
										catch (HechoVital $e) {
												$mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
												$error = true;
										} 
										if(!$error) {             
												//Actualizo Defuncion
												$defuncion = new defuncion();
												$_REQUEST['iddefuncion'] = $hechovital->getlastId();
												$defuncion->readEnv();
												try {
														$defuncion->addRecord();
												}
												catch (Defuncion $e) {
														$mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
														$error = true;
												}   
												if(!$error) {             
														//Actualizo Nacimiento
														/*$actanacimiento = new acta();
														  $nacimientobd = $actanacimiento->getNacimientoByTomoFolio($_REQUEST['tomoinscripcionnacimiento'],$_REQUEST['folioinscripcionnacimiento']);
														  if($nacimientobd) {  
														  $nacimientobd->request['lugarinscripciondefuncion'] = $_REQUEST['lugarinscripciondefuncion'];
														  $nacimientobd->request['folioinscripciondefuncion'] = $_REQUEST['folio'];
														  $nacimientobd->request['tomoinscripciondefuncion'] = $_REQUEST['idtomo']; 
														  $nacimientobd->request['partidainscripciondefuncion'] = $_REQUEST['partida'];
														  $arrayaux = explode('-',$_REQUEST['fechadefuncion']);
														  $nacimientobd->request['anyoinscripciondefuncion'] = $arrayaux[0]; 
														  try {
														  $nacimientobd->updateRecord();
														  }
														  catch (Nacimiento $e) {
														  $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
														  $error = true;
														  }
														//Elimino el asiento que tiene que ver con la inscripcion 
														//$asientonacimiento = new asientoregistral();
														//$asientonacimiento->deleteRecord($nacimientobd->request['idnacimiento']);
														} */
														include_once("__marginacionesresultantes.php");
														//Actualizo el fallecido
														$IdFallecido =  ($_REQUEST['cedulafallecido'] != '')  ? $persona->getIdByCedula($_REQUEST['cedulafallecido']) : $persona->getIdByName($_REQUEST['inscrito1nombre1'].' '.$_REQUEST['inscrito1nombre2'].' '.$_REQUEST['inscrito1apellido1'].' '.$_REQUEST['inscrito1apellido2']);
														if(!$IdFallecido) {
																//Inserto el Inscrito como persona
																$fallecido = new persona();
																$_REQUEST['nombre1'] = $_REQUEST['inscrito1nombre1'];  
																$_REQUEST['nombre1'] = $_REQUEST['inscrito1nombre1'];
																$_REQUEST['nombre2'] = $_REQUEST['inscrito1nombre2'];
																$_REQUEST['apellido1'] = $_REQUEST['inscrito1apellido1'];
																$_REQUEST['apellido2'] = $_REQUEST['inscrito1apellido2'];
																$_REQUEST['edad'] = $_REQUEST[$valor.'edad'];
																$_REQUEST['ocupacion'] = $_REQUEST['oficiofallecido'];
																$_REQUEST['domicilio'] = $_REQUEST['domiciliofallecido']; 
																$_REQUEST['nacionalidad'] = $_REQUEST['nacionalidadfallecido']; 
																$_REQUEST['sexo'] = 'm';   
																$_REQUEST['edad'] = $_REQUEST['edadfallecido'];
																$fallecido->readEnv();
																$fallecido->addRecord();
																if($_REQUEST['cedulafallecido'] != '') {
																		$cuidadanofallecido = new ciudadano();
																		$_REQUEST['idciudadano'] = $fallecido->getlastId();
																		$_REQUEST['cedula'] = $_REQUEST['cedulafallecido'];
																		$cuidadanofallecido->readEnv();
																		$cuidadanofallecido->addRecord();
																}                        
														}                                                  
												}                                           
										}                    
								}
						}   
				}
				$smarty->assign('notice',(!$error) ? 'La inscripcion fue creada correctamente'.$textmessage : '<b>error:<b> La Inscripcion no se pudo crear');
				$smarty->assign('class',(!$error) ? 'notice' : 'errornotice'); 
				if(!$error) {
						//Registro el evento
						$evento = new evento();
						$evento->request['tipoevento'] = 'Crear Partida de Defuncion';
						$evento->request['nombreusuario'] = $usuario->request['nombre']; 
						$evento->request['clave'] = $usuario->request['clave'];  
						$evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
						$evento->request['descripcion'] = 'Se creo una partida de defuncion con tomo'.$_REQUEST['idtomo'].' folio '.$_REQUEST['folio'].' Se hizo el asiento correspondiente'; 
						$evento->request['fechaocurrencia'] = date('Y-m-d');
						$evento->addRecord();
				}                   
		}     

		foreach($arrayTomos as $tomo) {
				$tomobd = $tomos->getTomo($tomo['idtomo']);
				$arrayPartFolio[$tomo['idtomo']]['partida'] = $tomobd->getLastPartida() + 1;
				$arrayPartFolio[$tomo['idtomo']]['folio'] = $tomobd->getLastFolio() + 1; 
				if($esprimero) {
						$folio = $tomobd->getLastFolio() + 1;
						$partida = $tomobd->getLastPartida() + 1;
						$esprimero = false;
				}    
		}
		//Causa de muertes
		$muertes = new causamuerteTable();
		$arrayCausaMuertes = $muertes->readData();
		$smarty->assign('arrayCausaMuertes',$arrayCausaMuertes); 
		$arrayPersona['fallecido']['municipio'] =  $perfilbd->getParametro('Municipio');
		$arrayPersona['fallecido']['ciudad'] = $perfilbd->getParametro('Provincia');
		$arrayPersona['fallecido']['departamento'] = $perfilbd->getParametro('Departamento');     
		$arrayPersona['fallecido']['pais'] = $perfilbd->getParametro('Pais');
		$smarty->assign('persona',$arrayPersona);
		$smarty->assign('defuncionb','ok');
		$smarty->assign('Secretarios',$usuario->getUsersByRol('secretario'));
		$smarty->assign('Registradores',$usuario->getUsersByRol('registrador'));
		$smarty->assign('url','/modulos/inscripciones/adddefuncion');    
		$smarty->assign('fechainscripcion',date('Y-m-d H:m'));   
		$smarty->assign('fechadefuncion',date('Y-m-d H:m')); 
		$smarty->assign('folio',$folio); 
		$smarty->assign('partida',$partida);   
		$smarty->assign('add','add');
		$smarty->assign('arrayPartFolio',$arrayPartFolio);    
		$smarty->assign('arrayTomos',$arrayTomos);
		$smarty->assign('camino','>> Inscripciones >> Defunciones >> Nueva');  
		$smarty->display('layout.tpl');     
} else {
		header("Location: ./login.php");
}     
?>
