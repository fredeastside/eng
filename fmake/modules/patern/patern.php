<?php
include '_pattern.php';
class patern extends _pattern{
	public $table = "projects";
	public $idField = "id_project";
	public function tpl_test($i){
		return $i;
	}
}