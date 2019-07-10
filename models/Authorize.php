<?php
class Authorize
{
	public static function getUserInfo($login, $password) {
		$db = Db::getConnection();
		// Вытаскиваем из БД запись, у которой логин равняеться введенному
		$login=mysql_real_escape_string($login);
		$password=mysql_real_escape_string($password);
		
		$sql = $db->prepare("SELECT Id, Name FROM Users WHERE Name =? AND Password =?");
		$sql->execute(array($login, $password));

		$result = $sql->fetch();
		var_dump($result);
		return $result;
	}
}