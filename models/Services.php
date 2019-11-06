<?php

class Services
{
	public static function getServices($id=null, $skillsArr=null){
		$db = Db::getConnection();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		if($id != null && $skillsArr != null){			
			$total = count($skillsArr);
			$quest_marks = array_fill(0,$total, '?');
			$sqlText = "select distinct s.Name as Skill, s.Id as No from services s left join skills sk on s.Id=sk.ServiceId left join users u on sk.EmployeeId = u.Id where sk.EmployeeId IS NULL or (u.Id!=? and s.Id NOT IN(".implode(',',$quest_marks)."))";
			$result = $db->prepare($sqlText);
			$result->execute(array_merge(array($id),array_values($skillsArr)));			
			return $result->fetchAll(PDO::FETCH_CLASS);
		}
		else{
			$sqlText = "select s.Id as No, s.Name as Skill, s.Price, s.Duration, s.DivisionId, s.Description from services s";
			$result = $db->query($sqlText);
			return $result->fetchAll();
		}
	}
	
	public static function addService($name, $price, $duration, $divisionid, $description){
		$db = Db::getConnection();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = $db->prepare("INSERT INTO services (Name, Price, Duration, DivisionId, Description) VALUES (:name, :price, :duration, :divisionid, :description)");
		$sql->execute(array(':name' => $name, ':price'=> intval($price), ':duration'=> floatval($duration), ':divisionid'=> intval($divisionid), ':description'=>$description));
		$sqlText = "select s.Id, s.Name, s.Price, s.Duration, s.DivisionId, s.Description from services s ORDER BY id DESC LIMIT 1";
		$result = $db->query($sqlText);
		return $result->fetchAll(PDO::FETCH_CLASS);
	}
	
	public static function editService($id, $name, $price, $duration, $divisionid, $description){
		$db = Db::getConnection();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		$sql = $db->prepare("UPDATE services SET Name=:name, Price=:price, Duration=:duration, DivisionId=:divisionid, Description=:description WHERE Id=:id"); 
		$sql->execute(array(':id' => $id,':name' => $name, ':price'=> $price, ':duration'=> $duration, ':divisionid'=> $divisionid,':description'=> $description ));
	}
	
	public static function deleteService($id){
		$db = Db::getConnection();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 	$sql = $db->prepare("DELETE FROM services WHERE Id=:id");
	 	$sql->execute(array(':id' => $id));
	 	$sql = $db->prepare("ALTER TABLE services AUTO_INCREMENT=0");
	 	$sql->execute(array(':id' => $id));
	}
		
	public static function deleteSkill($id, $skillId){
		$db = Db::getConnection();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 	$sql = $db->prepare("DELETE FROM skills WHERE EmployeeId=:id AND ServiceId=:skillId");
	 	$sql->execute(array(':id' => $id,':skillId' =>$skillId));
	}
		
	public static function addSkill($id, $skillId){
		$db = Db::getConnection();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = $db->prepare("INSERT INTO skills (EmployeeId, ServiceId) VALUES (:id, :skillId)");
		$sql->execute(array(':id' => $id,':skillId' =>$skillId));
		$sqlText = "select u.Id, u.Name, s.Name as Skill, s.Id as No from services s left join skills sk on s.Id=sk.ServiceId left join users u on sk.EmployeeId = u.Id where sk.EmployeeId=:id and sk.ServiceId=:skillId";
		$result = $db->prepare($sqlText);
		$result->execute(array(':id' => $id,':skillId' =>$skillId));
		return $result->fetchAll(PDO::FETCH_CLASS);		
	}
}