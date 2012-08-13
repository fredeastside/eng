<?php

/* ------------вспомогательные функции----------------- */
/* написание функции */

function sendLetter($email, $msg) {
        $msg = trim(nl2br($msg));
    
    	$mail = new PHPMailer();
        $mail->From = 'support@engels.bz';
        $mail->FromName = 'SUPPORT';
        $mail->AddAddress($configs->email);
        $mail->Subject = "Сообщение с сайта engels.bz";
        $mail->Body = "<b>E-mail:</b> $email<br/><b>Сообщение:</b> $msg";
        $mail->isHTML(true);
        $mail->Send();
    //$newContent = "Value of \$arg: ".$arg;
    // Instantiate the xajaxResponse object
    //$objResponse = new xajaxResponse();
    // add a command to the response to assign the innerHTML attribute of
    // the element with id="SomeElementId" to whatever the new content is
    //$objResponse->assign("SomeElementId","innerHTML", $newContent);
    //return theВ  xajaxResponse object
    //return $objResponse;
    return true;
}

/* написание функции */
/* ------------вспомогательные функции----------------- */

require_once (ROOT . "/fmake/libs/xajax/xajax_core/xajax.inc.php");
//$xajax = new xajax();
$xajax = new xajax();
$xajax->configure('decodeUTF8Input', true);
//$xajax->configure('debug',true);
$xajax->configure('javascript URI', '/libs/xajax/');

/* регистрация функции */
$xajax->register(XAJAX_FUNCTION, "sendLetter");
/* регистрация функции */



$xajax->processRequest();
$globalTemplateParam->set('xajax', $xajax);