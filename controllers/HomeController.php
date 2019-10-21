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
	
	public function actionGetSchedule()
	{
		if(isset($_POST['employeeId'])){
			$currentMonth = date('m');
			$currentYeahr = date('y');
			$schedule = Home::getSchedule($_POST['employeeId'], $currentYeahr, $currentMonth);
			echo json_encode($schedule, JSON_UNESCAPED_UNICODE);
		}
		else{
			echo null;
		}
		return true;
	}
	
	public function actionGetClientTimeBooking()
	{
		if(isset($_POST['employeeId']) && isset($_POST['time'])){
			$clientTimeBooking = Home::getClientTimeBooking($_POST['employeeId'], $_POST['time']);
			echo json_encode($clientTimeBooking, JSON_UNESCAPED_UNICODE);
		}
		else{
			echo null;
		}
		return true;
	}

	public function actionGetClient()
	{
		if(isset($_POST['phone'])){
			$client = Home::getClient($_POST['phone']);
			echo json_encode($client, JSON_UNESCAPED_UNICODE);
		}
		else{
			echo null;
		}
		return true;
	}
	
	public function actionBooking(){
		$result = null;
		if(isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['name']) && isset($_POST['masterId']) && isset($_POST['skillId']) && isset($_POST['fullTime'])){
			$comment = isset($_POST['comment']) ? $_POST['comment'] : ""; 
			$bookingResult = Home::booking($_POST['phone'], $_POST['email'], $_POST['name'], $_POST['masterId'], $_POST['skillId'], $_POST['fullTime'], $comment);
			$result = $bookingResult ? array( "Status" => 1, "Text" => "Вы записаны") : array( "Status" => 0, "Text" => "Не удалось записаться, попробуйте еще раз.");
		}
		else{
			$result = array( "Status" => 0, "Text" => "Неизвестная ошибка");
		}
		echo json_encode($result, JSON_UNESCAPED_UNICODE);
		return true;
	}
}