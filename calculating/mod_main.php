<?php

	$news_obj = new fmakeNews();
	$news = $news_obj->getNews(true);
	$globalTemplateParam->set('news',$news);

	$incidents_obj = new fmakeIncidents();
	$incidents = $incidents_obj->getIncidents();
	$globalTemplateParam->set('incidents',$incidents);

	$meets_obj = new fmakeMeets();
	$meets = $meets_obj->getMeets(true, 0, 2);
	$globalTemplateParam->set('meets',$meets);

	$modul->template = "base/main.tpl";
	
?>