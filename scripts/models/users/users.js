"use strict";

var User = class {
    constructor(item) {
        var self = this;
		this.id = ko.observable(item.id);
		this.name = ko.observable(item.Name);
		this.email = ko.observable(item.Email);
		this.password = ko.observable(item.Password)
		this.role = ko.observable(item.Role)
	}
};

var UsersModel = class {
    constructor() {
		var self = this;
		this.users = ko.observableArray([]);
		this.getUsersUrl = "/users/GetUsers";
		this.deleteUsersUrl = "/users/deleteUser";
		
		this.viewUsers();
				
	}
	
	viewUsers() {
		var self = this;
		if(self.users().length<=0){
			$.post(self.getUsersUrl)
			.done(function(result) {
					JSON.parse(result).forEach(function(item) {
					self.users.push(new User(item));
				});
			});
		}
		
	}
	
	deleteUser(ID) {
		self = this;
		$.post(self.deleteUsersUrl, {submit:'Удалить', id: ID})
			.done(function(result) {
				alert('удален')});
		this.users.remove(function(item){return item.id() === ID});
	}
	
	addUser(form){
		self = this;
		var arr=[];
		for(var i=0; i<4; i++){
		arr.push(form[i].value);}
		$.post('addUser', {name:arr[0], email:arr[1], password:arr[2], submit:arr[3]})
			.done(function(result) {
					var item = JSON.parse(result);
					self.users.push(new User(item));
					alert('пользователь добавлен');
					console.log(result);
				});
		
	}
		
}



