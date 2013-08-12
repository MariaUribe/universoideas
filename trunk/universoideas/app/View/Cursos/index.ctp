<div class="cursos index">
    <h2><?php echo __('Cursos'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('name', 'Nombre'); ?></th>
            <th><?php echo $this->Paginator->sort('description', 'Descripción'); ?></th>
            <th><?php echo $this->Paginator->sort('date', 'Fecha'); ?></th>
            <th><?php echo $this->Paginator->sort('enabled', 'Habilitado'); ?></th>
            <th><?php echo $this->Paginator->sort('created', 'Creado'); ?></th>
            <th><?php echo $this->Paginator->sort('modified', 'Modificado'); ?></th>
            <th class="actions"><?php echo __('Acciones'); ?></th>
        </tr>
        <?php foreach ($cursos as $curso): ?>
        <?php 
            $date_created = $this->Time->format('D-F-j-Y-h:i A', $curso['Curso']['created']);
            list($dia_sem_crea, $mes_crea, $dia_crea, $ano_crea) = explode('-', $date_created);
            
            $date_modified = $this->Time->format('D-F-j-Y-h:i A', $curso['Curso']['modified']);
            list($dia_sem_mod, $mes_mod, $dia_mod, $ano_mod) = explode('-', $date_modified);
        ?>
        <tr>
            <td><?php echo h($curso['Curso']['id']); ?>&nbsp;</td>
            <td><?php echo h($curso['Curso']['name']); ?>&nbsp;</td>
            <td><?php echo h($curso['Curso']['description']); ?>&nbsp;</td>
            <td><?php echo h($curso['Curso']['date']); ?>&nbsp;</td>
            <td><?php echo h($curso['Curso']['enabled']); ?>&nbsp;</td>
            <td><?php echo __($dia_sem_crea) . " " . __($mes_crea) . " " . __($dia_crea) . ", " . __($ano_crea) ?>&nbsp;</td>
            <td><?php echo __($dia_sem_mod) . " " . __($mes_mod) . " " . __($dia_mod) . ", " . __($ano_mod) ?>&nbsp;</td>
            <td class="actions">
                <?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $curso['Curso']['id'])); ?>
                <?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $curso['Curso']['id']), null, __('Are you sure you want to delete # %s?', $curso['Curso']['id'])); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página {:page} de {:pages}, mostrando {:current} cursos de {:count} total')
	));
	?>
    </p>
    <div class="paging">
    <?php
        echo $this->Paginator->prev('< ' . __('anterior'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
    </div>
</div>