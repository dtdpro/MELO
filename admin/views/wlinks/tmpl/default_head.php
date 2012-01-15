<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$saveOrder	= $listOrder == 'l.ordering';
?>
<tr>
	<th width="5">
		<?php echo JText::_('COM_MELO_WLINKS_HEADING_ID'); ?>
	</th>
	<th width="20">
		<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
	</th>			
	<th>
		<?php echo JText::_('COM_MELO_WLINKS_HEADING_NAME'); ?>
	</th>	
	<th>
		<?php echo JText::_('COM_MELO_WLINKS_HEADING_URL'); ?>
	</th>	
	<th width="100">
		<?php echo JText::_('JPUBLISHED'); ?>
	</th>	
	<th width="100">
		<?php echo JHtml::_('grid.sort',  'JGRID_HEADING_ORDERING', 'l.ordering', $listDirn, $listOrder); ?>
		<?php echo JHtml::_('grid.order',  $this->items, 'filesave.png', 'wlinks.saveorder'); ?>
	</th>
	
	<th width="100">
		<?php echo JText::_( 'COM_MELO_WLINKS_HEADING_CAT' ); ?>
	</th>
				


</tr>


