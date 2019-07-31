"use strict";

var Master = class {
    constructor(data) {
        var self = this;
		this.id = ko.observable(data.Id);
		this.name = ko.observable(data.Name);
		this.email = ko.observable(data.Email);		
	}
};

var MastersModel = class {
    constructor() {
		this.masters = ko.observableArray([]);
		this.selectedMaster = ko.observable();
		this.isSelectedMode = ko.observable(false);
		this.getMastersUrl = "/home/GetMasters";
	}
	
	viewMasters() {
		var self = this;
		self.isSelectedMode(!self.isSelectedMode());
		if(self.masters().length<=0){
			$.post(self.getMastersUrl)
			.done(function(result) {
				
				JSON.parse(result).forEach(function(item) {
					self.masters.push(new Master(item));
				});
			});
		}
	}
	
	selectMaster(master){
		var self = this;
		self.selectedMaster(master);
		self.changeMode();
	}
	
	changeMode() {
		var self = this;
		self.isSelectedMode(!self.isSelectedMode());
	}
};

