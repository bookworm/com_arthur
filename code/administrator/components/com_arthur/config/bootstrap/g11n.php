<?php

use arthur\core\Libraries;
use arthur\core\Environment;
use arthur\g11n\Locale;
use arthur\g11n\Catalog;
use arthur\g11n\Message;
use arthur\util\Inflector;
use arthur\util\Validator;
use arthur\net\http\Media;
use arthur\action\Dispatcher as ActionDispatcher;
use arthur\console\Dispatcher as ConsoleDispatcher;

date_default_timezone_set('UTC');

$locale = 'en';
$locales = array('en' => 'English');

Environment::set('production', compact('locale', 'locales'));
Environment::set('development', compact('locale', 'locales'));
Environment::set('test', array('locale' => 'en', 'locales' => array('en' => 'English')));

Catalog::config(array(
	'runtime' => array(
		'adapter' => 'Memory'
	),
	// 'app' => array(
	// 	'adapter' => 'Gettext',
	// 	'path' => Libraries::get(true, 'resources') . '/g11n'
	// ),
	'arthur' => array(
		'adapter' => 'Php',
		'path' => ARTHUR_LIBRARY_PATH . '/arthur/g11n/resources/php'
	)
) + Catalog::config());

// Inflector::rules('transliteration', Catalog::read(true, 'inflection.transliteration', 'en'));

// Inflector::rules('singular', array('rules' => array('/rata/' => '\1ratus')));
// Inflector::rules('singular', array('irregular' => array('foo' => 'bar')));
//
// Inflector::rules('plural', array('rules' => array('/rata/' => '\1ratum')));
// Inflector::rules('plural', array('irregular' => array('bar' => 'foo')));
//
// Inflector::rules('transliteration', array('/É|Ê/' => 'E'));
//
// Inflector::rules('uninflected', 'bord');
// Inflector::rules('uninflected', array('bord', 'baird'));

Media::applyFilter('_handle', function($self, $params, $chain) 
{
	$params['handler'] += array('outputFilters' => array());
	$params['handler']['outputFilters'] += Message::aliases();
	return $chain->next($self, $params, $chain);
});

foreach(array('phone', 'postalCode', 'ssn') as $name) {
	Validator::add($name, Catalog::read(true, "validation.{$name}", 'en_US'));
}

$setLocale = function($self, $params, $chain) 
{
	if(!$params['request']->locale())
		$params['request']->locale(Locale::preferred($params['request']));

	Environment::set(true, array('locale' => $params['request']->locale()));

	return $chain->next($self, $params, $chain);
};
ActionDispatcher::applyFilter('_callable', $setLocale);
ConsoleDispatcher::applyFilter('_callable', $setLocale);