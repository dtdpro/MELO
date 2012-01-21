<?php
/**
 * @package		MELO.Site
 * @subpackage	com_melo
 * @copyright	Copyright (C) 2011 - 2012 DtD Productions All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

 /* MELO Component Route Helper
 *
 * @package		MELO.Site
 * @subpackage	com_melo
 * @since 1.0
 */

defined('_JEXEC') or die;


/**
 * Build the route for the com_weblinks component
 *
 * @param	array	An array of URL arguments
 *
 * @return	array	The URL arguments to use to assemble the subsequent URL.
 */
function MELOBuildRoute(&$query)
{
	$segments = array();

	if (isset($query['linkid'])) $id = $query['linkid'];
	if (isset($id)) {
		$segments[] = $id;
		unset($query['linkid']);
		unset($query['view']);
		unset($query['disp']);
	}
	
	return $segments;
}
/**
 * Parse the segments of a URL.
 *
 * @param	array	The segments of the URL to parse.
 *
 * @return	array	The URL attributes to be used by the application.
 */
function MELOParseRoute($segments)
{
	$vars = array();

	//Get the active menu item.
	$app	= JFactory::getApplication();
	$menu	= $app->getMenu();
	$item	= $menu->getActive();
	$params = JComponentHelper::getParams('com_melo');

	// Count route segments
	$count = count($segments);
	// Standard routing 
	if ($count) {
		$linkid		= $segments[0];
		if (isset($linkid)) {
			$vars['linkid'] = (int)$linkid;
			$vars['disp'] = "redir";
			$vars['view'] = "melo";
		}
	}
	return $vars;
}
