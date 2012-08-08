<?php
        $breadcrubs = $modul->getBreadCrumbs($modul->id);
        $meets_obj = new fmakeMeets();
        
        $page = !empty($_GET['page']) ? abs((int)$_GET['page']) : 1;
        $limit = $configs->news_count ? $configs->news_count : 10;
        $offset = ($page - 1) * $limit;
        
        $cat_obj = new fmakeMeetCategories();
        $cat = $cat_obj->getAll(true);
        
        $globalTemplateParam->set('categories', $cat);
        
        switch($request->action){
            case 'search': 
                    $search_string = !empty($_REQUEST['search_string']) ? strip_tags($_REQUEST['search_string']) : null;
                    $category = !empty($_REQUEST['event_category']) ? strip_tags($_REQUEST['event_category']) : null;
                    $date = !empty($_REQUEST['event_date']) ? strip_tags($_REQUEST['event_date']) : null;
                    
                    $meets = $meets_obj->setSearch($search_string, $category, $date, $offset, $limit);
                    $pages = ceil(count($meets)/$limit);
                    if ($page < 1) {
                            $page = 1;
                    }
                    elseif ($page > $pages) {
                            $page = $pages;
                    }
                    $pag_menu = $meets_obj->getPaginationMenu($page, $pages);
                    $globalTemplateParam->set('pag_menu', $pag_menu);
                    $globalTemplateParam->set('meets', $meets);
                    $globalTemplateParam->set('breadcrubs', $breadcrubs);
                    //printAr($meets);
                    $modul->template = "meets/all_meets.tpl";
                    ;
                break;
            default: 
                if($request -> getEscape('url')){
            $url_arr = explode('/', $request -> getEscape('url'));
            
            list($main_cat, $cat, $item) = $url_arr;

            if(is_string($item)){;
                $item = $meets_obj->getItemByRedir($request->modul);
                $globalTemplateParam->set('item', $item);
                $modul->title = $item['title'];
                $modul->description = $item['description'];
                $modul->template = "meets/item.tpl"; //exit;
            }elseif(is_string($cat)){
                //echo $request->modul;
                $item = $meets_obj->getItemByRedir($request->modul, true);
                $modul->title = $item['title'];
                $modul->description = $item['description'];
                $meets = $meets_obj->getMeets(false, $offset, $limit, $item['id']);
                $globalTemplateParam->set('meets', $meets);
                $pages = $meets_obj->getPaginationPages($limit, $item['id']);

                if ($page < 1) {
                        $page = 1;
                }
                elseif ($page > $pages) {
                        $page = $pages;
                }
                $pag_menu = $meets_obj->getPaginationMenu($page, $pages);
                $globalTemplateParam->set('pag_menu', $pag_menu);
                //printAr($item);
                $globalTemplateParam->set('item', $item);
                $modul->template = "meets/category.tpl"; //exit;
            }
        }else{
                      
        $pages = $meets_obj->getPaginationPages($limit);

        if ($page < 1) {
		$page = 1;
	}
	elseif ($page > $pages) {
		$page = $pages;
	}
        
        $meets = $meets_obj->getMeets(false, $offset, $limit);
        //printAr($meets);
        
        $pag_menu = $meets_obj->getPaginationMenu($page, $pages);

        $globalTemplateParam->set('meets', $meets);
	$globalTemplateParam->set('breadcrubs', $breadcrubs);
        $globalTemplateParam->set('pag_menu', $pag_menu);
        $globalTemplateParam->set('modul_params', $modul->params);
        
	$modul->template = "meets/all_meets.tpl";
        }
            ;
        }
?>
