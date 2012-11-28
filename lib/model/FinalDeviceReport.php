<?php

/**
 * Subclass for representing a row from the 'final_device_report' table.
 *
 * 
 *
 * @package lib.model
 */ 
class FinalDeviceReport extends BaseFinalDeviceReport
{
	public function formattedDate(){
		$unformatted = $this->getCreatedAt();
		if(empty($unformatted)) return;
		
		$ar_date_info = explode(' ',$unformatted);
		$ar_date = $ar_date_info[0];
		$ar_time = $ar_date_info[1];
		
		$date_ar = explode('-',$ar_date);
		$date = $date_ar[1].'-'.$date_ar[2].'-'.$date_ar[0]; //format 01-15-2008
		return $date.' '.$this->convertMilitaryTime($ar_time);
	}
	public function convertMilitaryTime($time){
		$time_ex = explode(':', $time);
		
		$hr = (int)$time_ex[0];
		$min = $time_ex[1];
		$sec = $time_ex[2];
		
		if($hr == 0)
			return "12:$min AM";
		elseif($hr < 12)
			return "$hr:$min AM";
		elseif($hr == 12 )
			return "12:$min PM";
		else
			return ($hr-12).":$min PM";
	}
	public static function convertImportedDate($date){
		
		$expl = explode('-', $date);
		$month = trim($expl[0],' ');
		$day = trim($expl[1],' ');
		$year = trim($expl[2],' ');
		
		if(strlen($year) < 2){
			$year = "0$year";
		}
		if(strlen($day) < 2){
			$day = "0$day";
		}
		if(strlen($month) < 2){
			$month = "0$month";
		}
		return "$month-$day-$year";
	}
}
