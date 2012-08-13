<?php
/*------------вспомогательные функции-----------------*/
	/*написание функции*/
		function func($arg){
			$newContent = "Value of \$arg: ".$arg;

			// Instantiate the xajaxResponse object
			$objResponse = new xajaxResponse();

			// add a command to the response to assign the innerHTML attribute of
			// the element with id="SomeElementId" to whatever the new content is
			$objResponse->assign("SomeElementId","innerHTML", $newContent);

			//return theВ  xajaxResponse object
			return $objResponse;
		}
	/*написание функции*/
/*------------вспомогательные функции-----------------*/

require_once (ROOT."/fmake/libs/xajax/xajax_core/xajax.inc.php");
	//$xajax = new xajax();
	$xajax = new xajax();
	$xajax->configure('decodeUTF8Input',true);
	//$xajax->configure('debug',true);
	$xajax->configure('javascript URI','/libs/xajax/');

	/*регистрация функции*/
		$xajax->register(XAJAX_FUNCTION,"func");
	/*регистрация функции*/
	

	
	$xajax->processRequest();
	$globalTemplateParam->set('xajax', $xajax);