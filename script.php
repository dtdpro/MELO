<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
class com_meloInstallerScript
{
	/**
	 * method to install the component
	 *
	 * @return void
	 */
	function install($parent) 
	{
		// $parent is the class calling this method
		$parent->getParent()->setRedirectURL('index.php?option=com_melo');
	}
 
	/**
	 * method to uninstall the component
	 *
	 * @return void
	 */
	function uninstall($parent) 
	{
		// $parent is the class calling this method
		echo '<p>' . JText::_('COM_MELO_UNINSTALL_TEXT') . '</p>';
	}
 
	/**
	 * method to update the component
	 *
	 * @return void
	 */
	function update($parent) 
	{
		// $parent is the class calling this method
		$db=JFactory::getDBO();
		$q=$db->getQuery(true);
		$q->select('link_name,link_id');
		$q->from('#__melo_links');
		$db->setQuery($q);
		$res=$db->loadObjectList();
		
		foreach ($res as $r) {
			$qu=$db->getQuery(true);
			$qu->update('#__melo_links');
			$qu->set('link_alias = "'.JApplication::stringURLSafe($r->link_name).'"');
			$qu->where('link_id='.$r->link_id);
			$db->setQuery($qu);
			$db->query();
		}
		echo '<p>' . JText::_('COM_MELO_UPDATE_TEXT') . '</p>';
	}
 
	/**
	 * method to run before an install/update/uninstall method
	 *
	 * @return void
	 */
	function preflight($type, $parent) 
	{
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)
	}
 
	/**
	 * method to run after an install/update/uninstall method
	 *
	 * @return void
	 */
	function postflight($type, $parent) 
	{
		
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)
	}
}