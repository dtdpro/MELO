<?php
// no direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_melo')) {
return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');

$document = JFactory::getDocument();
$document->addStyleDeclaration('.icon-48-melo-categories {background-image: url(../media/com_melo/images/melocat-48x48.png);}');
$document->addStyleDeclaration('.icon-48-melo {background-image: url(../media/com_melo/images/melo-48x48.png);}');

$controller = JControllerLegacy::getInstance('melo');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
?>
