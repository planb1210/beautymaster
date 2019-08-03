<?php
return array(
	'news/([0-9]+)' => 'news/view/$1',
	'news' => 'news/index', 
	'admin' => 'admin/index',
	'users/([0-9]+)' => 'users/edit/$1',
	'users/GetUsers' => 'users/GetUsers',
	'users/deleteUser' => 'users/Edit',
	'users/addUser' => 'users/Edit',
	'users' => 'users/index',
    'authorize' => 'authorize/index',
	'home/GetMasters' => 'home/GetMasters',
	'home' => 'home/index'	);
