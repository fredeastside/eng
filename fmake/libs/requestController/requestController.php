<?PHP

class requestController{
	public $filter = 'filter';
	
	
	public function __isset($key){
 		return true;
  	}
	
	function __get($key)
	{	
		return $_REQUEST[$key];
	}
	
	
	
	function getEscape($key){
		return mysql_real_escape_string($_REQUEST[$key]);
	}
	
	function getEscapeVal($val){
		return mysql_real_escape_string($val);
	}
	
	function getFilterEscape($name){
		return mysql_real_escape_string($_REQUEST[$this -> filter][$name]);
	}	

	function getFilter($name){
		return $_REQUEST[$this -> filter][$name];
	}
	
	function setFilter($name,$val){
		$_REQUEST[$this -> filter][$name] = $val;
	}
	
	function getFilterArr(){
		$filter = $_REQUEST[$this -> filter];
		

		if($arg = func_get_args()){
			foreach ($arg AS $notFilter)
			{
				unset($filter[$notFilter]);
			}
		}
		
		// удаляем пустые
		if($filter){
			foreach ($filter AS $name => $value)
			{
				if($value === false){
					unset($filter[$name]);
				}
			}
		}
		
		return $filter;
	}
	
	function writeFilter(){
	
		$filter = $_REQUEST[$this -> filter];
		
		/*if($notFilter){
			foreach ($notFilter as $not){
				unset($filter[$not]);
			}
		}*/
		
		if($arg = func_get_args()){
			foreach ($arg AS $notFilter)
			{
				unset($filter[$notFilter]);
			}
		}
		
		$str = '';
		$i=1;
		if($filter){
			foreach ($filter as $name=>$value){
				if($value !== false && $i++ == 1){
					$str .= "filter[{$name}]={$value}";
				}else if($value !== false){
					$str .= "&filter[{$name}]={$value}";
				}
			}
		}
		
		return $str;
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