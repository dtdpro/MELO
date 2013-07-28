<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

class MELOViewWlink extends JViewLegacy
{
	
	protected $state;

	protected $item;

	protected $form;

	public function display($tpl = null)
	{
		$this->state	= $this->get('State');
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$isNew		= ($this->item->link_id == 0);
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		// Since we don't track these assets at the item level, use the category id.
		$canDo		= MELOHelper::getActions($this->item->link_cat, 0);

		JToolbarHelper::title(JText::_('COM_MELO_MANAGER_WLINK'), 'wlinks');

		// If not checked out, can save the item.
		if (!$checkedOut && ($canDo->get('core.edit')||(count($user->getAuthorisedCategories('com_melo', 'core.create')))))
		{
			JToolbarHelper::apply('wlink.apply');
			JToolbarHelper::save('wlink.save');
		}
		if (!$checkedOut && (count($user->getAuthorisedCategories('com_melo', 'core.create')))){
			JToolbarHelper::save2new('wlink.save2new');
		}
		// If an existing item, can save to a copy.
		if (!$isNew && (count($user->getAuthorisedCategories('com_melo', 'core.create')) > 0))
		{
			JToolbarHelper::save2copy('wlink.save2copy');
		}
		if (empty($this->item->link_id))
		{
			JToolbarHelper::cancel('wlink.cancel');
		}
		else
		{
			JToolbarHelper::cancel('wlink.cancel', 'JTOOLBAR_CLOSE');
		}

	}
}
