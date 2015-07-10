<script type="text/javascript">
window.onload = function () {
    document.getElementById("UserPassword").onchange = validatePassword;
    document.getElementById("UserPassword2").onchange = validatePassword;
    document.getElementById("UserFname").onchange = validatePassword;
}

function validatePassword(){
	var pass2=document.getElementById("UserPassword2").value;
	var pass1=document.getElementById("UserPassword").value;
	var fname=document.getElementById("UserFname").value;
	if(pass1!=pass2)
	    document.getElementById("UserPassword2").setCustomValidity(unescape("Passw%F6rter stimmen nicht %FCberein"));
	else
	    document.getElementById("UserPassword2").setCustomValidity('');  
	//empty string means no validation error

	if (pass1==fname) {
		document.getElementById("UserPassword").setCustomValidity('Ein Administrator darf seinen Vornamen nicht als Passwort verwenden');
	} else {
		document.getElementById("UserPassword").setCustomValidity('');
	}
		
}
</script>
<div id="div_newdb">
	<?php
	echo "<legend>Administrator anlegen</legend>";
	echo $this->Form->create('User', array('url' => array('controller' => 'install', 'action' => 'create')));
	echo $this->Form->input('username', array('label' => 'Nachname'));
	echo $this->Form->input('fname', array('label' => 'Vorname'));
	echo $this->Form->input('password', array('label' => 'Passwort'));
	echo $this->Form->input('password2', array('label' => 'Passwort wiederholen', 'type' => 'password'));
	echo $this->Form->submit('Installieren',array('class' => 'btn btn-primary'));
	echo $this->Form->end();
	?>
</div>
