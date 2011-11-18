<?php

define('ARTHUR_APP_PATH', dirname(dirname(__DIR__)));
if(!defined('ARTHUR_LIBRARY_PATH')) define('ARTHUR_LIBRARY_PATH', JPATH_SITE . DS . 'libraries');

if(!include ARTHUR_LIBRARY_PATH . '/arthur/core/Libraries.php') 
{
	$message  = "Arthur core could not be found.  Check the value of ARTHUR_LIBRARY_PATH in ";
	$message .= __FILE__ . ".  It should point to the directory containing your ";
	$message .= "/libraries directory.";
	throw new ErrorException($message);
}

use arthur\core\Libraries;     

require ARTHUR_LIBRARY_PATH . '/arthur/core/Object.php';
require ARTHUR_LIBRARY_PATH . '/arthur/core/StaticObject.php';
require ARTHUR_LIBRARY_PATH . '/arthur/util/Collection.php';
require ARTHUR_LIBRARY_PATH . '/arthur/util/collection/Filters.php';
require ARTHUR_LIBRARY_PATH . '/arthur/util/Inflector.php';
require ARTHUR_LIBRARY_PATH . '/arthur/util/String.php';
require ARTHUR_LIBRARY_PATH . '/arthur/core/Adaptable.php';
require ARTHUR_LIBRARY_PATH . '/arthur/core/Environment.php';
require ARTHUR_LIBRARY_PATH . '/arthur/net/Message.php';
require ARTHUR_LIBRARY_PATH . '/arthur/net/http/Message.php';
require ARTHUR_LIBRARY_PATH . '/arthur/net/http/Media.php';
require ARTHUR_LIBRARY_PATH . '/arthur/net/http/Request.php';   
# require ARTHUR_LIBRARY_PATH . '/arthur/net/http/JRequest.php';
require ARTHUR_LIBRARY_PATH . '/arthur/net/http/Response.php';
require ARTHUR_LIBRARY_PATH . '/arthur/net/http/Route.php';
require ARTHUR_LIBRARY_PATH . '/arthur/net/http/Router.php';
require ARTHUR_LIBRARY_PATH . '/arthur/action/Controller.php';
require ARTHUR_LIBRARY_PATH . '/arthur/action/Dispatcher.php';
require ARTHUR_LIBRARY_PATH . '/arthur/action/Request.php';
require ARTHUR_LIBRARY_PATH . '/arthur/action/Response.php';
require ARTHUR_LIBRARY_PATH . '/arthur/template/View.php';
require ARTHUR_LIBRARY_PATH . '/arthur/template/view/Renderer.php';
require ARTHUR_LIBRARY_PATH . '/arthur/template/view/Compiler.php';
require ARTHUR_LIBRARY_PATH . '/arthur/template/view/adapter/File.php';
require ARTHUR_LIBRARY_PATH . '/arthur/storage/Cache.php';
require ARTHUR_LIBRARY_PATH . '/arthur/storage/cache/adapter/Apc.php';

Libraries::add('arthur');
Libraries::add('app', array('default' => true));