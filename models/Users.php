<?php


class Users
{
	public static function getAdminInfo() {
		/*$db = Db::getConnection();
		$newsList = array();

		$result = $db->query('SELECT id, title, date, author_name, short_content FROM news ORDER BY id ASC LIMIT 10');

		$i = 0;
		while($row = $result->fetch()) {
			$newsList[$i]['id'] = $row['id'];
			$newsList[$i]['title'] = $row['title'];
			$newsList[$i]['date'] = $row['date'];
			$newsList[$i]['author_name'] = $row['author_name'];
			$newsList[$i]['short_content'] = $row['short_content'];
			$i++;
		}

		return $newsList;/**/
		$adminInfo['name'] = "Name 12";
		return $adminInfo;
	}
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
		foreach($usersList as $val) {
			echo "<table border=1>";
			foreach ($val as $k=>$v) {
				echo "<tr><td>$k</td><td>$v</td></tr>";					
			}
			echo "</table>";
		}
		$db = null;
	}
	public static function addUser($name, $email, $password){
	
	 $db = Db::getConnection();
	 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $sql = $db->prepare("INSERT INTO users (Name, Email, Role, Password) VALUES (:name, :email, :role, :password)");
	 $sql->execute(array(':name' => $name, ':email'=> $email, ':role'=> 1, ':password'=>md5(md5($password))));
	 
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
