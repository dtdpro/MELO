<?php
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

class MLinksModelSCats extends JModel
{
	var $_data;


	function _buildQuery()
	{
		$q  = 'SELECT * FROM #__mlinks_subcats as s ';
		$q .= 'LEFT JOIN #__mlinks_cats as c ON c.cat_id = s.catid ';
		$q .= 'ORDER BY c.cat_name, s.sc_name ASC';

		return $q;
	}

	function getData()
	{
		if (empty( $this->_data ))
		{
			$query = $this->_buildQuery();
			$this->_data = $this->_getList( $query );
		}

		return $this->_data;
	}

}
