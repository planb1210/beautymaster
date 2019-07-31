<?php

include_once ROOT. '/models/Users.php';
include_once ROOT. '/controllers/AdminController.php';

class UsersController extends AdminController{

	public function actionIndex()
	{		
		//$this->CheckPermissions();
		$this->AddPartials();
				
		require_once(ROOT . '/views/users/index.php');
				
		return true;
		
		
	}
	
	public function actionEdit(){
	
		if($_POST['submit']=='Удалить'){
			Users::deleteUser($_POST['id']);
			exit();
			}
		elseif($_POST['submit']=='Отобразить'){
			Users::getUsers();
			exit();
			}
		elseif(!isset($_POST['id'])){
			Users::addUser($_POST['name'], $_POST['email'], $_POST['password']);
		}
		
		else{
			Users::editUser($_POST['id'], $_POST['name'], $_POST['email'], $_POST['password']);
		}
		return true;
		
		}
		
	}
	

