<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');

$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);      

if($user->checkCredenciales(array('Administracion', 'Definir Perfiles'))) {
    $perfiles = new perfil();
    $perfil = $perfiles->getPerfil($_POST['idperfil']);
    if((isset($_POST['salvar'])) && ($_POST['salvar'] == 'salvar')){
        $perfil->request['idperfil'] = $_REQUEST['idperfil'];
        $perfil->request['nombre'] = $_REQUEST['nombre'];
        $perfil->request['descripcion'] = $_REQUEST['descripcion'];
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
    }

    $arrayPerfiles = $perfiles->readData(); 

    $smarty->assign('arrayPerfiles',$arrayPerfiles);
    $smarty->display($_REQUEST['template']); 
} else {
    header("location: /login.php"); 
} 
?>
