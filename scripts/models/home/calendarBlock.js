"use strict";

infuser.defaults.templateUrl = "/views/home/templates/";

class CalendarBlock extends BaseBlock {	
    constructor() {
		super();		
		//this.masters = ko.observableArray([]);
		//this.getMastersUrl = "/home/GetMasters";
		//this.template = "mastersBlock";
		
		/*
		var firstDay = Kalendae.moment().startOf('month').weekday(2),
			secondDay = Kalendae.moment().startOf('month').weekday(4),
			endMonth = Kalendae.moment().endOf('month');
		var selected = [];

		while(firstDay <= endMonth) {
			if (firstDay >= Kalendae.moment().startOf('month')) {
				selected.push(firstDay.clone());
				selected.push(secondDay.clone());
			}
			firstDay.add(7, 'd');
			secondDay.add(7, 'd');
		}

		new Kalendae({
			attachTo:document.body,
			months:3,
			mode:'multiple',
			dayHeaderClickable: true,
			selected: selected
		});
		/**/		
	}
	
	viewCalendar(skill, master) {
		var self = this;
		self.isSelectedMode(!self.isSelectedMode());

		$("#cal").html("");
		/*var classMap = [];
		classMap[ Kalendae.moment().add({d:5}).format('YYYY-MM-DD') ] = 'closed';

		//document.getElementById("cal")
		new Kalendae("cal", {
			dateClassMap: classMap
		});/**/

		var firstDay = Kalendae.moment().startOf('month').weekday(2),
			secondDay = Kalendae.moment().startOf('month').weekday(4),
			endMonth = Kalendae.moment().endOf('month');
		var selected = [];

		/*while(firstDay <= endMonth) {
			if (firstDay >= Kalendae.moment().startOf('month')) {
				selected.push(firstDay.clone());
				selected.push(secondDay.clone());
			}
			firstDay.add(7, 'd');
			secondDay.add(7, 'd');
		}/**/
		selected.push(Kalendae.moment("2011-10-31", "YYYY-MM-DD"));
		
		var blocked = [];
		blocked.push(Kalendae.moment("20111030", "YYYYMMDD"));
		
		console.log(selected);
		new Kalendae({
			attachTo:"cal",
			months:1,
			mode:'multiple',
			dayHeaderClickable: true,			
			selected: selected,
			blackout: blocked
		});
	}
};

