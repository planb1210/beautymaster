<?php

include_once ROOT. '/models/Home.php';

class HomeController {

	public function actionIndex()
	{
		
		//$newsList = array();
		//$newsList = Home::getNewsList();

		if(isset($_POST['id'])){
			print_r($_POST['id']);
		}
		require_once(ROOT . '/views/home/index.php');

		return true;
	}
	
	public function actionGetMasters()
	{
		$id = null;
		if(isset($_POST['id'])){
			$id = $_POST['id'];
		}
		$masters = Home::getMasters($id);
		echo json_encode($masters, JSON_UNESCAPED_UNICODE);
		return true;
	}
	
	public function actionGetSkills()
	{
		$id = null;
		if(isset($_POST['id'])){
			$id = $_POST['id'];
		}
		$skills = Home::getSkills($id);
		//echo $skills;
		echo json_encode($skills, JSON_UNESCAPED_UNICODE);
		return true;
	}
}