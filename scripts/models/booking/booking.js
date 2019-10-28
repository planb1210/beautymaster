"use strict";

var MasterModel = class{
	constructor(item) {		
		this.Id = item.Id;
		this.Name = item.Name;
	}
};
	
var BookingModel = class {
    constructor() {
		var self = this;
		this.itemsUrl = "/booking/GetRows";
		this.getMastersUrl = "/home/GetMasters";
		
		//-------------------------------------------------------------------
		this.masters = ko.observableArray([]);	
		this.isMastersBusy = ko.observable(true);
		this.selectedDate = ko.observable();
		this.selectedMaster = ko.observable();
		this.getMasters();
    	//-------------------------------------------------------------------
		
		this.items = ko.observableArray([]);		
		this.isItemsBusy = ko.observable(true);	
		this.run();
	}
	
	run() {
		var self = this;
		self.isItemsBusy(true);
		
		var data = {}
		if(self.selectedDate()!=undefined && self.selectedDate()!=""){
			data.date = self.selectedDate();
		}
		if(self.selectedMaster()!=undefined){
			data.master = self.selectedMaster();
		}
		
		self.items([]);
		$.post(self.itemsUrl, data)
		.done(function(result) {
			var rows = JSON.parse(result);
			if(rows.length > 0){	
				self.items(rows);
			}
			self.isItemsBusy(false);
		});
	}
	
	getMasters(){
		var self = this;
		self.isMastersBusy(true);
		$.post(self.getMastersUrl)
		.done(function(result) {
			var rows = JSON.parse(result);
			if(rows.length > 0){				
				rows.forEach(function(item) {
					self.masters.push(new MasterModel(item));
				});
			}			
			
			self.isMastersBusy(false);
			
			var kalendae = new Kalendae.Input('cal', {
				months:1,
	     		mode:'single',
				format: "YYYY-MM-DD"
			});		
		});
	}
}



