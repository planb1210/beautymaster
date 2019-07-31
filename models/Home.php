<?php
class Home
{
	public static function getMasters(){
		$db = Db::getConnection();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result = $db->query('SELECT id, Name, Email FROM users  WHERE Role = 1 ORDER BY id ASC');
		$i = 0;
		while($row = $result->fetch()) {
			$usersList[$i]['id'] = $row['id'];
			$usersList[$i]['Name'] = $row['Name'];
			$usersList[$i]['Email'] = $row['Email'];
			$i++;
		}
		return $usersList;		
	}
}