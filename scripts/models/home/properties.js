"use strict";

var PropertyModel = class {
    constructor(name) {
        var self = this;
		this.name = name;
		this.masterModel = new MastersModel();
	}
	
	test() {

		$.post("/home/test", { id: 1232})
		.done(function(data) {
			console.log(data);
		});
	}
};

