<?php

include_once ROOT. '/models/Authorize.php';

class AuthorizeController {

	public function actionIndex()
	{
		if(isset($_POST['login']) && isset($_POST['password']))
		{
			$userInfo = Authorize::getUserInfo($_POST['login'], $_POST['password']);
			
			if($userInfo['Password'] === md5(md5($_POST['password'])))
			{
				setcookie("beautyLogin", $userInfo['Name'], time()+60*60*24*30);
				header("Location: /admin");
				exit();				
			}
		}
		require_once(ROOT . '/views/authorize/index.php');

		return true;
	}
}