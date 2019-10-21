<?php

include_once ROOT. '/models/Info.php';

class InfoController {

	public function actionIndex()
	{
		/*
		if(isset($_POST['id'])){
			print_r($_POST['id']);
		}/**/
		require_once(ROOT . '/views/info/index.php');

		return true;
	}
}