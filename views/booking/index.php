<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BeautyMaster Booking</title>
		<link href="/template/css/styles.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="/template/css/admin.css" rel="stylesheet" type="text/css" media="screen" />
		<script type="text/javascript" src="/scripts/jquery-3.4.1.js"></script>
        <script type="text/javascript" src="/scripts/knockout-3.5.0.js"></script>
        <script type="text/javascript" src="/scripts/models/booking/booking.js"></script>		
	</head>
	<body>
		<?php echo $this->head; ?>
		<div class="container-wrapper container">
			<?php echo $this->menu; ?>	
			<div class="content">
				<!-- ko if: isBusy -->
					<img src="/template/images/waiting.gif">
				<!-- /ko -->
				<!-- ko ifnot: isBusy -->
					<div class="data_table">
						<table>
							<tr class="row header">
								<th>Имя мастера</th>
								<th>Имя клиента</th>
								<th>Услуга</th>
								<th>Цена</th>
								<th>Длительность</th>
								<th>Время записи</th>
								<th>Комментарий клиента</th>
							</tr>
							<!-- ko foreach: items -->
								<tr class="row">
									<td data-bind="text:MasterName"></td>
									<td data-bind="text:ClientName"></td>
									<td data-bind="text:ServiceName"></td>
									<td data-bind="text:Price"></td>
									<td data-bind="text:Duration"></td>
									<td data-bind="text:BookingTime"></td>
									<td data-bind="text:Comment"></td>
								</tr>
							<!-- /ko -->
						</table>
					</div>
				<!-- /ko -->
			</div>
		</div>
		<?php echo $this->footer; ?>
		<script>
			 let viewModel = new BookingModel();
			 ko.applyBindings(viewModel);
		</script>		
	</body>
</html>
	
