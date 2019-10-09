"use strict";

var BookingModel = class {
    constructor(master, skill, fullTime) {
        var self = this;
		this.master = ko.observable(master);
		this.skill = ko.observable(skill);
		this.fullTime = ko.observable(fullTime);
		//-----------------------------------------------------------------------------
		this.phone = ko.observable();
		this.checkPhoneUrl = "/home/GetClient";
		this.isPhoneValid = ko.observable(false);
		this.isPhoneBusy = ko.observable(false);
		this.phoneMessage = ko.observable();
		this.phone.subscribe(function(newValue) {
			if (/(\+7)[- _]*\(?[- _]*(\d{3}[- _]*\)?([- _]*\d){7}|\d\d[- _]*\d\d[- _]*\)?([- _]*\d){6})/g.test(newValue))
			{
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
					}
					else{
						self.phoneMessage("");
						self.isPhoneValid(true);
					}
				});
			}
			else{
				self.phoneMessage("Формат телефона неверный");
				self.isPhoneValid(false);
			}
		});
		this.isPhoneErrorVisible = ko.computed(function() {
			return self.phone()!=undefined && !self.isPhoneValid() && self.phoneMessage() != "";
		});
		//-----------------------------------------------------------------------------
		this.email = ko.observable();
		this.isEmailValid = ko.observable(false);
		this.emailMessage = ko.observable("Формат email неверный");
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
	}
};