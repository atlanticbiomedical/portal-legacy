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
</div>

<!-- <div class="content"> -->
<?php echo $sf_data->getRaw('sf_content') ?>
<!-- </div> -->

</body>
</html>
