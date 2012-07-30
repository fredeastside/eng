<?php
class fmakeComments extends fmakeCore{
		
	public $table = "film_comments";

	protected $extensions; 	
	public $order = "date";

	function getComments($id) {
		$select = $this->dataBase->SelectFromDB(__LINE__);
		return $select->addFrom($this->table)->addWhere("film_id = ".$id)->addWhere("active = '1'")->queryDB();
	}
	
	function getByPage($id,$limit, $page, $active = false) {
		
		$select = $this->dataBase->SelectFromDB( __LINE__);
		if($active)
			$select -> addWhere("active='1'");
		return $select -> addFrom($this->table)->addWhere("film_id = ".$id) -> addOrder($this->order,DESC) -> addLimit((($page-1)*$limit), $limit) -> queryDB();
	}
	
	function getByPageCount($id,$active = false) {
		
		$select = $this->dataBase->SelectFromDB( __LINE__);
		if($active)
			$select -> addWhere("active='1'");
		$result = $select ->addFild("COUNT(*)")-> addFrom($this->table)->addWhere("film_id = ".$id)-> queryDB();
		return $result[0]["COUNT(*)"];
	}
	
	function getByPageAll($limit, $page, $active = false) {
		
		$select = $this->dataBase->SelectFromDB( __LINE__);
		if($active)
			$select -> addWhere("active='1'");
		return $select -> addFrom($this->table) -> addOrder($this->order,DESC) -> addLimit((($page-1)*$limit), $limit) -> queryDB();
	}
	
	function getByPageCountAll($active = false) {
		
		$select = $this->dataBase->SelectFromDB( __LINE__);
		if($active)
			$select -> addWhere("active='1'");
		$result = $select ->addFild("COUNT(*)")-> addFrom($this->table)-> queryDB();
		return $result[0]["COUNT(*)"];
	}
}