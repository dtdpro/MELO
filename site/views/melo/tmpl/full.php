<?php
foreach ($this->linkdata as $l) {
	echo '<div id="linkcat'.$l->cat_level.'" style="padding-left:'.(5*$l->cat_level).'px">'.$l->cat_title.'</div>'."\n";
	$linklist=$l->links;
	if ($l->links) {
		echo '<div id="linksec">'."\n";
		foreach ($l->links as $r) {
			echo '<div id="link" style="padding-right:5px;padding-left:'.(5*($l->cat_level+1)).'px;">';
			echo ' <a href="';
			if ($this->linktype == 'normal') echo $r->link_url;
			if ($this->linktype == 'redir') echo JRoute::_('index.php?option=com_melo&disp=redir&linkid='.$r->link_id);
			echo '">'.$r->link_name.'</a>';
			echo '</div>'."\n";
			echo '<div id="linkdesc" style="padding-right:5px;padding-left:'.((5*($l->cat_level+1))+5).'px;">';
			echo $r->link_desc;
			echo '</div>'."\n";
		}
		echo '</div>'."\n";
	}
}