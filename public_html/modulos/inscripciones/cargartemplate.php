<?php
include_once('../../common.inc.php');
   switch ($_REQUEST['valorcombo']) {
      case 'declarar mayor de edad':
         $encabezado = 'Datos del Declarado Mayor';
         $titulo = 'Declaracion de la mayoria de Edad';
      break; 
      case 'emancipar a un menor':
         $encabezado = 'Datos del Emancipado';
         $titulo = 'Emancipacion';
      break;    
      case 'otorgar la guarda':
         $encabezado = 'Datos de la Persona Sujeta a la Guarda';
         $titulo = 'De la Guarda'; 
      break;  
      case 'declarar ausente':
         $encabezado = 'Datos del Ausente';
         $titulo = 'Declaracion de Ausencia';   
      break; 
      case 'interdiccion civil':
         $encabezado = 'Datos de la Persona a la que se le suspenden sus derechos';
         $titulo = 'Interdiccion Civil'; 
      break; 
      case 'posesion notoria del estado':
         $encabezado = 'Datos de la Persona a la que se le suspenden sus derechos';
         $titulo = 'Posesion Notoria del Estado'; 
      break;        
      case 'identificacion notarial':
         $encabezado = 'Datos de la Persona a la que se le suspenden sus derechos';
         $titulo = 'Identificacion Notarial'; 
      break;    
      case 'cancelacion de asientos registrales':
         $encabezado = 'Datos de la Persona a la que se le Cancela el Asiento';
         $titulo = 'Cancelacion de Asientos Registrales'; 
      break;                                
   }    
   $smarty->assign('add','add'); 
   $smarty->assign('encabezado',$encabezado);
   $smarty->assign('titulo',$titulo);
   $smarty->display('inscripciones/_tipootrainscripcion.tpl');
 
?>
