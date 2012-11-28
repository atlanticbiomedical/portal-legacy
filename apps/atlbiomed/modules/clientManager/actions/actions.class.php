<?php

/**
 * clientManager actions.
 *
 * @package    atlbiomed
 * @subpackage clientManager
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class clientManagerActions extends sfActions
{

	public function executeIndex()
	{ 
		$this->client_id = '';

		//populate Client Select dropdown
		$m = new Criteria();
		$m->addAscendingOrderByColumn(ClientPeer::CLIENT_IDENTIFICATION);

		$this->clients = array();
		foreach(ClientPeer::doSelect($m) as $client)
		{
			$this->clients[$client->getId()] = $client->getClientIdentification();
		}

		//Set Default "mode"
		if(!isset($this->mode))
		{
			$this->mode = '';
		}

		$this->isAdmin = $this->isAdmin();
		if($this->isAdmin())
			$this->unapproveLinkText = $this->getUnapproveFreqText();

		//initialize form values
		$this->populateClient = new Client();
		$this->populateDevice = new Device();
//		$this->populateSpecification = new Specification();
		if($this->getRequestParameter('mode') == 'report' || $this->getRequestParameter('mode') == 'report-view')
		{
			function csvEncode($string) {
				if (strpos($string, ',') !== false || strpos($string, '"') !== false || strpos($string, "\n") !== false) {
					$string = '"' . str_replace('"', '""', $string) . '"';
				}
				return $string;
			}

			$month_selector = $this->getRequestParameter('month');
			$month_selector = "%" . $this->getRequestParameter('month') . "%";

                        $connection = Propel::getConnection();
			$query = '
				SELECT
					c.client_identification as `client_identification`,
					c.client_name as `client_name`,
					c.attn as `contact`,
					c.phone as `phone`,
					c.city as `city`,
					CASE WHEN c.frequency LIKE "%s" THEN "Y" ELSE "x" END as legacy,
					CASE WHEN c.frequency_annual LIKE "%s" THEN "Y" ELSE "x" END as annual,
					CASE WHEN c.frequency_semi LIKE "%s" THEN "Y" ELSE "x" END as semi,
					CASE WHEN c.frequency_quarterly LIKE "%s" THEN "Y" ELSE "x" END as quarterly,
					CASE WHEN c.frequency_sterilizer LIKE "%s" THEN "Y" ELSE "x" END as sterilizer,
					CASE WHEN c.frequency_tg LIKE "%s" THEN "Y" ELSE "x" END as tg,
					CASE WHEN c.frequency_ert LIKE "%s" THEN "Y" ELSE "x" END as ert,
					CASE WHEN c.frequency_rae LIKE "%s" THEN "Y" ELSE "x" END as rae,
					CASE WHEN c.frequency_medgas LIKE "%s" THEN "Y" ELSE "x" END as medgas,
					CASE WHEN c.frequency_imaging LIKE "%s" THEN "Y" ELSE "x" END as imaging,
					CASE WHEN c.frequency_neptune LIKE "%s" THEN "Y" ELSE "x" END as neptune,
					CASE WHEN c.frequency_anesthesia LIKE "%s" THEN "Y" ELSE "x" END as anesthesia,
					c.all_devices as `T`,
					c.notes as `notes`
				FROM
					client c
				WHERE
					c.frequency LIKE "%s" OR
					c.frequency_annual LIKE "%s" OR
					c.frequency_semi LIKE "%s" OR
					c.frequency_quarterly LIKE "%s" OR
					c.frequency_sterilizer LIKE "%s" OR
					c.frequency_tg LIKE "%s" OR
					c.frequency_ert LIKE "%s" OR
					c.frequency_rae LIKE "%s" OR
					c.frequency_medgas LIKE "%s" OR
					c.frequency_imaging LIKE "%s" OR
					c.frequency_neptune LIKE "%s" OR
					c.frequency_anesthesia LIKE "%s"
				ORDER BY
					c.client_identification
			';

			$query = str_replace("%s", $month_selector, $query);
//			$output = $query . "\r\n\r\n" . $output;

                        $statement = $connection->prepareStatement($query);
                        $resultSet = $statement->executeQuery();

			

			if ($this->getRequestParameter('mode') == 'report') {

				$output = "Customer ID, Customer Name, Contact, Phone, City, Legacy, Annual, Semi, Quarterly, Sterilizer, Trace gas, ERT, Room air exchange, Medgas, Imaging, Neptune, Anesthesia, T, Notes\r\n";

        	                while($resultSet->next()){
					$output .= csvEncode($resultSet->get('client_identification')) . ",";
					$output .= csvEncode($resultSet->get('client_name')) . ",";
					$output .= csvEncode($resultSet->get('contact')) . ",";
					$output .= csvEncode($resultSet->get('phone')) . ",";
					$output .= csvEncode($resultSet->get('city')) . ",";
					$output .= csvEncode($resultSet->get('legacy')) . ",";
					$output .= csvEncode($resultSet->get('annual')) . ",";
					$output .= csvEncode($resultSet->get('semi')) . ",";
					$output .= csvEncode($resultSet->get('quarterly')) . ",";
					$output .= csvEncode($resultSet->get('sterilizer')) . ",";
					$output .= csvEncode($resultSet->get('tg')) . ",";
					$output .= csvEncode($resultSet->get('ert')) . ",";
					$output .= csvEncode($resultSet->get('rae')) . ",";
					$output .= csvEncode($resultSet->get('medgas')) . ",";
					$output .= csvEncode($resultSet->get('imaging')) . ",";
					$output .= csvEncode($resultSet->get('neptune')) . ",";
					$output .= csvEncode($resultSet->get('anesthesia')) . ",";
					$output .= csvEncode($resultSet->get('T')) . ",";
					$output .= csvEncode($resultSet->get('notes')) . ",";
					$output .= "\r\n";
				}

				$this->getResponse()->clearHttpHeaders();
				$this->getResponse()->setContentType('text/csv');
				$this->getResponse()->addCacheControlHttpHeader('no-cache');
	    			$this->getResponse()->setHttpHeader('Content-Disposition', 'attachment; filename=report.csv');
				$this->getResponse()->setHttpHeader('Content-length', strlen($output));
				$this->getResponse()->setContent($output);
//				echo $output;
			
//				$this->renderText($output);
//				return sfView::HEADER_ONLY;
				return sfView::NONE;
			} else {
				$output = '<form id="clientSelect" method="post" action="/index.php/clientManager">';
				$output .= '<input type="hidden" name="mode" id="mode" value="report" />';
				$output .= '<input type="hidden" name="month" id="month" value="' . $this->getRequestParameter('month') . '" />';
				$output .= '<input type="submit" name="commit" value="Download CSV" />';
				$output .= "<table>";
                                while($resultSet->next()){
					$output .= "<tr>";
                                        $output .= "<td>" . $resultSet->get('client_identification') . "</td>";
                                        $output .= "<td>" . $resultSet->get('contact') . "</td>";
                                        $output .= "<td>" . $resultSet->get('phone') . "</td>";
                                        $output .= "</tr>";
                                }
				$output .= "</table>";
				$output .= "</form>";
				$this->reportData = $output;
			}
		}

		if($this->getRequestParameter('mode') == 'edit')
		{

			$device_id = $this->getRequestParameter('input_device_id');
			if(!empty($device_id)){
				$c = new Criteria();
				$c->add(DevicePeer::IDENTIFICATION,$device_id);
				$theDevice = DevicePeer::doSelect($c);

				if($theDevice){
					$client_id = $theDevice[0]->getClientId();
					$this->foundDeviceId = $device_id;
				}else 
					return;
			}else
			//retrieve client information
			$client_id = $this->getRequestParameter('id');



			if(empty($client_id)){
				$this->redirect('clientManager/index');
			}

			//autogenerate a pdf report
			//$this->generateReport($client_id);
			//get pdf report data
			$this->finalReport = $this->getPdfReports($client_id);
			
			$this->client_id = $client_id;
			$this->populateClient = ClientPeer::retrieveByPk($client_id);
			$this->displayFreqApprove = $this->getDisplayFreqApprove($this->populateClient);
			$this->freqLocked = ($this->populateClient) ? $this->populateClient->getFreqLocked() : false;
			 
			
			$c = new Criteria();
			$c->add(DeviceCheckupPeer::CLIENT_ID,351);
			$passFailDates = DeviceCheckupPeer::doSelect($c);
			$this->passFailDates = $passFailDates;
		 
			
			$this->mode = 'edit';
			$anest = $this->populateClient->getAnesthesia();
			$mgas = $this->populateClient->getMedgas();
			
			if ($anest == 'Anest'){$this->anestValue = 1;}
			if ($mgas == 'MGas'){$this->medgasValue = 1;}	
			
			$locationId = $this->populateClient->getLocationId();
			
			//link devices to clients
			$c = new Criteria();
			$c->add(DevicePeer::CLIENT_ID, $client_id);
			$c->addjoin(DevicePeer::SPECIFICATION_ID, SpecificationPeer::ID, Criteria::LEFT_JOIN);
			//$c->addAscendingOrderByColumn(DevicePeer::IDENTIFICATION);
			
			$modSort = $this->getRequestParameter('modsort');
			$idSort = $this->getRequestParameter('didsort');
			$mSort = $this->getRequestParameter('msort');
			$dSort = $this->getRequestParameter('dsort');
			$sSort = $this->getRequestParameter('ssort');
			
			if(!empty($modSort) && $modSort=='asc')
				$c->addAscendingOrderByColumn(SpecificationPeer::MODEL_NUMBER);
			elseif(!empty($modSort) && $modSort=='dsc')
				$c->addDescendingOrderByColumn(SpecificationPeer::MODEL_NUMBER);
			elseif(!empty($idSort) && $idSort=='asc')
				$c->addAscendingOrderByColumn(DevicePeer::IDENTIFICATION);
			elseif(!empty($idSort) && $idSort=='dsc')
				$c->addDescendingOrderByColumn(DevicePeer::IDENTIFICATION);
			elseif(!empty($mSort) && $mSort=='asc')
				$c->addAscendingOrderByColumn(SpecificationPeer::MANUFACTURER);
			elseif(!empty($mSort) && $mSort=='dsc')
				$c->addDescendingOrderByColumn(SpecificationPeer::MANUFACTURER);
			elseif(!empty($dSort) && $dSort=='asc')
				$c->addAscendingOrderByColumn(SpecificationPeer::DEVICE_NAME);
			elseif(!empty($dSort) && $dSort=='dsc')
				$c->addDescendingOrderByColumn(SpecificationPeer::DEVICE_NAME);
			elseif(!empty($sSort) && $sSort=='asc')
				$c->addAscendingOrderByColumn(DevicePeer::SERIAL_NUMBER);
			elseif(!empty($sSort) && $sSort=='dsc')
				$c->addDescendingOrderByColumn(DevicePeer::SERIAL_NUMBER);
			else 
			    $c->addAscendingOrderByColumn(DevicePeer::IDENTIFICATION);
			
			$join = new sfPropelCustomJoinHelper('Device');
			$join->addSelectTables('Device', 'Specification');
			$join->setHas('Device', 'Specification');
			$this->populateDevice  = $join->doSelect($c); 
			
			$thedate = date('Y-m-d');
			
			
			$currentMonth = date('m');
			$currentYear = date('Y');
			$connection = Propel::getConnection();
			$query = "SELECT %s FROM %s WHERE YEAR(%s) <= $currentYear and MONTH(%s) <= $currentMonth and client_id=$client_id";
			$query = sprintf($query, WorkorderPeer::ID, WorkorderPeer::TABLE_NAME,WorkorderPeer::JOB_SCHEDULED_DATE, WorkorderPeer::JOB_SCHEDULED_DATE );
			 
			$statement = $connection->prepareStatement($query);
			$resultSet = $statement->executeQuery();
			$pastId = array();
			while($resultSet->next()){
				$pastId[] = $resultSet->get('ID');
			} 
			$passWorkOrderIdStr = implode(',',$pastId);
			$oldW = new Criteria();
			$upW = new Criteria();
			
			$oldW->add(WorkorderPeer::ID, $pastId, Criteria::IN);
/*
			$oldW->add(WorkorderPeer::CLIENT_ID, $this->populateClient->getId());
			$oldW->add(WorkorderPeer::JOB_DATE, $thedate, Criteria::LESS_THAN);
			$oldW->add(WorkorderPeer::JOB_DATE, $thedate, Criteria::EQUAL);
			$oldW->addDescendingOrderByColumn(WorkorderPeer::JOB_DATE);
*/
			$oldW->setLimit(3);
			
			
			$upW->add(WorkorderPeer::CLIENT_ID, $this->populateClient->getId());
			$upW->add(WorkorderPeer::JOB_SCHEDULED_DATE, $thedate, Criteria::GREATER_THAN);
			$upW->addAscendingOrderByColumn(WorkorderPeer::JOB_SCHEDULED_DATE);
			$upW->setLimit(2);
			
			
			$this->oldWork = WorkorderPeer::doSelect($oldW);
			$this->upcomingWork = WorkorderPeer::doSelect($upW);

		} else {

			$this->populateClient->setClientIdentification('');
			$this->populateClient->setClientName('');
			$this->populateClient->setAddress('');
			$this->populateClient->setAddress2('');
			$this->populateClient->setCity('');
			$this->populateClient->setState('');
			$this->populateClient->setZip('');
			$this->populateClient->setAttn('');
			$this->populateClient->setEmail('');
			$this->populateClient->setPhone('');
			$this->populateClient->setExt('');
			$this->populateClient->setCategory('');
			$this->populateClient->setNotes('');
			$this->populateClient->setAllDevices('');

		}		

		//check for initial postmod
		if ($this->getRequest()->getMethod() != sfRequest::POST)
		{
			return sfView::SUCCESS;
		}       $this->freak = ($this->populateClient);
	}
    
	public function executeGetPassFailByDate(){
		
		$requestData = $this->getRequestParameter('date_and_id');
 
		$requestData = explode('||',$requestData);
		$date = $requestData[0];
		$client_id = (int)$requestData[1];
		
 
		if(empty($date) or empty($client_id))
			return sfView::NONE;
		$c = new Criteria();
		$c->add(DeviceCheckupPeer::DATE, $date);
		$c->add(DeviceCheckupPeer::CLIENT_ID, $client_id);
		$c->addjoin(DeviceCheckupPeer::DEVICE_ID, SpecificationPeer::DEVICE_NAME, Criteria::LEFT_JOIN);
		$devices = DeviceCheckupPeer::doSelect($c);
		
 
			for($i = 0; $i<count($devices); $i++){
				$rows[] = array($devices[$i]->getDeviceId(),$devices[$i]->getPassFail());
			}
		print "{'main':[";
		for($i =0 ;$i<count($rows); $i++)
		{
			print "[".$rows[$i][0].", '".$rows[$i][1]."']";
			if($i < count($rows)-1)
				print ",";
		}
		print "]}";
		return sfView::NONE;
		
	}
	public function executeFrequencyChecks(){
		$clientId = $this->getRequestParameter('clientId');
		$months_str = $this->getRequestParameter('months');


            if(empty($clientId))
                {
                     print "<script type='text/javascript'>  $('updatedFreqCount').value = 0; frequencyCheckDone(); </script>";
		     return sfView::NONE;
                }
       // $clientId = 351;
       // $months_str = 'MAR,NOV,OCT,DEC';
		
		$client = ClientPeer::retrieveByPk($clientId);
		
		$oldFreq = ($client->getFrequency()) ? $client->getFrequency()->getContents() : '';
	    $newFreq = $months_str;
	    $changes = $this->getFreqChanges($newFreq,$oldFreq); 
	    if($newFreq == $oldFreq)
	    	$changesDetected = false;
	    else 
	    	$changesDetected = true;
		
	    $todayMonth = date('m');
	    $todayYear = date('Y');
	    //$nextYear = $todayYear + 1;
	    $connection = Propel::getConnection();
		$query = "SELECT %s,%s,%s,MONTH(%s) as MONTH, MONTH(%s) as MONTH2 FROM %s WHERE %s = 9 and MONTH(%s) >= $todayMonth and (%s)=$clientId  and(YEAR(%s)=$todayYear ) order by %s";	
		$query = sprintf($query,WorkorderPeer::ID,WorkorderPeer::JOB_DATE, WorkorderPeer::JOB_SCHEDULED_DATE,WorkorderPeer::JOB_DATE,WorkorderPeer::JOB_SCHEDULED_DATE, WorkorderPeer::TABLE_NAME, WorkorderPeer::JOB_STATUS_ID,WorkorderPeer::JOB_DATE,WorkorderPeer::CLIENT_ID,WorkorderPeer::JOB_DATE,WorkorderPeer::JOB_DATE,WorkorderPeer::JOB_SCHEDULED_DATE  );
        
		$statement = $connection->prepareStatement($query);
		$resultSet = $statement->executeQuery(); 
		while($resultSet->next()){

			 $result_job_date = $resultSet->get('JOB_DATE');
			 $result_scheduled_job_date = $resultSet->get('JOB_SCHEDULED_DATE');
			 $result_job_month = $resultSet->getInt('MONTH');
			 $result_job_month2 = $resultSet->getInt('MONTH2');
			 
			 $job_month = !empty($result_job_month2) ? $result_job_month2 : $result_job_month;
			 $job_date = !empty($result_scheduled_job_date) ? $result_scheduled_job_date : $result_job_date;
			 
			 $futureOrders[] = array('id'=>$resultSet->getInt('ID'), 'date'=>$job_date,'month'=>$job_month );
		}
	     
		$updatedFreq = array();
	    
	    
	    $pks= array();
	    if(empty($changes['deleted'][0]))
	    	$count  = 0; // make sure we indicate nothing was updated
	    else{
	    	foreach($changes['deleted'] as $deletedMonth){
	    	    $deletedMonth = $this->monthToNum($deletedMonth); //fron string to int
	    		$query = "SELECT * FROM workorder WHERE client_id = $clientId and MONTH(job_scheduled_date) = $deletedMonth and MONTH(job_scheduled_date) >= $todayMonth and YEAR(job_scheduled_date) = $todayYear and job_status_id = 9 LIMIT 1";
	    		$stat = $connection->prepareStatement($query);
	    		$resultSet= $stat->executeQuery();
	    		while($resultSet->next()){
			        $pks[] = $resultSet->get('id');
			   
	    		}//while
	    	}//foreach
	    	$c  = new Criteria();
	    
	    	$c->add(WorkorderPeer::ID, $pks, Criteria::IN);
	    	$deletedWorkorders = WorkorderPeer::doSelect($c);
	    	
	    	$count = 0;
	    	foreach($deletedWorkorders as $wo){
	    		$count++;
	    		if(!empty($changes['all'])){
	    		$link = '/index.php/scheduler/index/mode/edit/ticket/'.$wo->getId(); 
	    		
	    		$link = "<a href='$link' class='popLink'>Edit</a>";
	    		$sel = "<div class='listBox'> &nbsp;&nbsp;&nbsp;" . $wo->getJobScheduledDate() . "&nbsp;&nbsp;&nbsp;&nbsp;$link&nbsp;&nbsp;<select id='drop".$count."'>";
	    	 
	    		     $job_date = $wo->getJobScheduledDate();
	    		     $job_date_ar = explode('-',$job_date);
	    	    	//$selected = ($order['month'] == $this->monthToNum($theMonth)) ? "selected='selected'" : '';
	    		     foreach($changes['all'] as $theMonth){
	    		     	$selected = ($order['month'] == $this->monthToNum($theMonth)) ? "selected='selected'" : '';
	    				$sel .= "<option value='".$wo->getId()."|".$this->monthToNum($theMonth)."' $selected>".$theMonth."</option>";
	    		     }
	    			$sel .= "</select><br/>";
	    			print $sel;
	    			print "</div><br/>";
	    		}//iff
	    	}//foreach
	    	
	    	
	        $count = (!empty($deletedWorkorders) and !empty($changes['all'])) ? $count : 0;//indicate that we have dates to edit
	    }
	    
	    
        print "<script type='text/javascript'>  $('updatedFreqCount').value = $count; frequencyCheckDone(); </script>";
		return sfView::NONE;
	}
    private function getDisplayFreqApprove($client){
    	if(!$client) return false;
    	$userId = $this->getUser()->getAttribute('userId');
    	if(!$userId) return false;
    	$user = UserPeer::retrieveByPk($userId);
    	if(!$user) return false;
    	
    	if($user->getAdmin() == 1){
    		//if($client->getFreqApproved()== 1)
    		//	return false;
    		//else 
    			return true;
    	}else 
    		return false;	      
    }
    public function executeUpdateClientCordCache(){
          $c = new Criteria();
          $clients = ClientPeer::doSelect($c);
          foreach($clients as $client){
          //	var_dump(get_class_methods($client));exit;
          	
          	if($client->getRequireCoordsUpdate() == 1){
          		$mapCache = new GoogleMapCache();
          		$mapCache->updateCordinateCache($client->getId());
          	}
          }
          return sfView::NONE;
    }
	
	public function executeAddDevice()
	{
		//Request Device form values
		$device_info = $this->getRequest()->getParameterHolder()->getAll();		
	
		//Save "Time for all Devices" to client database
		$client = new Client();
		$client->setAllDevices($this->getRequestParameter('all_devices'));


		//Aquire update device data
		if(isset($device_info['device_update']))
		{

			foreach(array_keys($device_info['device_update']) as $key)
			{
				$this->deviceUpdate($key,
								$device_info['id'], 
								$this->getRequestParameter('device_update['.$key.'][identification]'), 
								$this->getRequestParameter('device_update['.$key.'][device_name]'), 
								$this->getRequestParameter('device_update['.$key.'][manufacturer]'),
								$this->getRequestParameter('device_update['.$key.'][model_number]'),
								$this->getRequestParameter('device_update['.$key.'][serial_number]'),
								$this->getRequestParameter('device_update['.$key.'][location]'),
								$this->getRequestParameter('device_update['.$key.'][frequency]'),
								$this->getRequestParameter('device_update['.$key.'][status]')
							);

			}
		}

		//Test for blank entries in "new" entry fields
		if(!(($device_info['new_device_name'] == '') && ($device_info['new_manufacturer'] == '') && ($device_info['new_model_number'] == '') && ($device_info['new_serial_number'] == '') && ($device_info['new_frequency'] == '') && ($device_info['new_status'] == '')))
		{
				$this->deviceAddNew(-1,
								$device_info['id'], 
								$this->getRequestParameter('new_device_ident'),
								$this->getRequestParameter('new_device_name'), 
								$this->getRequestParameter('new_manufacturer'),
								$this->getRequestParameter('new_model_number'),
								$this->getRequestParameter('new_serial_number'),
								$this->getRequestParameter('new_location'),
								$this->getRequestParameter('new_frequency'),
								$this->getRequestParameter('new_status')
							);		
		}

		$this->redirect('clientManager/index?mode=edit&id='.$device_info['id']);
	}

	private function convertFreq($client){
		if ($client->getFrequency() == null) return;
		$frequency =  $client->getFrequency()->getContents();
		$frequency_arr = explode(',',$frequency);
		$freq_months = array();
		
		$year = date('Y');
		$nextYear = date('Y');
		
		for($i=0; $i < count($frequency_arr); $i++){
			switch($frequency_arr[$i]){
				case "JAN":
					    $time = mktime(0,0,0,1,1,$year); $time_next = mktime(0,0,0,1,1,$year+1);
						$freq_months[] = array('month' =>'01','thisYear' => $year."-01-01", 'nextYear'=>$nextYear."-01-01",'date_time'=>$time, 'time_next'=>$time_next);
					break;
				case "FEB":
					    $time = mktime(0,0,0,2,1,$year); $time_next = mktime(0,0,0,2,1,$year+1);
						$freq_months[] = array('month' =>'02','thisYear' => $year."-02-01", 'nextYear'=>$nextYear."-02-01",'date_time'=>$time, 'time_next'=>$time_next);
					break;
				case "MAR":
					    $time = mktime(0,0,0,3,1,$year); $time_next = mktime(0,0,0,3,1,$year+1);
						$freq_months[] = array('month' =>'03','thisYear' => $year."-03-01", 'nextYear'=>$nextYear."-03-01",'date_time'=>$time, 'time_next'=>$time_next);
					break;
				case "APR":
                        $time = mktime(0,0,0,4,1,$year); $time_next = mktime(0,0,0,4,1,$year+1);
						$freq_months[] = array('month' =>'04','thisYear' => $year."-04-01", 'nextYear'=>$nextYear."-04-01",'date_time'=>$time, 'time_next'=>$time_next);
					break;
				case "MAY":
					    $time = mktime(0,0,0,5,1,$year); $time_next = mktime(0,0,0,5,1,$year+1);
						$freq_months[] = array('month' =>'05','thisYear' => $year."-05-01", 'nextYear'=>$nextYear."-04-01",'date_time'=>$time, 'time_next'=>$time_next);
					break;
				case "JUN":
					    $time = mktime(0,0,0,6,1,$year); $time_next = mktime(0,0,0,6,1,$year+1);
						$freq_months[] = array('month' =>'06','thisYear' => $year."-06-01", 'nextYear'=>$nextYear."-04-01",'date_time'=>$time, 'time_next'=>$time_next);
					break;
				case "JUL":
					    $time = mktime(0,0,0,7,1,$year); $time_next = mktime(0,0,0,7,1,$year+1);
						$freq_months[] = array('month' =>'07','thisYear' => $year."-07-01", 'nextYear'=>$nextYear."-04-01",'date_time'=>$time, 'time_next'=>$time_next);
					break;
				case "AUG":
					    $time = mktime(0,0,0,8,1,$year); $time_next = mktime(0,0,0,8,1,$year+1);
						$freq_months[] = array('month' =>'08','thisYear' => $year."-08-01", 'nextYear'=>$nextYear."-04-01",'date_time'=>$time, 'time_next'=>$time_next);
					break;
				case "SEP":
					    $time = mktime(0,0,0,9,1,$year); 
					    $time_next = mktime(0,0,0,9,1,$year+1);
						$freq_months[] = array('month' =>'09','thisYear' => $year."-09-01", 'nextYear'=>$nextYear."-04-01",'date_time'=>$time, 'time_next'=>$time_next);
					break;
				case "OCT":
					    $time = mktime(0,0,0,10,1,$year); $time_next = mktime(0,0,0,10,1,$year+1);
						$freq_months[] = array('month' =>'10','thisYear' => $year."-10-01", 'nextYear'=>$nextYear."-04-01",'date_time'=>$time, 'time_next'=>$time_next);
					break;
				case "NOV":
					    $time = mktime(0,0,0,11,1,$year); $time_next = mktime(0,0,0,11,1,$year+1);
						$freq_months[] = array('month' =>'11','thisYear' => $year."-11-01", 'nextYear'=>$nextYear."-04-01",'date_time'=>$time, 'time_next'=>$time_next);
					break;
				case "DEC":
					    $time = mktime(0,0,0,12,1,$year); 
					    $time_next = mktime(0,0,0,12,1,$year+1);
						$freq_months[] = array('month' =>'12','thisYear' => $year."-12-01", 'nextYear'=>$nextYear."-12-01");
					break;
			}//switch
		}//if 
		return $freq_months;
	}//func
	
	/* This function saves our client form data to the database */
	
	private function updateWorkorderMonth($workorderInfo){
		 
		if(empty($workorderInfo) ) 
			return false; 
		
		$connection = Propel::getConnection();
		foreach($workorderInfo as $data){
			
			$wid = $data['wid'];
			$month = (strlen($data['month'])< 2) ? "0".$data['month'] : $data['month'] ;
			
			$query = "SELECT %s, %s FROM %s WHERE %s = $wid";
			$query = sprintf($query, WorkorderPeer::JOB_DATE, WorkorderPeer::JOB_SCHEDULED_DATE, WorkorderPeer::TABLE_NAME, WorkorderPeer::ID );
			
			
			$statement = $connection->prepareStatement($query);
			$result = $statement->executeQuery();
			$result->next();
			$jobDate = $result->getDate('JOB_DATE');
			$jobDateScheduled = $result->getDate('JOB_SCHEDULED_DATE');
			
			$jobDate_ar = explode('/',$jobDate);
			$jobDate_ar[0] = $month;
			$jobDate = "20".$jobDate_ar[2]."-".$jobDate_ar[0]."-".$jobDate_ar[1];
			
			if(!empty($jobDateScheduled)){
				$jobDateScheduled_ar = explode('/',$jobDateScheduled);
				$jobDateScheduled_ar[0] = $month;
				$jobDateScheduled = "20".$jobDateScheduled_ar[2]."-".$jobDateScheduled_ar[0]."-".$jobDateScheduled_ar[1];
			}else 
			     $jobDateScheduled = $jobDate;
			
	 
			$query = "UPDATE %s set %s = '$jobDate', %s = '$jobDateScheduled' WHERE %s = $wid";
			
			$query = sprintf($query, WorkorderPeer::TABLE_NAME, WorkorderPeer::JOB_DATE, WorkorderPeer::JOB_SCHEDULED_DATE, WorkorderPeer::ID);
		
			$statement = $connection->prepareStatement($query);
			$statement->executeQuery();
			
		}
	}
	public function executeAddClient()
	{
		 
		/*
		$connection = Propel::getConnection();
		$query = 'SELECT %s, %s as Year FROM %s';
		$query = sprintf($query,WorkorderPeer::ID, WorkorderPeer::JOB_DATE, WorkorderPeer::TABLE_NAME);
		$statement = $connection->prepareStatement($query);
		$resultSet = $statement->executeQuery();
		
		while($resultSet->next()){
			$id = $resultSet->getInt('ID');
	        //var_dump(get_class_methods($resultSet));exit;
			$date = $resultSet->get('Year');
			
			$query = "UPDATE %s SET %s = '%s' WHERE %s = $id";
			$query = sprintf($query,WorkorderPeer::TABLE_NAME, WorkorderPeer::JOB_SCHEDULED_DATE, $date,WorkorderPeer::ID);
			print "$query<br/>";
			$statement = $connection->prepareStatement($query);
			$statement->executeQuery();
	        
		}
        */
		
		 
		// Create a client object to store parsed information
		$client = new Client();
		
		
        
		if ($this->getRequestParameter('mode') == 'edit')
		{

				$client_id = $this->getRequestParameter('id');
				$client = ClientPeer::retrieveByPk($client_id);
				
//				$frequency = $this->getRequestParameter('frequency');
//				$freq = implode(",", $frequency); 	
//				
//				$oldFrequencyTxt = ($client->getFrequency()) ? $client->getFrequency()->getContents() : '';
//	   			$newFrequencyTxt = $freq;
//	   			$newFreuency_ar = explode(',',$newFrequencyTxt);
//	   			
//	   			//these are future workorders who's date may change
//				$scheduledForUpdatedFreq = $this->getRequestParameter('updatedFreqCount');
//				$this->updateScheduledWorkorder($client_id,$scheduledForUpdatedFreq);
//	   			$freqChanges = $this->getFreqChanges($newFrequencyTxt,$oldFrequencyTxt);
//	   			
//	   			if($oldFrequencyTxt != $newFrequencyTxt){
//					$this->deletePastUnscheduled($client_id, $freqChanges['deleted']);
//					//$this->removeDeletedFreqWorkorder($client_id,$freqChanges['deleted']);
//					
//	   			}
//				
		}
		
	
		$client->setClientIdentification($this->getRequestParameter('client_identification'));
		$client->setClientName($this->getRequestParameter('client_name'));
		$client->setAddress($this->getRequestParameter('address'));
		$client->setAddress2($this->getRequestParameter('address_2'));
		$client->setCity($this->getRequestParameter('city'));
		$client->setState($this->getRequestParameter('state'));
		$client->setZip($this->getRequestParameter('zip'));
		$client->setAttn($this->getRequestParameter('attn'));
		$client->setEmail($this->getRequestParameter('email'));
		$client->setPhone($this->getRequestParameter('phone'));
		$client->setExt($this->getRequestParameter('ext'));
		$client->setCategory($this->getRequestParameter('category'));
		$client->setNotes($this->getRequestParameter('notes'));
		$client->setAllDevices($this->getRequestParameter('all_devices'));
		$client->setAnesthesia($this->getRequestParameter('anesthesia'));
		$client->setMedgas($this->getRequestParameter('medgas'));
		$client->setAddressType($this->getRequestParameter('address_type'));
	    
		if($client->getFreqLocked() == false){
//		    if(strtolower($oldFrequencyTxt) == strtolower($newFrequencyTxt)){
//		    	$changesDetected = false;
//		    }else {
//		    	$changesDetected = true;
//		    }
			 
//	       if ($this->getRequestParameter('mode') == 'edit')
//				$client->setFrequency($newFrequencyTxt);
//	       else{
//	        	// this is a new entry
//	        	$newEntry = true;
//	       	    $newFrequencyTxt = implode(',',$this->getRequestParameter('frequency'));
//	       	    $freqChanges = $this->getFreqChanges($newFrequencyTxt,'');
//	            $client->setFrequency(implode(',',$this->getRequestParameter('frequency')));
//	       }
			$client->setFrequency(implode(',', $this->getRequestParameter('frequency_legacy')));
			$client->setFrequencyAnnual(implode(',', $this->getRequestParameter('frequency_annual')));
			$client->setFrequencySemi(implode(',', $this->getRequestParameter('frequency_semi')));
			$client->setFrequencyQuarterly(implode(',', $this->getRequestParameter('frequency_quarterly')));
			$client->setFrequencySterilizer(implode(',', $this->getRequestParameter('frequency_sterilizer')));
			$client->setFrequencyTg(implode(',', $this->getRequestParameter('frequency_tg')));
			$client->setFrequencyErt(implode(',', $this->getRequestParameter('frequency_ert')));
			$client->setFrequencyRae(implode(',', $this->getRequestParameter('frequency_rae')));
			$client->setFrequencyMedgas(implode(',', $this->getRequestParameter('frequency_medgas')));
			$client->setFrequencyImaging(implode(',', $this->getRequestParameter('frequency_imaging')));
			$client->setFrequencyNeptune(implode(',', $this->getRequestParameter('frequency_neptune')));
			$client->setFrequencyAnesthesia(implode(',', $this->getRequestParameter('frequency_anesthesia')));
		}
        //if changes were made to the client save it
		if ($client->isModified())
		{	
			$client->save();
		}

        // exit;
		if ($this->getRequestParameter('mode') != 'edit')
		{
			$c = new Criteria();
			$c->add(ClientPeer::CLIENT_IDENTIFICATION, $client->getClientIdentification());
			$c->add(ClientPeer::CLIENT_NAME, $client->getClientName());
			$c->add(ClientPeer::ADDRESS, $client->getAddress());
			$c->add(ClientPeer::ADDRESS_2, $client->getAddress2());
			$c->add(ClientPeer::CITY, $client->getCity());
			$c->add(ClientPeer::STATE, $client->getState());
			$c->add(ClientPeer::ZIP, $client->getZip());
			$c->add(ClientPeer::ATTN, $client->getAttn());
			$c->add(ClientPeer::EMAIL, $client->getEmail());
			$c->add(ClientPeer::PHONE, $client->getPhone());
			$c->add(ClientPeer::EXT, $client->getExt());
			$c->add(ClientPeer::CATEGORY, $client->getCategory());
			$c->add(ClientPeer::NOTES, $client->getNotes()); 

			$d = ClientPeer::doSelect($c);
			$client_id = $d[0]->getId();
			 

		}
		
		
		$searchMonth = (int)date('m');
		$year = date("Y");
		$yeard = $year + 1;
		
		$jstat = '10';
		$jtech = '1';
		$jdev = '0';
		$jzip = $client->getZip();
		$jreason = '17';
		$jonsite = '8:00';
		$jrecieved = date("Y-m-d");
		$jstart = '800';
		$jend = '1700';
		
		$alld = $client->getAllDevices();
		
		if (($alld != '0') || ($alld != NULL) || ($alld != '')){
			$jonsite = $alld.":00";
			$jend = 800 + ($alld * 100);
		} 
	   
		
		$frequency = $this->convertFreq($client);
	    
	
		//check if new frequencys were added if yes we add workorder for this month
		if(!empty($freqChanges['added'][0])){
			for($i=0; $i<count($freqChanges['added']); $i++){ 
				   $searchMonth = $this->monthToNum($freqChanges['added'][$i]);
				   $theMonth = (strlen($searchMonth)>1) ? $searchMonth : "0".$searchMonth;
				   $jobdate = date('Y').'-'.$theMonth.'-'.date("d");
				   $jobscheduleddate = date('Y').'-'.$theMonth.'-01';
				  
				   if($newEntry == false){
					   $connection = Propel::getConnection();
					   $query = "SELECT %s FROM %s WHERE  (MONTH(%s) = $searchMonth and YEAR(%s) = $year ) and %s = $client_id and %s = 17";
					  
				       $query = sprintf($query,WorkorderPeer::ID, WorkorderPeer::TABLE_NAME, WorkorderPeer::JOB_SCHEDULED_DATE , WorkorderPeer::JOB_SCHEDULED_DATE,WorkorderPeer::CLIENT_ID ,WorkorderPeer::REASON);
				       $statement = $connection->prepareStatement($query);
				       
				       $resultSet = $statement->executeQuery();
				   }
				   
			       if($newEntry == true or !$resultSet->next() ){
			       	
					  
			       	    // doesn't exit create it
			       	    $newOrder = new Workorder();
						$newOrder->setClientId($client_id);
						$newOrder->setDeviceId('0');
						$newOrder->setJobDate($jobdate);
						$newOrder->setJobScheduledDate($jobscheduleddate);
						$newOrder->setDateRecieved($jrecieved);
						$newOrder->setTech($jtech);
						$newOrder->setOnsiteTime($jonsite);
						$newOrder->setZip($jzip);
						$newOrder->setReason(17);
						$newOrder->setJobStart($jstart);
						$newOrder->setJobEnd($jend);
						$newOrder->setJobStatusId(10);
						//create workorders for the past
						if($theMonth >= date('m'))
							$newOrder->save();
						
			       }else{
			       	    //do nothing already exit
			       } 
			} //for  
			 
		}//if	
		
		/*
		//additional orders
		  if(!empty($newFreuency_ar[0])){
			for($i=0; $i<count($newFreuency_ar[0]); $i++){ 
	               
				   $searchMonth = $this->monthToNum($newFreuency_ar[$i]);
				   $theMonth = (strlen($searchMonth)>1) ? $searchMonth : "0".$searchMonth;
				   $jobdate = date('Y').'-'.$theMonth.'-01';
				     $jobscheduleddate = date('Y').'-'.$theMonth.'-01';
				   $connection = Propel::getConnection();
				   $query = "SELECT %s FROM %s WHERE ( (MONTH(%s) = $searchMonth and YEAR(%s)=$year) or
				   (MONTH(%s) = $searchMonth and YEAR(%s)=$year)) and %s = $client_id and %s = 17";
				   
			       $query = sprintf($query,WorkorderPeer::ID, WorkorderPeer::TABLE_NAME, WorkorderPeer::JOB_DATE, WorkorderPeer::JOB_DATE, WorkorderPeer::JOB_SCHEDULED_DATE , WorkorderPeer::JOB_SCHEDULED_DATE,WorkorderPeer::CLIENT_ID ,WorkorderPeer::REASON);
			       $statement = $connection->prepareStatement($query);
			       
			       $resultSet = $statement->executeQuery();
			       if(!$resultSet->next()){
			       	    // doesn't exit create it
			       	    $newOrder = new Workorder();
						$newOrder->setClientId($client_id);
						$newOrder->setDeviceId('0');
						$newOrder->setJobDate($jobdate);
						$newOrder->setJobScheduledDate($jobscheduleddate);
						$newOrder->setDateRecieved($jrecieved);
						$newOrder->setTech($jtech);
						$newOrder->setOnsiteTime($jonsite);
						$newOrder->setZip($jzip);
						$newOrder->setReason(17);
						$newOrder->setJobStart($jstart);
						$newOrder->setJobEnd($jend);
						$newOrder->setJobStatusId(10);
						$newOrder->save();
						
			       }else{
			       	    //do nothing already exit
			       }
			      
			} //for
		  }//if
        */
		$this->redirect('clientManager/index?mode=edit&id='.$client_id);
	}
	
	private function allowNewWorkorder($client_id,$year){
		
		 
		
		$c = new Criteria();
		$c->add(WorkorderPeer::CLIENT_ID, $client_id);
		$c->add(WorkorderPeer::REASON, 17);
		$c->add(WorkorderPeer::JOB_DATE, $year."-".$frequency[$i]['month']."-%", Criteria::LIKE);
		$job = WorkorderPeer::doSelect($c);
		
	}

	public function executeDeleteClient()
	{
		$client_id = $this->getRequestParameter('delete_client');

		$client = ClientPeer::retrieveByPk($client_id);
		$client->delete();

		$this->redirect('clientManager/index');
	}

	public function handleErrorAddClient()
	{
		$this->forward('clientManager', 'index');
	}

