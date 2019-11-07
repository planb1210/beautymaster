<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BeautyMaster Booking</title>
		<link href="/template/css/jquery-ui.css" rel="stylesheet" type="text/css" charset="utf-8">
		<link href="/template/css/styles.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="/template/css/admin.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="/template/css/kalendae.css" rel="stylesheet" type="text/css" charset="utf-8">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
	</head>
	<body>
		<?php echo $this->head; ?>
		<div class="container-wrapper container">
			<?php echo $this->menu; ?>	
			<div class="content">
				<!-- ko if: isMastersBusy -->
					<img src="/template/images/waiting.gif">
				<!-- /ko -->
				<!-- ko ifnot: isMastersBusy -->
				<div class="filter">
					<div>Фильтр по мастеру: <select data-bind="options: masters, optionsText: 'Name', optionsValue: 'Id', value: selectedMaster, optionsCaption: '-'"></select></div>
					<div>Фильтр по клиенту: <input type="text" data-bind="value: client"></div>
					<div>Фильтр по дате: <input id="cal" type="text" data-bind="value: selectedDate"></div>
					<div>
						<button class="button-item button-enable" type="submit" data-bind="click: function() {run()}">Выбрать</button>
					</div>
				</div>
				<!-- /ko -->
				
				<!-- ko if: isItemsBusy -->
					<img src="/template/images/waiting.gif">
				<!-- /ko -->
				<!-- ko ifnot: isItemsBusy -->
					<div class="data_table">
						<table>
							<tr class="row header">
								<th>Имя мастера</th>
								<th>Имя клиента</th>
								<th>Телефон клиента</th>
								<th>Услуга</th>
								<th>Цена</th>
								<th>Длительность</th>
								<th>Время записи</th>
								<th>Комментарий клиента</th>
								<th></th>
								<th></th>
							</tr>
							<!-- ko foreach: items -->
								<tr class="row">
									<td data-bind="text:masterName"></td>
									<td data-bind="text:clientName"></td>
									<td data-bind="text:clientPhone"></td>
									<td data-bind="text:serviceName"></td>
									<td data-bind="text:price"></td>
									<td data-bind="text:duration"></td>
									<td data-bind="text:showTime"></td>
									<td class="left_text" data-bind="text:comment"></td>
									<td><div class="ico_edit fa fa-pencil-square-o" data-bind="click: function() { $parent.editItem($data); }"></div></td>
									<td><div class="ico_delete fa fa-times" data-bind="click: function() { $parent.removeItem(id); }"></div></td>
								</tr>
							<!-- /ko -->
						</table>
					</div>
					<!-- ko with: pagination -->
						<!-- ko if: !isPagingBusy() -->
							<div class="pagination_wrapper">
								<!-- ko foreach: buttons -->
									<div class="page" data-bind="text:$data, click: function() {$root.clickPage($data)}, css: { 'current_page': $parent.currentPage() == $data }"></div>
								<!-- /ko -->
							</div>
						<!-- /ko -->
					<!-- /ko -->
				<!-- /ko -->
			</div>
		</div>
		<?php echo $this->footer; ?>
		
		<div id="editDisplay" style="display:none">
			<div>Клиент: <input data-bind="value: editor.clientName" /></div>
		</div>

		<script type="text/javascript" src="/scripts/jquery-3.4.1.js"></script>
		<script type="text/javascript" src="/scripts/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/scripts/knockout-3.5.0.js"></script>
		<script type="text/javascript" src="/scripts/kalendae.standalone.js"></script>
        <script type="text/javascript" src="/scripts/models/booking/booking.js"></script>
		<script type="text/javascript" src="/scripts/models/shared/paginationModel.js"></script>
		<script>
			let viewModel = new BookingModel();
			ko.applyBindings(viewModel);
		</script>		
	</body>
</html>
	
