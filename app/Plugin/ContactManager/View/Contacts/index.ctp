
<h1>Contacts</h1>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th>Name</th>
		<th>Number</th>
		<th>Created</th>
		<th>Modified</th>
	</tr>
	<?php foreach ($contacts as $contact): ?>
	<tr>
		<td><?php echo $contact['Contact']['name']; ?></td>
		<td><?php echo $contact['Contact']['contact_number']; ?></td>
		<td><?php echo $contact['Contact']['created']; ?></td>
		<td><?php echo $contact['Contact']['modified']; ?></td>
	</tr>
	<?php endforeach;?>
</table>
