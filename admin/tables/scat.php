<?php
defined('_JEXEC') or die('Restricted access');


class TableSCat extends JTable
{
	var $sc_id = null;
	var $sc_name = null;
	var $lcol = null;
	var $catid = null;
	
	function TableSCat(& $db) {
		parent::__construct('#__mlinks_subcats', 'sc_id', $db);
	}
}
?>
