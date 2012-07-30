<?php
define(ID_ADMINISTRATOR,1);
define(ID_MODERATOR,2);
define(ID_REGISTRATOR,3);

class fmakeSiteAdministrator extends fmakeCore{
	
	public $table = "site_administrator";
	public $id; 	// int
	public $login;	// char
	public $role;	// int
	public $status;	// bool
	public $acces;	// char
	public $name;
	
	
	public static $accesObj = false;
	public static $roleObj = false;
	
	/**
	 * 
	 * @return fmakeAcces_adminModul
	 */
	function getAccesObj(){
		if(!self::$accesObj){
			self::$accesObj = new fmakeAcces_adminModul();
		}
		return self::$accesObj;
	}
	
	/**
	 * 
	 * @return fmakeSiteAdministratorRole
	 */
	function getRoleObj(){
		if(!self::$roleObj){
			self::$roleObj = new fmakeSiteAdministratorRole();
		}
		return self::$roleObj;
	}
	
	
	public function setLogin($id, $login, $role, $name = 'Пользователь')
	{
		$this->id = $id;
		$this->login = $login;
		$this->role = $role;
		$this->status = true;
		$this->name = $name;
		$this->save();
	}
	
	public function logout()
	{
		unset($_SESSION[$this->type]);
		$this->status = false;
	}

	public function isLogined()
	{
		return $this->status;
	}

	public function getRole()
	{
		return $this->role;
	}

	public function load()
	{
		$this->id = $_SESSION[$this->type]['id'];
		$this->login = $_SESSION[$this->type]['login'];
		$this->role = $_SESSION[$this->type]['role'];
		$this->status = $_SESSION[$this->type]['status'];
		$this->name = $_SESSION[$this->type]['name'];
	}

	public function save()
	{
		$_SESSION[$this->type]['id'] = $this->id;
		$_SESSION[$this->type]['login'] = $this->login;
		$_SESSION[$this->type]['role'] = $this->role;
		$_SESSION[$this->type]['status'] = $this->status;
		$_SESSION[$this->type]['name'] = $this->name;
	}
	
	function login($login, $password){
     	$select = $this->dataBase->SelectFromDB( __LINE__);
		$row = $select -> addFrom($this->table) ->	addWhere("login='".mysql_escape_string($login)."'") -> addWhere("active='1'") -> queryDB();
		$row = $row[0];

		if (md5($password) == $row["password"]){
			return $row;
		}else{
			return false;
		}
	}
	
	/**
	* 
	* Получаем записи по роли
	*/
	function getByRole($role,$active = false){
		
		$where[0] = 'role = '.$role;
		if($active !== false){
			if($active){
				$where[1] = 'active = '.$active;
			}else{
				$where[1] = "active = '0'";
			}
		}
		
		return $this->getWhere($where);	
	}
	
	/**
	* 
	* Получаем колличество записей по роли
	*/
	function getNumRows($role,$active = false) {
		
		$where[0] = 'role = '.$role;
		if($active !== false){
			if($active){
				$where[1] = 'active = '.$active;
			}else{
				$where[1] = "active = '0'";
			}
		}
		
		$count = $this->getFieldWhere(array( "COUNT(*)" ),$where);	
		
		return $count[0]["COUNT(*)"];
	}
	
}