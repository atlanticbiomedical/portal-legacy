
<?php use_helper('Javascript'); ?>

<?php echo input_hidden_tag('schedule_date'); ?>
<div id="techInfo">

	<div class="techSchedule">
	<?php
	$techCount = 0;
 	foreach($schedules as $schedule)
 	{
		$techCount++;

 		include_partial('global/technicianEmailSchedule', array('date'=>$date,'emailComment'=>$emailComment,'schedule' => $schedule, 'workorderCallbackFunction' => 'populateWorkorder','job_reason'=>$dropdowns));

 		if ($techCount % 5 == 0){
			echo '</div><div class="techSchedule">';
		}
 	}
 	?>
	</div>
	<div id="techMap" style="float:left">
		<iframe frameborder="0" id="techMapDisplay"></iframe>
	</div>
</div>

