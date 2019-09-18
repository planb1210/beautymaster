<?php

include_once ROOT. '/models/Users.php';
include_once ROOT. '/models/Services.php';
class ProfileController{

	/*public function actionIndex($id){		
		
		require_once(ROOT . '/views/profile/index.php');
		$this->actionGetUsers($id);
		return true;
	}*/
	
	public function actionEdit(){
	
		if($_POST['submit']=='Удалить'){
			Services::deleteSkill($_POST['id'], $_POST['skillId']);
			exit();
			}		
		elseif($_POST['submit']=='Отобразить'){			
			$skillToAdd = Services::getServices($_POST['id'], $_POST['skillsArr']);
			echo json_encode($skillToAdd, JSON_UNESCAPED_UNICODE);
			return true;
			}			
		else{$newSkill = Services::addSkill($_POST['id'], $_POST['skillId']);
			echo json_encode($newSkill, JSON_UNESCAPED_UNICODE);
			return true;			
			}
				
		return true;
		
		}
		
	public function actionGetUsers() {		
		$users = Users::getUsers($_POST['id']);
		echo json_encode($users, JSON_UNESCAPED_UNICODE);
		return true;
	}
		
}
	

