<div class="members form">
<?php echo $this->Form->create('Member', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Add Member'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('role', array('type' => 'hidden', 'value' => 'member'));
		echo $this->Form->input('name');
		echo $this->Form->input('gender', array('type' => 'radio', 'options' => $genders));
		echo $this->Form->input('education', array('type' => 'select', 'options' => $educations));
		echo $this->Form->input('avatar1' ,array('type' => 'file'));
		echo $this->Form->input('avatar2' ,array('type' => 'file'));
		echo $this->Form->input('avatar3' ,array('type' => 'file'));
		echo $this->Form->input('avatar4' ,array('type' => 'file'));
		echo $this->Form->input('address');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Members'), array('action' => 'index')); ?></li>
	</ul>
</div>
