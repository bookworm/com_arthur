<?php

namespace app\controllers;

class PagesController extends \arthur\action\Controller 
{
	public function view() 
	{
		$path = func_get_args() ?: array('home');
		return $this->render(array('template' => join('/', $path)));
	}
}