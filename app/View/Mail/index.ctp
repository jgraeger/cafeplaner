<?php echo $this->element('actions',array(
		'actions' => $actions
));?>

<script type="text/javascript">
	$(document).ready(function() {
		//Gleiche die Breite der Textarea mit der des Betrefffeldes an
		var width = $("#MailSubject").width();
		$("#MailContent").width(width);
		$("#MailContent").height(120);

		//Versehe den Button "Felder leeren" mit einer Funktion
		$("#clear-fields").click(function() {
			$("#MailSubject").val("");
			$("#MailContent").val("");
		});	
		
	});
</script>
	<h2>Rundmail verschicken</h2>
	<p> 
	Hier können Administratoren E-Mails an alle Mitarbeiter der Cafeteria versenden.
	</p>
	<br>
	<?php echo "<legend>E-Mail versenden</legend>"; ?>
	<?php echo $this->Form->create('Mail',array(
			'type' => 'post',
			'url' => array('controller' => 'mail', 'action' => 'index'),
			'inputDefaults' => array(
					'div' => 'control-group',
					'label' => array(
							'class' => 'control-label'
					 ),
			'class' => 'well form-horizontal')
			)); ?>
		<?php echo $this->Form->input('sendToAll',array(
				'div' => 'control-group',
				'class' => 'input-xxlarge',
				'label' => array(
						'text' => 'auch an inaktive Mitarbeiter'
					),
				'type' => 'checkbox'
				));?>
		<?php echo $this->Form->input('allowReply',array(
				'div' => 'control-group',
				'class' => 'input-xxlarge',
				'label' => array(
						'text' => 'Antwort zulassen'
					),
				'type' => 'checkbox'
				));?>
		<?php echo $this->Form->input('subject',array(
				'placeholder' => 'Betreff eingeben',
				'div' => 'control-group',
				'class' => 'input-xxlarge',
				'label' => array(
						'text' => 'Betreff:'
					)
				));?>
		<?php echo $this->Form->textarea('content',array(
				'placeholder' => 'Bitte geben sie den zu versendenden Text ein',
				'label' => array ( 'text' => 'Inhalt:')				
				));?>
		<div class="form-actions">
			<?php echo $this->Form->submit('E-Mail versenden',array(
						'div' => false,
						'class' => 'btn btn-primary'
					));?>
			<button type="button" class="btn" id="clear-fields">Felder leeren</button>
		</div>
	<?php echo $this->Form->end();?>
</div>
