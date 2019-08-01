"use strict";

var PropertyModel = class {
    constructor() {
        var self = this;
		
		this.masterModel = new MastersBlock();
		this.isMasterModeUse = ko.computed(function() {
			return self.masterModel.isSelectedMode();
		});
		this.selectedMaster = ko.computed(function() {
			return self.masterModel.selectedItem();
		});
		
		
		this.skillModel = new SkillsBlock();
		this.isSkillsModeUse = ko.computed(function() {
			return self.skillModel.isSelectedMode();
		});
		this.selectedSkill = ko.computed(function() {
			return self.skillModel.selectedItem();
		});
		
		
		this.isEmptyModeUse = ko.computed(function() {
			return !self.isMasterModeUse() && !self.isSkillsModeUse();
		});	
	}
	
	takeMasterMode() {
		var self = this;
		self.masterModel.viewMasters(self.selectedSkill());
	}
	
	takeSkillsMode() {
		var self = this;
		self.skillModel.viewSkills(self.selectedMaster());
	}
};

