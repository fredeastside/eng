<?php
        $breadcrubs = $modul->getBreadCrumbs($modul->id);
        $meets_obj = new fmakeMeets();
		
		$meet_url = $meets_obj->getUrlMeet();
		$globalTemplateParam->set('meet_url',$meet_url);
        
        $page = !empty($_GET['page']) ? abs((int)$_GET['page']) : 1;
        if($request->getFilter('check'))
            $page = 1;
        $limit = $configs->news_count ? $configs->news_count : 10;
        $offset = ($page - 1) * $limit;
        
        $cat_obj = new fmakeMeetCategories();
        $cat = $cat_obj->getAll(true);
        
        $globalTemplateParam->set('categories', $cat);
        
        switch($request->getFilter('action')){
            case 'search':
                    $search_string = $request->getFilter('search_string') ? strip_tags($request->getFilter('search_string')) : null;
                    $category = $request->getFilter('event_category') ? strip_tags($request->getFilter('event_category')) : null;
                    $date = $request->getFilter('event_date') ? strip_tags($request->getFilter('event_date')) : null;
                    //printAr($category);
                    $meets = $meets_obj->setSearch($search_string, $category, $date, $offset, $limit);
                    $count = $meets_obj->getRows();
			
                    $pages = ceil($count/$limit);
                    if ($page < 1) {
                            $page = 1;
                    }
                    elseif ($page > $pages) {
                            $page = $pages;
                    }
                    $pag_menu = $meets_obj->getPaginationMenu($page, $pages, true);
                    $globalTemplateParam->set('search_string', $search_string);
                    $globalTemplateParam->set('event_category', $category);
                    if(preg_match("/(\d{2})\.(\d{2})\.(\d{4})/", $date)){
                        $globalTemplateParam->set('date', $date);
                    }
                    $globalTemplateParam->set('event_date', $date);
                    $globalTemplateParam->set('pag_menu', $pag_menu);
                    if(!$meets){
                        $not_found = true;
                        $globalTemplateParam->set('not_found', $not_found);
                    }
                    else
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
