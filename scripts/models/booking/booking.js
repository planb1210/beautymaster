"use strict";


var BookingModel = class {
    constructor() {
		var self = this;
		this.users = ko.observableArray([]);
		this.skills = ko.observableArray([]);
		this.skillsToAdd = ko.observableArray([]);
		this.skillsEmptyId=ko.observable();
		this.emptyUserName=ko.computed(function(){ var b=self.users().find(function(it){return it.id()==self.skillsEmptyId()}); if (b!==undefined){return b.name()}});
		this.skillArr = ko.computed(function(){var a=[];self.skills().forEach(function(el){a.push(el.skill())}); return a});
		this.profileMode = ko.observable(false);
		this.editSkillMode = ko.observable(false);
		this.getUsersUrl = "/users/GetUsers";
		this.deleteUsersUrl = "/users/deleteUser";
		this.addUsersUrl = "/users/addUser";
		
		//this.viewUsers();
				
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
}



