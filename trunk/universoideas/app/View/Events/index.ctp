<div class="events index">
    <h2><?php echo __('Eventos'); ?></h2>
    <h3><?php echo __('Manejo de eventos en la sección de calendario.'); ?></h3><br>

    <table cellpadding="0" cellspacing="0">
	<tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('name', 'Nombre'); ?></th>
            <th><?php echo $this->Paginator->sort('place', 'Lugar'); ?></th>
            <th class="w130 tac"><?php echo $this->Paginator->sort('event_date', 'Fecha'); ?></th>
            <th class="w80"><?php echo $this->Paginator->sort('init_time', 'Hora Inicio'); ?></th>
            <th class="w80"><?php echo $this->Paginator->sort('end_time', 'Hora Fin'); ?></th>
            <th><?php echo $this->Paginator->sort('enabled', 'Habilitado'); ?></th>
            <th class="w130 tac"><?php echo $this->Paginator->sort('created', 'Creado'); ?></th>
            <th class="w130 tac"><?php echo $this->Paginator->sort('modified', 'Modificado'); ?></th>
            <th class="actions tac"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($events as $event): ?>
        <?php 
            $date = $this->Time->format('D-F-j-Y-h:i A', $event['Event']['event_date']);
            list($dia_s, $mes, $dia, $ano) = explode('-', $date);
            
            $date_created = $this->Time->format('D-F-j-Y-h:i A', $event['Event']['created']);
            list($dia_sem_crea, $mes_crea, $dia_crea, $ano_crea, $hora_crea) = explode('-', $date_created);
            
            $date_modified = $this->Time->format('D-F-j-Y-h:i A', $event['Event']['modified']);
            list($dia_sem_mod, $mes_mod, $dia_mod, $ano_mod, $hora_mod) = explode('-', $date_modified);
        ?>
	<tr>
            <td><?php echo h($event['Event']['id']); ?>&nbsp;</td>
            <td><?php echo h($event['Event']['name']); ?>&nbsp;</td>
            <td><?php echo h($event['Event']['place']); ?>&nbsp;</td>
            <td><?php echo __($dia_s) . " " . __($mes) . " " . __($dia) . ", " . __($ano) ?>&nbsp;</td>
            <td><?php echo h($event['Event']['init_time']); ?>&nbsp;</td>
            <td><?php echo h($event['Event']['end_time']); ?>&nbsp;</td>
            <td class="tac"><?php echo h(($event['Event']['enabled']==1?"SI":"NO")); ?>&nbsp;</td>
            <td><?php echo __($dia_sem_crea) . " " . __($mes_crea) . " " . __($dia_crea) . ", " . __($ano_crea) . " " . $hora_crea?>&nbsp;</td>
            <td><?php echo __($dia_sem_mod) . " " . __($mes_mod) . " " . __($dia_mod) . ", " . __($ano_mod) . " " . $hora_mod ?>&nbsp;</td>
            <td class="actions">
                <?php echo '<a href="/pages/event?id=' . $event['Event']['id'] . '">Ver</a>'; ?>
                <?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $event['Event']['id'])); ?>
                <?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $event['Event']['id']), null, __('Are you sure you want to delete # %s?', $event['Event']['id'])); ?>
            </td>
	</tr>
        <?php endforeach; ?>
    </table>
	<p>
	<?php
            echo $this->Paginator->counter(array('format' => __('Página {:page} de {:pages}, mostrando {:current} eventos de {:count} total')
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
