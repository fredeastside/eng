<?php

class fmakeNews extends fmakeCore {

    public $table = "news";
    public $order = "position";
    public $fileDirectory = "images/sitemodul_image/";
	public $order_as = "DESC";
	public $mod = "news";

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
        $images->resize(120, 80, true, $dirname, 'vm', false);
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
	
	public function getMainNew(){
		$select = $this->dataBase->SelectFromDB( __LINE__);

		$select -> addWhere("active='1'");
		
		$select -> addWhere("main='1'");
		
		$select = $select -> addFrom($this->table) -> queryDB();
		
		$category = $this->getNewsCategory($select[0]['id_category']);
		
		$select[0]['cat_name'] = $category['name'];
		$select[0]['cat_redir'] = $category['redir'];
		
		return $select[0];
	}
	
	public function getNews(){
		
		$this->order = "a.date";
		
		$select = $this->dataBase->SelectFromDB( __LINE__);
		
		$select->addFild("a.id as id_new, 
			a.name as name_new, 
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
		
		//$select -> addWhere("a.id_category=b.id");
		
		$select -> addWhere("a.active='1'");
		
		$select -> addWhere("a.main='0'");
		
		$select -> addOrder($this->order, (($this->order_as)?$this->order_as:'DESC'));
		
		$select->addLimit(0, 8);
		
		return $select -> addFrom($this->table." as a Left join news_categories as b on a.id_category=b.id") -> queryDB();
	}
	
	private function getNewsCategory($id_category){
		if(!$id_category)
			return false;
		
		$this->table = 'news_categories';
		
		$select = $this->dataBase->SelectFromDB( __LINE__);
		
		$where = "id = '%d'";

		$select -> addWhere(sprintf($where, $id_category));
		
		$select = $select -> addFrom($this->table) -> queryDB();
		$this->table = 'news';
		return $select[0];
	}
	
	public function getUrlNews(){
		$this->table = 'site_modul';
		$select = $this->dataBase->SelectFromDB( __LINE__);
		
		$where = "file = '%s'";

		$select -> addWhere(sprintf($where, $this->mod));
		
		$select = $select -> addFrom($this->table) -> queryDB();
		$this->table = 'news';
		return $select[0]['redir'];
		
	}

}

?>
