<?php defined('_JEXEC') or die('Restricted access'); ?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">
			<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( 'SubCat Name' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="sc_name" id="sc_name" size="30" maxlength="30" value="<?php echo $this->data->sc_name;?>" />
			</td></tr>
			<tr><td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( 'Category' ); ?>:
				</label>
			</td>
			<td><?php
				echo JHTML::_( 'select.genericlist', $this->cats, 'catid','','cat_id','cat_name',$this->data->catid);
			?></td></tr>
			<tr><td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( 'Column' ); ?>:
				</label>
			</td>
			<td><?php
				echo JHTML::_( 'select.integerlist', 1, 6, 1, 'lcol', '', $this->data->lcol );
			?></td></tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_mlinks" />
<input type="hidden" name="sc_id" value="<?php echo $this->data->sc_id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="scat" />
</form>
