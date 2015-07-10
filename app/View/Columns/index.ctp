<?php echo $this->Html->script('columnScript'); ?>
<?php echo $this->element('actions',array(
	'actions' => $actions));
?>
<h2> Spaltenverwaltung </h2>
<p> Hier können Sie die Spalten im Plan verwalten. Durch klicken auf die Pfeile können Sie die Position der Spalten im Plan verändern.
	Bitte beachten sie, dass Textspalten, unabhägig von den hier getroffenen Einstellungen, den Schichtspalten vorrangestellt werden.
</p>
<div class="columns index">
	<h3><?php echo 'Spalten im Plan'; ?></h3>
	<table cellpadding="0" cellspacing="0" class="table table-bordered">
	<tr>
			<th><?php echo $this->Paginator->sort('name', 'Name'); ?></th>
			<th><?php echo $this->Paginator->sort('type', 'Typ'); ?></th>
			<th><?php echo $this->Paginator->sort('obligated', 'Belegung notwendig'); ?></th>
			<th><?php echo $this->Paginator->sort('req_admin', 'Eintragen erfordert Adminrechte'); ?></th>
			<th class="actions"><?php echo 'Aktionen'; ?></th>
	</tr>
	
	<?php 
	$yesno = array(0 => 'Nein', 1 => 'Ja');
	$types = array(1 => 'Text', 2 => 'Benutzer') 
	?>

	<?php foreach ($columns as $column): ?>

		

	<tr id="column_<?php echo $column['Column']['id'];?>">
		<td><?php echo h($column['Column']['name']); ?>&nbsp;</td>
		<td><?php echo h($types[$column['Column']['type']]); ?>&nbsp;</td>
		<td><?php echo h($yesno[$column['Column']['obligated']]); ?>&nbsp;</td>
		<td><?php echo h($yesno[$column['Column']['req_admin']]); ?>&nbsp;</td> 
		<td class="actions">
			<?php echo $this->Html->link('Bearbeiten', array('action' => 'edit', $column['Column']['id'])); ?>
			&nbsp;|&nbsp;
			<?php echo $this->Form->postLink('Löschen', array('action' => 'delete', $column['Column']['id']), null, 'Wollen Sie wirklich die Spalte "'.$column['Column']['name'].'" löschen?'); ?>
			&nbsp;|&nbsp;
			<i class="icon-large icon-upload" id="up_<?php echo $column['Column']['id'];?>"></i>
			&nbsp;
			<i class="icon-large icon-download" id="down_<?php $column['Column']['id'];?>"></i>
		</td>
	</tr>


<?php endforeach; ?>

	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => ('Seite {:page} von {:pages}, zeige {:current} Einträge von {:count} insgesamt, von Eintrag {:start} bis Eintrag {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		  echo $this->Paginator->pagination(array('div' => 'pagination'));
	?>
	</div>
</div>
</div>
