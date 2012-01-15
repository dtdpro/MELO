<?php
// no direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_melo')) {
return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');

$controller = JController::getInstance('melo');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
?>
