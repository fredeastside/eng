<?php

class fmakeMeets extends fmakeCore {

    public $table = "meets";
    public $order = "position";
    public $fileDirectory = "images/sitemodul_image/meets/";
	public $order_as = "DESC";
	public $mod = "meets";

    function addFile($tempName, $name) {
        $dirs = explode("/", $this->fileDirectory . '/' . $this->id);
        $dirname = ROOT . "/";

        foreach ($dirs as $dir) {
            $dirname = $dirname . $dir . "/";
            if (!is_dir($dirname))
                mkdir($dirname);
        }

        $images = new imageMaker($name);
        $images->imagesData = $tempName;
        $images->resize(640, 480, false, $dirname, '', false);
        $images->resize(201, 113, true, $dirname, 'vb', false);
        $images->resize(139, 85, true, $dirname, 'vm', false);
        $images->resize(70, 47, true, $dirname, 'mini', false);

        $this->addParam('picture', $name);
        $this->update();
    }
	
	public function getDate($date_str){
		if(!$date_str)
			return false;
		
		list ($day, $month, $year) = split ('[/.-]', $date_str);
		$date = "$year-$month-$day";
		
		return $date;
	}
	
	public function setDate($date_str){
		if(!$date_str)
			return false;
		
		list ($year, $month, $day) = split ('[/.-]', $date_str);
		$date = "$day.$month.$year";
		
		return $date;
	}
	
