<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']); 
if($usuario->checkCredenciales(array('Inscripciones'))) { 
    if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
        $smarty->assign('camino','>> Inscripciones >> Disolucion de Matrimonio >> Editando');  
        $libroregistral = new libroregistral();
        $libroregistralbd = $libroregistral->getLibroByRubro('Disolucion Vinculo Matrimonial');
        //$arrayTomos = $libroregistralbd->getTomosAbiertos(); 
        $arrayTomos = $libroregistralbd->getTomos(); 
        $tomos = new tomo();           
        $_REQUEST['idinscripcion'] = $_REQUEST['id'];  
        $inscripcion = new inscripcion();
        $inscripcionbd = $inscripcion->getInscripcion($_REQUEST['idinscripcion']);
        $acta = $inscripcionbd->getActa();  
        $actojuridico = $inscripcionbd->getActojuridico();
        $disolucionmatrimonio = $actojuridico->getDisolucionMatrimonio();
        $perfil = new Perfil();
        $perfilbd = $perfil->getPerfil($usuario->request['idperfil']); 
        $smarty->assign('Perfil',$perfilbd);
        $smarty->assign('disabled', 'disabled=disabled');
        $smarty->assign('Secretarios',$usuario->getUsersByRol('secretario'));
        $smarty->assign('Registradores',$usuario->getUsersByRol('registrador'));
        $tomobd = $tomos->getTomo($acta->request['idtomo']); 

        $smarty->assign('tomobd',$tomobd);              
        $smarty->assign('folio',$acta->request['folio']);
        $smarty->assign('tomo',$acta->request['idtomo']);   
        $smarty->assign('partida',$acta->request['partida']);
        $smarty->assign('arrayPartFolio',$arrayPartFolio);    
        $smarty->assign('arrayTomos',$arrayTomos);
        $smarty->assign('actojuridico',$actojuridico); 
        $smarty->assign('fechainscripcion',$acta->request['fecha']);
        $smarty->assign('fechadictament',$actojuridico->request['fechadictament']);  
        $smarty->assign('inscripcion',$inscripcionbd); 
        //Compareciente1
        $arrayPersona['comparecientes1']['nombre'] =  $inscripcionbd->request['compareciente1nombre'];
        $arrayPersona['comparecientes1']['edad'] = $inscripcionbd->request['compareciente1edad'];
        $arrayPersona['comparecientes1']['oficio'] = $inscripcionbd->request['compareciente1oficio']; 
        $arrayPersona['comparecientes1']['domicilio'] = $inscripcionbd->request['compareciente1domicilio'];
        $arrayPersona['comparecientes1']['cedula'] = $inscripcionbd->request['compareciente1cedula'];
        //Conyuge1
        $arrayPersona['conyuge1']['nombre1'] =  $inscripcionbd->request['inscrito1nombre1'];
        $arrayPersona['conyuge1']['nombre2'] =  $inscripcionbd->request['inscrito1nombre2'];
        $arrayPersona['conyuge1']['apellido1'] =  $inscripcionbd->request['inscrito1apellido1']; 
        $arrayPersona['conyuge1']['apellido2'] =  $inscripcionbd->request['inscrito1apellido2'];  
        $arrayPersona['conyuge1']['edad'] = $disolucionmatrimonio->request['conyuge1edad'];
        $arrayPersona['conyuge1']['oficio'] = $disolucionmatrimonio->request['conyuge1oficio']; 
        $arrayPersona['conyuge1']['domicilio'] = $disolucionmatrimonio->request['conyuge1domicilio'];
        $arrayPersona['conyuge1']['nacionalidad'] = $disolucionmatrimonio->request['conyuge1nacionalidad'];
        $arrayPersona['conyuge1']['cedula'] = $disolucionmatrimonio->request['conyuge1cedula'];   
        $arrayPersona['conyuge1']['estadocivil'] = $disolucionmatrimonio->request['conyuge1estadocivilanterior']; 
        //Conyuge2
        $arrayNombre = explode(' ',trim($disolucionmatrimonio->request['conyuge2nombre']));
        $arrayPersona['conyuge2']['nombre1'] =  $arrayNombre[0];
        $arrayPersona['conyuge2']['nombre2'] =  $arrayNombre[1];
        $arrayPersona['conyuge2']['apellido1'] =  $arrayNombre[2]; 
        $arrayPersona['conyuge2']['apellido2'] =  $arrayNombre[3];
        $arrayPersona['conyuge2']['edad'] = $disolucionmatrimonio->request['conyuge2edad'];
        $arrayPersona['conyuge2']['oficio'] = $disolucionmatrimonio->request['conyuge2oficio']; 
        $arrayPersona['conyuge2']['domicilio'] = $disolucionmatrimonio->request['conyuge2domicilio'];
        $arrayPersona['conyuge2']['nacionalidad'] = $disolucionmatrimonio->request['conyuge2nacionalidad'];
        $arrayPersona['conyuge2']['cedula'] = $disolucionmatrimonio->request['conyuge2cedula'];   
        $arrayPersona['conyuge2']['estadocivil'] = $disolucionmatrimonio->request['conyuge2estadocivilanterior'];   
        //Nacimiento conyuge1
	//TODO: revisar aca para la disolucion id=49 alguno de los conyuges no esta incrito y no se encuentra el acta por lo ke retorna un error. validar la existencia primero antes de proceder con lo siguiente.
        $actaConyuge1 = new acta();
        $actaConyuge1->request['idtomo'] = $disolucionmatrimonio->request['conyuge1tomoinscripcion'];
        $actaConyuge1->request['folio'] = $disolucionmatrimonio->request['conyuge1folioinscripcion'];
        $actaConyuge1->request['partida'] = $disolucionmatrimonio->request['conyuge1partidainscripcion'];
        $anyo1 = $disolucionmatrimonio->request['conyuge1anyoinscripcion'];
        $arraynacimiento['conyuge1']['actabd'] = $actaConyuge1;
        $arraynacimiento['conyuge1']['hechovital'] = $hechovitalConyuge1;
        $arraynacimiento['conyuge1']['numero'] = $disolucionmatrimonio->request['conyuge1tomoinscripcion']; 
        $arraynacimiento['conyuge1']['anyo'] = $anyo1;   
        $arraynacimiento['conyuge1']['inscripcion'] = $nacimientoconyuge1; 
	//revisar si esta entencia es la ke producre el fallo
        //$arraynacimiento['conyuge1']['tomo'] = $actaConyuge1->getNoTomo();
        $nacimientoconyuge1 = new inscripcion();
        $nacimientoconyuge1->request['municipioinscripcion'] =  $disolucionmatrimonio->request['conyuge1lugarinscripcion']; 
        $arraynacimiento['conyuge1']['inscripcion'] = $nacimientoconyuge1;
        //Nacimiento conyuge2
        $actaConyuge2 = new acta();
        $actaConyuge2->request['idtomo'] = $disolucionmatrimonio->request['conyuge2tomoinscripcion'];
        $actaConyuge2->request['folio'] = $disolucionmatrimonio->request['conyuge2folioinscripcion'];
        $actaConyuge2->request['partida'] = $disolucionmatrimonio->request['conyuge2partidainscripcion'];
        $anyo2 = $disolucionmatrimonio->request['conyuge2anyoinscripcion'];
        $nacimientoconyuge2 = new inscripcion();
        $nacimientoconyuge2->request['municipioinscripcion'] =  $disolucionmatrimonio->request['conyuge2lugarinscripcion']; 
        $arraynacimiento['conyuge2']['actabd'] = $actaConyuge2;
        $arraynacimiento['conyuge2']['anyo'] = $anyo2; 
         $arraynacimiento['conyuge2']['numero'] = $disolucionmatrimonio->request['conyuge2tomoinscripcion'];
        $arraynacimiento['conyuge2']['inscripcion'] = $nacimientoconyuge2; 
        //$arraynacimiento['conyuge2']['tomo'] = $actaConyuge2->getNoTomo(); 
        
        //Hijos Reconocidos
        $reconocidos = new reconocimiento();
	//FIX:esta linea causaba el erro cuando el matrimonio no era encontrado o la disolucion no tiene asociada un matrimonio o no se enecuntra el matrimonio correspondiente en el registro de matrimonios.
        $idmatrimonio = $disolucionmatrimonio->getIdMatrimonio(); 
        if($idmatrimonio){
            $reconocidosbd = $reconocidos->getReconocidosByInscripcion($idmatrimonio); 
            $smarty->assign('reconocidosbd',$reconocidosbd); 
        }
               
        $arrayNotasMarginales = $inscripcionbd->getNotasmarginales(); 
        $smarty->assign('notasmarginalesbd',$arrayNotasMarginales); 
        $smarty->assign('visiblenotamarginal',(is_array($arrayNotasMarginales)) ? 'true' : '');
        $smarty->assign('idinscripcionmarginal',$inscripcionbd->request['idinscripcion']); 
        $smarty->assign('titular','Disolucion Vinculo Matrimonial');            
        $smarty->assign('arraynacimiento',$arraynacimiento);
        $smarty->assign('visiblehijo',($reconocidosbd) ? 'true' : '');  
        $smarty->assign('persona',$arrayPersona);
        $smarty->assign('idtomom',$disolucionmatrimonio->request['tomomatrimonio']); 
        $smarty->assign('foliom',$disolucionmatrimonio->request['foliomatrimonio']);
        $smarty->assign('partidam',$disolucionmatrimonio->request['partidamatrimonio']);
        $smarty->assign('disolucionmatrimonio',$disolucionmatrimonio);
        $smarty->assign('iddisolucionmatrimonio',$inscripcionbd->request['idinscripcion']); 
        $smarty->assign('visiblenacimiento','true');  
        $smarty->assign('url','/modulos/inscripciones/editdisolucionmatrimonio.php/'.$inscripcionbd->request['idinscripcion']);
        $smarty->assign('urladd','/modulos/inscripciones/adddisolucionmatrimonio.php');
        $smarty->assign('urllistado','/modulos/inscripciones/listardisomatrimonios.php');
        $smarty->assign('etiqueta','edit');
        $smarty->assign('tipo','Disolucion Vinculo Matrimonial');
        $smarty->assign('template','inscripciones/disolucionmatrimonio.tpl'); 
        $smarty->display('layout.tpl');       
    }    
} else {
    header("Location: ./login.php");
}   
?>
