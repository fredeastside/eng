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

//printAr($_REQUEST);
$modul = new fmakeSiteModule();
//printAr($_COOKIE);
$url = $request -> getEscape('url') ? $request -> getEscape('url') : $request -> getEscape('modul');
$url = explode('/', $url);
$url = $url[0];

$modul->getPage($request -> getEscape('modul') , $twig, $url);
//добавляем каталог к основным модулям
$menu = $modul->getAllForMenuSite(0, true,$q=е,$flag=true,true);
//printAr($menu);
$globalTemplateParam->set('menu',$menu);
$globalTemplateParam->set('url',$url);
$globalTemplateParam->set('modul',$modul);

$news_obj = new fmakeNews();
$news = $news_obj->getNews(true);
$news_url = $news_obj->getUrlNews();
$globalTemplateParam->set('news_url',$news_url);
$globalTemplateParam->set('news',$news);

$incidents_obj = new fmakeIncidents();
$incidents = $incidents_obj->getIncidents();
$incident_url = $incidents_obj->getUrlIncident();
$globalTemplateParam->set('incident_url',$incident_url);
$globalTemplateParam->set('incidents',$incidents);

$modul->template = "base/main.tpl";

if($modul->file){
	include($modul->file.".php");
} 


$template = $twig->loadTemplate($modul->template);
$template->display($globalTemplateParam->get());
