<?php

/**
 * Subclass for representing a row from the 'devices_files' table.
 *
 * 
 *
 * @package lib.model
 */ 
class DevicesFiles extends BaseDevicesFiles
{
	const save_path = 'uploads/spreadsheet';
	private $fileLoaded = false;
	private $data = null;
	
	public function setData($data){
		$this->data = $data;
	}
	public function getData(){
		return $this->data;
	}
	public function fileLoaded(){
		return $this->fileLoaded;	
	}
	public function saveToDisk(){
		$filename = $this->getFilename();
		$filepath = self::save_path."/".$filename;

		if(empty($filename)) return;

		$data = $this->data;
		$fp = fopen($filepath,'w');
		if($fp){
			if(fwrite($fp,$data)){
				chmod($filepath, 0777);			
			}
		}
	}

	public function loadFromDisk($filename){
		$filepath = self::save_path . '/'.$filename;
		$fp = fopen($filepath,'r');
		if($fp){
			$data = "";
			$data = fread($fp,filesize($filepath));
		
			$unserialize = unserialize($data);
			$this->data = $unserialize;
			$this->fileLoaded = true;
			
		}else
			$this->fileLoaded = false;
	}
}
