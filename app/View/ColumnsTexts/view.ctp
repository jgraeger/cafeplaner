<div class="columnsTexts view">
<h2><?php echo __('Columns Text'); ?></h2>
	<dl>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($columnsText['ColumnsText']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message'); ?></dt>
		<dd>
			<?php echo h($columnsText['ColumnsText']['message']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Column Name'); ?></dt>
		<dd>
			<?php echo h($columnsText['ColumnsText']['column_name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Columns Text'), array('action' => 'edit', $columnsText['ColumnsText']['date'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Columns Text'), array('action' => 'delete', $columnsText['ColumnsText']['date']), null, __('Are you sure you want to delete # %s?', $columnsText['ColumnsText']['date'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Columns Texts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Columns Text'), array('action' => 'add')); ?> </li>
	</ul>
</div>
