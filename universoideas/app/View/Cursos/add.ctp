<div class="cursos border">
<?php echo $this->Form->create('Curso', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
    <legend><?php echo __('Crear Curso'); ?></legend>
    <?php
        echo $this->Form->input('Curso.name', array('label' => 'Nombre', 'maxlength' => '150'));
        echo $this->Form->input('Curso.category', array('label' => 'Categoría'));
        echo $this->Form->input('Curso.description', array('label' => 'Descripción', 'type' => 'textarea', 'rows' => '10', 'class' => 'ckeditor'));
        echo $this->Form->input('Curso.date', array('label' => 'Fecha de Inicio'));
        echo $this->Form->input('Curso.end_date', array('label' => 'Fecha de Fin'));
        echo $this->Form->input('Curso.upload', array('type' => 'file', 'label' => 'Seleccione Imagen', 'onchange' => 'validateInputFile(this)'));
        echo $this->Form->input('Curso.enabled', array('label' => 'Habilitado'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>