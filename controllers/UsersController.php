<?php

include_once ROOT. '/models/Users.php';
include_once ROOT. '/controllers/AdminController.php';

class UsersController extends AdminController{

	public function actionIndex()
	{		
		$this->CheckPermissions();
		$this->AddPartials();
		
		//$users = Users::getUsers();
		require_once(ROOT . '/views/users/index.php');

		return true;
	}
	
	public function EditUser()
	{		
	
		if( $_POST['id']==null){
			Users::addUser($_POST['name'], $_POST['email'], $_POST['password']);
		}
		else{
			Users::editUser($_POST['id'], $_POST['name'], $_POST['email'], $_POST['password']);
		}
		return true;
	}
}