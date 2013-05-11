<?php

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'wlink.cancel' || document.formvalidator.isValid(document.id('wlink-form')))
		{
			Joomla.submitform(task, document.getElementById('wlink-form'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_melo&layout=edit&link_id='.(int) $this->item->link_id); ?>" method="post" name="adminForm" id="wlink-form" class="form-validate">
	<div class="row-fluid">
		<!-- Begin Weblinks -->
		<div class="span10 form-horizontal">

	<fieldset>
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>

			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', empty($this->item->link_id) ? JText::_('COM_MELO_NEW_WLINK', true) : JText::sprintf('COM_MELO_EDIT_WLINK', $this->item->link_id, true)); ?>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('link_name'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('link_name'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('link_url'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('link_url'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('link_cat'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('link_cat'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('ordering'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('ordering'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('link_desc'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('link_desc'); ?></div>
				</div>
			<?php echo JHtml::_('bootstrap.endTab'); ?>

			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'publishing', JText::_('JGLOBAL_FIELDSET_PUBLISHING', true)); ?>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('link_alias'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('link_alias'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('link_id'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('link_id'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('created_by'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('created_by'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('created_by_alias'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('created_by_alias'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('created'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('created'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('publish_up'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('publish_up'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('publish_down'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('publish_down'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('modified_by'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('modified_by'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('modified'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('modified'); ?></div>
				</div>
				<?php if ($this->item->hits) : ?>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('link_hits'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('link_hits'); ?></div>
					</div>
				<?php endif; ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>

			<input type="hidden" name="task" value="" />
			<?php echo JHtml::_('form.token'); ?>

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>
		</fieldset>
		</div>
		<!-- End Weblinks -->
		<!-- Begin Sidebar -->
			<?php echo JLayoutHelper::render('joomla.edit.details', $this); ?>
		<!-- End Sidebar -->
</form>