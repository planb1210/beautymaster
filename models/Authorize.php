<?php
class Authorize
{
	public static function getUserInfo($login) {
		$db = Db::getConnection();
		// Вытаскиваем из БД запись, у которой логин равняеться введенному
		
		$sql = $db->prepare("SELECT Id, Name, Password FROM users WHERE Name = :login");
		$sql->execute(array(':login' => $login));
		$result = $sql->fetch();

		return $result;
	}
}
