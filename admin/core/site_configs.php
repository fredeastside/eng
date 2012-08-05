<?php
if (!$admin->isLogined())
	die("Доступ запрещен!");
	
	$absitem = new globalConfigs();
	
	//$configs = $absitem->getSiteConfigs();
	//printAr($configs);
	
	switch($request->action){
		case 'change':
			//echo "qq";
			foreach ($_POST['configs'] as $key=>$value){
				$absitem ->udateByValue($key, $value);
			}
		break;
		case 'new':
			foreach ($_POST as $key=>$value){
				$absitem ->addParam($key, $value);
			}
			$absitem -> newItem();
		break;
	}
	
	
# Поля
	$form = new utlFormEngine($modul, "/admin/index.php?modul=".$request->modul);
	$form->formLegend = "Основные параметры";
	$form->addHidden("action", 'change');
	$form->addVarchar("<em><b>Телефон</b></em>", "configs[phone1]",$configs->phone1,50,false,"Используется на основных страницах сайта и в футере");
	$form->addVarchar("<em><b>Емайл</b></em>", "configs[email]",$configs->email,50,false,"Используется на основных страницах сайта и в футере, а так же для рассылки и оповещения с сайта");
        
        $form->addVarchar("<em>Количество новостей<em>", "configs[news_count]",$configs->news_count,20,false,"Количество новостей, выводимых на странице");
	
	$form->addSubmit("Добавить","Обновить");
	$content = $form->printForm();
	
	
	$form = new utlFormEngine($modul, "/admin/index.php?modul=".$request->modul);
	$form->formLegend = "Текстовые блоки";
	$form->addHidden("action", 'change');
	$form->addTinymce("<em>Главный баннер</em><br />", "configs[main_banner]",$configs->main_banner,"Главный баннер");
	$form->addTinymce("<em>Баннер справа</em><br />", "configs[right_block]",$configs->right_block,"Баннер справа");
	$form->addTinymce("<em>Баннер слева</em><br />", "configs[left_block]",$configs->left_block,"Баннер слева");
	$form->addTinymce("<em>Футер</em><br />", "configs[footer]",$configs->footer,"Футер");
	
	$form->addSubmit("Добавить","Обновить"); 
	$content .= $form->printForm();
	
	$globalTemplateParam -> set('content', $content);
	global $template;
	$template = "admin/edit/simple_edit.tpl";
?>