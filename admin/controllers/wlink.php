<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controllerform');

class MELOControllerWlink extends JControllerForm
{
	
	protected function allowAdd($data = array())
	{
		$user = JFactory::getUser();
		$categoryId = JArrayHelper::getValue($data, 'link_cat', $this->input->getInt('filter_category_id'), 'int');
		$allow = null;
	
		if ($categoryId)
		{
			// If the category has been passed in the URL check it.
			$allow = $user->authorise('core.create', $this->option . '.category.' . $categoryId);
		}
	
		if ($allow === null)
		{
			// In the absense of better information, revert to the component permissions.
			return parent::allowAdd($data);
		}
		else
		{
			return $allow;
		}
	}
	
	protected function allowEdit($data = array(), $key = 'link_id')
	{
		$recordId = (int) isset($data[$key]) ? $data[$key] : 0;
		$categoryId = 0;
	
		if ($recordId)
		{
			$categoryId = (int) $this->getModel()->getItem($recordId)->link_cat;
		}
	
		if ($categoryId)
		{
			// The category has been set. Check the category permissions.
			return JFactory::getUser()->authorise('core.edit', $this->option . '.category.' . $categoryId);
		}
		else
		{
			// Since there is no asset tracking, revert to the component permissions.
			return parent::allowEdit($data, $key);
		}
	}
	
	public function batch($model = null)
	{
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
	
		// Set the model
		$model = $this->getModel('WLink', '', array());
	
		// Preset the redirect
		$this->setRedirect(JRoute::_('index.php?option=com_melo&view=wlinks' . $this->getRedirectToListAppend(), false));
	
		return parent::batch($model);
	}
	
	protected function postSaveHook(JModelLegacy $model, $validData = array())
	{
		if ($task == 'save')
		{
			$this->setRedirect(JRoute::_('index.php?option=com_melo&view=wlinks', false));
		}
	}
}