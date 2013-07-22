<div class="events form">
<?php echo $this->Form->create('Event', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
    <legend><?php echo __('Crear Evento'); ?></legend>
    <?php
        echo $this->Form->input('Event.name');
        echo $this->Form->input('Event.place');
        echo $this->Form->input('Event.event_date');
        echo $this->Form->input('Event.init_time');
        echo $this->Form->input('Event.end_time');
        echo $this->Form->input('Event.upload', array('type' => 'file', 'label' => 'Seleccione Imagen', 'onchange' => 'validateInputFile(this)'));
        echo $this->Form->input('Event.enabled');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Acciones'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Listar Eventos'), array('action' => 'index')); ?></li>
    </ul>
</div>