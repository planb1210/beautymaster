"use strict";

var PropertyModel = class {
    constructor(name) {
        var self = this;
		this.name = name;
		
		this.masterModel = new MastersModel();
		this.isMasterModeUse = ko.computed(function() {
			return self.masterModel.isSelectedMode();
		});
		this.selectedMaster = ko.computed(function() {
			return self.masterModel.selectedMaster();
		});		
		
		this.isEmptyModeUse = ko.computed(function() {
			return !self.masterModel.isSelectedMode();
		});	
	}
	
	takeMasterMode() {
		var self = this;
		self.masterModel.viewMasters();
	}
};

