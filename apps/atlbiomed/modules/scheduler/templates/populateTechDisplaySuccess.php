<?php use_helper('Javascript'); ?>

<?php echo input_hidden_tag('schedule_date'); ?>
<div id="techInfo">
	<div id="techMenu" style="padding: 4px">
         
		<?php  echo "<span  style='height: 100%; display:table-cell;'>"; echo link_to_function('All', "selectTechSchedule('all')"); echo "</span>";
               
			foreach($tech_info as $tech)
			{
				echo "<span  style='padding-top: 0px; height: 20px; display:table-cell;' id = 'tech_id_".$tech->getId()."'>";
				echo link_to_function($tech->getFirstName().' '.$tech->getLastName(), "selectTechSchedule(".$tech->getId().")");
				echo "</span>";	
			}
                 
		?>
        
	</div>
	<div class="techSchedule">
	<?php
	$techCount = 0;
 
 	foreach($schedules as $schedule)
 	{
		$techCount++;

 		include_partial('global/technicianSchedule', array('schedule' => $schedule, 'workorderCallbackFunction' => 'populateWorkorder'));

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

