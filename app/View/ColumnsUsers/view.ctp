<div class="columnsUsers view">
<h2><?php echo __('Columns User'); ?></h2>
	<dl>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($columnsUser['ColumnsUser']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Half Shift'); ?></dt>
		<dd>
			<?php echo h($columnsUser['ColumnsUser']['half_shift']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($columnsUser['ColumnsUser']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shift Name'); ?></dt>
		<dd>
			<?php echo h($columnsUser['ColumnsUser']['shift_name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Columns User'), array('action' => 'edit', $columnsUser['ColumnsUser']['date'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Columns User'), array('action' => 'delete', $columnsUser['ColumnsUser']['date']), null, __('Are you sure you want to delete # %s?', $columnsUser['ColumnsUser']['date'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Columns Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Columns User'), array('action' => 'add')); ?> </li>
	</ul>
</div>
