<div class="cursos form">
<?php echo $this->Form->create('Curso', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
    <legend><?php echo __('Crear Curso'); ?></legend>
    <?php
        echo $this->Form->input('Curso.name');
        echo $this->Form->input('Curso.description');
        echo $this->Form->input('Curso.date');
        echo $this->Form->input('Curso.upload', array('type' => 'file', 'label' => 'Seleccione Imagen', 'onchange' => 'validateInputFile(this)'));
        echo $this->Form->input('Curso.enabled');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Acciones'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Listar Cursos'), array('action' => 'index')); ?></li>
    </ul>
</div>
