<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);      
if($usuario->checkCredenciales(array('Gestionar Tomos', 'Nuevo Tomo', 'Edit Tomo', 'Cerrar Tomo'))) { 
    $smarty->assign('template','tomos/cerrartomo.tpl');
    if((isset($_POST['cerrar'])) && ($_POST['cerrar'] == 'cerrar')) {
       $error = false;
       //Asiento la inscripcion
       $cierre = new cierre();
       $cierre->readEnv();
       try {
            $cierre->addRecord();
       }
        catch (Exception $e) {
            $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
            $error = true;
        }
        if(!$error) {  
           //Adiciono Indice
           $indice = new indice();
           $indice->readEnv(); 
           try {
                $indice->addRecord();
           }
            catch (Exception $e) {
                $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                $error = true;
            } 
            if(!$error) {                  
               //Creo los Indices del Tomo
               $tomo = new tomo();
               $tomobd = $tomo->getTomo($_REQUEST['idtomo']);
               $tomobd->CrearIndices($tomobd->request['idtomo']);
               $tomo = new tomo();
               $tomo->request['idtomo'] = $tomobd->request['idtomo'];
               $tomo->request['estado'] = 'cerrado';
               $tomo->request['numero'] = $tomobd->request['numero'];
               $tomo->request['idlibro'] = $tomobd->request['idlibro']; 
               $tomo->request['anyo'] = $tomobd->request['anyo'];
               try {
                    $tomo->updateRecord();
               }
                catch (Exception $e) {
                    $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                    $error = true;
               }
           }
        }
        $smarty->assign('notice',(!$error) ? 'Se cerro el libro correctamente<br> Se creo el indice correspondiente' : '<b>error:<b> El libro no se pudo cerrar');
        $smarty->assign('class',(!$error) ? 'notice' : 'errornotice'); 
        if(!$error) {
            //Registro el evento
            $evento = new evento();
            $evento->request['tipoevento'] = 'Cerrar Tomo';
            $evento->request['nombreusuario'] = $usuario->request['nombre']; 
            $evento->request['clave'] = $usuario->request['clave'];  
            $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
            $evento->request['descripcion'] = 'Se cerro el tomo '.$tomobd->getNumero().' del libro '.$tomobd->getRubro(); 
            $evento->request['fechaocurrencia'] = date('Y-m-d');
            $evento->addRecord();
        }
        $smarty->display('layout.tpl'); 
        die;                                
    }      
    $tomo = new tomo();
    $tomobd = $tomo->getTomo($args[1]);
    if($tomobd){
        if($tomobd->request['estado'] == 'abierto') {
            $libroregistral = new libroregistral();
            $libroregistralbd = $libroregistral->getLibro($tomobd->request['idlibro']);
            $smarty->assign('titular','Cierre del Tomo numero '.$tomobd->request['idtomo'].' del libro '.$libroregistralbd->getNomRubro());
            $smarty->assign('fechacierre',date('Y-m-d'));
            $smarty->assign('Secretarios',$usuario->getUsersByRol('secretario'));
            $smarty->assign('Registradores',$usuario->getUsersByRol('registrador')); 
            $smarty->assign('idtomo',$tomobd->request['idtomo']);
         
        } else {
            $smarty->assign('notice', '<b>error:<b> El tomo no esta abierto');
            $smarty->assign('class','errornotice'); 
            $smarty->display('layout.tpl'); 
            die;         
        }    
    } else {
        $smarty->assign('notice', '<b>error:<b> No existe ese tomo abierto asegurese de que existe y que este abierto');
        $smarty->assign('class','errornotice');
        $smarty->display('layout.tpl'); 
        die;       
    } 
    
    $smarty->display('layout.tpl');      
} else {
    header("Location: ./login.php");
}    
?>
