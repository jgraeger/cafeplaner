<h1>Installation</h1>

<p>
Bitte w&auml;hlen Sie die Installationsmethode:
</p>
<ul>
<li><a href="#" id="link_newdb">Ich m&ouml;chte eine neue, leere Datenbank anlegen</a></li>
<li><a href="#" id="link_olddb">Ich habe schon eine Datenbank und m&ouml;chte diese importieren</a></li>
</ul>
<script type="text/javascript">
$(document).ready(function() {

	$("#div_olddb").hide();
	$("#div_newdb").hide();

	$("#link_newdb").click( function() {
		$("#div_olddb").hide();
		$("#div_newdb").show();
	});

	$("#link_olddb").click( function () {
		$("#div_newdb").hide();
		$("#div_olddb").show();
	});
});
</script>



<?php require 'import.ctp'; ?>
<?php require 'create.ctp'; ?>