<div class="forums border">
<?php echo $this->Form->create('Forum'); ?>

    <legend><?php echo __('Publicar un nuevo tema'); ?></legend>
    <?php
        echo $this->Form->input('Forum.title', array('label' => 'Asunto'));
        echo $this->Form->input('Forum.content', array('label' => 'Contenido', 'type' => 'textarea'));
//	echo $this->Form->input('Forum.enabled', array('label' => 'Habilitado'));
    ?>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>