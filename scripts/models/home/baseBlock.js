"use strict";

var BaseBlock = class {
    constructor() {
		this.selectedItem = ko.observable();
		this.isSelectedMode = ko.observable(false);
	}
	
	selectItem(item){
		var self = this;
		self.selectedItem(item);
		self.changeMode();
	}
	
	changeMode() {
		var self = this;
		self.isSelectedMode(!self.isSelectedMode());
	}
	
	clearSelectedItem(){
		var self = this;
		self.selectedItem(null);
	}
};

