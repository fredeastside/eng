<?php 
	require 'configs/main.php';
	/**
	 * загружаем шаблонизатор
	 */	
	$loader = new Twig_Loader_Filesystem(ROOT.TEMPLATE);
	$twig = new Twig_Environment($loader,array('auto_reload' => true ,'cache' => ROOT.CACHE, 'debug' => true));
	$lexer = new Twig_Lexer($twig, array('tag_comment' => array('/*', '*/'),'tag_block'  => array('[[', ']]'),'tag_variable' => array('{', '}'),));
	$twig->setLexer($lexer);
	$twig->addExtension(new Twig_Project_Extension());

	/**
	 *  лог запросов 
	 */
	$log = new dataBaseController_logFile(ROOT.CACHE."/sql.html", SQL_LOG);	
	$dataBase -> addLog($log);			
	/**
	 * делаем коннект к базе данных
	 */
	$dataBase->connect(__LINE__);
	/**
	 * глобальные переменные для шаблона
	 */
	$globalTemplateParam = new templateController_templateParam();
	/**
	 * адрес домена
	 */
	$hostname = str_replace("www.", "", $_SERVER['HTTP_HOST']);
	$globalTemplateParam->set('hostname', $hostname);
	/**
	 * обработчик информации из вне, get, post 
	 */
	$request = new requestController();
	$globalTemplateParam->set('request', $request);
	/**
	 * защита от sql иньекций, если включен защищенный режим 
	 */
	if(REQUEST_SAFETY){
		$request->allSqlInjectionNone();
	}
	/**
	 * обработчик сессии
	 */
	$session = new sessionController();
	/**
	 * создаем класс глобальных параметров
	 */
	$configs = new globalConfigs();
	$globalTemplateParam->set('configs',$configs);
