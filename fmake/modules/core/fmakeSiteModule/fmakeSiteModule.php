<?php

class fmakeSiteModule extends fmakeCore {

	public $table = "site_modul";
	public $setName = "";
	public $fileDirectory = "images/sitemodul_image/";

	/**
	 * 
	 * 
	 * @var ArrayObject fmakeSiteModule_ExtensionInterface 
	 */
	protected $extensions;
	public $order = "position";
	public $tree = array();
	public static $adminModulAccessQuery = false;

	public function __isset($key) {

		return isset($this->params[$key]);
	}

	function __get($nm) {
		return $this->__isset($nm) ? $this->params[$nm] : false;
	}

	function setRedir($redir) {
		$select = $this->dataBase->SelectFromDB(__LINE__);
		$result = $select->addFild("id")->addFrom($this->table)->addWhere("redir = '" . $redir . "'")->queryDB();
		$this->id = $result[0]['id'];
	}

	function getChilds($id = null, $active = false, $inmenu = false) {
		//echo('childs '.$type.'<br/>');
		if ($id === null)
			$id = $this->id;

		$select = $this->dataBase->SelectFromDB(__LINE__);

		if ($active)
			$select->addWhere("active='1'");
		if ($inmenu)
			$select->addWhere("inmenu='1'");

		return $select->addFrom($this->table)->addWhere("parent='" . $id . "'")->addOrder($this->order)->queryDB();
	}

	function getAllAsTree($parent = 0, $level = 0, $active = false, $inmenu = false, $level_vlojennost = false) {
		//$array = array(2,3,4,6);
		if ($level != $level_vlojennost || !$level_vlojennost) {
			$level++;
			$items = $this->getChilds($parent, $active, $inmenu);
			//printAr($items);
			if ($items) {
				foreach ($items as $item) {
					//if($item['id'] == 2 || $item['id'] == 3 || $item['id'] == 4 || $item['id'] == 6) continue;
					if ($item['delete_security'])
						continue;
					$item['level'] = $level;
					$this->tree[] = $item;
					$this->getAllAsTree($item['id'], $level, $active, $inmenu, $level_vlojennost);
				}
			}
		}
		return $this->tree;
	}

	function getAllForMenu($parent = 0, $active = false, &$q, &$flag, $inmenu, $acces = false, $level = 0, $level_vlojennost = false, $type = false) {
		if ($level != $level_vlojennost || !$level_vlojennost) {
			$items = $this->getChilds($parent, $active, $inmenu, $type);

			if (!$items)
				return;
			foreach ($items as $key => $item) {
				if ($items[$key]['id'] == $this->id) {
					$items[$key]['status'] = true;
					$flag = !$flag;
					$q = true;
				}

				if ($flag)
					$items[$key]['status'] = &$q;
				$items[$key]['child'] = $this->getAllForMenu($item['id'], $active, $q, $flag, $inmenu, $acces, $level++, $level_vlojennost, $type);
				if ($flag)
					unset($items[$key]['status']);

			}
		}
		return $items;
	}
        
        function getAllForMenuSite($parent = 0, $active = false, &$q, &$flag, $inmenu, $acces = false, $level = 0, $level_vlojennost = false, $type = false) {
		if ($level != $level_vlojennost || !$level_vlojennost) {
			$items = $this->getChilds($parent, $active, $inmenu, $type);

			if (!$items)
				return;
			foreach ($items as $key => $item) {
				if ($items[$key]['id'] == $this->id) {
					$items[$key]['status'] = true;
					$flag = !$flag;
					$q = true;
				}

				if ($flag)
					$items[$key]['status'] = &$q;
				$items[$key]['child'] = $this->getAllForMenu($item['id'], $active, $q, $flag, $inmenu, $acces, $level++, $level_vlojennost, $type);
				if ($flag)
					unset($items[$key]['status']);

				if ($items[$key]['file'] == 'news') {
					$cat_obj = new fmakeNewsCategories();
					$cat_obj->order = "position";
					$cat = $cat_obj->getAll(true);
					$items[$key]['child'] = $cat;
				}
			}
		}
		return $items;
	}

	function getModul($modul) {

		$where = array();
		if ($modul) {
			$where[sizeof($where)] = "`redir` = '" . $modul . "'";
		} else {
			$where[sizeof($where)] = "`index` = '1'";
		}

		$arr = $this->getWhere($where);

		if ($arr[0]) {
			foreach ($arr[0] as $key => $mod) {
				$this->addParam($key, $mod);
			}
		}
		return $arr;
	}

