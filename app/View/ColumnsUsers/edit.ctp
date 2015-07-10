<div class="columnsUsers form">
<?php echo $this->Form->create('ColumnsUser'); ?>
	<fieldset>
		<legend><?php echo __('Edit Columns User'); ?></legend>
	<?php
		echo $this->Form->input('date');
		echo $this->Form->input('half_shift');
		echo $this->Form->input('username');
		echo $this->Form->input('shift_name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ColumnsUser.date')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ColumnsUser.date'))); ?></li>
		<li><?php echo $this->Html->link(__('List Columns Users'), array('action' => 'index')); ?></li>
	</ul>
</div>
