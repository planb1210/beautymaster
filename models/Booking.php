<?php
class Booking
{	
	public static function getUsers($id=null){
		$db = Db::getConnection();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if($id != null){
			$sqlText = "select u.Id, u.Name, s.Name as Skill, s.Id as No from skills sk join users u on sk.EmployeeId = u.Id join services s on sk.ServiceId=s.Id
						where u.Id = :id";
			$result = $db->prepare($sqlText);
			$result->execute(array(':id' => $id));
		}
		else{
			$result = $db->query('SELECT id, Name, Email, Role, Password FROM users ORDER BY id ASC');
		}
		
		return $result->fetchAll(PDO::FETCH_CLASS);	
	}
}
