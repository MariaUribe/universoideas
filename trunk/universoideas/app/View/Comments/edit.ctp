<div class="comments border">
<?php echo $this->Form->create('Comment'); ?>
	<fieldset>
        <legend><?php echo __('Editar Comentario'); ?></legend>
        <h3><?php echo $comment['Forum']['title']; ?></h3>

	<?php   
            echo $this->Form->input('forum_id', array('type' => 'hidden')); 
            echo $this->Form->input('id');
            echo $this->Form->input('description', array('label' => 'Descripción', 'type', 'textarea', 'cols' => 58, 'rows' => 12, 'maxlength' => 1500));
            echo $this->Form->input('user_id', array('type' => 'hidden'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Acciones'); ?></h3>
    <ul>
        <li><?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $this->Form->value('Comment.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Comment.id'))); ?></li>
    </ul>
</div>
