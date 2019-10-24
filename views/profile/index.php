<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BeautyMaster</title>
		<link href="/template/css/styles.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="/template/css/admin.css" rel="stylesheet" type="text/css" media="screen" />
		<script type="text/javascript" src="/scripts/jquery-3.4.1.js"></script>
        <script type="text/javascript" src="/scripts/knockout-3.5.0.js"></script>
        <script type="text/javascript" src="/scripts/models/users/users.js"></script>
	</head>
	<body>
		<div class="container-header">
			<span class="logo">BeautyMaster</span>
		</div>
		<div class="container-wrapper container">
			<div class="top-content">
				<div class="mask-top-content"></div>
			</div>			
			<div class="content">
				<div class="middle-block">
					<!-- ko with: users()[0] -->
					<h1 data-bind="text: name()"></h1>
					<!-- /ko -->
					<table border=1>
						<thead data-bind="visible: skills().length > 0">
							<tr>							
								<td>Услуги</td>
								<td>ID услуги</td>
							</tr>
						</thead>
						<tbody data-bind="foreach: skills" >
							<tr > 
								<td data-bind="text: skill"></td>
								<td data-bind="text: skillId"></td>							
								<td><input data-bind="click:function(data) {$root.deleteSkill(data.id, data.skillId);$root.skillsToAdd.removeAll()}" type=submit value="Удалить"/></td> 
							</tr>						
							<div data-bind="foreach:$root.skillsToAdd">
								<!-- ko if: $root.editSkillMode() -->
								<li data-bind="text:skill, click:function(data) {$root.addSkill((window.location.pathname).split('/')[2], data.skillId); $root.editSkillMode(!$root.editSkillMode())}"></li>
								<!-- /ko -->
							</div>						
						</tbody>														
					</table>
					<input type=submit  value="Добавить навык" data-bind="click:function(data) {$root.viewSkillsToAdd((window.location.pathname).split('/')[2], $root.skillArr());$root.editSkillMode(!$root.editSkillMode()); $root.skillsToAdd.removeAll()}">
				</div>
			</div>
		</div>
		<div class="container-footer"></div>		
		<script>		
            	var viewModel = new UsersModel(true);
				ko.applyBindings(viewModel);
				$(window).on("load",function(){
					viewModel.viewProfile((window.location.pathname).split('/')[2])
				})
		</script>
	</body>
</html>
