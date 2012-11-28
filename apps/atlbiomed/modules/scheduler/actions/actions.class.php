<?php

class schedulerActions extends sfActions {
	/**
	 * Executes index action
	 *
	 */

	public function executeIndex() {


		new GoogleMapCache();
		//print $this->getFirstAvailableJobStartTime(7,351, "2008-05-08");exit;
		//$this->preventitaveThisMonth(351, 17, "2008-06-17");

		$this->google_api_key = sfConfig::get('app_google_maps_api_key');
		$technician = UserPeer::retrieveByPk ( 29 );

		$this->specification_select = '';
			
		//Select Error state
		$this->error = $this->getRequestParameter ( 'error' );

		//Populate Client Dropdown menu
		$m = new Criteria ( );
		$m->addAscendingOrderByColumn ( ClientPeer::CLIENT_IDENTIFICATION );
		$this->selectClient = ClientPeer::doSelect ( $m );

		$this->client_select = $this->getRequestParameter ( 'client_select' );

		$g = new Criteria ( );
		$g->add ( DropdownPeer::MENU, 'reason' );
		$g->addAscendingOrderByColumn ( DropdownPeer::VALUE );
		$this->reason_dropdown = DropdownPeer::doSelect ( $g );

        $sel_drop = new Dropdown();
        $sel_drop->setId(-1);
        $sel_drop->setMenu('Reason');
        $sel_drop->setValue('Please Select');
        $this->reason_dropdown = array_merge(array($sel_drop),$this->reason_dropdown);
 

		$this->status = $this->getRequestParameter ( 'status' );

		$s = new Criteria ( );
		$s->addAscendingOrderByColumn ( JobStatusPeer::STATUS_NAME );
		$this->selectStatus = JobStatusPeer::doSelect ( $s );



		$this->notes = $this->makeRemarks($this->client_select ,$this->getRequestParameter('checkeditems'));

		//Edit Mode
		$this->mode = $this->getRequestParameter ( 'mode' );

		if (! empty ( $this->mode )) {
			if ($this->mode == 'edit') {
				;

				$workorder_id = $this->getRequestParameter ( 'ticket' );
				$this->ticket = $workorder_id;
				$this->edit_workorder = WorkorderPeer::retrieveByPk ( $workorder_id );
				$this->edit_workorder_tech = UserPeer::retrieveByPk ( $this->edit_workorder->getTech () );
				$this->edit_workorder_stech = UserPeer::getWorkorderSTech ( $workorder_id, $this->edit_workorder->getTech () );

				//if this is a preventive maintenance display the job scheduled date not job date
				$job_scheduled_date = $this->edit_workorder->getJobScheduledDate ();
				;
				$this->job_date = $this->edit_workorder->getJobDate ();
					




				$this->date = $this->job_date;
				$this->client_select = $this->edit_workorder->getClientId ();
				$this->edit_client = $this->edit_workorder->getClient ();
				$this->device_select = $this->edit_workorder->getDeviceId ();
				$this->notes = $this->edit_workorder->getRemarks ();
				$this->caller = $this->edit_workorder->getCaller ();
				$this->status = $this->edit_workorder->getJobStatusId ();
				$this->reason_select = $this->edit_workorder->getReason ();




				//clientid in session is used in firstavailable tech since we can't pass it
				$this->getUser()->setAttribute('session_client_id', $this->client_select);
				//account for 'All' devices
				if ($this->device_select == 0) {
					$this->specification_select = - 2;
				} else {
					$this->specification_select = $this->edit_workorder->getDevice ()->getSpecificationId ();
				}

				$start_time = $this->edit_workorder->getJobStart ();
				$end_time = $this->edit_workorder->getJobEnd ();
				$this->exact_time = $this->edit_workorder->getExactTime();

				//parse start time
				$this->start_time_minutes = $start_time % 100;
				$this->start_time_hours = ($start_time - $this->start_time_minutes) / 100;
				$this->start_time_am = true;
				if ($this->start_time_hours >= 12) {
					$this->start_time_am = false;
				}
				if ($this->start_time_hours > 12) {
					$this->start_time_hours = $this->start_time_hours - 12;
				}
				if (strlen ( $this->start_time_minutes ) == 1) {
					$this->start_time_minutes = '0' . $this->start_time_minutes;
				}

				//parse end time
				$this->end_time_minutes = $end_time % 100;
				$this->end_time_hours = ($end_time - $this->end_time_minutes) / 100;
				$this->end_time_am = true;

				if ($this->end_time_hours >= 12) {
					$this->end_time_am = false;
				}
				if ($this->end_time_hours > 12) {
					$this->end_time_hours = $this->end_time_hours - 12;
				}
				if (strlen ( $this->end_time_minutes ) == 1) {
					$this->end_time_minutes = '0' . $this->end_time_minutes;
				}

				//populate 'Device' menu
				$c = new Criteria ( );
				$c->add ( DevicePeer::CLIENT_ID, $this->client_select );
				$c->addAscendingOrderByColumn ( DevicePeer::IDENTIFICATION );
				$c->addAscendingOrderByColumn ( DevicePeer::IDENTIFICATION );
				$specification_result = DevicePeer::doSelect ( $c );
					
					

				$specification_options = array ( );

				//set results of table join to array for use in dropdown
				$specification_options [0] = 'Please Select...';
				$specification_options [- 1] = 'No Device';
				$specification_options [- 2] = 'All Devices';
				$specification_options [- 3] = 'New Device';
				foreach ( $specification_result as $result ) {
					if($result->getSpecification () != NULL)
					$specification_options [$result->getSpecification ()->getId ()] = $result->getSpecification ()->getDeviceName ();
				}
				$this->specification_options = $specification_options;

				//populate 'Device Id' menu
				$d = new Criteria ( );
				$d->add ( DevicePeer::CLIENT_ID, $this->client_select );
				$d->add ( DevicePeer::SPECIFICATION_ID, $this->specification_select );
				$device_result = DevicePeer::doSelect ( $c );

				//				$this->device_select = $device_result->getDeviceId();


				$device_options = array ( );

				$device_options [- 1] = 'Please Select...';
				foreach ( $device_result as $result ) {
					$device_options [$result->getId ()] = $result->getIdentification ();
				}
				$this->device_options = $device_options;
			}

		} else {

			$cal_date = $this->getUser ()->getAttribute ( 'calendar_date' );
			if ( !empty($cal_date)){
				$this->date = $this->getUser ()->getAttribute ( 'calendar_date' );
				$exp = explode('-',$this->date);

				$a1 = (int)$exp[0];
				$a2 = (int)$exp[1];
				$a3 = (int)$exp[2];

				if($a1 <= 0 || $a2 <= 0 || $a3<=0 || strlen($exp[1])>2 || strlen($exp[2])>2 ){
					$this->getUser()->setAttribute('calendar_date', date('Y-m-d') );
					$this->date = $this->getUser ()->getAttribute ( 'calendar_date' );
				}
			}else
			$this->date = date ( 'Y-m-d' );


			$this->job_date = $this->date;
			$this->start_time_minutes = '';
			$this->start_time_hours = '';
			$this->start_time_am = true;
			$this->end_time_minutes = '';
			$this->end_time_hours = '';
			$this->end_time_am = true;

			if (! empty ( $this->client_select )) {
				$this->client_source = ClientPeer::retrieveByPk ( $this->client_select );

				$this->specification_select = $this->getRequestParameter ( 'specification_select' );
				//Populate Device dropdown menu
				$c = new Criteria ( );
				$c->add ( DevicePeer::CLIENT_ID, $this->client_select );
				$c->addJoin ( DevicePeer::SPECIFICATION_ID, SpecificationPeer::ID, Criteria::INNER_JOIN );
				$c->addAscendingOrderByColumn ( SpecificationPeer::DEVICE_NAME );
				$this->specification_result = DevicePeer::doSelect ( $c );

				$specification_options = array ( );

				//set results of table join to array for use in dropdown
				$specification_options [0] = 'Please Select...';
				$specification_options [- 1] = 'No Device';
				$specification_options [- 2] = 'All Devices';
				$specification_options [- 3] = 'New Device';
				foreach ( $this->specification_result as $result ) {
					$specification_options [$result->getSpecification ()->getId ()] = $result->getSpecification ()->getDeviceName ();
				}
				$this->specification_options = $specification_options;
				$this->all_time = $this->client_source->getAllDevices ();
				$this->client_data = ClientPeer::retrieveByPk ( $this->client_select );
					
			}
		}

	}

	private function getWeekDates($theDate){
		$date_arr = explode('-',$theDate);
		$_month = (int)$date_arr[1];
		$_day =  (int)$date_arr[2];
		$_year = (int)$date_arr[0];
		 
		$time = mktime(0,0,0, $_month, $_day, $_year);


		$date = getdate($time);

		$wday = $date['wday']; //day of week, 0 ... 6 (sun ... sat)

		//$addFirstDayNextWeek = 7 - $wday; //first sunday of the next week
		$addFirstThisWeek = ($wday);

		$format = 'Y-m-d';  
		$sun = date($format, mktime(0,0,0, $_month, ($_day - $addFirstThisWeek), $_year));
		$mon = date($format, mktime(0,0,0, $_month, ($_day - $addFirstThisWeek) + 1, $_year));
		$tue = date($format, mktime(0,0,0, $_month, ($_day - $addFirstThisWeek) + 2, $_year));
		$wed = date($format, mktime(0,0,0, $_month, ($_day - $addFirstThisWeek) + 3, $_year));
		$thu = date($format, mktime(0,0,0, $_month, ($_day - $addFirstThisWeek) + 4, $_year));
		$fri = date($format, mktime(0,0,0, $_month, ($_day - $addFirstThisWeek) + 5, $_year));
		$sat = date($format, mktime(0,0,0, $_month, ($_day - $addFirstThisWeek) + 6, $_year));
 
        return array('mon'=>$mon, 'tue'=>$tue, 'wed'=>$wed, 'thu'=>$thu, 'fri'=>$fri);
	}
	private function getUpcomingWeek($days, $theDate){
		$date_arr = explode('-', $theDate);
		$_month = (int)$date_arr[1];
		$_day =  (int)$date_arr[2];
		$_year = (int)$date_arr[0];
		 
		$time = mktime(0,0,0, $_month, $_day, $_year);


		$date = getdate($time);

		$wday = $date['wday']; //day of week, 0 ... 6 (sun ... sat)
		$addFirstDayNextWeek = 7 - $wday; //first sunday of the next week
		$addFirstThisWeek = -$wday;



		$format = 'Y-m-d';
		$sun = date($format, mktime(0,0,0, $_month, $_day + $addFirstDayNextWeek, $_year));
		$mon = date($format, mktime(0,0,0, $_month, $_day + $addFirstDayNextWeek + 1, $_year));
		$tue = date($format, mktime(0,0,0, $_month, $_day + $addFirstDayNextWeek + 2, $_year));
		$wed = date($format, mktime(0,0,0, $_month, $_day + $addFirstDayNextWeek + 3, $_year));
		$thu = date($format, mktime(0,0,0, $_month, $_day + $addFirstDayNextWeek + 4, $_year));
		$fri = date($format, mktime(0,0,0, $_month, $_day + $addFirstDayNextWeek + 5, $_year));
		$sat = date($format, mktime(0,0,0, $_month, $_day + $addFirstDayNextWeek + 6, $_year));
 
			
		if($days == 'mwf'){
			if($wday <= 1){//sun -mon
				$mon = date($format, mktime(0,0,0, $_month, $_day +($addFirstThisWeek+1),$_year));
				$wed = date($format, mktime(0,0,0, $_month, $_day +($addFirstThisWeek+3),$_year));
				$fri = date($format, mktime(0,0,0, $_month, $_day +($addFirstThisWeek+5),$_year));
			}elseif($wday > 1 && $wday <= 3){ // (tues - wed)
				$wed = date($format, mktime(0,0,0, $_month, $_day +($addFirstThisWeek+3),$_year));
				$fri = date($format, mktime(0,0,0, $_month, $_day +($addFirstThisWeek+5),$_year));
			}elseif($wday > 3 && $wday <= 5)
			$fri = date($format, mktime(0,0,0, $_month, $_day +($addFirstThisWeek+5),$_year));
			$assignedDates = array('mon'=>$mon, 'wed'=>$wed, 'fri'=>$fri);
		}elseif($days == 'tt'){
			if($wday <= 2){//sun -mon
				$tue = date($format, mktime(0,0,0, $_month, $_day +($addFirstThisWeek+2),$_year));
				$thu = date($format, mktime(0,0,0, $_month, $_day +($addFirstThisWeek+4),$_year));
			}elseif($wday>2 && $wday<= 4){
				$thu = date($format, mktime(0,0,0, $_month, $_day +($addFirstThisWeek+4),$_year));
			}
			$assignedDates = array('tue'=>$tue, 'thu'=>$thu);
				
		}elseif($days == 'mtwtf'){
            return array('mon'=>$mon, 'tue'=>$tue, 'wed'=>$wed, 'thu'=>$thu, 'fri'=>$fri);
        }
		return $assignedDates;
	}

