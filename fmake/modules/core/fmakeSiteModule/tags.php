<?php

	class fmakeSiteModule_tags extends fmakeCore{
		
		public $idField = "id_tag";
		public $table = "tags";
		public $table_notice_tags = "site_modul_tags";
		
		/**
		*
		* добавить тег
		* @param $name имя
		*/
		function addTag($name){
			$tag = $this->getWhere(array("`name` = '{$name}'"));
			$tag = $tag[0];
			if($tag){
				return $tag;
			}
			$this -> addParam('name',$name);
			$this -> newItem();
			$this -> params = array();
			return $this->getInfo();
		}
		/**
		*
		* добавить тег из строки, через запятую
		* @param $tagsStr 
		*/
		function addTags($tagsStr, $id_site_modul){
			if($tagsStr){
				$tags = explode (',',$tagsStr);
				global $request ;
				$tagsNotDelete = array();
				for($i=0;$i<sizeof($tags);$i++){
					$tagStr = trim($tags[$i]);
					if(!$tagStr) continue;
					$tagsNotDelete[$i] = $this -> addNoticeTag( $request -> getEscapeVal($tagStr), $id_site_modul);
				}
			}
			
			// удаляем те что не нужны больше
			//printAr($tagsNotDelete);
			if($tagsNotDelete || !$tagsStr){
				$delete = $this->dataBase->DeleteFromDB( __LINE__ );
				if($tagsNotDelete){
					foreach ($tagsNotDelete as $tagNotDelete){
						$delete -> addWhere("`".$this->idField."` != '".$tagNotDelete[$this->idField]."'");
					}
				}
				$delete	-> addTable($this->table_notice_tags) -> addWhere("`id_site_modul`='".$id_site_modul."'") -> queryDB();
			}
		}
		/**
		*
		* добавить 
		* @param $name 
		* @param $id_site_modul id 
		*/
		function addNoticeTag($name,$id_site_modul){
			$tag = $this -> addTag( $name );
			$tmp = $this->table;
			$this->table = $this->table_notice_tags;
			$item = $this->getWhere(array("`id_site_modul` = '{$id_site_modul}'","`{$this->idField}` = '{$tag[$this->idField]}'"));
			if($item){
				$this->table = $tmp;
				return $item[0];
			}
			
			$this -> addParam($this->idField,$tag[$this->idField]);
			$this -> addParam("id_site_modul",$id_site_modul);
			
			$this ->newItem();
			$item['id_site_modul'] = $id_site_modul;
			$item[$this->idField] = $tag[$this->idField];
			$this -> params = array();
			$this->table = $tmp;
			return $item;
		}
		/**
		*
		* получить теги по странице
		* @param $id_site_modul id 
		*/
		function getTags($id_site_modul){
			
			$tmp = $this->table;
			$this->table = $this->table_notice_tags;
			$items = $this->getWhere(array("`id_site_modul` = '{$id_site_modul}'"));
			$this->table = $tmp;
			for($i=0;$i<sizeof($items);$i++){
				$this->setId($items[$i][$this->idField]);
				$items[$i] = $this->getInfo();
			}
			return $items;
		}
		
		function tagsToString($tags){

			for($i=0;$i<sizeof($tags);$i++){
				$str .= $tags[$i]['name'].', ';
			}
			return $str;
		}
		
		function tagsToJsString($tags){

			for($i=0;$i<sizeof($tags);$i++){
				$str .= '"'.$tags[$i]['name'].'", ';
			}
			return $str;
		}
		
		function countTagPage($id_tag){
			$select = $this->dataBase->SelectFromDB(__LINE__);
			$result = $select->addFild('COUNT(*)')->addFrom($this->table_notice_tags)->addWhere($this->idField.' = '.$id_tag)->queryDB();
			return $result[0]['COUNT(*)'];
		}
	
		
		function delTagPage($id_tag){
			$delete = $this->dataBase->DeleteFromDB(__LINE__);
			$delete->addTable($this->table_notice_tags)->addWhere($this->idField.' = '.$id_tag)->queryDB();
		}
		
		function delTagsPage($id_page){
			$delete = $this->dataBase->DeleteFromDB(__LINE__);
			$fmakeSiteModule = new fmakeSiteModule();
			$delete->addTable($this->table_notice_tags)->addWhere('id_site_modul = '.$id_page)->queryDB();
		}
		
		function getTagsPress($id_tag){
			$select = $this->dataBase->SelectFromDB(__LINE__);
			$result = $this->dataBase->query("Select * from ".$this->table.",".$this->table_notice_tags." where ".$this->table.".".$this->idField." = ".$this->table_notice_tags.".".$this->idField." AND  id_site_modul in (Select id_site_modul from ".$this->table_notice_tags." where ".$this->idField." = ".$id_tag." ) ", __LINE__);
		    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		        if($line[$this->idField]!=$id_tag) $result_array[] = $line;
		    }
			return $result_array;
		}
		
		function bublesort($array,$param_sort){
			//echo('start');
			$size = sizeof($array);
			for($i=0;$i<$size-1;$i++){
				//echo($i.'<br />');
				for($j=$i+1;$j<$size;$j++){
					if(intval($array[$i][$param_sort])<intval($array[$j][$param_sort])){
						$tmp = $array[$i];
						$array[$i] = $array[$j];
						$array[$j] = $tmp;
					}
				}
			}
			
			return $array;
		}
	}
?>