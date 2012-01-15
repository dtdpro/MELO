<?php
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

class MELOModelMELO extends JModel
{

	protected $_numcats = 0;
	protected $_numlinks = 0;
	
	function getLinks($disp)
	{
		$user =& JFactory::getUser();
		$db =& JFactory::getDBO();
		$query = $db->getQuery(true);
		
		//Get Cat List
		$query->select('a.id as cat_id, a.title as cat_title, a.level as cat_level');
		$query->from('#__categories AS a');
		$query->where('a.parent_id > 0');
		$query->where('extension = ' . $db->quote("com_melo"));
		$query->where('a.published >= 1');
		$query->where('a.access IN ('.implode(",",$user->getAuthorisedViewLevels()).')');
		$query->order('a.lft');
		$db->setQuery($query);
		$items = $db->loadObjectList();
		
		//set num cats
		$this->_numcats=count($items);
		
		//Gather links
		foreach ($items as &$i) {
			$lquery = $db->getQuery(true);
			$lquery->select('l.*');
			$lquery->from('#__melo_links AS l');
			$lquery->where('l.link_cat = '.(int)$i->cat_id);
			$lquery->where('l.access IN ('.implode(",",$user->getAuthorisedViewLevels()).')');
			$lquery->where('l.published >= 1');
			$lquery->order('l.ordering');
			$db->setQuery($lquery);
			$i->links = $db->loadObjectList();
			$this->_numlinks = $this->_numlinks + count($i->links);
		}

		return $items;
	}
	
	function getNumCats() {
		return $this->_numcats;
	}
	
	function getNumLinks() {
		return $this->_numlinks;
	}
	
	function getLink($linkid) {
		$user =& JFactory::getUser();
		$db =& JFactory::getDBO();
		$q=$db->getQuery(true);
		$q->select('l.link_url as url,l.link_id');
		$q->from('#__melo_links as l');
		$q->where('l.link_id = '.$linkid.'');
		$q->where('l.published >= 1');
		$q->where('l.access IN ('.implode(",",$user->getAuthorisedViewLevels()).')');
		$db->setQuery( $q );
		$linkset = $db->loadObject();
		if ($linkset) $this->trackLink($user->id,$linkid,$db);
		return $linkset;
	}
	function trackLink($userid,$linkid,$db) {
		$q = $db->getQuery(true);
		$q->insert('#__melo_track');
		$q->columns(array($this->_db->quoteName('mlt_link'),$this->_db->quoteName('mlt_user'),$this->_db->quoteName('mlt_ip')));
		$q->values('"'.$linkid.'","'.$userid.'","'.$_SERVER['REMOTE_ADDR'].'"');
		$db->setQuery($q);
		$db->query();
	}
	
	
}
?>