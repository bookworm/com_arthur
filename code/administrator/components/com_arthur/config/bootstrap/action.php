<?php

use arthur\core\Libraries;
use arthur\net\http\Router;
use arthur\core\Environment;
use arthur\action\Dispatcher;

Dispatcher::applyFilter('run', function($self, $params, $chain) {
	Environment::set($params['request']);

	foreach(array_reverse(Libraries::get()) as $name => $config) 
	{
		if($name === 'arthur')
			continue;

		$file = "{$config['path']}/config/routes.php";
		file_exists($file) ? include $file : null;
	}   
	
	return $chain->next($self, $params, $chain);
});