	function error404() {

		global $globalTemplateParam, $twig;
		HttpError(404);
		$template = $twig->loadTemplate('404.tpl');
		$template->display($globalTemplateParam->get());
		exit();
	}

	function getPage($modul, $twig, $url = false) {

		if ($url) {
			$param = explode('/', $url);
			$modul = $param[0];
		}else
			$url = $modul;

		$this->getModul($modul);
		// находим страницы из других 
		if (!$this->id && $this->extensions) {
			foreach ($this->extensions as $name => &$obj) {
				if ($obj->getModul($modul)) {
					$this->params = $obj->params;
					$this->setName = $name;
					break;
				}
			}
		} else {
			$this->setName = $this->getName();
		}

		if (!$this->id) {
			global $globalTemplateParam;
			HttpError(404);
			$template = $twig->loadTemplate('404.tpl');
			$template->display($globalTemplateParam->get());
			exit();
		}
	}

	function addExtension(fmakeSiteModule_ExtensionInterface $extension) {

		$this->extensions[$extension->getName()] = $extension;
	}

	function getUp() {

		$order = $this->getInfo();
		$select = $this->dataBase->SelectFromDB(__LINE__);
		$arr = $select->addFrom($this->table)->addWhere("`parent` = '{$order['parent']}' ")->addWhere("`position` < '{$order['position']}' ")->addOrder('position', 'DESC')->addLimit(0, 1)->queryDB();
		$arr = $arr[0];

		if ($arr) {
			$update = $this->dataBase->UpdateDB(__LINE__);
			$update->addTable($this->table)->addFild("`position`", $order['position'])->addWhere("`" . $this->idField . "` = '" . $arr['id'] . "'")->queryDB();
			$update->addTable($this->table)->addFild("`position`", $arr['position'])->addWhere("`" . $this->idField . "` = '" . $this->id . "'")->queryDB();
		}
	}

	function getDown() {

		$order = $this->getInfo();
		$select = $this->dataBase->SelectFromDB(__LINE__);
		$arr = $select->addFrom($this->table)->addWhere("`parent` = '{$order['parent']}' ")->addWhere("`position` > '{$order['position']}' ")->addOrder('position', 'ASC')->addLimit(0, 1)->queryDB();
		$arr = $arr[0];

		if ($arr) {

			$update = $this->dataBase->UpdateDB(__LINE__);
			$update->addTable($this->table)->addFild("`position`", $order['position'])->addWhere("`id` = '" . $arr['id'] . "'")->queryDB();
			$update->addTable($this->table)->addFild("`position`", $arr['position'])->addWhere("`id` = '" . $this->id . "'")->queryDB();
		}
	}

	/*
	 * делаем две записи на одном уровне, устонавливает позицуии
	 */

	function setGeneralParent($from, $to) {
		$this->setId($to);
		$info = $this->getInfo();
		// добавляем объект в дерево
		$this->setId($from);
		$this->addParam("parent", $info['parent']);
		$this->update();
		$select = $this->dataBase->SelectFromDB(__LINE__);
		$arr = $select->addFild("id")->addFrom($this->table)->addWhere("`parent` = '" . $info['parent'] . "' ")->addOrder('position', 'ASC')->queryDB();
		$fromNum = 0;
		$toNum = 0;
		for ($i = 0; $i < sizeof($arr); $i++) {
			if ($fromNum && $toNum)
				break;

			if ($arr[$i]['id'] == $from) {
				$fromNum = $i + 1;
			} else if ($arr[$i]['id'] == $to) {
				$toNum = $i + 1;
			}
		}
		$action = $fromNum - $toNum - 1; // -1 так как они должны быть друг под другом
		$this->setId($from);
		while ($action > 0) {
			$this->getUp();
			$action--;
		}
		while ($action < 0) {
			$this->getDown();
			$action++;
		}
	}

	/*
	 * выставляем родителя и делаем самой последней
	 */

	function setParent($child, $parent) {
		$this->setId($child);
		$this->addParam("parent", $parent);
		$this->update();

		$select = $this->dataBase->SelectFromDB(__LINE__);
		$arr = $select->addFild("id")->addFrom($this->table)->addWhere("`parent` = '" . $info['parent'] . "' ")->addOrder('position', 'ASC')->queryDB();
		$childNum = 0;
		for ($i = 0; $i < sizeof($arr); $i++) {
			if ($arr[$i]['id'] == $child) {
				$childNum = $i;
				break;
			}
		}

		$action = sizeof($arr) - $childNum;

		$this->setId($child);
		while ($action > 0) {
			$this->getDown();
			$action--;
		}
	}

