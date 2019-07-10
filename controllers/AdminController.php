<?php

include_once ROOT. '/models/Admin.php';

class AdminController {

	public function actionIndex()
	{
		if (isset($_COOKIE['beautyLogin']))   
		{   
			print_r($_COOKIE['beautyLogin']);
		}
		else{
			header("Location: /authorize");
		}

		
		/*$adminInfo = Admin::getAdminInfo();/**/
		require_once(ROOT . '/views/admin/index.php');

		return true;
	}
}