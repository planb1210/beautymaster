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
					s.Id, s.Name, s.Price, s.Duration, s.Description, s.DivisionId
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

	public static function getClientTimeBooking($employeeId, $time){
		$db = Db::getConnection();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		

		$sqlText = "select Duration, BookingTime from booking cb
					left join services s on s.Id = cb.ServiceId
					where cb.EmployeeId = :employeeId 
					AND date(cb.BookingTime) = :bookingtime
					order by cb.BookingTime";
		$result = $db->prepare($sqlText);
		$result->execute(array(':employeeId' => $employeeId, ':bookingtime' => $time));		

		return $result->fetchAll(PDO::FETCH_CLASS);		
	}

	public static function getClient($phone){
		$db = Db::getConnection();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		

		$sqlText = "select Id, Name, Phone, Email from clients cl
					where cl.Phone = :phone";
		$result = $db->prepare($sqlText);
		$result->execute(array(':phone' => $phone));		

		return $result->fetchAll(PDO::FETCH_CLASS);		
	}
	
	public static function booking($phone, $email, $name, $employeeId, $serviceId, $fullTime, $comment){
		$db = Db::getConnection();
		try {			
			$db->beginTransaction();
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
			
			$client = self::getClient($phone);
			$clientId = 0;
			if(empty($client)){
				$sqlText = "INSERT INTO clients (Name, Phone, Email) VALUES (:name, :phone, :email)";
			
				$result = $db->prepare($sqlText);
				$result->execute(array(':phone' => $phone, ':email' => $email, ':name' => $name));
				
				$result = $db->prepare('SELECT Id FROM clients WHERE Phone = :phone LIMIT 1');
				$result->execute(array(':phone' => $phone));
				
				$clientId = $result->fetch(PDO::FETCH_OBJ)->Id;
			}
			else{
				$clientId = $client[0]->Id;
			}

			$sqlText = "INSERT INTO booking (EmployeeId, ServiceId, ClientId, BookingTime, Comment) VALUES (:employeeId, :serviceId, :clientId, :bookingTime, :comment)";			
			$result = $db->prepare($sqlText);
			$result->execute(array(':employeeId' => $employeeId, ':serviceId' => $serviceId, ':clientId' => $clientId, ':bookingTime' => $fullTime , ':comment' => $comment ));
			
			$db->commit();
			return true;
		} catch (Exception $e) {
			$db->rollback();
			return false;
		}				
	}	
}