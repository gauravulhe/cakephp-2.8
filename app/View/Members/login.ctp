<div class="members form">
<?php echo $this->Session->flash(); ?>
<?php echo $this->Form->create('Member'); ?>
	<fieldset>
		<legend><?php echo __('Login'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Members'), array('action' => 'index')); ?></li>
	</ul>
</div>
