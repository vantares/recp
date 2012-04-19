<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);

if($user->checkCredenciales(array('Administracion','Gestionar Usuarios'))) {
   if((isset($args[1])&&(($args[1]) !=''))){
        $usuario = $usuarios->getUser($args[1]); 
        $usuarios->deleteRecord($args[1]);
        //Registro el evento
        $evento = new evento();      
        $evento->request['descripcion'] = "Se ha eliminado al usuario ".$usuario->request['nombre']; 
        $evento->request['tipoevento'] = "Eliminar usuario";
        $user = $usuarios->getUser($_SESSION['idusuario']);
        $evento->request['nombreusuario'] = $user->request['nombre']; 
        $evento->request['clave'] = $user->request['clave'];  
        $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
        $evento->request['fechaocurrencia'] = date('Y-m-d');
        $evento->addRecord(); 
   }
   
   $arrayUsuarios = $usuarios->readData();
   $idrol = $_POST['idrol'];
   $idperfil = $_POST['idperfil'];  
   $sql = '';
   if($idrol != '') $sql .= " AND usuario.idrol='".$idrol."'";
   if($idperfil != '') $sql .= " AND usuario.idperfil='".$idperfil."'";                          
   
   $arrayUsuarios = $usuarios->readDataFilter('usuario.idusuario != -1 '.$sql); 
   
   if(is_array($arrayUsuarios)) { 
       foreach($arrayUsuarios as $key => $user) {
           $userbd = $usuarios->getUser($user['idusuario']);
           $rol = $userbd->getRol();
           $perfil = $userbd->getPerfilArreglo();
           $user['rol'] = $rol['nombrerol'];
           $user['perfil'] =  $perfil['nombre']; 
           $arrayUsuarios[$key] = $user;     
       }
   } 
      
   $perfiles = new perfil();
   $roles  = new rolTable();
   $arrayRoles = $roles->readData();
   $arrayPerfiles =  $perfiles->readData();
    
   $smarty->assign('arrayUsuarios',$arrayUsuarios); 
   $smarty->assign('idrol',$idrol);  
   $smarty->assign('idperfil',$idperfil); 
   $smarty->assign('arrayPerfiles',$arrayPerfiles); 
   $smarty->assign('arrayRoles',$arrayRoles);
   $smarty->assign('titular','Listado de Usuarios ');
   $smarty->assign('template','usuarios/listadousuarios.tpl');
   $smarty->display('layout.tpl');
} else {
   header("location: /login.php"); 
}  


    
?>
