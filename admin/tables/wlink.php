<?php


// No direct access
defined('_JEXEC') or die('Restricted access');

// import Joomla table library
jimport('joomla.database.table');

class MELOTableWlink extends JTable
{
	public function __construct(&$db)
	{
		parent::__construct('#__melo_links', 'link_id', $db);
	}
	
	public function store($updateNulls = false)
	{
		$date	= JFactory::getDate();
		$user	= JFactory::getUser();
		if ($this->link_id)
		{
			// Existing item
			$this->modified		= $date->toSql();
			$this->modified_by	= $user->get('id');
		}
		else
		{
			// New weblink. A weblink created and created_by field can be set by the user,
			// so we don't touch either of these if they are set.
			if (!(int) $this->created)
			{
				$this->created = $date->toSql();
			}
			if (empty($this->created_by))
			{
				$this->created_by = $user->get('id');
			}
		}

		// Set publish_up to null date if not set
		if (!$this->publish_up)
		{
			$this->publish_up = $this->_db->getNullDate();
		}

		// Set publish_down to null date if not set
		if (!$this->publish_down)
		{
			$this->publish_down = $this->_db->getNullDate();
		}

		// Verify that the alias is unique
		$table = JTable::getInstance('WLink', 'MELOTable');

		if ($table->load(array('link_alias' => $this->link_alias, 'link_cat' => $this->link_cat)) && ($table->link_id != $this->link_id || $this->link_id == 0))
		{
			$this->setError(JText::_('COM_MELO_ERROR_UNIQUE_ALIAS'));
			return false;
		}

		$result = parent::store($updateNulls);
		return $result;
	}

	public function check()
	{
		if (JFilterInput::checkAttribute(array ('href', $this->link_url)))
		{
			$this->setError(JText::_('COM_MELO_WARNING_PROVIDE_VALID_URL'));
			return false;
		}

		// check for valid name
		if (trim($this->link_name) == '')
		{
			$this->setError(JText::_('COM_MELO_WARNING_PROVIDE_VALID_NAME'));
			return false;
		}

		// check for existing name
		$query = 'SELECT link_id FROM #__melo_links WHERE link_name = '.$this->_db->quote($this->link_name).' AND link_cat = '.(int) $this->link_cat;
		$this->_db->setQuery($query);

		$xid = (int) $this->_db->loadResult();
		if ($xid && $xid != (int) $this->link_id)
		{
			$this->setError(JText::_('COM_MELO_WARNING_SAME_NAME'));
			return false;
		}

		if (empty($this->link_alias))
		{
			$this->link_alias = $this->link_name;
		}
		$this->link_alias = JApplication::stringURLSafe($this->link_alias);
		if (trim(str_replace('-', '', $this->link_alias)) == '')
		{
			$this->link_alias = JFactory::getDate()->format("Y-m-d-H-i-s");
		}

		// Check the publish down date is not earlier than publish up.
		if ($this->publish_down > $this->_db->getNullDate() && $this->publish_down < $this->publish_up)
		{
			$this->setError(JText::_('JGLOBAL_START_PUBLISH_AFTER_FINISH'));
			return false;
		}

		return true;
	}

	public function publish($pks = null, $state = 1, $userId = 0)
	{
		$k = $this->_tbl_key;

		// Sanitize input.
		JArrayHelper::toInteger($pks);
		$userId = (int) $userId;
		$state  = (int) $state;

		// If there are no primary keys set check to see if the instance key is set.
		if (empty($pks))
		{
			if ($this->$k)
			{
				$pks = array($this->$k);
			}
			// Nothing to set publishing state on, return false.
			else {
				$this->setError(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
				return false;
			}
		}

		// Build the WHERE clause for the primary keys.
		$where = $k.'='.implode(' OR '.$k.'=', $pks);

		// Determine if there is checkin support for the table.
		if (!property_exists($this, 'checked_out') || !property_exists($this, 'checked_out_time'))
		{
			$checkin = '';
		}
		else
		{
			$checkin = ' AND (checked_out = 0 OR checked_out = '.(int) $userId.')';
		}

		// Update the publishing state for rows with the given primary keys.
		$this->_db->setQuery(
			'UPDATE '.$this->_db->quoteName($this->_tbl) .
			' SET '.$this->_db->quoteName('state').' = '.(int) $state .
			' WHERE ('.$where.')' .
			$checkin
		);

		try
		{
			$this->_db->execute();
		}
		catch (RuntimeException $e)
		{
			$this->setError($e->getMessage());
			return false;
		}

		// If checkin is supported and all rows were adjusted, check them in.
		if ($checkin && (count($pks) == $this->_db->getAffectedRows()))
		{
			// Checkin the rows.
			foreach ($pks as $pk)
			{
				$this->checkin($pk);
			}
		}

		// If the JTable instance value is in the list of primary keys that were set, set the instance.
		if (in_array($this->$k, $pks))
		{
			$this->state = $state;
		}

		$this->setError('');
		return true;
	}
	
	public function hit($pk = null)
	{
		// If there is no hits field, just return true.
		if (!property_exists($this, 'link_hits'))
		{
			return true;
		}
	
		$k = $this->_tbl_key;
		$pk = (is_null($pk)) ? $this->$k : $pk;
	
		// If no primary key is given, return false.
		if ($pk === null)
		{
			return false;
		}
	
		// Check the row in by primary key.
		$query = $this->_db->getQuery(true)
		->update($this->_tbl)
		->set($this->_db->quoteName('link_hits') . ' = (' . $this->_db->quoteName('link_hits') . ' + 1)')
		->where($this->_tbl_key . ' = ' . $this->_db->quote($pk));
		$this->_db->setQuery($query);
		$this->_db->execute();
	
		// Set table values in the object.
		$this->hits++;
	
		return true;
	}
}