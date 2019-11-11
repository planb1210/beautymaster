"use strict";

var ItemModel = class{
	constructor(item) {
		var self = this;
		this.id = ko.observable(item != undefined ? item.Id : "");
		
		var masterId = item != undefined ? item.MasterId : "";
		var masterName = item != undefined ? item.MasterName : "";
		var data = { Id:masterId, Name: masterName };
		this.master = ko.observable(new Master(data));
		
		var serviceId = item != undefined ? item.ServiceId : "";
		var serviceName = item != undefined ? item.ServiceName : "";
		var servicePrice = item != undefined ? item.Price : "";
		var serviceDuration = item != undefined ? item.Duration : "";
		
		var data = { Id:serviceId, Name: serviceName, Price: servicePrice, Duration: serviceDuration};
		this.service = ko.observable(new Skill(data));

		this.clientName = ko.observable(item != undefined ? item.ClientName : "");
		this.clientPhone = ko.observable(item != undefined ? item.ClientPhone : "");
		this.bookingTime = ko.observable(item != undefined ? item.BookingTime : "");
		this.comment = ko.observable(item != undefined ? item.Comment : "");
		this.showTime = ko.computed(function() {
			var momentDate = Kalendae.moment(self.bookingTime());
			return momentDate.format('DD.MM.YYYY HH:mm');
		});		
	}
	
	/*save() {
		$.post("/users/editUser", {id: this.id(),name:this.name(), email:this.email(), password:this.password(), submit:'Редактировать'})
			.done(function(result) {
					alert('Изменения сохранены');
			})
	}/**/
};

var BookingModel = class {
    constructor() {
		var self = this;
		this.itemsUrl = "/booking/GetRows";
		this.countItemsUrl = "/booking/GetCountRows";
		this.deleteItemUrl = "/booking/DeleteRowById";
		this.getMastersUrl = "/home/GetMasters";
		this.updateBookingUrl = "/home/updateBooking";
		this.getServicesUrl = "home/GetSkills";
		//-------------------------------------------------------------------
		this.masters = ko.observableArray([]);
		this.services = ko.observableArray([]);	
		this.isMastersBusy = ko.observable(true);
		this.isServiceBusy = ko.observable(true);		
		this.selectedDate = ko.observable();
		this.selectedMaster = ko.observable();
		this.client = ko.observable();
		this.getMasters();
    	//-------------------------------------------------------------------
		this.items = ko.observableArray([]);
		this.editor = new ItemModel();
		this.isItemsBusy = ko.observable(true);
		//-------------------------------------------------------------------
		this.pagination = new PaginationModel();
		this.run();
	}

	run(){
		var self = this;
		self.pagination.currentPage(1);
		self.getItems();
		self.getPageCount();
	}
	
	getItems() {
		var self = this;
		self.isItemsBusy(true);

		var data = {};
		data.page = self.pagination.currentPage();
		
		if(self.selectedDate()!=undefined && self.selectedDate()!=""){
			data.date = self.selectedDate();
		}
		if(self.selectedMaster()!=undefined){
			data.master = self.selectedMaster();
		}
		if(self.client()!=undefined && self.client()!=""){
			data.client = self.client();
		}
		
		self.items([]);
		$.post(self.itemsUrl, data)
		.done(function(result) {
			var rows = JSON.parse(result);
			if(rows.length > 0){
				rows.forEach(function(row) {
					self.items.push(new ItemModel(row));
				});
			}
			self.isItemsBusy(false);
		});
	}
	
	getPageCount(){
		var self = this;
		var data = {};
		
		if(self.selectedDate()!=undefined && self.selectedDate()!=""){
			data.date = self.selectedDate();
		}
		if(self.selectedMaster()!=undefined){
			data.master = self.selectedMaster();
		}
		if(self.client()!=undefined && self.client()!=""){
			data.client = self.client();
		}
		
		self.pagination.isPagingBusy(true);
		$.post(self.countItemsUrl, data)
		.done(function(result) {
			var count = JSON.parse(result);
			self.pagination.pageCount(count != null ?  Math.ceil(count/10) : 0);
			self.pagination.generateButtons();
			self.pagination.isPagingBusy(false);
		});
	}
	
	clickPage(newPage){
		var self = this;
		self.pagination.currentPage(newPage);
		self.pagination.generateButtons();
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
					self.masters.push(new Master(item));
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
	
	getServices(){
		var self = this;
		self.isServiceBusy(true);
		$.post(self.getServicesUrl)
		.done(function(result) {
			var rows = JSON.parse(result);
			if(rows.length > 0){
				rows.forEach(function(item) {
					self.services.push(new Skill(item));
				});
				self.isServiceBusy(false);
				self.openModal();
			}
		});
	}
	
	removeItem(id){
		var self = this;
		var canDelete = confirm("Вы уверены что хотите удалить запись?");
		if(canDelete){
			var data = { id : id };
			$.post(self.deleteItemUrl, data)
			.done(function(result) {
				var status = JSON.parse(result);
				if(status == true){
					self.run();
				}
			});
		}
	}
	
	editItem(item) {
		var self = this;
		self.editor.id(item.id());		
		var data = {Id:item.master().id(), Name: item.master().name()};
		self.editor.master(new Master(data));
		var data = { Id:item.service().id(), Name: item.service().name(), Price: item.service().price(), Duration: item.service().duration() };
		self.editor.service(new Skill(data));
		self.editor.bookingTime(item.bookingTime);
		
		this.timeModel = new CalendarBlock();
		
		self.getServices();
    }
	
	openModal(){
		var self = this;
		$('#editDisplay').dialog({
            modal: true,
            buttons: {
                Accept: function() {
					var findMaster = self.masters().find(x=>x.id() == self.editor.master().id());
					var findService = self.services().find(x=>x.id() == self.editor.service().id());
					self.editor.master(findMaster);
					self.editor.service(findService);
					self.updateBooking(self.editor.id(), self.editor.master(), self.editor.service());
					$(this).dialog("close");
                },
                Cancel: function() {
                    $(this).dialog("close");
                }
            }
        });
	}
	
	updateBooking(id, master, service){
		var self = this;
		//var data = { id : id, masterId : master.Id };
		
		var item = self.items().find(x => x.id() == id);
		item.master(master);
		item.service(service);
		//console.log(item);
		//console.log(master);
		//console.log(service);
		//self.items.push(item);
		/*$.post(self.updateBookingUrl, data)
		.done(function(result) {
			var status = JSON.parse(result);
			if(status == true){
				
			}
		});/**/
	}
	
	takeTimeMode() {
		var self = this;
		var master = self.editor.master();
		var service = self.editor.service();
		console.log(master);
		self.timeModel.viewCalendar(master, service);
	}
	
	clearSelectedTime() {
		var self = this;
		self.timeModel.clearSelectedItem();
	}
}



