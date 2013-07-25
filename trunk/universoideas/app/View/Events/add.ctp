<div class="events border">
<?php echo $this->Form->create('Event', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
    <legend><?php echo __('Crear Evento'); ?></legend>
    <?php
        echo $this->Form->input('Event.name', array('label' => 'Nombre'));
        echo $this->Form->input('Event.place', array('label' => 'Lugar'));
        echo $this->Form->input('Event.event_date', array('label' => 'Fecha'));
        echo $this->Form->input('Event.init_time', array('label' => 'Hora Inicio'));
        echo $this->Form->input('Event.end_time', array('label' => 'Hora Fin'));
        echo $this->Form->input('Event.upload', array('type' => 'file', 'label' => 'Seleccione Imagen', 'onchange' => 'validateInputFile(this)'));
        echo $this->Form->input('Event.enabled', array('label' => 'Habilitado'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>