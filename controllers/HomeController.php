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
	
	public function actionTest()
	{
		echo $_POST['id']."------список мастеров";
		
		return true;
	}
}