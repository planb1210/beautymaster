"use strict";

var Master = class {
    constructor(data) {
        var self = this;
		this.id = ko.observable(data.Id);
		this.name = ko.observable(data.Name);
		this.email = ko.observable(data.Email);		
	}
};

class MastersBlock extends BaseBlock {	
    constructor() {
		super();		
		this.masters = ko.observableArray([]);
		this.getMastersUrl = "/home/GetMasters";
	}
	
	viewMasters(skill) {
		var self = this;
		
		self.masters([]);
		self.isSelectedMode(!self.isSelectedMode());
		
		var data = {};
		if(skill!=null){
			data = { id: skill.id()};
		}

		$.post(self.getMastersUrl, data)
		.done(function(result) {
			var rows = JSON.parse(result);
			if(rows.length > 0){				
				rows.forEach(function(item) {
					self.masters.push(new Master(item));
				});
			}
		});
	}
};

