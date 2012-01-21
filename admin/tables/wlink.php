<?php


// No direct access
defined('_JEXEC') or die('Restricted access');

// import Joomla table library
jimport('joomla.database.table');

class MELOTableWLink extends JTable
{
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function __construct(&$db) 
	{
		parent::__construct('#__melo_links', 'link_id', $db);
	}
	
	/**
	 * Overloaded bind function
	 *
	 * @param	array		Named array
	 * @return	null|string	null is operation was satisfactory, otherwise returns an error
	 * @since	1.6
	 */
	public function bind($array, $ignore = '')
	{

		return parent::bind($array, $ignore);
	}

	/**
	 * Stores a contact
	 *
	 * @param	boolean	True to update fields even if they are null.
	 * @return	boolean	True on success, false on failure.
	 * @since	1.6
	 */
	public function store($updateNulls = false)
	{
		// Verify that the alias is unique
		$table = JTable::getInstance('WLink', 'MELOTable');
		if ($table->load(array('link_alias'=>$this->link_alias, 'link_cat'=>$this->link_cat)) && ($table->link_id != $this->link_id || $this->link_id==0)) {
			$this->setError(JText::_('COM_MELO_ERROR_UNIQUE_ALIAS'));
			return false;
		}

		// Attempt to store the data.
		return parent::store($updateNulls);
	}

	/**
	 * Overloaded check function
	 *
	 * @return boolean
	 * @see JTable::check
	 * @since 1.5
	 */
	function check()
	{
		if (JFilterInput::checkAttribute(array ('href', $this->link_url))) {
			$this->setError(JText::_('COM_MELO_WARNING_PROVIDE_VALID_URL'));
			return false;
		}

		/** check for valid name */
		if (trim($this->link_name) == '') {
			$this->setError(JText::_('COM_MELO_WARNING_PROVIDE_VALID_NAME'));
			return false;
		}
		
		/** check for existing name */
		$query = 'SELECT link_id FROM #__melo_links WHERE link_name = '.$this->_db->Quote($this->link_name).' AND link_cat = '.(int) $this->link_cat;
		$this->_db->setQuery($query);

		$xid = intval($this->_db->loadResult());
		if ($xid && $xid != intval($this->link_id)) {
			$this->setError(JText::_('COM_MELO_WARNING_SAME_NAME'));
			return false;
		}

		if (empty($this->link_alias)) {
			$this->link_alias = $this->link_name;
		}
		$this->link_alias = JApplication::stringURLSafe($this->link_alias);
		if (trim(str_replace('-', '', $this->link_alias)) == '') {
			$this->link_alias = JFactory::getDate()->format("Y-m-d-H-i-s");
		}
		/** check for valid category */
		if (trim($this->link_cat) == '') {
			$this->setError(JText::_('COM_MELO_WARNING_CATEGORY'));
			return false;
		}

		return true;
	}
}