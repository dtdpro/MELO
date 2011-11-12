<?php
defined('_JEXEC') or die();

class MLinksControllerSCat extends MLinksController
{
	function __construct()
	{
		parent::__construct();

		$this->registerTask( 'add'  , 	'edit' );
	}

	function edit()
	{
		JRequest::setVar( 'view', 'scat' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}

	function save()
	{
		$model = $this->getModel('scat');

		if ($model->store($post)) {
			$msg = JText::_( 'SubCat Saved!' );
		} else {
			$msg = JText::_( 'Error Saving SubCat' );
		}

		$link = 'index.php?option=com_mlinks&view=scats';
		$this->setRedirect($link, $msg);
	}

	function remove()
	{
		$model = $this->getModel('scat');
		if(!$model->delete()) {
			$msg = JText::_( 'Error: One or More SubCats Could not be Deleted' );
		} else {
			$msg = JText::_( 'SubCat(s) Deleted' );
		}

		$this->setRedirect( 'index.php?option=com_mlinks&view=scats', $msg );
	}

	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_mlinks&view=scats', $msg );
	}
}
?>
