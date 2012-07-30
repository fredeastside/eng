<?php
/**
 * залогиневание пользователя
 */

$user = new fmakeSiteUser();
// если был залогинен, то загружаем его данные
$user -> load();


if(!$user->isLogined() && $_COOKIE['email']){
	$email = $request->getEscapeVal( $_COOKIE['c_email'] );
	$autication = $request->getEscapeVal( $_COOKIE['c_autication'] );
	if( $user->loginCokie($email, $autication)){
		//echo "Залогинен через куку";
		$message['login'] = 'Залогинен через куку';
	}
}
//printAr($user->isLogined());

if($request->code){
	$vk = new VKapi();
	$vk->login($request->code);
	header("HTTP/1.1 301 Moved Permanently");
	header('Location: /');
}

switch ($request->action){
	case 'login':
		
		// если уже залогинен
		if($user->isLogined()){
			break;
		}
		//echo('qq');
		$fmakePlaylist = new fmakePlaylist();
		$playlist = $fmakePlaylist->getPlaylistCookie();
		if( $user->login($request->getEscape('email'), $request->password) ){
			
		 	//echo "Вошел";
		 	$message['login'] = 'Вы вошли';
		 	if($request->save){
		 		$cookies = $user -> getAutication($request->email."_cookies");
		 		$user->addParam('cookies', $cookies );
		 		setcookie("c_email", $request->getEscape('email'),time()+3600*24*15,"/");
				setcookie("c_autication", $cookies,time()+3600*24*15,"/");				
		 	}
		 	//printAr($playlist);
		 	$fmakePlaylist->savePlaylistLoginCookieUser($playlist,$user->id);
		 	//echo $user->id;
		 	//exit();
		 	setcookie('playlist', '', strtotime("+1 month",time()), '/');
			header("HTTP/1.1 301 Moved Permanently");
			header('Location: /');
		}else{
			$error['password'] = '<span style="color:red;">Неверный логин - пароль</span>';
			$globalTemplateParam->set('error', $error);
		}
		
	break;
	case 'logout':
		
		// если не залогинен
		if(!$user->isLogined()){
			header('Location: /');
			break;
		}
		
		$user->logout();
	  	setcookie("c_email",'',time()-3600*24*60,"/");
		setcookie("c_autication",'',time()-3600*24*60,"/");
		header('Location: /');
		
	break;
	case 'autication':
		$id_user = intval($request->id_user);
		
		if($request->autication && $id_user && is_int($id_user) ){
			//echo 'qq';
			$userObj = new fmakeSiteUser($id_user);
			$user = $userObj->getInfo();
			if($user['autication'] == $request->autication && !$user['active']){
				$autication = true;
				$globalTemplateParam->set('autication', $autication);
				$globalTemplateParam->set('email', $user['email']);
				$globalTemplateParam->set('type', $request->type);
				$userObj->addParam("active", 1);
				$userObj->update();
				$userObj->loginAutication($user['email']);
				header("HTTP/1.1 301 Moved Permanently");
				header('Location: /');
			}else{
				$autication_error = true;
				$globalTemplateParam->set('autication_error', $autication_error);
			}
		}
		
	break;
}
if($user->id){
	$fmakeSiteUser = new fmakeSiteUser();
	$fmakeSiteUser->setId($user->id);
	$user_params = $fmakeSiteUser->getInfo();
}

$globalTemplateParam->set('user', $user);
$globalTemplateParam->set('user_params', $user_params);
/*echo('qq');
printAr($user_params);
*/	