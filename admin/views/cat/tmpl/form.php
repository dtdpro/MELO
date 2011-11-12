<?php defined('_JEXEC') or die('Restricted access'); ?>
<form action="" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">
			<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( 'Category Name' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="cat_name" id="cat_name" size="30" maxlength="30" value="<?php echo $this->data->cat_name;?>" />
			</td></tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_mlinks" />
<input type="hidden" name="cat_id" value="<?php echo $this->data->cat_id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="cat" />
</form>
