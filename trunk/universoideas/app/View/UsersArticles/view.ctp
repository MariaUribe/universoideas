<div class="usersArticles view">
<h2><?php  echo __('Users Article'); ?></h2>
	<dl>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($usersArticle['User']['id'], array('controller' => 'users', 'action' => 'view', $usersArticle['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Article'); ?></dt>
		<dd>
			<?php echo $this->Html->link($usersArticle['Article']['id'], array('controller' => 'articles', 'action' => 'view', $usersArticle['Article']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Users Article'), array('action' => 'edit', $usersArticle['UsersArticle']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Users Article'), array('action' => 'delete', $usersArticle['UsersArticle']['id']), null, __('Are you sure you want to delete # %s?', $usersArticle['UsersArticle']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users Articles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users Article'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articles'), array('controller' => 'articles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article'), array('controller' => 'articles', 'action' => 'add')); ?> </li>
	</ul>
</div>
