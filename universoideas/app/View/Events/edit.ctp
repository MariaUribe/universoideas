<div class="events form">
<?php echo $this->Form->create('Event', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
    <legend><?php echo __('Editar Evento'); ?></legend>
    <?php
        echo $this->Form->input('Event.id');
        echo $this->Form->input('Event.name');
        echo $this->Form->input('Event.place');
        echo $this->Form->input('Event.event_date');
        echo $this->Form->input('Event.init_time');
        echo $this->Form->input('Event.end_time');
        echo $this->Form->input('Event.image_thumb');
        echo $this->Form->input('Event.upload', array('type' => 'file', 'label' => 'Seleccione Imagen', 'onchange' => 'validateInputFile(this)'));
        
        $image_thumb = "";
        $image_thumb = $this->Form->value('Event.image');
        
        if($image_thumb != "")
            echo $this->Html->image($image_thumb);
        
        echo $this->Form->input('Event.enabled');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Acciones'); ?></h3>
    <ul>
        <li><?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $this->Form->value('Event.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Event.id'))); ?></li>
        <li><?php echo $this->Html->link(__('Listar Eventos'), array('action' => 'index')); ?></li>
    </ul>
</div>
