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
		$date = isset($_POST['date']) ? $_POST['date'] : null;

		$rows = Booking::getRows($master, $date);
		echo json_encode($rows, JSON_UNESCAPED_UNICODE);
		return true;
	}
}