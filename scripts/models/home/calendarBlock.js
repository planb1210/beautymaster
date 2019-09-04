"use strict";

infuser.defaults.templateUrl = "/views/home/templates/";

class CalendarBlock extends BaseBlock {	
    constructor() {
		super();
		var self = this;
		this.getScheduleUrl = "/home/GetSchedule";
		this.getClientTimeBookingUrl = "/home/GetClientTimeBooking";		
		this.availableTimeBlocks = ko.observableArray([]);
		this.showAvailableTimeBlocks = ko.computed(function() {
			return self.availableTimeBlocks().length > 0;
		});
	}
	
	viewCalendar(master, skill) {
		var self = this;
		self.isSelectedMode(!self.isSelectedMode());
		
		var data = { employeeId: master.id()};
		$.post(self.getScheduleUrl, data)
		.done(function(result) {
			var rows = JSON.parse(result);			
			if(rows.length>0){
				var validDays = self.parseCalendarData(rows);
				$("#cal").html("");
				new Kalendae({
					attachTo:"cal",
					months:1,
					direction:'today-future',
					mode:'single',
					dayHeaderClickable: true,
					blackout: function (date) {
						var result = 1;
						validDays.forEach(function(element) {
							var isSomeDay = Kalendae.moment(date).isSame(element, 'day');
							if(isSomeDay){
								result = 0;
								return false;
							}
						});
						return result;
					},
					subscribe: {
						'change': function (date) {
							self.getTimeBooking(this.getSelected(), master, skill);
						}
					}
				});
			}
		});
	}
	
	getTimeBooking(date, master, skill) {
		var self = this;
		//self.availableTimeBlocks(self.getTimeBlocks());
		var data = { employeeId: master.id(), time: date };
		$.post(self.getClientTimeBookingUrl, data)
		.done(function(result) {
			var rows = JSON.parse(result);			
			if(rows.length>0){
				var test = new Date(rows[0].BookingTime);
				console.log(test);
			}
		});
	}
	
	getTimeBlocks(){
		var self = this;
		var times = [{time: "10:00"}, {time: "10:30"}, {time: "11:00"}];
		return times;
	}
	
	parseCalendarData(calendarData) {
		var resultDays = [];
		calendarData.forEach(function(item) {
			var yeahr = item.Yeahr;
			var month = item.Month;
			var days = item.Days.split(';');			
			days.forEach(function(day) {
				resultDays.push(Kalendae.moment(String(yeahr)+String(month)+String(day), "YYYYMMDD"));
			});
		});
		return resultDays;
	}
	
	changeMode() {
		var self = this;
		self.isSelectedMode(!self.isSelectedMode());
		self.availableTimeBlocks([]);
	}
};

