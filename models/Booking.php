<?php
class Booking
{	
	public static function getRows($master = null, $client = null, $date = null, $page = 1){
		$limit = 10;
		$db = Db::getConnection();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sqlText = "select b.Id as Id, 
							u.Name as MasterName, 
							c.Name as ClientName, 
							c.Phone as ClientPhone, 
							s.Name as ServiceName, 
							s.Price as Price, 
							s.Duration as Duration, 
							b.BookingTime as BookingTime,
							b.Comment as Comment from booking b 
							join users u on b.EmployeeId = u.Id 
							join clients c on b.ClientId = c.Id
							join services s on b.ServiceId = s.Id ";
		if($master != null || $client != null || $date != null){
			$additionalSql = " WHERE ";
			if($master != null){
				$additionalSql = $additionalSql." u.Id = :master ";
			}
			/*---------------------------------------------------------------*/
			if($client != null){
				if($master != null){
					$additionalSql = $additionalSql." AND ";
				}
				$additionalSql = $additionalSql." (LOWER(c.Name) Like LOWER(:clientText) OR LOWER(c.Phone) like LOWER(:clientText)) ";
			}
			/*---------------------------------------------------------------*/
			if($date != null){
				if($master != null || $client != null){
					$additionalSql = $additionalSql." AND ";
				}
				$additionalSql = $additionalSql." date(b.BookingTime) = :date ";
			}
			$sqlText = $sqlText.$additionalSql;
		}
		
		$sqlText = $sqlText." order by b.BookingTime desc LIMIT :limit OFFSET :offset";		
		$result = $db->prepare($sqlText);
		
		//--------------------------------------------------------------------------------------------------
		$result->bindValue(':limit', (int) $limit, PDO::PARAM_INT); 
		$result->bindValue(':offset', (int) (($page - 1) * $limit), PDO::PARAM_INT);
		if($master != null){
			$result->bindValue(':master', $master); 
		}
		if($client != null){
			$result->bindValue(':clientText', '%'.$client.'%');
		}
		if($date != null){
			$result->bindValue(':date', $date);
		}
		//--------------------------------------------------------------------------------------------------
		$result->execute();

		return $result->fetchAll(PDO::FETCH_CLASS);
	}
	
	public static function getCountRows($master = null, $client = null, $date = null){
		$db = Db::getConnection();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sqlText = "select Count(*) as Count from booking b 
							join users u on b.EmployeeId = u.Id 
							join clients c on b.ClientId = c.Id
							join services s on b.ServiceId = s.Id";
		if($master != null || $client != null || $date != null){
			$additionalSql = " WHERE ";
			if($master != null){
				$additionalSql = $additionalSql." u.Id = :master ";
			}
			if($client != null){
				if($master != null){
					$additionalSql = $additionalSql." AND ";
				}
				$additionalSql = $additionalSql." (LOWER(c.Name) Like LOWER(:clientText) OR LOWER(c.Phone) like LOWER(:clientText)) ";
			}
			if($date != null){
				if($master != null || $client != null){
					$additionalSql = $additionalSql." AND ";
				}
				$additionalSql = $additionalSql." date(b.BookingTime) = :date ";
			}
			$sqlText = $sqlText.$additionalSql;
		}
		
		$result = $db->prepare($sqlText);

		if($master != null){
			$result->bindValue(':master', $master); 
		}
		if($client != null){
			$result->bindValue(':clientText', '%'.$client.'%');
		}
		if($date != null){
			$result->bindValue(':date', $date);
		}
		
		$result->execute();		
		return $clientId = $result->fetch(PDO::FETCH_OBJ)->Count;
	}
}
