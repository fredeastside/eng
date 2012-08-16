<?php 
	ini_set('memory_limit','128M' );
	require('../../libs/FController.php');
	$modulObj = new fmakeAdminController();
	require_once(ROOT.'/admin/checklogin.php');
	
	require_once (ROOT."/libs/xajax/xajax_core/xajax.inc.php");

	$xajax = new xajax();
	$xajax->configure('decodeUTF8Input',true);
	//$xajax->configure('debug',true);
	$xajax->configure('javascript URI','../../libs/xajax/');
	//$xajax->processRequest();
	$xajax->register(XAJAX_FUNCTION,"SaveGalleryCaption");
	$xajax->register(XAJAX_FUNCTION,"deleteImage");
	$xajax->register(XAJAX_FUNCTION,"buttonOtmena");
	
	function SaveGalleryCaption($param) {
		if(intval($param['id'])>0){
			$fmakeGallery = new fmakeGallery($param['id']);
			$fmakeGallery->addParam('caption', $param['caption']);
			$fmakeGallery->update();
		}
		else{
			$fmakeGallery = new fmakeGallery();
			$fmakeGallery->addParam('caption', $param['caption']);
			$fmakeGallery->newItem();
			$gallery = $fmakeGallery->getInfo();
			$fmakeGalleryImage = new fmakeGallery_Image();
			$fmakeGalleryImage->renameGallery($gallery['id'], $param['id']);
			$fmakeGalleryNotise = new fmakeGallery();
			$fmakeGalleryNotise->table = $fmakeGalleryNotise->table_notice_galley;
			$fmakeGalleryNotise->addParam("id_site_modul", $param['id_content']);
			$fmakeGalleryNotise->addParam("id_gallery", $gallery['id']);
			$fmakeGalleryNotise->newItem();
		}
		$objResponse = new xajaxResponse();
		$objResponse->script('parent.document.location = parent.document.location;');
		return $objResponse;
	}
	
	function deleteImage($id_gallery,$image){
		$fmakeGalleryImage = new fmakeGallery_Image();
		$fmakeGalleryImage->deleteImage($id_gallery, $image);
		
		$all_photo = $fmakeGalleryImage->getFullPhoto($id_gallery);
		if($all_photo){
			foreach($all_photo as $photo){
				$content .='<li>
								<img class="thb" src="/images/galleries/'.$id_gallery.'/thumbs/'.$photo[image].'">
								<input type="hidden" name="sort[]" value="'.$photo[image].'" />
								<a style="position: absolute; right: -3px; top: -3px;" href="#" onclick="xajax_deleteImage('.$id_gallery.',\''.$photo[image].'\');return false;"><img src="/images/close.png"></a>
							</li>';
			}
		}
		
		$objResponse = new xajaxResponse();
		$objResponse->assign("uploadList","innerHTML", $content);
		return $objResponse;
	}
	
	function buttonOtmena($id_gallery){
		if($id_gallery<0){
			$fmakeGalleryImage = new fmakeGallery_Image();
			$fmakeGalleryImage->deleteImagesTmp($id_gallery);
		}
		
		$objResponse = new xajaxResponse();
		$objResponse->script('parent.document.location = parent.document.location;');
		return $objResponse;		
		
	}
	
	$xajax->processRequest();
	
	if(!$_GET['id_gallery']) $id_gallery = rand(1, 1000)*(-1);
	else $id_gallery = $_GET['id_gallery'];
	
	$id_content = $_GET['id_content'];
	//printAr($_GET);
	if($_GET[sort]){
		$array = $_GET[sort];
		$fmakeGalleryImage = new fmakeGallery_Image();
		foreach ($array as $key=>$item){
			$fmakeGalleryImage->editImageSort($id_gallery, $item, $key);
		}
	}
	$fmakeGallery = new fmakeGallery($id_gallery);
	$gallery = $fmakeGallery->getInfo();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title>Галлерея</title>
	<link rel="stylesheet" type="text/css" media="screen" href="gallery.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="js/uploadify/uploadify.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="js/tags/tags.css" />
	<link href="/styles/admin/main.css" type="text/css" rel="stylesheet">
	<script type="text/javascript" src="uploadifynew/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.custom.min.js"></script>
	<script type="text/javascript" src="uploadifynew/swfobject.js"></script>
	<script type="text/javascript" src="uploadifynew/jquery.uploadify.v2.1.4.js"></script>
	<script type="text/javascript" src="js/tags/tags.js"></script>
	<?php $xajax->printJavascript(); ?>
</head>
<body style="overflow: hidden; padding: 20px;width: 690px;background: url(/images/prozr.png) repeat;">
<style>
#uploadList li img.thb:hover {cursor: move;}
#uploadList li {}
</style>
<script type="text/javascript">

function updateParam()
{
	xajax_SaveGalleryCaption(xajax.getFormValues("form_save"));
}
function Otmena(id)
{
	xajax_buttonOtmena(id);
}

