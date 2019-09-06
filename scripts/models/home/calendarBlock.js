"use strict";

infuser.defaults.templateUrl = "/views/home/templates/";

class TimePart {	
	constructor(hour, minute) {
		var self = this;
		this.year = ko.observable();
		this.month = ko.observable();
		this.day = ko.observable();
		this.hour = ko.observable(hour);
		this.minute = ko.observable(minute);
		this.showTime = ko.computed(function() {
			return self.hour()+":"+(self.minute() == 0 ? "00" : self.minute());
		});
		this.showFullTime = ko.computed(function() {
			return self.year()+"-"+self.month()+"-"+self.day()+" "+self.hour()+":"+(self.minute() == 0 ? "00" : self.minute());
		});
	}
}

var barberShopTimeParts = [new TimePart(10,0), 
				new TimePart(10,30),
				new TimePart(11, 0),
				new TimePart(11, 30),
				new TimePart(12, 0),
				new TimePart(12, 30),
				new TimePart(13, 0),
				new TimePart(13, 30),
				new TimePart(14, 0),
				new TimePart(14, 30),
				new TimePart(15, 0),
				new TimePart(15, 30),
				new TimePart(16, 0),
				new TimePart(16, 30),
				new TimePart(17, 0),
				new TimePart(17, 30),
				new TimePart(18, 0),
				new TimePart(18, 30)];
				
var manicureTimeParts = [new TimePart(10,0), 
				new TimePart(12, 30),
				new TimePart(14, 30),
				new TimePart(16, 30),
				new TimePart(18, 30)];

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
		var data = { employeeId: master.id(), time: date };
		$.post(self.getClientTimeBookingUrl, data)
		.done(function(result) {
			var rows = JSON.parse(result);
			var	timeBlocks = [];
			if(skill.divisionId() == 1){
				timeBlocks = self.getBarberShopTimeParts(rows, skill.duration());
			}
			if(skill.divisionId() == 2){
				timeBlocks = self.getManicureTimeParts(rows, skill.duration());
			}
			self.availableTimeBlocks(self.prepareTimePart(date, timeBlocks));
		});
	}
	
	prepareTimePart(date, parts) {
		var result = parts.map(function(part) {
			part.year(new Date(date).getFullYear());
			part.month(new Date(date).getMonth()+1);
			part.day(new Date(date).getDate());
			return part;
		});
		return result;
	}
	
	
	getBarberShopTimeParts(rows, serviceDuration){
		var self = this;
		var result = self.prepareLastTime(barberShopTimeParts, serviceDuration);		
		
		rows.forEach(function(row) {
			result = self.getTimePart(result, row, serviceDuration);			
		});		
		return result;
	}
	
	getManicureTimeParts(rows, serviceDuration){
		var self = this;
		var result = manicureTimeParts;		
		
		rows.forEach(function(row) {
			result = self.getTimePart(result, row, serviceDuration);			
		});		
		return result;
	}
	
	prepareLastTime(parts, serviceDuration){
		var lastTime = new TimePart(19 - serviceDuration,0);
		var result = [];
		var stop = false;
		parts.forEach(function(part) {
			if(part.hour() == lastTime.hour() && part.minute() == lastTime.minute()){
				result.push(part);
				stop = true;
			}
			if(!stop){
				result.push(part);
			}
		});
		return result;
	}
	
	getTimePart(parts, bookingObj, serviceDuration){
		var hour = new Number(new Date(bookingObj.BookingTime).getHours());
		var minute = new Number(new Date(bookingObj.BookingTime).getMinutes());
		var duration = new Number(bookingObj.Duration);
		var firstTime = new TimePart(hour-serviceDuration, minute);
		var lastTime = new TimePart(hour+duration, minute);
		var stop = firstTime.hour()<parts[0].hour() ? true : false;
		var result = [];
		
		parts.forEach(function(part) {
			if(part.hour() == firstTime.hour() && part.minute() == firstTime.minute()){
				result.push(part);
				stop = true;
			}
			if(part.hour() == lastTime.hour() && part.minute() == lastTime.minute()){
				stop = false;
			}
			if(!stop){
				result.push(part);
			}
		});
		return result;
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

