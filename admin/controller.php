<?php


jimport('joomla.application.component.controller');


class MELOController extends JController
{
	protected $default_view = 'wlinks';
	
	function display()
	{
		require_once JPATH_COMPONENT.'/helpers/melo.php';
		// Set the submenu
		MELOHelper::addSubmenu(JRequest::getVar('view'));
		parent::display();
		return $this;
	}
}

