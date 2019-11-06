<?php

include_once ROOT. '/models/Users.php';
include_once ROOT. '/models/Services.php';
include_once ROOT. '/controllers/AdminController.php';

class ProfileController extends AdminController {
	public function actionIndex() {
		$this->CheckPermissions();
		$this->AddPartials();
		require_once(ROOT . '/views/profile/index.php');
		return true;
	}
	
	public function actionDelete() {
		Services::deleteSkill($_POST['id'], $_POST['skillId']);
		return true;		
	}
	
	public function actionViewSkillsToAdd() {
		if(isset($_POST['skillsArr'])) {			
			$skillToAdd = Services::getServices($_POST['id'], $_POST['skillsArr']);
			echo json_encode($skillToAdd, JSON_UNESCAPED_UNICODE);
			return true;
		}
		else{$skillToAdd = Services::getServices();
			echo json_encode($skillToAdd, JSON_UNESCAPED_UNICODE);
			return true;
		}
	}
	
	public function actionAddSkill() {
		$newSkill = Services::addSkill($_POST['id'], $_POST['skillId']);
		echo json_encode($newSkill, JSON_UNESCAPED_UNICODE);
		return true;
	}
			
	public function actionGetUsers() {	
		$users = Users::getUsers($_POST['id']);
		echo json_encode($users, JSON_UNESCAPED_UNICODE);
		return true;
	}		
}
	

