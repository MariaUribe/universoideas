<div class="events index">
    <h2><?php echo __('Eventos'); ?></h2>
    <table cellpadding="0" cellspacing="0">
	<tr>
<!--        <th><php echo $this->Paginator->sort('id'); ?></th>-->
            <th><?php echo $this->Paginator->sort('name', 'Nombre'); ?></th>
            <th><?php echo $this->Paginator->sort('place', 'Lugar'); ?></th>
            <th><?php echo $this->Paginator->sort('event_date', 'Fecha'); ?></th>
            <th><?php echo $this->Paginator->sort('init_time', 'Hora Inicio'); ?></th>
            <th><?php echo $this->Paginator->sort('end_time', 'Hora Fin'); ?></th>
<!--        <th><php echo $this->Paginator->sort('image'); ?></th>-->
            <th><?php echo $this->Paginator->sort('enabled', 'Habilitado'); ?></th>
            <th><?php echo $this->Paginator->sort('created', 'Creado'); ?></th>
            <th><?php echo $this->Paginator->sort('modified', 'Modificado'); ?></th>
            <th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($events as $event): ?>
	<tr>
<!--        <td><php echo h($event['Event']['id']); ?>&nbsp;</td>-->
            <td><?php echo h($event['Event']['name']); ?>&nbsp;</td>
            <td><?php echo h($event['Event']['place']); ?>&nbsp;</td>
            <td><?php echo h($event['Event']['event_date']); ?>&nbsp;</td>
            <td><?php echo h($event['Event']['init_time']); ?>&nbsp;</td>
            <td><?php echo h($event['Event']['end_time']); ?>&nbsp;</td>
<!--        <td><php echo h($event['Event']['image']); ?>&nbsp;</td>-->
            <td><?php echo h($event['Event']['enabled']); ?>&nbsp;</td>
            <td><?php echo h($event['Event']['created']); ?>&nbsp;</td>
            <td><?php echo h($event['Event']['modified']); ?>&nbsp;</td>
            <td class="actions">
                <?php echo $this->Html->link(__('View'), array('action' => 'view', $event['Event']['id'])); ?>
                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $event['Event']['id'])); ?>
                <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $event['Event']['id']), null, __('Are you sure you want to delete # %s?', $event['Event']['id'])); ?>
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
