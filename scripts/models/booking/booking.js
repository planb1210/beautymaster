"use strict";

var MasterModel = class{
	constructor(item) {
		this.Id = item.Id;
		this.Name = item.Name;
	}
};

var PaginationModel = class {
    constructor() {
		var self = this;
		this.countUrl = "/booking/GetPages";
		this.buttons = ko.observableArray([]);
		this.isBusy = ko.observable(true);
		
		this.currentPage = ko.observable(0);
	}
	
	getCount() {
		var self = this;
		self.isBusy(true);
		$.post(self.countUrl)
		.done(function(result) {
			var count = JSON.parse(result);
			if(count != null){
				
			}
			self.isBusy(false);
		});
	}	
}	
var BookingModel = class {
    constructor() {
		var self = this;
		this.itemsUrl = "/booking/GetRows";
		this.countItemsUrl = "/booking/GetCountRows";
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
		//-------------------------------------------------------------------
		this.buttons = ko.observableArray([]);
		this.currentPage = ko.observable(1);
		this.pageCount = ko.observable(1);
		this.isPagingBusy = ko.observable(true);
		
		this.run();
	}
	
	run(){
		var self = this;
		self.getItems();
		self.getPageCount();
	}
	
	getItems() {
		var self = this;
		self.isItemsBusy(true);

		var data = {};
		data.page = self.currentPage();
		
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
	
	getPageCount(){
		var self = this;
		var data = {}
		if(self.selectedDate()!=undefined && self.selectedDate()!=""){
			data.date = self.selectedDate();
		}
		if(self.selectedMaster()!=undefined){
			data.master = self.selectedMaster();
		}
		self.isPagingBusy(true);
		$.post(self.countItemsUrl, data)
		.done(function(result) {
			var count = JSON.parse(result);
			self.pageCount(count != null ?  Math.ceil(count/10) : 0);
			self.generateButtons();
			self.isPagingBusy(false);
		});
	}
	
	generateButtons(){
		var self = this;
		self.buttons([]);
		
		if(self.pageCount()>1){
			var firstPage = (self.currentPage() > 3) ? self.currentPage()-2 : 1;
			
			if(self.currentPage()>3){
				self.buttons().push(1);
			}
			for (var i = 0; i < 5; i++) {
				if(i+firstPage <= self.pageCount()){
					self.buttons().push(i+firstPage);
				}
			}
			if(self.pageCount()>firstPage+5){
				self.buttons().push(self.pageCount());
			}
		}
	}
	
	clickPage(newPage){
		var self = this;
		self.currentPage(newPage);
		self.generateButtons();
		self.getItems();
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



