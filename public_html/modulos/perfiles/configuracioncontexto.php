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
    $idparametro = $_REQUEST['idparametro2'];
    $idcontexto = $_REQUEST['idcontexto'];
    
    //arreglar todo esto y leer la documentacion sobre
    //el idcontexto en el parametro
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

$confcontexto = $confcontextos->getConfiguracioncontexto($_POST['idparametro'],$_POST['idcontexto']);
if((isset($_POST['salvar'])) && ($_POST['salvar'] == 'salvar')){
    $confcontexto->request['idparametro'] = $_REQUEST['idparametro'];
	$confcontexto->request['idcontexto'] = $_REQUEST['idcontexto'];
    $confcontexto->request['valor'] = $_REQUEST['valor'];
    $confcontexto->readEnv();
    $confcontexto->updateRecord();
    
    $parametro = $parametros->getParametro($_REQUEST['idparametro']);
    $contexto = $contextos->getContexto($_REQUEST['idcontexto']);
    //Registro el evento
    $evento = new evento();
    $evento->request['tipoevento'] = 'Configuracion de contexto';
    $evento->request['nombreusuario'] = $user->request['nombre']; 
    $evento->request['clave'] = $user->request['clave'];  
    $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
    $evento->request['descripcion'] = 'Se ha configurado el contexto'.$contexto->request['descripcion'].' del parametro '.$parametro->request['definicion']; 
    $evento->request['fechaocurrencia'] = date('Y-m-d');
    $evento->addRecord();            
}

if(($_REQUEST['idcontexto'] != '')&&($_REQUEST['idparametro'] != '')) $filter .= "(configuracioncontexto.idparametro ='".$_REQUEST['idparametro']."' AND configuracioncontexto.idcontexto = '".$_REQUEST['idcontexto']."')"; 
if($filter == ''){    
    $confcontexto = new configuracioncontexto();     
} else {
    $confcontextodb = $confcontextos->readDataSQL("SELECT configuracioncontexto.*
                                          FROM configuracioncontexto  
                                         WHERE ".$filter);
    $confcontexto = $confcontextos->getConfiguracioncontexto($confcontextodb['idparametro'],$confcontextodb['idcontexto']);
}
//poner el valor en dependencia del parametro
$idparametro = $_REQUEST['idparametro'];
$idcontexto = $_REQUEST['idcontexto'];  


$arrayParametros = $parametros->readData();
$arrayContextos = $contextos->reaData();
$smarty->assign('arrayParametros',$arrayParametros);
$smarty->assign('arrayContextos',$arrayContextos);
$smarty->assign('idparametro',$idparametro);  
$smarty->assign('idcontexto',$idcontexto);
$smarty->assign('confcontexto',$confcontexto);  
$smarty->display($_REQUEST['template']);
?>