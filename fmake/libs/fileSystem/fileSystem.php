<?php
/**
 * 
 * Класс для работы с файлами, директориями, удаление, копирование и перемещение
 *
 */
class fileSystem{
	/**
	 * 
	 * перемещение директории
	 * @param $fromDir откуда
	 * @param $toDir куда
	 */
	function moveDirectory($fromDir,$toDir){
		if(!is_dir($fromDir)){
			echo "ERROR : fromDir is not dir";
			return;
		}
		if(!is_dir($toDir)){
			mkdir($toDir);
		}
		$dir_handle = opendir($fromDir);
		while($file = readdir($dir_handle)) {
			if ($file != "." && $file != "..") {
				if (!is_dir($fromDir."/".$file)){
					copy($fromDir."/".$file, $toDir."/".$file);
					unlink($fromDir."/".$file);
				}else{
					$this -> moveDirectory($fromDir.'/'.$file,$toDir.'/'.$file);
				}
			}
		}
		closedir($dir_handle);
		rmdir($fromDir);
	}
	/**
	 * 
	 * Удаление директории
	 * @param $dirname string  
	 */
	function deleteDirectory($dirname) {
		if (is_dir($dirname))
			$dir_handle = opendir($dirname);
		if (!$dir_handle)
			return false;
		while($file = readdir($dir_handle)) {
			if ($file != "." && $file != "..") {
				if (!is_dir($dirname."/".$file))
					unlink($dirname."/".$file);
				else
					$this -> deleteDirectory($dirname.'/'.$file);
			}
		}
		closedir($dir_handle);
		rmdir($dirname);
		return true;
	}
}