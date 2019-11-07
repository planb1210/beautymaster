"use strict";

var MasterModel = class{
	constructor(item) {
		this.Id = item.Id;
		this.Name = item.Name;
	}
};

var ItemModel = class{
	constructor(item) {
		var self = this;
		this.id = item!=undefined ? item.Id : "";;
		this.masterName = ko.observable(item!=undefined ? item.MasterName: "");
		this.clientName = ko.observable(item!=undefined ? item.ClientName:"");
		this.clientPhone = item!=undefined ? item.ClientPhone : "";
		this.serviceName = item!=undefined ? item.ServiceName : "";
		this.price = item!=undefined ? item.Price+" руб." : "";
		this.duration = item!=undefined ? item.Duration+" ч." : "";
		this.bookingTime = item!=undefined ? item.BookingTime : "";
		this.comment = item!=undefined ? item.Comment : "";
		this.showTime = ko.computed(function() {
			var momentDate = Kalendae.moment(self.bookingTime);
			return momentDate.format('DD.MM.YYYY HH:mm');
		});
		this.show = ko.observable(false);
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
		//-------------------------------------------------------------------
		this.masters = ko.observableArray([]);	
		this.isMastersBusy = ko.observable(true);
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
		self.editor.clientName(item.clientName());
        $('#editDisplay').dialog({
            modal: true,
            buttons: {
                Accept: function() {
					$(this).dialog("close");
                },
                Cancel: function() {
                    $(this).dialog("close");
                }
            }
        });
    }
}



