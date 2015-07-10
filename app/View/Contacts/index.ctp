<?php echo $this->element('actions',array(
		'actions' => $actions));
?>
	<h2>Telefonliste</h2>
	<table cellpadding="0" cellspacing="0" class="table table-bordered" id="contactlist">
		<tr>
			<th><?php echo $this->Paginator->sort('lname','Nachname'); ?></th>
			<th><?php echo $this->Paginator->sort('fname','Vorname'); ?></th>
			<th><?php echo $this->Paginator->sort('tel1','Tel1'); ?></th>
			<th><?php echo $this->Paginator->sort('tel2','Tel2'); ?></th>
			<th><?php echo $this->Paginator->sort('mail','E-Mail'); ?></th>
			<th><?php echo $this->Paginator->sort('mo'); ?></th>
			<th><?php echo $this->Paginator->sort('di'); ?></th>
			<th><?php echo $this->Paginator->sort('mi'); ?></th>
			<th><?php echo $this->Paginator->sort('do'); ?></th>
			<th><?php echo $this->Paginator->sort('fr'); ?></th>
		</tr>
		<?php foreach($users as $user): ?>
		<?php $state = ($user['User']['leave_date'] == null) ? "activeUser" : "inactiveUser"; ?>
		<tr class="<?php echo $state?>">
			<td><?php echo h($user['User']['lname']); ?> &nbsp; </td>
			<td><?php echo h($user['User']['fname']); ?> &nbsp; </td>
			<td><?php echo h($user['User']['tel1']);  ?> &nbsp; </td>
			<td><?php echo h($user['User']['tel2']);  ?> &nbsp; </td>
			<td><i class="icon-envelope"></i>
				<?php echo $this->Html->link(h($user['User']['mail']),array(
						'controller' => 'contacts',
						'action' => 'mail',
						$user['User']['mail']
						)); ?>
			</td>
			
			<td class="<?php echo $user['User']['mo']['class']; ?>">
				<?php echo h($user['User']['mo']['value']); ?>
			</td>
			<td class="<?php echo $user['User']['di']['class']; ?>">
				<?php echo h($user['User']['di']['value']); ?> &nbsp;
			</td>
			<td class="<?php echo $user['User']['mi']['class']; ?>">
				<?php echo h($user['User']['mi']['value']); ?>
			</td>
			<td class="<?php echo $user['User']['do']['class']; ?>">
				<?php echo h($user['User']['do']['value']); ?>
			</td>
			<td class="<?php echo $user['User']['fr']['class']; ?>">
				<?php echo h($user['User']['fr']['value']); ?>
			</td>
		</tr>
		<?php endforeach;?>
	</table>
	<?php echo $this->Paginator->pagination(array('div' => 'pagination'));?>
</div>
