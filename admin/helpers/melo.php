<?php

// No direct access to this file
defined('_JEXEC') or die;

abstract class MELOHelper
{	
	public static function addSubmenu($vName = 'weblinks')
	{
		JHtmlSidebar::addEntry(JText::_('COM_MELO_SUBMENU_WLINKS'),'index.php?option=com_melo&view=wlinks',$vName == 'wlinks');
		JHtmlSidebar::addEntry(JText::_('COM_MELO_SUBMENU_CATEGORIES'),'index.php?option=com_categories&extension=com_melo',$vName == 'categories');
		
		if ($vName == 'categories')
		{
			JToolbarHelper::title(JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_melo')),'melo-categories');
		}
	}
	
	public static function getActions($categoryId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;
	
		if (empty($categoryId))
		{
			$assetName = 'com_melo';
			$level = 'component';
		}
		else
		{
			$assetName = 'com_melo.category.'.(int) $categoryId;
			$level = 'category';
		}
	
		$actions = JAccess::getActions('com_melo', $level);
	
		foreach ($actions as $action)
		{
			$result->set($action->name,	$user->authorise($action->name, $assetName));
		}
	
		return $result;
	}
	
}
