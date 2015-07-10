<script type="text/javascript">
	$(document).ready(function() {
		var navListWidth = $("#navlist").css('width');
		$("#navlist").css('width',navListWidth);
		$("#navlist").affix();
	});
</script>
<div id='navlist-div' class="span2">
	<div id="navlist" class="well sidebar-nav">
		<ul class="nav nav-list">
		<li class="nav-header">Aktionen</li>
		<?php foreach($actions as $action){ 
			echo "<li>";
			echo $this->Html->link($action['text'],(isset($action['params']) ? $action['params'] : '#'),(isset($action['htmlattributes'])) ? $action['htmlattributes'] : array());
			echo "</li>";			
		}
		?>
		<li class="nav-header">
			Statische Aktionen
		</li>
		<?php
		
		if (AuthComponent::user('id')) {
			echo "<li>";
			echo $this->Html->link('Logout',array(
				'controller' => 'login',
				'action' => 'logout'	
				));
			echo "</li>";
		}
		?>
		</ul>	
	</div>
</div>
<div class="span9">
