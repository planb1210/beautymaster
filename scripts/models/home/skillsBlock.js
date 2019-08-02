"use strict";

infuser.defaults.templateUrl = "/views/home/templates/";

var Skill = class {
    constructor(data) {
        var self = this;
		this.id = ko.observable(data.Id);
		this.name = ko.observable(data.Name);
		this.price = ko.observable(data.Price);	
		this.duration = ko.observable(data.Duration);	
		this.description = ko.observable(data.Description);			
	}
};

class SkillsBlock extends BaseBlock {	
    constructor() {
		super();		
		this.skills = ko.observableArray([]);
		this.getSkillsUrl = "/home/GetSkills";
		this.template = "mastersBlock";
	}
	
	viewSkills(master) {
		var self = this;

		self.skills([]);
		self.isSelectedMode(!self.isSelectedMode());
		
		var data = {};
		if(master!=null){
			data = { id: master.id()};
		}

		$.post(self.getSkillsUrl, data)
		.done(function(result) {
			var rows = JSON.parse(result);
			if(rows.length > 0){
				JSON.parse(result).forEach(function(item) {
					self.skills.push(new Skill(item));
				});
			}
		});
	}
	
	whichTemplateToUse() {
		return 'skillsBlock2';
	}
};

