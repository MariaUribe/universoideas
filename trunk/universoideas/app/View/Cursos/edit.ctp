<div class="cursos border">
<?php echo $this->Form->create('Curso', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
    <legend><?php echo __('Editar Curso'); ?></legend>
    <?php
        echo $this->Form->input('Curso.id');
        echo $this->Form->input('Curso.name', array('label' => 'Nombre'));
        echo $this->Form->input('Curso.description', array('label' => 'Descripción', 'type' => 'textarea', 'rows' => '10'));
        echo $this->Form->input('Curso.date', array('label' => 'Fecha'));
        echo $this->Form->input('Curso.upload', array('type' => 'file', 'label' => 'Seleccione Imagen', 'onchange' => 'validateInputFile(this)'));
        
        $image_thumb = "";
        $image_thumb = $this->Form->value('Curso.image');
        
        if($image_thumb != "")
            echo $this->Html->image($image_thumb);
        
        echo $this->Form->input('Curso.enabled', array('label' => 'Habilitado'));
        
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Acciones'); ?></h3>
    <ul>
        <li><?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $this->Form->value('Curso.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Curso.id'))); ?></li>
    </ul>
</div>
