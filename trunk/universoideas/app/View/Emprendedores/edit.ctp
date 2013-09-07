<div class="forums border">
    <?php echo $this->Form->create('Emprendedore'); ?>
            <fieldset>
                    <legend><?php echo __('Editar Emprendimiento'); ?></legend>
            <?php
                    echo $this->Form->input('id');
                    echo $this->Form->input('title', array('label' => 'Título'));
                    echo $this->Form->input('resume', array('label' => 'Resumen', 'type' => 'textarea'));
                    echo $this->Form->input('description', array('label' => 'Descripción', 'type' => 'textarea', 'rows' => '10'));
                    echo $this->Form->input('status', array('label' => 'Estatus', 'options' => $status));
            
                    echo '<div>Creado por: ' . $user_emp['User']['username'] . '</div>';
            ?>
            </fieldset>
    <?php echo $this->Form->end(__('Guardar')); ?>
</div>
