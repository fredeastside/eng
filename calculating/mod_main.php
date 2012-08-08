<?php

	$news_obj = new fmakeNews();
	$news = $news_obj->getNews(true);
	$news_url = $news_obj->getUrlNews();
	$globalTemplateParam->set('news_url',$news_url);
	$globalTemplateParam->set('news',$news);

	$incidents_obj = new fmakeIncidents();
	$incidents = $incidents_obj->getIncidents();
	$incident_url = $incidents_obj->getUrlIncident();
	$globalTemplateParam->set('incident_url',$incident_url);
	$globalTemplateParam->set('incidents',$incidents);

	$meets_obj = new fmakeMeets();
	$meets = $meets_obj->getMeets(true, 0, 2);
	$meet_url = $meets_obj->getUrlMeet();
	$globalTemplateParam->set('meet_url',$meet_url);
	$globalTemplateParam->set('meets',$meets);

	$modul->template = "base/main.tpl";
	
?>