<div class="forums index">
    <h2><?php echo __('Temas'); ?></h2>
    <table cellpadding="0" cellspacing="0">
	<tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('title', 'Asunto'); ?></th>
            <th class="tac"><?php echo $this->Paginator->sort('title', 'Respuestas'); ?></th>
            <th><?php echo $this->Paginator->sort('enabled', 'Habilitado'); ?></th>
            <th><?php echo $this->Paginator->sort('created', 'Creado'); ?></th>
            <th><?php echo $this->Paginator->sort('modified', 'Modificado'); ?></th>
            <th><?php echo $this->Paginator->sort('user_id', 'Usuario'); ?></th>
            <th class="actions tac"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($forums as $forum): ?>
        <?php 
            $date_created = $this->Time->format('D-F-j-Y-h:i A', $forum['Forum']['created']);
            list($dia_sem_crea, $mes_crea, $dia_crea, $ano_crea, $hora_crea) = explode('-', $date_created);
            
            $date_modified = $this->Time->format('D-F-j-Y-h:i A', $forum['Forum']['modified']);
            list($dia_sem_mod, $mes_mod, $dia_mod, $ano_mod, $hora_mod) = explode('-', $date_modified);
        ?>
	<tr>
            <td><?php echo h($forum['Forum']['id']); ?>&nbsp;</td>
            <td><?php echo h($forum['Forum']['title']); ?>&nbsp;</td>
            <td class="tac"><?php echo h($forum['Forum']['count']); ?>&nbsp;</td>
            <td class="tac"><?php echo h(($forum['Forum']['enabled']==1?"SI":"NO")); ?>&nbsp;</td>
            <td><?php echo __($dia_sem_crea) . " " . __($mes_crea) . " " . __($dia_crea) . ", " . __($ano_crea) .  " " . $hora_crea ?>&nbsp;</td>
            <td><?php echo __($dia_sem_mod) . " " . __($mes_mod) . " " . __($dia_mod) . ", " . __($ano_mod) .  " " . $hora_mod ?>&nbsp;</td>
            <td>
                <?php echo $this->Html->link($forum['User']['name'], array('controller' => 'users', 'action' => 'view', $forum['User']['id'])); ?>
            </td>
            <td class="actions tac">
                <?php echo $this->Html->link(__('Ver Comentarios'), array('controller' => 'comments', 'action' => 'index?forum_id=' . $forum['Forum']['id'])); ?>
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
        ?>
    </p>
    <div class="paging">
	<?php
            echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
            echo $this->Paginator->numbers(array('separator' => ''));
            echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
    </div>
</div>