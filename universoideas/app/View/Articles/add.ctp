<div class="articles form">
<?php echo $this->Form->create('Article'); ?>
	<fieldset>
                <legend><?php echo __('Crear Artículo'); ?></legend>
	<?php
		echo $this->Form->input('Article.title', array('label' => 'Título'));
		echo $this->Form->input('Article.summary', array('label' => 'Sumario'));
		echo $this->Form->input('Article.body', array('label' => 'Cuerpo', 'type' => 'textarea'));
		echo $this->Form->input('Article.enabled', array('label' => 'Habilitado'));

	?>
                <h3><?php echo __('Asociar Imagen'); ?></h3>
        <?php 
                echo $this->Form->input('RelatedImage.uri', array('label' => 'Uri'));
		echo $this->Form->input('RelatedImage.width', array('label' => 'Width'));
		echo $this->Form->input('RelatedImage.height', array('label' => 'Height'));
        ?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar Artículos'), array('action' => 'index')); ?></li>
                <li><?php echo $this->Html->link(__('Listar Usuarios'), array('controller' => 'users', 'action' => 'index')); ?> </li>
                
		<li><?php echo $this->Html->link(__('List Related Images'), array('controller' => 'related_images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Related Image'), array('controller' => 'related_images', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Related Videos'), array('controller' => 'related_videos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Related Video'), array('controller' => 'related_videos', 'action' => 'add')); ?> </li>
		
	</ul>
</div>
