<?php
jimport( 'joomla.application.component.view');

class MELOViewMELO extends JView
{
	protected $numcats;
	protected $numcols;
	protected $numlinks;
	protected $linktype;
	
	function display($tpl = null)
	{
		$app = JFactory::getApplication();
		$model =& $this->getModel();
		$params = $app->getParams();		
		$disp = JRequest::getVar('disp');
		if (!$disp) $disp = 'list';
		if ($disp == 'redir') {
			$linkid = JRequest::getVar('linkid');
			$linkdata=$model->getLink($linkid);
			if ($linkdata) $app->redirect($linkdata->url);
			else $disp='list';
		}
		if ($disp != 'redir') {
			$linkdata=$model->getLinks($disp);
			$this->linktype = $params->get('linktype','redir');
			$this->numcols = $params->get('numcols',5);
			$this->numcats=$model->getNumCats();
			$this->numlinks=$model->getNumLinks();
			$this->assignRef('linkdata',$linkdata);
			$this->assignRef('disp',$disp);
			parent::display($tpl);
		}
	}
}
?>
