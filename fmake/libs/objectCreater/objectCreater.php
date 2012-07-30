<?php
/**
 * 
 * @author n1k
 * создание объектов во все системе
 *
 */
	class objectCreater{
		static $startPathSearcher = 1;
		static $endPathSearcher = 1;
		static $extension = ".php";
		
		
		static function setDirPaths(){
			set_include_path(
				get_include_path().ROOT.DIRECTORY_SEPARATOR.PATH_SEPARATOR
				.ROOT.DIRECTORY_SEPARATOR.'fmake'.DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.PATH_SEPARATOR
				.ROOT.DIRECTORY_SEPARATOR.'fmake'.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.PATH_SEPARATOR
				.ROOT.DIRECTORY_SEPARATOR.'fmake'.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.PATH_SEPARATOR
				.ROOT.DIRECTORY_SEPARATOR.'calculating'.DIRECTORY_SEPARATOR
			);	
			
			ini_set('unserialize_callback_func', 'spl_autoload_call');
        	spl_autoload_register(array(new self, 'createObj'));
			//размер уже установленных патчей, чтобы не смотреть в лишних директориях
			objectCreater::$endPathSearcher = sizeof(explode(PATH_SEPARATOR, get_include_path())) - 1;
				
		}
		
		
		static function createObj($name){
			//echo($name."<br/>");
			//выкачиваем все патхи
			$paths = explode(PATH_SEPARATOR, get_include_path());
			//printAr($paths);
			//заменяем _ на / для того что бы загрузить вспомогательные классы в папке
			$name = str_replace('_', '/', $name);
			$include = objectCreater::add_include_path( $name, $paths );
			//echo($include."<br/>");
			if($include){
				require $include;
			}
		}
		
		static function add_include_path ($name, $paths){
		    foreach ($paths AS $path){

		        if ( file_exists($fullPath = $path.$name.DIRECTORY_SEPARATOR.$name.objectCreater::$extension) ){
					set_include_path(get_include_path() . PATH_SEPARATOR . $path.$name.DIRECTORY_SEPARATOR);
		        	return $fullPath;
		        }
		       
		    	if ( file_exists($fullPath = $path.$name.objectCreater::$extension) ){
		        	return $fullPath;
		        }
		        
		    }
		}
	
		static function remove_include_path ($path){
			
		    foreach (func_get_args() AS $path)
		    {
		        $paths = explode(PATH_SEPARATOR, get_include_path());
		       
		        if (($k = array_search($path, $paths)) !== false)
		            unset($paths[$k]);
		        else
		            continue;
		       
		        if (!count($paths))
		        {
		            //trigger_error("Include path '{$path}' can not be removed because it is the only", E_USER_NOTICE);
		            continue;
		        }
		       
		        set_include_path(implode(PATH_SEPARATOR, $paths));
		    }
		}
		
		
		
		
		
	}
