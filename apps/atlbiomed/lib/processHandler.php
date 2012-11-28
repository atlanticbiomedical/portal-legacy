<?php
class processHandler{
	
	private $parsedFileData = array();
	private $deviceData = null;
	private $fileName = null;
	private $partial = array();
	private $noMatch = array();
	private $match = array();
	private $shouldForward = false;
	
	public function __construct($request=''){
		 
		if(empty($request))
			return false;
	 
		$uploadedFile = $this->readUploadedFile($request);
		 
		
		$c = new Criteria();
	  	$c->add(DevicesFilesPeer::FILENAME, $this->fileName);
	  	$devicesFiles = DevicesFilesPeer::doSelect($c);
	  	$devicesFilesResult = $devicesFiles[0]; 
	  	
	  	if(!$devicesFilesResult){
			$this->parseData($uploadedFile);
			$this->deviceData = new DeviceData();
			$this->deviceData->readRow($this->parsedFileData);
			$this->searchForMatch();
		
	  		//save the parsed content of the file
	  	    $devicesFiles = new DevicesFiles();
	  		$devicesFiles->setFilename($this->fileName);
	  		$devicesFiles->setData(serialize($this->parsedFileData));
	  		$devicesFiles->saveToDisk();
	  		$devicesFiles->save();
	  	}else{
	  		  $this->shouldForward = true;
	  	}
	}	
	public function loadFile($filename){	
		$c = new Criteria();
		$c->add(DevicesFilesPeer::FILENAME, $filename);
		$result = DevicesFilesPeer::doSelect($c);
		$result = $result[0];
		if(!$result)
			return false;
		
	    $deviceFile = new DevicesFiles();
	    $deviceFile->loadFromDisk($filename);
	    
	    if(!$deviceFile->fileLoaded())  //fail to load data
	    	return false;
		$this->parsedFileData = $deviceFile->getData();
		
		$this->fileName = $filename;
		$this->deviceData = new DeviceData();
		$this->deviceData->readRow($this->parsedFileData);
		$this->searchForMatch(true); //element those that were already processed
	}

	public function shouldForward(){
		return $this->shouldForward;
	}
	private function readUploadedFile($request){
		
		$this->request = $request;
		//$upload_path = 'uploads/spreadsheet/unparsed';
	  	$fileName = $this->request->getFileName ( 'upload' );
	  	$micro = microtime();
	  	$micro = str_replace(' ','-',$micro);
	  	$date = date("M-d-Y",time());
	  	$destination_path = $upload_path . DIRECTORY_SEPARATOR . "$date-$micro-$fileName";
	  	$destination_path = $upload_path . DIRECTORY_SEPARATOR .$fileName;
	  	
	
	  	//read file data
	  	if ( !empty($fileName)) { 
	  		$this->fileName = $fileName; 
	  		
			$tmpPath =  $this->request->getFilePath ( 'upload' );
			//$this->request->moveFile ( 'upload', $destination_path);
			
			if(file_exists($tmpPath)){
				$fp = fopen($tmpPath,'r');
				if($fp){
					while($partial_data = fread($fp,1024)){
						$data .= $partial_data;
					}
				}
			}
			return $data;
		}//if
	}
    private function parseData($rawFile){
    	//break down the data by ',' and newline into arrays
		$rows_data = array();
		if(!empty($rawFile)){
			$rows = explode("\n", $rawFile);
			foreach($rows as $row){
				$row = trim($row,' ');
				if(empty($row)) continue;
					$columns = explode(',',$row);
					$explodedData [] = $columns; //all the rows and columns exploded	
			}//for each 
			
			
			//strip away quotes and blank spaces
			$tempData = array();
			for($i = 0; $i < count($explodedData); $i++){
				for($j = 0; $j < count($explodedData[$i]); $j++){
					$tempData[$i][$j] = trim ( str_replace ( '"', '', $explodedData[$i][$j] ), ' ' );
				}//for
			}//for'
			$this->parsedFileData=$tempData;
		}	
    }
	public function getParsedData(){
		return $this->parsedFileData;
	}
	
