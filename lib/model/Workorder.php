<?php

/**
 * Subclass for representing a row from the 'workorder' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Workorder extends BaseWorkorder
{
       function convertTime($time){
	    	$time = (int)$time;
			$sec = ($time < 1200) ? " AM" : " PM";
		
			if($time == 0 or $time == 2400){
				return "12:00 pm";
			}
			
			if($time >= 1300) $time = ($time - 1200);
			$len = strlen($time);
			$lenMinus2 = $len - 2;
			$hours = substr($time, 0, $lenMinus2);
			$min =  substr($time,$lenMinus2,2); 	
			
			return $hours.":".$min.$sec;
		}
		function getAssignerName(){
			$assignerID = $this->getAssignedBy();
			$assigner = UserPeer::retrieveByPk ($assignerID);
			
			if($assigner)
				return $assigner->getFirstName();
			else 
				return "----";
				
		}
}
