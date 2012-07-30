<?php
class fmakeFeedback extends fmakeCore{
		
	public $idField = "id";
	public $table = "feedback_email";

	function isEmail($email){
		$select = $this->dataBase->SelectFromDB(__LINE__);
		return $select->addFrom($this->table)->addWhere("`email`='{$email}'")->queryDB();
	}
}