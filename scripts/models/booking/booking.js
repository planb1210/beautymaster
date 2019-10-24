"use strict";

var BookingModel = class {
    constructor() {
		var self = this;
		this.itemsUrl = "/booking/GetRows";
		this.items = ko.observableArray([]);
		this.isBusy = ko.observable(true);
		this.run();
	}
	
	run() {
		var self = this;
		self.isBusy(true);
		
		
		/*data = { phone: self.phone(),
			email:self.email(),
			name: self.name(),
			comment: self.comment(),
			masterId:self.master().id(),
			skillId: self.skill().id(),
			fullTime: self.fullTime()
			};/**/
		
		$.post(self.itemsUrl)//, data)
		.done(function(result) {
			var items = JSON.parse(result);
			console.log(items);
			self.items(items);
			self.isBusy(false);
		});
	}
}



