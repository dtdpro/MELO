<?php

// No direct access to this file
defined('_JEXEC') or die;

abstract class MELOHelper
{
	public static function addSubmenu($submenu) 
	{
		JSubMenuHelper::addEntry(JText::_('COM_MELO_SUBMENU_WLINKS'), 'index.php?option=com_melo&view=wlinks', $submenu == 'wlinks');
		JSubMenuHelper::addEntry(JText::_('COM_MELO_SUBMENU_CATEGORIES'),'index.php?option=com_categories&extension=com_melo',$submenu == 'categories');
		
		if ($submenu=='categories') {
			JToolBarHelper::title(JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_melo')),'melo-categories');
		}
	}
	
}
