<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BeautyMaster Users</title>
		<link href="/template/css/styles.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="/template/css/admin.css" rel="stylesheet" type="text/css" media="screen" />
		<script type="text/javascript" src="/scripts/jquery-3.4.1.js"></script>
        <script type="text/javascript" src="/scripts/knockout-3.5.0.js"></script>
        <script type="text/javascript" src="/scripts/models/users/users.js"></script>
		
	</head>
	<body>
		<?php echo $this->head; ?>
		<div class="container-wrapper container">
			<?php echo $this->menu; ?>	
			<div class="content">							
				<table border=1>
					<thead data-bind="visible: users().length > 0">
						<tr>
							<td>Id</td>
							<td>Имя</td>
							<td>Email</td>
							<td>Права</td>
						</tr>
					</thead>
					<tbody data-bind="foreach: users">
						<tr>
							<!-- ko if: !editMode() -->
							<td data-bind="text: id"></td>
							<td data-bind="text: name, click: function(data){let id=data.id(); window.location.href=`/profile/${id}`}"<!--function(data){$parent.viewProfile(data.id()); $root.profileMode(!$root.profileMode())-->></td>
							<td data-bind="text: email"></td>
							<td data-bind="text: role"></td>
							<!-- /ko -->
							<!-- ko if: editMode() -->
							<td><input type=text name=name data-bind="value: id" disabled/></td>
							<td><input type=text name=name data-bind="value: name"/></td>
							<td><input type=text name=name data-bind="value: email"/></td>
							<td><input type=text name=name data-bind="value: role"/></td>
							<!-- /ko -->
							<td>
								<input data-bind="click:function(data) { $parent.deleteUser(data.id())}" type="submit" value="Удалить" name="submit"/>
								<!-- ko if: !editMode() -->
									<input data-bind="click:function(data) { toggleMode()}" type="submit" value="Изменить" name="submit"/>
								<!-- /ko -->
								<!-- ko if: editMode() -->
									<input data-bind="click:function(data) { save(); toggleMode()}" type="submit" value="Сохранить" name="submit"/>
								<!-- /ko -->
							</td>
						</tr>
					</tbody>
				</table>
				<input  type="submit" value="Добавить пользователя" onclick="$('#add').toggle();"/>
				<form id="add" style="display: none;" data-bind="submit:addUser">
					<table border=1>
						<tr><td>Имя</td><td><input type=text name=name size=10/></td></tr>
						<tr><td>email</td><td><input type=text name=email size=10/></td></tr>
						<tr><td>Пароль</td><td><input type=password name=password size=10/></td></tr>
					</table>
					<input type=submit  value="Создать" name="submit" onclick="$('#add').toggle();"/>
				</form>							
			</div>
		</div>
		<?php echo $this->footer; ?>
		<script>
			 let viewModel = new UsersModel();
			 ko.applyBindings(viewModel);
		</script>		
	</body>
</html>
	