	public function executePopulateDevice() {

		$this->client_select = $this->getRequestParameter ( 'client_select' );
		$this->specification_select = $this->getRequestParameter ( 'specification_select' );

		$c = New Criteria ( );
		$c->add ( DevicePeer::CLIENT_ID, $this->client_select );
		$c->add ( DevicePeer::SPECIFICATION_ID, $this->specification_select );
		$c->addJoin ( DevicePeer::SPECIFICATION_ID, SpecificationPeer::ID, Criteria::INNER_JOIN );
		$c->addAscendingOrderByColumn ( SpecificationPeer::DEVICE_NAME );
		$device_result = DevicePeer::doSelect ( $c );

		$device_options = array ( );

		$device_options [- 1] = 'Please Select...';
		foreach ( $device_result as $result ) {
			$device_options [$result->getId ()] = $result->getIdentification ();
		}

		$this->device_options = $device_options;

	}

	public function executeJobScheduler() {

		$is_exact_time = $this->getRequestParameter('exactTime');
		$is_weekly = $this->getRequestParameter('allWeekTechCheckox_hidden');
        
        $this->checked_days_hidden = $this->getRequestParameter('checked_days_hidden');
        $this->using_checked = $this->getRequestParameter('using_checked');
       // var_dump($checked_days_hidden, $using_checked); exit;

		//the selected date on the javascript calendar
		if ($this->getUser ()->getAttribute ( 'calendar_date' ) != '' and $this->getUser ()->getAttribute ( 'calendar_date' ) != NULL)
		$cal_date = $this->getUser ()->getAttribute ( 'calendar_date' );
		else
		$cal_date = date ( 'Y-m-d' );

		//schedule Weekly
		if($is_weekly)
		$this->scheduleWeek( $this->getNextBusinessDays($cal_date, 5) );

		$mwf = $this->getRequestParameter('mwf');
		$tt = $this->getRequestParameter('tt');

			
		if($this->using_checked)
		$this->mwf_tt();
	  

		//if we are here it is a normal schedule
		$mode = $this->getRequestParameter ( 'mode' );
		$client = $this->getRequestParameter ( 'client' ); //client id;
		$specification = $this->getRequestParameter ( 'specification_select' );
		$device = $this->getRequestParameter ( 'device_select' );
		$reason = $this->getRequestParameter ( 'reason_select' );
		$status = $this->getRequestParameter ( 'status' );
		$job_status = $this->getRequestParameter ( 'job_status' );
		$job_date = $this->getRequestParameter ( 'date' );
		$start_time = $this->getRequestParameter ( 'start_time' );
		$end_time = $this->getRequestParameter ( 'end_time' );
		$tech_id = $this->getRequestParameter ( 'technician' );
		$stech_id = $this->getRequestParameter ( 'stech' );
		$workorder_id = $this->getRequestParameter ( 'ticket' );
		$allowScheduleExtension = $this->getRequestParameter('allowScheduleExtension');


		//we have a unscheduled job with for this month
		//changed it to scheduled

		$preventative_exist = $this->preventitaveThisMonth($client, $reason, $job_date);
			

		$onsite = $end_time - $start_time;
		if (strlen ( $onsite ) == 4) {
			$hrs = substr ( $onsite, 0, 2 );
			$min = substr ( $onsite, 2, 2 );
		} else {
			$hrs = substr ( $onsite, 0, 1 );
			$min = substr ( $onsite, 1, 2 );
		}
		$onsite_time = $hrs . ':' . $min;

		//Retrieve Client Information
		$client_info = ClientPeer::retrieveByPk ( $client );

		//Retrieve Technician Information
		$tech_info = UserPeer::retrieveByPk ( $tech_id );

		//Test for device values
		if ($specification == - 2) {
			$device = 'All';
		}

		if(!$preventative_exist){
			//Set workorder object
			$workorder = new Workorder ( );
		}else
		$workorder = $preventative_exist;
			

			
			
		$workorder_ptech = new WorkorderTech ( );
		$workorder_stech = new WorkorderTech ( );



		if (! empty ( $mode )) {
			if ($mode == 'edit') {

				if (! empty ( $workorder_id )) {
					$workorder = WorkorderPeer::retrieveByPk ( $workorder_id );
					$workorders = WorkorderTechPeer::getWorkorderTechs ( $workorder_id );
					foreach ( $workorders as $wods ) {
						$wods->delete ();
					}
				}
				$client = $this->getRequestParameter ( 'client_edit' );
			}
		}


		//get rid of the workorder queried in edit mode
		if($preventative_exist)
		$workorder = $preventative_exist;
			
		if($reason == 17 || $reason == 23){
			$this->setDevicesStatus($client,'pm scheduled');
		}

		$workorder->setDeviceId ( $device );
		$workorder->setClientId ( $client );
		$workorder->setTech ( $tech_id );
		$workorder_ptech->setUserId ( $tech_id );
		$workorder_ptech->setWorkorderId ( $workorder_id );
		$workorder_stech->setUserId ( $stech_id );
		$workorder_stech->setWorkorderId ( $workorder_id );
		$workorder->setJobStatusId ( $this->getRequestParameter ( 'status' ) );
		$workorder->setPageNumber ( '1' ); //Needs Modification
		$workorder->setTravelTime ( '1' ); //Needs Modification
		$workorder->setZip ( $client_info->getZip () );
		$workorder->setDateRecieved ( date ( 'Y-m-d' ) );
		$workorder->setReason ( $reason );
		$workorder->setRemarks ( $this->getRequestParameter ( 'notes' ) );
		$workorder->setCaller ( $this->getRequestParameter ( 'caller' ) );
		$workorder->setJobDate ( $job_date );
		$workorder->setJobStart ( $start_time );
		$workorder->setJobEnd ( $end_time );
		$workorder->setOnsiteTime ( $onsite_time );
		$workorder->setAssignedBy($this->getUser()->getAttribute('userId'));
		$workorder->setExactTime($is_exact_time);
		if($mode != 'edit') $workorder->setJobScheduledDate($job_date);


		//if we have a unscheduled preventative for this month we want to overwrite it with new data
		if($preventative_exist){
			$workorder->setJobStatusId(9);
		}


		if (! empty ( $mode )) {
			if ($mode == 'edit') {
				$workorder->save ();
				$workorder_ptech->save ();
				$workorder_stech->save ();
				$this->redirect ( 'scheduler/index' );
			}
		} else if ($mode != 'edit') {

			if ($job_status == 'scheduled') {
				//Test to see if Job is scheduled
				$f = new Criteria ( );
				$f->add ( WorkorderPeer::JOB_DATE, $job_date );
				$f->add ( WorkorderPeer::JOB_STATUS_ID, 9 );
				$f->add ( WorkorderPeer::TECH, $tech_id );

				$technician = UserPeer::retrieveByPk ( $tech_id );
				$second_technician = UserPeer::retrieveByPk ( $stech_id );

				$scheduler = new TechnicianScheduler ( $technician, $job_date );

				if($second_technician != NULL)
				$scheduler_2 = new TechnicianScheduler ( $second_technician, $job_date );
					
				$workorder->save ();
				$workorder_ptech->setWorkorderId ( $workorder->getId () );
				$workorder_ptech->save ();
					
				if($second_technician != NULL){
					$workorder_stech->setWorkorderId ( $workorder->getId () );
					$workorder_stech->save ();
				}//if
			}
		}
		$this->date = $workorder->getJobDate ();
		$this->redirect ( 'scheduler/index' );
	}

