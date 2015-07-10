<div class="columnsTexts index">
	<h2><?php echo __('Columns Texts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('message'); ?></th>
			<th><?php echo $this->Paginator->sort('column_name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($columnsTexts as $columnsText): ?>
	<tr>
		<td><?php echo h($columnsText['ColumnsText']['date']); ?>&nbsp;</td>
		<td><?php echo h($columnsText['ColumnsText']['message']); ?>&nbsp;</td>
		<td><?php echo h($columnsText['ColumnsText']['column_name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $columnsText['ColumnsText']['date'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $columnsText['ColumnsText']['date'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $columnsText['ColumnsText']['date']), null, __('Are you sure you want to delete # %s?', $columnsText['ColumnsText']['date'])); ?>
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
		<li><?php echo $this->Html->link(__('New Columns Text'), array('action' => 'add')); ?></li>
	</ul>
</div>
