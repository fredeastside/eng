<?php

class fmakeNews extends fmakeCore {

    public $table = "news";
    public $order = "position";
    public $fileDirectory = "images/sitemodul_image/";
    public $order_as = "DESC";
    public $mod = "news";
    public $prefix = "";

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
        $images->resize(171, 96, true, $dirname, 'mini', false);

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
	
	public function getNews($main = false, $offset = 0, $limit = 9, $id_category = false){
		
		$this->order = "a.date";
		
		$select = $this->dataBase->SelectFromDB( __LINE__);
		
		$select->addFild("a.id as id_new, 
			a.name as name_new, 
                        a.active,
			a.title as title_new, 
			a.description as description_new, 
			a.redir as redir_new, 
			a.id_category, 
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
		
		if($id_category){
                    $where = "a.id_category = '%d'";
                    $where = sprintf($where, $id_category);
                    $select -> addWhere($where);
                }
		$select -> addWhere("a.active='1'");
		
                if($main)
                    $select -> addWhere("a.main='1'");
		
		$select -> addOrder($this->order, (($this->order_as)?$this->order_as:'DESC'));
		
		$select->addLimit($offset, $limit);
		
		return $select -> addFrom($this->table." as a Left join ".$this->prefix."news_categories as b on a.id_category=b.id") -> queryDB();
	}
	
	private function getNewsCategory($id_category){
		if(!$id_category)
			return false;
		
		$this->table = $this->prefix . 'news_categories';
		
		$select = $this->dataBase->SelectFromDB( __LINE__);
		
		$where = "id = '%d'";

		$select -> addWhere(sprintf($where, $id_category));
		
		$select = $select -> addFrom($this->table) -> queryDB();
		$this->table = $this->prefix . 'news';
		return $select[0];
	}
	
	public function getUrlNews(){
		$this->table = 'site_modul';
		$select = $this->dataBase->SelectFromDB( __LINE__);
		
		$where = "file = '%s'";

		$select -> addWhere(sprintf($where, $this->mod));
		
		$select = $select -> addFrom($this->table) -> queryDB();
		$this->table = $this->prefix . 'news';
		return $select[0];
		
	}
        
        public function getPaginationPages($nums, $id_category = false){
            $select = $this->dataBase->SelectFromDB( __LINE__);
            $select->addFild("COUNT(*) AS cnt");
            $select -> addWhere("active='1'");
            if($id_category){
                    $where = "id_category = '%d'";
                    $where = sprintf($where, $id_category);
                    $select -> addWhere($where);
                }
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
                $this->table = $this->prefix.'news_categories';
            
            $select = $this->dataBase->SelectFromDB( __LINE__);
            $where = "redir = '%s'";
            $where = sprintf($where, mysql_real_escape_string($redir));
            $select -> addWhere($where);
            $select = $select -> addFrom($this->table) -> queryDB();
            $this->table = $this->prefix.'news';
            
            if($select){
                $select[0]['cat'] = $this->getNewsCategory($select[0]['id_category']);
                return $select[0];
            }
        }

}

?>
