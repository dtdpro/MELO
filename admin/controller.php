<?php


jimport('joomla.application.component.controller');


class MELOController extends JControllerLegacy
{	
	public function display($cachable = false, $urlparams = false)
	{
		require_once JPATH_COMPONENT.'/helpers/melo.php';
	
		$view   = $this->input->get('view', 'wlinks');
		$layout = $this->input->get('layout', 'default');
		$id     = $this->input->getInt('link_id');
	
		// Check for edit form.
		if ($view == 'wlink' && $layout == 'edit' && !$this->checkEditId('com_melo.edit.wlink', $id))
		{
			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_melo&view=wlinks', false));
	
			return false;
		}
	
		parent::display();
	
		return $this;
	}
}

