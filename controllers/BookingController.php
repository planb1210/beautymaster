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
}