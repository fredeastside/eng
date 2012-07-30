<?

//echo "<pre>"; print_r($_SESSION); echo "</pre>";

$admin = $modulObj->getUserObj();
$admin->load();

//printAr($_REQUEST);

if ($request->action=="logout")
{
	$admin->logout();
	Header ("Location: /");
	exit();
}

if ($request->action=="Login")
{
	//$absAdmin = new fmakeSiteAdministrator();
	if ($row = $admin->login($request->login, $request->password)) 
	{
		
		$admin->setLogin($row['id'], $row['login'], $row['role'], $row['name']); //login($id, $login, $acces)
		Header ("Location: /admin/index.php");
	}else{
		$error = true;
	}         
}

if (!$admin->isLogined()) 
{	   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
	<title>Сиситема администрирования Fmake</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link rel="stylesheet" type="text/css" href="/styles/admin/login.css" />
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
</head>

<body>
	
	<div id="page">
		<div id="form-login">
			<a href="http://www.fmake.ru" target="_blank"><div id="logo"></div></a>
			<div id="site"><a href="/" target="_blank"><? echo($_SERVER['HTTP_HOST']); ?></a></div>
			<div class="caption">Вход в систему администрирования</div>
			<form method="post" >
			<input type="hidden" name="action" value="Login" />
			<? if($error){ ?><p class="err">Неправильное имя пользователя или пароль.</p> <? } ?>
			<table class="table-login">
				<tr>
					<td>
						Логин
					</td>
				</tr>
				<tr>
					<td>
						<input type="text" class="login" name="login" />
					</td>
				</tr>
				<tr>
					<td>
						Пароль
					</td>
				</tr>
				<tr>
					<td>
						<input type="password" class="login" name="password"  />
					</td>
				</tr>
				<tr>
					<td>
						<input type="checkbox" name="save" id="save" /> <label class="small" for="save">Запомнить меня</label>
					</td>
				</tr>
				<tr>
					<td>
						<button class="fmk-button"><div><div><div><div>Войти</div></div></div></div></button>
					</td>
				</tr>
				<tr>
					<td>
						<a href="">Не могу вспомнить пароль</a>
					</td>
				</tr>
			</table>
			</form>
			<div class="version">
				версия: v0.0.1
			</div>
			<div class="create">
				<a href="" target="_blank">Создание сайтов</a> - Future-Group.ru
			</div>
		</div>
	</div>	
</body>
</html>
<?  
	exit();
}
?>