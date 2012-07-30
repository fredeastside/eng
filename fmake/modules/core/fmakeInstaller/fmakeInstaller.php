<?php 
class fmakeInstaller extends fmakeCore{
	private $extractFolder = "";
	private $constant = array(
		'install' => 'install.xml'
	);
	private $install = array(
		'name' => false,
		'path' => '/modules/',
		'db' => 'db.sql',
		'install' => 'install.php', 
	);
	/**
	 * 
	 * Извлечение из архива, проверка корректности
	 * @param $path путь до архива
	 * @return array массив файлов извлеченных из архива
	 */
	function extractFiles($path){
		$xmlParser = new xmlParser();
		$archive = new PclZip($path);
	    $list = $archive->extract(PCLZIP_OPT_BY_NAME, $this->constant['install'],
	                              PCLZIP_OPT_EXTRACT_AS_STRING);
	    if (!$list[0]['content'] && $list == 0) {
	      echo "ERROR : {$this->constant['install']} doesn't exist ";
	      exit;
	    }
	    $install = $xmlParser -> xmlToArray( $list[0]['content'] );
	    //printAr($install);
	    $this -> install = array_merge($this -> install, $install);
	    if(! $this -> install['name']){
	    	echo "ERROR : name module doesn't exist ";
	     	exit;
	    }
	    
		/**
		 * распаковываем все файлы
		 */
	    $this -> extractFolder = FROOT.$install['path'].$install['name']."/";
	    if( is_dir($this -> extractFolder) ){
	    	echo "ERROR : files module is exist ";
	     	exit;
	    }
		$archive = new PclZip($path);
		return $archive->extract(PCLZIP_OPT_PATH, $this -> extractFolder);
	}
	/**
	 * 
	 * Удаление файлов архива
	 */
	function deleteFiles($dir){
		$fileSystem = new fileSystem();
		$fileSystem -> deleteDirectory($dir);
	}
	/**
	 * 
	 * Установка модуля
	 * @param $module string путь до архива *.zip
	 */
	function installModule($module){
		$fileSystem = new fileSystem();
		$fmakeModule = new fmakeModule();
		if(!$module) return;
		$files = $this -> extractFiles($module);
		/**
		 * если нет основного класса модуля
		 */
		if(!file_exists($this -> extractFolder. $this -> install['name'].".php")){
			echo "ERROR : files module name doesn't exist ";
			$this -> deleteFiles($this -> extractFolder);
	     	exit;
		}
		/**
		 * Проверяем и устанавливаем модуль в систему
		 */
		if( !$fmakeModule -> addModule($this -> install['name'],$this -> install['path'],$this -> install['description']) ){
			echo "ERROR : module name is exist ";
			$this -> deleteFiles($this -> extractFolder);
			exit;
		}
		/**
		 * Добавляем параметры к модулю
		 */
		$fmakeModule -> addConfig($this -> install['config']);
		/**
		 * если есть установочный файл модуля
		 */
		if( file_exists($this -> extractFolder. $this -> install['install']) ){
			include $this -> extractFolder. $this -> install['install'];
		}
		/**
		 * если есть установочный файл модуля для базы данных
		 */
		if( file_exists($this -> extractFolder. $this -> install['db']) ){
			 $sql = file_get_contents( $this -> extractFolder. $this -> install['db'] );
			 if($sql)
			 	$this->dataBase->query($sql,__LINE__);
		}
		/**
		 * если есть файлы шаблонизатора
		 */
		if($this -> install['templateFolder']){
			$fileSystem -> moveDirectory($this -> extractFolder. $this -> install['templateFolder'],
											 ROOT.TEMPLATE . "/" . $this -> install['templateFolder']);
		}
		/**
		 * если есть файлы шаблонизатора для системы администрирования
		 */
		if($this -> install['templateFolderAdmin']){
			$fileSystem -> moveDirectory($this -> extractFolder. $this -> install['templateFolderAdmin'],
											 ROOT.TEMPLATE_ADM . "/" . $this -> install['templateFolderAdmin']);
		}
		
		/**
		 * сохраняем установочный файл
		 */
		copy($module,$this -> extractFolder . $this -> install['name'].".zip");
		
	}

	/**
	 * 
	 * Удаление модуля по названию
	 * @param $module
	 */
	function uninstallModule($module){
		$fmakeModule = new fmakeModule();
		/**
		 * удаляем из базы данных
		 */
		$module = $fmakeModule -> deleteModule($module);
		if(!$module){
			return false;
		}
		$this -> deleteFiles(FROOT.$module['path'].$module['name']."/");
	}
	
}