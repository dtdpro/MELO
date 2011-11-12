<?php
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

class MLinksViewSCat extends JView
{
	function display($tpl = null)
	{
		//get the hello
		$data		=& $this->get('Data');
		$isNew		= ($data->sc_id < 1);
		$model = $this->getModel('scat');
		$cats = $model->getCats();
		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
		JToolBarHelper::title(   JText::_( 'MLinks - SubCat' ).': <small><small>[ ' . $text.' ]</small></small>' );
		JToolBarHelper::save();
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

		$this->assignRef('cats',$cats);
		$this->assignRef('data',$data);
		parent::display($tpl);
	}
}
