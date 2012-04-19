<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);
$privilegios = new privilegioTable();

if($user->checkCredenciales(array('Administracion','Definir Roles'))) {
    $roles = new rol();
    if(($args[2])&&($args[2] !='')){    
        $rol = $roles->getRol($args[2]);
        $arrayRolAreas = $rol->getAreas();
        $arrayPrivilegiosAsignados = $rol->getPrivilegios();
        
        $smarty->assign('rol',$rol);
        $smarty->assign('arrayPrivilegiosAsignados',$arrayPrivilegiosAsignados);
        $smarty->assign('titular','Editar Rol: '.$rol->request['nombrerol']);
        $smarty->assign('arrayRolAreas',$arrayRolAreas);     
    }else{
        $smarty->assign('titular','Nuevo Rol'); 
    }

    if(isset($_POST['salvar'])){    	
    	$arrayRolAreas = $_POST['rolareas']; 
	    $arrayPrivilegiosAsignados = $_POST['privilegiosasignados'];
        if(isset($args[1])) {
            switch($args[1]) {
                case 'add':
                   $rol = new rol();                   
                   $rol->readEnv();
                   $rol->addRecord();   
                   if(is_array($arrayRolAreas)) {
                      /* foreach($arrayRolAreas as $valor => $valor1){
                              echo $valor."-->";
                              echo $valor1."    ";
                       }   die;*/ 
                       $idrol = $roles->getlastId();
                       $rol = $roles->getRol($idrol);
                       $rol->setAreas($arrayRolAreas); 
                   }else{
                       $rol->deleteAreas();
                   }
                   if(is_array($arrayPrivilegiosAsignados)) {
                       $rol->setPrivilegios($arrayPrivilegiosAsignados);
                   }else {
                       $rol->deletePrivilegios();
                   }
                   //Registro el evento
                   $evento = new evento(); 
                   $evento->request['tipoevento'] = 'Agregar rol';
                   $evento->request['nombreusuario'] = $user->request['nombre']; 
                   $evento->request['clave'] = $user->request['clave'];  
                   $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
                   $evento->request['descripcion'] = 'Se ha agregado el rol '.$rol->request['nombrerol'].' al sistema'; 
                   $evento->request['fechaocurrencia'] = date('Y-m-d');
                   $evento->addRecord();        
                break;
                case 'edit':
                   $rol = $roles->getRol($_POST['idrol']);
                   $rol->readEnv();
                   $rol->updateRecord();
                   if(is_array($arrayRolAreas)) {
                      /* foreach($arrayRolAreas as $valor => $valor1){
                              echo $valor."-->";
                              echo $valor1."    ";
                       }   die;*/ 
                       $rol->setAreas($arrayRolAreas); 
                   }else{
                       $rol->deleteAreas();
                   }
                   if(is_array($arrayPrivilegiosAsignados)) {
                       $rol->setPrivilegios($arrayPrivilegiosAsignados);
                   }else {
                       $rol->deletePrivilegios();
                   }
                   //Registro el evento
                   $evento = new evento();
                   $evento->request['tipoevento'] = 'Editar rol';
                   $evento->request['nombreusuario'] = $user->request['nombre']; 
                   $evento->request['clave'] = $user->request['clave'];  
                   $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
                   $evento->request['descripcion'] = 'Se ha editado el rol '.$rol->request['nombrerol']; 
                   $evento->request['fechaocurrencia'] = date('Y-m-d');
                   $evento->addRecord();    
                break;
            }           
        } else {
            header("Location: /modulos/roles/");
        }        
        header("Location: /modulos/roles/");
    }
    $areas = new area();
    $arrayAreas = $areas->getAreasLimitadas();
    $arrayPrivilegios = $privilegios->readData();

    $smarty->assign('arrayPrivilegios',$arrayPrivilegios);                                                 
    $smarty->assign('arrayAreas',$arrayAreas); 
    $smarty->assign('template','roles/editrol.tpl');
    $smarty->display('layout.tpl');        
} else {
    header("Location: /login.php");  
}
?>