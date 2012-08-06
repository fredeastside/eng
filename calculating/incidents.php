<?php
        $breadcrubs = $modul->getBreadCrumbs($modul->id);
        $incident_obj = new fmakeIncidents();
        
        if($request -> getEscape('url')){
            $url_arr = explode('/', $request -> getEscape('url'));
            
            list($main_cat, $cat, $item) = $url_arr;

            if(is_string($item)){
                //echo $request->modul;
                $item = $incident_obj->getItemByRedir($request->modul);
                $globalTemplateParam->set('item', $item);
                //printAr($item);
                $modul->title = $item['title'];
                $modul->description = $item['description'];
                $modul->template = "incidents/item.tpl"; //exit;
            }elseif(is_string($cat)){
                //echo $request->modul;
                $item = $incident_obj->getItemByRedir($request->modul, true);
                $modul->title = $item['title'];
                $modul->description = $item['description'];
                //printAr($item);
                $globalTemplateParam->set('item', $item);
                $modul->template = "incidents/category.tpl"; //exit;
            }
        }else{
        
        $page = !empty($_GET['page']) ? abs((int)$_GET['page']) : 1;
        $limit = $configs->news_count ? $configs->news_count : 10;
               
        $pages = $incident_obj->getPaginationPages($limit);

        if ($page < 1) {
		$page = 1;
	}
	elseif ($page > $pages) {
		$page = $pages;
	}
        
        $offset = ($page - 1) * $limit;
        $incidents = $incident_obj->getIncidents($offset, $limit);
        //printAr($news);
        $pag_menu = $incident_obj->getPaginationMenu($page, $pages);

        $globalTemplateParam->set('incidents', $incidents);
	    $globalTemplateParam->set('breadcrubs', $breadcrubs);
        $globalTemplateParam->set('pag_menu', $pag_menu);
        $globalTemplateParam->set('modul_params', $modul->params);
        
	$modul->template = "incidents/all_incidents.tpl";
        }
?>
