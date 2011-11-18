<?php

if(!defined('ARTHUR')) 
{ 
	JError::raiseWarning(0, JText::_("Arthur wasn't found. Please install the Arthur plugin and enable it.")); 
  return; 
} 
else {
  require 'config' . DS . 'bootstrap.php'; 
  echo arthur\action\Dispatcher::run(new arthur\action\JRequest());
}

