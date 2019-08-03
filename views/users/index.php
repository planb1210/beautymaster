<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Users</title>
<script type="text/javascript" src="/scripts/jquery-3.4.1.js"></script>
        <script type="text/javascript" src="/scripts/knockout-3.5.0.js"></script>
        <script type="text/javascript" src="/scripts/models/users/users.js"></script>
        
</head>
	<body>
		<?php echo $this->head; ?>
		<div class="container-wrapper container">
			<?php echo $this->menu; ?>	
			<div class="content" >
								
				<table border=1>
				<thead data-bind="visible: users().length > 0">
				<tr>
				<td>Id</td>
				<td data-bind"text: name">Имя</td>
				<td data-bind"text: email">Email</td>
				<td data-bind"text: role">Права</td>
				</tr>
				</thead>
				<tbody  data-bind="foreach: users">
				<tr>
				<td data-bind="text: id"></td>
				<td data-bind="text: name"></td>
				<td data-bind="text: email"></td>
				<td data-bind="text: role"></td>
				<td>
				<input data-bind="click:function(data) { $parent.deleteUser(data.id())}" type="submit" value="Удалить" name="submit"/>
				</td>
				</tr>
				</tbody>
				</table>
				<input  type="submit" value="Добавить пользователя" onclick="$('#add').toggle();"/>
				<form id="add" style="display: none;" data-bind="submit:addUser">
					<table border=1>
						<tr><td>Имя</td><td><input type=text name=name size=10</td></tr>
						<tr><td>email</td><td><input type=text name=email size=10></td></tr>
						<tr><td>Пароль</td><td><input type=password name=password size=10></td></tr>
					</table>
					<input type=submit  value="Создать" name="submit">
				</form>
				
				
			<!--<?php	
			
			foreach(Users::getUsers() as $val) {
			echo "<table border=1>";
			foreach ($val as $k=>$v) {
				echo "<tr><td>$k</td><td>$v</td></tr>";					
			}
			echo "</table>";
			}
			?>
				<form method="post" action="/users/0">
					<table border=1>
						<tr><td>Имя</td><td><input type=text name=name size=10</td></tr>
						<tr><td>email</td><td><input type=text name=email size=10></td></tr>
						<tr><td>Пароль</td><td><input type=text name=password size=10></td></tr>
					</table>
					<input type=submit  value="Создать" name="submit">
				</form>
				<form method="post" action="/users/1">
					<table border=1>
						<tr><td>Id</td><td><input type=text name=id size=10</td></tr>
						<tr><td>Имя</td><td><input type=text name=name size=10</td></tr>
						<tr><td>email</td><td><input type=text name=email size=10></td></tr>
						<tr><td>Пароль</td><td><input type=password name=password size=10></td></tr>
					</table>
					<input type=submit  value="Редактировать" name="submit">
				</form>
				<form method="post" action="/users/3">
					Чтобы удалить пользователя, введите его id <input type="text" name="id" />
					<input type="submit" value="Удалить" name="submit"/>
				</form> -->
			</div>
		</div>
		<?php echo $this->footer; ?>
		<script>
                     let viewModel = new UsersModel();
                     ko.applyBindings(viewModel);</script>
		
	</body>
</html>
	
