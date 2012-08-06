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
	
	public function getMeets($main = false, $offset = 0, $limit = 9){
		
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
        
        public function getPaginationPages($nums){
            $select = $this->dataBase->SelectFromDB( __LINE__);
            $select->addFild("COUNT(*) AS cnt");
            $select -> addWhere("active='1'");
            $select = $select -> addFrom($this->table) -> queryDB();
            if($select)
                $count = $select[0]['cnt'];
            
            $pages = ceil($count/$nums);
	
            return $pages;
        }
        
        public function getPaginationMenu($paginator, $pages){
            $pag_menu = "";
            
            if($pages != 1){
                
                for($i = 1 ; $i <= $pages; $i++){
                        if($i == 1 && $paginator != $i)
                            $pag_menu .= '<span class="prev"><a href="page-'.($paginator-1).'"><< Предыдущая</a></span><span><a href="page-'.$i.'">'.$i.'</a></span>';
                        elseif($i == $pages && $paginator != $i)
                            $pag_menu .= '<span><a href="page-'.$i.'">'.$i.'</a></span><span class="next"><a href="page-'.($paginator+1).'">Следующая >></a></span>';
                        elseif($i == $paginator)
                                $pag_menu .= '<span>'.$i.'</span>';
                        else
                                $pag_menu .= '<span><a href="page-'.$i.'">'.$i.'</a></span>';
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

}

?>
