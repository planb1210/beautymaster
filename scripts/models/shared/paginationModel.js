"use strict";

var PaginationModel = class {
    constructor() {
		var self = this;

		this.buttons = ko.observableArray([]);
		this.currentPage = ko.observable(1);
		this.pageCount = ko.observable(1);
		this.isPagingBusy = ko.observable(true);
	}
	
	generateButtons(){
		var self = this;
		self.buttons([]);
		
		if(self.pageCount()>1){
			var firstPage = (self.currentPage() > 3) ? self.currentPage()-2 : 1;
			
			if(self.currentPage()>3){
				self.buttons().push(1);
			}
			for (var i = 0; i < 5; i++) {
				if(i+firstPage <= self.pageCount()){
					self.buttons().push(i+firstPage);
				}
			}
			if(self.pageCount()>firstPage+5){
				self.buttons().push(self.pageCount());
			}
		}
	}
}