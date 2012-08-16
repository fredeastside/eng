<?php
        $breadcrubs = $modul->getBreadCrumbs($modul->id);
        $reports_obj = new fmakePhotoReports();
        $reports_url = $reports_obj->getUrlReports();
	$globalTemplateParam->set('reports_url',$reports_url);
        $page = !empty($_GET['page']) ? abs((int)$_GET['page']) : 1;
        $limit = $configs->reports_count ? $configs->reports_count : 10;
        
        $offset = ($page - 1) * $limit;
        
        if($request -> getEscape('url')){
            
            $item = $reports_obj->getItemByRedir($request->modul);
            //printAr($item);   
            $id_gallery = $reports_obj->getGalleryId($item['id']);
            
            if($id_gallery){
                $photos = $reports_obj->getPhotos($id_gallery);
                $globalTemplateParam->set('photos', $photos);
                //printAr($photos);
            }
            
            $modul->title = $item['title'];
            $modul->description = $item['description'];
            $globalTemplateParam->set('item', $item);
            
            $modul->template = "photoreports/item.tpl";

        }else{
        
        $reports = $reports_obj->getReports(false, $offset, $limit);
        
        $pages = $reports_obj->getPaginationPages($limit);

        if ($page < 1) {
		$page = 1;
	}
	elseif ($page > $pages) {
		$page = $pages;
	}
        
        $pag_menu = $reports_obj->getPaginationMenu($page, $pages);
        $globalTemplateParam->set('pag_menu', $pag_menu);
        
        $globalTemplateParam->set('reports', $reports);
	$globalTemplateParam->set('breadcrubs', $breadcrubs);
        $globalTemplateParam->set('modul_params', $modul->params);
        
	$modul->template = "photoreports/all_reports.tpl";
        }
?>
