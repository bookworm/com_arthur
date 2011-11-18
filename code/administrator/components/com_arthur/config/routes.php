<?php

use arthur\net\http\Router;
use arthur\core\Environment;

Router::connect('/', 'Pages::view');
Router::connect('/pages/{:args}', 'Pages::view');

if(!Environment::is('production')) {
	Router::connect('/test/{:args}', array('controller' => 'arthur\test\Controller'));
	Router::connect('/test', array('controller' => 'arthur\test\Controller'));
}

// Router::connect('/{:controller}/{:action}/{:id:\d+}.{:type}', array('id' => null));
// Router::connect('/{:controller}/{:action}/{:id:\d+}');

// Router::connect('/{:controller}/{:action}/{:id:[0-9a-f]{24}}.{:type}', array('id' => null));
// Router::connect('/{:controller}/{:action}/{:id:[0-9a-f]{24}}');

Router::connect('/{:controller}/{:action}/{:args}');