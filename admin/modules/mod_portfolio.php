<?php

if (!$admin->isLogined())
	die("Доступ запрещен!");

function setGeneralParent($from,$to){
	$from = (int)$from;
	$to = (int)$to;
	$absitem = new fmakeSiteModule();
	
	$absitem->setGeneralParent($from,$to);
		
	$xajax = new xajax();
	$objResponse = new xajaxResponse('utf8');
	return $objResponse->getXML();
}	
	
function setParent($child,$parent){
	$child = (int) $child ;
	$parent = (int) $parent;
	
	$absitem = new fmakeSiteModule();
	$absitem->setParent($child,$parent);
	$xajax = new xajax();
	
	$objResponse = new xajaxResponse('utf8');
	//$objResponse->addScript("alert(".$child.")");
	return $objResponse->getXML();
}
require_once (ROOT."/libs/xajax/xajax_core/xajax.inc.php");
$xajax = new xajax();
$xajax->setCharEncoding('utf8');
//$xajax->debugOn();
$xajax->registerFunction("setGeneralParent");
$xajax->registerFunction("setParent");
$xajax->processRequest();
$globalTemplateParam->set('xajax', $xajax);

$flag_url = true;
$ignor_delete_security = true;
$globalTemplateParam->set('ignor_delete_security', $ignor_delete_security);

# Поля
$filds = array(
//	 'parent'=>'Родитель',
	 'caption'=>'Название'
//	 'text'=>'Текст',
//	 'redir'=>'url',
//	 'file'=>'Шаблон'
);

$globalTemplateParam->set('filds', $filds);



