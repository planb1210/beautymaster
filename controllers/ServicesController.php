<?php

include_once ROOT. '/models/Services.php';
include_once ROOT. '/controllers/AdminController.php';

class ServicesController extends AdminController{

	public function actionIndex(){		
		$this->CheckPermissions();
		$this->AddPartials();
				
		require_once(ROOT . '/views/services/index.php');
		return true;
	}
	
	public function actionEdit(){
	
		if($_POST['submit']=='Удалить'){
			Services::deleteService($_POST['id']);
			exit();
		}
		
		elseif(!isset($_POST['id'])){
			$newService = Services::addService($_POST['name'], $_POST['price'], $_POST['duration'], $_POST['divisionid'], $_POST['description']);
			echo json_encode($newService, JSON_UNESCAPED_UNICODE);
			return true;
		}	
		else{
			Services::editService($_POST['id'], $_POST['name'], $_POST['price'], $_POST['duration'], $_POST['divisionid'], $_POST['description']);
		}
		return true;
	}
		
	public function actionGetServices(){
		$services = Services::getServices();
		echo json_encode($services, JSON_UNESCAPED_UNICODE);
		return true;
	}
		
}
	

