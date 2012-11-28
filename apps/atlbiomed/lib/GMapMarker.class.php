<?php 

/**
 * Represents a pinpointed location on a Google Map.
 *
 * @author Ciphent
 **/
class GMapMarker
{
	var $address;
	var $title;
	var $contents;
	var $imageColor;
	var $latitude;
	var $longitude;

	public function GMapMarker($theAddress, $theLatitude, $theLongitude, $theTitle, $theContents, $theImageColor)
	{
		$this->address = $theAddress;
		
		if($theLatitude != '')
			$this->latitude = $theLatitude;
			
		if($theLongitude != '')
			$this->longitude = $theLongitude;
			
		$this->title = $theTitle;
		$this->contents = $theContents;
		$this->imageColor = $theImageColor;
	}
	
	public function hasLatLong()
	{
		return isset($this->latitude) && isset($this->longitude);
	}
	
	public function getLatitude()
	{
		return $this->latitude;
	}

	public function getLongitude()
	{
		return $this->longitude;
	}
		
	public function getAddress()
	{
		return $this->address;
	}
	
	public function getTitle()
	{
		return $this->title;
	}
	
	public function getContent()
	{
		return $this->contents;
	}
	
	public function getImageColor()
	{
		return $this->imageColor;
	}
}

?>