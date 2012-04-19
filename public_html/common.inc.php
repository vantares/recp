<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/../classes/config.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/../classes/app.class.php');
if((LOGIN != 1) && (!$_SESSION['autenticacion'])) {
   header("Location: /login.php?refer=" . rawurlencode($_SERVER['HTTP_REFERER']));
   die;
}
$args = explode("/", $_SERVER['PATH_INFO']);
?>