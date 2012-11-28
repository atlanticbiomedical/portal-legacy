<h2>Administrative Contacts</h2>

<?php
	foreach($administrator as $admin)
	{ 
		echo $admin->getLastName().', '.$admin->getFirstName().' - '.mail_to($admin->getEmail(), $admin->getEmail(), 'encode=true');
		?><br /><?
	}
?>
<br />
<h2>Bug Reporting</h2>
Hepner, Nicholas - <?php echo mail_to('nicholas.hepner@ciphent.com', 'nicholas.hepner@ciphent.com'); ?>


