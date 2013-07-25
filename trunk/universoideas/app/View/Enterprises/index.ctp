<div class="enterprises index">
	<h2><?php echo __('Empresas'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
<!--			<th><php echo $this->Paginator->sort('id'); ?></th>-->
			<th><?php echo $this->Paginator->sort('enterprise', 'Empresa'); ?></th>
			<th><?php echo $this->Paginator->sort('email', 'Correo'); ?></th>
			<th><?php echo $this->Paginator->sort('description', 'Cargo/Funciones'); ?></th>
			<th><?php echo $this->Paginator->sort('duration', 'Duración'); ?></th>
			<th><?php echo $this->Paginator->sort('enabled', 'Habilitado'); ?></th>
			<th><?php echo $this->Paginator->sort('created', 'Creado'); ?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Modificado'); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($enterprises as $enterprise): ?>
	<tr>
<!--		<td><php echo h($enterprise['Enterprise']['id']); ?>&nbsp;</td>-->
		<td><?php echo h($enterprise['Enterprise']['enterprise']); ?>&nbsp;</td>
		<td><?php echo h($enterprise['Enterprise']['email']); ?>&nbsp;</td>
		<td><?php echo h($enterprise['Enterprise']['description']); ?>&nbsp;</td>
		<td><?php echo h($enterprise['Enterprise']['duration']); ?>&nbsp;</td>
		<td><?php echo h($enterprise['Enterprise']['enabled']); ?>&nbsp;</td>
		<td><?php echo h($enterprise['Enterprise']['created']); ?>&nbsp;</td>
		<td><?php echo h($enterprise['Enterprise']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $enterprise['Enterprise']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $enterprise['Enterprise']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $enterprise['Enterprise']['id']), null, __('Are you sure you want to delete # %s?', $enterprise['Enterprise']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página {:page} de {:pages}, mostrando {:current} empresas de {:count} total')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('anterior'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('siguiente') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
