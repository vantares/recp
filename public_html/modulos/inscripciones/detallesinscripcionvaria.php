<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']); 
if($usuario->checkCredenciales(array('Inscripciones'))) { 
    if(isset($_REQUEST['id']) && $_REQUEST['id'] > 0) {
        $smarty->assign('camino','>> Inscripciones >> Varias >> Editando');  
        $libroregistral = new libroregistral();
        $libroregistralbd = $libroregistral->getLibroByRubro('Inscripciones Varias');
        $arrayTomos = $libroregistralbd->getTomosAbiertos(); 
        $tomos = new tomo();           
        $_REQUEST['idinscripcion'] = $_REQUEST['id'];  
        $inscripcion = new inscripcion();
        $inscripcionbd = $inscripcion->getInscripcion($_REQUEST['idinscripcion']);
        $acta = $inscripcionbd->getActa();        
        $actojuridico = $inscripcionbd->getActojuridico();
        $inscripcionvaria = $actojuridico->getInscripcionVaria();
        $perfil = new Perfil();
        $perfilbd = $perfil->getPerfil($usuario->request['idperfil']); 
        $smarty->assign('Perfil',$perfilbd);
        $smarty->assign('disabled', 'disabled=disabled');        
        $smarty->assign('Secretarios',$usuario->getUsersByRol('secretario'));
        $smarty->assign('Registradores',$usuario->getUsersByRol('registrador'));
        $tomobd = $tomos->getTomo($acta->request['idtomo']); 
        $smarty->assign('folio',$acta->request['folio']);
        $smarty->assign('tomo',$acta->request['idtomo']);   
        $smarty->assign('partida',$acta->request['partida']);
        $smarty->assign('arrayPartFolio',$arrayPartFolio);    
        $smarty->assign('arrayTomos',$arrayTomos);
        $smarty->assign('tomobd',$tomobd); 
        $smarty->assign('actojuridico',$actojuridico); 
        $smarty->assign('fechainscripcion',$acta->request['fecha']);
        $smarty->assign('fechadictament',$actojuridico->request['fechadictament']);  
        $smarty->assign('inscripcion',$inscripcionbd); 
        $smarty->assign('inscripcionvaria',$inscripcionvaria); 
        $smarty->assign('notamarginal',$notamarginal); 
        //Compareciente1
        $arrayPersona['comparecientes1']['nombre'] =  $inscripcionbd->request['compareciente1nombre'];
        $arrayPersona['comparecientes1']['edad'] = $inscripcionbd->request['compareciente1edad'];
        $arrayPersona['comparecientes1']['oficio'] = $inscripcionbd->request['compareciente1oficio']; 
        $arrayPersona['comparecientes1']['domicilio'] = $inscripcionbd->request['compareciente1domicilio'];
        $arrayPersona['comparecientes1']['cedula'] = $inscripcionbd->request['compareciente1cedula'];
        $smarty->assign('persona',$arrayPersona); 
        $nacimiento = $inscripcionvaria->getInscripcionNacimiento();  
        if($nacimiento) {
            $actanacbd = $nacimiento->getActa();     
            $arraynacimiento['inscrito']['tomo'] = $actanacbd->getNoTomo(); 
        } else {
            $actanacbd = new Acta();
            $actanacbd->request['idtomo'] = $inscripcionvaria->request['tomoinscripcionnacimiento'];
            $actanacbd->request['folio']  = $inscripcionvaria->request['folioinscripcionnacimiento'];
            $actanacbd->request['partida']  = $inscripcionvaria->request['folioinscripcionnacimiento'];
            $arraynacimiento['inscrito']['tomo'] = $inscripcionvaria->request['tomoinscripcionnacimiento'];
            $nacimiento = new inscripcion();
            $nacimiento = $inscripcionvaria;  
        }  
        $arraynacimiento['inscrito']['inscripcion'] = $nacimiento; 
        $arraynacimiento['inscrito']['actabd'] = $actanacbd; 
        $arraynacimiento['inscrito']['nombre1'] = $inscripcionbd->request['inscrito1nombre1']; 
        $arraynacimiento['inscrito']['nombre2'] = $inscripcionbd->request['inscrito1nombre2'];
        $arraynacimiento['inscrito']['apellido1'] = $inscripcionbd->request['inscrito1apellido1'];
        $arraynacimiento['inscrito']['apellido2'] = $inscripcionbd->request['inscrito1apellido2'];   
        $arraynacimiento['inscrito']['ciudadinscripcion'] = $inscripcionvaria->request['lugarinscripcionnacimiento'];  
        //Notas Marginales Asociadas
        $arrayNotasMarginales = $inscripcionbd->getNotasmarginales();
        //$reconocidosbd = $reconocidos->getReconocidosByInscripcion($inscripcionbd->request['idinscripcion']); 
        $smarty->assign('titular','Inscripci&oacute;n Varia');            
        $smarty->assign('arraynacimiento',$arraynacimiento);
        switch ($inscripcionvaria->request['tipootrainscripcion']) {
          case 'declarar mayor de edad':
             $encabezado = 'Datos del Declarado Mayor';
             $titulo = 'Declaracion de la mayoria de Edad';
          break; 
          case 'emancipar a un menor':
             $encabezado = 'Datos del Emancipado';
             $titulo = 'Emancipacion';
          break;    
          case 'otorgar la guarda':
             $encabezado = 'Datos de la Persona Sujeta a la Guarda';
             $titulo = 'De la Guarda'; 
          break;  
          case 'declarar ausente':
             $encabezado = 'Datos del Ausente';
             $titulo = 'Declaracion de Ausencia';   
          break; 
          case 'interdiccion civil':
             $encabezado = 'Datos de la Persona a la que se le suspenden sus derechos';
             $titulo = 'Interdiccion Civil'; 
          break;                      
        }          
        $smarty->assign('encabezado',$encabezado); 
        $smarty->assign('titulo',$titulo);         
        $smarty->assign('notasmarginalesbd',$arrayNotasMarginales);
        $smarty->assign('idinscripcionvaria',$inscripcionbd->request['idinscripcion']); 
        $smarty->assign('idinscripcionmarginal',$inscripcionbd->request['idinscripcion']);
        //$smarty->assign('visiblenacimiento','true');  
        $smarty->assign('visiblenotamarginal',(is_array($arrayNotasMarginales)) ? 'true' : '');
        $smarty->assign('url','/modulos/inscripciones/editinscripcionvaria.php/'.$inscripcionbd->request['idinscripcion']);
        $smarty->assign('urladd','/modulos/inscripciones/addinscripcionvaria.php');
        $smarty->assign('urllistado','/modulos/inscripciones/listarinscripcionvaria.php');
        $smarty->assign('etiqueta','edit');
        $smarty->assign('tipo','Inscripciones Varias');
        $smarty->assign('template','inscripciones/inscripcionvaria.tpl'); 
        $smarty->display('layout.tpl');       
    }    
} else {
    header("Location: ./login.php");
}   
?>