<?php
class Home
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
	
	public static function getSkills($id){
		$db = Db::getConnection();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
		
		if($id != null){
			$sqlText = "select 
					s.Id, s.Name, s.Price, s.Duration, s.Description
					from skills sk
					left join services s on sk.ServiceId = s.Id
					where EmployeeId = :id";
			$result = $db->prepare($sqlText);
			$result->execute(array(':id' => $id));
		}
		else{
			$sqlText = "select 
						s.Id, s.Name, s.Price, s.Duration, s.Description
						from services s";
			$result = $db->query($sqlText);
		}
		return $result->fetchAll(PDO::FETCH_CLASS);		
	}

	public static function getSchedule($employeeId, $yeahr, $month){
		$db = Db::getConnection();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		

		$sqlText = "select Yeahr, Month, Days from schedule 
					where EmployeeId = :employeeId 
					AND Month >= :month
					AND Yeahr >= :yeahr";
		$result = $db->prepare($sqlText);
		$result->execute(array(':employeeId' => $employeeId, ':yeahr' => $yeahr, ':month' => $month));		

		return $result->fetchAll(PDO::FETCH_CLASS);		
	}

	public static function getClientTimeBooking($employeId, $time){
		$db = Db::getConnection();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		

		$sqlText = "select Duration, BookingTime from clientsBooking cb
					left join services s on s.Id = cb.ServiceId
					where cb.EmployeId = :employeId 
					AND date(cb.BookingTime) = :bookingtime";
		$result = $db->prepare($sqlText);
		$result->execute(array(':employeId' => $employeId, ':bookingtime' => $time));		

		return $result->fetchAll(PDO::FETCH_CLASS);		
	}	
}