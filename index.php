<?php
header('Content-type: text/html; charset=utf-8'); 
setlocale(LC_ALL, 'ru_RU.UTF-8');
mb_internal_encoding('UTF-8');
ini_set('display_errors',1);
error_reporting(7);
//error_reporting(E_ALL);


require('./fmake/FController.php');
require './fmake/libs/function_xajax.php';
//require('./fmake/libs/login.php');

$modul = new fmakeSiteModule();

$url = $request -> getEscape('url') ? $request -> getEscape('url') : $request -> getEscape('modul');
$url = explode('/', $url);
$url = $url[0];

$modul->getPage($request -> getEscape('modul') , $twig, $url);
//добавляем каталог к основным модулям
$menu = $modul->getAllForMenuSite(0, true,$q=е,$flag=true,true);

$globalTemplateParam->set('menu',$menu);
$globalTemplateParam->set('url',$url);
$globalTemplateParam->set('modul',$modul);

$modul->template = "base/main.tpl";

if($modul->file){
	include($modul->file.".php");
} 

$template = $twig->loadTemplate($modul->template);
$template->display($globalTemplateParam->get());