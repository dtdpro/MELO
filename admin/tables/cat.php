<?php
defined('_JEXEC') or die('Restricted access');


class TableCat extends JTable
{
	var $cat_id = null;
	var $cat_name = null;
	
	function TableCat(& $db) {
		parent::__construct('#__mlinks_cats', 'cat_id', $db);
	}
}
?>
