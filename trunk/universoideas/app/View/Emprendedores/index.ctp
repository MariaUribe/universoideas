<div class="emprendedores index">
	<h2><?php echo __('Publicaciones de Emprendimiento'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th width="200px"><?php echo $this->Paginator->sort('title', 'Título'); ?></th>
			<th><?php echo $this->Paginator->sort('description', 'Resumen'); ?></th>
			<th width="80px"><?php echo $this->Paginator->sort('status', 'Estatus'); ?></th>
			<th width="120px"><?php echo $this->Paginator->sort('created', 'Creado'); ?></th>
			<th width="120px"><?php echo $this->Paginator->sort('modified', 'Modificado'); ?></th>
			<th width="80px"><?php echo $this->Paginator->sort('user_id', 'Usuario'); ?></th>
			<th class="actions tac"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($emprendedores as $emprendedore): ?>
        <?php 
            $date_created = $this->Time->format('D-F-j-Y-h:i A', $emprendedore['Emprendedore']['created']);
            list($dia_sem_crea, $mes_crea, $dia_crea, $ano_crea, $hora_crea) = explode('-', $date_created);
            
            $date_modified = $this->Time->format('D-F-j-Y-h:i A', $emprendedore['Emprendedore']['modified']);
            list($dia_sem_mod, $mes_mod, $dia_mod, $ano_mod, $hora_mod) = explode('-', $date_modified);
        ?>
        <?php 
            $status = "";
                
            if ($emprendedore['Emprendedore']['status'] === "PA")
                $status = "Por Aprobar";
            else if ($emprendedore['Emprendedore']['status'] === "AP")
                $status = "Aprobado";
            else
                $status = "Rechazado";
        ?>
        
	<tr>
		<td><?php echo h($emprendedore['Emprendedore']['id']); ?>&nbsp;</td>
		<td><?php echo h($emprendedore['Emprendedore']['title']); ?>&nbsp;</td>
		<td><?php echo h($emprendedore['Emprendedore']['resume']); ?>&nbsp;</td>
		<td><?php echo $status; ?>&nbsp;</td>
		<td><?php echo __($dia_sem_crea) . " " . __($mes_crea) . " " . __($dia_crea) . ", " . __($ano_crea) .  " " . $hora_crea ?>&nbsp;</td>
                <td><?php echo __($dia_sem_mod) . " " . __($mes_mod) . " " . __($dia_mod) . ", " . __($ano_mod) .  " " . $hora_mod ?>&nbsp;</td>
                <td>
			<?php echo $this->Html->link($emprendedore['User']['username'], array('controller' => 'users', 'action' => 'view', $emprendedore['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $emprendedore['Emprendedore']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $emprendedore['Emprendedore']['id'])); ?>
			<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $emprendedore['Emprendedore']['id']), null, __('¿Estás seguro que deseas eliminar el emprendimiento # %s?', $emprendedore['Emprendedore']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
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