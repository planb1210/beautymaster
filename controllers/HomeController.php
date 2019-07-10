<?php

include_once ROOT. '/models/Home.php';

class HomeController {

	public function actionIndex()
	{
		
		$newsList = array();
		$newsList = Home::getNewsList();

		require_once(ROOT . '/views/home/index.php');

		return true;
	}
}