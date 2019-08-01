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
				<div class="middle-block">
					<!-- ko if: isEmptyModeUse -->
						<div class="list-item">
							<div class="list-item-wrapper">
								<h3 data-bind="click: takeMasterMode">Выбор мастера</h3>
								<!-- ko if: selectedMaster -->
									<div data-bind="text: selectedMaster().name"></div>
								<!-- /ko -->
								<!-- ko ifnot: selectedMaster -->
								<div>
								список мастеров
								</div>
								<!-- /ko -->
							</div>
						</div>
						<div class="list-item" data-bind="visible: !isMasterModeUse()">
							<div class="list-item-wrapper">
								<h3 data-bind="click: takeSkillsMode">Выбор услуги</h3>
								<!-- ko if: selectedSkill -->
									<div data-bind="text: selectedSkill().name"></div>
								<!-- /ko -->
								<!-- ko ifnot: selectedSkill -->
								<div>
								список услуг
								</div>
								<!-- /ko -->
							</div>
						</div>
						<div class="list-item" data-bind="visible: !isMasterModeUse()">
							<div class="list-item-wrapper">
								<h3>Выбор даты</h3>
								<div>
								календарь
								</div>
							</div>
						</div>
					<!-- /ko -->
					<div data-bind="visible: isMasterModeUse">
						<!-- ko with: masterModel -->
							<div class="list-item-wrapper">
								<h3 data-bind="click: changeMode">Выбор мастера</h3>
							</div>
							<div data-bind="visible: isSelectedMode">
								<!-- ko foreach: masters -->
									<div data-bind="text: name, click:function(data) { $parent.selectItem(data) } "></div>
								<!-- /ko -->
							</div>
						<!-- /ko -->					
					</div>
					
					<div data-bind="visible: isSkillsModeUse">
						<!-- ko with: skillModel -->
							<div class="list-item-wrapper">
								<h3 data-bind="click: changeMode">Выбор услуги</h3>
							</div>
							<div data-bind="visible: isSelectedMode">
								<!-- ko foreach: skills -->
									<div data-bind="text: name, click:function(data) { $parent.selectItem(data) } "></div>
								<!-- /ko -->
							</div>
						<!-- /ko -->					
					</div>
				</div>
			</div>
		</div>
		<div class="container-footer"></div>
		<script type="text/javascript" src="/scripts/jquery-3.4.1.js"></script>
		<script type="text/javascript" src="/scripts/knockout-3.5.0.js"></script>
		<script type="text/javascript" src="/scripts/models/home/baseBlock.js"></script>
		<script type="text/javascript" src="/scripts/models/home/mastersBlock.js"></script>
		<script type="text/javascript" src="/scripts/models/home/skillsBlock.js"></script>
		<script type="text/javascript" src="/scripts/models/home/properties.js"></script>		
		<script>
			var viewModel = new PropertyModel();
			ko.applyBindings(viewModel);/**/
		</script>
	</body>
</html>