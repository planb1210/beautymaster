<?php

include_once ROOT. '/models/Order.php';

class OrderController {

	public function actionIndex()
	{
		if(isset($_POST['EmployeId']) && isset($_POST['SkillId']) && isset($_POST['Time'])){
			print_r($_POST['EmployeId']);
			print_r($_POST['SkillId']);
			print_r($_POST['Time']);
		}else{
			header("Location: /");
		}
		require_once(ROOT . '/views/order/index.php');

		return true;
	}

}