<?php

use arthur\console\Dispatcher;

Dispatcher::applyFilter('_call', function($self, $params, $chain) 
{
	$params['callable']->response->styles(array(
		'heading' => '\033[1;30;46m'
	)); 
	
	return $chain->next($self, $params, $chain);
});