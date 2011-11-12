<?php defined('_JEXEC') or die('Restricted access'); ?>
<form action="index.php" method="post" name="adminForm">
<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5">
				<?php echo JText::_( 'ID' ); ?>
			</th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>			
			<th>
				<?php echo JText::_( 'Name' ); ?>
			</th>			
			<th width="150">
				<?php echo JText::_( 'Category' ); ?>
			</th>			
			<th width="50">
				<?php echo JText::_( 'Column' ); ?>
			</th>
		</tr>			
	</thead>
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];
		$checked 	= JHTML::_('grid.id',   $i, $row->sc_id );
		$link 		= JRoute::_( 'index.php?option=com_mlinks&controller=scat&task=edit&cid[]='. $row->sc_id );
		
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $row->sc_id; ?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>
			<td>
				<a href="<?php echo $link; ?>"><?php echo $row->sc_name; ?></a>
			</td>
			<td>
				<?php echo $row->cat_name; ?>
			</td>
			<td>
				<?php echo $row->lcol; ?>
			</td>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
	</table>
</div>

<input type="hidden" name="option" value="com_mlinks" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="scat" />
</form>
