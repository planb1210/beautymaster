<?php

include_once ROOT. '/models/Authorize.php';

class AuthorizeController {

	public function actionIndex()
	{
		if(isset($_POST['login']) && isset($_POST['password']))
		{
			$userInfo = Authorize::getUserInfo($_POST['login'], $_POST['password']);
			print_r($userInfo);
			/*if($userInfo['password'] === md5(md5($_POST['password'])))
			{
				setcookie("beautyId", $userInfo['Id'], time()+60*60*24*30);
				header("Location: check.php"); exit();
			}/**/
		}
		require_once(ROOT . '/views/authorize/index.php');

		return true;
	}
}