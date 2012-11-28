<?php
class DeviceData {
	
	private $uploadedData = null;
	public function getData(){
		return $this->uploadedData;
	}
	
	public function __construct() {
	
	}
	public function getTotalRecords(){
		return	count($this->uploadedData);
	}
	
	public function readRow($rows) {
		$rows = $this->groupData($rows);
		$this->uploadedData = $rows;
	}
	

	
	private function groupData($rows){
		$groupedData = array();
		$lastRow = count($rows)-1;
		$temp = array();
		
		for($i = 0; $i < count($rows); $i++){
	
			$startRowIndex = $i;  //checking index
			$nextIndex = $i+1;      //next index
			$startRow = $rows[$i];  //checking row
			array_push($temp, $startRow);
 
			
			while($startRow[0] == $rows[$nextIndex][0] && $rows[$nextIndex][1] == 3){
				array_push($temp,$rows[$nextIndex]); //add to temp array
				$currentRow = $nextIndex;
				$nextIndex++;
				$i++; //increment becuase we don't want to check in next for loop
			}//while
			$groupedData[] = $temp;
			unset($temp);
			$temp = array();
			
		}//for
		return $groupedData;
	}//function
	public function getDeviceId($index){
		$totalRows = count($this->uploadedData);
		if($index >= $totalRows)
			return null;
		return $this->uploadedData[$index][0][0];
	}
	public function getRowIndicator($index){
		$totalRows = count($this->uploadedData);
		if($index >= $totalRows)
			return null;
		return $this->uploadedData[$index][0][1];
	}
	public function getDate($index){
		$totalRows = count($this->uploadedData);
		if($index >= $totalRows)
			return null;
		return $this->uploadedData[$index][0][2];
	}
	public function getTime($index){
		$totalRows = count($this->uploadedData);
		if($index >= $totalRows)
			return null;
		return $this->uploadedData[$index][0][3];
	}
	public function getPassFail($index){
		$totalRows = count($this->uploadedData);
		if($index >= $totalRows)
			return null;
			
		if(@strtolower($this->uploadedData[$index][0][4]) == 'fail' || @strtolower($this->uploadedData[$index][1][4]) == 'fail'
	 		|| @strtolower($this->uploadedData[$index][0][12]) == 'fail' || @strtolower($this->uploadedData[$index][1][12]) == 'fail')
			return 'fail';
		else
			return $this->uploadedData[$index][0][4];
	}
	public function getDeviceTechId($index){
		$totalRows = count($this->uploadedData);
		if($index >= $totalRows)
			return null;
		return $this->uploadedData[$index][0][5];
	}
	public function getDeviceName($index){
		$totalRows = count($this->uploadedData);
		if($index >= $totalRows)
			return null;
		return $this->uploadedData[$index][0][6];
	}
	public function getManufacturer($index){
		$totalRows = count($this->uploadedData);
		if($index >= $totalRows)
			return null;
		return $this->uploadedData[$index][0][7];
	}
	public function getLocation($index){
		$totalRows = count($this->uploadedData);
		if($index >= $totalRows)
			return null;
		return $this->uploadedData[$index][0][50];
	}
	public function getModel($index){
		$totalRows = count($this->uploadedData);
		if($index >= $totalRows)
			return null;
		return $this->uploadedData[$index][0][9];
	}
	public function getSerial($index){
		$totalRows = count($this->uploadedData);
		if($index >= $totalRows)
			return null;
		return $this->uploadedData[$index][0][10];
	}
	public function getPassFailCode($index){
		$totalRows = count($this->uploadedData);
		if($index >= $totalRows)
			return null;
		return $this->uploadedData[$index][1][12];
	}
	public function getRecNumber($index){
		$totalRows = count($this->uploadedData);
		if($index >= $totalRows)
			return null;
		return $this->uploadedData[$index][0][14];
	}
	public function getRowPurpose($index){
		$totalRows = count($this->uploadedData);
		if($index >= $totalRows)
			return null;
		return $this->uploadedData[$index][0][18];
	}
	public function getPhysicalInspection($index){
		$totalRows = count($this->uploadedData);
		if($index >= $totalRows)
			return null;
		return $this->uploadedData[$index][0][49];
	}
	public function getRoom($index){
		$totalRows = count($this->uploadedData);
		if($index >= $totalRows)
			return null;
		return $this->uploadedData[$index][0][51];
	}
	public function getTotalTest($index){
		$firstTestIndex = 54; // tests always start at index 54
		$currentIndex = $firstTestIndex;
		$totalTests = 0;
 
	 
		if($this->uploadedData[$index][0][1] == 3)
			$row = $this->uploadedData[$index][0];
		else if($this->uploadedData[$index][1][1] == 3){
			$row = $this->uploadedData[$index][1];
		}else 
			return 0; 
		
		 
		while(is_numeric($row[$currentIndex])){
			$totalTests += 1; //if its a int that is one test
			$currentIndex += 4; //if value at every 4 increment is INT then it is a test
			
		}
		return $totalTests;
	}
	public function getTestDetail($index,$testNumber){
		
		$totalTests  = $this->getTotalTest($index);
		if($testNumber> $totalTests)
			return array('name'=>'','passFail'=>'','value'=>'','unit'=>'','type'=>'');
		
		 
		$firstTestIndex = 54; // tests always start at index 54
		$currentIndex = $firstTestIndex;
		$totalTests = 0;
 
	 
		$totalRows = count($this->uploadedData[$index]);
		
		if($this->uploadedData[$index][0][1] == 3){
			$usingType3 = true;
			$row = $this->uploadedData[$index][0];
		}
		else if($this->uploadedData[$index][1][1] == 3){
			$usingType3 = false;
			$row = $this->uploadedData[$index][1];
		}else 
			return 0; 

		$searchIndex = $firstTestIndex + (($testNumber-1)*4);
			
	 
		if($totalRows>=2){
			$name = @$this->uploadedData[$index][1][$searchIndex+1];//second line
			$type = @$this->uploadedData[$index][0][$searchIndex+2];
			$passFail = @$this->uploadedData[$index][1][$searchIndex+2];
			$value = @$this->uploadedData[$index][0][$searchIndex+3];
			$unit = @$this->uploadedData[$index][0][$searchIndex+4];
		}elseif($totalRows == 1 && $this->uploadedData[$index][0][1] == 3){
			$name = @$this->uploadedData[$index][0][$searchIndex+1];//second line
			//$type = @$this->uploadedData[$searchIndex][0][$searchIndex+2];
			$passFail = @$this->uploadedData[$index][0][$searchIndex+2];
			//$value = @$this->uploadedData[$searchIndex][0][$searchIndex+3];
			//$unit = @$this->uploadedData[$searchIndex][0][$searchIndex+4];
		}else if($totalRows == 1 && $this->uploadedData[$index][0][1] == 1){
			//$name = @$this->uploadedData[$searchIndex][1][$searchIndex+1];//second line
			$type = @$this->uploadedData[$index][0][$searchIndex+2];
			//$passFail = @$this->uploadedData[$searchIndex][1][$searchIndex+2];
			$value = @$this->uploadedData[$index][0][$searchIndex+3];
			$unit = @$this->uploadedData[$index][0][$searchIndex+4];
		}
		
		return array('name'=>$name,'passFail'=>$passFail,'value'=>$value,'unit'=>$unit,'type'=>$type);
	}
	public function getAllTestData($index){
		$temp = array();
		$total = $this->getTotalTest($index);
		for($i = 0; $i < $total; $i++){
			$temp[] = $this->getTestDetail($index, $i);
		}//for
		return $temp;
	}
}

?>