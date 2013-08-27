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
<div class="actions">
    <h3><?php echo __('Acciones'); ?></h3>
    <ul>
        <li><?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $this->Form->value('Enterprise.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Enterprise.id'))); ?></li>
    </ul>
</div>
