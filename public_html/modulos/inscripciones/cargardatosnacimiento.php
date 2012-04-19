<?php
include_once('../../common.inc.php');
$folio = $_REQUEST['folio'];  
$numero = $_REQUEST['idtomo'];
$partida = $_REQUEST['partida']; 
$smarty->assign('add','add'); 
if($folio != '' && $numero != '') {
    $tomo = new tomo();
    $idtomo = $tomo->getIdTomoByLibroNumero('Nacimientos',$numero);
    if($idtomo != '') {
        $acta = new acta();
        $filter = ($partida != '') ? ' AND acta.folio='.$partida : '';
        $actafilter = $acta->readDataFilter('acta.idtomo='.$idtomo.' AND acta.folio='.$folio.$filter);
        if($actafilter) {
            $inscripcion = new inscripcion();
            $inscripcionbd = $inscripcion->getInscripcion($actafilter[0]['idinscripcion']);
            $smarty->assign('inscripcion',$inscripcionbd);
            $smarty->assign('hechovital',$inscripcionbd->getHechoVital());
            //$actabd =  $acta->getActa($actafilter[0]);
            $arraynacimiento[$_REQUEST['tipo']]['hechovital'] = $inscripcionbd->getHechoVital();
            $arraynacimiento[$_REQUEST['tipo']]['inscripcion'] = $inscripcionbd;
            $arraynacimiento[$_REQUEST['tipo']]['actabd'] = $acta->getActa($actafilter[0]);
            $arraynacimiento[$_REQUEST['tipo']]['numero'] = $numero; 
            $fecha= explode('-',$inscripcionbd->getHechoVital()->request['fechanacimiento']); 
            $arraynacimiento[$_REQUEST['tipo']]['anyo'] = $fecha[0];
            $arraynacimiento[$_REQUEST['tipo']]['tomo'] = $numero; 
            $smarty->assign('arraynacimiento',$arraynacimiento);
            if($_REQUEST['tipo'] == 'fallecido') {
                $hechovital = $inscripcionbd->getHechoVital();
                $nacimiento = $hechovital->getNacimiento(); 
                $persona['padre']['nombre'] = $hechovital->request['padrenombre'];
                $persona['padre']['edad'] = $nacimiento->request['edadpadre'];
                $persona['padre']['oficio'] = $nacimiento->request['oficiopadre'];
                $persona['padre']['domicilio'] = $nacimiento->request['domiciliopadre'];  
                $persona['padre']['nacionalidad'] = $nacimiento->request['nacionalidadpadre'];
                $persona['padre']['cedula'] = $nacimiento->request['cedulapadre'];   
                $persona['madre']['nombre'] = $hechovital->request['nombremadre'];
                $persona['madre']['edad'] = $nacimiento->request['edadmadre'];
                $persona['madre']['oficio'] = $nacimiento->request['oficiomadre'];
                $persona['madre']['domicilio'] = $nacimiento->request['domiciliomadre'];  
                $persona['madre']['nacionalidad'] = $nacimiento->request['nacionalidadmadre']; 
                $persona['madre']['cedula'] = $nacimiento->request['cedulamadre'];              
                $smarty->assign('persona',$persona);     
                $smarty->assign('defuncionb',$_REQUEST['defuncionb']); 
            }    
        } else {
            $smarty->assign('error','No hay nacimiento registrado con ese tomo y ese folio en el sistema');
        }
    } else {
        $smarty->assign('error','No hay nacimiento registrado con ese tomo y ese folio en el sistema');
    }  
} else {
   $smarty->assign('error','No hay nacimiento registrado con ese tomo y ese folio en el sistema');
}    
$smarty->display($_REQUEST['template']);   
?>
