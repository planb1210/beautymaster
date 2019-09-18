<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<head>
<title>Users</title>
<script type="text/javascript" src="/scripts/jquery-3.4.1.js"></script>
<script type="text/javascript" src="/scripts/knockout-3.5.0.js"></script>
<script type="text/javascript" src="/scripts/models/services/services.js"></script>
        
</head>
	<body>
		<?php echo $this->head; ?>
		<div class="container-wrapper container">
			<?php echo $this->menu; ?>	
			<div class="content" >					
				<table border=1>
					<thead data-bind="visible: services().length > 0">
						<tr>
							<td>Id</td>
							<td>Название</td>
							<td>Цена</td>
							<td>Продолжительность</td>
							<td>Категория</td>
							<td>Описание</td>
						</tr>
					</thead>
					<tbody  data-bind="foreach: services">
						<tr>
							<!--ko if:!editMode()-->
							<td data-bind="text: id"></td>
							<td data-bind="text: name"></td>
							<td data-bind="text: price"></td>
							<td data-bind="text: duration"></td>
							<td data-bind="text: divisionid"></td>
							<td data-bind="text: description"></td>	
							<!--/ko-->		
							<!--ko if:editMode()-->
							<td><input data-bind="value: id" disabled/></td>
							<td><input data-bind="value: name"/></td>
							<td><input data-bind="value: price"/></td>
							<td><input data-bind="value: duration"/></td>
							<td><input data-bind="value: divisionid"/></td>
							<td><input data-bind="value: description"/></td>
							<!--/ko-->			
							<td>
								<!--ko if:!editMode()-->
								<input data-bind="click:function(data) {$parent.deleteService(data.id())}" type="submit" value="Удалить" name="submit"/>								
								<input data-bind="click:function() {toggleMode()}" type="submit" value="Изменить" name="submit"/>
								<!--/ko-->	
								<!--ko if:editMode()-->
								<input data-bind="click:function(data) {save(); toggleMode()}" type="submit" value="Сохранить" name="submit"/>
								<!--/ko-->	
							</td>
						</tr>
					</tbody>
				</table>
				<input  type="submit" value="Добавить услугу" onclick="$('#add').toggle();"/>
				<form id="add" style="display: none;" data-bind="submit:addService">
					<table border=1>
						<tr><td>Название</td><td><input type=text name=name size=10</td></tr>
						<tr><td>Цена</td><td><input type=text name=price size=10></td></tr>
						<tr><td>Продолжительность</td><td><input type=text name=duration size=10></td></tr>
						<tr><td>Категория</td><td><input type=text name=divisionid size=10></td></tr>
						<tr><td>Описание</td><td><input type=text name=description size=10></td></tr>	
					</table>
					<input type=submit  value="Создать" name="submit" onclick="$('#add').toggle();">
				</form>
			</div>
		</div>
		<?php echo $this->footer; ?>
		<script>
                     let viewModel = new ServicesModel();
                     ko.applyBindings(viewModel);</script>
		
	</body>
</html>
	
