"use strict";

infuser.defaults.templateUrl = "/views/home/templates/";

class CalendarBlock extends BaseBlock {	
    constructor() {
		super();
		this.getScheduleUrl = "/home/GetSchedule";
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
					months:3,
					direction:'today-future',
					mode:'multiple',
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
					}
				});
			}
		});
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
};

