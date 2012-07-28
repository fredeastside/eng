<?php

if (!$admin->isLogined())
	die("Доступ запрещен!");

# Поля
$filds = array(
//	 'parent'=>'Родитель',
	 'role'=>'Роль',
	 //'caption' => 'Название'

);

$globalTemplateParam->set('filds', $filds);

	$admin = new fmakeSiteAdministrator($request->id);
	$absitem = $admin->getRoleObj();
	
$actions = array( 'active', 'edit', 'delete');
$globalTemplateParam->set('actions', $actions);

$ignor_delete_security = true;
$globalTemplateParam->set('ignor_delete_security', $ignor_delete_security);

$absitem->setId($request->id);
$absitem->tree = false;
# Actions
switch($request->action)
{
	case 'up':
	case 'down':
	case 'insert':
	case 'update':
	case 'delete':
	case 'index':
	case 'inmenu':
	case 'active':
	default:
		switch($request->action)
		{
			case 'index':
				$absitem->setIndex();
			break;

			case 'inmenu':
			case 'active':
				$absitem->setEnum($request->action);
			break;

			case 'up': // Вверх 
				$absitem->getUp();
			break;

			case 'down': // Вниз
				$absitem->getDown();
			break;

			case 'insert': // Новый
				
				foreach ($_POST as $key=>$value)
					$absitem ->addParam($key, $value);
					
				$absitem -> newItem();
				
				
			break;
		
			case 'update': // Переписать
				foreach ($_POST as $key=>$value)
					$absitem ->addParam($key, $value);
				$absitem -> update();

				//echo $_FILES['icon']['tmp_name'];
				//printAr($_FILES);
			break;
		
			case 'delete': // Удалить
				$absitem -> delete();
			break;
			
		}

		$items = $absitem -> getAll();
		$globalTemplateParam->set('items', $items);
		global $template;
		$template = $block;
		include('content.php');
	break;
	case 'delimg':
		$absitem -> deleteImage($name = 'icon.png');
	case 'edit':
		$items = $absitem -> getInfo();
	case 'new': // Далее форма

		$form = new utlFormEngine($modul, "/admin/index.php?modul=".$request->modul, "POST", "multipart/form-data");
	
		$form->addHidden("action", (($_GET['action'] == 'new')?'insert':'update'));
		$form->addHidden("id", $items['id']);

		foreach ($filds as $key=>$fild)
		{
			if($key == 'file') continue;
			$form->addVarchar($fild, $key, (($key == 'date' && $_GET['action'] == 'new')? date("Y-m-d") : $items[$key]));
		}


		$form->addSubmit("save", "Сохранить");
		$content .= $form->printForm();
		$globalTemplateParam->set('content', $content);
		global $template; 
		$template = "admin/edit/simple_edit.tpl";
		
	break;
}
?>