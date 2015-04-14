<div class="enterprises border">
<?php echo $this->Form->create('Enterprise'); ?>
    <fieldset>
        <legend><?php echo __('Crear Empresa'); ?></legend>
        <h3><?php echo __('Sección para crear empresas buscando pasantes'); ?></h3><br>
        <?php
            echo $this->Form->input('enterprise', array('label' => 'Empresa', 'maxlength' => '150'));
            echo $this->Form->input('email', array('label' => 'Correo'));
            echo $this->Form->input('description', array('label' => 'Cargo/Funciones', 'type' => 'textarea', 'rows' => '4', 'maxlength' => 1500, 'class' => 'ckeditor'));
            echo $this->Form->input('duration', array('label' => 'Duración'));
            echo $this->Form->input('enabled', array('label' => 'Habilitado'));
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
