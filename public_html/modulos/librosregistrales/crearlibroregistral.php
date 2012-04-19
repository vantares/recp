<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);
if($usuario->checkCredenciales(array('Libros Registrales', 'Crear Libro Registral'))) {
    $libroregistral = new libroregistral(); 
    $smarty->assign('codigo',$libroregistral->getCodigo());
    $smarty->assign('anyo',date('Y'));
    if(isset($_POST['abrir']) && $_POST['abrir'] == 1) {  
       //abro el libro registral
       $ok = false;
       $libroregistral->readEnv();
       $libroregistral->addRecord();
       $ok = true;
       $smarty->assign('notice',($ok) ? 'El libro fue creado correctamente' : '<b>error:<b> El libro no se pudo crear');
       $smarty->assign('class',($ok) ? 'notice' : 'errornotice');
       //Registro el evento
       $evento = new evento();
       $evento->request['tipoevento'] = 'crear libro registral';
       $evento->request['nombreusuario'] = $usuario->request['nombre']; 
       $evento->request['clave'] = $usuario->request['clave'];  
       $evento->request['cliente'] = $_SERVER['REMOTE_ADDR']; 
       $evento->request['descripcion'] = 'Se creo un nuevo libro registral con codigo '.$libroregistral->getlastId(); 
       $evento->request['fechaocurrencia'] = date('Y-m-d');
       $evento->addRecord();             
    }    
    $smarty->assign('titular','Nuevo libro registral'); 
    $smarty->assign('template','librosregistrales/abrirlibroregistral.tpl');
    $smarty->assign('camino','>> Libro Registrales >> Crear Libro'); 
    $rubros = new rubro(); //obtengo los rubros
    foreach($rubros->getAll() as $rubro) {
        if(!$libroregistral->checkRubro($rubro['idrubro'])) {
           $arrayRubros[] =  $rubro;  
        }    
    } 
    $smarty->assign('arrayRubros',$arrayRubros); 
    if(!is_array($arrayRubros)) {
        $smarty->assign('notice', '<b>error:<b> Ya no existen mas libros registrales definidos para abrir');
        $smarty->assign('class','errornotice'); 
    }    
    $smarty->display('layout.tpl'); 
} else {
    header("Location: ./login.php"); 
}              
?> 