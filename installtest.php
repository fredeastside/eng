<?php 
header('Content-type: text/html; charset=utf-8'); 
setlocale(LC_ALL, 'ru_RU.UTF-8');
mb_internal_encoding('UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);


require('./fmake/FController.php');

$modul->template = "/admin/install.tpl";


$installer = new fmakeInstaller();
if($_FILES['modul']['tmp_name'])
	$installer -> installModule($_FILES['modul']['tmp_name']);


$template = $twig->loadTemplate($modul->template);
$template->display($globalTemplateParam->get());