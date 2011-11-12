<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_melo')) 
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// require helper file
JLoader::register('ContinuedHelper', dirname(__FILE__) . DS . 'helpers' . DS . 'melo.php');

//icon
//$document = JFactory::getDocument();
//$document->addStyleDeclaration('.icon-48-ContinuEd {background-image: url(../media/com_melo/images/melo-48x48.png);}');
//$document->addStyleDeclaration('.icon-48-continued {background-image: url(../media/com_melo/images/melo-48x48.png);}');


// import joomla controller library
jimport('joomla.application.component.controller');

// Get an instance of the controller prefixed by vidrev
$controller = JController::getInstance('MELO');

// Perform the Request task
$controller->execute(JRequest::getCmd('task'));

// Redirect if set by the controller
$controller->redirect();

?>
