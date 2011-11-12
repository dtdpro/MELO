<?php
defined('_JEXEC') or die();

jimport('joomla.application.component.model');

class MLinksModelSCat extends JModel
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
			$query = ' SELECT * FROM #__mlinks_subcats '.
					'  WHERE sc_id = '.$this->_id;
			$this->_db->setQuery( $query );
			$this->_data = $this->_db->loadObject();
		}
		if (!$this->_data) {
			$this->_data = new stdClass();
			$this->_data->sc_id = 0;
			$this->_data->sc_name = '';
			$this->_data->lcol = 0;
			$this->_data->catid = 0;
						
		}
		return $this->_data;
	}
	
	function getCats() {
		$db =& JFactory::getDBO();
		$q  = 'SELECT * FROM #__mlinks_cats ';
		$q .= 'ORDER BY cat_name';
		$db->setQuery( $q );
		return $db->loadObjectList();
	}
	function store()
	{
		$row =& $this->getTable();

		$data->sc_id = JRequest::getVar('sc_id');
		$data->sc_name = JRequest::getVar('sc_name');
		$data->lcol = JRequest::getVar('lcol');
		$data->catid = JRequest::getVar('catid');

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
