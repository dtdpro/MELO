<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
// load tooltip behavior
JHtml::_('behavior.tooltip');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$saveOrder	= $listOrder == 'l.ordering';
?>
<form action="<?php echo JRoute::_('index.php?option=com_melo&view=wlinks'); ?>" method="post" name="adminForm" id="adminForm">
	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
			
		</div>
		<div class="filter-select fltrt">
			<select name="filter_published" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_PUBLISHED');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.published'), true);?>
			</select>
			<select name="filter_cat" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('COM_MELO_WLINKS_SELECT_CAT');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('category.options', 'com_melo'), 'value', 'text', $this->state->get('filter.cat'));?>
			</select>
		</div>
	</fieldset>
	
	<div class="clr"> </div>
	
	<table class="adminlist table table-striped">
		<thead>
			<tr>
				<th width="20">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
				</th>			
				<th>
					<?php echo JHtml::_('grid.sort','COM_MELO_WLINKS_HEADING_NAME','l.link_name', $listDirn, $listOrder); ?>
				</th>	
				<th>
					<?php echo JText::_('COM_MELO_WLINKS_HEADING_URL'); ?>
				</th>	
				<th width="100">
					<?php echo JHtml::_('grid.sort','JPUBLISHED','l.published', $listDirn, $listOrder); ?>
				</th>	
				<th width="100">
					<?php echo JHtml::_('grid.sort','JGRID_HEADING_ACCESS','l.access', $listDirn, $listOrder); ?>
				</th>	
				<th width="100">
					<?php echo JHtml::_('grid.sort',  'JGRID_HEADING_ORDERING', 'l.ordering', $listDirn, $listOrder); ?>
					<?php echo JHtml::_('grid.order',  $this->items, 'filesave.png', 'wlinks.saveorder'); ?>
				</th>
				
				<th width="100">
					<?php echo JText::_( 'COM_MELO_WLINKS_HEADING_CAT' ); ?>
				</th>
				<th width="5">
					<?php echo JHtml::_('grid.sort','COM_MELO_WLINKS_HEADING_ID','l.link_id', $listDirn, $listOrder); ?>
				</th>
			</tr>
		</thead>
		<tfoot><tr><td colspan="8"><?php echo $this->pagination->getListFooter(); ?></td></tr></tfoot>
		<tbody>
			<?php foreach($this->items as $i => $item): 
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
							<p class="smallsub small">
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
							<input type="text" name="order[]" size="5" value="<?php echo $item->ordering;?>" <?php echo $disabled ?> class="width-20 text-area-order" />
					</td>
					<td>
						<?php echo $item->category_name; ?>
					</td>
					<td>
						<?php echo $item->link_id; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	
	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_area" value="<?php echo $this->state->get('filter.area'); ?>" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>