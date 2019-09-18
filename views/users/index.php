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
			<div class="content">
				<!-- ko if: !profileMode() -->			
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
							<td data-bind="text: name, click: function(data){$parent.viewProfile(data.id()); $root.profileMode(!$root.profileMode())}"></td>
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
									<input data-bind="click:function(data) { $parent.save(data.id())}" type="submit" value="Сохранить" name="submit"/>
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
					<input type=submit  value="Создать" name="submit">
				</form>	
				<!-- /ko -->
				
				<!-- ko if: profileMode() -->
				<table border=1>
					<thead data-bind="visible: skills().length > 0">
						<tr">
							<td>ID</td>
							<td >Имя</td>
							<td>Услуги</td>
							<td>ID услуги</td>
						</tr>
					</thead>
					<tbody data-bind="foreach: skills" >
						<tr > 
							<td data-bind="text: id"></td>
							<td data-bind="text: name, click:function(){$root.profileMode(!$root.profileMode()); $root.skills.removeAll(), $root.skillsToAdd.removeAll()}"></td>							
							<td data-bind="text: skill"></td>
							<td data-bind="text: skillId"></td>							
							<td><input data-bind="click:function(data) {$root.deleteSkill(data.id, data.skillId);$root.skillsToAdd.removeAll();$root.skillsEmptyId(data.id())}" type=submit value="Удалить"/></td> 
							<td ><input type=submit  value="Добавить навык" data-bind="click:function(data) {$root.viewSkillsToAdd(data.id(), $root.skillArr());$root.editSkillMode(!$root.editSkillMode()); $root.skillsToAdd.removeAll()}"></td>
						</tr>
						
						
							<div data-bind="foreach:$root.skillsToAdd">
								<!-- ko if: $root.editSkillMode() -->
								<li data-bind="text:skill, click:function(data) {$root.addSkill($root.skills()[0].id(), data.skillId); $root.editSkillMode(!$root.editSkillMode())}"></li>
								<!-- /ko -->
							</div>
						
					</tbody>
				</table>
				<div data-bind="visible: skills().length == 0">
				<span data-bind="text:emptyUserName"></span>
				<input type=submit  value="Добавить навык" data-bind="click:function() {viewSkillsToAdd(skillsEmptyId(), new Array(1,2))}">
				<div data-bind="foreach:$root.skillsToAdd">								
								<li data-bind="text:skill, click:function(data) {$root.addSkill($root.skillsEmptyId(), data.skillId);}"></li>
								
				</div>
				</div>
				<!-- /ko -->
				
			</div>
		</div>
		<?php echo $this->footer; ?>
		<script>
			 let viewModel = new UsersModel();
			 ko.applyBindings(viewModel);
		</script>		
	</body>
</html>
	
