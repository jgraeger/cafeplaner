<?php

echo $this->element('actions', array (
		'actions' => $actions
	)); ?>


<div class="changelogs index">
	<h2><?php echo 'Änderungsliste'; ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
	<tr>
			<th><?php echo $this->Paginator->sort('for_date', 'betroffenes Datum'); ?></th>
			<th><?php echo $this->Paginator->sort('change_date', 'Änderungsdatum'); ?></th>
			<th><?php echo $this->Paginator->sort('value_before', 'vorheriger Eintrag'); ?></th>
			<th><?php echo $this->Paginator->sort('value_after', 'neuer Eintrag'); ?></th>
			<th><?php echo $this->Paginator->sort('column_name', 'betroffene Schicht'); ?></th>
			<th><?php echo $this->Paginator->sort('user_did', 'ändernder Nutzer'); ?></th>
	</tr>
	<?php foreach ($changelogs as $changelog): ?>
	<tr>
		<td><?php echo h(date('d. m. Y',strtotime( $changelog['Changelog']['for_date']))); ?>&nbsp;</td>
		<td><?php echo h(date('d. m. Y H:i:s', strtotime($changelog['Changelog']['change_date']))); ?>&nbsp;</td>
		<td><?php echo h($changelog['Changelog']['value_before']); ?>&nbsp;</td>
		<td><?php echo h($changelog['Changelog']['value_after']); ?>&nbsp;</td>
		<td><?php echo h($changelog['Changelog']['column_name']); ?>&nbsp;</td>
		<td><?php echo h($changelog['Changelog']['user_did']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => 'Seite {:page} von {:pages}, zeigt {:current} Einträge von insgesamt {:count}, Anfang bei Eintrag {:start}, Ende bei Eintrag {:end}')
	);
	?>	</p>
	<div id='paging-div' class="paging">
	<?php
		//echo $this->Paginator->prev('< ' . 'vorherige Seite', array(), null, array('class' => 'prev disabled'));
		//echo $this->Paginator->numbers(array('separator' => ''));
		//echo $this->Paginator->next('nächste Seite' . ' >', array(), null, array('class' => 'next disabled'));
		echo $this->Paginator->pagination(array('div' => 'pagination'));
	?>
	</div>
</div>

</div>
