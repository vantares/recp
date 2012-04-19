<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);      
if($usuario->checkCredenciales(array('Personas'))) { 
   $persona = new persona();
   $persona->request['municipionacimiento'] = 'Matagalpa';
   $persona->request['paisnacimiento'] = 'Nicaragua';
   $ciudadano = new ciudadano();   
   $smarty->assign('camino','>> Personas >> Nueva'); 
   $smarty->assign('template','personas/persona.tpl');       
   if((isset($_POST['salvar'])) && ($_POST['salvar'] == 'salvar')) { 
        //Actualizo persona 
        $_REQUEST['fechanacimiento'] = ($_REQUEST['fechanacimiento'] != '') ?  $_REQUEST['fechanacimiento'] : NULL;
        $persona->readEnv();
        try {
            $persona->addRecord();
        }
        catch (Persona $e) {
            $error = true; 
            $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
        }
        if(!$error) {
            $_REQUEST['idciudadano'] = $persona->getlastId();
            $ciudadano->readEnv();
            try {
                $ciudadano->addRecord();
            }
            catch (Asiento $e) {
                $error = true; 
                $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
            }            
        } 
        $smarty->assign('notice',(!$error) ? 'La persona fue registrada correctamente' : '<b>error:<b> La persona no se pudo registrar');
        $smarty->assign('class',(!$error) ? 'notice' : 'errornotice'); 
        if(!$error) {
            //Registro el evento
            $evento = new evento();
            $evento->request['tipoevento'] = 'Registrar Persona';
            $evento->request['nombreusuario'] = $usuario->request['nombre']; 
            $evento->request['clave'] = $usuario->request['clave'];  
            $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
            $evento->request['descripcion'] = 'Se registro una persona con cedula '.$_REQUEST['cedula']; 
            $evento->request['fechaocurrencia'] = date('Y-m-d');
            $evento->addRecord();
        }
        $smarty->display('layout.tpl');
        die;
   } 
   $smarty->assign('add','add'); 
   $smarty->assign('persona',$persona); 
   $smarty->assign('ciudadano',$ciudadano); 
   $smarty->display('layout.tpl');
} else {
    header("Location: ./login.php");
}   
?>
