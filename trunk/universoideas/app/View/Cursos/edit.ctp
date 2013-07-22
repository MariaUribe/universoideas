<div class="cursos form">
<?php echo $this->Form->create('Curso', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
    <legend><?php echo __('Editar Curso'); ?></legend>
    <?php
        echo $this->Form->input('Curso.id');
        echo $this->Form->input('Curso.name');
        echo $this->Form->input('Curso.description');
        echo $this->Form->input('Curso.date');
        echo $this->Form->input('Curso.upload', array('type' => 'file', 'label' => 'Seleccione Imagen', 'onchange' => 'validateInputFile(this)'));
        
        $image_thumb = "";
        $image_thumb = $this->Form->value('Curso.image');
        
        if($image_thumb != "")
            echo $this->Html->image($image_thumb);
        
        echo $this->Form->input('Curso.enabled');
        
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Acciones'); ?></h3>
    <ul>
        <li><?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $this->Form->value('Curso.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Curso.id'))); ?></li>
        <li><?php echo $this->Html->link(__('Listar Cursos'), array('action' => 'index')); ?></li>
    </ul>
</div>
