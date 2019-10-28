"use strict";

var User = class {
    constructor(item) {
        var self = this;
		this.id = ko.observable(item.Id);
		this.name = ko.observable(item.Name);
		this.email = ko.observable(item.Email);
		this.password = ko.observable(item.Password);
		this.role = ko.observable(item.Role);
		this.editMode = ko.observable(false);
	}
	
	toggleMode(){
		this.editMode(!this.editMode());
	}
	
	save(){
		$.post("/users/editUser", {id: this.id(),name:this.name(), email:this.email(), password:this.password(), submit:'Редактировать'})
			.done(function(result) {
					alert('Изменения сохранены');
			})
	}
};


var Skill = class {
	constructor(item) {
		 var self = this;
		 this.id = ko.observable(item.Id);
		 this.name = ko.observable(item.Name);
		 this.skill = ko.observable(item.Skill);
		 this.skillId = ko.observable(item.No);		 
		 }
		 
		
	}


var UsersModel = class {
    constructor(isProfile) {
		var self = this;
		this.users = ko.observableArray([]);
		this.skills = ko.observableArray([]);
		this.skillsToAdd = ko.observableArray([]);
		//this.skillsEmptyId=(window.location.pathname).split('/')[2];
		//this.emptyUserName=get
		//this.emptyUserName=ko.computed(function(){ var b=self.users().find(function(it){return it.id()==self.skillsEmptyId()}); if (b!==undefined){return b.name()}});
		this.skillArr = ko.computed(function(){var a=[];self.skills().forEach(function(el){a.push(el.skill())}); return a});
		this.profileMode = ko.observable(false);
		this.editSkillMode = ko.observable(false);
		this.getUsersUrl = "/users/GetUsers";
		this.deleteUsersUrl = "/users/deleteUser";
		this.addUsersUrl = "/users/addUser";
		if (isProfile){} else{
		this.viewUsers();
		}
				
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
		$.post(self.addUsersUrl, {name:arr[0], email:arr[1], password:arr[2], submit:arr[3]})
			.done(function(result) {
					JSON.parse(result).forEach(function(item){
					self.users.push(new User(item));
					alert('пользователь добавлен');					
				})
			})
		
	}
	
	viewProfile(id){
		self = this;
		$.post('/profile/GetUsers', {id:id})
			.done(function(result) {
				JSON.parse(result).forEach(function(item){								
				self.users.push(new User(item));
				if (!("Email" in item))self.skills.push(new Skill(item))
				})
			})
		}
	
	
	deleteSkill(id, skillId) {
		self = this;
		$.post('/profile/DeleteSkill', {submit:'Удалить', id:id, skillId:skillId})
			.done(function(result) {
				self.skills.remove(function(item){return item.skillId()==skillId()});
				alert('удален');											
			})
		
	}
	
	viewSkillsToAdd(id, skillsArr) {
		self = this;
		$.post('/profile/ViewSkillsToAdd', {submit:'Отобразить', id:id, skillsArr:skillsArr})
		.done(function(result) {
			JSON.parse(result).forEach(function(item){
			self.skillsToAdd.push(new Skill(item));
			});
		})
	}
	
	addSkill(id, skillId){
		self = this;
		$.post('/profile/AddSkill', {submit:'Добавить', id:id, skillId:skillId})
		.done(function(result) {
			JSON.parse(result).forEach(function(item){
			self.skills.push(new Skill(item));
			});
		})
	}
		
}



