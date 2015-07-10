<div class="columnsUsers index">
	<h2><?php echo __('Columns Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('half_shift'); ?></th>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('shift_name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($columnsUsers as $columnsUser): ?>
	<tr>
		<td><?php echo h($columnsUser['ColumnsUser']['date']); ?>&nbsp;</td>
		<td><?php echo h($columnsUser['ColumnsUser']['half_shift']); ?>&nbsp;</td>
		<td><?php echo h($columnsUser['ColumnsUser']['username']); ?>&nbsp;</td>
		<td><?php echo h($columnsUser['ColumnsUser']['shift_name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $columnsUser['ColumnsUser']['date'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $columnsUser['ColumnsUser']['date'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $columnsUser['ColumnsUser']['date']), null, __('Are you sure you want to delete # %s?', $columnsUser['ColumnsUser']['date'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Columns User'), array('action' => 'add')); ?></li>
	</ul>
</div>
