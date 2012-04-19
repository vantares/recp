<?php
session_start();  
include_once('../../common.inc.php'); 
include_once($_SERVER['DOCUMENT_ROOT'] . '/../classes/function.numeros.php');   
$args = explode("/", $_SERVER['PATH_INFO']); 
if(isset($_REQUEST['acta'])) $args[1] = $_REQUEST['acta'];  
if(isset($_REQUEST['idinscripcion'])) $args[2] = $_REQUEST['idinscripcion'];  
if(isset($args[1])) {  
    $smarty->register_function("convertir_a_letras", "convertir_a_letras");
    $usuarios = new usuario();
    $usuario = $usuarios->getUser($_SESSION['idusuario']);  
    $perfil = new Perfil();
    $perfilbd = $perfil->getPerfil($usuario->request['idperfil']);    
    $smarty->assign('Municipio',$perfilbd->getParametro('Municipio')); 
    $smarty->assign('Provincia',$perfilbd->getParametro('Provincia'));
    $smarty->assign('Departamento',$perfilbd->getParametro('Departamento'));
    $smarty->assign('fecha',date('Y-m-d')); 
    $smarty->assign('Ciudad',$perfilbd->getParametro('Ciudad')); 
    $inscripcion = new inscripcion();
    $inscripcionbd = $inscripcion->getInscripcion($args[2]);
    switch($args[1]) {
        case 'nacimiento':
        $hechovital =  $inscripcionbd->getHechoVital(); 
        $smarty->assign('hechovital',$hechovital);       
        $smarty->assign('actabd',$inscripcionbd->getActa()); 
        $smarty->assign('nacimiento',$hechovital->getNacimiento());
        $template = 'actas/nacimiento.tpl';
        break;
        case 'defuncion':
            $hechovital =  $inscripcionbd->getHechoVital();
            $defuncion = $hechovital->getDefuncion();
            $smarty->assign('hechovital',$hechovital);       
            $smarty->assign('actabd',$inscripcionbd->getActa()); 
            $smarty->assign('defuncion',$defuncion);
            $template = 'actas/defuncion.tpl';     
        break;
        case 'matrimonio':
	//falta lo de los hijos, modificaciones al estado y lo de ls fecha de inscripcion de cada conyuge
        $actojuridico =  $inscripcionbd->getActojuridico();
        $matrimonio = $actojuridico->getMatrimonio();
        $smarty->assign('actojuridico',$actojuridico);       
        $smarty->assign('actabd',$inscripcionbd->getActa()); 
        $smarty->assign('matrimonio',$matrimonio);
        $reconocidos = new reconocimiento();
        $reconocidosbd = $reconocidos->getReconocidosByInscripcion($inscripcionbd->request['idinscripcion']);
        $smarty->assign('reconocidos',$reconocidosbd);   
        $notasmarginales = $inscripcionbd->getNotasmarginales();
        $modificacion = '';
        $esprimero = true;
        if(is_array($notasmarginales)) {
            foreach($notasmarginales as $notamarginal) {
                if($esprimero) {
                    $modificacion .= $notamarginal->request['modificacion'];
                    $esprimero = false; 
                } else {
                    $modificacion .= ', '.$notamarginal->request['modificacion'];     
                }    
            }  
        }
        $smarty->assign('modificacion',$modificacion);    
        $template = 'actas/matrimonio.tpl';           
        break; 
        case 'repomatrimonio':
	//falta lo de los hijos, modificaciones al estado y lo de ls fecha de inscripcion de cada conyuge
        $actojuridico =  $inscripcionbd->getActojuridico();
        $matrimonio = $actojuridico->getReposicionmatrimonio();
	//print_r($matrimonio);
        $smarty->assign('actojuridico',$actojuridico);       
        $smarty->assign('actabd',$inscripcionbd->getActa()); 
        $smarty->assign('matrimonio',$matrimonio);
        $smarty->assign('repomatrimonio',$matrimonio);
        $reconocidos = new reconocimiento();
        $reconocidosbd = $reconocidos->getReconocidosByInscripcion($inscripcionbd->request['idinscripcion']);
        $smarty->assign('reconocidos',$reconocidosbd);   
        $notasmarginales = $inscripcionbd->getNotasmarginales();
        $modificacion = '';
        $esprimero = true;
        if(is_array($notasmarginales)) {
            foreach($notasmarginales as $notamarginal) {
                if($esprimero) {
                    $modificacion .= $notamarginal->request['modificacion'];
                    $esprimero = false; 
                } else {
                    $modificacion .= ', '.$notamarginal->request['modificacion'];     
                }    
            }  
        }
        $smarty->assign('modificacion',$modificacion);    
        $template = 'actas/repomatrimonio.tpl';           
        break; 

        case 'reponacimiento':
        $repohechovital =  $inscripcionbd->getRepoHechoVital(); 
        $smarty->assign('repohechovital',$repohechovital);       
        $smarty->assign('actabd',$inscripcionbd->getActa()); 
        $smarty->assign('reponacimiento',$repohechovital->getReposicionnacimiento());
        $template = 'actas/reposicion_nacimiento.tpl';
        break; 
        case 'repodefuncion':
        $repohechovital =  $inscripcionbd->getRepoHechoVital();
        $repodefuncion = $repohechovital->getReposiciondefuncion();
        $smarty->assign('repohechovital',$repohechovital);       
        $smarty->assign('actabd',$inscripcionbd->getActa()); 
        $smarty->assign('repodefuncion',$repodefuncion);
        $template = 'actas/reposicion_defuncion.tpl';     
        break;  
        case 'inscripciones_varias':
        $actojuridico =  $inscripcionbd->getActojuridico();
        $inscripcionvaria = $actojuridico->getInscripcionvaria();
        $smarty->assign('actojuridico',$actojuridico);       
        $smarty->assign('actabd',$inscripcionbd->getActa()); 
        $smarty->assign('inscripcionvaria',$inscripcionvaria);
        $notasmarginales = $inscripcionbd->getNotasmarginales();
        $modificacion = '';
        $esprimero = true;
        if(is_array($notasmarginales)) {
            foreach($notasmarginales as $notamarginal) {
                if($esprimero) {
                    $modificacion .= $notamarginal->request['modificacion'];
                    $esprimero = false;
                } else {
                    $modificacion .= ', '.$notamarginal->request['modificacion'];     
                }    
            }  
        }
        $smarty->assign('modificacion',$modificacion);  
        $template = 'actas/varia.tpl';     
        break; 
        case 'disolucion_vinculo_matrimonial':
            $actojuridico =  $inscripcionbd->getActojuridico();
            $smarty->assign('actojuridico',$actojuridico);  
            $actabd = $inscripcionbd->getActa();
            $disolucionmatrimonio = $actojuridico->getDisolucionmatrimonio();
            $tomo = new tomo();
            $tomobd = $tomo->getTomo($actabd->request['idtomo']);    
            $smarty->assign('actabd',$actabd); 
            $smarty->assign('numero',$tomobd->request['numero']);
            $smarty->assign('disolucionmatrimonio',$disolucionmatrimonio);
            $notasmarginales = $inscripcionbd->getNotasmarginales();
            $modificacion = '';
            $esprimero = true;
            if(is_array($notasmarginales)) {
                foreach($notasmarginales as $notamarginal) {
                    if($esprimero) {
                        $modificacion .= $notamarginal->request['modificacion'];
                        $esprimero = false;
                    } else {
                        $modificacion .= ', '.$notamarginal->request['modificacion'];     
                    }    
                }  
            }
            $smarty->assign('modificacion',$modificacion);   
            //Hijos Reconocidos
            $reconocidos = new reconocimiento();
            $idmatrimonio = $disolucionmatrimonio->getIdMatrimonio();
            $reconocidosbd = '';
            if($idmatrimonio){
                $reconocidosbd = $reconocidos->getReconocidosByInscripcion($idmatrimonio); 
                $hijos = '';
                $esprimero = true;
                if(is_array($reconocidosbd)) {
                    foreach($reconocidosbd as $hijo) {
                        if($esprimero) {
                            $hijos .= $hijo->request['nombrereconocido'];
                            $esprimero = false;
                        } else {
                            $hijos .= ', '.$hijo->request['nombrereconocido'];     
                        }    
                    }  
                }
                $smarty->assign('hijos',$hijos);                 
            }
            $template = 'actas/disolucion_matrimonio.tpl';
        break;                                 
	
        case 'generic':
            $template = 'actas/base.tpl';
        break;                                 
    }
    $smarty->assign('inscripcionbd',$inscripcionbd);
    $smarty->display($template);   
}    
?> 
