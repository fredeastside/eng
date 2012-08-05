<?php

if (!$admin->isLogined())
    die("Доступ запрещен!");

$flag_url = true;

# Поля
$filds = array(
    'title' => 'Название',
);

$globalTemplateParam->set('filds', $filds);

$ignor_delete_security = true;
$globalTemplateParam->set('ignor_delete_security', $ignor_delete_security);

$absitem = new fmakeNews();
$absitem->setId($request->id);
$absitem->tree = false;

$news_categories_obj = new fmakeNewsCategories();
$news_categories = $news_categories_obj->getAll();
//printAr($news_categories);

$actions = array('active',
    'edit',
    'delete',
    'move');
$globalTemplateParam->set('actions', $actions);

# Actions
switch ($request->action) {
    case 'up':
    case 'down':
    case 'insert':
    case 'update':
    case 'delete':
    case 'index':
    case 'inmenu':
    case 'active':
    default:
        switch ($request->action) {
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
				
				$_POST['date'] = $absitem->getDate($_POST['date']);
				
                foreach ($_POST as $key => $value)
                    $absitem->addParam($key, mysql_real_escape_string($value));

                $absitem->newItem();
                
                if($_FILES['picture']['tmp_name'])
                    $absitem->addFile($_FILES['picture']['tmp_name'], $_FILES['picture']['name']);

                break;

            case 'update': // Переписать

				$_POST['date'] = $absitem->getDate($_POST['date']);
				
                foreach ($_POST as $key => $value)
                    $absitem->addParam($key, mysql_real_escape_string($value));

                $absitem->update();
                
                if($_FILES['picture']['tmp_name'])
                    $absitem->addFile($_FILES['picture']['tmp_name'], $_FILES['picture']['name']);
                
                break;

            case 'delete': // Удалить
                $absitem->delete();
                break;
        }

        $items = $absitem->getAll();


        $globalTemplateParam->set('items', $items);
        global $template;
        $template = $block;
        include('content.php');
        break;
    case 'edit':
        $items = $absitem->getInfo();
    case 'new': // Далее форма

        $form = new utlFormEngine($modul, "/admin/index.php?modul=" . $request->modul, "POST", "multipart/form-data");

        $form->addHidden("action", (($_GET['action'] == 'new') ? 'insert' : 'update'));
        $form->addHidden("id", $items['id']);

        $form->addVarchar("<b>Название</b>", "name", $items["name"]);
		$form->addVarchar("<i>Заголовок</i>", "title", $items["title"]);
		$form->addVarchar("<i>Описание</i>", "description", $items["description"]);
		$form->addVarchar("<i>URL</i>", "redir", $items["redir"]);
        
        $_select = $form->addSelect("Категория", "id_category");
        //$_select->AddOption(new selectOption("", "", false));
        foreach($news_categories as $category){
            $_select->AddOption(new selectOption($category['id'], $category['title'], (($category['id'] == $items['id_category'] || ($request->action=='new' && $file=='mod_text') )? true : false )));
        }
        
        $form->AddElement($_select);
		
        $form->addVarchar("Дата (ДД.ММ.ГГГГ)", "date", $absitem->setDate($items['date']));
        if($items['picture'])
            $form->addHtml("", "<tr><td colspan='2'><img src='/{$absitem->fileDirectory}{$items['id']}/vm{$items['picture']}' /></td></tr>");
        $form->addFile("Фото:", "picture",$text = false);
        $form->addTextArea("Анонс", "anons", $items["anons"], 50, 50);
        
        $form->addCheckBox("Главная новость", "in_main", $items["main"], true);
        $form->addHidden("main", "1");
        
        $form->addFCKEditor("Текст", "text", $items["text"]);

        $form->addSubmit("save", "Сохранить");
        $content .= $form->printForm();

        $globalTemplateParam->set('content', $content);
        $block = "admin/edit/simple_edit.tpl";
        global $template;
        $template = $block;
        break;
}
?>
