<script type="text/javascript">
	$(document).ready(function() {
		$("#legendDiv").children().attr('align','');
	});
</script>
<?php echo $this->element('actions', $actions); ?>
<h2> Benutzerverwaltung </h2>
<div class="users form">
<?php echo $this->Form->create('User', array(
		'class' => 'well'
	)); ?>
		<legend><?php echo 'Benutzer anlegen'; ?></legend>
	
	<div class="span12">
	<div class="span5">
	<?php echo $this->Form->input('username', array('label' => array('text' =>'Benutzername')));?> 
	<?php echo $this->Form->input('fname', array('label' => array('text' =>'Vorname')));?>
	<?php echo $this->Form->input('lname', array('label' => array('text' =>'Nachname')));?>

<!--	<td>	<?php	echo $this->Form->input('password', array('label' => array('text' =>'Passwort')));?> </td>-->

	<?php echo $this->Form->input('tel1', array('label' => array('text' =>'Telefonnummer 1')));?>
	<?php echo $this->Form->input('tel2', array('label' => array('text' =>'Telefonnummer 2')));?>
	<?php echo $this->Form->input('mail', array('label' => array('text' =>'E-Mail Adresse'))); ?> 
	</div>
	<div class="span5 offset1">

	<?php
		echo $this->Form->input('mo',array(
			'options' => $enumValues,
			'type' => 'select',
			'label' => 'Montag',
			'empty' => '-- Bitte auswählen --'
		));
		echo $this->Form->input('di',array(
			'options' => $enumValues,
			'type' => 'select',
			'label' => 'Dienstag',
			'empty' => '-- Bitte auswählen --'
		));
		echo $this->Form->input('mi',array(
			'options' => $enumValues,
			'type' => 'select',
			'label' => 'Mittwoch',
			'empty' => '-- Bitte auswählen --'
		));
		echo $this->Form->input('do',array(
			'options' => $enumValues,
			'type' => 'select',
			'label' => 'Donnerstag',
			'empty' => '-- Bitte auswählen --'
		));
		echo $this->Form->input('fr',array(
			'options' => $enumValues,
			'type' => 'select',
			'label' => 'Freitag',
			'empty' => '-- Bitte auswählen --'
		));
	?>
	<div id="legendDiv" style="margin-top: 15px">
	<?php echo $this->element('legend'); ?>	
	</div>
	</div>
	</div>
<?php echo $this->Form->submit('Benutzer erstellen',array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->end(); ?>
</div>

</div>
