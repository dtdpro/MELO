<?php
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

class MLinksModelMLinks extends JModel
{

	function getLinks($disp)
	{
		$user =& JFactory::getUser();
		$userid = $user->id;
		$aid = $user->aid;
		$db =& JFactory::getDBO();
		$q  = 'SELECT * FROM #__mlinks as l ';
		$q .= 'LEFT JOIN #__mlinks_subcats as s ON l.cat = s.sc_id ';
		$q .= 'LEFT JOIN #__mlinks_cats as c ON s.catid = c.cat_id ';
		$q .= 'WHERE l.published = 1 && l.access <= "'.$aid.'" ';
		if ($disp == 'list') $q .= 'ORDER BY s.lcol ASC, c.cat_name ASC, s.sc_name ASC, l.sitename ASC';
		if ($disp == 'full') $q .= 'ORDER BY c.cat_name ASC, s.sc_name ASC, l.sitename ASC';
		$db->setQuery( $q );
		$linkset = $db->loadAssocList();
		return $linkset;
	}
	function getLink($linkid) {
		$user =& JFactory::getUser();
		$userid = $user->id;
		$aid = $user->aid;
		$db =& JFactory::getDBO();
		$q  = 'SELECT l.sitelink as url,l.id FROM #__mlinks as l ';
		$q .= 'WHERE l.id = '.$linkid.' && l.published = 1 && l.access <= "'.$aid.'" ';
		$db->setQuery( $q );
		$linkset = $db->loadAssoc();
		if ($linkset) $this->trackLink($user->id,$linkset['id'],$db);
		return $linkset;
	}
	function trackLink($userid,$linkid,$db) {
		$q = 'INSERT INTO #__mlinks_track (mlt_link,mlt_user,mlt_ip) VALUES ("'.$linkid.'","'.$userid.'","'.$_SERVER['REMOTE_ADDR'].'")';	
		$db->setQuery($q);
		$db->query();
	}
	
}
?>