	private function saveDataToSession(){

		$is_all_week = $this->getRequestParameter('allWeekTechCheckox_hidden');

			
		$mode = $this->getRequestParameter ( 'mode' );
		$client = $this->getRequestParameter ( 'client' );
		$specification = $this->getRequestParameter ( 'specification_select' );
		$device = $this->getRequestParameter ( 'device_select' );
		$reason = $this->getRequestParameter ( 'reason_select' );
		$status = $this->getRequestParameter ( 'status' );
		$job_status = $this->getRequestParameter ( 'job_status' );
		$job_date = $this->getRequestParameter ( 'date' );
		$start_time = $this->getRequestParameter ( 'start_time' );
		$end_time = $this->getRequestParameter ( 'end_time' );
		$tech_id = $this->getRequestParameter ( 'technician' );
		$stech_id = $this->getRequestParameter ( 'stech' );
		$workorder_id = $this->getRequestParameter ( 'ticket' );
		$start_time_hours = $this->getRequestParameter ( 'start_time_hours' );
		$start_time_min = $this->getRequestParameter ( 'start_time_minutes' );
		$end_time_hours = $this->getRequestParameter ( 'end_time_hours' );
		$end_time_min = $this->getRequestParameter ( 'end_time_minutes' );
		$caller = $this->getRequestParameter ( 'caller');
		$notes = $this->getRequestParameter ( 'notes');





		$this->getUser()->setAttribute('mode',$mode);
		$this->getUser()->setAttribute('client',$client);
		$this->getUser()->setAttribute('specification_select',$specification);
		$this->getUser()->setAttribute('device_select',$device);
		$this->getUser()->setAttribute('reason_select',$reason);
		$this->getUser()->setAttribute('status',$status);
		$this->getUser()->setAttribute('job_status',$job_status);
		$this->getUser()->setAttribute('date',$job_date);
		$this->getUser()->setAttribute('start_time',$start_time);
		$this->getUser()->setAttribute('end_time',$end_time);
		$this->getUser()->setAttribute('technician',$tech_id);
		$this->getUser()->setAttribute('stech',$stech_id);
		$this->getUser()->setAttribute('ticket',$workorder_id);
		$this->getUser()->setAttribute('reason_select',$reason);
		$this->getUser()->setAttribute('start_time_hours',$start_time_hours );
		$this->getUser()->setAttribute('start_time_minutes',$start_time_min );
		$this->getUser()->setAttribute('end_time_hours', $end_time_hours);
		$this->getUser()->setAttribute('end_time_minutes',$end_time_min );
		$this->getUser()->setAttribute('caller',$caller );
		$this->getUser()->setAttribute('notes',$notes );
		$this->getUser()->setAttribute('is_all_week',$is_all_week);


	}

