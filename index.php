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
/*
$xajax = new xajax();

$xajax->registerFunction("myFunction");

function myFunction($arg)
{
    // do some stuff based on $arg like query data from a database and
    // put it into a variable like $newContent
    $newContent = "Value of \$arg: ".$arg;

    // Instantiate the xajaxResponse object
    $objResponse = new xajaxResponse();

    // add a command to the response to assign the innerHTML attribute of
    // the element with id="SomeElementId" to whatever the new content is
    $objResponse->assign("SomeElementId","innerHTML", $newContent);

    //return theВ  xajaxResponse object
    return $objResponse;
}

$xajax->processRequest();
*/
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

$modul->template = "base/main.tpl";

if($modul->file){
	include($modul->file.".php");
} 

$template = $twig->loadTemplate($modul->template);
$template->display($globalTemplateParam->get());