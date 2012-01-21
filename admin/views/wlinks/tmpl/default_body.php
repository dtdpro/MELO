<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

foreach($this->items as $i => $item): 
	$listOrder	= $this->escape($this->state->get('list.ordering'));
	$listDirn	= $this->escape($this->state->get('list.direction'));
	$saveOrder	= $listOrder == 'l.ordering';
	$ordering	= ($listOrder == 'l.ordering');
	?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php echo JHtml::_('grid.id', $i, $item->link_id); ?>
		</td>
		<td>
				<a href="<?php echo JRoute::_('index.php?option=com_melo&task=wlink.edit&link_id='.(int) $item->link_id); ?>">
				<?php echo $item->link_name; ?></a>
				<p class="smallsub">
				<?php echo JText::sprintf('JGLOBAL_LIST_ALIAS', $this->escape($item->link_alias));?></p>
		</td>
		<td>
			<?php echo $item->link_url; ?>
		</td>
		<td class="center">
			<?php echo JHtml::_('jgrid.published', $item->published, $i, 'wlinks.', true);?>
		</td>
       <td class="center">
			<?php echo $this->escape($item->access_level); ?>
		</td>
        <td class="order">
				<?php if ($saveOrder) :?>
					<?php if ($listDirn == 'asc') : ?>
						<span><?php echo $this->pagination->orderUpIcon($i, ($item->link_cat == @$this->items[$i-1]->link_cat), 'wlinks.orderup', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
						<span><?php echo $this->pagination->orderDownIcon($i, $this->pagination->total, ($item->link_cat == @$this->items[$i+1]->link_cat), 'wlinks.orderdown', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
					<?php elseif ($listDirn == 'desc') : ?>
						<span><?php echo $this->pagination->orderUpIcon($i, ($item->link_cat == @$this->items[$i-1]->link_cat), 'wlinks.orderdown', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
						<span><?php echo $this->pagination->orderDownIcon($i, $this->pagination->total, ($item->link_cat == @$this->items[$i+1]->link_cat), 'wlinks.orderup', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
					<?php endif; ?>
				<?php endif; ?>
				<?php $disabled = $saveOrder ?  '' : 'disabled="disabled"'; ?>
				<input type="text" name="order[]" size="5" value="<?php echo $item->ordering;?>" <?php echo $disabled ?> class="text-area-order" />
		</td>
		<td>
			<?php echo $item->category_name; ?>
		</td>
		<td>
			<?php echo $item->link_id; ?>
		</td>
	</tr>
<?php endforeach; ?>

