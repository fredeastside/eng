<?php
class fmakeSiteUser_role extends fmakeCore{
	
	public $table = "site_modul_role";
	
	function getRols(){
		$select = $this->dataBase->SelectFromDB(__LINE__);
		return $select -> addFild("id,role") -> addFrom($this->table)->addOrder($this->order) -> addGroup("role") -> queryDB();
	}
	
}