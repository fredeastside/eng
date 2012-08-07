<?php
        $breadcrubs = $modul->getBreadCrumbs($modul->id);
        $meets_obj = new fmakeMeets();
        
        $cat_obj = new fmakeMeetCategories();
        $cat = $cat_obj->getAll(true);
        
        $globalTemplateParam->set('categories', $cat);
        //printAr($request->modul);
        
        if($request -> getEscape('url')){
            $url_arr = explode('/', $request -> getEscape('url'));
            
            list($main_cat, $cat, $item) = $url_arr;

            if(is_string($item)){
                //echo $request->modul;
                $item = $meets_obj->getItemByRedir($request->modul);
                $globalTemplateParam->set('item', $item);
                //printAr($item);
                $modul->title = $item['title'];
                $modul->description = $item['description'];
                $modul->template = "meets/item.tpl"; //exit;
            }elseif(is_string($cat)){
                //echo $request->modul;
                $item = $meets_obj->getItemByRedir($request->modul, true);
                $modul->title = $item['title'];
                $modul->description = $item['description'];
                //printAr($item);
                $globalTemplateParam->set('item', $item);
                $modul->template = "meets/category.tpl"; //exit;
            }
        }else{
        
        $page = !empty($_GET['page']) ? abs((int)$_GET['page']) : 1;
        $limit = $configs->news_count ? $configs->news_count : 10;
               
        $pages = $meets_obj->getPaginationPages($limit);

        if ($page < 1) {
		$page = 1;
	}
	elseif ($page > $pages) {
		$page = $pages;
	}
        
        $offset = ($page - 1) * $limit;
        $meets = $meets_obj->getMeets(false, $offset, $limit);
        //printAr($meets);
        
        $pag_menu = $meets_obj->getPaginationMenu($page, $pages);

        $globalTemplateParam->set('meets', $meets);
	$globalTemplateParam->set('breadcrubs', $breadcrubs);
        $globalTemplateParam->set('pag_menu', $pag_menu);
        $globalTemplateParam->set('modul_params', $modul->params);
        
	$modul->template = "meets/all_meets.tpl";
        }
?>
