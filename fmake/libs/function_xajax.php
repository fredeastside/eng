<?php
/*------------вспомогательные функции-----------------*/

/*------------вспомогательные функции-----------------*/

require_once (ROOT."/fmake/libs/xajax/xajax_core/xajax.inc.php");
	//$xajax = new xajax();
	$xajax = new xajax("http://".$hostname."/index.php");
	$xajax->configure('decodeUTF8Input',true);
	//$xajax->configure('debug',true);
	$xajax->configure('javascript URI','/libs/xajax/');

	/*регистрация функции*/
		//$xajax->register(XAJAX_FUNCTION,"func");
	/*регистрация функции*/
	
	/*написание функции*/
		/*function func(){
		
		}*/
	/*написание функции*/
	
	$xajax->processRequest();
	$globalTemplateParam->set('xajax', $xajax);