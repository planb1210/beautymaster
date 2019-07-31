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
		$masters = Home::getMasters();
		echo json_encode($masters, JSON_UNESCAPED_UNICODE);
		return true;
	}
}