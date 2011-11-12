<?php
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

class MLinksViewCats extends JView
{
	function display($tpl = null)
	{
		JToolBarHelper::title(   JText::_( 'MLinks - Category Manager' ), 'generic.png' );
		JToolBarHelper::deleteList();
		JToolBarHelper::editListX();
		JToolBarHelper::addNewX();

		$items		= & $this->get( 'Data');

		$this->assignRef('items',		$items);

		parent::display($tpl);
	}
}
