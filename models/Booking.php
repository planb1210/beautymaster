<?php
class Booking
{	
	public static function getRows($master=null, $date=null){
		$db = Db::getConnection();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$executeArray = array();	

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
		if($master != null || $date != null){
			$additionalSql = " WHERE ";
			if($master != null){
				$additionalSql = $additionalSql." u.Id = :master ";
				$executeArray[':master'] = $master;
			}
			if($date != null){
				$additionalSql = $additionalSql." date(b.BookingTime) = :date ";
				$executeArray[':date'] = $date;
			}
			$sqlText = $sqlText.$additionalSql;
		}
		$sqlText = $sqlText." order by b.BookingTime desc";
		
		$result = $db->prepare($sqlText);
		$result->execute($executeArray);
		
		return $result->fetchAll(PDO::FETCH_CLASS);
	}
}
