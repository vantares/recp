<?php
include_once('../../common.inc.php');
include_once(MODULOSDIR.'menucomponent.php');
$usuarios = new usuario();
$usuario = $usuarios->getUser($_SESSION['idusuario']);
if($usuario->checkCredenciales(array('Libros Registrales','Listar Libros'))) {
   $libroregistral = new libroregistral();
   $arrayLibros = $libroregistral->readData();
   if(is_array($arrayLibros)) {     
       foreach($arrayLibros as $key => $libro) {
           $libroregistralbd = $libroregistral->getLibro($libro['idlibro']);
           $libro['cantlibro'] = $libroregistralbd->getCantTomos();
           $libro['ultimotomo'] = $libroregistralbd->getUltimoTomo();
           $libro['rubro'] = $libroregistralbd->getNomRubro();
           $arrayLibros[$key] = $libro;
       }
   }
   $smarty->assign('idrubro',$idrubro); 
   $smarty->assign('titular','Listado de Libros Registrales'); 
   $smarty->assign('arrayLibros', $arrayLibros); 
   $smarty->assign('template','librosregistrales/listadolibros.tpl');
   $rubros = new rubro(); //obtengo los rubros
   $smarty->assign('camino','>> Libro Registrales >> Listado'); 
   $smarty->display('layout.tpl');

} else {
    header("Location: ./login.php");
} 
?> 