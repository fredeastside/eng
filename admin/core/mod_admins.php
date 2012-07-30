<?php
if (!$admin->isLogined())
	die("Доступ запрещен!");

# Поля
$filds = array(
	'name'=>'Имя',
	'login'=>'Логин',
	'email'=>'email'
);

$globalTemplateParam -> set('filds', $filds);

$actions = array(
	'active',
	'edit',
	'delete'
);

$ignor_delete_security = true;
$globalTemplateParam->set('ignor_delete_security', $ignor_delete_security);

$globalTemplateParam -> set('actions', $actions);

	$absitem = new fmakeSiteAdministrator($request->id);
	
# Actions
switch($request->action)
{
	case 'insert':
	case 'update':
	case 'delete':
	case 'active':
	default:
		switch($request->action)
		{
			case 'insert': // Новый
				foreach ($_POST as $key=>$value){
					if(($key == "password" && !$value)) continue;
					else if(($key == "password" && $value)) $value = md5($value);
					$absitem ->addParam($key, $value );
				}
				$absitem -> newItem();
			break;
		
			case 'update': // Переписать
				foreach ($_POST as $key=>$value){
					if(($key == "password" && !$value)) continue;
					else if(($key == "password" && $value)) $value = md5($value);
					$absitem ->addParam($key, $value );
				}
				$absitem -> update();
			break;
		
			case 'delete': // Удалить
				$absitem -> delete();
			break;
		
			case 'active': // Включить/выключить
				$absitem -> active();
			break;
		}
		$items = $absitem->getRoleObj()->getRols();
		
		
		for($i=0;$i<sizeof($items);$i++){
			$items[$i]['users'] = $absitem->getByRole($items[$i][$absitem->getRoleObj()->idField]);
		}
		
		//printAr($items);
		$globalTemplateParam -> set('items', $items);
		global $template; 
		$template = $block;
		
	break;

	case 'edit': // Если редактировать то покажем картинку
		$items = $absitem -> getInfo();
		
	case 'new': // Далее форма
		$rols = $absitem->getRoleObj()->getRols();
		
		//printAr($rols);
		$form = new utlFormEngine($modul, "/admin/index.php?modul=".$request->modul);
		$form->addHidden("action", (($request->action == 'new')?'insert':'update'));
		$form->addHidden("id", $items['id']);
		
		$_modul = $form->addSelect("Тип", "role");
		//$_modul->AddOption(new selectOption(0, "Без Отдела", (($items['role']==0)? true : false )));
		
		if($rols) foreach ($rols as $modul)
		{
			$_modul->AddOption(new selectOption($modul['id'], blankprint($modul['level']).$modul['role'], (($modul['id']==$items['role'])? true : false )));
		}
		$form->AddElement($_modul);
		
		
		foreach ($filds as $key=>$fild)
			$form->addVarchar($fild, $key, $items[$key]);

		//$form->addVarchar("Тип", "type", $items['type']);
		$form->addVarchar("Пароль", "password", "");
		$form->addSubmit("save", "Сохранить");
		$content .= $form->printForm();
		$globalTemplateParam -> set('content', $content);
		global $template; 
		$template = "admin/edit/simple_edit.tpl";
	break;
}
?>