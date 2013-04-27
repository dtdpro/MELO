<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

class MELOViewWLink extends JViewLegacy
{
	
	protected $form;
	protected $item;

	/**
	 * display method of view
	 * @return void
	 */
	public function display($tpl = null) 
	{
		// get the Data
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');
		$script = $this->get('Script');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) 
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign the Data
		$this->script = $script;

		// Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}

	/**
	 * Setting the toolbar
	 */
	protected function addToolBar() 
	{
		JRequest::setVar('hidemainmenu', true);
		$user = JFactory::getUser();
		$userId = $user->id;
		$isNew = $this->item->link_id == 0;
		JToolBarHelper::title($isNew ? JText::_('COM_MELO_MANAGER_WLINK_NEW') : JText::_('COM_MELO_MANAGER_WLINK_EDIT'), 'melo');
		// Built the actions for new and existing records.
		if ($isNew) 
		{
			// For new records, check the create permission.
			JToolBarHelper::apply('wlink.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('wlink.save', 'JTOOLBAR_SAVE');
			JToolBarHelper::custom('wlink.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
			JToolBarHelper::cancel('wlink.cancel', 'JTOOLBAR_CANCEL');
		}
		else
		{
			JToolBarHelper::apply('wlink.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('wlink.save', 'JTOOLBAR_SAVE');
			JToolBarHelper::custom('wlink.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
			JToolBarHelper::custom('wlink.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
			JToolBarHelper::cancel('wlink.cancel', 'JTOOLBAR_CLOSE');
		}
	}
	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
		$isNew = $this->item->link_id == 0;
		$document = JFactory::getDocument();
		$document->setTitle($isNew ? JText::_('COM_MELO_MANAGER_WLINK_NEW') : JText::_('COM_MELO_MANAGER_WLINK_EDIT'));
		JText::script('COM_MELO_WLINK_ERROR_UNACCEPTABLE');
	}
}
