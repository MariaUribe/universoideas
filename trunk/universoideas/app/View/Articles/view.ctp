<div class="articles view">
<h2><?php  echo __('Artículo'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($article['Article']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Título'); ?></dt>
		<dd>
			<?php echo h($article['Article']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sumario'); ?></dt>
		<dd>
			<?php echo h($article['Article']['summary']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cuerpo'); ?></dt>
		<dd>
			<?php echo h($article['Article']['body']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Habilitado'); ?></dt>
		<dd>
			<?php echo h($article['Article']['enabled']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creado'); ?></dt>
		<dd>
			<?php echo h($article['Article']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($article['Article']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
            <li><?php echo $this->Html->link(__('Nuevo Artículo'), array('action' => 'add')); ?> </li>
            <li><?php echo $this->Html->link(__('Editar Artículo'), array('action' => 'edit', $article['Article']['id'])); ?> </li>
            <li><?php echo $this->Form->postLink(__('Borrar Artículo'), array('action' => 'delete', $article['Article']['id']), null, __('Are you sure you want to delete # %s?', $article['Article']['id'])); ?> </li>
            <li><?php echo $this->Html->link(__('Listar Artículos'), array('action' => 'index')); ?> </li>
        </ul>
</div>
<div class="related">
	<h3><?php echo __('Imagen Relacionada'); ?></h3>
	<?php if (!empty($article['RelatedImage'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Uri'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Uri Thumb'); ?></th>
		<th><?php echo __('Width'); ?></th>
		<th><?php echo __('Height'); ?></th>
		<th><?php echo __('Width Thumb'); ?></th>
		<th><?php echo __('Height Thumb'); ?></th>
		<th><?php echo __('Article Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($article['RelatedImage'] as $relatedImage): ?>
		<tr>
			<td><?php echo $relatedImage['id']; ?></td>
			<td><?php echo $relatedImage['uri']; ?></td>
			<td><?php echo $relatedImage['name']; ?></td>
			<td><?php echo $relatedImage['title']; ?></td>
			<td><?php echo $relatedImage['uri_thumb']; ?></td>
			<td><?php echo $relatedImage['width']; ?></td>
			<td><?php echo $relatedImage['height']; ?></td>
			<td><?php echo $relatedImage['width_thumb']; ?></td>
			<td><?php echo $relatedImage['height_thumb']; ?></td>
			<td><?php echo $relatedImage['article_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'related_images', 'action' => 'view', $relatedImage['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'related_images', 'action' => 'edit', $relatedImage['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'related_images', 'action' => 'delete', $relatedImage['id']), null, __('Are you sure you want to delete # %s?', $relatedImage['id'])); ?>
			</td>
		</tr>
                <tr>
                    <td colspan="6">
                        <?php echo $this->Html->image('/app/webroot/img/uploads/' . $relatedImage['name']); ?> 
                    </td>
                    <td colspan="5">
                        <?php echo $this->Html->image($relatedImage['uri_thumb']); ?> 
                    </td>
                </tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Related Image'), array('controller' => 'related_images', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Related Videos'); ?></h3>
	<?php if (!empty($article['RelatedVideo'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Source'); ?></th>
		<th><?php echo __('Article Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($article['RelatedVideo'] as $relatedVideo): ?>
		<tr>
			<td><?php echo $relatedVideo['id']; ?></td>
			<td><?php echo $relatedVideo['name']; ?></td>
			<td><?php echo $relatedVideo['source']; ?></td>
			<td><?php echo $relatedVideo['article_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'related_videos', 'action' => 'view', $relatedVideo['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'related_videos', 'action' => 'edit', $relatedVideo['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'related_videos', 'action' => 'delete', $relatedVideo['id']), null, __('Are you sure you want to delete # %s?', $relatedVideo['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Related Video'), array('controller' => 'related_videos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($article['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Lastname'); ?></th>
		<th><?php echo __('Mail'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($article['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['name']; ?></td>
			<td><?php echo $user['lastname']; ?></td>
			<td><?php echo $user['mail']; ?></td>
			<td><?php echo $user['created']; ?></td>
			<td><?php echo $user['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
