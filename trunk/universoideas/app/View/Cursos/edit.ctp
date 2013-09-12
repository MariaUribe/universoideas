<div class="cursos border">
<?php echo $this->Form->create('Curso', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
    <legend><?php echo __('Editar Curso'); ?></legend>
    <?php
        echo $this->Form->input('Curso.id');
        echo $this->Form->input('Curso.name', array('label' => 'Nombre', 'maxlength' => '150'));
        echo $this->Form->input('Curso.description', array('label' => 'Descripción', 'type' => 'textarea', 'rows' => '10'));
        echo $this->Form->input('Curso.date', array('label' => 'Fecha'));
        echo $this->Form->input('Curso.upload', array('type' => 'file', 'label' => 'Seleccione Imagen', 'onchange' => 'validateInputFile(this)'));
        
        $image_thumb = "";
        $image_thumb = $this->Form->value('Curso.image');
        
        if($image_thumb != "")
            echo $this->Html->image($image_thumb, array('width' => 200));
        
        echo $this->Form->input('Curso.enabled', array('label' => 'Habilitado'));
        
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>