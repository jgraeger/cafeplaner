<?php echo $this->element('actions',array(
	'actions' => $actions));
?>

<div class="columns form">
<?php echo $this->Form->create('Column'); ?>
	<fieldset>
		<legend><?php echo 'Neue Spalte anlegen'; ?></legend>
	<?php
		echo $this->Form->input('name', array('label' => array('text' =>'Name'), 'placeholder' => 'Spaltenname') );
		echo $this->Form->input('type', array('label' => array('text' => 'Typ'), 'type' => 'select', 'options' => array(1 => 'Text', 2 => 'Benutzer')));
		echo $this->Form->input('obligated', array('label' => array('text' => 'Belegung notwendig'), 'type' => 'select', 'options' => array(0 => 'Nein', 1 => 'Ja')));
		echo $this->Form->input('req_admin', array('label' => array('text' => 'Eintragen erfordert Adminrechte'), 'type' => 'select', 'options' => array(0 => 'Nein', 1 => 'Ja')));
	?>
	</fieldset>
<?php echo $this->Form->end('Spalte anlegen'); ?>
</div>

</div>