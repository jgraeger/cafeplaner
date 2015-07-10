<div class="columnsTexts form">
<?php echo $this->Form->create('ColumnsText'); ?>
	<fieldset>
		<legend><?php echo __('Add Columns Text'); ?></legend>
	<?php
		echo $this->Form->input('message');
		echo $this->Form->input('column_name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Columns Texts'), array('action' => 'index')); ?></li>
	</ul>
</div>
