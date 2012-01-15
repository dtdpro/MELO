<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import the Joomla modellist library
jimport('joomla.application.component.modellist');


class MELOModelWLinks extends JModelList
{
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'link_name', 'l.link_name',
				'ordering', 'l.ordering',
			);
		}
		parent::__construct($config);
	}
	
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$courseId = $this->getUserStateFromRequest($this->context.'.filter.cat', 'filter_cat',"");
		$this->setState('filter.cat', $courseId);

		$published = $this->getUserStateFromRequest($this->context.'.filter.published', 'filter_published', '', 'string');
		$this->setState('filter.published', $published);
		
		// Load the parameters.
		$params = JComponentHelper::getParams('com_melo');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('l.ordering', 'asc');
	}
	
	protected function getListQuery() 
	{
		// Create a new query object.
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);

		// Select some fields
		$query->select('l.*');
		$query->select('c.title AS category_name');


		// From the hello table
		$query->from('#__melo_links as l');
		// Join over the categories.
		$query->join('LEFT', '#__categories AS c ON c.id = l.link_cat');
		
		// Filter by published state
		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where('l.published = '.(int) $published);
		} else if ($published === '') {
			$query->where('(l.published IN (0, 1))');
		}

		// Filter by a single or group of categories.
		$baselevel = 1;
		$categoryId = $this->getState('filter.cat');
		if (is_numeric($categoryId)) {
			$cat_tbl = JTable::getInstance('Category', 'JTable');
			$cat_tbl->load($categoryId);
			$rgt = $cat_tbl->rgt;
			$lft = $cat_tbl->lft;
			$baselevel = (int) $cat_tbl->level;
			$query->where('c.lft >= '.(int) $lft);
			$query->where('c.rgt <= '.(int) $rgt);
		}
		elseif (is_array($categoryId)) {
			JArrayHelper::toInteger($categoryId);
			$categoryId = implode(',', $categoryId);
			$query->where('l.link_cat IN ('.$categoryId.')');
		}
				
		$orderCol	= $this->state->get('list.ordering');
		$orderDirn	= $this->state->get('list.direction');
		
		if ($orderCol == 'l.ordering') {
			$orderCol = 'category_name '.$orderDirn.', l.ordering';
		}
		
		$query->order($db->getEscaped($orderCol.' '.$orderDirn));
				
		return $query;
	}
}
