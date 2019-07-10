<?php

include_once ROOT. '/models/Admin.php';

class AdminController {

	public function actionIndex()
	{
		$adminInfo = Admin::getAdminInfo();
		require_once(ROOT . '/views/admin/index.php');

		return true;
	}
}