<?php
header('Content-type: text/html; charset=utf-8'); 
setlocale(LC_ALL, 'ru_RU.UTF-8');
mb_internal_encoding('UTF-8');
ini_set('display_errors',1);
error_reporting(7);


require('./fmake/FController.php');
require './fmake/libs/function_xajax.php';
//require('./fmake/libs/login.php');

switch ($request->action){
	case 'feedback':
		$fmakeFeedback = new fmakeFeedback();
		$error = false;
		if(!trim($request ->email) || !ereg("^([-a-zA-Z0-9._]+@[-a-zA-Z0-9.]+(\.[-a-zA-Z0-9]+)+)*$", $request ->email)) $error['email'] = "Некорректный Email";
		if($fmakeFeedback->isEmail(trim($request ->email))) $error['duble'] = "Данный email уже записан";
		if(!$error){
			$fmakeFeedback->addParam("email",$request->email);
			$fmakeFeedback->newItem();
			$message = "Ты узнаешь первым!";
			$globalTemplateParam->set('message',$message);
		}else {
			$globalTemplateParam->set('errors',$error);
		}
		
		break;
}


$modul = new fmakeSiteModule();
//printAr($_COOKIE);
//добавляем каталог к основным модулям
$menu = $modul->getAllForMenu(0, true,$q=false,$flag=true,true);
//printAr($menu);
$globalTemplateParam->set('menu',$menu);

$modul->getPage($request -> getEscape('modul') ,$twig);
$globalTemplateParam->set('modul',$modul);

//printAr($_POST);

$modul->template = "base/main.tpl";

if($modul->file){
	include($modul->file.".php");
} 


$template = $twig->loadTemplate($modul->template);
$template->display($globalTemplateParam->get());
