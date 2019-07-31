<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BeautyMaster</title>
		<link href="/template/css/styles.css" rel="stylesheet" type="text/css" media="screen" />
		<link rel="stylesheet" href="/scripts/bootstrap/bootstrap.css" >
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
				<form method="post" action="/">
				  <p><b>тестирование формы</b></p>
				  <p><input type="text" id="id" name="id" value="12" size="40">
				  <p><input type="submit"></p>
				</form>
				<div data-bind="text:name, click: test"></div>
				
				<div class="middle-block">
					<div class="col-sm-9">
						<!-- ko with: masterModel -->
							<a href="#" class="btn btn-primary" data-bind="click: viewMasters">Выбор мастера</a>
							<div data-bind="visible: isSelectedMode">
								<!-- ko foreach: masters -->
									<div data-bind="text: name"></div>
								<!-- /ko -->
							</div>
						<!-- /ko -->
					</div>
					<div class="col-sm-9">
						<a href="#" class="btn btn-primary">Выбор услуги</a>
						<div>
						список услуг
						</div>
					</div>
					<div class="col-sm-9">
						<a href="#" class="btn btn-primary">Выбор даты</a>
						<div>
						календарь
						</div>
					</div>
					
				</div>
				
				<!--
				 <nav class="navbar navbar-expand-lg fixed-top ">  
				 <a class="navbar-brand" href="#">Home</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">  
				 <span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse " id="navbarSupportedContent">     <ul class="navbar-nav mr-4">
				 <li class="nav-item">
					 <a class="nav-link" data-value="about" href="#">About</a>        </li>  
				<li class="nav-item">
					<a class="nav-link " data-value="portfolio"href="#">Portfolio</a>    
				 </li>
				 <li class="nav-item"> 
					<a class="nav-link " data-value="blog" href="#">Blog</a>         </li>   
				<li class="nav-item">  
				   <a class="nav-link " data-value="team" href="#">         Team</a>       </li>  
				<li class="nav-item"> 
				 <a class="nav-link " data-value="contact" href="#">Contact</a>       </li> 
				</ul> 
				</div>
				</nav>-->


			</div>
		</div>
		<div class="container-footer"></div>
		<script type="text/javascript" src="/scripts/jquery-3.4.1.js"></script>
		<script type="text/javascript" src="/scripts/knockout-3.5.0.js"></script>
		<script type="text/javascript" src="/scripts/models/home/masters.js"></script>
		<script type="text/javascript" src="/scripts/models/home/properties.js"></script>
		<script>
			var viewModel = new PropertyModel("fuck fuck");
			ko.applyBindings(viewModel);/**/
		</script>
	</body>
</html>