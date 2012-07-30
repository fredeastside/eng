<?php
/**
 * 
 * Управление модулями в системе
 * @author n1k
 *
 */
class fmakeModule extends fmakeCore{
	public $idField = "id_module";
	public $table = "modules";
	
	/**
	 * 
	 * Добавление модуля в систему
	 * @param $name
	 */
	function addModule($name,$path = false, $descr = false){
		$where[] = "name = '{$name}'";
		if($this -> getWhere($where)){
			return false;
		}
		$this -> addParam('name', $name);
		$this -> addParam('path', $path);
		$this -> addParam('description', $descr);
		$this -> newItem();
		return true;
	}
/**
	 * 
	 * Добавление модуля в систему
	 * @param $name
	 */
	function deleteModule($name){
		$where[] = "name = '{$name}'";
		if($arr = $this -> getWhere($where)){
			return false;
		}
		$modul = $arr[0];
		
		$this -> setId($modul[$this->idField]);
		$this -> delete();
		return $modul;
	}
	/**
	 * 
	 * Добавления параметров к модулю
	 * @param $config
	 */
	function addConfig($config){
		if(!$config || !$this -> id)return;
		$modulConfig = new fmakeModule_config();
		if(!$config['item'][0]){
			$modulConfig ->  addParam('name', $config['item']['name']);
			$modulConfig ->  addParam('description', $config['item']['description']);
			$modulConfig ->  addParam('value', $config['item']['value']);
			$modulConfig ->  addParam('id_module', $this -> id);
			$modulConfig -> newItem();
		}else{
			$index = sizeof($config['item']);
			for ($i = 0; $i < $index; $i++) {
				$modulConfig ->  addParam('name', $config['item'][$i]['name']);
				$modulConfig ->  addParam('description', $config['item'][$i]['description']);
				$modulConfig ->  addParam('value', $config['item'][$i]['value']);
				$modulConfig ->  addParam('id_module', $this -> id);
				$modulConfig -> newItem();
			}
		}
	}
}