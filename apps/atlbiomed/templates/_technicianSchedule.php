<?php 
/*
 * Accepts the following parameters
 *  	$schedule: a TechnicianSchedule object
 *		$workorderCallbackFunction: a string representing a javascript function accepting 1 parameter
 */
 ?>
<div class="techTableWrapper">
<div class="tech-name" id="techSchedule_color_<?php echo $schedule->getTechnician ()->getId();?>"><?php $tech_name = $schedule->getTechnician ()->getFirstName () . ' ' . $schedule->getTechnician ()->getLastName ();
echo $schedule->getTechnician ()->getFirstName () . ' ' . $schedule->getTechnician ()->getLastName ();
?> | <a href='javascript:void(0);' onclick='show_popup2(event ,"<?php echo $schedule->getTechnician ()->getId(); ?>","<?php echo $tech_name; ?>","emailPopUp");'>Send
Email</a></div>
<div id="techSchedule_<?php echo $schedule->getTechnician ()->getId (); ?>" class="techTable">
<?php
	
	$start = $schedule->getTechnician ()->getStartTime ();
	$previousOrder = null;
	while ( $start < $schedule->getTechnician ()->getEndTime () ) {
		
		$order = $schedule->getWorkorderAtTime ( $start );
		
		
		//convert to standard hours 8:00am, 3:30pm etc
		$h = substr ( $start, 0, 2 );
		$hh = substr ( $start, 0, 1 );
		$m = substr ( $start, 2, 2 );
		
		if ($hh == '0') {
			$hour = substr ( $start, 1, 1 );
		}
		if ($hh != '0' && $h < 13) {
			$hour = $h;
		}
		if ($h > 12) {
			$hour = $h - 12;
		}
		$time = $hour . ':' . $m;
		if($order!=null){
		}
		if ($order == null) {
				// no job is schedule for this hour
				//display empty hour
				?>
				<div class="unscheduled">
				<table>
					<tr>
						<td class="time"><?php
							echo $time;
							?></td>
						<td class="un-spacer"></td>
					</tr>
				</table>
				</div>
		        <?php
		} else {
			$content = '<td class="time" align="right">' . $time . '</td>';
			$cssClazz = 'scheduled';
				if (($previousOrder != null && $previousOrder->getId () != $order->getId ()) || $previousOrder == null) {
				//print_r(get_class($order));
				$job_start = $order->getJobStart ();
				$job_end = $order->getJobEnd ();
				
                if($order->getJobStatusId() == 7)
                   $newBg = "Style = 'background-color: red'";
				elseif($order->getExactTime())
				   $newBg = "Style = 'background-color: #0099FF'";
				else 
					$newBg = "";
				
            //just in case this client was deleted from the DB we create an empty client to avoid an error
            
if($order->getClient())
   $c_address =   $order->getClient ()->getAddress () . ' ' . $order->getClient ()->getCity () . ' ' . $order->getClient ()->getState (). ' '.$order->getClient ()->getZip ()."<br/>";

if(!$order->getClient())
    $content = "<div>THE CLIENT THIS JOB WAS SCHEDULED FOR NO LONGER EXIST</div>";
else
	$content .= '<td class="schedule-client" '.$newBg.'><b> '. $order->convertTime($job_start) .'-'.$order->convertTime($job_end).'<br/>'. $order->getClient ()->getClientName () . '</b><br/>(' . $order->getClient ()->getClientIdentification () . ') <br/>' . $order->getClient ()->getCity () . ', ' . $order->getClient ()->getState () . '<br/><br/>Assigned By: '.$order->getAssignerName(). $c_address.'</td>';
		

	}
			
			if ($previousOrder != null && $previousOrder->getId () != $order->getId ()) {
				$cssClazz = $cssClazz . ' scheduled-new';
			} else {
				$cssClazz = $cssClazz . ' scheduled-existing';
				if ($previousOrder != null) {
					$content .= '<td class="schedule-spacer"  '.$newBg.'>&nbsp;</td>';
				}
			}
			
			$previousOrder = $order;
			
			$callback = '';
			if (isset ( $workorderCallbackFunction ))
				$callback = $workorderCallbackFunction . '(' . $order->getId () . ')'?>
		<div class="<?php
			echo $cssClazz;
			?>"
	onclick="<?php
			echo $callback;
			?>" <?php  ?>>
<table>
	<tr>
			  <?php   
			//print schedule row for hour with schedule
			echo $content;
			?> 
			 </tr>
</table>
</div>
	<?php
		
		}
		
		// increment time
		if (substr ( $start, 2, 2 ) == '30') {
			$start = abs ( substr ( $start, 0, 2 ) ) + 1 . '00';
			
			if (strlen ( $start ) != 4) {
				$start = '0' . $start;
			}
		} else {
			$start = substr ( $start, 0, 2 ) . '30';
		}
	} //while	
	?>			
	</div>
</div>
