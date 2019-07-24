<?php

include_once ROOT. '/models/Admin.php';

class AdminController {
	
	public $menu = "";	
	public $head = "";
	public $footer = "";

	public function actionIndex()
	{		
		$this->CheckPermissions();
		$this->AddPartials();
		/*$adminInfo = Admin::getAdminInfo();/**/

		require_once(ROOT . '/views/admin/index.php');

		return true;
	}
	
	protected function CheckPermissions(){
		if (isset($_COOKIE['beautyLogin']))   
		{   
			print_r("Вы вошли как ".$_COOKIE['beautyLogin']);
		}
		else{
			header("Location: /authorize");
		}		
	}
	
	protected function AddPartials(){		
		$this->head = file_get_contents(ROOT.'\views\shared\adminContainerHeader.php');
		$this->menu = file_get_contents(ROOT.'\views\shared\adminMenu.php');	
		$this->footer = file_get_contents(ROOT.'\views\shared\adminContainerFooter.php');			
	}
	
}