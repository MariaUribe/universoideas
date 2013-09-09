<div class="enterprises border">
<?php echo $this->Form->create('Enterprise'); ?>
    <fieldset>
        <legend><?php echo __('Editar Empresa'); ?></legend>
        <?php
            echo $this->Form->input('id');
            echo $this->Form->input('enterprise', array('label' => 'Empresa'));
            echo $this->Form->input('email', array('label' => 'Correo'));
            echo $this->Form->input('description', array('label' => 'Cargo/Funciones', 'type' => 'textarea', 'rows' => '4', 'maxlength' => 1500));
            echo $this->Form->input('duration', array('label' => 'Duración'));
            echo $this->Form->input('enabled', array('label' => 'Habilitado'));
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>