<?php
	/**
	 * Создаем основной класс для соединения с базой данных 
	 */ 
	$dataBase = new dataBaseController(
						$_SERVER["PHP_SELF"],
						"root",//пользователь
						"0twinings5",//пароль
						"engels",//имя базы 
						"localhost",//сервер
						"",
						"utf8",//кодировка
						"pr"//кодировка
					);

	