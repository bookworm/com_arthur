<?php

use arthur\storage\Cache;
use arthur\core\Libraries;
use arthur\core\Environment;
use arthur\action\Dispatcher;
use arthur\storage\cache\adapter\Apc;

if(PHP_SAPI === 'cli') return;

$cachePath = Libraries::get(true, 'resources') . '/tmp/cache';

if(!($apcEnabled = Apc::enabled()) && !is_writable($cachePath))
	return;

$default = array('adapter' => 'File', 'strategies' => array('Serializer'));

if($apcEnabled) 
	$default = array('adapter' => 'Apc');
Cache::config(compact('default'));

Dispatcher::applyFilter('run', function($self, $params, $chain) 
{
	if(!Environment::get('production'))
		return $chain->next($self, $params, $chain);
	$key = md5(ARTHUR_APP_PATH) . '.core.libraries';

	if($cache = Cache::read('default', $key)) {
		$cache = (array) $cache + Libraries::cache();
		Libraries::cache($cache);
	}
	$result = $chain->next($self, $params, $chain);

	if($cache != Libraries::cache())
		Cache::write('default', $key, Libraries::cache(), '+1 day');

	return $result;
});