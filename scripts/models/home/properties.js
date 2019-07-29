"use strict";

var PropertyModel = class {
    constructor(name) {
        var self = this;
		this.name = name;
		console.log(this.name);
	}
	
	test() {

		$.post("/home/test", { id: 1232})
		.done(function(data) {
			console.log(data);
		});
	}
};

