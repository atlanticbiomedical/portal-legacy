<?php use_helper('Javascript') ?>

<div id="<?php echo $uniqueId; ?>Header" class="collapsingPanelHeader">
	<?php echo $title; ?>
</div>
<div id="<?php echo $uniqueId; ?>Content" class="collapsingPanelContent">
	<?php echo $content; ?>
</div>
<?php 
echo javascript_tag("

	Event.observe($('" . $uniqueId . "Header'), 'click', show" . $uniqueId . ", true);

	var is" . $uniqueId . "Showing = 1;
	
	function show" . $uniqueId . "(e)
	{
		if (is" . $uniqueId . "Showing)
			" . visual_effect('blindUp', $uniqueId . 'Content') . "
		else
			" . visual_effect('blindDown', $uniqueId . 'Content') . "
			
		is" . $uniqueId . "Showing = !is" . $uniqueId . "Showing;
	}
");
?>
