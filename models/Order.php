<?php
class Order
{
	public static function getMasters($id){
		$db = Db::getConnection();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if($id != null){
			$sqlText = "select 
						u.Id, u.Name, u.Email
						from skills sk
						left join users u on sk.EmployeeId = u.Id
						where sk.ServiceId = :id";
			$result = $db->prepare($sqlText);
			$result->execute(array(':id' => $id));
		}
		else{
			$result = $db->query('SELECT Id, Name, Email FROM users  WHERE Role = 1 ORDER BY id ASC');
		}
		
		return $result->fetchAll(PDO::FETCH_CLASS);	
	}
}