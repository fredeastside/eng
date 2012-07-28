<?PHP

class requestController{
	
	public function __isset($key){
 		return true;
  	}
	
	function __get($key)
	{	
		return $_REQUEST[$key];
	}
	
	
	
	function getEscapeVal($val){
		return mysql_real_escape_string($val);
	}
	
	function getEscape($key){
		return isset($_REQUEST[$key]) ? mysql_real_escape_string($_REQUEST[$key]) : false;
	}
	
	
	// приводим в нормальный вид перед добавление в базу
	function allEscape($array = false,$key = false){
		if(!$array)$array = &$_REQUEST;
		
			foreach ($array as $key=>&$value){
				
				if(is_array($value)){
					$value = $this->allEscape($value);
				}else{
					$value = mysql_real_escape_string($value);
				}
				
			}
			
		return $array;
	}
	
	function injectionWordNone($word){
		$word = mysql_real_escape_string ($word);
 
	    $word = strip_tags($word);
	         
	    $word = htmlspecialchars($word);
	 
	    $word = stripslashes($word);
	     
	    return addslashes($word); 
	}
	
	// приводим в нормальный вид перед добавление в базу (защита от всех иньекций)
	function allSqlInjectionNone($array = false,$key = false){
		if(!$array)$array = &$_REQUEST;
		
			foreach ($array as $key=>&$value){
				
				if(is_array($value)){
					$value = $this->allEscape($value);
				}else{
					$value = $this->injectionWordNone($value);
				}
				
			}

		return $array;
	}
	
}
?>