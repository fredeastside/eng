<?php

class fmakePhotoReports extends fmakeCore {

    public $table = "photo_reports";
    public $order = "position";
    public $fileDirectory = "images/sitemodul_image/gallery/";
    public $order_as = "DESC";
    public $mod = "photo_reports";
    //public $prefix = "";

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
        $images->resize(190, 107, true, $dirname, 'mini', false);

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
	
	public function getReports($main = false, $offset = 0, $limit = 2){
		
		$this->order = "date";
		
		$select = $this->dataBase->SelectFromDB( __LINE__);

		$select -> addWhere("active='1'");
		
                if($main)
                    $select -> addWhere("main='1'");
		
		$select -> addOrder($this->order, (($this->order_as)?$this->order_as:'DESC'));
		
		$select->addLimit($offset, $limit);
		
		return $select -> addFrom($this->table) -> queryDB();
	}
	/*
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
	*/
	public function getUrlReports(){
		$this->table = 'site_modul';
		$select = $this->dataBase->SelectFromDB( __LINE__);
		
		$where = "file = '%s'";

		$select -> addWhere(sprintf($where, $this->mod));
		
		$select = $select -> addFrom($this->table) -> queryDB();
		$this->table = $this->prefix . 'photo_reports';
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

        public function getItemByRedir($redir){

            $select = $this->dataBase->SelectFromDB( __LINE__);
            $where = "redir = '%s'";
            $where = sprintf($where, mysql_real_escape_string($redir));
            $select -> addWhere($where);
            $select = $select -> addFrom($this->table) -> queryDB();
            
            return $select[0];
        }
        
        public function getGalleryId($id_modul){
            if(!$id_modul)
                return false;
            
            $select = $this->dataBase->SelectFromDB( __LINE__);
            $where = "id_site_modul = '%d'";
            $where = sprintf($where, $id_modul);
            $select -> addWhere($where);
            $select = $select -> addFrom("site_modul_gallery") -> queryDB();
            
            return $select[0]['id_gallery'];
        }
        
        public function getPhotos($id_gallery){
            if(!$id_gallery)
                return false;
            
            $this->order = "position";
            
            $select = $this->dataBase->SelectFromDB( __LINE__);
            $where = "id_catalog = '%d'";
            $where = sprintf($where, $id_gallery);
            $select -> addWhere($where);
            $select -> addOrder($this->order, 'ASC');
            return $select -> addFrom("gallery_images") -> queryDB();
        }

}

?>
