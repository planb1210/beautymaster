<?php

include_once ROOT. '/models/Booking.php';
include_once ROOT. '/controllers/AdminController.php';

class BookingController extends AdminController{

	public function actionIndex()
	{		
		$this->CheckPermissions();
		$this->AddPartials();
				
		require_once(ROOT . '/views/booking/index.php');
				
		return true;
	}
	
	public function actionGetRows()
	{
		$master = isset($_POST['master']) ? $_POST['master'] : null;
		$client = isset($_POST['client']) ? $_POST['client'] : null;
		$date = isset($_POST['date']) ? $_POST['date'] : null;
		$page = isset($_POST['page']) ? $_POST['page'] : 1;		

		$rows = Booking::getRows($master, $client, $date, $page);
		echo json_encode($rows, JSON_UNESCAPED_UNICODE);
		return true;
	}
	
	public function actionGetCountRows(){
		$master = isset($_POST['master']) ? $_POST['master'] : null;
		$client = isset($_POST['client']) ? $_POST['client'] : null;
		$date = isset($_POST['date']) ? $_POST['date'] : null;

		$count = Booking::getCountRows($master, $client, $date);
		echo json_encode($count, JSON_UNESCAPED_UNICODE);
		return true;
	}
}