	public function getMeets($main = false, $offset = 0, $limit = 9, $id_category = false){
		
		$this->order = "a.date";
		
		$select = $this->dataBase->SelectFromDB( __LINE__);
		
		$select->addFild("a.id as id_meets, 
			a.name as name_meet, 
                        a.active,
			a.title as title_meet, 
			a.description as description_meet, 
			a.redir as redir_meet, 
			a.id_meet, 
			a.date, 
			a.anons, 
			a.text, 
			a.picture, 
			a.main,
			b.id as cat_id,
			b.name as cat_name,
			b.title as cat_title,
			b.description as cat_description,
			b.redir as cat_redir");
		
		//$select -> addWhere("a.id_category=b.id");
		
		$select -> addWhere("a.active='1'");
                
                if($id_category){
                    $where = "a.id_meet = '%d'";
                    $where = sprintf($where, $id_category);
                    $select -> addWhere($where);
                }
		
                if($main)
                    $select -> addWhere("a.main='1'");
		
		$select -> addOrder($this->order, (($this->order_as)?$this->order_as:'DESC'));
		
		$select->addLimit($offset, $limit);
		
		return $select -> addFrom($this->table." as a Left join meet_categories as b on a.id_meet=b.id") -> queryDB();
	}
	
	private function getMeetCategory($id_category){
		if(!$id_category)
			return false;
		
		$this->table = 'meet_categories';
		
		$select = $this->dataBase->SelectFromDB( __LINE__);
		
		$where = "id = '%d'";

		$select -> addWhere(sprintf($where, $id_category));
		
		$select = $select -> addFrom($this->table) -> queryDB();
		$this->table = 'meets';
		return $select[0];
	}
	
	public function getUrlMeet(){
		$this->table = 'site_modul';
		$select = $this->dataBase->SelectFromDB( __LINE__);
		
		$where = "file = '%s'";

		$select -> addWhere(sprintf($where, $this->mod));
		
		$select = $select -> addFrom($this->table) -> queryDB();
		$this->table = 'meets';
		return $select[0]['redir'];
		
	}
        
        public function getPaginationPages($nums, $id_category = false){
            $select = $this->dataBase->SelectFromDB( __LINE__);
            $select->addFild("COUNT(*) AS cnt");
            $select -> addWhere("active='1'");
            if($id_category){
                    $where = "id_meet = '%d'";
                    $where = sprintf($where, $id_category);
                    $select -> addWhere($where);
                }
            $select = $select -> addFrom($this->table) -> queryDB();
            if($select)
                $count = $select[0]['cnt'];
            
            $pages = ceil($count/$nums);
	
            return $pages;
        }
        
        public function getPaginationMenu($paginator, $pages, $filter = false){
            $pag_menu = ""; 
			global $request;
			
			$char = $filter ? "?" : "";
            
            if($pages != 1){
                
                for($i = 1 ; $i <= $pages; $i++){
                        if($i == 1 && $paginator != $i)
                            $pag_menu .= '<span class="prev"><a href="page-'.($paginator-1).$char.$request->writeFilter('check').'"><< Предыдущая</a></span><span><a href="page-'.$i.$char.$request->writeFilter('check').'">'.$i.'</a></span>';
                        elseif($i == $pages && $paginator != $i)
                            $pag_menu .= '<span><a href="page-'.$i.$char.$request->writeFilter('check').'">'.$i.'</a></span><span class="next"><a href="page-'.($paginator+1).$char.$request->writeFilter('check').'">Следующая >></a></span>';
                        elseif($i == $paginator)
                                $pag_menu .= '<span>'.$i.'</span>';
                        else
                                $pag_menu .= '<span><a href="page-'.$i.$char.$request->writeFilter('check').'">'.$i.'</a></span>';
                }
            }
            
            return $pag_menu;
        }
        
        public function getItemByRedir($redir, $from = false){
            if($from)
                $this->table = 'meet_categories';
            
            $select = $this->dataBase->SelectFromDB( __LINE__);
            $where = "redir = '%s'";
            $where = sprintf($where, mysql_real_escape_string($redir));
            $select -> addWhere($where);
            $select = $select -> addFrom($this->table) -> queryDB();
            $this->table = 'meets';
            
            if($select){
                $select[0]['cat'] = $this->getMeetCategory($select[0]['id_meet']);
                return $select[0];
            }
        }
        
        public function setSearch($search_string, $category = false, $date = false, $offset = 0, $limit = 9){
            
            $this->order = "a.date";
            
            $select = $this->dataBase->SelectFromDB( __LINE__);
            
            $select->addFild("SQL_CALC_FOUND_ROWS a.id as id_meets, 
			a.name as name_meet, 
                        a.active,
			a.title as title_meet, 
			a.description as description_meet, 
			a.redir as redir_meet, 
			a.id_meet, 
			a.date, 
			a.anons, 
			a.text, 
			a.picture, 
			a.main,
			b.id as cat_id,
			b.name as cat_name,
			b.title as cat_title,
			b.description as cat_description,
			b.redir as cat_redir");
            
            $select -> addWhere("a.active='1'");
            
            if($search_string){
                $where = "MATCH(a.name, a.anons, a.text) AGAINST ('%s')";
                $where = sprintf($where, mysql_real_escape_string($search_string));
                $select->addWhere($where);
            }
            
            if($category){
                $where = "a.id_meet = '%d'";
                $where = sprintf($where, $category);
                $select->addWhere($where);
            }
            
            if($date){
                if(preg_match("/(\d{2})\.(\d{2})\.(\d{4})/", $date)){
                    $date = $this->getDate($date);
                    $where = "a.date = '%s'";
                    $where = sprintf($where, mysql_real_escape_string($date));
                    $select->addWhere($where);
                }else{
                    switch($date){
                        case 'today': $date = date("Y-m-d");
                            break;
                        case 'yersterday': $date = date("Y-m-d", time() - 24 * 60 * 60);
                            break;
                        case 'week': $date = date("Y-m-d", time() - 7 * 24 * 60 * 60);
                            break;
                        case 'month': $date = date("Y-m-d", time() - 30 * 24 * 60 * 60);
                            break;
                    }
                    if(preg_match("/(\d{4})-(\d{2})-(\d{2})/", $date)){
                        $where = "a.date > '%s'";
                        $where = sprintf($where, mysql_real_escape_string($date));
                        $select->addWhere($where);
                    }
                }
            }
            $select -> addOrder($this->order, (($this->order_as)?$this->order_as:'DESC'));
            $select->addLimit($offset, $limit);
            $select = $select -> addFrom($this->table." as a Left join meet_categories as b on a.id_meet=b.id") -> queryDB();  
            
            return $select;
        }
        
        public function getRows(){
			$select = $this->dataBase->SelectFromDB( __LINE__);
            $str = "SELECT FOUND_ROWS() as count";
			$result = $select->setQuery($str);
			if($result)
				return $result[0]['count'];
        }

}

?>
