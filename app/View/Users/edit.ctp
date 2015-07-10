<script type="text/javascript">
	$(document).ready(function() {
		$("#legendDiv").children().attr('align','');
	});
</script>
<?php echo $this->element('actions',array('actions' => $actions)); ?>
<h2>Kontoverwaltung</h2>

	<?php echo $this->Form->create('User',array(
		'type' => 'post',
		'url' => array('controller' => 'users','action' => 'edit'),
		'class' => 'well '
		)); ?>
	<legend><?php echo 'Benutzer editieren'; ?></legend>
		<?php echo $this->Form->input('id'); ?>
		<div class="span12">
        <div class="span5">
		<?php echo $this->Form->input('username',array(
				'placeholder' => 'Benutzernamen eingeben',
				'div' => 'control-group',
				'label' => array(
						'text' => 'Benutzername:'
			)));?> 

		<?php echo $this->Form->input('fname', array(
				'placeholder' => 'Vornamen eingeben',
				'div' => 'control-group',
				'label' => array(
						'text' => 'Vorname:'
			)));?> 

		<?php echo $this->Form->input('lname', array('label' => array('text' =>'Nachname')));?>

		<?php echo $this->Form->input('password', array('label' => array('text' =>'Passwort'), 'value'=>""));?> 

		<?php echo $this->Form->input('password2', array('label' => array('text' =>'Passwort wiederholen'), 'type' => 'password'));?> 
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
	<div id="legendDiv">
	<?php echo $this->element('legend'); ?>
	</div>
	</div>
	</div>
	<?php echo $this->Form->submit('Änderungen speichern', array(
			'div' => false,
			'class' => 'btn btn-primary'
		)); ?>

<?php echo $this->Form->end(); ?>
</div>
