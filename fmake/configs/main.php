<?php
	/**
	 * конфигурация всей системы системы
	 */
	include 'constant.inc';
	/**
	 *  регистрация шаблонизатора
	 */ 
	require_once(FROOT.'/libs/pear/PEAR.php');
	require_once(FROOT.'/libs/pear/Twig/Autoloader.php');
	Twig_Autoloader::register();
	
	/**
	 * подключение глобальных функций
	 */  
	require FROOT.'/libs/includes/functions.php';
	/**
	 * подключение инициализатора объектов
	 */
	require FROOT.'/libs/objectCreater/objectCreater.php';
	/**
	 * устанавливаем пути к директории и определяем загрузчик классов
	 */
	objectCreater::setDirPaths();
	/*
	 * инициализируем базу данных
	 */
	require 'db_config.php';