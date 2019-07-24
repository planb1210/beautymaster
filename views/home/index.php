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
				<div>
				<p data-bind="text: name"></p>
				<p data-bind="text: name"></p>
				</div>
				<p><button id="changePhoneBtn">Изменить</button></p>
				
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
</div></nav>


			</div>
		</div>
		<div class="container-footer"></div>
		<script type="text/javascript" src="scripts/knockout-3.5.0.js"></script>
		<script type="text/javascript" src="scripts/models/home/properties.js"></script>
		<script>
			var viewModel = new PropertyModel("fuck fuck");
			ko.applyBindings(viewModel);
		</script>
	</body>
</html>