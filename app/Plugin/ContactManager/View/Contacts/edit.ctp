<h1>Edit Contact</h1>
<?php 
	echo $this->Form->create('Contact');

	echo $this->Form->input('name');
	echo $this->Form->input('contact_number');	 

	echo $this->Form->end('Update');
?>
