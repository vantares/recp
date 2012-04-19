<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');

$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);

if($user->checkCredenciales(array('Administracion', 'Gestionar Usuarios'))) {
    $usuario = new usuario();
    if(($args[2])&&($args[2] !='')){    
        $usuario = $usuarios->getUser($args[2]);
        $smarty->assign('titular','Editar Usuario '.$usuario->request['nombreusuario']); 
        $smarty->assign('usuario',$usuario);     
    }else{
        $smarty->assign('titular','Nuevo Usuario'); 
    }

    if(isset($_POST['salvar'])){
    
        if(isset($_REQUEST['check'])){
            $_REQUEST['estado'] = A;
        }else{
            $_REQUEST['estado'] = D;
        }
           
        if(isset($_POST['idusuario'])&&($_POST['idusuario'] != '')){
            $usuario->request['idusuario']  = $_POST['idusuario']; 
        }
        
        
        /*/verifico si existe otro usuario con el mismo login OJO: ver como se puede hacer por js o ajax
        if($usuario->existeOtroLogin($usuario->request['idusuario'],$usuario->request['nombre'])){
            echo 'cometiste un error';die;//header("Location: /usuarios.php");        
        }
        //--------------------------------------------*/
        
        if(isset($args[1])) {
            switch($args[1]) {
                case 'add':
                   $pass = md5($_REQUEST['clave']);
                   $_REQUEST['clave'] = $pass;
                   $_REQUEST['fechaingreso']  = date('Y-m-d');
                   $usuario->readEnv();
                   $usuario->addRecord();
                   //Registro el evento
                   $evento = new evento();      
                   $evento->request['tipoevento'] = "Agregar usuario";
                   $evento->request['nombreusuario'] = $user->request['nombre']; 
                   $evento->request['clave'] = $user->request['clave'];  
                   $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
                   $evento->request['descripcion'] = "Se ha agregado el usuario ".$usuario->request['nombre']." al sistema"; 
                   $evento->request['fechaocurrencia'] = date('Y-m-d');
                   $evento->addRecord();        
                break;
                case 'edit':
                   $_REQUEST['clave'] = $usuario->request['clave'];
                   $_REQUEST['fechaingreso']  = $usuario->request['fechaingreso'];
                   $usuario->readEnv();
                   $usuario->updateRecord();  
                   //Registro el evento
                   $evento = new evento();
                   $evento->request['descripcion'] = 'Se ha editado al usuario '.$usuario->request['nombre']; 
                   $evento->request['tipoevento'] = 'Editar usuario';
                   $user = $usuarios->getUser($_SESSION['idusuario']);
                   $evento->request['nombreusuario'] = $user->request['nombre']; 
                   $evento->request['clave'] = $user->request['clave']; 
                   $evento->request['cliente'] = $_SERVER['REMOTE_ADDR'];                   
                   $evento->request['fechaocurrencia'] = date('Y-m-d');
                   $evento->addRecord();    
                break;
            }           
        } else {
            header("Location: /modulos/usuarios/");
        }
        
        header("Location: /modulos/usuarios/");
    }
    $perfiles = new perfil();
    $roles  = new rolTable();
    $arrayRoles = $roles->readData();
    $arrayPerfiles =  $perfiles->readData();

    $smarty->assign('args',$args);
    $smarty->assign('arrayPerfiles',$arrayPerfiles); 
    $smarty->assign('arrayRoles',$arrayRoles);
    $smarty->assign('template','usuarios/editusuario.tpl');
    $smarty->display('layout.tpl');
} else {
    header("Location: /login.php");  
}
?>
