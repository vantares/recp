<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);      
if($usuario->checkCredenciales(array('Personas'))) { 
    if(isset($args[1]) && $args[1] > 0) {
        $smarty->assign('camino','>> Personas >> Editando');  
        $smarty->assign('template','personas/persona.tpl');
        if((isset($_POST['salvar'])) && ($_POST['salvar'] == 'salvar')) { 
            //Actualizo persona  
            $persona = new persona();   
            $persona->readEnv();
            try {
                $persona->updateRecord();
            }    
            catch (Persona $e) {
                $error = true; 
                $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
            }  
            if(!$error) {
                $ciudadano = new ciudadano();
                $_REQUEST['idciudadano'] = $persona->request['idpersona'];
                $ciudadano->readEnv();
                try {
                    $ciudadano->updateRecord();
                }    
                catch (Persona $e) {
                    $error = true; 
                    $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                }                 
            }  
            $smarty->assign('notice',(!$error) ? 'La persona fue actualizada correctamente desea volver a editar pinche <a href="/modulos/personas/editpersona.php/'.$persona->request['idpersona'].'"><b>aqui</b></a>' : '<b>error:<b> La persona no se pudo actualizar');
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
            $smarty->display('layout.tpl');
            die;
        }
        $persona = new persona();
        $pesonabd = $persona->getPersona($args[1]);
        $ciudadano = $pesonabd->getCiudadano();    
        $smarty->assign('persona',$persona); 
        $smarty->assign('ciudadano',$ciudadano); 
        $smarty->assign('disabled',((isset($args[2])) && ($args[2] == 1)) ? 'disabled=disabled' : ''); 
        $smarty->display('layout.tpl');  
        
    }           
} else {
    header("Location: ./login.php");
}    
?>
