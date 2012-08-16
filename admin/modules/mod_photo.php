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

$absitem = new fmakePhotoReports();
$absitem->setId($request->id);
$absitem->tree = false;

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
        
        //галлерея
		$fmakeGalleryNotice = new fmakeGallery();
		$fmakeGalleryNotice->table = $fmakeGalleryNotice->table_notice_galley;
		$fmakeGalleryNotice->idField = 'id_site_modul';
		$fmakeGalleryNotice->setId($request->id);
		$do_gallery = $fmakeGalleryNotice->getInfo();
		$fmakeGallery = new fmakeGallery();
		$fmakeGallery->setId($do_gallery['id_gallery']);
		$item_gallery = $fmakeGallery->getInfo();
		//
                
                $content .= '<script type="text/javascript" src="/js/gallery/admin-gallery.js"></script>';

        $form = new utlFormEngine($modul, "/admin/index.php?modul=" . $request->modul, "POST", "multipart/form-data");

        $form->addHidden("action", (($_GET['action'] == 'new') ? 'insert' : 'update'));
        $form->addHidden("id", $items['id']);

        $form->addVarchar("<b>Название</b>", "name", $items["name"]);
		$form->addVarchar("<i>Заголовок</i>", "title", $items["title"]);
		$form->addVarchar("<i>Описание</i>", "description", $items["description"]);
		$form->addVarchar("<i>URL</i>", "redir", $items["redir"]);

		
        $form->addVarchar("Дата (ДД.ММ.ГГГГ)", "date", $absitem->setDate($items['date']));
        if($items['picture'])
            $form->addHtml("", "<tr><td colspan='2'><img src='/{$absitem->fileDirectory}{$items['id']}/vm{$items['picture']}' /></td></tr>");
        $form->addFile("Основное фото:", "picture",$text = false);
        
        $form->addCheckBox("Главный репортаж", "in_main", $items["main"], true);
        $form->addHidden("main", "1");
        
        /*-----------------галлерея----------------------*/
		if($items){
			if($item_gallery){
				$form->addHtml('','<td colspan="2"><a class="action-link" onclick="return false;" id="link-gallery" href="../../fmake/modules/core/fmakeGallery/index.php?id_gallery='.$item_gallery['id'].'"><div><img alt="" src="/images/admin/and.png"></div>Изменить галерею</a> <div style="padding-top: 6px;">'.$item_gallery[caption].'</div><td>');
			}
			else{
				$form->addHtml('','<td colspan="2"><a class="action-link" onclick="return false;" id="link-gallery" href="../../fmake/modules/core/fmakeGallery/index.php?id_gallery='.$item_gallery['id'].'&id_content='.$items['id'].'"><div><img alt="" src="/images/admin/and.png"></div>Добавить галерею</a> <td>');
			}
		}
		else{
			$form->addHtml('','<td colspan="2">Для добавления галереи сохраните страницу<td>');
		}
		
		$form->addHtml("", '<td colspan="2">
<div id="iframe-pole" style="position: fixed; top:100px; left: 136px;z-index: 9999999;width: 800px; min-height: 500px;display: none;"></div></td>');
		/*-----------------галлерея----------------------*/
        
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
