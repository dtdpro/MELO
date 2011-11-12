<?php
defined('_JEXEC') or die();

jimport('joomla.application.component.model');

class MLinksModelCat extends JModel
{
	function __construct()
	{
		parent::__construct();

		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
	}

	function setId($id)
	{
		$this->_id		= $id;
		$this->_data	= null;
	}
	
	function &getData()
	{
		if (empty( $this->_data )) {
			$query = ' SELECT * FROM #__mlinks_cats '.
					'  WHERE cat_id = '.$this->_id;
			$this->_db->setQuery( $query );
			$this->_data = $this->_db->loadObject();
		}
		if (!$this->_data) {
			$this->_data = new stdClass();
			$this->_data->cat_id = 0;
			$this->_data->cat_name = '';
			
		}
		return $this->_data;
	}

	function store()
	{
		$row =& $this->getTable();

		$data->cat_id = JRequest::getVar('cat_id');
		$data->cat_name = JRequest::getVar('cat_name');

		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		if (!$row->store()) {
			$this->setError( $row->getErrorMsg() );
			return false;
		}

		return true;
	}

	function delete()
	{
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );

		$row =& $this->getTable();

		if (count( $cids ))
		{
			foreach($cids as $cid) {
				if (!$row->delete( $cid )) {
					$this->setError( $row->getErrorMsg() );
					return false;
				}
			}						
		}
		return true;
	}
			

}
?>
