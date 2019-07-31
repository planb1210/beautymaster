"use strict";

var MastersModel = class {
    constructor() {
        var self = this;
		this.masters = ko.observableArray([]);
		this.selectedMaster = ko.observable();
		this.isSelectedMode = ko.observable(false);		
	}
	
	viewMasters() {
		var self = this;
		self.isSelectedMode(!self.isSelectedMode());
		if(self.masters().length<=0){
			$.post("/home/test", { id: 1232})
			.done(function(data) {
				self.masters.push({name:data});
				console.log(self.masters());
			});
		}
	}
};

