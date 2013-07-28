<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelform library
jimport('joomla.application.component.modeladmin');

class MELOModelWlink extends JModelAdmin
{
	protected $text_prefix = 'COM_MELO_WLINK';
	
	protected function canDelete($record)
	{
		if (!empty($record->link_id))
		{
			if ($record->state != -2)
			{
				return;
			}
			$user = JFactory::getUser();
	
			if ($record->link_cat)
			{
				return $user->authorise('core.delete', 'com_melo.category.'.(int) $record->link_cat);
			}
			else
			{
				return parent::canDelete($record);
			}
		}
	}
	
	protected function canEditState($record)
	{
		$user = JFactory::getUser();
	
		if (!empty($record->link_cat))
		{
			return $user->authorise('core.edit.state', 'com_melo.category.'.(int) $record->link_cat);
		}
		else
		{
			return parent::canEditState($record);
		}
	}
	
	public function getTable($type = 'WLink', $prefix = 'MELOTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true)
	{
		$app = JFactory::getApplication();
	
		// Get the form.
		$form = $this->loadForm('com_melo.wlink', 'wlink', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
		{
			return false;
		}
	
		// Determine correct permissions to check.
		if ($this->getState('wlink.link_id'))
		{
			// Existing record. Can only edit in selected categories.
			$form->setFieldAttribute('link_cat', 'action', 'core.edit');
		}
		else
		{
			// New record. Can only create in selected categories.
			$form->setFieldAttribute('link_cat', 'action', 'core.create');
		}
	
		// Modify the form based on access controls.
		if (!$this->canEditState((object) $data))
		{
			// Disable fields for display.
			$form->setFieldAttribute('ordering', 'disabled', 'true');
			$form->setFieldAttribute('state', 'disabled', 'true');
			$form->setFieldAttribute('publish_up', 'disabled', 'true');
			$form->setFieldAttribute('publish_down', 'disabled', 'true');
	
			// Disable fields while saving.
			// The controller has already verified this is a record you can edit.
			$form->setFieldAttribute('ordering', 'filter', 'unset');
			$form->setFieldAttribute('state', 'filter', 'unset');
			$form->setFieldAttribute('publish_up', 'filter', 'unset');
			$form->setFieldAttribute('publish_down', 'filter', 'unset');
		}
	
		return $form;
	}
	
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_melo.edit.wlink.data', array());
	
		if (empty($data))
		{
			$data = $this->getItem();
	
			// Prime some default values.
			if ($this->getState('wlink.link_id') == 0)
			{
				$app = JFactory::getApplication();
				$data->set('link_cat', $app->input->get('link_cat', $app->getUserState('com_melo.wlinks.filter.category_id'), 'int'));
			}
		}
	
		$this->preprocessData('com_melo.wlink', $data);
	
		return $data;
	}
	
	protected function prepareTable($table)
	{
		$date = JFactory::getDate();
		$user = JFactory::getUser();
	
		$table->link_name		= htmlspecialchars_decode($table->link_name, ENT_QUOTES);
		$table->link_alias		= JApplication::stringURLSafe($table->link_alias);
	
		if (empty($table->link_alias))
		{
			$table->link_alias = JApplication::stringURLSafe($table->link_name);
		}
	
		if (empty($table->link_id))
		{
			// Set the values
	
			// Set ordering to the last item if not set
			if (empty($table->ordering))
			{
				$db = JFactory::getDbo();
				$db->setQuery('SELECT MAX(ordering) FROM #__melo_links');
				$max = $db->loadResult();
	
				$table->ordering = $max + 1;
			}
			else
			{
				// Set the values
				$table->modified	= $date->toSql();
				$table->modified_by	= $user->get('id');
			}
		}
	}

	protected function getReorderConditions($table)
	{
		$condition = array();
		$condition[] = 'link_cat = '.(int) $table->link_cat;
		return $condition;
	}
	
	public function save($data)
	{
		$app = JFactory::getApplication();
	
		// Alter the title for save as copy
		if ($app->input->get('task') == 'save2copy')
		{
			list($name, $alias) = $this->generateNewTitle($data['link_cat'], $data['link_alias'], $data['link_name']);
			$data['link_name']	= $name;
			$data['link_alias']	= $alias;
			$data['state']	= 0;
		}
		$return = parent::save($data);
	
		return $return;
	}
	
	protected function generateNewTitle($category_id, $alias, $name)
	{
		// Alter the title & alias
		$table = $this->getTable();
	
		while ($table->load(array('link_alias' => $alias, 'link_cat' => $category_id)))
		{
			if ($name == $table->link_name)
			{
				$name = JString::increment($name);
			}
			$alias = JString::increment($alias, 'dash');
		}
	
		return array($name, $alias);
	}
}