	function getName() {

		return 'siteModul';
	}

	/**
	 * 
	 * Удаление записи, перед использованием надо установить id записи
	 */
	function delete() {
		$select = $this->dataBase->SelectFromDB(__LINE__);
		$isdelete = $select->addFrom($this->table)->addFild('delete_security')->addWhere("`" . $this->idField . "`='" . $this->id . "'")->queryDB();
		if ($isdelete[0]['delete_security'] == '0') {
			$delete = $this->dataBase->DeleteFromDB(__LINE__);
			$delete->addTable($this->table)->addWhere("`" . $this->idField . "`='" . $this->id . "'")->queryDB();
		}
	}

	function getByPage($parent, $limit, $page, $type = false, $active = false) {
		$select = $this->dataBase->SelectFromDB(__LINE__);
		$order = $this->order;
		if ($active)
			$select->addWhere("active='1'");

		if ($type) {
			$fmakeTypeTable = new fmakeTypeTable();
			$table = "," . $fmakeTypeTable->getTable($type);
			$select->addWhere($fmakeTypeTable->getTable($type) . '.id = ' . $this->table . '.id');
			$order = "date";
		}
		return $select->addFrom($this->table . $table)->addOrder($order, DESC)->addWhere($this->table . '.parent in (' . $parent . ')')->addLimit((($page - 1) * $limit), $limit)->queryDB();
	}

	function getByPageCount($parent, $type = false, $active = false) {
		$select = $this->dataBase->SelectFromDB(__LINE__);

		if ($active)
			$select->addWhere("active='1'");
		if ($type) {
			$fmakeTypeTable = new fmakeTypeTable();
			$table = "," . $fmakeTypeTable->getTable($type);
			$select->addWhere($fmakeTypeTable->getTable($type) . '.id = ' . $this->table . '.id');
		}
		$result = $select->addFild("COUNT(*)")->addFrom($this->table . $table)->addOrder($this->order, DESC)->addWhere($this->table . '.parent in (' . $parent . ')')->queryDB();
		return $result[0]["COUNT(*)"];
	}

	function getByPageTags($parent, $limit, $page, $id_tag, $active = false) {
		$select = $this->dataBase->SelectFromDB(__LINE__);
		if ($active)
			$select->addWhere("active='1'");
		//echo($date_start.'q<br>q'.$date_end.'<br>');
		$fmakeTag = new fmakeSiteModule_tags();
		if ($id_tag) {
			$select->addWhere($fmakeTag->table_notice_tags . '.id_site_modul = ' . $this->table . '.id')->addWhere($fmakeTag->table_notice_tags . '.id_tag = ' . $id_tag);
		} else {
			return false;
		}
		return $select->addFrom($this->table . ',' . $fmakeTag->table_notice_tags)->addOrder($this->order, DESC)->addWhere($this->table . '.parent = ' . $parent)->addLimit((($page - 1) * $limit), $limit)->queryDB();
	}

	function getByPageTagsCount($parent, $id_tag, $active = false) {
		$select = $this->dataBase->SelectFromDB(__LINE__);
		if ($active)
			$select->addWhere("active='1'");
		//echo($date_start.'q<br>q'.$date_end.'<br>');
		$fmakeTag = new fmakeSiteModule_tags();
		if ($id_tag) {
			$select->addWhere($fmakeTag->table_notice_tags . '.id_site_modul = ' . $this->table . '.id')->addWhere($fmakeTag->table_notice_tags . '.id_tag = ' . $id_tag);
		} else {
			return false;
		}
		$result = $select->addFild("COUNT(*)")->addFrom($this->table . ',' . $fmakeTag->table_notice_tags)->addOrder($this->order, DESC)->addWhere($this->table . '.parent = ' . $parent)->addLimit((($page - 1) * $limit), $limit)->queryDB();
		return $result[0]["COUNT(*)"];
	}

	function getParent($parent) { // Берем родителя раздела

		$select = $this->dataBase->SelectFromDB(__LINE__);
		$parent = $select->addFrom($this->table)->addWhere("active='1'")->addWhere("{$this->idField}='$parent'")->addOrder($this->order)->queryDB();
		return $parent[0];
	}

