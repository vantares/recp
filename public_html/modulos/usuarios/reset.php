<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');

$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);
if($user->checkCredenciales(array('Administracion', 'Gestionar Usuarios'))) {
	if(($args[1])&&($args[1] !='')){    
	    $usuario = $usuarios->getUser($args[1]);    
	}
	
	if(isset($_POST['salvar'])){ 
		$usuario = $usuarios->getUser($_POST['idusuario']);
		$pass = md5($_REQUEST['clave']);
        $_REQUEST['clave'] = $pass;	    
	    //$_REQUEST['idusuario']  = $usuario->request['idusuario'];
	    $_REQUEST['idrol']  = $usuario->request['idrol'];
	    $_REQUEST['idperfil']  = $usuario->request['idperfil'];
	    $_REQUEST['nombreusuario']  = $usuario->request['nombreusuario'];
	    $_REQUEST['nombre']  = $usuario->request['nombre'];
	    $_REQUEST['email']  = $usuario->request['email'];
	    $_REQUEST['preguntaconfirmacion']  = $usuario->request['preguntaconfirmacion'];
	    $_REQUEST['respuestaconfirmacion']  = $usuario->request['respuestaconfirmacion'];
	    $_REQUEST['estado']  = $usuario->request['estado'];
	    $_REQUEST['fechaingreso']  = $usuario->request['fechaingreso'];
        $usuario->readEnv();
        $usuario->updateRecord();
        //Registro el evento
        $evento = new evento();
        $evento->request['descripcion'] = "Se ha cambiado la clave de acceso del usuario ".$usuario->request['nombre'];                                                                             
        $evento->request['tipoevento'] = "Cambiar clave de acceso";
        $user = $usuarios->getUser($_SESSION['idusuario']);
        $evento->request['nombreusuario'] = $user->request['nombre']; 
        $evento->request['clave'] = $user->request['clave'];  
        $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
        $evento->request['fechaocurrencia'] = date('Y-m-d');
        $evento->addRecord(); 
        header("Location: /modulos/usuarios/");
	}
    $smarty->assign('titular',"Cambiar la clave de acceso de ".$usuario->request['nombreusuario'].' ('.$usuario->request['nombre'].')'); 
    $smarty->assign('usuario',$usuario); 
    $smarty->assign('template','usuarios/resetpass.tpl');
    $smarty->display('layout.tpl');	
}else{
	header("Location: /login.php");
}
?>