/*	public function handleErrorAddDevice()
	{
		$this->forward('clientManager', 'index');
	}*/

	private function deviceUpdate($device_id, $client_id, $device_ident, $device_name, $manufacturer, $model_number, $serial_number, $location, $frequency, $status)
	{
			//Add New device					
			$device = DevicePeer::retrieveByPk($device_id);
			$specID = $device->getSpecificationId();
			$specification = SpecificationPeer::retrieveByPk($specID);

			$device->setIdentification($device_ident);
			$device->setSerialNumber($serial_number);
			$device->setStatus($status);
			$device->setLocation($location);

			if($device->isModified())
			{
				$device->save();
			}
			
			$specification->setDeviceName($device_name);
			$specification->setManufacturer($manufacturer);
			$specification->setModelNumber($model_number);

			if($specification->isModified())
			{
				$specification->save();
			}

	}
	
	private function deviceAddNew($device_id, $client_id, $device_ident, $device_name, $manufacturer, $model_number, $serial_number, $location, $frequency, $status)
	{
			//Add New device					
			$device = new Device();
			$specification = new Specification();

			
			//Set Specifications to database
			$specification->setDeviceName($device_name);
			$specification->setManufacturer($manufacturer);
			$specification->setModelNumber($model_number);

			$specification->save();
			
			//Set Device information to database
			
			$device->setIdentification($device_ident);
			$device->setSpecificationId($specification->getId());
			$device->setClientId($client_id);
			$device->setSerialNumber($serial_number);
			$device->setLocation($location);
			$device->setFrequency($frequency);
			$device->setStatus($status);

			$device->save();
	}
	
	public function executeQualifications()
	{
		$this->techId = $this->getRequestParameter('techId');
	}
	
	public function executeDeleteDevice()
	{
		$device_id = $this->getRequestParameter('id');
		
		$device = DevicePeer::retrieveByPk($device_id);
		$clientID = $device->getClientId();
		$specification = $device->getSpecification();
		
		$device->delete();
		$specification->delete();
		
		$this->redirect('clientManager/addDevice?mode=edit&id='.$clientID);
	}

	private function getFreqChanges($newFreq,$oldFreq){
		
		$newFreqAr = empty($newFreq) ? array() : explode(",",$newFreq);
		$oldFreqAr = empty($oldFreq) ? array() : explode(",",$oldFreq);
		
		
		    $addedMonths = array();
		    $deletedMonths = array();
		    $list = array();
		    //get recently added months
		foreach($newFreqAr as $month){
			if(!in_array($month,$oldFreqAr)){
				$addedMonths[] = $month;
			}
		}
		//get deleted months
		foreach($oldFreqAr as $month){
			
			if(!in_array($month,$newFreqAr)){
				$deletedMonths[] = $month;
			}
		}
		
		foreach($oldFreqAr as $freq){
			if(!in_array($freq, $deletedMonths)){
				$list[] = $freq;
			}
		}
		
		$completeList = array_merge($list, $addedMonths);
 
		usort( $completeList, array("clientManagerActions", "monthSort"));
        
		
	    $changes = array('deleted'=>$deletedMonths, 'added'=>$addedMonths, 'all'=>$completeList);

	    return $changes;
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
	private function monthSort($a, $b){
    if ($this->monthToNum($a) == $this->monthToNum($b)) {
        return 0;
    }
    return ($this->monthToNum($a) < $this->monthToNum($b)) ? -1 : 1;
}


	private function deletePastUnscheduled($client_id, $month_ar){	
	
	 
	 	$connection = Propel::getConnection();
	 	$year = date('Y');
	 	foreach($month_ar as $month){
	 		if(!empty($month)){
	 			$month = $this->monthToNum($month); //fron string to int
				 
			    $query = "DELETE FROM %s WHERE %s=$client_id and MONTH(%s)=$month and YEAR(%s)=$year and job_status_id = 10";
			    $query = sprintf($query, WorkorderPeer::TABLE_NAME, WorkorderPeer::CLIENT_ID, WorkorderPeer::JOB_SCHEDULED_DATE, WorkorderPeer::JOB_SCHEDULED_DATE);
			 	$statement = $connection->prepareStatement($query);
				$resultSet = $statement->executeQuery();
	 		}
	 	}//foreach
	}

	private function removeDeletedFreqWorkorder($client_id,$month_ar){	
         
	   
	 	$connection = Propel::getConnection();
	 	$year = date('Y');
	 	foreach($month_ar as $month){
	 		if(!empty($month)){
	 			$month = $this->monthToNum($month); //fron string to int
				 
			    $query = "DELETE FROM %s WHERE %s=$client_id and MONTH(%s)=$month and YEAR(%s)=$year";
			    $query = sprintf($query, WorkorderPeer::TABLE_NAME, WorkorderPeer::CLIENT_ID, WorkorderPeer::JOB_SCHEDULED_DATE, WorkorderPeer::JOB_SCHEDULED_DATE);
			 	$statement = $connection->prepareStatement($query);
				$resultSet = $statement->executeQuery();
	 		}
	 	}//foreach
	}
	private function updateScheduledWorkorder($client_id,$update_str){	
         if($update_str == '0') return;
         $info = explode('-',$update_str);
         foreach ($info as $wi){
         	$data = explode('|', $wi);
         	$wo_info[] = array('wid'=>$data[0], 'month'=>$data[1]);
         }
         
	   
	 	$connection = Propel::getConnection();
	 	$year = date('Y');
	 	foreach($wo_info as $wo_detail){
	 		if(!empty($wo_detail['month']) and !empty($wo_detail['wid'])){
	 			$month =  $wo_detail['month']; //fron string to int
	 			$wid = $wo_detail['wid'];
	 			$query = "SELECT (%s) FROM %s WHERE %s=$wid";
			    $query = sprintf($query, WorkorderPeer::JOB_SCHEDULED_DATE, WorkorderPeer::TABLE_NAME, WorkorderPeer::ID);
			 	$statement = $connection->prepareStatement($query);
			 	
				$resultSet = $statement->executeQuery();
				while($resultSet->next()){
					$old_date = $resultSet->get('JOB_SCHEDULED_DATE');
					if(!empty($old_date))
					{
						$date_ar = explode('-',$old_date);
						$month = (strlen($month)<2) ? "0".$month : $month;
						$old_date = $date_ar[0].'-'.$month.'-'.$date_ar[2];
					}
				}
				
			    $query = "Update %s SET %s = '$old_date' WHERE %s=$wid";
			    $query = sprintf($query, WorkorderPeer::TABLE_NAME, WorkorderPeer::JOB_SCHEDULED_DATE, WorkorderPeer::ID);
			    $statement = $connection->prepareStatement($query);
				$resultSet = $statement->executeQuery();
	 		}//if
	 	}//foreach
	}
	
	public function executeCreatePdf(){
		
		$requestData = $this->getRequestParameter('date_and_id');
		$requestData = explode('||',$requestData);
		$date = $requestData[0];
		$client_id = (int)$requestData[1];
		
		$c = new Criteria();
		$c->add(DeviceCheckupPeer::DATE, $date);
		$c->add(DeviceCheckupPeer::CLIENT_ID, $client_id);
		$c->add(DeviceCheckupPeer::PASS_FAIL, 'FAIL');
		$failedDevices = DeviceCheckupPeer::doSelect($c);
		
		$c = new Criteria();
		$c->add(DeviceCheckupPeer::DATE, $date);
		$c->add(DeviceCheckupPeer::CLIENT_ID, $client_id);
		$all = DeviceCheckupPeer::doSelect($c);
		$passed = true;
		
		if(count($all) == 0){
			
		}else if(!empty($failedDevices)){
			$passed = false;
		}
		
	 
			$c = new Criteria();
			$c->add(ClientPeer::ID, $client_id);
			$clientinfo = ClientPeer::doSelect($c);
			//var_dump($clientinfo);
		 
		
		define('FPDF_FONTPATH',SF_ROOT_DIR.'/web/font/');
		$date = date("M d Y", time());
		$clientName = $clientinfo[0]->getClientIdentification();
		$address_line_1 = $clientinfo[0]->getAddress();
		$address_line_2 = $clientinfo[0]->getAddress2();
		$address_line_3 = $clientinfo[0]->getCity().', '.$clientinfo[0]->getState().' '.$clientinfo[0]->getZip();
		$subject = "Re:  Preventive Maintenance Test Results ";
		$contact = $clientinfo[0]->getAttn();
		$line_1 = "While our technician was doing preventive maintenance on your equipment, some failures were found. The following is a list of the equipment and the problems that were found:
		";
		$line_2 = "
		We would like to schedule a time to repair this equipment. Please call us and we will arrange for a technician to perform the needed repair immediately. If you have any questions, please do not hesitate to call.";
		$signer = "Chris Endres, VP";
		
		
		$passed_line = "While our technician was doing preventive maintenance on your equipment there were no problems found. Enclosed please find the reports for all equipment tested. If you need any repairs or have any questions, please do not hesitate to call.
		"; 
		
		$pdf=new FPDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times','',12);
		//for($i=1;$i<=40;$i++)
		$pdf->Cell(0,5,$date,0,1);
		$pdf->Cell(0,5,"",0,1);
		$pdf->Cell(0,5,$clientName,0,1);
		$pdf->Cell(0,5,$address_line_1,0,1);
		if(!empty($address_line_2))
			$pdf->Cell(0,5,$address_line_2,0,1);
		$pdf->Cell(0,5,$address_line_3,0,1);
		$pdf->Cell(0,5,"",0,1);
		$pdf->Cell(0,5,$subject,0,1);
		$pdf->Cell(0,5,"",0,1);
		$pdf->Cell(0,5,"Dear $contact,",0,1);
		$pdf->Cell(0,5,"",0,1);
		
		if($passed)
			$pdf->MultiCell(0,5,$passed_line,0,1);
		else{
			
			
			$pdf->MultiCell(0,5,$line_1,0,1); 
			for($i =0; $i< count($failedDevices); $i++){
		 
				$c = new Criteria();
				$c->add(DevicePeer::ID, $failedDevices[$i]->getDeviceId());
				$db_device = DevicePeer::doSelect($c);
				
				$c = new Criteria();
				$c->add(SpecificationPeer::ID, $db_device[$i]->getSpecificationId());
				$spef = SpecificationPeer::doSelect($c);
				
				
				$deviceName = $spef[$i]->getDeviceName();
				$deviceIdentification = $db_device[$i]->getIdentification();
				$pdf->Cell(0,5,"        * $deviceIdentification - $deviceName",0,1);
			}
			$pdf->Cell(0,5," ",0,1);
			$pdf->MultiCell(0,5,$line_2,0,1);
		}
		
		$pdf->Cell(0,5," ",0,1);
		$pdf->Cell(0,5,"Sincerely, ",0,1);
		$pdf->Cell(0,5,$signer,0,1);
		
		//$pdf->Cell(0,5,$subject,0,1);
		//$pdf->Cell(0,5,$subject,0,1);
		//$pdf->Cell(0,5,$subject,0,1);
		$pdf->Output();
		return svView::NONE;
	}
	public function executeSaveSecondaryAddress(){
		$client_id = $this->getRequestParameter('client_id');
		$address = $this->getRequestParameter('address');
		$address2 = $this->getRequestParameter('address2');
		$city = $this->getRequestParameter('city');
		$state = $this->getRequestParameter('state');
		$zip = $this->getRequestParameter('zip');
		$attn = $this->getRequestParameter('attn');
		$c = new Criteria();
		$c->add(ClientPeer::ID, $client_id);
		$client = ClientPeer::doSelect($c);
		if(!empty($client)){
			$client[0]->setSecondaryAddress($address);
			$client[0]->setSecondaryCity($city);
			$client[0]->setSecondaryAddress2($address2);
			$client[0]->setSecondaryState($state);
			$client[0]->setSecondaryZip($zip);
			$client[0]->setSecondaryAttn($attn);
			$client[0]->save();
		}
		return sfView::NONE;
	}
    public function getPdfReports($client_id){
		
		$c = new Criteria();
		$c->add(FinalDeviceReportPeer::CLIENT_ID, $client_id);
		$c->addDescendingOrderByColumn(FinalDeviceReportPeer::CREATED_AT);
		$finalReport = FinalDeviceReportPeer::doSelect($c);
		
		return $finalReport;
		
  }
    public function executeDeleteReport(){
  	
  	
  	    $client_id = $this->getRequestParameter('client_id');
  	    $report_id = $this->getRequestParameter('id');
  	    
  	    $c = new Criteria();
  	    $c->add(FinalDeviceReportPeer::ID, $report_id);
  	    $c->add(FinalDeviceReportPeer::CLIENT_ID, $client_id);
  	    $forDelete = FinalDeviceReportPeer::doSelect($c);
  	    if($forDelete){
  	    	$forDelete[0]->delete();
  	    }
  	    
  	    $c = new Criteria();
		$c->add(FinalDeviceReportPeer::CLIENT_ID, $client_id);
		$c->addDescendingOrderByColumn(FinalDeviceReportPeer::CREATED_AT);
		$finalReport = FinalDeviceReportPeer::doSelect($c);
		$this->finalReport = $finalReport;
		$this->setTemplate('deviceReport');
  }

    public function executeSaveFreqApprove(){
 	$client_id = $this->getRequestParameter('client_id');

 	if(!empty($client_id)){
 	  $client = ClientPeer::retrieveByPk($client_id);
 	  if($client){
		$client->setFrequency(str_replace('|', ',', $this->getRequestParameter('legacy')));
		$client->setFrequencyAnnual(str_replace('|', ',', $this->getRequestParameter('annual')));
		$client->setFrequencySemi(str_replace('|', ',', $this->getRequestParameter('semi')));
		$client->setFrequencyQuarterly(str_replace('|', ',', $this->getRequestParameter('quarterly')));
		$client->setFrequencySterilizer(str_replace('|', ',', $this->getRequestParameter('sterilizer')));
		$client->setFrequencyTg(str_replace('|', ',', $this->getRequestParameter('tg')));
		$client->setFrequencyErt(str_replace('|', ',', $this->getRequestParameter('ert')));
		$client->setFrequencyRae(str_replace('|', ',', $this->getRequestParameter('rae')));
		$client->setFrequencyMedgas(str_replace('|', ',', $this->getRequestParameter('medgas')));
		$client->setFrequencyImaging(str_replace('|', ',', $this->getRequestParameter('imaging')));
		$client->setFrequencyNeptune(str_replace('|', ',', $this->getRequestParameter('neptune')));
		$client->setFrequencyAnesthesia(str_replace('|', ',', $this->getRequestParameter('anesthesia')));
 	  	$client->setFreqApproved(1);
 	  	$client->setFreqLocked(1);
		$client->save();
 	  }
 	}
 	return sfView::NONE;
 }
    public function executeUnlockFreq(){
 	$client_id = $this->getRequestParameter('client_id'); 
 	
  
 	if(!empty($client_id)){
 	  $client = ClientPeer::retrieveByPk($client_id);
 	  if($client){ 
 	  		$client->setFreqLocked(0);
 	  		$client->save();
 	  }
 	}
 	
 	return sfView::NONE;
 }

    public function executeUnapproveFreq(){
    	$c = new Criteria();
    	$c->add(ClientPeer::FREQ_APPROVED, 0);
    	$c->addAscendingOrderByColumn(ClientPeer::CLIENT_IDENTIFICATION);
    	$c->add(ClientPeer::CLIENT_IDENTIFICATION,'',Criteria::NOT_EQUAL);
    	$unapproved = ClientPeer::doSelect($c);
    	$totalUnapproved = count($unapproved);
    	
    	$c = new Criteria();
    	$c->add(ClientPeer::CLIENT_IDENTIFICATION,'',Criteria::NOT_EQUAL);
    	$totalClients = count(ClientPeer::doSelect($c));
    	
    	


$cssTitleCell = 'background-color: #EEF5FB; ';
$cellCssStyle = 'background-color: rgb(239, 237, 237)' ;
        print "TOTAL: $totalUnapproved";
    	print "<table style='border:1px solid black; font-size:12px;' cellpadding ='1' cellspacing ='0'>"; 
    	print "<tr> <td style='$cssTitleCell'>CLIENT ID</td> <td style='$cssTitleCell'>CLIENT NAME</td> <td style='$cssTitleCell'>CREATED ON</td></tr>";
    	$count = 0;
    	foreach ($unapproved as $un){
    		$cellCss = ($count%2) ==0 ?$cellCssStyle : '';
    		$count++;
    		print "<tr>";
    		print "<td style='$cellCss'>".$un->getClientIdentification()."</td><td style='$cellCss'> ".$un->getClientName()."</td><td style='$cellCss'> " . $un->getCreatedAt().'</td>';
    		print "</tr>";
    	}
    	return sfView::NONE;
    }
    public function executeReportAll(){
    	$c = new Criteria();
    
    	$c->addAscendingOrderByColumn(ClientPeer::CLIENT_IDENTIFICATION); 
    	$c->add(ClientPeer::CLIENT_IDENTIFICATION,'',Criteria::NOT_EQUAL);
    	$clients = ClientPeer::doSelect($c);
    	$totalClients = count($clients);
        ;
		$cssTitleCell = 'background-color: #EEF5FB; ';
		$cellCssStyle = 'background-color: rgb(239, 237, 237)' ;
        
		print "TOTAL: $totalClients";
    	print "<table style='border:1px solid black; font-size:12px;' cellpadding ='1' cellspacing ='0'>"; 
    	print "<tr> <td style='$cssTitleCell'>CLIENT ID</td> <td style='$cssTitleCell'>CLIENT NAME</td> <td style='$cssTitleCell'>Attn</td><td style='$cssTitleCell'>Phone</td><td style='$cssTitleCell'>Ext</td><td style='$cssTitleCell'>Frequency</td></tr>";
    	$count = 0;
    	foreach ($clients as $un){
    		$oldFreq = ($un->getFrequency()) ? $un->getFrequency()->getContents() : '';
    		$cellCss = ($count%2) ==0 ?$cellCssStyle : '';
    		$count++;
    		print "<tr>";
    		print "<td style='$cellCss'>".$un->getClientIdentification()."</td><td style='$cellCss'> ".$un->getClientName()."</td><td style='$cellCss'> " . $un->getAttn()."</td><td style='$cellCss'> " . $un->getPhone().'</td>'."</td><td style='$cellCss'> " . $un->getExt()."</td><td style='$cellCss'> " . $oldFreq.'</td>';
    		print "</tr>";
    	}
    	return sfView::NONE;
    }
    private function getUnapproveFreqText(){
    	$c = new Criteria();
    	$c->add(ClientPeer::FREQ_APPROVED, 1);
    	$c->addAscendingOrderByColumn(ClientPeer::CLIENT_IDENTIFICATION);
    	$c->add(ClientPeer::CLIENT_IDENTIFICATION,'',Criteria::NOT_EQUAL);
    	$unapproved = ClientPeer::doSelect($c);
    	$totalUnapproved = count($unapproved);
    	
    	$c = new Criteria();
    	$c->add(ClientPeer::CLIENT_IDENTIFICATION,'',Criteria::NOT_EQUAL);
    	$totalClients = count(ClientPeer::doSelect($c));
        return  " " . $totalUnapproved .' of '.$totalClients;
        }
	private function isAdmin(){
		$userId = $this->getUser()->getAttribute('userId');
    	if(!$userId) return false;
    	$user = UserPeer::retrieveByPk($userId);
    	if(!$user) return false;
    	if($user->getAdmin() == 1 )
    		return true;
    	else
    		return false;
	}
        public function executeMoveDevice(){
            $clientId = (int)$this->getRequestParameter('client_id');
            $deviceId = (int)$this->getRequestParameter('device_id');

         
            $c = new Criteria();
            $c->add(DevicePeer::IDENTIFICATION, $deviceId);
            $device = DevicePeer::doSelectOne($c);

            $c = new Criteria();
            $c->add(ClientPeer::ID, $clientId);
            $client = ClientPeer::doSelectOne($c);

            if($device and $client){
 
               $device->setClientId($clientId);
               $device->save(); 
            }

            if(empty($client)){
              $status = 'client_not_found';
            }

            if(empty($device)){
              $status = 'device_not_found';
            }
            if(empty($status))
               $status = 'success';

            $val = "
            {
              status: '$status'
            }";
            print $val;

            return sfView::NONE;
        }
}
