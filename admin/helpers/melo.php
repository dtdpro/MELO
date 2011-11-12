<?php

// No direct access to this file
defined('_JEXEC') or die;

abstract class MELOHelper
{
	public static function addSubmenu($submenu) 
	{
		JSubMenuHelper::addEntry(JText::_('COM_MELO_SUBMENU_LINKS'), 'index.php?option=com_continued&view=melos', $submenu == 'melos');
		JSubMenuHelper::addEntry(JText::_('COM_MELO_SUBMENU_CATS'), 'index.php?option=com_continued&view=cats', $submenu == 'cats');
		JSubMenuHelper::addEntry(JText::_('COM_MELO_SUBMENU_SCATS'), 'index.php?option=com_continued&view=scats', $submenu == 'scats');
	}
	
}
