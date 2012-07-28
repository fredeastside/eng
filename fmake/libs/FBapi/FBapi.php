<?php
 
 class FBapi {
     public $app_secret = 'cb254543affc7eb97834f22fe94c0b88';
     private $app_id = '339698956065200';

    
    public function login($code) {
		
        $url = 'https://graph.facebook.com/oauth/access_token?client_id='.$this->app_id.'&redirect_uri=http://my-cinema.fmake.ru/fb.php&client_secret='.$this->app_secret.'&code='.$code;
		$curl = new cURL();
		$curl -> init();
		$curl -> get($url);
		$result = $curl -> data();
		$params = null;
		 parse_str($result, $params);
		 $graph_url = "https://graph.facebook.com/me?access_token=". $params['access_token'];

		// $user = json_decode(file_get_contents($graph_url));
		$curl -> get($graph_url);
		$result = $curl -> data();
		$user_fb = json_decode($result);
		 //echo("Hello " . $user_fb->id);
		 $user_fb_id = $user_fb->id;
		if($user_fb_id){
			$userObj = new fmakeSiteUser();
			$user = $userObj->getByIdFb($user_fb_id);
			if(!$user){
				$userObj->addParam("id_fb", $user_fb_id);
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
 }
 ?>