<?php


class Users
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
		
		
	
	
	
	public static function addUser($name, $email, $password){
	
	 $db = Db::getConnection();
	 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $sql = $db->prepare("INSERT INTO users (Name, Email, Role, Password) VALUES (:name, :email, :role, :password)");
	 $sql->execute(array(':name' => $name, ':email'=> $email, ':role'=> 1, ':password'=>md5(md5($password))));
	 $result = $db->query('SELECT id, Name, Email, Role, Password FROM users ORDER BY id DESC LIMIT 1');
	 while($row = $result->fetch()) {
			$addedUser['id'] = $row['id'];
			$addedUser['Name'] = $row['Name'];
			$addedUser['Email'] = $row['Email'];
			$addedUser['Role'] = $row['Role'];
			$addedUser['Password'] = $row['Password'];
			}
			$db = null;
			return $addedUser;
	 
	}
	public static function editUser($id, $name, $email, $password){
	
	 $db = Db::getConnection();
	 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 	 
	 $sql = $db->prepare("UPDATE users SET Name=:name, Email=:email, Role=:role, Password=:password WHERE Id=:id");
	 if ($name=='admin'){
		 $role=0;
	 }
	 else{
		 $role=1;
	 }
	 
	 $sql->execute(array(':id' => $id,':name' => $name, ':email'=> $email, ':role'=> $role, ':password'=>md5(md5($password))));;
	}
	public static function deleteUser($id){
		$db = Db::getConnection();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 	$sql = $db->prepare("DELETE FROM users WHERE Id=:id");
	 	$sql->execute(array(':id' => $id));
		}
}
