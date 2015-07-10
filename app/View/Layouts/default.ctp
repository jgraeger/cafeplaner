<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Humboldtgymnasium Berlin Tegel - Cafeteriaplaner');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>	
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('jquery-ui');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('bootstrap-responsive');
		echo $this->Html->css('glyphicons');
		echo $this->Html->script('jquery');
		echo $this->Html->script('jquery-ui');
		echo $this->Html->script('jquery-tap-min');
		echo $this->Html->script('bootstrap');
//		echo $this->Html->scirpt('typeahead');
		echo $this->Html->script('/CakeBootstrappifier/js/cakebootstrap');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<script type="text/javascript">
		$(window).resize(function() {
			$("#ourNavbar").width($(document).width());
		});

		$(window).ready(function() {
			$("#ourNavbar").width($(document).width());
		});
	</script>
</head>
<body>
	<?php echo $this->element('navbar'); ?>
	<div class="container-fluid">
		<div class="row-fluid">	
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>

		</div>
		<hr>
		<footer>
			<div class="modal hide fade" id="modal-impressum">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    			<h3>Impressum und Kontakt</h3>
    			</div>
   			 <div class="modal-body">
   				<p>Cafeteriadienstplan des Humboldt Gymnasium Berlin-Tegel <br/>
   				<a href="http://www.humboldtschule-berlin.de"><i>Zur Schulwebsite...</i></a>
   				</p>
   				<p><b>Kontakt:</b><br />
   					<i>Telefon:</i> 0157 84678757 <br />
   					<i>E-Mail-Adresse:</i> cafeteria-humboldtschule@web.de
   				</p>
   				<p><b>Realisiert von:</b> <br/>
   					<i>Alexander Löser</i> <br />
   					<i>Johannes Gräger</i> <br />
   					<i>Julius Brose</i>
   				</p>
    		</div>
   			  <div class="modal-footer">
   				<a href="#" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Schließen</a>
   			</div>
   	 	</div>
   	 	<a href="#modal-impressum" role="button" data-toggle="modal">Impressum anzeigen</a>
		</footer>
	</div>
</body>
</html>
