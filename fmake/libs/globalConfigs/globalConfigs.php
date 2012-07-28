<?php
class globalConfigs extends fmakeCore{
	
	public $table = "site_config";


	function __get($key){
		
		return $this->getByParam($key);
	}
	
	public function __isset($key){
 		return true;
  	}
	
	
	function udateByValue($key,$value){
		$item = $this->getByParam($key,false);
		$this->id = $item['id'];
		$this->addParam("param",$key);
		$this->addParam("value",$value);
		$this->update();
	}
	
	function getByParam($param,$value = true){
		$select = $this->dataBase->SelectFromDB(__LINE__);
		$arr = $select-> addWhere("param='".$param."'") -> addFrom($this->table) -> queryDB();
		if($value){
			return $arr[0]['value'];
		}else{
			return $arr[0];
		}
		
	}
	
	function getSiteConfigs() 
	{
		$siteconfig = $this->getAll(true);
		if($siteconfig)
			foreach($siteconfig as $conf)
				$this->{$conf['param']} = $conf['value'];
	}
}

?>