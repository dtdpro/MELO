<?php


jimport('joomla.application.component.controller');


class MELOController extends JController
{
	protected $default_view = 'links';
	
	function display()
	{
		// Set the submenu
		parent::display();
		MELOHelper::addSubmenu(JRequest::getVar('view'));
	}
}
?>
