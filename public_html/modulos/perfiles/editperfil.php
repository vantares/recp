<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');

$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);

if(isset($_REQUEST['accion'])) $args[1] = $_REQUEST['accion'];
if(isset($_REQUEST['idperfil'])) $args[2] = $_REQUEST['idperfil'];

if($user->checkCredenciales(array('Administracion', 'Definir Perfiles'))) {
    $perfiles = new perfil();
    $parametros = new parametro();
    $contextos = new contexto();
    $definiciones = new definicionperfil();
    if(($args[2])&&($args[2] !='')){    
        $perfil = $perfiles->getPerfil($args[2]);        
        $arrayPerfiles = $perfiles->readData();
        $arrayParametros = $parametros->readData();
        
        $arrayDefiniciones = $perfil->getDefiniciones();
        
        $arrayContextos = $contextos->readData();
        $action = $_REQUEST['accion']; 
		        
        $smarty->assign('perfil',$perfil);
        $smarty->assign('arrayPerfiles',$arrayPerfiles);
        $smarty->assign('arrayDefiniciones',$arrayDefiniciones); 
        $smarty->assign('arrayParametros',$arrayParametros);
        $smarty->assign('arrayContextos',$arrayContextos);
        $smarty->assign('titular','Editar Perfil: '.$perfil->request['nombre']);
        $smarty->assign('action',$action); 
    }else{
        $smarty->assign('titular','Nuevo Perfil'); 
    }
    
    if(isset($_POST['idperfil'])&&($_POST['idperfil'] != '')){
            $perfil->request['idperfil']  = $_POST['idperfil']; 
        }
        
    if(isset($_POST['salvar'])){
    	if(isset($args[1])) {
            switch($args[1]) {
                case 'add':
                	$perfil = new perfil();
                    $perfil->readEnv(); 
                    $perfil->addRecord();
                    //Registro el evento
                    $evento = new evento();
                    $evento->request['tipoevento'] = 'Agregar perfil';
                    $evento->request['nombreusuario'] = $user->request['nombre']; 
                    $evento->request['clave'] = $user->request['clave'];  
                    $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
                    $evento->request['descripcion'] = 'Se ha agregado el perfil '.$perfil->request['nombre'].' al sistema'; 
                    $evento->request['fechaocurrencia'] = date('Y-m-d');
                    $evento->addRecord();       
                break;
                case 'edit':
                	$perfil = $perfiles->getPerfil($_POST['idperfil']);
                    $perfil->readEnv(); 
                    $perfil->updateRecord();
                    //Registro el evento
                    $evento = new evento();
                    $evento->request['tipoevento'] = 'Editar perfil';
                    $evento->request['nombreusuario'] = $user->request['nombre']; 
                    $evento->request['clave'] = $user->request['clave'];  
                    $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
                    $evento->request['descripcion'] = 'Se ha editado el perfil '.$perfil->request['nombre']; 
                    $evento->request['fechaocurrencia'] = date('Y-m-d');
                    $evento->addRecord(); 
                break;
            }           
        } else {
            header("Location: /modulos/perfiles/");
        }        
        header("Location: /modulos/perfiles/");
    }
    $idperfil = $_REQUEST['idperfil']; 
    $smarty->assign('idperfil',$idperfil);
    $smarty->assign('template','perfiles/editperfil.tpl');
    $smarty->display('layout.tpl');        
} else {
    header("Location: /login.php");  
}


?>