	public function searchForMatch($eliminateSaved= false){
		
		if(!$this->deviceData)
			return false;
			
		$notAlreadySavedDevices = ($eliminateSaved) ? $this->getUnprocessedDevices($this->fileName) : array();
		 
		$totalRecords = $this->deviceData->getTotalRecords();
		for($row = 0; $row < $totalRecords; $row++){
			//data for this row
			$device_id = $this->deviceData->getDeviceId($row);
			$device_name = $this->deviceData->getDeviceName($row);
			$manufacturer = $this->deviceData->getManufacturer($row);
			$model = $this->deviceData->getModel($row);
			$serial = $this->deviceData->getSerial($row);
			$p_date = $this->deviceData->getDate($row);
			$pass_fail = $this->deviceData->getPassFail($row);
			$location = $this->deviceData->getLocation($row);
			$random_id = $this->getRandomNumber();
			$p_date = str_replace('/','-',$p_date);
			$testData = $this->deviceData->getAllTestData($row);
			$time = $this->deviceData->getTime($row);
			$deviceTechId = $this->deviceData->getDeviceTechId($row);
			$rowIndicator = $this->deviceData->getRowIndicator($row);
			$passFailCode = $this->deviceData->getPassFailCode($row);
			$recNumber = $this->deviceData->getRecNumber($row);
			$rowPurpose = $this->deviceData->getRowPurpose($row);
			$physicalInspection = $this->deviceData->getPhysicalInspection($row);
			$room = $this->deviceData->getRoom($row);
			
			$extraData = array('time'=>$time,'techId'=>$deviceTechId, 'rowIndicator'=>$rowIndicator, 'location'=>$location, 'passFailCode'=>$passFailCode,
			'recNumber'=>$recNumber, 'rowPurpose'=>$rowPurpose,'physicalInspection'=>$physicalInspection, 'room'=>$room);
		
						//search for a device with this indentification
			$c = new Criteria(); 
			$c->add(DevicePeer::IDENTIFICATION, $device_id); //$c->addjoin(DevicePeer::SPECIFICATION_ID, SpecificationPeer::ID, Criteria::LEFT_JOIN);
			$result = DevicePeer::doSelect($c);
			
			//if id matches
			if(!empty($result[0])){
				$_deviceName = $result[0]->getSpecification()->getDeviceName();
				$_model = $result[0]->getSpecification()->getModelNumber();
				$_manufacturer = $result[0]->getSpecification()->getManufacturer();
				$_serial = $result[0]->getSerialNumber();
				$_status = $result[0]->getStatus();
				$retiredWarning = (strtolower($_status)=='retired') ? "<span style='color:red'> Warning: Retired</span>" : '';
				
				 
				
				
				
				
				
				                                                                                                                                                                   //if the serial in mup file is empty consider it a match still
				if(strtolower($device_name) == strtolower($_deviceName) && strtolower($model) == strtolower($_model) && strtolower($manufacturer) == strtolower($_manufacturer) && (strtolower($serial) == strtolower($_serial) || empty($serial))  ){
				
					
						
					$this->changePm2Missing($result[0]->getClientId()); // changed any 'pm scheduled' to 'missing' because we have a match
					
					//for matched devices
					//save the pass fail code
					$result[0]->setStatus(strtolower($pass_fail));
					$result[0]->setLocation($location);
					$result[0]->setComments($passFailCode);
					$result[0]->setLastPmDate(FinalDeviceReport::convertImportedDate($p_date));
					$result[0]->save();
					
					
					$client_name = $result[0]->getClient()->getClientIdentification().' - '.$result[0]->getClient()->getClientName();
					//total match
					$deviceCheckup = new DeviceCheckup();
					$deviceCheckup->setDeviceId($result[0]->getId());
					$deviceCheckup->setClientId($result[0]->getClientId());
					$deviceCheckup->setDeviceIdentification($device_id);
					$deviceCheckup->setDate($p_date);
					$deviceCheckup->setPassFail($pass_fail);
					
					$deviceCheckup->setPassFailCode($passFailCode);
					$deviceCheckup->setRowIndicator($rowIndicator);
					$deviceCheckup->setRowPurpose($rowPurpose);
					$deviceCheckup->setRoom($room);
					$deviceCheckup->setPhysicalInspection($physicalInspection);
					$deviceCheckup->setRecNumber($recNumber);
					$deviceCheckup->setTime($time);			
					$deviceCheckup->save();
					
					$match = array('id'=>$result[0]->getId(),'client_name'=>$client_name, 'random_id'=>$random_id,'type'=>2,'device_id'=>$device_id, 'device_name'=>$device_name,'model'=>$model,
					'manufacturer'=>$manufacturer, 'serial'=>$serial, 'date'=>$p_date); 
					
					if($eliminateSaved){ //these devices were not saved yet
						if(in_array($device_id,$notAlreadySavedDevices))
				    		$this->match[] = $match; 
					}else 
						$this->match[] = $match;
				     
				}else{
					//give option
					$pm_deviceName = array($device_name, $_deviceName);
					$pm_manufacturer = array($manufacturer, $_manufacturer);
					$pm_serial = array($serial, $_serial);
					$pm_model = array($model, $_model);
					$client_name = $result[0]->getClient()->getClientIdentification().' - '.$result[0]->getClient()->getClientName();
					 
					
					 $misMatch = array('device_name'=>false, 'model'=>false, 'manufacturer'=>false, 'serial'=>false);
					if(strtolower($device_name) != strtolower($_deviceName))
						$misMatch['device_name'] = true;
					if(strtolower($model) != strtolower($_model))
						$misMatch['model'] = true;
					if(strtolower($manufacturer) != strtolower($_manufacturer))
						$misMatch['manufacturer'] = true;
					if((strtolower($serial) != strtolower($_serial) && !empty($serial)))
						$misMatch['serial'] = true;
					 
					
					$partial_match = array('misMatch'=>$misMatch, 'comments'=>$passFailCode, 'location'=>$location, 'warning'=>$retiredWarning,'client_name'=>$client_name,'random_id'=>$random_id,'type'=>2,'device_id'=>$device_id, 'device_name'=>$pm_deviceName,'model'=>$pm_model,
					'manufacturer'=>$pm_manufacturer, 'serial'=>$pm_serial, 'date'=>$p_date, 'pass_fail'=>$pass_fail, 'testData'=>$testData, 'extraData'=>$extraData); 
					$this->totalPartialMatch += 1;
					
					if($eliminateSaved){ //these devices were not saved yet
						if(in_array($device_id,$notAlreadySavedDevices))
				    		$this->partial[] = $partial_match;
					}else 
						$this->partial[] = $partial_match;
				    
					if(!$eliminateSaved){
						$c = new Criteria();
						$c->add(UnprocessedDevicesPeer::FILENAME, $this->fileName);
						$c->add(UnprocessedDevicesPeer::DEVICE_ID,$device_id);
						$c->setLimit(1);
						$dcheck = UnprocessedDevicesPeer::doSelect($c);
						if(empty($dcheck)){  //unprocessed device record of this does not exit
						    //saved as unprocessed
						    $unprocessed = new UnprocessedDevices();
						    $unprocessed->setFilename($this->fileName);
						    $unprocessed->setDeviceId($device_id);
						    $unprocessed->save();
						}
					}
				}
			}else{
					
				$no_match = array('comments'=>$passFailCode, 'location'=>$location, 'warning'=>$retiredWarning,'random_id'=>$random_id,'type'=>3, 'device_id'=>$device_id, 'device_name'=>$device_name,'model'=>$model,
					'manufacturer'=>$manufacturer, 'serial'=>$serial, 'date'=>$p_date, 'pass_fail'=>$pass_fail, 'testData'=>$testData, 'extraData'=>$extraData );
				
				if($eliminateSaved){ //these devices were not saved yet
					if(in_array($device_id,$notAlreadySavedDevices))
				    	$this->noMatch[] = $no_match; 
				}else 
						$this->noMatch[] = $no_match; 
						
				//saved as unprocessed
				if(!$eliminateSaved){
						$c = new Criteria();
						$c->add(UnprocessedDevicesPeer::FILENAME, $this->fileName);
						$c->add(UnprocessedDevicesPeer::DEVICE_ID,$device_id);
						$c->setLimit(1);
						$dcheck = UnprocessedDevicesPeer::doSelect($c);
						if(empty($dcheck)){  //unprocessed device record of this does not exit
						    //saved as unprocessed
							$unprocessed = new UnprocessedDevices();
							$unprocessed->setFilename($this->fileName);
							$unprocessed->setDeviceId($device_id);
							$unprocessed->save();
						}//if
				}
			}//if
		}//for
	}//function
	public function getUnprocessedDevices($filename){
		$unprocessedDevices_id  = array();
		$c = new Criteria();
		$c->add(UnprocessedDevicesPeer::FILENAME, $filename);
		$unprocessedDevices = UnprocessedDevicesPeer::doSelect($c);
		foreach($unprocessedDevices as $unprocessedDevice){
			$unprocessedDevices_id[] = $unprocessedDevice->getDeviceId();
		}
		return $unprocessedDevices_id;
	}
	public function getMatched(){
		return $this->match;
	}
	public function getFilename(){
		return $this->fileName;
	}
	public function getPartialMatch(){
		return $this->partial;
	}
	public function getNoMatch(){
		return $this->noMatch;
	}
    public function getRandomNumber(){
    	srand((double)microtime()*1000000); 
        return rand(0,2000000); 
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
 
}