	function getParents($parent) {

		$parents[] = $this->getParent($parent);
		if ($parents[sizeof($parents) - 1]['parent']) {
			$subparents = $this->getParents($parents[sizeof($parents) - 1]['parent']);
			if ($subparents) {
				$parents = array_merge($parents, $subparents);
			}
		}
		return $parents;
	}

	function getBreadCrumbs($id) {
		$this->setId($id);
		$breadCrumbs[] = $this->getInfo();

		if ($parents = $this->getParents($breadCrumbs[0]['parent'])) {
			$breadCrumbs = array_merge($breadCrumbs, $parents);
		}

		$str = "";
		$sizeI = sizeof($breadCrumbs);

		for ($i = $sizeI - 1; $i >= 0; $i--) {
			/* if( !$breadCrumbs[$i]['showlink'] ){
			  continue;
			  } */
			if ($breadCrumbs[$i]['caption'] == '') {
				continue;
			}
			$str .= "/" . $breadCrumbs[$i]['redir'];
			$ans[] = array("caption" => $breadCrumbs[$i]['caption'], "link" => $str . "/", "redir" => $breadCrumbs[$i]['redir'], "id" => $breadCrumbs[$i]['id']);
		}
		//printAr($ans);
		//array("caption"=>$modul->caption,"link"=>"/".$modul->redir."/");
		return $ans;
	}

	function isAccesPage($modul_id, $role) {
		$user = new fmakeSiteUser();
		$adminModulAccess = $user->getAccesObj();
		// генерируем запрос который будет выгружать доступные модули для пользователя
		self::$adminModulAccessQuery = $adminModulAccess->getAccessStandartQuery($role);

		$field = array('id');
		$where = array();
		$where[sizeof($where)] = $this->idField . " in (" . self::$adminModulAccessQuery . ")";
		$where[sizeof($where)] = "`$this->idField` = '{$modul_id}'";
		if ($this->getFieldWhere($field, $where)) {
			return false;
		}
		return true;
	}

	///////// возвращает true или false можно войти на эту страницу или нет
	function getAccesParents($modul_id, $role) {
		//echo($modul_id."q</br>");
		if (!$this->isAccesPage($modul_id, $role)) {
			return false;
		} else {
			$this->setId($modul_id);
			$item = ($this->getInfo());
			$parent = ( $this->getParent($item['parent']) );
			//printAr($parent);
			if ($parent) {
				return $this->getAccesParents($parent[$this->idField], $role);
			}
		}
		return true;
	}

	///////// вызывает страницу ошибки доступа
	function isAccesable($twig, $modul_id, $role) {

		if (!$this->getAccesParents($modul_id, $role)) {
			//echo("aa");
			global $globalTemplateParam;
			HttpError(404);
			$globalTemplateParam->set('url', $_SERVER['REQUEST_URI']);
			$template = $twig->loadTemplate('error_acces.tpl');
			$template->display($globalTemplateParam->get());
			exit();
		}
	}

	function itemForvard($id_item, $parent) {
		$select = $this->dataBase->SelectFromDB(__LINE__);
		$result = $select->addFild("position")->addFrom($this->table)->addWhere($this->idField . " = " . $id_item)->queryDB();
		$select = $this->dataBase->SelectFromDB(__LINE__);
		$result = $select->addFrom($this->table)->addOrder('position', 'ASC')->addWhere("position >" . $result[0]['position'])->addWhere("parent = " . $parent)->addLimit(0, 1)->queryDB();
		return $result[0];
	}

	function itemBack($id_item, $parent) {
		$select = $this->dataBase->SelectFromDB(__LINE__);
		$result = $select->addFild("position")->addFrom($this->table)->addWhere($this->idField . " = " . $id_item)->queryDB();
		$select = $this->dataBase->SelectFromDB(__LINE__);
		$result = $select->addFrom($this->table)->addOrder('position', 'DESC')->addWhere("position <" . $result[0]['position'])->addWhere("parent = " . $parent)->addLimit(0, 1)->queryDB();
		return $result[0];
	}

	function itemForvardPress($id_item, $parent, $id_tag) {
		$select = $this->dataBase->SelectFromDB(__LINE__);
		$result = $select->addFild("position")->addFrom($this->table)->addWhere($this->idField . " = " . $id_item)->queryDB();
		$select = $this->dataBase->SelectFromDB(__LINE__);
		$fmakeTag = new fmakeSiteModule_tags();
		if ($id_tag) {
			$select->addWhere($fmakeTag->table_notice_tags . '.id_site_modul = ' . $this->table . '.id')->addWhere($fmakeTag->table_notice_tags . '.id_tag = ' . $id_tag);
			$table = ',' . $fmakeTag->table_notice_tags;
		}
		$result = $select->addFrom($this->table . $table)->addOrder('position', 'ASC')->addWhere("position >" . $result[0]['position'])->addWhere("parent = " . $parent)->addLimit(0, 1)->queryDB();
		return $result[0];
	}

