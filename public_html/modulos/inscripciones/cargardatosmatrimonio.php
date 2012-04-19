<?php
include_once('../../common.inc.php');                                     
$folio = $_REQUEST['folio'];  
$numero = $_REQUEST['idtomo'];
$smarty->assign('add','add'); 
if($folio != '' && $numero != '') {
    //Obtengo el dado el numero y el Libro
    $tomo = new tomo();
    $idtomo = $tomo->getIdTomoByLibroNumero('Matrimonios',$numero);
    if($idtomo != '') { 
        $acta = new acta();
        $actafilter = $acta->readDataFilter('acta.idtomo='.$idtomo.' AND acta.folio='.$folio);   
        if($actafilter) {
            $usuarios = new usuario();
            $usuario = $usuarios->getUser($_SESSION['idusuario']);        
            $inscripcion = new inscripcion();
            $inscripcionbd = $inscripcion->getInscripcion($actafilter[0]['idinscripcion']);
            $actabd = $acta->getActa($actafilter[0]);
            $matrimonio = $acta->getMatrimonioByTomoFolio($idtomo, $folio);
            if($matrimonio->request['idmatrimonio'] != '') {
                $actojuridico =  $inscripcionbd->getActojuridico();
                $smarty->assign('inscripcion',$inscripcionbd);
                $smarty->assign('actojuridico',$actojuridico);
                $smarty->assign('fechadictament',$actojuridico->request['fechadictament']);
                //Conyuge1
                $arrayPersona['conyuge1']['nombre1'] =  $inscripcionbd->request['inscrito1nombre1'];
                $arrayPersona['conyuge1']['nombre2'] =  $inscripcionbd->request['inscrito1nombre2'];
                $arrayPersona['conyuge1']['apellido1'] =  $inscripcionbd->request['inscrito1apellido1']; 
                $arrayPersona['conyuge1']['apellido2'] =  $inscripcionbd->request['inscrito1apellido2'];  
                $arrayPersona['conyuge1']['edad'] = $matrimonio->request['conyuge1edad'];
                $arrayPersona['conyuge1']['oficio'] = $matrimonio->request['conyuge1oficio']; 
                $arrayPersona['conyuge1']['domicilio'] = $matrimonio->request['conyuge1domicilio'];
                $arrayPersona['conyuge1']['nacionalidad'] = $matrimonio->request['conyuge1nacionalidad'];
                $arrayPersona['conyuge1']['cedula'] = $matrimonio->request['conyuge1cedula'];   
                $arrayPersona['conyuge1']['estadocivil'] = $matrimonio->request['conyuge1estadocivilanterior']; 
                //Conyuge2
                $arrayPersona['conyuge2']['nombre1'] =  $matrimonio->request['inscrito2nombre1'];
                $arrayPersona['conyuge2']['nombre2'] =  $matrimonio->request['inscrito2nombre2'];
                $arrayPersona['conyuge2']['apellido1'] =  $matrimonio->request['inscrito2apellido1']; 
                $arrayPersona['conyuge2']['apellido2'] =  $matrimonio->request['inscrito2apellido2'];
                $arrayPersona['conyuge2']['edad'] = $matrimonio->request['conyuge2edad'];
                $arrayPersona['conyuge2']['oficio'] = $matrimonio->request['conyuge2oficio']; 
                $arrayPersona['conyuge2']['domicilio'] = $matrimonio->request['conyuge2domicilio'];
                $arrayPersona['conyuge2']['nacionalidad'] = $matrimonio->request['conyuge2nacionalidad'];
                $arrayPersona['conyuge2']['cedula'] = $matrimonio->request['conyuge2cedula'];   
                $arrayPersona['conyuge2']['estadocivil'] = $matrimonio->request['conyuge2estadocivilanterior'];
                //Compareciente1
                $arrayPersona['compareciente1']['nombre'] =  $inscripcionbd->request['compareciente1nombre'];
                $arrayPersona['compareciente1']['edad'] = $inscripcionbd->request['compareciente1edad'];
                $arrayPersona['compareciente1']['oficio'] = $inscripcionbd->request['compareciente1oficio']; 
                $arrayPersona['compareciente1']['domicilio'] = $inscripcionbd->request['compareciente1domicilio'];
                $arrayPersona['compareciente1']['cedula'] = $inscripcionbd->request['compareciente1cedula'];
                //Testigo1
                $arrayPersona['testigo1']['nombre'] =  $matrimonio->request['testigo1nombre'];
                $arrayPersona['testigo1']['edad'] = $matrimonio->request['testigo1edad'];
                $arrayPersona['testigo1']['oficio'] = $matrimonio->request['testigo1oficio']; 
                $arrayPersona['testigo1']['domicilio'] = $matrimonio->request['testigo1domicilio'];
                $arrayPersona['testigo1']['nacionalidad'] = $matrimonio->request['testigo1nacionalidad'];
                $arrayPersona['testigo1']['cedula'] = $matrimonio->request['testigo1cedula'];   
                $arrayPersona['testigo1']['estadocivil'] = $matrimonio->request['testigo1estadocivil'];   
                //Testigo2
                $arrayPersona['testigo2']['nombre'] =  $matrimonio->request['testigo2nombre'];
                $arrayPersona['testigo2']['edad'] = $matrimonio->request['testigo2edad'];
                $arrayPersona['testigo2']['oficio'] = $matrimonio->request['testigo2oficio']; 
                $arrayPersona['testigo2']['domicilio'] = $matrimonio->request['testigo2domicilio'];
                $arrayPersona['testigo2']['nacionalidad'] = $matrimonio->request['testigo2nacionalidad'];
                $arrayPersona['testigo2']['cedula'] = $matrimonio->request['testigo2cedula'];   
                $arrayPersona['testigo2']['estadocivil'] = $matrimonio->request['testigo2estadocivil']; 
                $smarty->assign('persona',$arrayPersona); 
                //Nacimiento conyuge1
                $nacimientoconyuge1 = $matrimonio->getNacimientoConyuge('conyuge1');
                if($nacimientoconyuge1) {
                    $actaConyuge1 = $nacimientoconyuge1->getActa();
                    $hechovitalConyuge1 = $nacimientoconyuge1->getHechoVital();
                    $fecha = explode('-',$hechovitalConyuge1->request['fechanacimiento']);
                    $anyo1 = $fecha[0];
                } else {
                    $actaConyuge1 = new acta();
                    $actaConyuge1->request['idtomo'] = $matrimonio->request['conyuge1tomoinscripcion'];
                    $actaConyuge1->request['folio'] = $matrimonio->request['conyuge1folioinscripcion'];
                    $actaConyuge1->request['partida'] = $matrimonio->request['conyuge1partidainscripcion'];
                    $anyo1 = $matrimonio->request['conyuge1anyoinscripcion'];
                    $nacimientoconyuge1 = new inscripcion();
                    $nacimientoconyuge1->request['municipioinscripcion'] =  $matrimonio->request['conyuge1lugarinscripcion']; 
                }  
               
                $arraynacimiento['conyuge1']['actabd'] = $actaConyuge1;
                $arraynacimiento['conyuge1']['hechovital'] = $hechovitalConyuge1;
                $arraynacimiento['conyuge1']['numero'] = $matrimonio->request['conyuge1tomoinscripcion']; 
                $arraynacimiento['conyuge1']['anyo'] = $anyo1;
                $arraynacimiento['conyuge1']['inscripcion'] = $nacimientoconyuge1; 
                //Nacimiento conyuge2
                $nacimientoconyuge2 = $matrimonio->getNacimientoConyuge('conyuge2');
                if($nacimientoconyuge2) {
                    $actaConyuge2 = $nacimientoconyuge2->getActa();
                    $hechovitalConyuge2 = $nacimientoconyuge2->getHechoVital();
                    $fecha = explode('-',$hechovitalConyuge2->request['fechanacimiento']);
                    $anyo2 = $fecha[0];
                } else {
                    $actaConyuge2 = new acta();
                    $actaConyuge2->request['idtomo'] = $matrimonio->request['conyuge2tomoinscripcion'];
                    $actaConyuge2->request['folio'] = $matrimonio->request['conyuge2folioinscripcion'];
                    $actaConyuge2->request['partida'] = $matrimonio->request['conyuge2partidainscripcion'];
                    $anyo2 = $matrimonio->request['conyuge1anyoinscripcion'];
                    $nacimientoconyuge2 = new inscripcion();
                    $nacimientoconyuge2->request['municipioinscripcion'] =  $matrimonio->request['conyuge2lugarinscripcion']; 
                }         
                $arraynacimiento['conyuge2']['actabd'] = $actaConyuge2;
                $arraynacimiento['conyuge2']['hechovital'] = $hechovitalConyuge2;
                $arraynacimiento['conyuge2']['anyo'] = $anyo2; 
                $arraynacimiento['conyuge2']['numero'] = $matrimonio->request['conyuge1tomoinscripcion']; 
                $arraynacimiento['conyuge2']['inscripcion'] = $nacimientoconyuge2; 
                $smarty->assign('arraynacimiento',$arraynacimiento);  
                $reconocidos = new reconocimiento();
                $reconocidosbd = $reconocidos->getReconocidosByInscripcion($inscripcionbd->request['idinscripcion']); 
                $smarty->assign('reconocidosbd',$reconocidosbd);
                $smarty->assign('idtomom',$numero); 
                $smarty->assign('foliom',$folio); 
                $smarty->assign('partidam',$actabd->request['partida']);
                $smarty->assign('visiblenacimiento','true');  
                $smarty->assign('Registradores',$usuario->getUsersByRol('registrador'));  
                $smarty->assign('Secretarios',$usuario->getUsersByRol('secretario'));
                $smarty->assign('visiblehijo',($reconocidosbd) ? 'true' : ''); 
            } else {
                $smarty->assign('errormat','No hay matrimonio registrado con ese tomo y ese folio en el sistema');
            }          
            
        } else {
            $smarty->assign('errormat','No hay matrimonio registrado con ese tomo y ese folio en el sistema');
        } 
    } else {
        $smarty->assign('errormat','No hay matrimonio registrado con ese tomo y ese folio en el sistema'); 
    } 
} else {
    $smarty->assign('errormat','No hay matrimonio registrado con ese tomo y ese folio en el sistema');
}    
$smarty->display($_REQUEST['template']);   
?>
