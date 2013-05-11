<?php
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

class MELOViewMELO extends JViewLegacy
{
	function display($tpl = null)
	{
		MELOHelper::addSubmenu();
		JToolBarHelper::title(   JText::_( 'MELO External Link Organizer' ), 'melo' );
		JToolBarHelper::preferences('com_melo');
		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}
}
