<div class="members form">
<?php echo $this->Form->create('Member', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Edit Member'); ?></legend>
	<?php
		// echo $this->Form->input('id');
		// echo $this->Form->input('name');
		// echo $this->Form->input('gender');
		// echo $this->Form->input('education'); ?>
	<?php //echo $this->Html->image('/uploads/' . h($avatar), array('width' => '30')); ?>
	<?php 	
		// echo $this->Form->input('avatar');
		// echo $this->Form->input('address');
	?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('name');
		echo $this->Form->input('gender', array('type' => 'radio', 'options' => $genders));
		echo $this->Form->input('education', array('type' => 'select', 'options' => $educations)); 
		echo $this->Html->image('/uploads/' . h($avatar1), array('width' => '50'));
		echo $this->Form->input('avatar1_old' ,array('type' => 'hidden', 'value' => $avatar1)); 		
		echo $this->Form->input('avatar1' ,array('type' => 'file', 'novalidate' => true));

		echo $this->Html->image('/uploads/' . h($avatar2), array('width' => '50'));
		echo $this->Form->input('avatar2_old' ,array('type' => 'hidden', 'value' => $avatar2)); 		
		echo $this->Form->input('avatar2' ,array('type' => 'file', 'novalidate' => true));

		echo $this->Html->image('/uploads/' . h($avatar3), array('width' => '50'));
		echo $this->Form->input('avatar3_old' ,array('type' => 'hidden', 'value' => $avatar3)); 		
		echo $this->Form->input('avatar3' ,array('type' => 'file', 'novalidate' => true));

		echo $this->Html->image('/uploads/' . h($avatar4), array('width' => '50'));
		echo $this->Form->input('avatar4_old' ,array('type' => 'hidden', 'value' => $avatar4)); 		
		echo $this->Form->input('avatar4' ,array('type' => 'file', 'novalidate' => true));

		echo $this->Form->input('address');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Member.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Member.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Members'), array('action' => 'index')); ?></li>
	</ul>
</div>
