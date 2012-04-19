<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);
     
if($usuario->checkCredenciales(array('Personas'))) { 
    if($_REQUEST['id'] > 0) {
        $smarty->assign('camino','>> Personas >> Editando');  
        $smarty->assign('template','personas/persona.tpl');
        $persona = new persona();
        $pesonabd = $persona->getPersona($_REQUEST['id']);
        $ciudadanobd = $pesonabd->getCiudadano();          
        if((isset($_POST['salvar'])) && ($_POST['salvar'] == 'salvar')) { 
            //Actualizo persona  
            $_REQUEST['fechanacimiento'] = ($_REQUEST['fechanacimiento'] != '') ?  $_REQUEST['fechanacimiento'] : NULL;   
            $persona->readEnv();
            try {
                $persona->updateRecord();
            }    
            catch (Persona $e) {
                $error = true; 
                $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
            }  
            if(!$error) {
                
                $_REQUEST['idciudadano'] = $persona->request['idpersona'];
                try {
                    if($ciudadanobd->request['idciudadano'] != '') {
                        $ciudadanobd->readEnv();
                        $ciudadanobd->updateRecord();
                    } else {
                        $ciudadanobd = new ciudadano();
                        $ciudadanobd->readEnv();
                        $ciudadanobd->addRecord();
                    }    
                }    
                catch (Persona $e) {
                    $error = true; 
                    $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                }                 
            }  
            $smarty->assign('notice',(!$error) ? 'La persona fue actualizada correctamente desea volver a editar pinche <a href="/modulos/personas/editpersona.php?id='.$persona->request['idpersona'].'"><b>aqui</b></a>' : '<b>error:<b> La persona no se pudo actualizar');
            $smarty->assign('class',(!$error) ? 'notice' : 'errornotice'); 
            if(!$error) {
                //Registro el evento
                $evento = new evento();
                $evento->request['tipoevento'] = 'Actualizar Persona';
                $evento->request['nombreusuario'] = $usuario->request['nombre']; 
                $evento->request['clave'] = $usuario->request['clave'];  
                $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
                $evento->request['descripcion'] = 'Se actualizo la persona con cedula '.$_REQUEST['cedula']; 
                $evento->request['fechaocurrencia'] = date('Y-m-d');
                $evento->addRecord();
            }
        }
        $smarty->assign('persona',$persona); 
        $smarty->assign('ciudadano',$ciudadanobd); 
        $smarty->assign('disabled',($_REQUEST['detalle'] == 1) ? 'disabled=disabled' : ''); 
        $smarty->display('layout.tpl');  
        
    }           
} else {
    header("Location: ./login.php");
}    
?>
