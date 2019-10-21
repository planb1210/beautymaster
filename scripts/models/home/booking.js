"use strict";

var BookingModel = class {
    constructor(master, skill, fullTime) {
        var self = this;
		this.bookingUrl = "/home/Booking";
		this.master = ko.observable(master);
		this.skill = ko.observable(skill);
		this.fullTime = ko.observable(fullTime);
		//-----------------------------------------------------------------------------
		this.phone = ko.observable();
		this.checkPhoneUrl = "/home/GetClient";
		this.isPhoneValid = ko.observable(false);
		this.isPhoneBusy = ko.observable(false);
		this.isPhoneFind = ko.observable(false);
		this.phoneMessage = ko.observable();
		this.phone.subscribe(function(newValue) {
			self.isPhoneFind(false);
			if (/(\+7)[- _]*\(?[- _]*(\d{3}[- _]*\)?([- _]*\d){7}|\d\d[- _]*\d\d[- _]*\)?([- _]*\d){6})/g.test(newValue))
			{
				self.email("");
				self.name("");
				var data = { phone: newValue };				
				$.post(self.checkPhoneUrl, data)
				.done(function(result) {
					var rows = JSON.parse(result);	
					if(rows.length > 0){
						self.phoneMessage("Найден пользователь");
						self.isPhoneValid(true);
						var row = rows[0];
						self.email(row.Email);
						self.name(row.Name);
						self.isPhoneFind(true);
					}
					else{
						self.phoneMessage("");
						self.isPhoneValid(true);
					}
				});
			}
			else{
				self.phoneMessage("Поле пустое или формат телефона неверный");
				self.isPhoneValid(false);
			}
		});
		this.isPhoneErrorVisible = ko.computed(function() {
			return self.phone()!=undefined && !self.isPhoneValid() && self.phoneMessage() != "";
		});
		//-----------------------------------------------------------------------------
		this.email = ko.observable();
		this.isEmailValid = ko.observable(false);
		this.emailMessage = ko.observable("Поле пустое или формат email неверный");
		this.email.subscribe(function(newValue) {
			if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(newValue))
			{				
				self.isEmailValid(true);
			}
			else{
				self.isEmailValid(false);
			}
		});
		this.isEmailErrorVisible = ko.computed(function() {
			return self.email()!=undefined && !self.isEmailValid();
		});
		//-----------------------------------------------------------------------------
		this.name = ko.observable();
		//-----------------------------------------------------------------------------
		this.comment = ko.observable();
		//-----------------------------------------------------------------------------
		this.canBooking = ko.computed(function() {
			return self.isPhoneValid() && self.isEmailValid() && self.name()!=undefined && self.name()!="";
		});
		this.isBookingFinish = ko.observable(false);
		this.bookingStatus = ko.observable();
		this.bookingText = ko.observable();
	}
	
	booking() {
		var self = this;
		var data = {};
				
		data = { phone: self.phone(),
				email:self.email(),
				name: self.name(),
				comment: self.comment(),
				masterId:self.master().id(),
				skillId: self.skill().id(),
				fullTime: self.fullTime()
				};
		
		$.post(self.bookingUrl, data)
		.done(function(result) {
			var resultObj = JSON.parse(result);
			self.bookingStatus(resultObj.Status);
			self.bookingText(resultObj.Text);
			self.isBookingFinish(true);
		});
	}
};