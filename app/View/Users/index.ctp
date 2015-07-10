<?php echo $this->element('actions', array( 'actions' => $actions)); ?>
	<?php echo $this->Form->create('User'); ?>
	<h2><?php echo 'Benutzerverwaltung'; ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
	<tr>
			<th><?php echo $this->Paginator->sort('username', 'Name'); ?></th>
			<th><?php echo $this->Paginator->sort('leave_date', 'Aktiv'); ?></th>
			<th><?php echo $this->Paginator->sort('admin', 'Rechte'); ?></th>
			<th class="actions"><?php echo 'Aktionen'; ?></th>
	</tr>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['username']." (".$user['User']['fname']." ".$user['User']['lname'].")"); ?>&nbsp;</td>
		<td><?php echo $this->Form->input('leave_date', array('type' => 'checkbox', 'label' => array('text' =>  ($user['User']['leave_date'] == null) ? "(noch aktiv)" : "inaktiv seit dem ".date('d. m. Y', strtotime($user['User']['leave_date'])))  , 'checked' => $user['User']['leave_date'] == null, 'name' => "data[User][".$user['User']['id']."][leave_date]", 'id' => "Userleave_date".$user['User']['id'])); ?> </td>
		<?php $options = array(0 => 'Mitarbeiter', 1 => 'Administrator', 2 => 'Programmierer'); ?>
		<td><?php echo $this->Form->input('admin', array('type' => 'select', 'options' => $options,'label' => '', 'value' => $user['User']['admin'], 'checked' => $user['User']['admin'], 'name' => "data[User][".$user['User']['id']."][admin]", 'id' => "UserAdmin".$user['User']['id']."", 'align' => 'right')); ?></td>

		<td class="actions">
			<!--<?php echo $this->Html->link('Anzeigen', array('action' => 'view', $user['User']['id'])); ?>-->
			<?php echo $this->Html->link(' Editieren', array('action' => 'edit', $user['User']['id'])); ?>
			&nbsp;|&nbsp;
			<?php echo $this->Html->link(' Löschen', array('action' => 'delete', $user['User']['id']), null, 'Wollen Sie wirklich den Benutzer "'.$user['User']['username'].'" löschen?'); ?>
		</td>
	</tr>
<?php	 endforeach; ?>
	</table>
	
	<?php 
// 	echo $this->Form->input('Änderungen zurücksetzen', array('type' => 'button', 'onClick' => "window.location.href='.'", 'label' => false));
	echo $this->Form->end('Änderungen speichern'); 
	?>
	<!-- <div class="p">  -->
	<?php
		//echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		//echo $this->Paginator->numbers(array('separator' => ''));
		//echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		echo $this->Paginator->pagination(array('div' => 'pagination'));
	?>
	<!--</div>   -->
	</div>
</div>
