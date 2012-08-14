<?php

	$news_obj = new fmakeNews();
	$news = $news_obj->getNews(true);
        $news_url = $news_obj->getUrlNews();
	$globalTemplateParam->set('news_url',$news_url);
	$globalTemplateParam->set('news',$news);
        
        $business_news_obj = new fmakeBusinessNews();
	$business_news = $business_news_obj->getNews(true, 0, 4);
        $business_news_url = $business_news_obj->getUrlNews();
		//printAr($business_news_url);
	$globalTemplateParam->set('business_news_url',$business_news_url);
	$globalTemplateParam->set('business_news',$business_news);
        $business_category_obj = new fmakeBusinessNewsCategories();
        $business_categories = $business_category_obj->getAll(true);
        $globalTemplateParam->set('business_categories',$business_categories);
        
        $education_news_obj = new fmakeEducationNews();
	$education_news = $education_news_obj->getNews(true, 0, 4);
        $education_news_url = $education_news_obj->getUrlNews();
	$globalTemplateParam->set('education_news_url',$education_news_url);
	$globalTemplateParam->set('education_news',$education_news);
        $education_category_obj = new fmakeEducationNewsCategories();
        $education_categories = $education_category_obj->getAll(true);
        $globalTemplateParam->set('education_categories',$education_categories);

	$incidents_obj = new fmakeIncidents();
	$incidents = $incidents_obj->getIncidents();
	$globalTemplateParam->set('incidents',$incidents);
        $incident_url = $incidents_obj->getUrlIncident();
        $globalTemplateParam->set('incident_url',$incident_url);

	$meets_obj = new fmakeMeets();
	$meets = $meets_obj->getMeets(true, 0, 2);
        $meet_url = $meets_obj->getUrlMeet();
	$globalTemplateParam->set('meet_url',$meet_url);
	$globalTemplateParam->set('meets',$meets);

	$modul->template = "base/main.tpl";
	
?>