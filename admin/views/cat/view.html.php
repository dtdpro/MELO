<?php
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

class MLinksViewCat extends JView
{
	function display($tpl = null)
	{
		//get the hello
		$data		=& $this->get('Data');
		$isNew		= ($data->cat_id < 1);
		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
		JToolBarHelper::title(   JText::_( 'MLinks - Category' ).': <small><small>[ ' . $text.' ]</small></small>' );
		JToolBarHelper::save();
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

		$this->assignRef('data',$data);
		parent::display($tpl);
	}
}
