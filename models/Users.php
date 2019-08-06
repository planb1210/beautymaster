<?php


class Users
{
	
	public static function getUsers(){
		$db = Db::getConnection();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result = $db->query('SELECT id, Name, Email, Role, Password FROM users ORDER BY id ASC');
		$i = 0;
		while($row = $result->fetch()) {
			$usersList[$i]['id'] = $row['id'];
			$usersList[$i]['Name'] = $row['Name'];
			$usersList[$i]['Email'] = $row['Email'];
			$usersList[$i]['Role'] = $row['Role'];
			$usersList[$i]['Password'] = $row['Password'];
			$i++;
		}
		
		$db = null;
		return $usersList;
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