$absitem = new fmakePortfolio();
$typesite = new fmakePortfolio_typesite();
	
	

	
	$actions = array('move', 'inmenu', 'active', 'edit', 'delete');
	$globalTemplateParam->set('actions', $actions);


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
				if($_POST['caption']==''){
					$_POST['caption']=$_POST['title'];
				}
				foreach ($_POST as $key=>$value){
					if($key=='text') $absitem ->addParam($key, mysql_real_escape_string($value));
					else $absitem ->addParam($key, $value);
				}
				/*if($_FILES['item_file']['tmp_name']){
					$absitem->addParam('images', $_FILES['item_file']['name']);
				}*/
				if($_FILES['index_item_file']['tmp_name']){
					$absitem->addParam('images_main', $_FILES['index_item_file']['name']);
				}
				$absitem -> newItem();
				/*if($_FILES['item_file']['tmp_name']){
					$absitem->addFile($_FILES['item_file']['tmp_name'], $_FILES['item_file']['name']);
				}*/
				if($_FILES['index_item_file']['tmp_name']){
					$absitem->addFile($_FILES['index_item_file']['tmp_name'], $_FILES['index_item_file']['name'],true);
				}
				/*if($_FILES['index_item_file2']['tmp_name']){
					$absitem->addFile($_FILES['index_item_file2']['tmp_name'], 'index2.jpg',true);
				}*/
				//жанры
				$typesite->addTags($_POST['typesites'],$absitem -> id) ;
			break;
		
			case 'update': // Переписать
				$tmp_item = $absitem->getInfo();
				foreach ($_POST as $key=>$value){
					if($key=='text') $absitem ->addParam($key, mysql_real_escape_string($value));
					else $absitem ->addParam($key, $value);
				}
				/*if($_FILES['item_file']['tmp_name']){
					$absitem->addParam('images', $_FILES['item_file']['name']);
				}*/
				if($_FILES['index_item_file']['tmp_name']){
					$absitem->addParam('images_main', $_FILES['index_item_file']['name']);
				}
				$absitem -> update();
				/*if($_FILES['item_file']['tmp_name']){
					$absitem->addFile($_FILES['item_file']['tmp_name'], $_FILES['item_file']['name']);
				}*/
				if($_FILES['index_item_file']['tmp_name']){
					$absitem->addFile($_FILES['index_item_file']['tmp_name'], $_FILES['index_item_file']['name'],true);
				}
				/*if($_FILES['index_item_file2']['tmp_name']){
					$absitem->addFile($_FILES['index_item_file2']['tmp_name'], 'index2.jpg',true);
				}*/
				//жанры
				$typesite->addTags($_POST['typesites'],$absitem -> id) ;
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
		$flag_url = false;
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
		
		$fmakeTypeSite = new fmakeTypeSite();
		$typesiteall = $fmakeTypeSite->getAll(true);
		
		$typesiteStr = $typesite -> tagsToString( $typesite -> getTags ($items[$absitem->idField]) );
		$typesiteJsStr = $typesite -> tagsToJsString( $typesite -> getAll () );
		
		$content .= '<script type="text/javascript" src="/js/jquery.autocomplete.js"></script>
					<script type="text/javascript" src="/js/gallery/admin-gallery.js"></script>';
	
		$dir = new utlDirectories(ROOT.'/calculating');
		$files = $dir->listing();
		
		$form = new utlFormEngine($modul, "/admin/index.php?modul=".$request->modul, "POST", "multipart/form-data");
	
		$form->addHidden("action", (($_GET['action'] == 'new')?'insert':'update'));
		$form->addHidden("id", $items['id']);
		if($request->dop_polya){
			$content .= "
			<script type=\"text/javascript\" >			
				$('.no-active').live('click',function(){
					$(this).text('Скрыть доп. поля');
					$(this).removeClass('no-active').addClass('active_d');
					//$('#title').parent().parent().show();
					$('#keywords').parent().parent().show();
					$('#description').parent().parent().show();
					$('#caption').parent().parent().show();
					$('#redir').parent().parent().show();
					//$('#tags').parent().parent().show();
				});
				$('.active_d').live('click',function(){
					$(this).text('Показать доп. поля');
					$(this).removeClass('active_d').addClass('no-active');
					//$('#title').parent().parent().hide();
					$('#keywords').parent().parent().hide();
					$('#description').parent().parent().hide();
					$('#caption').parent().parent().hide();
					$('#redir').parent().parent().hide();
					//$('#tags').parent().parent().hide();
				});
			</script>";

		$form->addHtml('','<td><a onclick="return false;" class="no-active" href="#">Показать доп. поля</a></td>');
		}
		$form->addVarchar("<em>Заголовок</em>", "title", $items["title"]);
		$form->addVarchar("<em>Ключевые</em>", "keywords", $items["keywords"],50,false,"");
		$form->addVarchar("<em>Описание</em>", "description", $items["description"]);
		$form->addVarchar("<em>Название</em>", "caption", $items["caption"]);
		$form->addVarchar("<em>Url</em>", "redir", $items["redir"]);
		$form->addVarchar("<em>Ссылка на сайт (без http://)</em>", "link", $items["link"],"(Пример: www.site.ru)");
		
		$form->addTextAreaMini("Тип сайта ( через запятую )", "typesites", $typesiteStr,1,1);
	
		//$form->addFCKEditor("Анотация", "anotaciya", $items['anotaciya']);
		//$form->addTinymce("Анотация", "anotaciya", $items['anotaciya']);
		//$form->addFile("Загрузить картинку", "item_file");
		$form->addFile("Загрузить картинку для главной страницы и портфолио", "index_item_file");
		//$form->addFile("Загрузить картинку для главной страницы(Цветная)", "index_item_file2");
		/*-----------------галлерея----------------------*/
		if($items){
			if($item_gallery){
				$form->addHtml('','<td colspan="2"><a class="action-link" onclick="return false;" id="link-gallery" href="/modules/fmakeGallery/index.php?id_gallery='.$item_gallery['id'].'"><div><img alt="" src="/images/admin/and.png"></div>Изменить галерею</a> <div style="padding-top: 6px;">'.$item_gallery[caption].'</div><td>');
			}
			else{
				$form->addHtml('','<td colspan="2"><a class="action-link" onclick="return false;" id="link-gallery" href="/modules/fmakeGallery/index.php?id_gallery='.$item_gallery['id'].'&id_content='.$items['id'].'"><div><img alt="" src="/images/admin/and.png"></div>Добавить галерею</a> <td>');
			}
		}
		else{
			$form->addHtml('','<td colspan="2">Для добавления галереи сохраните страницу<td>');
		}
		
		$form->addHtml("", '<td colspan="2">
<div id="iframe-pole" style="position: fixed; top:100px; left: 136px;z-index: 9999999;width: 800px; min-height: 500px;display: none;"></div></td>');
		/*-----------------галлерея----------------------*/
		
		$form->addFCKEditor("Текст", "text", $items['text']);
		//$form->addTinymce("Текст", "text", $items['text']);
		

		$form->addSubmit("save", "Сохранить");
		$content .= $form->printForm();
		
		$content .= '<script type="text/javascript">
			var typesites = ['.$typesiteJsStr.']
		
			$("#typesites").autocomplete(typesites , {
				multiple: true,
				mustMatch: false,
				autoFill: true
			});
		</script>';
		
		if($flag_url){
		$content .='
			<script>
				$("#title").keyup(function(){
					convert2EN("title","redir");
				});
			</script>
		';
		}
		$globalTemplateParam->set('content', $content);
		$block = "admin/edit/simple_edit.tpl";
		global $template; 
		$template = $block;
	break;
}
?>