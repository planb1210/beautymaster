"use strict";

var BookingModel = class {
    constructor(master, skill, fullTime) {
        var self = this;
		this.master = ko.observable(master);
		this.skill = ko.observable(skill);
		this.fullTime = ko.observable(fullTime);
		console.log(self);
	}
};