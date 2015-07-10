<?php echo $this->element('actions',array(
		'actions' => $actions));
?>

<div class="columns form">
<?php echo $this->Form->create('Column'); ?>
	<fieldset>
		<legend><?php echo 'Spalte bearbeiten'; ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label' => 'Name'));
		echo $this->Form->input('type', array('label' => 'Typ', 'type' => 'select', 'options' => array(1 => 'Text', 2 => 'Benutzer')));
		echo $this->Form->input('obligated', array('label' => 'Belegung notwendig', 'type' => 'select', 'options' => array(0 => 'Nein', 1 => 'Ja')));
		echo $this->Form->input('req_admin', array('label' => 'Eintragen erfordert Adminrechte', 'type' => 'select', 'options' => array(0 => 'Nein', 1 => 'Ja')));

	?>
	</fieldset>
<?php echo $this->Form->end('Speichern'); ?>
</div>
</div>