	function itemBackPress($id_item, $parent, $id_tag) {
		$select = $this->dataBase->SelectFromDB(__LINE__);
		$result = $select->addFild("position")->addFrom($this->table)->addWhere($this->idField . " = " . $id_item)->queryDB();
		$select = $this->dataBase->SelectFromDB(__LINE__);
		$fmakeTag = new fmakeSiteModule_tags();
		if ($id_tag) {
			$select->addWhere($fmakeTag->table_notice_tags . '.id_site_modul = ' . $this->table . '.id')->addWhere($fmakeTag->table_notice_tags . '.id_tag = ' . $id_tag);
			$table = ',' . $fmakeTag->table_notice_tags;
		}
		$result = $select->addFrom($this->table . $table)->addOrder('position', 'DESC')->addWhere("position <" . $result[0]['position'])->addWhere("parent = " . $parent)->addLimit(0, 1)->queryDB();
		return $result[0];
	}

	function mainPrintRazdel($cat, $type, $count=false, $active=false, $inmenu = false, $_date = true, $all = false, $rand = false) {
		$select = $this->dataBase->SelectFromDB(__LINE__);
		if ($active)
			$select->addWhere("active='1'");
		if ($count)
			$select->addLimit(0, $count);
		$fmakeType = new fmakeTypeTable();
		$table = $fmakeType->getTable($type);
		$date = time();
		if ($inmenu) {
			$select->addWhere("inmenu = '1'");
		}
		if ($_date) {
			$select->addOrder($table . ".date", DESC);
		}
		if (!$all) {
			$select->addWhere("parent = " . $cat);
		}
		if ($rand) {
			$select->addOrder("RAND()");
		}
		return $select->addFrom($this->table . "," . $table)->addWhere($this->table . ".id = " . $table . ".id")->queryDB();
	}

	function getFullDate($cat, $type, $id_tag=false) {
		$select = $this->dataBase->SelectFromDB(__LINE__);
		$fmakeType = new fmakeTypeTable();
		$table = $fmakeType->getTable($type);
		$fmakeTag = new fmakeSiteModule_tags();
		if ($id_tag) {
			$select->addWhere($fmakeTag->table_notice_tags . '.id_site_modul = ' . $this->table . '.id')->addWhere($fmakeTag->table_notice_tags . '.id_tag = ' . $id_tag);
			$table_tag = ',' . $fmakeTag->table_notice_tags;
		}
		return $select->addFild('date_creation')->addFrom($this->table . "," . $table . $table_tag)->addWhere($this->table . "." . $this->idField . " = " . $table . ".id")->addWhere("parent = " . $cat)->queryDB();
	}

	function getAllOld($cat, $type, $active=false) {
		$select = $this->dataBase->SelectFromDB(__LINE__);
		/* if($active)
		  $select -> addWhere("active = 1"); */
		$fmakeType = new fmakeTypeTable();
		$table = $fmakeType->getTable($type);
		$date = time();
		return $select->addFrom($this->table . "," . $table)->addOrder($this->order, ASC)->addWhere("date < " . $date)->addWhere($this->table . "." . $this->idField . " = " . $table . ".id")->addWhere("parent = " . $cat)->queryDB();
	}

	function getAllOldCount($cat, $type, $active=false) {
		$select = $this->dataBase->SelectFromDB(__LINE__);
		if ($active)
			$select->addWhere("active='1'");
		$fmakeType = new fmakeTypeTable();
		$table = $fmakeType->getTable($type);
		$date = time();
		$result = $select->addFild("COUNT(*)")->addFrom($this->table . "," . $table)->addOrder($this->order, DESC)->addWhere($table . ".date < " . $date)->addWhere($this->table . "." . $this->idField . " = " . $table . ".id")->addWhere("parent = " . $cat)->queryDB();
		return $result[0]["COUNT(*)"];
	}

	/**
	 * 
	 * добавление файла
	 * @param string $tempName
	 * @param string $name
	 */
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

		//$this->addParam('picture', $name);
		//$this->update();
	}

}