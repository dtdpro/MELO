<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import the Joomla modellist library
jimport('joomla.application.component.modellist');


class MELOModelLinks extends JModelList
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
		$query->select('CONCAT(sec.sec_name," - ",cat.cat_name) AS category_name');

		// From the hello table
		$query->from('#__melo_links as l');
		// Join over the categories.
		$query->join('RIGHT', '#__melo_cats AS cat ON cat.cat_id = l.link_cat');
		// Join over the sections.
		$query->join('RIGHT', '#__melo_secs AS sec ON sec.sec_id = cat.cat_sec');
		
		// Filter by published state
		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where('l.published = '.(int) $published);
		} else if ($published === '') {
			$query->where('(l.published IN (0, 1))');
		}

				
		// Filter by course.
		$catId = $this->getState('filter.cat');
		if (is_numeric($catId)) {
			$query->where('l.link_cat = '.(int) $catId);
		}
				
		$orderCol	= $this->state->get('list.ordering');
		$orderDirn	= $this->state->get('list.direction');
		
		if ($orderCol == 'l.ordering') {
			$orderCol = 'category_name '.$orderDirn.', l.ordering';
		}
		
		$query->order($db->getEscaped($orderCol.' '.$orderDirn));
				
		return $query;
	}
	
	public function getCats() {
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('CONCAT(sec.sec_name," - ",cat.cat_name) AS text,cat.cat_id AS value');
		$query->from('#__melo_cats as cat');
		$query->join('RIGHT', '#__melo_secs AS sec ON sec.sec_id = cat.cat_sec');
		$catId = $this->getState('filter.cat');
		if (is_numeric($catId)) {
			$query->where('cat.cat_id = '.(int) $catId);
		}
		$query->order("sec.sec_name,cat.cat_name");
		$db->setQuery($query);
		return $db->loadObjectList();
	}

	
}
