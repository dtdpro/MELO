<?php
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

class MLinksModelCats extends JModel
{
	var $_data;


	function _buildQuery()
	{
		$q  = 'SELECT * FROM #__mlinks_cats ';
		$q .= 'ORDER BY cat_name ASC';

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
