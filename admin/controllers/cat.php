<?php
defined('_JEXEC') or die();

class MLinksControllerCat extends MLinksController
{
	function __construct()
	{
		parent::__construct();

		$this->registerTask( 'add'  , 	'edit' );
	}

	function edit()
	{
		JRequest::setVar( 'view', 'cat' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}

	function save()
	{
		$model = $this->getModel('cat');

		if ($model->store($post)) {
			$msg = JText::_( 'Category Saved!' );
		} else {
			$msg = JText::_( 'Error Saving Category' );
		}

		$link = 'index.php?option=com_mlinks&view=cats';
		$this->setRedirect($link, $msg);
	}

	function remove()
	{
		$model = $this->getModel('cat');
		if(!$model->delete()) {
			$msg = JText::_( 'Error: One or More Categories Could not be Deleted' );
		} else {
			$msg = JText::_( 'Category(s) Deleted' );
		}

		$this->setRedirect( 'index.php?option=com_mlinks&view=cats', $msg );
	}

	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_mlinks&view=cats', $msg );
	}
}
?>
