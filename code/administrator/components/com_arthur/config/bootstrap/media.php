<?php

use arthur\util\Collection;

Collection::formats('arthur\net\http\Media');

use arthur\action\Dispatcher;
use arthur\action\Response;
use arthur\net\http\Media;

Dispatcher::applyFilter('_callable', function($self, $params, $chain) 
{
	list($library, $asset) = explode('/', $params['request']->url, 2) + array("", "");

	if($asset && ($path = Media::webroot($library)) && file_exists($file = "{$path}/{$asset}")) 
	{
		return function() use ($file) 
		{
			$info    = pathinfo($file);
			$media   = Media::type($info['extension']);
			$content = (array) $media['content'];

			return new Response(array(
				'headers' => array('Content-type' => reset($content)),
				'body' => file_get_contents($file)
			));
		};
	}     
	
	return $chain->next($self, $params, $chain);
});