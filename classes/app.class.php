<?
require_once('config.php');
#if(DB3===true)  require_once((defined('ALMIDONDIR')?ALMIDONDIR . '/php/':'').'db3.class.php');
#else  require_once((defined('ALMIDONDIR')?ALMIDONDIR . '/php/':'').'db2.class.php');
#require_once((defined('ALMIDONDIR')?ALMIDONDIR . '/php/':'').'Smarty/Smarty.class.php');
require_once('config.php');
$almidondir = defined('ALMIDONDIR') ? ALMIDONDIR : $_SERVER['DOCUMENT_ROOT'] . '/../../';
require_once($almidondir . '/php/almidon.php');
/*
$smarty = new Smarty;
$smarty->template_dir = ROOTDIR . '/templates/';
$smarty->compile_dir = ROOTDIR . '/templates_c/';
$smarty->config_dir = ROOTDIR . '/configs/';
$smarty->cache_dir = ROOTDIR . '/cache/';

# Crea links manualmente                                                                                
if (ADMIN === true) {
  $adminlinks['pagina.php'] = 'Paginas';
  $adminlinks['categoria.php'] = 'Categorias';
  $adminlinks['enlace.php'] = 'Enlaces';
  $adminlinks['doc.php'] = 'Documentos';
  $adminlinks['galeria.php'] = 'Galeria';
  $smarty->assign('adminlinks', $adminlinks);
}

require('tables.class.php');
require('extra.class.php');
*/
