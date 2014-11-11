<div class="events border">
<?php echo $this->Form->create('Event', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
    <legend><?php echo __('Crear Evento'); ?></legend>
    <?php
        echo $this->Form->input('Event.name', array('label' => 'Nombre', 'maxlength' => '150'));
        echo $this->Form->input('Event.category', array('label' => 'Categoría'));
        echo $this->Form->input('Event.description', array('label' => 'Descripción', 'type' => 'textarea', 'rows' => '10', 'class' => 'ckeditor'));
        echo $this->Form->input('Event.place', array('label' => 'Lugar'));
        echo $this->Form->input('Event.event_date', array('label' => 'Fecha de Inicio'));
        echo $this->Form->input('Event.event_end_date', array('label' => 'Fecha de Fin'));
        echo $this->Form->input('Event.init_time', array('label' => 'Hora Inicio', 'class' => 'time'));
        echo $this->Form->input('Event.end_time', array('label' => 'Hora Fin', 'class' => 'time'));
        echo $this->Form->input('Event.upload', array('type' => 'file', 'label' => 'Seleccione Imagen', 'onchange' => 'validateInputFile(this)'));
        echo $this->Form->input('Event.enabled', array('label' => 'Habilitado'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>