	private function scheduleWeek($dates) {
		$schedule_test_mode = true;

		$mode = $this->getRequestParameter ( 'mode' );

		$client = $this->getRequestParameter ( 'client' );

		$specification = $this->getRequestParameter ( 'specification_select' );
		$device = $this->getRequestParameter ( 'device_select' );
		$reason = $this->getRequestParameter ( 'reason_select' );
		$status = $this->getRequestParameter ( 'status' );
		$job_status = $this->getRequestParameter ( 'job_status' );
		$job_date = $this->getRequestParameter ( 'date' );
		$start_time = $this->getRequestParameter ( 'start_time' );
		$end_time = $this->getRequestParameter ( 'end_time' );
		$tech_id = $this->getRequestParameter ( 'technician' );
		$stech_id = $this->getRequestParameter ( 'stech' );
		$workorder_id = $this->getRequestParameter ( 'ticket' );


		$testParam = 5;
		for($i = 0; $i < $testParam; $i ++) {


			$job_date = $dates[$i]; //override job date with job dates in the week array

			$onsite = $end_time - $start_time;
			if (strlen ( $onsite ) == 4) {
				$hrs = substr ( $onsite, 0, 2 );
				$min = substr ( $onsite, 2, 2 );
			} else {
				$hrs = substr ( $onsite, 0, 1 );
				$min = substr ( $onsite, 1, 2 );
			}
			$onsite_time = $hrs . ':' . $min;

			//Retrieve Client Information
			$client_info = ClientPeer::retrieveByPk ( $client );

			//Retrieve Technician Information
			$tech_info = UserPeer::retrieveByPk ( $tech_id );

			//Test for device values
			if ($specification == - 2) {
				$device = 'All';
			}

			//Set workorder object
			$workorder = new Workorder ( );
			$workorder_ptech = new WorkorderTech ( );
			$workorder_stech = new WorkorderTech ( );

			if (! empty ( $mode )) {
				if ($mode == 'edit') {
					if (! empty ( $workorder_id )) {
						$workorder = WorkorderPeer::retrieveByPk ( $workorder_id );
						$workorders = WorkorderTechPeer::getWorkorderTechs ( $workorder_id );
						foreach ( $workorders as $wods ) {
							$wods->delete ();
						}
					}
					$client = $this->getRequestParameter ( 'client_edit' );
				}
			}

			$workorder->setDeviceId ( $device );
			$workorder->setClientId ( $client );
			$workorder->setTech ( $tech_id );
			$workorder_ptech->setUserId ( $tech_id );
			$workorder_ptech->setWorkorderId ( $workorder_id );
			$workorder_stech->setUserId ( $stech_id );
			$workorder_stech->setWorkorderId ( $workorder_id );
			//		$workorder->setOffice();				//Will populate when authentication in place
			$workorder->setJobStatusId ( $this->getRequestParameter ( 'status' ) );
			$workorder->setPageNumber ( '1' ); //Needs Modification
			$workorder->setTravelTime ( '1' ); //Needs Modification
			$workorder->setZip ( $client_info->getZip () );
			$workorder->setDateRecieved ( date ( 'Y-m-d' ) );
			//		$workorder->setDateCompleted();		**** Don't Need ****
			//		$workorder->setWorkorderType();		****
			//		$workorder->setJobType();			****
			//		$workorder->setInvoice();			****
			$workorder->setReason ( $reason );
			//		$workorder->setActionTaken(); 		****
			$workorder->setRemarks ( $this->getRequestParameter ( 'notes' ) );
			$workorder->setCaller ( $this->getRequestParameter ( 'caller' ) );
			$workorder->setJobDate ( $job_date );
			$workorder->setJobStart ( $start_time );
			$workorder->setJobEnd ( $end_time );
			$workorder->setOnsiteTime ( $onsite_time );

			if (! empty ( $mode )) {
				if ($mode == 'edit') {
					$workorder->save ();
					$workorder_ptech->save ();
					$workorder_stech->save ();
					$this->redirect ( 'scheduler/index' );
				}
			} else if ($mode != 'edit') {
					
				if ($job_status == 'scheduled') {
					//Test to see if Job is scheduled
					$f = new Criteria ( );
					$f->add ( WorkorderPeer::JOB_DATE, $job_date );
					$f->add ( WorkorderPeer::JOB_STATUS_ID, 9 );
					$f->add ( WorkorderPeer::TECH, $tech_id );

					$technician = UserPeer::retrieveByPk ( $tech_id );

					$scheduler = new TechnicianScheduler ( $technician, $job_date );

					//when we start we are in test mode where we do not save any data.
					//Objective is to test ahead all the days that we want to schedule to see
					//if we have any conflicts. if we do then we throw an error
					//after we've test all the days we set the testmode to false
					//and do everything again this time save the data
					if( $scheduler->isSchedulable ( $workorder ) && $schedule_test_mode==true){
						if($i == 4){// just check the final date in test mode. start in live mode where we save data
							$i = -1;
							$schedule_test_mode = false;
						}
						continue;
					}elseif(!$scheduler->isSchedulable ( $workorder ) && $schedule_test_mode==true){
						if ($technician->getStartTime () > $workorder->getJobStart () || $technician->getEndTime () < $workorder->getJobEnd ()) {
							$this->redirect ( 'scheduler/index?error=unavailable' );
						} else {
							$this->saveDataToSession();
							$this->getUser()->setAttribute('edit_client',$this->edit_client = ClientPeer::retrieveByPk ( $client ));
							$this->getUser()->setAttribute('edit_workorder_tech', $technician);
							$this->getUser()->setAttribute('device_list',$this->getDeviceMenu($client));
							$this->getUser()->setAttribute('specification_id', $specification);
							//$this->getUser()->setAttribute('selected_device_id', $device);
					  //  var_dump($device); exit;
							if(!empty($stech_id))
							$this->getUser()->setAttribute('second_tech', $second_technician);

							$this->getUser()->setAttribute('workorder',$workorder);
							$this->redirect ( 'scheduler/index?error=overlap' );
						}
					}



					if ($scheduler->isSchedulable ( $workorder )) {
						$workorder->save ();
						$workorder_ptech->setWorkorderId ( $workorder->getId () );
						$workorder_ptech->save ();
					} else {
						if ($technician->getStartTime () > $workorder->getJobStart () || $technician->getEndTime () < $workorder->getJobEnd ()) {
							$this->redirect ( 'scheduler/index?error=unavailable' );
						} else {
							$this->saveDataToSession();
							$this->getUser()->setAttribute('edit_client',$this->edit_client = ClientPeer::retrieveByPk ( $client ));
							$this->getUser()->setAttribute('edit_workorder_tech', $technician);
							$this->getUser()->setAttribute('device_list',$this->getDeviceMenu($client));
							$this->getUser()->setAttribute('specification_id', $specification);
							//$this->getUser()->setAttribute('selected_device_id', $device);
					  //  var_dump($device); exit;
							if(!empty($stech_id))
							$this->getUser()->setAttribute('second_tech', $second_technician);

							$this->getUser()->setAttribute('workorder',$workorder);
							$this->redirect ( 'scheduler/index?error=overlap' );
						}
					}
				}
			}//else if edit mode
		} //for loop

		$this->date = $workorder->getJobDate ();
		$this->redirect ( 'scheduler/index' );

	}
	private function createUpcomingweekWorkorder($workorder_dates){
		 
		//if we are here it is a normal schedule
		$is_exact_time = $this->getRequestParameter('exactTime');
		$is_weekly = $this->getRequestParameter('allWeekTechCheckox_hidden');
		$mode = $this->getRequestParameter ( 'mode' );
		$client = $this->getRequestParameter ( 'client' ); //client id;
		$specification = $this->getRequestParameter ( 'specification_select' );
		$device = $this->getRequestParameter ( 'device_select' );
		$reason = $this->getRequestParameter ( 'reason_select' );
		$status = $this->getRequestParameter ( 'status' );
		$job_status = $this->getRequestParameter ( 'job_status' );
		$job_date = $this->getRequestParameter ( 'date' );
		$start_time = $this->getRequestParameter ( 'start_time' );
		$end_time = $this->getRequestParameter ( 'end_time' );
		$tech_id = $this->getRequestParameter ( 'technician' );
		$stech_id = $this->getRequestParameter ( 'stech' );
		$workorder_id = $this->getRequestParameter ( 'ticket' );
		$allowScheduleExtension = $this->getRequestParameter('allowScheduleExtension');
		$mwf = $this->getRequestParameter('mwf');
		$tt = $this->getRequestParameter('tt');

		//Retrieve Client Information
		$client_info = ClientPeer::retrieveByPk ( $client );


		$date = getdate();
		$wday = $date['wday']; //day of week, 0 ... 6 (sun ... sat)



		foreach($workorder_dates as $wo_date){
				
			$job_date = $wo_date;
			$workorder = new Workorder();
				
			$workorder->setDeviceId ( $device );
			$workorder->setClientId ( $client );
			$workorder->setTech ( $tech_id );
			$workorder->setJobStatusId ( $this->getRequestParameter ( 'status' ) );
			$workorder->setPageNumber ( '1' ); //Needs Modification
			$workorder->setTravelTime ( '1' ); //Needs Modification
			$workorder->setZip ( $client_info->getZip () );
			$workorder->setDateRecieved ( date ( 'Y-m-d' ) );
			$workorder->setReason ( $reason );
			$workorder->setRemarks ( $this->getRequestParameter ( 'notes' ) );
			$workorder->setCaller ( $this->getRequestParameter ( 'caller' ) );
			$workorder->setJobDate ( $job_date );
			$workorder->setJobStart ( $start_time );
			$workorder->setJobEnd ( $end_time );
			$workorder->setOnsiteTime ( $onsite_time );
			$workorder->setAssignedBy($this->getUser()->getAttribute('userId'));
			$workorder->setExactTime($is_exact_time);
			$workorder->setJobScheduledDate($job_date);
				
			$wo[] = $workorder;
		}

		return $wo;
	}
	private function mwf_tt(){

		//the selected date on the javascript calendar
		if ($this->getUser ()->getAttribute ( 'calendar_date' ) != '' and $this->getUser ()->getAttribute ( 'calendar_date' ) != NULL)
		$cal_date = $this->getUser ()->getAttribute ( 'calendar_date' );
		else
		$cal_date = date ( 'Y-m-d' );


		//if we are here it is a normal schedule
		$is_exact_time = $this->getRequestParameter('exactTime');
		$is_weekly = $this->getRequestParameter('allWeekTechCheckox_hidden');
		$mode = $this->getRequestParameter ( 'mode' );
		$client = $this->getRequestParameter ( 'client' ); //client id;
		$specification = $this->getRequestParameter ( 'specification_select' );
		$device = $this->getRequestParameter ( 'device_select' );
		$reason = $this->getRequestParameter ( 'reason_select' );
		$status = $this->getRequestParameter ( 'status' );
		$job_status = $this->getRequestParameter ( 'job_status' );
		$job_date = $this->getRequestParameter ( 'date' );
		$start_time = $this->getRequestParameter ( 'start_time' );
		$end_time = $this->getRequestParameter ( 'end_time' );
		$tech_id = $this->getRequestParameter ( 'technician' );
		$stech_id = $this->getRequestParameter ( 'stech' );
		$workorder_id = $this->getRequestParameter ( 'ticket' );
		$allowScheduleExtension = $this->getRequestParameter('allowScheduleExtension');
		$mwf = $this->getRequestParameter('mwf');
		$tt = $this->getRequestParameter('tt');

		$workorder_dates = explode(',',$this->checked_days_hidden);
 
		//if we have a unscheduled job for this month changed it to scheduled and return the job object
		$preventative_exist = $this->preventitaveThisMonth($client, $reason, $job_date);

		$onsite = $end_time - $start_time;
		if (strlen ( $onsite ) == 4) {
			$hrs = substr ( $onsite, 0, 2 );
			$min = substr ( $onsite, 2, 2 );
		} else {
			$hrs = substr ( $onsite, 0, 1 );
			$min = substr ( $onsite, 1, 2 );
		}
		$onsite_time = $hrs . ':' . $min;
		//Retrieve Client Information
		$client_info = ClientPeer::retrieveByPk ( $client );
		//Retrieve Technician Information
		$tech_info = UserPeer::retrieveByPk ( $tech_id );
		//Test for device values
		if ($specification == - 2) {
			$device = 'All';
		}
		if(!$preventative_exist){
			$workorder = new Workorder ( );
		}else
		$workorder = $preventative_exist;
			
		$workorder_ptech = new WorkorderTech ( );
		$workorder_stech = new WorkorderTech ( );

		if (! empty ( $mode )) {
			if ($mode == 'edit') {
				if (! empty ( $workorder_id )) {
					$workorder = WorkorderPeer::retrieveByPk ( $workorder_id );
					$workorders = WorkorderTechPeer::getWorkorderTechs ( $workorder_id );
					foreach ( $workorders as $wods ) {
						$wods->delete ();
					}
				}
				$client = $this->getRequestParameter ( 'client_edit' );
			}
		}


		//get rid of the workorder queried in edit mode
		if($preventative_exist)
		$workorder = $preventative_exist;
			
		if($reason == 17 || $reason == 23){
			$this->setDevicesStatus($client,'pm scheduled');
		}

		if($mode != 'edit') $workorder->setJobScheduledDate($job_date);


		//if we have a unscheduled preventative for this month we want to overwrite it with new data
		if($preventative_exist){
			$workorder->setJobStatusId(9);
		}


		$futureWo = $this->createUpcomingweekWorkorder($workorder_dates);


		if (! empty ( $mode )) {
			if ($mode == 'edit') {
				$workorder->save ();
				$workorder_ptech->save ();
				$workorder_stech->save ();
				$this->redirect ( 'scheduler/index' );
			}
		} else if ($mode != 'edit') {

			if ($job_status == 'scheduled') {

				foreach($futureWo as $currentWo){
					$workorder_pptech = new WorkorderTech ( );
					$workorder_sstech = new WorkorderTech ( );
						
					$workorder_pptech->setUserId ( $tech_id );
					$workorder_pptech->setWorkorderId ( $workorder_id );
					$workorder_sstech->setUserId ( $stech_id );
					$workorder_sstech->setWorkorderId ( $workorder_id );

						
					$f = new Criteria ( );
					$f->add ( WorkorderPeer::JOB_DATE, $job_date );
					$f->add ( WorkorderPeer::JOB_STATUS_ID, 9 );
					$f->add ( WorkorderPeer::TECH, $tech_id );

					$technician = UserPeer::retrieveByPk ( $tech_id );
					$second_technician = UserPeer::retrieveByPk ( $stech_id );

					$scheduler = new TechnicianScheduler ( $technician, $job_date );

					if($second_technician != NULL)
					$scheduler_2 = new TechnicianScheduler ( $second_technician, $job_date );
						

					$currentWo->save ();
						
						
					$workorder_pptech->setWorkorderId ( $currentWo->getId () );
					$workorder_pptech->save ();

					if($second_technician != NULL){
						$workorder_sstech->setWorkorderId ( $currentWo->getId () );
						$workorder_sstech->save ();
					}//if
				}//foreach

			}//if
		}

		$this->date = $workorder->getJobDate ();
		$this->redirect ( 'scheduler/index' );
	}
	//is date X months from today (2006-04-11)
	private function isDateDiff($pastDate,$monthsDiff){

		$date = explode('-',$pastDate);
			
		$month = (int)$date[1];
		$year = (int)$date[0];
		$day = (int)$date[2];

		$m = date('m');
		$d = date('d');
		$y = date('Y');
		if($year == $y && (abs($month-$m)>=$monthsDiff) ) {
			return true;
		}elseif( $year == $y && abs($month-$m)< $monthsDiff ){
			return false;
		}else{//years are equal
			$diff_year = abs($year-$y) * 12;
			$t_m_diff = abs($month-$m);
			$m_diff = $t_m_diff + $diff_year;

			if($m_diff >= $monthsDiff)
			return true;
			else
			return false;
		}


	}
	function isPassedDate($date){
	  $date = strtotime($date);
	  $current_date = strtotime(date('Y-m-d'));
	  if($date < $current_date)
	    return true;
	  return false;
	}
	public function executeCheckEndOfDay(){
 
    //the selected date on the calendar
    $job_date = $this->getRequestParameter('use_date');
		

		//when MWF OR TT JOB SCHEDULE get parameter
		$mwf = $this->getRequestParameter('mwf');
		$tt = $this->getRequestParameter('tt');
			
		$tech_id = $this->getRequestParameter('techid');
		$stech_id = $this->getRequestParameter('stechid');
		$end_time = $this->getRequestParameter('end_time');
		$start_time = $this->getRequestParameter('start_time');
	  $checked_day = $this->getRequestParameter('checked_day');//days that are checked, ex. 0,0,0,1,1
    $using_checked = $this->getRequestParameter('using_checked');
    $checked_day = explode(',',$checked_day); 
    $d_o_w = date('w'); //day of week ... sat=0...sun=6
    $d_o_w -= 1; //we want it to start at zero to match the array
    //find the first checked day
    $index = -1;
    $d_index = array('0'=>'mon','1'=>'tue','2'=>'wed','3'=>'thu','4'=>'fri');
    $for_next_week = array();
    $current_week = array();
 
  
    $mwf_tt_dates = $this->getUpcomingWeek('mtwtf', $job_date); //dates of the upcoming week
    $c_week = $this->getWeekDates($job_date); //dates of the current week
         
         $today_date = date ( 'Y-m-d' );
         

         //checking to to see if we are scheduling a job for a future week
         $future_week = true;
         foreach($c_week as $c_date){
           //print "$today_date == $c_date<br/>";
           if($today_date == $c_date){
             $future_week = false;
             break;
           }
         }
         //var_dump('----------------------------------------');
         //$future_week = in_array($job_date,$c_week);
         //var_dump($today_date);
         //var_dump($c_week);
         //var_dump($future_week);
         //var_dump( $c_week,"<br/><br/><br/>",$mwf_tt_dates,"<br/><br/><br/>",$job_date);
        
        //var_dump($future_week);
        if(is_array($checked_day)){

           for($i = 0; $i < count($checked_day); $i++){
             //future_week tells us that we don't need to worry about a future dates
             //over to another week, because we are scheduling dates for the future week
             //not the current week
             //if($checked_day[$i] == 1 and (($i+1) < $d_o_w) and (!$future_week or $this->isPassedDate($mwf_tt_dates[$d_index[$i]]))){
             
             $n_date = $c_week[$d_index[$i]]; //date for this day
             if($checked_day[$i] == 1 and $this->isPassedDate($n_date) ){
               $for_next_week[] = $mwf_tt_dates[$d_index[$i]];
             }elseif($checked_day[$i] == 1){  
               $current_week[] = $c_week[$d_index[$i]];
             }
           }
        } 
        $checked_day = array_merge($current_week,$for_next_week);
        $checked_day_str = implode(',',$checked_day);
	 
			
		$technician = UserPeer::retrieveByPk ( $tech_id );
		$second_technician = UserPeer::retrieveByPk ( $stech_id );
		$ticket = $this->getRequestParameter('wid');
		$client_id = $this->getRequestParameter('client_id');
			

			
		$workorder = new Workorder();
		$workorder->setJobDate ( $job_date );
		$workorder->setJobStart ( $start_time );
		$workorder->setJobEnd ( $end_time );

			
		$pmInLast6Months = 'false';
		if(!empty($client_id) && !empty($tech_id)){

			$c = new Criteria();
			$c->add(WorkorderPeer::TECH,$tech_id);
			$c->add(WorkorderPeer::CLIENT_ID,$client_id);
			$c->addDescendingOrderByColumn(WorkorderPeer::JOB_DATE);
			$c->setLimit(1);
			$pastWO = WorkorderPeer::doSelect($c);
			if($pastWO)  ;
			$pmInLast6Months = 'true';

		}


		if(!empty($ticket)){
			$val = "
		    	{
		    		status: 'ok'
		    	}";
			print $val;
			return sfView::NONE;
		}

		if($technician != null){
			$allow =  ($end_time>$technician->getEndTime())? 'true': 'false';
			if($allow=='true'){
				$tech_end_time = $technician ->getEndTime();
				$tech_name = $technician->getDisplayName();
				$val = "
				{
				status: 'unavailable',
				tech_id: '$tech_id',
				stechid: '$stech_id',
				end_time: '$end_time',
				techEndTime: '$tech_end_time',
				name: '$tech_name'
			}";
			print $val;
			return sfView::NONE;
			}
		}
			
		if($second_technician != null){
			$allow =  ($end_time>$second_technician->getEndTime())? 'true': 'false';
			if($allow=='true'){
				$tech_end_time = $second_technician ->getEndTime();
				$tech_name = $second_technician->getDisplayName();
				$val = "
				{
				status: 'unavailable',
				tech_id: '$tech_id',
				stechid: '$stech_id',
				end_time: '$end_time',
				techEndTime: '$tech_end_time',
				name: '$tech_name'
			}";
			print $val;
			return sfView::NONE;
			}
		}
			
		$scheduler = new TechnicianScheduler ( $technician, $job_date );

		if($second_technician != null)
		$scheduler_2 = new TechnicianScheduler ( $second_technician, $job_date );

         // $checked_day = $this->getRequestParameter('checked_day');
        //$using_checked = $this->getRequestParameter('using_checked');
       

		//--------------------------------------------------------------
		//if this is a MWF - TT schedule job
		
		if($using_checked){
 
            $mwf_tt_dates = $checked_day; //dates of the days that were checked
			if($mwf_tt_dates){
          
				foreach ($mwf_tt_dates as $job_date){
					
					$mwf_tt_scheduler = new TechnicianScheduler ( $technician, $job_date );
					if($second_technician != null)
						$mwf_tt_schedulerscheduler_2 = new TechnicianScheduler ( $second_technician, $job_date );
					
					$tempWo = new Workorder();
					$tempWo->setJobDate ( $job_date );
					$tempWo->setJobStart ( $start_time );
					$tempWo->setJobEnd ( $end_time );
					
	
					if($mwf_tt_scheduler->isSchedulable ( $tempWo )){

						if($mwf_tt_schedulerscheduler_2 != null && !$mwf_tt_schedulerscheduler_2->isSchedulable ( $tempWo )){
							$val = "
							{
							recentPm: '$pmInLast6Months',
							status: 'overlapping',
                            checked_dates: '$checked_day_str'
							}";
							print $val;
							return sfView::NONE;
						}
						//DO NOTHING IF IT IS SCHEDULABLE SO WE CAN CHCK OTHER DATES AND CONTUNUE DOWN CODE
					}else{
						$val = "
						{
						recentPm: '$pmInLast6Months',
						status: 'overlapping',
                        checked_dates: '$checked_day_str'
						}";
						print $val;
						return sfView::NONE;
					}//if			
				}//foreach
			}//if
		}//if  
		
		//--------------------------------------------------------------
		



		if($scheduler->isSchedulable ( $workorder )){
			if($scheduler_2 != null && !$scheduler_2->isSchedulable ( $workorder )){
				$val = "
				{
				recentPm: '$pmInLast6Months',
				status: 'overlapping',
                checked_dates: '$checked_day_str'
			}";
			print $val;
			return sfView::NONE;
			}
			$val = "
			{
			recentPm: '$pmInLast6Months',
			status: 'ok',
            checked_dates: '$checked_day_str'
		}";
		print $val;
		return sfView::NONE;
		}else{
			$val = "
			{
			recentPm: '$pmInLast6Months',
			status: 'overlapping',
            checked_dates: '$checked_day_str'
		}";
		print $val;
		return sfView::NONE;
		}


			
			 

			
	}
	private function getNextBusinessDays($date, $number_ofdays) {
		$unix_date = strtotime ( $date );



		$month = date ( 'n', $unix_date);
		$day = date ( 'j', $unix_date ) - 1;
		$year = date ( 'Y', $unix_date );

		$day_of_week = date ( 'w', $unix_date );

		$business_days = array ( );
		for($i = 1; $i <= $number_ofdays; $i ++) {

			$active_day = mktime ( 0, 0, 0, $month, $day, $year );
			$next_day = mktime ( 0, 0, 0, $month, $day + 1, $year );

			if (date ( 'w', $next_day ) == 0 or date ( 'w', $next_day ) == 6) { //it is sunday. get next five days
				$number_ofdays ++; //we need to an extra iteration because we are skipping a weekend day
				$day ++; //move to next day
				continue;
			} else {
				$business_days [] = date ( 'Y-m-d', $next_day );
				$day ++;
			}
		} //
		return $business_days;
	}

