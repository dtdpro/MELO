<?php
/**
 * @package		MELO.Site
 * @subpackage	com_melo
 * @copyright	Copyright (C) 2011 - 2012 DtD Productions All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

/**
 * MELO Component Controller
 *
 * @package		MELO.Site
 * @subpackage	com_melo
 * @since 1.0
 */
class MELOController extends JController
{
	/**
	 * Method to display a view.
	 *
	 * @param	boolean			If true, the view output will be cached
	 * @param	array			An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JController		This object to support chaining.
	 * @since	1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		return parent::display($cachable, $urlparams);
	}
}
