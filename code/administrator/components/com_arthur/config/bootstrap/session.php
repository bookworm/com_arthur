<?php

use arthur\storage\Session;

Session::config(array(
	// 'cookie' => array('adapter' => 'Cookie'),
	'default' => array('adapter' => 'Php')
));

// use arthur\security\Auth;

// Auth::config(array(
// 	'default' => array(
// 		'adapter' => 'Form',
// 		'model' => 'Users',
// 		'fields' => array('username', 'password')
// 	)
// ));