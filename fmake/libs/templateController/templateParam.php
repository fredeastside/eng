<?php
class templateController_templateParam{
	private $params = array();
	
	function __construct(){;}
	
	function get(){
		return $this->params;
	}
	
	function set($name,&$value){
		$this->params[$name] = $value;
	}
	//добавить не по указателю, чтобы защитить свою переменную
	function setNonPointer($name,$value){
		$this->params[$name] = $value;
	}
}