	public function executePopulateTechDisplay() {
        
 
		$this->date = $this->getRequestParameter ( 'date' );
		$tech_id = $this->getRequestParameter ( 'tech_id' );
        if(empty($this->date))
            $this->getUser ()->setAttribute ( 'calendar_date', $this->date );
			
		//Builds tech tabs


		$t = new Criteria ( );
		$t->add ( UserPeer::USER_TYPE_ID, '1' );
		$t->addAscendingOrderByColumn ( UserPeer::WEIGHT );
		$t->addAscendingOrderByColumn ( UserPeer::LAST_NAME );
		$this->tech_info = UserPeer::doSelect ( $t );

		//$this->tech_info = UserPeer::getUserByType(1);


		//Build tech schedules
		$tech_results;
		if ((isset ( $tech_id )) && ($tech_id != 'all')) {
			$tech_results = UserPeer::retrieveByPks ( $tech_id );
		} else {
			$tech_results = $this->tech_info;
		}
 
		$this->schedules = array ( );
		foreach ( $tech_results as $technician ) {
                if(is_numeric($tech_id)){
                    $weekDates = $this->getWeekDates($this->date);
			        $this->schedules [] = new TechnicianScheduler ( $technician, $weekDates['mon'] );
                    $this->schedules [] = new TechnicianScheduler ( $technician, $weekDates['tue'] );
                    $this->schedules [] = new TechnicianScheduler ( $technician, $weekDates['wed'] );
                    $this->schedules [] = new TechnicianScheduler ( $technician, $weekDates['thu'] );
                    $this->schedules [] = new TechnicianScheduler ( $technician, $weekDates['fri'] );
                }else
                    $this->schedules [] = new TechnicianScheduler ( $technician, $this->date );
           
		}
	}

	public function executeEditWorkorder() {
		//Set mode to "edit"
		$this->mode = 'edit';

		//Populate Client Dropdown menu
		$this->selectClient = ClientPeer::doSelect ( new Criteria ( ) );

		$this->client_select = $this->getRequestParameter ( 'client_select' );

		//Populate Dropdown
		$g = new Criteria ( );
		$g->add ( DropdownPeer::MENU, 'reason' );
		$this->reason_dropdown = DropdownPeer::doSelect ( $g );

		//get Workorders based on selection
		$this->workorder_id = $this->getRequestParameter ( 'workorder_id' );

		$this->edit_workorder = WorkorderPeer::retrieveByPk ( $this->workorder_id );

		$this->date = $this->edit_workorder->getJobDate ();

		$this->technician = UserPeer::retrieveByPk ( $this->edit_workorder->getTech () );

		//parse start time
		$start_time = $this->edit_workorder->getJobStart ();
		$this->start_time_minutes = $start_time % 100;
		$this->start_time_hours = ($start_time - $this->start_time_minutes) / 100;

		//parse end time
		$end_time = $this->edit_workorder->getJobEnd ();
		$this->end_time_minutes = $end_time % 100;
		$this->end_time_hours = ($end_time - $this->end_time_minutes) / 100;

		//get Device information


		if ($this->edit_workorder->getDeviceId () == 0) {
			$this->specification_select = - 2;
		} else {
			$device = DevicePeer::retrieveByPk ( $this->edit_workorder->getDeviceId () );
			$this->specification_select = $device->getSpecificationId ();
		}

		//Get Client Information
		$this->client = ClientPeer::retrieveByPk ( $this->edit_workorder->getClientId () );

		//Get Device Dropdown information
		$c = new Criteria ( );
		$c->add ( DevicePeer::CLIENT_ID, $this->client->getId () );

		$specification_result = DevicePeer::doSelectJoinSpecification ( $c );

		$specification_options = array ( );

		//set results of table join to array for use in dropdown
		$specification_options [- 1] = 'Please Select...';
		$specification_options [- 2] = 'All Devices';
		foreach ( $specification_result as $result ) {
			$specification_options [$result->getSpecification ()->getId ()] = $result->getSpecification ()->getDeviceName ();
		}
		$this->specification_options = $specification_options;

		//populate device lists
		$c = new Criteria ( );
		$c->add ( DevicePeer::CLIENT_ID, $this->client_select );
		$c->add ( DevicePeer::SPECIFICATION_ID, $this->specification_select );
		$device_result = DevicePeer::doSelect ( $c );

		$device_options = array ( );

		$device_options [- 1] = 'Please Select...';
		foreach ( $device_result as $result ) {
			$device_options [$result->getId ()] = $result->getIdentification ();
		}
		$this->device_options = $device_options;

	}

	private function getDrivingDistance($address1,$address2){

		$a = urlencode($address1);
		$b = urlencode($address2);
		$url = "http://maps.google.com/maps";
		$query = "q=from+$a+to+$b&output=kml";
		$full_url= $url."?".$query;


		$fp = fopen($full_url,'r');
		while($data = fread(($fp),1024)){
			$kml .= $data;
		}
//Commented this out first as line 1380 is where it initially broke.
// apps/atlbiomed/lib/GoogleMapCache.php had an issue after commenting this out. To 
// see the issue uncomment the section I commented out in apps/atlbiomed/lib# nano GoogleMapCache.php 
// and then go to the Scheduler in the portal and select a client. That happens without selecting a 
// client with the below uncommented. 
//  -Chris
/*		if(!empty($kml)){
			$xml_object = new SimpleXMLElement($kml);
			$totalPlacemark = count($xml_object->Document->Placemark);
			$lastPlacemark = $xml_object->Document->Placemark[$totalPlacemark-1];

			$distance_info = split ('mi', $lastPlacemark->description[0]);
			$mileage = str_replace('Distance: ','',$distance_info[0]);


			$time_str = str_replace('(about','',$distance_info[1]);
			$time_str = str_replace('hours','hour',$time_str);
			$hourTextPos = strrpos($time_str, "hour");

			$time_arr = explode('hour', $time_str);

			if($hourTextPos!==false){
				$hours = $time_arr[0];
				$min= $time_arr[1];
			}
			else{
				$hours = 0;
				$min = $time_arr[0];
			}
		}//if
*/

		return array('hours'=>$hours,'min'=>$min);
	}
	public function executeFirstAvailable() {

		//the current selected client
		$date = $this->getRequestParameter ( 'date' );
		if(!empty($date)){

		}elseif ($this->getUser ()->getAttribute ( 'calendar_date' ) != '' and $this->getUser ()->getAttribute ( 'calendar_date' ) != NULL)
		$date = $this->getUser ()->getAttribute ( 'calendar_date' );
		else
		$date = date ( 'Y-m-d' );

		$client_id = $this->getRequestParameter('client_id');
		//this is only set when in edit mode

		if(empty($client_id)){
			//check session to see if we have a value there. //set by index when in edit mode
			$client_id = $this->getUser()->getAttribute('session_client_id');

			/*
			 * NOTE: if cookie is off  and client id didn't come from url error will occur
			 */
		}//if


		//get client information
		$client_data = ClientPeer::retrieveByPk ( $client_id );
		$this->getUser ()->setAttribute ( 'calendar_date', $date );

		//get all technicians
		$this->availableTechnicians = UserPeer::getUserByType ( 1 );
		$this->availableTimes = array ( );

		//go through each technician that we found
		foreach ( $this->availableTechnicians as $technician ) {
			$this->availableTimes [$technician->getId ()] = $this->getFirstAvailableJobStartTime($technician->getId (), $client_id, $date);
		}// foreach
	}

