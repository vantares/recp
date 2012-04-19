<?php
include_once('../../common.inc.php');
$persona = new persona();
$personabd = $persona->getPersona($_REQUEST['idpersona']);
/*
 este script carga los datos de la persona en los campos
 busca el regostro de la persona y recarga la plantilla pasandole los datos
*/
/*
 agregar restricciones sobre la persona
 ninguna defuncion asociada a esta persona,
 matrimonios: persona no casada actualmente
 nacimiento: persona no tiene asociado ningun registro de nacimiento
*/
$available=true;
$participacion= new participacionTable();
$inscription2verify= "Defunciones";
$defunciones_participacion= $participacion->readDataSQL("SELECT inscripcion.idinscripcion, participacion.idpersona FROM participacion LEFT JOIN inscripcion ON inscripcion.idinscripcion=participacion.idinscripcion WHERE inscripcion.tipoinscripcion ='".$inscription2verify."' AND participacion.idpersona=".$_REQUEST['idpersona']." AND participacion.formaparticipacion IS NULL");
if(sizeof($defunciones_participacion)>0){
	$available=false;
	$error_restriccion="Esta persona ha sido registrada como difunta";
}
else{
	$available=true;
}

/*
 * ninguno de los conyuges debe estar casado
 * establecer asociacion entre el matrimonio o la disolucion
 */
if(stristr($_REQUEST['tipo'],'conyuge')){

$inscription2verify= "Matrimonios";
$matrimonios_participacion=array();
$matrimonios_participacion= $participacion->readDataSQL("SELECT inscripcion.idinscripcion, participacion.idpersona FROM participacion LEFT JOIN inscripcion ON inscripcion.idinscripcion=participacion.idinscripcion WHERE inscripcion.tipoinscripcion ='".$inscription2verify."' AND participacion.idpersona=".$_REQUEST['idpersona']." AND participacion.formaparticipacion ilike 'conyuges'");

$inscriptionanulatoria= "Disolucion Vinculo Matrimonial";
//$inscripciones_anulacion=array();
$inscripciones_anulacion= $participacion->readDataSQL("select i.idinscripcion, i.tipoinscripcion, n.inscripcionmodificadora, m.tipoinscripcion, m.tipoinscripcion, p.idpersona, p.formaparticipacion from notamarginal n left outer join inscripcion i on n.idinscripcion= i.idinscripcion left outer join inscripcion m on n.inscripcionmodificadora= m.idinscripcion left outer join participacion p on p.idinscripcion=i.idinscripcion where i.tipoinscripcion='".$inscriptio2verify."' and m.tipoinscripcion= '".$inscriptionanulatoria."' and p.formaparticipacion ilike 'conyuges' and p.idpersona=".$_REQUEST['idpersona']);

//print_r($matrimonios_participacion);
//print_r($inscripciones_anulacion);
if(sizeof($matrimonios_participacion)>sizeof($inscripciones_anulacion) and !empty($inscripciones_anulacion[0])){
	$available=false;
	$error_restriccion="Esta persona tiene una o mas inscripciones de matrimonio registradas sin una disoluci&oacute;n asociada";
}
}

if($personabd != '' and $available) {
    //Datos de la Persona 
    $arrayPersona[$_REQUEST['tipo']]['nombre1'] =  trim($personabd->request['nombre1']);
    $arrayPersona[$_REQUEST['tipo']]['nombre2'] =  trim($personabd->request['nombre2']);
    $arrayPersona[$_REQUEST['tipo']]['apellido1'] =  trim($personabd->request['apellido1']);
    $arrayPersona[$_REQUEST['tipo']]['apellido2'] =  trim($personabd->request['apellido2']);
    $arrayPersona[$_REQUEST['tipo']]['edad'] = $personabd->getEdad();
    $arrayPersona[$_REQUEST['tipo']]['oficio'] = $personabd->request['ocupacion']; 
    $arrayPersona[$_REQUEST['tipo']]['domicilio'] = $personabd->request['domicilio'];
    $arrayPersona[$_REQUEST['tipo']]['nacionalidad'] = $personabd->request['nacionalidad'];
    $arrayPersona[$_REQUEST['tipo']]['cedula'] = $personabd->getCiudadano()->request['cedula'];
    $arrayPersona[$_REQUEST['tipo']]['estadocivil'] = $personabd->request['estadocivil']; 
    $arrayPersona[$_REQUEST['tipo']]['edad'] = $personabd->getEdad();  
    $arrayPersona[$_REQUEST['tipo']]['municipio'] = $personabd->getCiudadano()->request['municipio']; 
    $arrayPersona[$_REQUEST['tipo']]['ciudad'] = $personabd->getCiudadano()->request['ciudad']; 
    $arrayPersona[$_REQUEST['tipo']]['departamento'] = $personabd->getCiudadano()->request['departamento']; 
    $arrayPersona[$_REQUEST['tipo']]['pais'] = $personabd->request['paisnacimiento']; 
    
    if(in_array($_REQUEST['tipo'],array('comparecientes1','comparecientes2','persona','padre','madre'))) {
        $nombre = $personabd->request['nombre1'];
        if($personabd->request['nombre2'] != '') {
           $nombre.= ' '.$personabd->request['nombre2'];
        }
        if($personabd->request['apellido1'] != '') {
           $nombre.= ' '.$personabd->request['apellido1'];
        }
        if($personabd->request['apellido2'] != '') {
           $nombre.= ' '.$personabd->request['apellido2'];
        }
        $arrayPersona[$_REQUEST['tipo']]['nombre'] =  $nombre;
    }
    $smarty->assign('persona',$arrayPersona); 
} else {

	$smarty->assign('error','La Persona no esta registrada en el sistema <span class="chequear"><a href="/modulos/personas/addpersona.php" target="_blank">Ingresar aqui</a></span>'); 
	$smarty->assign('error','ERROR'); 
	if(isset($error_restriccion)){
		$smarty->assign('error',$error_restriccion); 
	}
}    
if($_REQUEST['tipo'] == 'fallecido') {
    //Causa de muertes
    $muertes = new causamuerteTable();
    $arrayCausaMuertes = $muertes->readData();
    $smarty->assign('arrayCausaMuertes',$arrayCausaMuertes);         
}
$smarty->assign('add','add');
$smarty->assign('defuncionb',$_REQUEST['defuncionb']);
$smarty->display($_REQUEST['template']); 
?>
