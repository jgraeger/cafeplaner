<div class="navbar navbar-inverse" id="ourNavbar">
	<div class="navbar-inner">
		<div class="container-fluid">
		<?php echo $this->Html->link('Cafeteria-Planer', '/', array('class' => 'brand')); ?>
		<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
     	</a>
		<div class="nav-collapse collapse">
		<ul class="nav">
		<?php 
		if (!AuthComponent::user('id')) {
			echo "<li class='active'>
					<a href='#'>Login</a>
			      </li>
			";
		} else {
// 			$active = $this->params['controller'];
// 			$aCtrlClasses = App::objects('controller');
// 			foreach ($aCtrlClasses as $controller) {
// 				if ($controller != "AppController" && $controller != "LoginController") {
// 					$controllerName = str_replace("Controller", "", $controller);
// 					$name = strtolower($controllerName);
// 					if ($active == $name) echo "<li class='active'>";  else  echo "<li>";				
// 					echo $this->Html->link($controllerName,array(
// 							'controller' => $name,
// 							'action' => 'index'
// 							));
// 					echo "</li>";
// 				}
// 			}
			
			$linksToPrint = array(
				'Plan' => array('admin' => false, 'controller' => 'plan', 'action' => 'index'),
				'Benutzerverwaltung' => array('admin' => true, 'controller' => 'users', 'action' => 'index'),
				'Kontaktliste' => array('admin' => false, 'controller' => 'contacts', 'action' => 'index'),
				'Rundmail' => array('admin' => true, 'controller' => 'mail', 'action' => 'index'),
				'Änderungsliste' => array('admin' => true, 'controller' => 'changelogs', 'action' => 'index'),
				'Statistik' => array('admin' => true, 'controller' => 'statistic', 'action' => 'index'),
				'Kontoverwaltung' => array('admin' => false, 'controller' => 'users', 'action' => 'edit'),
				'Sicherung' => array('admin' => true, 'controller' => 'backup', 'action' => 'index'),
				'Auto-Verwaltung' => array('admin' => true, 'controller' => 'auto', 'action' => 'index'),				
				'Spaltenverwaltung' => array('admin' => true, 'controller' => 'columns', 'action' => 'index'),
			);
?>
			
<?php 
			$active = $this->params['controller']."/".$this->params['action'];
			foreach ($linksToPrint as $name => $linkdata) {
				if ($active == $linkdata['controller']."/".$linkdata['action']) echo "<li class='active'>";
				else echo "<li>";
				
				if (($linkdata['admin'] && AuthComponent::user('id') && AuthComponent::user('admin')) || !$linkdata['admin']) {
					echo $this->Html->link($name, array('controller' => $linkdata['controller'], 'action' => $linkdata['action']));
				}
				
				echo "</li>";
			}
		}		
	?>
			</ul>
	<?php if ($this->Session->read('Auth.User')):?>
		<p class="navbar-text pull-right"> Eingeloggt als:
				<?php echo $this->Html->link(AuthComponent::user('username'), array('controller' => 'users', 'action' => 'edit'),array('id' => 'loggedInUserAnchor'));?>
			</p>
	<?php endif;?>
		</div>
		</div>
	</div>
</div>
