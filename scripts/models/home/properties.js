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
		
		
		this.timeModel = new CalendarBlock();
		this.isTimeModeUse = ko.computed(function() {
			return self.timeModel.isSelectedMode();
		});
		this.selectedTime = ko.computed(function() {
			return self.timeModel.selectedItem();
		});
		
		
		this.isEmptyModeUse = ko.computed(function() {
			return !self.isMasterModeUse() && !self.isSkillsModeUse();
		});
		
		this.isCalendarEnabled = ko.computed(function() {
			return self.isEmptyModeUse() && self.selectedMaster()!=null && self.selectedSkill()!=null;
		});
	}
	
	takeMasterMode() {
		var self = this;
		self.masterModel.viewMasters(self.selectedSkill());
	}
	
	clearSelectedMaster() {
		var self = this;
		self.masterModel.clearSelectedItem();
	}	
	
	takeSkillsMode() {
		var self = this;
		self.skillModel.viewSkills(self.selectedMaster());
	}
	
	clearSelectedSkill() {
		var self = this;
		self.skillModel.clearSelectedItem();
	}
	
	takeTimeMode() {
		var self = this;
		self.timeModel.viewCalendar(self.selectedMaster(), self.selectedSkill());
	}
};

