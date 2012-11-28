<?php

/**
 * process actions.
 *
 * @package    atlbiomed
 * @subpackage process
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class processActions extends sfActions
{
  /**
   * Executes index action
   *
   */
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
  }
  public function executeProcessUpload(){  	//get all clients
  	$c = new Criteria();
  	$c->addAscendingOrderByColumn(ClientPeer::CLIENT_IDENTIFICATION);
  	$clients = ClientPeer::doSelect($c);
  	
  	
  	//read and parse upload file
  	$processHandler = new processHandler($this->getRequest());

 
  	if($processHandler->shouldForward()){//file was already uploaded
  		$this->getUser()->setAttribute('fileAlreadyExist',true);
  		$this->redirect('/unprocessed/index?warning=yes&fn='.$processHandler->getFilename());
  	}
  	
  	$this->partialMatch = $processHandler->getPartialMatch();
  	$this->noMatch = $processHandler->getNoMatch();
  	$this->match = $processHandler->getMatched();
  	$this->clients = $clients;
  	$this->filename = $processHandler->getFilename();
  }//public
  public function executeSavePartialMatch(){
  	
 
  	$pass_fail = $this->getRequestParameter('pass_fail');
  	$device_id = $this->getRequestParameter('device_id');
  	$device_name = $this->getRequestParameter('device_name');
  	$serial = $this->getRequestParameter('serial');
  	$model = $this->getRequestParameter("model");
  	$manufacturer = $this->getRequestParameter('manufacturer');
  	$date = $this->getRequestParameter('date');
  	$serialize_test_data = $this->getRequestParameter('test_data');
  	$serialize_extra_data = $this->getRequestParameter('extra_data');
  	$test_data = unserialize($serialize_test_data);
  	$extra_data = unserialize($serialize_extra_data);
  	$filename = $this->getRequestParameter('filename');
  	$location = $this->getRequestParameter('location');
    $comments = $this->getRequestParameter('comments');
    $assoc_client_id = $this->getRequestParameter('assoc_client');
 
	$c = new Criteria();
	$c->add(DevicePeer::IDENTIFICATION, $device_id);
	$deviceResult = DevicePeer::doSelect($c);
	if($deviceResult){
		
		$this->changePm2Missing($deviceResult[0]->getClientId());
		
		$c = new Criteria();
		$c->add(UnprocessedDevicesPeer::DEVICE_ID, $device_id);
		$c->add(UnprocessedDevicesPeer::FILENAME, $filename);
		$unprocessDevice = UnprocessedDevicesPeer::doSelect($c);
		$unprocessDevice = $unprocessDevice[0];
		if($unprocessDevice)
			$unprocessDevice->delete();
		
		//saving device info
		$deviceResult = $deviceResult[0];
		$deviceResult->setSerialNumber($serial);
		$deviceResult->setStatus(strtolower($pass_fail));
		$deviceResult->setLocation($location);
		$deviceResult->setComments($comments);
		$deviceResult->setLastPmDate(FinalDeviceReport::convertImportedDate($date));
		if($assoc_client_id > 0)
			$deviceResult->setClientId($assoc_client_id);
		$specificationId = $deviceResult->getSpecificationId();
		$deviceResult->save();
		
		$deviceCheckup = new DeviceCheckup();
		$deviceCheckup->setDeviceId($deviceResult->getId());
		$deviceCheckup->setClientId($deviceResult->getClientId());
		$deviceCheckup->setDeviceIdentification($device_id);
		$deviceCheckup->setDate($date);
		$deviceCheckup->setPassFail($pass_fail);
		$deviceCheckup->setTime($extra_data['time']);
		$deviceCheckup->setRowIndicator($extra_data['rowIndicator']);
		$deviceCheckup->setDeviceTechId($extra_data['techId']);
		//$deviceCheckup->setLocation($extra_data['location']);
		$deviceCheckup->setPassFailCode($extra_data['passFailCode']);
		$deviceCheckup->setRecNumber($extra_data['recNumber']);
		$deviceCheckup->setRowPurpose($extra_data['rowPurpose']);
		$deviceCheckup->setPhysicalInspection($extra_data['physicalInspection']);
		$deviceCheckup->setRoom($extra_data['room']);
		$deviceCheckup->save();
		$deviceCheckup->save();
		
		$device_test_data = new DeviceTestData();
		$device_test_data->setDeviceCheckupId($deviceCheckup->getId());
		$device_test_data->setName($test_data['name']);
		$device_test_data->setPassFail($test_data['passFail']);
		$device_test_data->setType($test_data['type']);
		$device_test_data->setUnit($test_data['unit']);
		$device_test_data->setValue($test_data['value']);
		$device_test_data->save();
		
		$this->changePm2Missing();
	}
	
	$c = new Criteria();
	$c->add(SpecificationPeer::ID, $specificationId);
	$specificationResult = SpecificationPeer::doSelect($c);
	if($specificationResult){
		$specificationResult = $specificationResult[0];
		$specificationResult->setManufacturer($manufacturer);
		$specificationResult->setModelNumber($model);
		$specificationResult->setDeviceName($device_name);
		$specificationResult->save();
	}
	
  	return sfView::NONE;
  }
  public function executeSaveNoMatch(){
  	
  	$option = $this->getRequestParameter('option');
  	$device_id = $this->getRequestParameter('device_id');
  	$d_device_id = $this->getRequestParameter('get_devices');
  	$device_name = $this->getRequestParameter('device_name');
  	$serial = $this->getRequestParameter('serial');
  	$model = $this->getRequestParameter("model");
  	$manufacturer = $this->getRequestParameter('manufacturer');
  	$pass_fail = $this->getRequestParameter('pass_fail');
  	$date = $this->getRequestParameter('date');
  	$client_id = $this->getRequestParameter('client_id');
  	$serialize_test_data = $this->getRequestParameter('test_data');
  	$serialize_extra_data = $this->getRequestParameter('extra_data');
  	$test_data = unserialize($serialize_test_data);
  	$extra_data = unserialize($serialize_extra_data);
  	$filename = $this->getRequestParameter('filename');
  	$location = $this->getRequestParameter('location');
    $comments = $this->getRequestParameter('comments');
  	
  	//if this is -1 use the origanal device identification
  	//otherwise use whatever value this is for the identifcation
  	$existingId = $this->getRequestParameter('existingId');

	$c = new Criteria();
	$c->add(UnprocessedDevicesPeer::DEVICE_ID, $device_id);
	$c->add(UnprocessedDevicesPeer::FILENAME, $filename);
	$unprocessDevice = UnprocessedDevicesPeer::doSelect($c);
	$unprocessDevice = $unprocessDevice[0];
	
	if($unprocessDevice)
		$unprocessDevice->delete();
	
	
	//add as new entry
	if($option == 1){
		$this->changePm2Missing($client_id);
		$specification = new Specification();
		$specification->setDeviceName($device_name);
		$specification->setManufacturer($manufacturer);
		$specification->setModelNumber($model);
		$specification->save();
		$specification_id = $specification->getId();
		
		$device = new Device();
		$device->setIdentification($device_id);
		$device->setClientId($client_id);
		$device->setSpecificationId($specification_id);
		$device->setSerialNumber($serial);
		$device->setLocation($location);
		$device->setStatus(strtolower($pass_fail));
		$device->setLastPmDate(FinalDeviceReport::convertImportedDate($date));
		$device->setComments($comments);
		$device->save();
		
		$deviceCheckup = new DeviceCheckup();
		$deviceCheckup->setDeviceId($device->getId());
		$deviceCheckup->setClientId($device->getClientId());
		$deviceCheckup->setDeviceIdentification($device_id);
		$deviceCheckup->setDate($date);
		$deviceCheckup->setPassFail($pass_fail);
		$deviceCheckup->setTime($extra_data['time']);
		$deviceCheckup->setRowIndicator($extra_data['rowIndicator']);
		$deviceCheckup->setDeviceTechId($extra_data['techId']);
		//$deviceCheckup->setLocation($extra_data['location']);
		$deviceCheckup->setPassFailCode($extra_data['passFailCode']);
		$deviceCheckup->setRecNumber($extra_data['recNumber']);
		$deviceCheckup->setRowPurpose($extra_data['rowPurpose']);
		$deviceCheckup->setPhysicalInspection($extra_data['physicalInspection']);
		$deviceCheckup->setRoom($extra_data['room']);
		$deviceCheckup->save();
		
		$device_test_data = new DeviceTestData();
		$device_test_data->setDeviceCheckupId($deviceCheckup->getId());
		$device_test_data->setName($test_data['name']);
		$device_test_data->setPassFail($test_data['passFail']);
		$device_test_data->setType($extra_data['physicalInspection']);
		$device_test_data->setUnit($test_data['unit']);
		$device_test_data->setValue($test_data['value']);
		$device_test_data->save();
	}else{
	//update existing 
	
	    $c = new Criteria();
	    $c->add(DevicePeer::IDENTIFICATION, $d_device_id);
	    $c->add(DevicePeer::CLIENT_ID, $client_id);
	    $device = DevicePeer::doSelect($c);
	    $device = $device[0];
	    if($device){
	    	$specification_id = $device->getSpecificationId();
	    	if($existingId != '-1'){
	    		$device->setIdentification($existingId);
	    	}
	    	$device->setSerialNumber($serial);
	    	$device->setLocation($location);
	    	$device->setStatus(strtolower($pass_fail));
	    	$device->setComments($comments);
	    	$device->setLastPmDate(FinalDeviceReport::convertImportedDate($date));
	    	$device->save();
	    	
	    		$deviceCheckup = new DeviceCheckup();
				$deviceCheckup->setDeviceId($device->getId());
				$deviceCheckup->setClientId($device->getClientId());
				$deviceCheckup->setDeviceIdentification($d_device_id);
				$deviceCheckup->setDate($date);
				$deviceCheckup->setPassFail($pass_fail);
				$deviceCheckup->setTime($extra_data['time']);
				$deviceCheckup->setRowIndicator($extra_data['rowIndicator']);
				$deviceCheckup->setDeviceTechId($extra_data['techId']);
				//$deviceCheckup->setLocation($extra_data['location']);
				$deviceCheckup->setPassFailCode($extra_data['passFailCode']);
				$deviceCheckup->setRecNumber($extra_data['recNumber']);
				$deviceCheckup->setRowPurpose($extra_data['rowPurpose']);
				$deviceCheckup->setPhysicalInspection($extra_data['physicalInspection']);
				$deviceCheckup->setRoom($extra_data['room']);
				$deviceCheckup->save();
				
				$device_test_data = new DeviceTestData();
				$device_test_data->setDeviceCheckupId($deviceCheckup->getId());
				$device_test_data->setName($test_data['name']);
				$device_test_data->setPassFail($test_data['passFail']);
				$device_test_data->setType($test_data['type']);
				$device_test_data->setUnit($test_data['unit']);
				$device_test_data->setValue($test_data['value']);
				$device_test_data->save();
	    }

	    
	    $c= new Criteria();
	    $c->add(SpecificationPeer::ID,$specification_id);
	    $specification = SpecificationPeer::doSelect($c);
	    $specification = $specification[0];
	    if($specification){
	    	$specification->setDeviceName($device_name);
			$specification->setManufacturer($manufacturer);
			$specification->setModelNumber($model);
			$specification->Save();
	    }
	}
  	return sfView::NONE;
  }
  public function executeGetDevices(){
  	$client_id = $this->getRequestParameter('client_id');
  
 
  	$c = new Criteria();
  	$c->add(DevicePeer::CLIENT_ID, $client_id);
  	$c->addAscendingOrderByColumn(DevicePeer::IDENTIFICATION);
  	$result = DevicePeer::doSelect($c);
  	$this->devices = $result; 
  }
  public function executeDeviceIdChanged(){
  	  	//these info are from the uploaded file
	  	$device_name = $this->getRequestParameter('dn');
	  	$manufacturer = $this->getRequestParameter('man');
	  	$model = $this->getRequestParameter('mod');
	  	$serial = $this->getRequestParameter('ser');
	  	//device id we want to associate to
	  	$existing_device_id = $this->getRequestParameter('existing_device_id');
        
	  	$c = new Criteria();
	  	$c->add(DevicePeer::IDENTIFICATION, $existing_device_id);// <---------------------------------------------------
	  	$c->addjoin(DevicePeer::SPECIFICATION_ID, SpecificationPeer::ID, Criteria::LEFT_JOIN);
	  	$result = DevicePeer::doSelect($c);
	  	$this->oldDevice = $result[0];
	  	$this->newDevice = array('device_name'=>$device_name, 'manufacturer'=>$manufacturer, 'model'=>$model, 'serial'=>$serial);
  }
  public function executeListDevices(){
		$client_id = $this->getRequestParameter('client_id');
		$c= new Criteria(); 
		$c->add(DevicePeer::CLIENT_ID, $client_id);
		$c->addjoin(DevicePeer::SPECIFICATION_ID, SpecificationPeer::ID,Criteria::LEFT_JOIN);
		$devices = DevicePeer::doSelect($c);
		$this->devices = $devices;
		$this->client_id = $client_id;
		if($devices && $devices[0]->getClient() )
			$this->contact = $devices[0]->getClient()->getAttn();
  }
  public function executeQuotes(){
  	
		$client_id = $this->getRequestParameter('client_id');
		$checkedItemStr = $this->getRequestParameter('checkedItems'); //ids of items that were checked for update
		
		$c= new Criteria(); 
		$c->add(DevicePeer::CLIENT_ID, $client_id);
		$devices = DevicePeer::doSelect($c);
			
		if(!empty($checkedItemStr)){
			$checkedItems = explode(',',$checkedItemStr); 
			for($i = 0; $i<count($devices); $i++){
				if(strtolower($devices[$i]->getStatus())=='fail' and in_array($devices[$i]->getId(),$checkedItems)){
					$devices[$i]->setStatus('quote');
					$devices[$i]->save();
				}
			}
		}//if
		
		$this->devices = $devices;
		$this->client_id = $client_id;
		$this->setTemplate('listDevices');
  }
  public function executePendingRepair(){
  	
		$client_id = $this->getRequestParameter('client_id');
		$checkedItemStr = $this->getRequestParameter('checkedItems'); //ids of items that were checked for update
		
		$c= new Criteria(); 
		$c->add(DevicePeer::CLIENT_ID, $client_id);
		$devices = DevicePeer::doSelect($c);
		
		if(!empty($checkedItemStr)){
			$checkedItems = explode(',',$checkedItemStr); 
			for($i = 0; $i<count($devices); $i++){
				if(strtolower($devices[$i]->getStatus())=='quote' and in_array($devices[$i]->getId(),$checkedItems)){
					$devices[$i]->setStatus('pending repair');
					$devices[$i]->save();
				}
			}
		}
		$this->devices = $devices;
	    $this->client_id = $client_id;
		$this->setTemplate('listDevices');
  }
  public function executeGenerateReport(){
		$client_id = $this->getRequestParameter('client_id');
		$contact = trim($this->getRequestParameter('contact'),' ');
		
		$client = ClientPeer::retrieveByPk($client_id);
		if($client){
			if(!empty($contact)) 
				$contactName = $contact ;
			else {
				$contactName = ($client->getAddressType() == 1) ? $client->getAttn() : $client->getSecondaryAttn();
			}
		}
		
			//-------------------------------------------------------------------
	 	$c = new Criteria();
  		$c->add(DevicePeer::CLIENT_ID, $client_id);
  		$c->add(DevicePeer::STATUS, strtolower('fail'));
  		$totalFail = count(DevicePeer::doSelect($c));
  
  		
  		$c = new Criteria();
  		$c->add(DevicePeer::CLIENT_ID, $client_id);
  		$c->add(DevicePeer::STATUS, strtolower('pass'));
  		$totalPass = count(DevicePeer::doSelect($c));
   
  		
  		$c = new Criteria();
  		$c->add(DevicePeer::CLIENT_ID, $client_id);
  		$c->add(DevicePeer::STATUS, strtolower('missing'));
  		$totalMissing = count(DevicePeer::doSelect($c));
   
  		
  		$c = new Criteria();
  		$c->add(DevicePeer::CLIENT_ID, $client_id);
  		$c->add(DevicePeer::STATUS, "missing", CRITERIA::NOT_EQUAL);
  		$c->addJoin(DevicePeer::SPECIFICATION_ID, SpecificationPeer::ID, CRITERIA::LEFT_JOIN);
  		$c->add(SpecificationPeer::DEVICE_NAME,'BAUMANOMETER');
  		$totalBp = count(DevicePeer::doSelect($c));
  		
  		
  		$c = new Criteria();
  		$c->add(DevicePeer::CLIENT_ID, $client_id);
  		$c->add(DevicePeer::STATUS, "missing", CRITERIA::NOT_EQUAL);
  		$c->addJoin(DevicePeer::SPECIFICATION_ID, SpecificationPeer::ID, CRITERIA::LEFT_JOIN);
  		$c->add(SpecificationPeer::DEVICE_NAME,'TRACE GAS N20');
  		$totalTrace = count(DevicePeer::doSelect($c));
  		
  		$c = new Criteria();
  		$c->add(DevicePeer::CLIENT_ID, $client_id);
  		$c->add(DevicePeer::STATUS, "missing", CRITERIA::NOT_EQUAL);
  		$c->addJoin(DevicePeer::SPECIFICATION_ID, SpecificationPeer::ID, CRITERIA::LEFT_JOIN);
  		$c->add(SpecificationPeer::DEVICE_NAME,'WALL OUTLET');
  		$totalOutlets = count(DevicePeer::doSelect($c));
	//-------------------------------------------------------------------	
 
		
		$c = new Criteria();
		$c->add(DevicePeer::CLIENT_ID, $client_id);
		$c->add(DevicePeer::STATUS, 'missing');
		$missingDevices = DevicePeer::doSelect($c);
		if($missingDevices){
	 
			$report = new FinalDeviceReport();
			$report->setClientId($client_id);
			$report->setDate(date('Y').'-'.date('m').'-'.date('d'));
			$report->setPassFail('missing');
			$report->setTotalPassed($totalPass);
			$report->setTotalFailed($totalFail);
			$report->setTotalMissed($totalMissing);
			$report->setTotalTrace($totalTrace);
			$report->setTotalBp($totalBp);
			$report->setTotalOutlets($totalOutlets);
			$report->setContact($contactName);
			$report->save();
			
			foreach($missingDevices as $f_device){
				$missing = new DevicesFailed();
				$missing->setReportId($report->getId());
				$missing->setClientId($f_device->getClientId());
				$missing->setDeviceId($f_device->getId());
				$missing->setStatus($f_device->getStatus());
				$missing->save();
			}//foreach
		}
		
		
		$c = new Criteria();
		$c->add(DevicePeer::CLIENT_ID, $client_id);
		$c->add(DevicePeer::STATUS, 'fail');
		$failDevices = DevicePeer::doSelect($c);
		
		if($failDevices){
			//report failed
			
			 
			$report = new FinalDeviceReport();
			$report->setClientId($client_id);
			$report->setDate(date('Y').'-'.date('m').'-'.date('d'));
			$report->setPassFail('fail');
			$report->setTotalPassed($totalPass);
			$report->setTotalFailed($totalFail);
			$report->setTotalMissed($totalMissing);
			$report->setTotalTrace($totalTrace);
			$report->setTotalBp($totalBp);
			$report->setTotalOutlets($totalOutlets);
			$report->setContact($contactName);
			$report->save();
			
			foreach($failDevices as $f_device){
				$fail = new DevicesFailed();
				$fail->setReportId($report->getId());
				$fail->setClientId($f_device->getClientId());
				$fail->setDeviceId($f_device->getId());
				$fail->setStatus($f_device->getStatus());
				$fail->save();
			}//foreach
			
		}else{
			//report passed
			
		//in order to get contact name
 
			
			$report = new FinalDeviceReport();
			$report->setClientId($client_id);
			$report->setDate(date('Y').'-'.date('m').'-'.date('d'));
			$report->setPassFail('pass');
			$report->setTotalPassed($totalPass);
			$report->setTotalFailed($totalFail);
			$report->setTotalMissed($totalMissing);
			$report->setTotalTrace($totalTrace);
			$report->setTotalBp($totalBp);
			$report->setTotalOutlets($totalOutlets);
			$report->setContact($contactName);
			$report->save();
		}
		
		$c = new Criteria();
		$c->add(FinalDeviceReportPeer::CLIENT_ID, $client_id);
		$c->addDescendingOrderByColumn(FinalDeviceReportPeer::CREATED_AT);
		$finalReport = FinalDeviceReportPeer::doSelect($c);
		$this->finalReport = $finalReport;
		
  }
  public function executeGetReports(){
  	    $client_id = $this->getRequestParameter('client_id');
  	    $c = new Criteria();
		$c->add(FinalDeviceReportPeer::CLIENT_ID, $client_id);
		$c->addDescendingOrderByColumn(FinalDeviceReportPeer::CREATED_AT);
		$finalReport = FinalDeviceReportPeer::doSelect($c);
		$this->finalReport = $finalReport;
		$this->setTemplate('generateReport');
  }
  public function executeDeleteReport(){
  	
  	
  	    $client_id = $this->getRequestParameter('client_id');
  	    $report_id = $this->getRequestParameter('id');
  	    
  	    $c = new Criteria();
  	    $c->add(FinalDeviceReportPeer::ID, $report_id);
  	    $c->add(FinalDeviceReportPeer::CLIENT_ID, $client_id);
  	    $c->addDescendingOrderByColumn(FinalDeviceReportPeer::CREATED_AT);
  	    $forDelete = FinalDeviceReportPeer::doSelect($c);
  	    if($forDelete){
  	    	$forDelete[0]->delete();
  	    }
  	    
  	    $c = new Criteria();
		$c->add(FinalDeviceReportPeer::CLIENT_ID, $client_id);
		$c->addDescendingOrderByColumn(FinalDeviceReportPeer::CREATED_AT);
		$finalReport = FinalDeviceReportPeer::doSelect($c);
		$this->finalReport = $finalReport;
		$this->setTemplate('generateReport');
  }
  public function executeSaveComments(){
  	$device_id = $this->getRequestParameter('device_id');
  	$comments = $this->getRequestParameter('comments');
  	
  	$device = DevicePeer::retrieveByPK($device_id);
  	if($device){
  		$device->setComments($comments);
  		$device->save();
  	}
  	return sfView::NONE;
  }
  public function executeCreatePdf(){
		
		$client_id = 0; //default val
		
		
		$id = $this->getRequestParameter('id');
		
		$c = new Criteria();
		$c->add(DeviceCheckupPeer::DATE, $date);
		$c->add(DeviceCheckupPeer::CLIENT_ID, $client_id);
		$c->add(DeviceCheckupPeer::PASS_FAIL, 'FAIL');
		$failedDevices = DeviceCheckupPeer::doSelect($c);
		
		$c = new Criteria();
		$c->add(FinalDeviceReportPeer::ID, $id);
		$c->setLimit(1);
		$all = FinalDeviceReportPeer::doSelect($c);
		
		if(empty($all))
			$passed = true;
		elseif(strtolower($all[0]->getPassFail())=='fail'){
			$passed = false;
			$missing = false;
		}elseif(strtolower($all[0]->getPassFail())=='pass'){
			$passed = true;
			$missing = false;
		}elseif(strtolower($all[0]->getPassFail())=='missing'){
			$missing = true;
		}
		
		if(!empty($all))
			$client_id = 	$client_id = $all[0]->getClientId();
	 
			
			$c = new Criteria();
			$c->add(ClientPeer::ID, $client_id);
			$clientinfo = ClientPeer::doSelect($c);
		 
		 
		
		define('FPDF_FONTPATH',SF_ROOT_DIR.'/web/font/');
		$date = date("F d, Y", time());
		
		$clientName = $clientinfo[0]->getClientName();
		
		if($clientinfo[0]->getAddressType() == 1){
			$address_line_1 = $clientinfo[0]->getAddress();
			$address_line_2 = $clientinfo[0]->getAddress2();
			$address_line_3 = $clientinfo[0]->getCity().', '.$clientinfo[0]->getState().' '.$clientinfo[0]->getZip();
			//$contact = $clientinfo[0]->getAttn();
			$contact = $all[0]->getContact();
		}else{
			$address_line_1 = $clientinfo[0]->getSecondaryAddress();
			$address_line_2 = $clientinfo[0]->getSecondaryAddress2();
			$address_line_3 = $clientinfo[0]->getSecondaryCity().', '.$clientinfo[0]->getSecondaryState().' '.$clientinfo[0]->getSecondaryZip();
			//$contact = $clientinfo[0]->getSecondaryAttn();
			$contact = $all[0]->getContact();
		}
		
		
		$subject = "Re:  Preventive Maintenance Test Results ";
		
		if($missing){
				$line_1 = "While our technician was doing preventive maintenance on your equipment, some devices were missed. The following is a list of the equipment that were not checked: 
		";
			$line_2 = "
			We would like to schedule a time to complete the preventive maintenance on this equipment. Please call us and we will arrange for a technician to complete this work. If you have any questions, please do not hesitate to call. ";
			$signer = "Chris Endres, VP";
		}else{
			$line_1 = "While our technician was doing preventive maintenance on your equipment, some failures were found. The following is a list of the equipment and the problems that were found:
			";
			$line_2 = "
			We would like to schedule a time to repair this equipment. Please call us and we will arrange for a technician to perform the needed repair immediately. If you have any questions, please do not hesitate to call.";
			$signer = "Chris Endres, VP";
		}
		
		
		$passed_line = "While our technician was doing preventive maintenance on your equipment there were no problems found. Enclosed please find the reports for all equipment tested. If you need any repairs or have any questions, please do not hesitate to call.
		"; 
		
		$pdf=new FPDF();
		$pdf->SetMargins(30,25,30);
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
			
			
			//search for failed  device for report
			if($missing){
				$c = new Criteria();
				$c->add(DevicesFailedPeer::CLIENT_ID, $client_id);
				$c->add(DevicesFailedPeer::REPORT_ID, $id);
				$c->add(DevicesFailedPeer::STATUS, 'missing');
				$c->addjoin(DevicesFailedPeer::DEVICE_ID,DevicePeer::ID, Criteria::LEFT_JOIN);
				
				$failedDevices = DevicesFailedPeer::doSelect($c);
		 
				foreach($failedDevices as $failedDevice){
					$currentDevice = $failedDevice->getDevice();
					if($currentDevice){
						$deviceName = $currentDevice->getSpecification()->getDeviceName();
						$deviceIdentification = $currentDevice->getIdentification();
						
						$pdf->Cell(0,5,"        * $deviceIdentification - $deviceName",0,1);
					}
				}
			}else{
				$c = new Criteria();
				$c->add(DevicesFailedPeer::CLIENT_ID, $client_id);
				$c->add(DevicesFailedPeer::REPORT_ID, $id);
				$c->add(DevicesFailedPeer::STATUS, 'fail');
				$c->addjoin(DevicesFailedPeer::DEVICE_ID,DevicePeer::ID, Criteria::LEFT_JOIN);
				
				$failedDevices = DevicesFailedPeer::doSelect($c);
		 
				foreach($failedDevices as $failedDevice){
					$currentDevice = $failedDevice->getDevice();
					if($currentDevice){
						$comments = ($currentDevice->getComments()) ? '- ' . $currentDevice->getComments() : '';
						$comments = strtoupper($comments);
						$deviceName = $currentDevice->getSpecification()->getDeviceName();
						$deviceIdentification = $currentDevice->getIdentification();
						$pdf->Cell(0,5,"        * $deviceIdentification - $deviceName $comments",0,1);
					}
				}
			}
			
			$pdf->Cell(0,5," ",0,1);
			$pdf->MultiCell(0,5,$line_2,0,1);
		}
		
		$pdf->Cell(0,5," ",0,1);

		$pdf->Cell(0,5,"Sincerely, ",0,1);
		$pdf->Cell(0,5," ",0,1);
		$pdf->Cell(0,5," ",0,1);
		$pdf->Cell(0,5," ",0,1);
		$pdf->Cell(0,5,$signer,0,1);
		
		//$pdf->Cell(0,5,$subject,0,1);
		//$pdf->Cell(0,5,$subject,0,1);
		//$pdf->Cell(0,5,$subject,0,1);
		$pdf->Output();
		return svView::NONE;
	}
  private function changePm2Missing($clientId = null){
  	
  	if(empty($clientId)) return;
  	
  	$c = new Criteria();
  	$c->add(DevicePeer::CLIENT_ID,$clientId);
  	$c->add(DevicePeer::STATUS,'pm scheduled');
  	$devices = DevicePeer::doSelect($c);
  	foreach($devices as $device){
  		$device->setStatus('missing');
  		$device->save();
  	}
  }
  public function executeUpdateFullMatch(){
  	$client_id = $this->getRequestParameter('client_id');
  	$device_id = $this->getRequestParameter('device_id');
  	if($client_id > 0){
	  	$device = DevicePeer::retrieveByPk($device_id);
	  	 
	  	if($device){
	  		$device->setClientId($client_id);
	  		$device->save();
	  	}
  	}
  	return sfView::NONE;
  }
}
