<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body>

<div class="header">
	<div class="logo_wrapper">
		<div class="logo">
			<?php echo image_tag('logo.png'); ?>
		</div>
	</div>
	<div class="menu">
		<div class="menuCommands">
			<?php echo link_to('Scheduler', 'scheduler/index'); ?>&nbsp;&nbsp;|&nbsp;&nbsp;
			<?php echo link_to('Workorders', 'workOrder/index'); ?>&nbsp;&nbsp;|&nbsp;&nbsp;
			<?php echo link_to('Maps', 'maps/index'); ?>&nbsp;&nbsp;|&nbsp;&nbsp;
			<?php echo link_to('Clients', 'clientManager/index'); ?>&nbsp;&nbsp;|&nbsp;&nbsp;
			<?php echo link_to('Users', 'userManager/index'); ?>&nbsp;&nbsp;|&nbsp;&nbsp;
			<?php echo link_to('Messages', "messages/index"); ?>&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="http://accella.unfuddle.com/" target="_blank">Support</a>&nbsp;&nbsp;|&nbsp;&nbsp;
			<?php echo link_to('Process', "process/index"); ?>&nbsp;&nbsp;|&nbsp;&nbsp;
                        <a href='https://mail.google.com/a/atlanticbiomedical.com' target='_blank'> Email </a>&nbsp;&nbsp;|&nbsp;&nbsp;
			<?php echo link_to('Logout', 'security/logout'); ?>
		</div>
	</div>
</div>

<!-- <div class="content"> -->
<?php echo $sf_data->getRaw('sf_content') ?>
<!-- </div> -->

<div class="footer">

		<?php echo link_to('Scheduler', 'scheduler/index'); ?>&nbsp;&nbsp;|&nbsp;&nbsp;
		<?php echo link_to('Workorders', 'workOrder/index'); ?>&nbsp;&nbsp;|&nbsp;&nbsp;
		<?php echo link_to('Maps', 'maps/index'); ?>&nbsp;&nbsp;|&nbsp;&nbsp;
		<?php echo link_to('Clients', 'clientManager/index'); ?>&nbsp;&nbsp;|&nbsp;&nbsp;
		<?php echo link_to('Users', 'userManager/index'); ?>&nbsp;&nbsp;|&nbsp;&nbsp;
		<?php echo link_to('Messages', 'http://abc.accella.net/messages/index.html'); ?>&nbsp;&nbsp;|&nbsp;&nbsp;
		<?php echo link_to('Support', 'http://www.ciphent.com/bugtracker'); ?>&nbsp;&nbsp;<br/><br/>
		&copy; Copyright Atlantic Biomedical 2007
</div>
</body>
</html>
