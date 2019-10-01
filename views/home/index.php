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
					<!-- ko if: !isBookingModeUse() -->
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

							<div class="button-block list-item" data-bind="visible: !isMasterModeUse()">
								<button class="button-item" type="submit" data-bind="click: takeBookingMode, css: { 'button-enable': canBooking, 'button-disable': !canBooking() }">Записаться на услугу</button>
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
					<!-- /ko -->
					
					<!-- ko if: isBookingModeUse -->
						<div class="title">
							Детали заказа:
						</div>
						<div class="skill">
							<span data-bind="text: selectedSkill().name()"></span>
							<span data-bind="text: selectedSkill().description()"></span>
						</div>
						<div class="master">
							<span data-bind="text: selectedMaster().name()"></span>
						</div>
						<div class="time">
							<span data-bind="text: selectedTime().showFullTime()"></span>
						</div>	

						<form layout="column" name="orderForm" novalidate="novalidate" method="post" autocomplete="false" class="">						
							<div>
								<label class="ng-binding" for="record_name">Имя</label>
								<input tabindex="1" name="name" autocomplete="false" id="record_name" class="name-input online_booking_record" required="required"/>							
							</div>
							<div>
								<label class="ng-binding" for="record_email">Email</label>
								<input tabindex="4" name="email" autocomplete="false" id="record_email" class="online_booking_record" type="email"/>
							</div>
							<div>
								<label class="ng-binding ng-scope" for="record_comment">Комментарий к записи</label>							
								<textarea aria-label="comment" name="comment" id="record_comment" class="online_booking_record" tabindex="5" columns="1" maxlength="150" rows="1" style="height: 30px;"></textarea>
							</div>
							<button><span class="ng-binding">Записаться</span></button>
						</form>			
			
					<!-- /ko -->
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
		<script type="text/javascript" src="/scripts/models/home/booking.js"></script>	
		<script type="text/javascript" src="/scripts/models/home/properties.js"></script>		
		<script>
			var viewModel = new PropertyModel();
			ko.applyBindings(viewModel);/**/
		</script>
	</body>
</html>