<?php
	/**
	 * Создаем основной класс для соединения с базой данных 
	 */ 
	$dataBase = new dataBaseController(
						$_SERVER["PHP_SELF"],
						"engels_engels_bd",//пользователь
						"HJhjg4vt",//пароль
						"wwwengelsbz_engels_bd",//имя базы 
						"mysql.engels.mass.hc.ru",//сервер
						"",
						"utf8",//кодировка
						"pr"//кодировка
					);

	