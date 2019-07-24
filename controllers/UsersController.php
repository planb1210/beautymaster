<?php

include_once ROOT. '/models/Users.php';
include_once ROOT. '/controllers/AdminController.php';

class UsersController extends AdminController{

	public function actionIndex()
	{		
		$this->CheckPermissions();
		//$menu = file_get_contents(ROOT.'\views\shared\adminMenu.php');	
		$this->AddPartials();
		
		require_once(ROOT . '/views/users/index.php');

		return true;
	}
}