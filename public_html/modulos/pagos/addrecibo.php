<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$user = $usuarios->getUser($_SESSION['idusuario']);
if($user->checkCredenciales(array('Pagos'))) {     
    $allpersonas = new persona();
    $allsolicitudes = new solicitudtramite();
    $tipotramites = new tipotramite();
    $tratamientofechas = new TFechas();
    $organizaciones = new organizacion();
    $arrayOrganizacion = $organizaciones->getAll();   
    $formadepago = new formasdepagoTable();
    $arrayFormapago = $formadepago->readData();               
    //determino cuantos dias de espera son y determino a traves de ellos el monto a pagar en general
    $monto = 0;
    if((isset($_POST['salvar']))){ 
        $recibo = new recibo();
        $_REQUEST['nombrecliente'] = $_REQUEST['nombre'];
        $_REQUEST['monto'] = 0;
        $_REQUEST['estado'] = 0; 
        $_REQUEST['fecha']  = date('Y-m-d');
        $recibo->readEnv();  
        $recibo->addRecord();
        //Si existe la persona establezco el vinculo
        $persona = new Persona();
        $idpersona = $_REQUEST['idpersona'];
        $personabd = ($idpersona != '')  ? $persona->getIdByCedula($idpersona) : $persona->getIdByName($_REQUEST['nombre']);
        if(!$personabd) {
           $personabd = new Persona();
           $nombrebd = explode(' ',trim($_REQUEST['nombre']));
           switch (count($nombrebd)) {
               case 4:
                    $nombre1 = $nombrebd[0];
                    $nombre2 = $nombrebd[1];
                    $apellido1 = $nombrebd[2];
                    $apellido2 = $nombrebd[3];
                    break;
               case 3:
                    $nombre1 = $nombrebd[0];
                    $apellido1 = $nombrebd[1];
                    $apellido2 = $nombrebd[2];
                    break;
               case 2:
                    $nombre1 = $nombrebd[0];
                    $apellido1 = $nombrebd[1];
                    break;
               default:
                    break;
           }
           $personabd->readEnv();
           $personabd->request['nombre1']   = trim($nombre1);
           $personabd->request['nombre2']   = trim($nombre2);
           $personabd->request['apellido1'] = trim($apellido1);
           $personabd->request['apellido2'] = trim($apellido2);
           $personabd->addRecord();
        } else {
            $personabd = $persona->getPersona($personabd);
        }
        if(isset($_POST['check'])) {
           $_SESSION['patrocinio'] = true;
           $organizaciones->readEnv();
           $_SESSION['idorganizacion'] = $organizaciones->request['idorganizacion']; 
        }     
        $cliente = new clienteTable();
        $_REQUEST['idrecibo'] =  $recibo->getlastId();
        $_REQUEST['idpersona'] =  $personabd->getlastId();
        $cliente->readEnv();
        $cliente->addRecord(); 
        //evento       
        $evento = new evento();      
        $evento->request['tipoevento'] = "Registrar recibo";
        $evento->request['nombreusuario'] = $user->request['nombre']; 
        $evento->request['clave'] = $user->request['clave'];  
        $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
        $evento->request['descripcion'] = "Se ha registrado el recibo ".$recibo->getlastId()." del cliente: ".$_REQUEST['nombre']; 
        $evento->request['fechaocurrencia'] = date('Y-m-d');
        $evento->addRecord();
        if($_REQUEST['tipo'] == 'certificaciones') {
            header("Location: /modulos/tramites/solicitarcertificacion.php?idrecibo=".$recibo->getlastId());            
            $_SESSION['tipo'] = 'certificaciones';
        } elseif ($_REQUEST['tipo'] == 'inscripciones') {
            header("Location: /modulos/tramites/solicitarinscripcion.php?idrecibo=".$recibo->getlastId()); 
            $_SESSION['tipo'] = 'inscripciones';    
        }    
    }    
    $smarty->assign('titular',($_REQUEST['tipo'] != '') ? 'Nuevo Recibo Para Solicitudes  de '.$_REQUEST['tipo'] : 'Nuevo Recibo Para Solicitudes ');   
    $recibos = new recibo(); 
    $smarty->assign('tipotramite',$tipotramite);
    $smarty->assign('arrayFormapago',$arrayFormapago);
    $smarty->assign('numero',$recibos->getlastCodigo() + 1);
    $smarty->assign('arraySolicitud',$arraySolicitud);
    $smarty->assign('persona',$persona); 
    $smarty->assign('tipo',$_REQUEST['tipo']);
    $smarty->assign('nombrecliente',$nombrecliente); 
    $smarty->assign('arrayOrganizacion',$arrayOrganizacion);   
    $smarty->assign('template','pagos/editrecibo.tpl');
    $smarty->display('layout.tpl');    
       
} else {
   header("location: /login.php"); 
}

 
?>