<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Users</title>
</head>
	<body>
		<?php echo $this->head; ?>
		<div class="container-wrapper container">
			<?php echo $this->menu; ?>	
			<div class="content">
				<form method="post" action="/users/3">
					Отобразить список пользователей<input type="submit" value="Отобразить" name="submit"/>
				</form>
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
				</form>
			</div>
		</div>
		<?php echo $this->footer; ?>
	</body>
</html>
