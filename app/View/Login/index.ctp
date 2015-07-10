<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?php echo 'Bitte Benutzername und Passwort eingeben'; ?>
        </legend>
    	<?php 
	        echo $this->Form->input('username', array('label' => array('text' => 'Benutzername'), 'placeholder' => 'Benutzername'));
        	echo $this->Form->input('password', array('label' => array('text' => 'Passwort'), 'placeholder' => 'Passwort'));
    	?>
    </fieldset>
<?php echo $this->Form->end('Login'); ?>
</div>
