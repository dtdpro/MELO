<?php // no direct access
defined('_JEXEC') or die('Restricted access'); 
echo '<div id="system">';

$linkspercol=((int)($this->numlinks / $this->numcols)+1);
$cnumlinks=0;
$colreset=true;
foreach ($this->linkdata as $l) {
	if ($colreset==true) {
		$colreset=false;
		if ($cnumlinks != 0) echo '</div>'."\n";
		$cnumlinks=0;
		echo '<div style="float:left;width:'.(int)(100/$this->numcols).'%;">'."\n";
	}
	echo '<div id="linkcat'.$l->cat_level.'" style="padding-left:'.(5*$l->cat_level).'px">'.$l->cat_title.'</div>'."\n";
	$linklist=$l->links;
	if ($l->links) {
		echo '<div id="linksec">'."\n";
		foreach ($l->links as $r) {
			echo '<div id="link" style="padding-right:5px;padding-left:'.(5*($l->cat_level+1)).'px;">';
			echo ' <a href="';
			if ($this->linktype == 'normal') echo $r->link_url;
			if ($this->linktype == 'redir') echo JRoute::_('index.php?option=com_melo&disp=redir&linkid='.$r->link_id.':'.$r->link_alias);
			echo '"';
			if ($this->linktarget == 'new') echo ' target="_blank"';
			echo '>'.$r->link_name.'</a>';
			echo '</div>'."\n";
		}
		echo '</div>'."\n";
		$cnumlinks = $cnumlinks + count($l->links);
	}
	if ($cnumlinks > $linkspercol) {
		$colreset=true;
	}
}
echo '</div>';
echo '</div>';

