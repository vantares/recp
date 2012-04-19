<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);
if($usuario->checkCredenciales(array('Gestionar Tomos', 'Nuevo Tomo', 'Edit Tomo'))) {
    $tomo = $tomo = new tomo();  
    if(isset($args[1])) {
        switch($args[1]) {
            case 'add':
                $_REQUEST['idlibro'] = $_SESSION['libroregistral'];
                $_REQUEST['anyo'] = date('Y');
                $_REQUEST['estado'] = 'abierto'; 
                $tomo->readEnv();  
                $libro = new libroregistral();
                $librobd = $libro->getLibro($_SESSION['libroregistral']); 
                $smarty->assign('camino','>> Tomos >> Adicionar');                         
                if(isset($_POST['salvar'])){ 
                    $tomo->addRecord();
                    //Creo el acta de apertura
                    if($tomo->getlastId() > 0) {
                       $ok1 = 1;
                       $apertura = new apertura();
                       $_REQUEST['idtomo'] = $tomo->getlastId();
                       $_REQUEST['fecha'] = date('Y-m-d');
                       $apertura->readEnv();  
                       $apertura->addRecord();
                    }  
                    if($apertura->getlastId() > 0) $ok2 = 1;
                    $smarty->assign('notice',(($ok1 +$ok2) == 2) ? 'El Tomo fue abierto correctamente' : '<b>error:<b> El Tomo no se pudo abrir');
                    $smarty->assign('class',(($ok1 +$ok2) == 2) ? 'notice' : 'errornotice');  
                    $descripcion = "Se agrego un nuevo tomo al libro ".$librobd->getNomRubro();
                } 
 
                $titular = 'Nuevo Tomo para el Libro Registral '.$librobd->getNomRubro(); 
                $anno = date('Y');
            break;
            case 'cierre':
               if(isset($args[2]) && $args[2] > 0) {
                   $_REQUEST['idtomo'] = $args[2];
                   $_REQUEST['estado'] = 'cerrado';
                   $_REQUEST['fecha'] = date('Y-m-d');
                   $tomo->readEnv();
                   if(isset($_POST['salvar'])){
                       $tomo->updateRecord();
                       $descripcion = "Se actualizo el tomo ".$args[2]." del libro ".$_SESSION['libroregistral'];
                   }
                   $titular = 'Edicion del Tomo '.$args[2].' del Libro '.$_SESSION['libroregistral'];
               } else {
                   header("Location: /modulos/tomos");
               }   
            break;
        }
        
        if(isset($_POST['salvar'])){
            $evento = new evento();
            $evento->request['tipoevento'] = 'actualizacion de un tomo'; 
            $evento->request['nombreusuario'] = $usuario->request['nombre'];
            $evento->request['clave'] = $usuario->request['clave'];
            $evento->request['cliente'] = $_SERVER['REMOTE_ADDR'];
            $evento->request['descripcion'] = $descripcion; 
            $evento->request['fechaocurrencia'] = date('Y-m-d');  
            $evento->addRecord(); 
            header("Location: /modulos/tomos/");
        }  
        $smarty->assign('tomo',$tomo);
        $smarty->assign('anyo',$anno); 
        $smarty->assign('titular',$titular); 
        $smarty->assign('Secretarios',$usuario->getUsersByRol('secretario'));
        $smarty->assign('Registradores',$usuario->getUsersByRol('registrador'));            
        $smarty->assign('template','tomos/edittomo.tpl');
        $smarty->display('layout.tpl');
           
    } else {
        header("Location: /modulos/tomos/");
    }    
} else {
    header("Location: /login.php"); 
}      
