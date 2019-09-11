<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BeautyMaster</title>
		<link href="/template/css/styles.css" rel="stylesheet" type="text/css" media="screen" />
		<link rel="stylesheet" href="/scripts/bootstrap/bootstrap.css" >
		<link href="https://cdn.materialdesignicons.com/3.8.95/css/materialdesignicons.min.css" rel="stylesheet">
		<link rel="stylesheet" href="/template/css/kalendae.css" type="text/css" charset="utf-8">
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
				Order
			</div>
		</div>
		<div class="container-footer"></div>
		<script type="text/javascript" src="/scripts/jquery-3.4.1.js"></script>
		<script type="text/javascript" src="/scripts/knockout-3.5.0.js"></script>
		<script type="text/javascript" src="/scripts/knockout-latest.debug.js"></script>
		<script type="text/javascript" src="/scripts/koExternalTemplateEngine_all.js"></script>
		<script type="text/javascript" src="/scripts/kalendae.standalone.js"></script>		
		<script type="text/javascript" src="/scripts/models/home/baseBlock.js"></script>
		<script type="text/javascript" src="/scripts/models/home/mastersBlock.js"></script>
		<script type="text/javascript" src="/scripts/models/home/skillsBlock.js"></script>
		<script type="text/javascript" src="/scripts/models/home/calendarBlock.js"></script>
		<script type="text/javascript" src="/scripts/models/home/properties.js"></script>		
		<script>
			var viewModel = new PropertyModel();
			ko.applyBindings(viewModel);/**/
		</script>
	</body>
</html>