$(document).ready(function(){
	  $('#file_upload').uploadify({
		'uploader'  : 'uploadifynew/uploadify.swf',
		'script'    : 'uploadify.php?id_gallery=<?php echo($id_gallery); ?>',
		'cancelImg' : 'uploadifynew/cancel.png',
		'folder'    : '/images/gallery/',
		'auto'      : true,
		'multi'		: true,
		'fileDesc'	: 'Image Files',
		'fileExt'	: '*.jpg;*.JPG;*.png;*.gif',
		'sizeLimit' : 7097152,
		'buttonImg' : '/images/uploadphoto.gif',
		'width'		: 201,
		'height'	: 38,
		'onComplete' : function(event, queueID, fileObj, response, data) {
            var uploadList = $('#uploadList');
            uploadList.append("<li><img class=\"thb\"  src=\"/images/galleries/<?php echo($id_gallery); ?>/thumbs/"+escape(fileObj.name) + "\" alt=\"" + fileObj.name + "\" class=\"thb\" /><input type=\"hidden\" name=\"sort[]\" value=\"" + escape(fileObj.name) + "\" /><a style=\"position: absolute; right: -3px; top: -3px;\" href=\"#\" onclick=\"xajax_deleteImage(<?php echo($id_gallery);?>,'"+escape(fileObj.name)+"');return false;\"><img src=\"/images/close.png\"></a></li>");
        }
	  });
	
	 $("#uploadList").sortable();
});
</script>

<div class="page-content" style="width: 680px;">
	<a style="position: absolute; right: 65px; top: 28px;" href="#" onclick="Otmena(<?php echo($id_gallery);?>);return false;">
		<img src="/images/close.png">
	</a>
	<table class="rt">
		<tr>
			<td class="rt-tl"></td>
			<td class="rt-tc"></td>
			<td class="rt-tr"></td>
		</tr>
		<tr>
			<td class="rt-ml"></td>
			<td class="rt-mc">
				<table class="edit-forms" >
					<tr>
						<td>
							<label id="title-label" for="title"><em>Название Галереи</em></label><br>
						</td>
						<td>
							<form id="form_save" method="get" >
								<input type="hidden" name="id_content" value="<?php echo($id_content); ?>">
								<input type="hidden" name="id" value="<?php echo($id_gallery); ?>">							
								<input type="text" id="caption" value="<?php echo($gallery['caption']);?>" size="50" name="caption">
							</form>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<form action="index.php" method="get" enctype="multipart/form-data">
								<input type="hidden" name="id_gallery" value="<?php echo($id_gallery); ?>">
							<div id="uploadContainer">
									<!-- <p><strong>TIP:</strong> You can select multiple files with CTRL and SHIFT combinations.</p>  -->
							        <input id="file_upload" name="file_upload" type="file" />
							        <!-- <a href="#" id="uploadFiles">Upload Files</a> | <a href="#" id="clearQueue">Clear Queue</a> -->
							</div>
							<!--  <p id="sortdesc">Drag the images to and click save below to update the order in which they are displayed.</p> -->
							<div style="overflow:auto;width: 590px;height: 219px;"><div id="uploadFiles"><ul id="uploadList" class="ui-sortable">
							<?php 
								$absitem_photo = new fmakeGallery_Image();
								$all_photo = $absitem_photo->getFullPhoto($id_gallery);
								if($all_photo){
									foreach($all_photo as $photo){
										$content .='<li>
														<img class="thb" src="/images/galleries/'.$id_gallery.'/thumbs/'.$photo[image].'">
														<input type="hidden" name="sort[]" value="'.$photo[image].'" />
														<a style="position: absolute; right: -3px; top: -3px;" href="#" onclick="xajax_deleteImage('.$id_gallery.',\''.$photo[image].'\');return false;"><img src="/images/close.png"></a>
													</li>';
									}
									echo($content);
								}
							?>
							</ul></div>
							</div>
							<div class="submit">
								 <input type="submit" id="cmdsort" name="cmdsort" value="Сохранить сортировку" title="Нажмите для сохранения сортировки" />
							</div>
							</form>
						</td>
					</tr>
					<tr>
						<td></td>
						<td align="right" >
							
							<button onclick="Otmena(<?php echo($id_gallery);?>);return false;" name="save" class="fmk-button-admin f10"><div><div><div>Отменить</div></div></div></button>
							<button onclick="updateParam();return false;" name="save" class="fmk-button-admin f10"><div><div><div>Сохранить</div></div></div></button>
						</td>
					</tr>
				</table>
				
			</td>
			<td class="rt-mr"></td>
		</tr>
		<tr>
			<td class="rt-bl"></td>
			<td class="rt-bc"></td>
			<td class="rt-br"></td>
		</tr>
	</table>
</div>

</body>
</html>
