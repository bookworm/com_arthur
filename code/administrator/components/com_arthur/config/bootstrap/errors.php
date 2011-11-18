<?php

use arthur\core\ErrorHandler;
use arthur\action\Response;
use arthur\net\http\Media;

ErrorHandler::apply('arthur\action\Dispatcher::run', array(), function($info, $params) 
{
	$response = new Response(array(
		'request' => $params['request'],
		'status'  => $info['exception']->getCode()
	));

	Media::render($response, compact('info', 'params'), array(
		'library'    => true,
		'controller' => '_errors',
		'template'   => 'development',
		'layout'     => 'error',
		'request'    => $params['request']
	));    
	
	return $response;
});