	public function executePopulateMapWithJobs() {

         $assignedIconColors = array('29'=>'grey','11'=>'green','9'=>'mauv','7'=>'orange','30'=>'pink','31'=>'red','34'=>'teal','35'=>'white','36'=>'yellow');

		//$assignedIconColors = array('29'=>'red','26'=>'blue','23'=>'lightblue','24'=>'lightgreen','22'=>'orange','11'=>'pink',
		//'21'=>'purple','9'=>'yellow','10'=>'grey','7'=>'brown','31'=>'green','30'=>'brightred');

		//$assignedColors = array('29'=>'#fc6355','26'=>'#5781fc','23'=>'#58dee0','24'=>'#00e13c',
		//'22'=>'#ff9900','11'=>'#e14f9e','21'=>'#7e55fc','9'=>'#fcf357','10'=>'#666666','7'=>'brown', '31'=>'green','30'=>'#ff0000');
         $assignedColors = array('29'=>'#949494','11'=>'#3c8a39','9'=>'#b66963','7'=>'#da8a2a','30'=>' 	#dc9bdc','31'=>'#d2382d','34'=>'#58d7e3','35'=>'#ffffff','36'=>'#d8d235');

		if ($this->getUser ()->getAttribute ( 'calendar_date' ) != '' and $this->getUser ()->getAttribute ( 'calendar_date' ) != NULL)
		$this->date = $this->getUser ()->getAttribute ( 'calendar_date' );
		else
		$this->date = date ( 'Y-m-d' );

        $this->date = $this->getRequestParameter('use_date');

		$this->availableTechnicians = UserPeer::getUserByType ( 1 );
		$this->availableTimes = array ( );
		//var_dump($this->availableTechnicians);

//var_dump($this->date,$this->getUser ()->getAttribute ( 'calendar_date' ));
		$this->technician = array();

		$count = 0;
		foreach ( $this->availableTechnicians as $technician ) {


			$scheduler = new TechnicianScheduler ( $technician, $this->date );

			$workorder = $scheduler->getWorkorders();


			//fill job details
			//multiple jobs for this technician
			if(is_array($scheduler->getWorkorders())){
				$job = array();
				foreach ($scheduler->getWorkorders() as $workorder){
					$client = $workorder->getClient();
					$clientName = $client->getClientName();
					$jobStart = $workorder->getJobStart();
					$jobEnd = $workorder->getJobEnd();
					$clientAddress =  $client->getaddress() . ' ' . $client->getCity(). ' '. $client->getState().' '. $client->getZip();
					$job[] = array('clientname'=>$clientName, 'address'=>$clientAddress, 'start'=>$jobStart, 'end'=>$jobEnd);

				}
			}else{ //single jobs for this technician
				if($workorder != NULL){
					$client = $workorder->getClient();
					$clientName = $client->getClientName();

					$jobStart = $workorder->getJobStart();
					$jobEnd = $workorder->getJobEnd();
					$clientAddress =  $client->getaddress() . ' ' . $client->getCity(). ' '. $client->getState().' '. $client->getZip();
					$job[] = array('clientname'=>$clientName, 'address'=>$clientAddress, 'start'=>$jobStart, 'end'=>$jobEnd);
				}
			}
			//---------------------------
			usort(&$job, array(get_class($this), 'uksort_job_time'));
			$avail = $scheduler->getFirstAvailableStartTime ();
			//we have a time when the tech is available so not a full day schedule

			$add = $technician->getAddress();

			if(isset($avail) and (!empty($add) or count($job)>0) and count($job)){
				$techAddress = $technician->getAddress(). ' '.$technician->getCity() .' '. $technician->getState() . ' ' . $technician->getZip();
				$this->technician[] = array('jobs'=>$job, 'schedule'=>$schedule, 'techId'=>$technician->getId(),
										'name'=>$technician->getDisplayName(), 'techAddress'=>$techAddress,'lat'=>'', 'lon'=>'');
			}
			$this->availableTimes [$technician->getId ()] = $scheduler->getFirstAvailableStartTime ();
			$count++;
		}//for each



			
		require('GoogleMapAPI.class.php');

		$map = new GoogleMapAPI('map');
		$map->setAPIKey(sfConfig::get('app_google_maps_api_key'));

			
		$techInfoAndGeoData = array();
		foreach($this->technician as $technician){
			//tech has no job
			$t_id = (string)$technician['techId'];


			$pre_name_color = "pin_".$assignedIconColors[$t_id];
			$icon_color = $iconColors[$iconCounter];


			$geodata = array();
			//get location for each job or address
			for($i = 0; $i< count($technician['jobs']); $i++){
					
				$tech_icon = $pre_name_color . ($i+1);
				//print $tech_icon."<br/>";
				$address = !empty($technician['jobs'][$i]['address']) ? $technician['jobs'][$i]['address'] : $technician['techAddress'];
				$geodata = $map->getGeocode($address);
				//$techInfoAndGeoData[] = array('color'=>$htmlColors[$icon_color], 'id'=>$technician['techId'],'icon'=>$tech_icon,'name'=>$technician['name'],'jobNumber'=>($i+1),'jobStart'=>$technician['jobs'][$i]['start'],'jobEnd'=>$technician['jobs'][$i]['end'],'clientName'=>$technician['jobs'][$i]['clientname'],'address'=>$address,'lat'=>$geodata['lat'],'hasjob'=>1, 'lon'=>$geodata['lon']);
				$techInfoAndGeoData[] = array('color'=>$assignedColors[$t_id], 'id'=>$technician['techId'],'icon'=>$tech_icon,'name'=>$technician['name'],'jobNumber'=>($i+1),'jobStart'=>$technician['jobs'][$i]['start'],'jobEnd'=>$technician['jobs'][$i]['end'],'clientName'=>$technician['jobs'][$i]['clientname'],'address'=>$address,'lat'=>$geodata['lat'],'hasjob'=>1, 'lon'=>$geodata['lon']);

					
				$tech_icon="";
			}
			if(!count($technician['jobs'])){
				$tech_icon = $pre_name_color ;
				//print $tech_icon."---<br/>";
				$geodata = $map->getGeocode($technician['techAddress']);
				if(!empty($geodata['lat'])){
					//$techInfoAndGeoData[] = array('color'=>$htmlColors[$icon_color], 'id'=>$technician['techId'],'icon'=>$tech_icon."1",'name'=>$technician['name'],'address'=>$technician['techAddress'],'lat'=>$geodata['lat'],'hasjob'=>0, 'lon'=>$geodata['lon']);
					$techInfoAndGeoData[] = array('color'=>$assignedColors[$t_id], 'id'=>$technician['techId'],'icon'=>$tech_icon."1",'name'=>$technician['name'],'address'=>$technician['techAddress'],'lat'=>$geodata['lat'],'hasjob'=>0, 'lon'=>$geodata['lon']);
				}
				$tech_icon = "";
			}
		}// for each
			
		$clientID = $this->getRequestParameter('clientid');
		 

		$client_data = ClientPeer::retrieveByPk ( $clientID );
		if($client_data != NULL){
			$sel_clientName = $client_data->getClientName();
			$sel_clientAddress = $client_data->getAddress() . ' '.$client_data->getCity().' '.$client_data->getState().' '.$client_data->getZip();

			$geoCord = new GoogleMapCache();
			$client_geodata = $geoCord->getCordinateCache($clientID);//$map->getGeocode($sel_clientAddress);


			$client_lat = $client_geodata['lat'];
			$client_lon = $client_geodata['lon'];
			$client_icon = "star";

		}
		 
		print "
		{
		'client':
		{
		icon: '$client_icon',
		clientname: '$sel_clientName',
		clientaddress: '$sel_clientAddress',
		client_geodata: '$client_geodata',
		lat: '$client_lat',
		lon: '$client_lon'
	}
	,
	'info':[";
	for($i=0; $i<count($techInfoAndGeoData);$i++){
		$tech_id = $techInfoAndGeoData[$i]['id'];
		$tech_color = $techInfoAndGeoData[$i]['color'];
		$icon = $techInfoAndGeoData[$i]['icon'];
		$name = $techInfoAndGeoData[$i]['name'];
		$address = $techInfoAndGeoData[$i]['address'];
		$jobNumber = $techInfoAndGeoData[$i]['jobNumber'];
		$jobStart = $techInfoAndGeoData[$i]['jobStart'];
		$jobEnd = $techInfoAndGeoData[$i]['jobEnd'];
		$lat = $techInfoAndGeoData[$i]['lat'];
		$clientName = $techInfoAndGeoData[$i]['clientName'];
		$lon = $techInfoAndGeoData[$i]['lon'];
		$hasjob = $techInfoAndGeoData[$i]['hasjob'];
		print "{";
		print "id:'$tech_id', color: '$tech_color', icon: '$icon', hasjob: $hasjob,name: '$name', address: '$address', clientname: '$clientName', jobnumber: '$jobNumber', jobstart: '$jobStart', jobend: '$jobEnd', lat: '$lat', lon: '$lon'";
		print "}";
		if($i != count($techInfoAndGeoData)-1) print ",";
	}
	print "]}";
	return sfview::NONE;
	}
	private function preventitaveThisMonth($client_id, $reason, $date){
			
		$date_ar = explode('-',$date);
		$year = $date_ar[0];
		$month = $date_ar[1];
		$day = $date_ar[2];
		$date_int = mktime(0,0,0,$month,1,$year);

		if($reason != 17) return false;
			
		$connection = Propel::getConnection();
		$query = "SELECT %s FROM %s WHERE (( MONTH(%s) = $month and YEAR(%s) = $year ) ) and %s = $client_id and %s = 17 and job_status_id = 10";
		$query = sprintf($query, WorkorderPeer::ID, WorkorderPeer::TABLE_NAME, WorkorderPeer::JOB_SCHEDULED_DATE, WorkorderPeer::JOB_SCHEDULED_DATE, WorkorderPeer::CLIENT_ID, WorkorderPeer::REASON);
		$statement = $connection->prepareStatement($query);
			
		$result = $statement->executeQuery();
		$pks = array();
		while($result->next()){
			$pks[] = $result->getInt('ID');
		}

		$c = new Criteria();
		$c->add(WorkorderPeer::ID, $pks, Criteria::IN);
		$c->setLimit(1);
			
		$job = WorkorderPeer::doSelect($c);
			
		if($job == NULL){
			//we didn't find any unscheduled workorder now we will search previous months
			$client = ClientPeer::retrieveByPk($client_id);
			$frequencyTxt = ($client->getFrequency())? $client->getFrequency()->getContents() : '';
			$freq_ar = explode(',',$frequencyTxt);

			usort( $freq_ar, array( "schedulerActions" , "monthSortRev" ) );

			if(empty($freq_ar[0])) $freq_ar = array(); //if first element is null string entire array is empty

			foreach($freq_ar as $freq){
					
				$_month = $this->monthToNum($freq);
				$_date = $year."-".$_month."-01";

				$query = "SELECT %s, %s FROM %s WHERE (( MONTH(%s) = $_month and YEAR(%s) = $year )) and %s = $client_id and %s = 17 and job_status_id = 10 LIMIT 1";
				$query = sprintf($query, WorkorderPeer::ID, WorkorderPeer::JOB_DATE, WorkorderPeer::TABLE_NAME, WorkorderPeer::JOB_SCHEDULED_DATE, WorkorderPeer::JOB_SCHEDULED_DATE, WorkorderPeer::CLIENT_ID, WorkorderPeer::REASON);
				$statement = $connection->prepareStatement($query);
				$result = $statement->executeQuery();
				$pks = array();
					

					
					
				while($result->next()){
					$found_job_date = $result->get('JOB_DATE');
					$pks[] = $result->getInt('ID');
				}
				$found_job_date_ar = explode('-',$found_job_date);
					
				//convert the job date to unix timestamp
				$found_job_date_year = $found_job_date_ar[0];
				$found_job_date_month = $found_job_date_ar[1];
				$found_job_date_day = $found_job_date_ar[2];
				$found_job_date_int = mktime(0,0,0,$found_job_date_month,1,$found_job_date_year);
				$job_date_found = null;
					

				if($date_int < $found_job_date_int)
				continue;
					
					
				$c = new Criteria();
				$c->add(WorkorderPeer::ID,$pks,Criteria::IN);
				$c->setLimit(1);
				$job = WorkorderPeer::doSelect($c);
					
				if($job){
					$job[0]->setJobDate($date);
					//var_dump($job[0]);exit;
					return $job[0];
				}
			}//for each
			//print "NOTHING";exit;
			return false;
		}
		else{
			//print "SAME";exit;
			$job[0]->setJobDate($date);
			return $job[0];
		}

			
			
			
	}
	//return military time when minutes and hours are added to it
	private function addNewTime($militaryTime, $hours, $mins){
			
		//print " HOURS: $hours MIN: $mins --- $militaryTime <br/>";

		$militaryTime = (int)$militaryTime;
		$mins = (int)$mins;
		$hours = (int)$hours;
		$militaryHours = (int)($militaryTime/100) * 100;
		$militaryMins = (int)($militaryTime % 100);
		$convertedMilitaryHours = $hours * 100;

			
		if(empty($hours) && empty($mins)){
			$time = $militaryTime;
		}elseif($militaryTime == 0){
			$time = ($hours * 100) + $mins;
		} //adding new minutes equal less than 1 hour
		elseif( ($militaryMins + $mins) < 60){
			//print "$militaryHours + $militaryMins + $mins<br/>";
			//$time =  ( $militaryHours + $convertedMilitaryHours + $mins);
			$time =  ( $militaryHours + $convertedMilitaryHours + $militaryMins + $mins);
		}elseif( ($militaryMins + $mins) > 60){
			$extraMilitaryHours = ((int)(($militaryMins + $mins) / 60)) * 100;
			$militaryMins = (int)(($militaryMins + $mins) % 60);
			$time =  ($militaryHours + $extraMilitaryHours + $militaryMins );
		}
		//print "FINAL: $time |<br/><br/>";
		return $time;

			
	}
	public function executeDeleteJob() {
		$workorder_id = $this->getRequestParameter ( 'id' );

		$workorder = WorkorderPeer::retrieveByPk ( $workorder_id );
		$workorder->delete ();

		$workorders = WorkorderTechPeer::getWorkorderTechs ( $workorder_id );
		foreach ( $workorders as $wods ) {
			$wods->delete ();
		}

		$this->redirect ( 'scheduler/index' );
	}
/*
	public function executeTechMap() {
		$tech_id = $this->getRequestParameter ( 'tech_id' );
		$map_date = $this->getRequestParameter ( 'date' );

		$tech = UserPeer::retrieveByPk ( $tech_id );
		$orders = WorkorderPeer::getOrdersForTechnician ( $tech_id, $map_date );

		$count = 0;

		$this->markers = array ( );
		foreach ( $orders as $order ) {
			$count ++;
			$pin = 'red' . $count;
			$address = $order->getClient ()->getAddress () . ' ' . $order->getClient ()->getCity () . ' ' . $order->getClient ()->getState () . ' ' . $order->getClient ()->getZip ();

			$jobDate = $order->getJobDate ();

			$content = 'Tech: ' . $tech->getLastName () . ', ' . $tech->getFirstName () . ' (' . $tech->getPhone () . ')<br />' . 'Client: ' . $order->getClient ()->getClientName () . '<br />' . 'Date: ' . $map_date . '<br />' . 'Time: ' . $order->getJobStart () . '-' . $order->getJobEnd ();

			if (! $order->getClient ()->getLocation ())
			$this->markers [] = new GMapMarker ( $address, '', '', $order->getClient ()->getClientName (), $content, $pin ); else
			$this->markers [] = new GMapMarker ( $address, $order->getClient ()->getLocation ()->getLatitude (), $order->getClient ()->getLocation ()->getLongitude (), $order->getClient ()->getClientName (), $content, $pin );

		}
	}
*/
	public function executeTechMap() {
		$tech_id = $this->getRequestParameter ( 'tech_id' );
		$map_date = $this->getRequestParameter ( 'date' );

        if(empty($map_date))
            $map_date = date ( 'Y-m-d' );
       
        $dates = $this->getWeekDates($map_date);
        $tech = UserPeer::retrieveByPk ( $tech_id );

        $this->markers = array ( );
        $color = array( 'red','blue','orange','green','grey');
        $dcount = 0;
        $buffer = "";
        $cc = 0;
        foreach($dates as $ddate){
		    $orders = WorkorderPeer::getOrdersForTechnician ( $tech_id, $ddate );
         
             
                 usort(&$orders, array(get_class($this), 'uksort_job_wo_time'));
		    $count = 0;
		    $pin_color = $color[$dcount++];
         
		    foreach ( $orders as $order ) {
                
                 $c = new Criteria();
                 $c->add(CordinatesPeer::ID,$order->getClientId());
                 $cord = CordinatesPeer::doSelectOne($c);
                 if($cord){
                    $lat = $cord->getLat();
                    $lon = $cord->getLon();
                   // print $order->getClient ()->getAddress () ." ".$lat." ".$lon."<br/>";
                 }
                 $add = $order->getClient ()->getAddress ();
                   
               
                
                $address = $order->getClient ()->getAddress () . ' ' . $order->getClient ()->getCity () .
                ' ' . $order->getClient ()->getState () . ' ' . $order->getClient ()->getZip ();
                $count++;
               
			    $pin = $pin_color . $count;
                 
                    $this->markers [] = new GMapMarker ( $address, "$lat", "$lon", $order->getClient ()->getClientName (), $content, $pin );
                    $c++;
                //$markers = "$c. $address {$order->getClient ()->getClientName ()}  $pin <br/>";
                //$buffer .="\n\n$ddate\t$address\t$pin_color\t$pin\t{$order->getClient ()->getClientName ()}\n\n";
                //print "$markers";$markers=array();
            }//foreach
            
        }//foreach 
        //$pass = file_put_contents('/home/atlantic_biomedical/web/images/dump.txt',$buffer); 
    }
    
	public  function executeSendEmail() {

		if ($this->getUser ()->getAttribute ( 'calendar_date' ) != '' and $this->getUser ()->getAttribute ( 'calendar_date' ) != NULL)
			$this->date = $this->getUser ()->getAttribute ( 'calendar_date' );
		else
			$this->date = date ( 'Y-m-d' );

		$date = $this->date;
		$tech_id = $this->getRequestParameter ( 'tech_id' );
        $this->emailComment = $this->getRequestParameter ( 'comment' );
		//Builds tech tabs

		$t = new Criteria ( );
		$t->add ( UserPeer::USER_TYPE_ID, '1' );
		$t->addAscendingOrderByColumn ( UserPeer::WEIGHT );
		$t->addAscendingOrderByColumn ( UserPeer::LAST_NAME );
		$this->tech_info = UserPeer::doSelect ( $t );

		//$this->tech_info = UserPeer::getUserByType(1);

		//Build tech schedules
		$tech_results;
		if ((isset ( $tech_id ))) {
			$technician = UserPeer::retrieveByPk ( $tech_id );
		}

		$this->schedules = array ( );
		$this->schedules [] = new TechnicianScheduler ( $technician, $this->date );

        $c = new Criteria();
        $drops = DropdownPeer::doSelect($c);
        $dropdowns = array();
        for($i=0; $i<count($drops); $i++){
            $dropdowns[$drops[$i]->getId()] = $drops[$i]->getValue();
        }
        $this->dropdowns = $dropdowns; 
	}
	private function getDeviceMenu($clientId){
		//populate 'Device' menu
		$c = new Criteria ( );
		$c->add ( DevicePeer::CLIENT_ID, $clientId );
		$c->addAscendingOrderByColumn ( DevicePeer::IDENTIFICATION );
		$c->addAscendingOrderByColumn ( DevicePeer::IDENTIFICATION );
		$specification_result = DevicePeer::doSelect ( $c );


		$specification_options = array ( );

		//set results of table join to array for use in dropdown
		$specification_options [0] = 'Please Select...';
		$specification_options [- 1] = 'No Device';
		$specification_options [- 2] = 'All Devices';
		$specification_options [- 3] = 'New Device';
		foreach ( $specification_result as $result ) {
			$specification_options [$result->getSpecification ()->getId ()] = $result->getSpecification ()->getDeviceName ();
		}
		return $this->specification_options = $specification_options;
	}
	private function uksort_job_time($a, $b)
	{
		if ($a['start'] == $b['start']) return 0;
		return ($a['start'] < $b['start']) ? -1 : 1;
	}
	private function uksort_job_wo_time($a, $b)
	{

		if ($a->getJobStart() == $b->getJobStart()) return 0;
		return ($a->getJobStart() < $b->getJobStart()) ? -1 : 1;
	}
	private function uksort_workers($a, $b)
	{
		if ($a->getJobStart() == $b->getJobStart()) return 0;
		return ($a->getJobStart() < $b->getJobStart()) ? -1 : 1;
	}
	private function convertToMilitary($time){

		$milHr = (int)($time/100) * 100;
		$remainder = ($time%100);

			

		if($remainder< 60)
		$min = $remainder;
		elseif($remainder== 60){
			$milHr += 100;
			$min = 0;
		}
		else
		{

			$milHr += ((int)($remainder/60)) * 100;
			$min = ($remainder%60);
		}
		return $milHr + $min;
	}
	private function getMilitaryTimeDiffInMin($time1,$time2){
		$t1Hr = (int)($time1/100);
		$t2Hr = (int)($time2/100);
		$t1min = ($time1 % 100);
		$t2min = ($time2 % 100);



		$hr = ($t1Hr - $t2Hr);
		$min = ($t1min - $t2min);



			
			
		return abs(($hr* 60) + $min);
	}
	public  function getFirstAvailableJobStartTime($techId, $toClientID, $date){
			 
		$googleCache = new GoogleMapCache();

		$JobSize= array();
		//$workorders = WorkorderPeer::getOrdersForTechnician($techId, $date);
		$tech = UserPeer::retrieveByPk ( $techId );
		$tech_start_time = $tech->getStartTime();
		$tech_end_time = $tech->getEndTime();

		$sch = new TechnicianScheduler($tech, $date);
		$techHomeAddress = $tech->getAddress().' '.$tech->getCity().' '.$tech->getState().' '.$tech->getZip();

		$c = new Criteria();
		$c->add(WorkorderPeer::TECH, $techId);
		$c->add(WorkorderPeer::JOB_DATE, $date);
		$c->addAscendingOrderByColumn(WorkorderPeer::JOB_START);
		$workorders = $sch->getWorkorders();
		//sort the work order by time
		usort(&$workorders, array(get_class($this), 'uksort_workers'));
			
		//get client info
		for($i =0; $i<count($workorders); $i++){
			$clientId[] = $workorders[$i]->getClientId();
		}

		$toClient = ClientPeer::retrieveByPk($toClientID);
		$toClientAdddress = ($toClient) ? $toClient->getAddress().' '.$toClient->getCity().' '.$toClient->getState().' '.$toClient->getZip() : null;
		$_clientId = ($toClient) ? $toClient->getId() : '';
			
		$address = array();
		$clientidArr = array();
			
		for($i = 0; $i < count($workorders); $i++){
			$jobClientId = $workorders[$i]->getClientId();
			$client = ClientPeer::retrieveByPk($jobClientId);

            //just in case this client was deleted from the DB we create an empty client to avoid an error
            if(empty($client))
                $client = new Client();

			$address[] = $client->getAddress().' '.$client->getCity().' '.$client->getState().' '.$client->getZip();
			$clientidArr[] = $client->getId();
			if($toClientAdddress != null && $address[$i] != null){
				//$drivingT = $this->getDrivingDistance($toClientAdddress, $address[$i]);

				$drivingT = $googleCache->getDrivingDistanceCache($jobClientId, $toClientID);
			}

			$hrs = $drivingT['hours'];
			$mins = $drivingT['min'];

			$JobSize[] = ($hrs * 100) + $mins;
			$jobSizeHrMin[] = array('hr'=>(int)$hrs,'min'=>(int)$mins);
		}//for


		//checking time before first job to see if we have room to insert this job
		if( $sch->getWorkorderAtTime($tech_start_time) == null ){//no job at start time yet

			//driving time from the tech's home to the job we are trying to schedule
			$drivingHtoC = $googleCache->getDrivingDistanceCache( $techId, $_clientId, true ); //true = check TECH to CLIENT travel time

			$_hrs = (int)$drivingHtoC['hours'];
			$_mins = (int)$drivingHtoC['min'];
			$_JobSize = ($_hrs * 100) + $_mins;
			$techDrivingTimeMin = ($_hrs * 60) + $_mins; //techs travel time from home

			//the driving time between the job we are trying to schedule and the next available time
			$drivingBetweenJobs = $googleCache->getDrivingDistanceCache( $_clientId, $clientidArr[0] );
			$_btweenHrs = (int)$drivingBetweenJobs['hours'];
			$_btweenMins = (int)$drivingBetweenJobs['min'];
			$_btweenJobsSize = ($_btweenHrs * 100) + $_btweenMins;
			$drivingTimebtweenJobsMins = ($_btweenHrs * 60) + $_btweenMins;

			if($workorders[0] != null) //we have a job at the start time
			$firstJobStartTime = $workorders[0]->getJobStart();
			else
			return $this->convertToMilitary($tech_start_time+$_JobSize);//the tech have no jobs scheduled

			$gapRequired = $techDrivingTimeMin + 45 + $drivingTimebtweenJobsMins;
			$jobGap = $this->getMilitaryTimeDiffInMin($workorders[0]->getJobStart(), $tech_start_time);

			if( $gapRequired <= $jobGap){
				$t = $tech_start_time;
				return $this->addNewTime($t,$_hrs,$_mins);
			}
		}//if


		for($i = 1; $i<count($workorders); $i++){
			$IndexOfLastJob = $i-1;
			$indexOfNextJob = $i;

			//get the difference in minutes
			$jobGap = $this->getMilitaryTimeDiffInMin($workorders[$indexOfNextJob]->getJobStart(), $workorders[$IndexOfLastJob]->getJobEnd());

			if($jobGap < 45) //the minimum time required for a job is 45 mins
			continue;

			//gets the driving time from tech current job location to client
			//$drivingT = $this->getDrivingDistance($toClientAdddress, $address[$IndexOfLastJob]);
			$drivingT =  $googleCache->getDrivingDistanceCache($_clientId, $clientidArr[$IndexOfLastJob]);
			$hrs = $drivingT['hours'];
			$mins = $drivingT['min'];
			$DrivingTime2Client =  ($hrs * 100) + $mins; //military time
			$DrivingTime2ClientMins = ($hrs * 60) + $mins; //driving time in mins

			//gets the driving distances between the job we are trying to schedule and the next job
			//on the techs schedule.
			//$drivingBetweenJobs = $this->getDrivingDistance($toClientAdddress, $address[$indexOfNextJob]);
			$drivingBetweenJob = $googleCache->getDrivingDistanceCache($_clientId,$clientidArr[$indexOfNextJob]);

			$_btweenHrs = (int)$drivingBetweenJobs['hours'];
			$_btweenMins = (int)$drivingBetweenJobs['min'];
			$_btweenJobsSize = ($_btweenHrs * 100) + $_btweenMins; //military time
			$drivingTimebtweenJobsMins = ($_btweenHrs * 60) + $_btweenMins;

			$requireJobGap = $DrivingTime2ClientMins + $drivingTimebtweenJobsMins + 45;

			if(  $requireJobGap <= $jobGap){
				$t = ($workorders[$IndexOfLastJob]->getJobEnd());
				$t= $this->addNewTime($t,$hrs,$mins);;
				return $t;
			}
		}//for




		$lastJobIndex = count($workorders)-1;

		$drivingBetweenJobs = $this->getDrivingDistance($toClientAdddress, $address[$lastJobIndex]);
		$hrs = (int)$drivingBetweenJobs['hours'];
		$mins = (int)$drivingBetweenJobs['min'];


		$drivingTime2Client =  ($hrs * 100) + $mins; //military time
			
			
		$drivingTime2ClientMins = ($hrs * 60) + $mins; //driving time in mins
			

		$requireJobGap = $drivingTime2ClientMins+ 45;
		$jobGap = $this->getMilitaryTimeDiffInMin($workorders[$lastJobIndex]->getJobEnd(), $tech_end_time);

		if( $requireJobGap < $jobGap){
			$t = $workorders[$lastJobIndex]->getJobEnd();


			$t = $this->addNewTime($t,$hrs,$mins);

			return $t;
		}
		else
		return null;
	}
	private function monthToNum($month){
		if($month=='JAN')
		return 1;
		elseif($month == 'FEB')
		return 2;
		elseif($month == 'MAR')
		return 3;
		elseif($month == 'APR')
		return 4;
		elseif($month == 'MAY')
		return 5;
		elseif($month == 'JUN')
		return 6;
		elseif($month == 'JUL')
		return 7;
		elseif($month == 'AUG')
		return 8;
		elseif($month == 'SEP')
		return 9;
		elseif($month == 'OCT')
		return 10;
		elseif($month == 'NOV')
		return 11;
		elseif($month == 'DEC')
		return 12;
	}
	private function monthSortRev($a, $b){
		if ($this->monthToNum($a) == $this->monthToNum($b)) {
			return 0;
		}
		return ($this->monthToNum($a) > $this->monthToNum($b)) ? -1 : 1;
	}
	private function setDevicesStatus($clientId, $text){
		$c = new Criteria();
		$c->add(DevicePeer::CLIENT_ID,$clientId);
		$devices = DevicePeer::doSelect($c);

		foreach($devices as $device){
			if( strtolower($device->getStatus()) != 'retired'){
				$device->setStatus($text);
				$device->save();
			}
		}
	}
	private function makeRemarks($clientId,$idsString){
		$ppage = $this->getRequestParameter('ppage');
		$isForMissing = !empty($ppage) ? true : false;

			
		if($isForMissing){
			$c = new Criteria();
			$c->add(DevicePeer::CLIENT_ID, $clientId);
			$c->add(DevicePeer::STATUS, strtolower('missing'));
			$c->addJoin(DevicePeer::SPECIFICATION_ID, SpecificationPeer::ID, CRITERIA::LEFT_JOIN);
			$devices = DevicePeer::doSelect($c);

		}else{

			if(empty($idsString)) return '';

			//otherwise for rrpage(aka. reschedule repair from process page)
			$ids_ar = explode(',',$idsString);

			$c = new Criteria();
			$c->add(DevicePeer::ID,$ids_ar, CRITERIA::IN);
			$c->addJoin(DevicePeer::SPECIFICATION_ID, SpecificationPeer::ID, CRITERIA::LEFT_JOIN);
			$devices = DevicePeer::doSelect($c);

		}//if

		$text = '';
		foreach($devices as $device){
			$id = $device->getIdentification();
			if($device->getSpecification()){
				$name= $device->getSpecification()->getDeviceName();
				$model= $device->getSpecification()->getModelNumber();
				$manufacturer= $device->getSpecification()->getManufacturer();
				$serial= $device->getSerialNumber();
				$text .= "$id - $name - $model - $manufacturer - $serial | ".PHP_EOL;
			}//if
		}//foreach
		return $text;
	}//function
}


