<?php 
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');

$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);      

if($user->checkCredenciales(array('Administracion', 'Definir Perfiles'))) {   
    $parametros = new parametro();
    $perfiles = new perfil();
    $defperfiles = new definicionperfil();
    

    $idperfil = $_REQUEST['idperfil'];
    $idparametro = $_REQUEST['idparametro1'];      
    if(!$defperfiles->getExistedefinicion($idperfil, $idparametro)){        
            $definicionperfil = new definicionperfil();
            $case = 'add';         
    }else{
            $definicionperfil = $defperfiles->getDefinicionperfil($idperfil, $idparametro);
            $case = 'edit'; 
    }
 
    if((isset($_POST['salvar'])) && ($_POST['salvar'] == 'Salvar')){         
        switch($case) {
            case 'add':
                $definicionperfil->request['idperfil'] = $idperfil;
                $definicionperfil->request['idparametro'] =  $idparametro;
                $definicionperfil->request['valor'] = $_REQUEST['valor']; 
                $definicionperfil->addRecord();  
            break;
            case 'edit':                     
                $definicionperfil->request['valor'] = $_REQUEST['valor'];                
                $definicionperfil->updateRecord($idperfil,$idparametro); 
            break;
        }        
        
        $parametro = $parametros->getParametro($_REQUEST['parametro']);
        $perfil = $perfiles->getPerfil($_REQUEST['idperfil']);
        //Registro el evento
        $evento = new evento();
        $evento->request['tipoevento'] = 'Definir perfil';
        $evento->request['nombreusuario'] = $user->request['nombre']; 
        $evento->request['clave'] = $user->request['clave'];  
        $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
        $evento->request['descripcion'] = 'Se ha definido el parametro'.$parametro->request['definicion'].' del perfil '.$perfil->request['nombre']; 
        $evento->request['fechaocurrencia'] = date('Y-m-d');
        $evento->addRecord();            
    }
    header("location: /modulos/perfiles/editperfil.php?accion=edit&idperfil=".$idperfil);
} else {
     header("location: /login.php"); 
}
?>