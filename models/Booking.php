<?php
class Booking
{	
	public static function getRows($id=null){
		$db = Db::getConnection();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sqlText = "select b.Id as Id, 
							u.Name as MasterName, 
							c.Name as ClientName, 
							s.Name as ServiceName, 
							s.Price as Price, 
							s.Duration as Duration, 
							b.BookingTime as BookingTime,
							b.Comment as Comment from booking b 
							join users u on b.EmployeeId = u.Id 
							join clients c on b.ClientId = c.Id
							join services s on b.ServiceId = s.Id";
		//where u.Id = :id";
		$result = $db->prepare($sqlText);
		$result->execute(array(':id' => $id));
		
		return $result->fetchAll(PDO::FETCH_CLASS);	
	}
}
