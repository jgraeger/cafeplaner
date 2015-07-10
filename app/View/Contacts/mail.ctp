<?php 

echo $this->element('actions',array(
		'actions' => $actions 
));

?>

<script type="text/javascript">
	$(document).ready(function() {
		//Gleiche die Breite der Textarea mit der des Empfängerfeldes an
		var width = $("#MailMailTo").width();
		$("#MailContent").width(width);
		$("#MailContent").height(120);

		//Versehe den Button "Felder leeren" mit einer Funktion
		$("#clear-fields").click(function() {
			$("#MailMailTo").val("");
			$("#MailContent").val("");
		});	
		
	});
</script>

	<h2>Email verschicken</h2>
	<p> 
	Hier können Sie E-Mails an alle Mitarbeiter der Cafeteria versenden. E-Mail-Adressen, welche nicht einem Mitarbeiter in der Cafeteria zugeordnet werden
	können, werden nicht akzeptiert. Sie können als Empfänger sowohl den <b>Benutzernamen</b>, als auch eine gültige <b>E-Mail-Adresse</b> angeben.
	
	<?php
	//Nur für Admins sichtbar:
	if (AuthComponent::user('id') && AuthComponent::user('admin')) {
		echo 'Um eine E-Mail an alle Mitarbeiter zu versenden, wählen Sie bitte die Option "Rundmail verschicken" in der Seitenleiste.';	
	}
	?>
	</p>
	
	<p>
	Wenn Sie E-Mails an mehrere Mitarbeiter versenden wollen, so trennen Sie bitte deren Namen bzw. Mail-Adressen mit einem <b>Semikolon(;)</b>.
	</p>
	
	<br>
	<?php echo "<legend>E-Mail versenden</legend>"; ?>
	<?php echo $this->Form->create('Mail',array(
			'type' => 'post',
			'url' => array('controller' => 'contacts', 'action' => 'mail'),
			'inputDefaults' => array(
					'div' => 'control-group',
					'label' => array(
							'class' => 'control-label'
					 ),
			'class' => 'well form-horizontal')
			)); ?>
		<?php echo $this->Form->input('mailTo',array(
				'placeholder' => 'Empfänger eingeben',
				'div' => 'control-group',
				'class' => 'input-xxlarge',
				'label' => array(
						'text' => 'An:',
					),
				'value' => $receiver,
				'beforeInput' => '<div class="input-prepend"><span class="add-on"><i class="icon-envelope"></i></span>',
				'afterInput' => '</div>'
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
				'placeholder' => 'Bitte geben Sie den zu versendenden Text ein',
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
