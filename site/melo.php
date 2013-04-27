<?php
/**
 * @package		MELO.Site
 * @subpackage	com_melo
 * @copyright	Copyright (C) 2011 - 2012 DtD Productions All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

$doc = &JFactory::getDocument();
$doc->addStyleSheet("components/com_melo/melo.css");

jimport('joomla.application.component.controller');
$controller	= JControllerLegacy::getInstance('MELO');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
