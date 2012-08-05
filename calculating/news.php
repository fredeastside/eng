<?php
        $breadcrubs = $modul->getBreadCrumbs($modul->id);
        $news_obj = new fmakeNews();
        
        if($request -> getEscape('url')){
            $url_arr = explode('/', $request -> getEscape('url'));
            
            list($main_cat, $cat, $item) = $url_arr;

            if(is_string($item)){
                //echo $request->modul;
                $item = $news_obj->getItemByRedir($request->modul);
                $globalTemplateParam->set('item', $item);
                //printAr($item);
                $modul->title = $item['title'];
                $modul->description = $item['description'];
                $modul->template = "news/item.tpl"; //exit;
            }elseif(is_string($cat)){
                //echo $request->modul;
                $item = $news_obj->getItemByRedir($request->modul, true);
                $modul->title = $item['title'];
                $modul->description = $item['description'];
                //printAr($item);
                $globalTemplateParam->set('item', $item);
                $modul->template = "news/category.tpl"; //exit;
            }
        }else{
        
        $page = !empty($_GET['page']) ? abs((int)$_GET['page']) : 1;
        $limit = $configs->news_count ? $configs->news_count : 10;
               
        $pages = $news_obj->getPaginationPages($limit);

        if ($page < 1) {
		$page = 1;
	}
	elseif ($page > $pages) {
		$page = $pages;
	}
        
        $offset = ($page - 1) * $limit;
        $news = $news_obj->getNews(false, $offset, $limit);
        
        $pag_menu = $news_obj->getPaginationMenu($page, $pages);

        $globalTemplateParam->set('news', $news);
	$globalTemplateParam->set('breadcrubs', $breadcrubs);
        $globalTemplateParam->set('pag_menu', $pag_menu);
        $globalTemplateParam->set('modul_params', $modul->params);
        
	$modul->template = "news/all_news.tpl";
        }
?>
