"use strict";

var Service = class {
    constructor(data) {
        var self = this;
		this.id = ko.observable(data.No);
		this.name = ko.observable(data.Skill);
		this.price = ko.observable(data.Price);	
		this.duration = ko.observable(data.Duration);	
		this.divisionid = ko.observable(data.DivisionId);
		this.description = ko.observable(data.Description);	
		this.editMode = ko.observable(false);
	}
	toggleMode(){
		 this.editMode(!this.editMode());
	}
	
	save(){
		$.post("/services/editService", {id: this.id(),name:this.name(), price:this.price(), duration:this.duration(), divisionid:this.divisionid(), description:this.description(), submit:'Редактировать'})
			.done(function(result) {
					alert('Изменения сохранены');
					})
	}
		
}


var ServicesModel = class {
    constructor() {
		var self = this;
		this.services = ko.observableArray([]);
		this.getServicesUrl = "/services/GetServices";
		this.deleteServicesUrl = "/services/deleteService";
		this.addServicesUrl = "/services/addService";	
		this.viewServices();				
	}
	
	viewServices() {
		var self = this;
		if(self.services().length<=0){
			$.post(self.getServicesUrl)
			.done(function(result) {
					JSON.parse(result).forEach(function(item) {
					self.services.push(new Service(item));
				});
			});
		}
	}
	
	deleteService(ID) {
		self = this;
		$.post(self.deleteServicesUrl, {submit:'Удалить', id: ID})
			.done(function(result) {
				alert('Удалено')});
		this.services.remove(function(item){return item.id() === ID});
	}
	
	addService(form){
		self = this;
		var arr=[];
		for(var i=0; i<6; i++){
		arr.push(form[i].value);
		}
		$.post(self.addServicesUrl, {name:arr[0], price:arr[1], duration:arr[2], divisionid:arr[3], description:arr[4], submit:arr[5]})
			.done(function(result) {
					JSON.parse(result).forEach(function(item){
					self.services.push(new Service(item));
					alert('Услуга добавлена');
					})
			})
	}
	
}



