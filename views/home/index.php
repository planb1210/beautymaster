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
							<!-- ko if: selectedMaster -->
								<i data-bind="click: clearSelectedMaster" class="mdi y-icon remove-button mdi-close-circle-outline"></i>
							<!-- /ko -->
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
							<!-- ko if: selectedSkill -->
								<i data-bind="click: clearSelectedSkill" class="mdi y-icon remove-button mdi-close-circle-outline"></i>
							<!-- /ko -->
						</div>
						<div class="list-item" data-bind="visible: !isMasterModeUse()">
							<div class="list-item-wrapper">
								<h3 data-bind="click:function() { if(isCalendarEnabled()){takeTimeMode()} }, style: { color: isCalendarEnabled() ? 'black' : 'gray' }">Выбор даты</h3>
								<!-- ko if: selectedTime -->
									<div data-bind="text: selectedTime().showFullTime()"></div>
								<!-- /ko -->
								<!-- ko ifnot: selectedTime -->
								<div>
								календарь								
								</div>
								<!-- /ko -->
							</div>
							<!-- ko if: selectedTime -->
								<i data-bind="click: clearSelectedTime" class="mdi y-icon remove-button mdi-close-circle-outline"></i>
							<!-- /ko -->
						</div>
					<!-- /ko -->
					
					<div data-bind="visible: isMasterModeUse">
						<!-- ko with: masterModel -->
							<div class="list-item-wrapper">
								<h3 data-bind="click: changeMode">Выбор мастера</h3>
							</div>
							<div data-bind="visible: isSelectedMode, template: { name: template, foreach: masters }"></div>
						<!-- /ko -->					
					</div>
					
					<div data-bind="visible: isSkillsModeUse">
						<!-- ko with: skillModel -->
							<div class="list-item-wrapper">
								<h3 data-bind="click: changeMode">Выбор услуги</h3>
							</div>
							<div data-bind="visible: isSelectedMode, template: { name: template, foreach: skills }"></div>
						<!-- /ko -->					
					</div>
					
					<div data-bind="visible: isTimeModeUse">
						<!-- ko with: timeModel -->
							<div class="list-item-wrapper">
								<h3 data-bind="click: changeMode">Выбор даты</h3>
							</div>
							<div id="cal"></div>
							<!-- ko if: showAvailableTimeBlocks() -->							
								<div data-bind="foreach: availableTimeBlocks">
									<div class="time-slot-wrapper">
										<button class="y-button y-button_transparent time-slot ng-binding" data-bind="text: showTime, click:function(data) { $parent.selectItem(data) }"></button>
									</div>
								</div>
							<!-- /ko -->
						<!-- /ko -->					
					</div>		
					
					
				</div>
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