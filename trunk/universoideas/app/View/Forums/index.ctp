<div class="forums index">
	<h2><?php echo __('Foros'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
<!--			<th><php echo $this->Paginator->sort('id'); ?></th>-->
			<th><?php echo $this->Paginator->sort('title', 'Nombre'); ?></th>
			<th><?php echo $this->Paginator->sort('aproved', 'Aprobado'); ?></th>
			<th><?php echo $this->Paginator->sort('created', 'Creado'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id', 'Usuario'); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($forums as $forum): ?>
	<tr>
<!--		<td><php echo h($forum['Forum']['id']); ?>&nbsp;</td>-->
		<td><?php echo h($forum['Forum']['title']); ?>&nbsp;</td>
		<td><?php echo h($forum['Forum']['aproved']); ?>&nbsp;</td>
		<td><?php echo h($forum['Forum']['created']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($forum['User']['name'], array('controller' => 'users', 'action' => 'view', $forum['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $forum['Forum']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $forum['Forum']['id'])); ?>
			<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $forum['Forum']['id']), null, __('Are you sure you want to delete # %s?', $forum['Forum']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página {:page} de {:pages}, mostrando {:current} foros de {:count} total.')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>