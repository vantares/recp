<?php
include_once('../../common.inc.php'); 
/*echo $_REQUEST['inscripcionmatrimonio'];
die; */
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']); 
if($usuario->checkCredenciales(array('Inscripciones'))) {  
    if($_REQUEST['ajax'] == 1) {
        $inscripcion = new inscripcion();
        $inscripcionbd = $inscripcion->getInscripcion($_REQUEST['idinscripcionnacimiento']);        
        $acta = $inscripcionbd->getActa();
        $hechovital = $inscripcionbd->getHechoVital(); 
        $_REQUEST['nombrereconocido'] = $inscripcionbd->request['inscrito1nombre1'].' '.$inscripcionbd->request['inscrito1nombre2'].' '.$inscripcionbd->request['inscrito1apellido1'].' '.$inscripcionbd->request['inscrito1apellido2'];  
        $tomo = new tomo();
        $tomobd = $tomo->getTomo($acta->request['idtomo']);
        $_REQUEST['tomo'] = $tomobd->request['numero'];
        $_REQUEST['folio'] = $acta->request['folio'];
        $_REQUEST['partida'] = $acta->request['partida'];
        $fecha = explode('-',$acta->request['fecha']); 
        $_REQUEST['anyo'] = $fecha[0];
        $_REQUEST['fechanacimiento'] = $hechovital->request['fechanacimiento'];
        $_REQUEST['lugarnacimiento'] = $hechovital->request['municipionacimiento'];
        $_REQUEST['idinscripcion'] = $_REQUEST['inscripcionmatrimonio'];
        $reconocido = new reconocimiento();
        $reconocido->readEnv();
        try {
            $reconocido->addRecord();  
        }  
        catch (Reconocido $e) {
            $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
            $error = true;
        } 
        //Hijos Reconocidos 
        $reconocidos = new reconocimiento();
        $reconocidosbd = $reconocidos->getReconocidosByInscripcion($_REQUEST['inscripcionmatrimonio']); 
        $smarty->assign('reconocidosbd',$reconocidosbd); 
        $smarty->display('inscripciones/_listadoreconocidos.tpl');
    } else { 
        $_REQUEST['nombrereconocido'] = $_REQUEST['nombre1'].' '.$_REQUEST['nombre2'].' '.$_REQUEST['apellido1'].' '.$_REQUEST['apellido2'];      
        $_REQUEST['fechanacimiento'] = $_REQUEST['reconocidofechanacimiento'];                
        $reconocido = new reconocimiento();
        $reconocido->readEnv();
        try {
            $reconocido->addRecord();  
        }  
        catch (Reconocido $e) {
            $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
            $error = true;
        }
        if(!$error) {
            header("Location: /modulos/inscripciones/editmatrimonio.php?id=".$_POST['idinscripcion']);    
        }
   }        
} else {
    header("Location: ./login.php");
}    
?>
