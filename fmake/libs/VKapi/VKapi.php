<?php
 
 class VKapi {
     public $app_secret = 'ep7iJyWbfQrtMrByzf3K';
     private $app_id = '2853308';

    
     public function __construct($api_id='',$tocken='') {
         $this->api_id = $api_id;
		 $this->tocken = $tocken;
     }
    
	public function login($code) {
        $url = 'https://oauth.vkontakte.ru/access_token?client_id='.$this->app_id.'&client_secret='.$this->app_secret.'&code='.$code;
		$curl = new cURL();
		$curl -> init();
		$curl -> get($url);
		$result = $curl -> data();
		$res = json_decode($result,true);
		if($res['user_id']){
			$userObj = new fmakeSiteUser();
			$user = $userObj->getByIdVk($res['user_id']);
			if(!$user){
				$userObj->addParam("id_vk", $res['user_id']);
				$userObj->addParam("active", 1);
				$userObj->newItem();
				$user = $userObj->getInfo();
			}
			$userObj->id = $user[$userObj->idField];
			$userObj->login = $user['name'];
			$userObj->role = $user['role'];
			$userObj->status = true;
			$userObj -> save();
			
			$fmakePlaylist = new fmakePlaylist();
			$playlist = $fmakePlaylist->getPlaylistCookie();
			$fmakePlaylist->savePlaylistLoginCookieUser($playlist, $user[$userObj->idField]);
			setcookie('playlist', '', strtotime("+1 month",time()), '/');
			
			return true;
		}
		return false;
    }
    
    
	public function desktop_api($method, $data='') {

		if ($data) {
			foreach ($data as $k => $v) {
				$str .= ''.$k.'='.$v.'&';
			}
		}
		//ksort($postdata, SORT_STRING);
		$str .='access_token='.$this->tocken; 
		$url = 'https://api.vkontakte.ru/method/'.$method.'?'.$str;
		$curl = new cURL();
		$curl -> init();
		$curl -> get($url);
		$result = $curl -> data();
		$res = json_decode($result,true);
		return $res;
	}  
 }
 ?>