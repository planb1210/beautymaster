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
		/*if(isset($_POST['phone'])){
			$client = Home::getClient($_POST['phone']);
			echo json_encode($client, JSON_UNESCAPED_UNICODE);
		}
		else{
			echo null;
		}/**/

		$rows = Booking::getRows();
		echo json_encode($rows, JSON_UNESCAPED_UNICODE);
		return true;
	}
}