<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');


class MELOControllerWLinks extends JControllerAdmin
{

	protected $text_prefix = "COM_MELO_WLINK";
	
	public function getModel($name = 'WLink', $prefix = 'MELOModel') 
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}