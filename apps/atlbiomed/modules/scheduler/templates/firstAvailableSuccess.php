<?php	use_helper('Javascript'); ?>
		<h2>Available Technicians: </h2>
		<div id="availableTechs" >
		<?php 
		
	
		
		$c_count = 0;
		foreach($availableTechnicians as $tech)
		{
			$available = $availableTimes[$tech->getId()];
			if (isset($available))
			{
				echo '<div class="availTech">'.$tech->getFirstName().' '.$tech->getLastName().'<br />';
				//parse time string
				$inc = 2;
				$available_minutes = $available % 100;
				$available_hours = ($available - $available_minutes) / 100;
				$available_hrs = $available_hours;
				if($available_hours > 12) { $available_hours = $available_hours - 12; }
				if($available_minutes == 0) { $available_minutes = '00'; }
				$available_endhours = $available_hours + 2;
				if($available_hours == 11) { $available_endhours = 1; }
				if($available_hours == 12) { $available_endhours = 2; }
				
				$s_hours = substr($tech->getStartTime(),0,2);
				$s_mins = substr($tech->getStartTime(),2,2);
				$e_hours = substr($tech->getEndTime(),0,2);
				$e_mins = substr($tech->getEndTime(),2,2);
				
				$available_minutes_str = (strlen($available_minutes)<2) ? "0".$available_minutes : $available_minutes;

				echo link_to_function($available_hours.':'.$available_minutes_str, "selectTech(".$tech->getId().", '".$tech->getFirstName()."', '".$tech->getLastName()."', ".$available_hrs.", ".$available_minutes_str.")");
				echo " | ";
				echo link_to_function('Add', "selectSTech(".$tech->getId().", '".$tech->getFirstName()."', '".$tech->getLastName()."')");
				echo " | ";
				echo link_to_function('Day', "alldayTech(".$tech->getId().", '".$tech->getFirstName()."', '".$tech->getLastName()."', ".$s_hours.", ".$s_mins.", ".$e_hours.", ".$e_mins.")");
	            echo " | ";
				echo link_to_function('Week', "allweekTech(".$tech->getId().", '".$tech->getFirstName()."', '".$tech->getLastName()."', ".intval($s_hours).", ".$s_mins.", ".$e_hours.", ".$e_mins.")");
/*
   echo " | ";echo link_to_function('MWF', "MWF_TT(".$tech->getId().", '".$tech->getFirstName()."', '".$tech->getLastName()."', ".$s_hours.", ".$s_mins.", ".$e_hours.", ".$e_mins.",'mwf')");
   echo " | ";echo link_to_function('TT', "MWF_TT(".$tech->getId().", '".$tech->getFirstName()."', '".$tech->getLastName()."', ".$s_hours.", ".$s_mins.", ".$e_hours.", ".$e_mins.",'tt')");
*/
				?><br />
<input type='checkbox' value='1' id='d_m_<?php print $c_count; ?>' />M
<input type='checkbox' value='1' id='d_t_<?php print $c_count; ?>' />T
<input type='checkbox' value='1' id='d_w_<?php print $c_count; ?>' />W
<input type='checkbox' value='1' id='d_tt_<?php print $c_count; ?>' />T
<input type='checkbox' value='1' id='d_f_<?php print $c_count; ?>' />F

<?php echo link_to_function('Update', "MWF_TT(".$tech->getId().", '".$tech->getFirstName()."', '".$tech->getLastName()."', '".$s_hours."', '".$s_mins."', '".$e_hours."', '".$e_mins."','$c_count')"); ?>
</div><?php $c_count++;
			}
		}
?>
</div>

<div id='testing'></div>
