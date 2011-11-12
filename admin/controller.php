<?php


jimport('joomla.application.component.controller');


class MELOController extends JController
{
	protected $default_view = 'melos';
	
	function display()
	{
		// Set the submenu
		parent::display();
		ContinuEdHelper::addSubmenu(JRequest::getVar('view'));
	}
}
?>
