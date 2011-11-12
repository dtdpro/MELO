<?php
jimport( 'joomla.application.component.view');

class MLinksViewMLinks extends JView
{
	function display($tpl = null)
	{
		global $mainframe;
		$model =& $this->getModel('mlinks');
		$params = $mainframe->getPageParameters();
		$disp = JRequest::getVar('disp');
		if (!$disp) $disp = $params->get('disp');
		$linktype = $params->get('linktype');
		if (!$disp) $disp = 'list';
		if ($disp == 'redir') {
			$linkid = JRequest::getVar('linkid');
			$linkdata=$model->getLink($linkid);
			if ($linkdata) $mainframe->redirect($linkdata['url']);
			else $disp='list';
		}
		if ($disp != 'redir') {
			$linkdata=$model->getLinks($disp);
			$this->assignRef('linkdata',$linkdata);
			$this->assignRef('linktype',$linktype);
			$this->assignRef('disp',$disp);
			parent::display($tpl);
		}
	}
}
?>
