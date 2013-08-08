<div class="events border">
<?php echo $this->Form->create('Event', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
    <legend><?php echo __('Editar Evento'); ?></legend>
    <?php
        echo $this->Form->input('Event.id');
        echo $this->Form->input('Event.name', array('label' => 'Nombre'));
        echo $this->Form->input('Event.description', array('label' => 'Descripción'));
        echo $this->Form->input('Event.place', array('label' => 'Lugar'));
        echo $this->Form->input('Event.event_date', array('label' => 'Fecha'));
        echo $this->Form->input('Event.init_time', array('label' => 'Hora Inicio'));
        echo $this->Form->input('Event.end_time', array('label' => 'Hora Fin'));
        echo $this->Form->input('Event.upload', array('type' => 'file', 'label' => 'Seleccione Imagen', 'onchange' => 'validateInputFile(this)'));
        
        $image_thumb = "";
        $image_thumb = $this->Form->value('Event.image');
        
        if($image_thumb != "")
            echo $this->Html->image($image_thumb);
        
        echo $this->Form->input('Event.enabled', array('label' => 'Habilitado'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Acciones'); ?></h3>
    <ul>
        <li><?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $this->Form->value('Event.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Event.id'))); ?></li>
    </ul>
</div>
