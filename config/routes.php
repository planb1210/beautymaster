<?php
return array(
	'news/([0-9]+)' => 'news/view/$1',
	'news' => 'news/index', 
	'admin' => 'admin/index',
	'users/([0-9]+)' => 'users/edit/$1',
	'users/GetUsers' => 'users/GetUsers',
	'users/deleteUser' => 'users/Edit',
	'users/addUser' => 'users/Edit',
	'users/editUser' => 'users/Edit',
	'users' => 'users/index',
	'services/GetServices' => 'services/GetServices',
	'services/deleteService' => 'services/Edit',
	'services/addService' => 'services/Edit',
	'services/editService' => 'services/Edit',
	'services' => 'services/index',
    'authorize' => 'authorize/index',
	'home/GetMasters' => 'home/GetMasters',
	'home/GetSkills' => 'home/GetSkills',
	'home/GetSchedule' => 'home/GetSchedule',
	'home/GetClientTimeBooking' => 'home/GetClientTimeBooking',
	'home/GetClient' => 'home/GetClient',
	'home/Booking' => 'home/Booking',
	'home' => 'home/index',
	'profile/([0-9]+)' => 'profile/index/$1',
	'profile/GetUsers' => 'profile/GetUsers',
	'profile/DeleteSkill' => 'profile/Delete',
	'profile/ViewSkillsToAdd' => 'profile/ViewSkillsToAdd',
	'profile/AddSkill' => 'profile/AddSkill',
	'info' => 'info/index',
	'booking/GetRows' => 'booking/GetRows',
	'booking/GetCountRows' => 'booking/GetCountRows',
	'booking/DeleteRowById' => 'booking/DeleteRowById',	
	'booking' => 'booking/index');
