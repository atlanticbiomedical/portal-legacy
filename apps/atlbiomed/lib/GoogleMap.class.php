<?php 

/**
 * Represents a Google Map.  A simple wrapper over the api.
 *
 * @author Ciphent
 **/
class GoogleMap
{
	var $map;

	public function GoogleMap($mapId)
	{
		$this->map = new GoogleMapAPI($mapId);
		
    	$this->map->setAPIKey(sfConfig::get('app_google_maps_api_key'));
		$this->map->disableDirections();
		$this->map->enableSidebar();
	}
	
	public function includeDefaultLocation()
	{
	    /*
		$this->map->addMarkerByAddress(sfConfig::get('app_default_map_location'),
									   sfConfig::get('app_default_map_location_title'),
									   '<h2>' . sfConfig::get('app_default_map_location_title') . '</h2>'
		);
									   
		$this->map->addMarkerIcon(sfConfig::get('app_site_images_url') . 'pin_blue.png',
								  sfConfig::get('app_site_images_url') . 'pin_shadow_big.png', 10, 35, 10, 10);	
		*/
		// support for chaining
		return $this;
	}
	
	public function setWidth($width)
	{
		$this->map->setWidth($width);
		
		// support for chaining
		return $this;
	}

	public function setHeight($height)
	{
		$this->map->setHeight($height);
		
		// support for chaining
		return $this;
	}
		
	public function getMapJS()
	{
		return $this->map->printHeaderJS() . ' ' . $this->map->printMapJS();
	}
	
	public function getMapHtml()
	{
		return $this->map->printMap();
	}
	
	public function addMarkers($markers)
	{
    	// create some map markers
    	foreach($markers as $mapMarker)
    	{
    		$this->addMarker($mapMarker);
    	}
    	
    	// support for chaining
    	return $this;
	}
	
	public function addMarker($mapMarker)
	{
        static $cc = 0;
        $cc++;
        
   
		$distance = $this->map->geoGetDistance(39.227088,-76.660942,$mapMarker->getLatitude(),$mapMarker->getLongitude());
		$distance = 'Distance: '.substr($distance, 0, 5).' mi (approx)';

		if ($mapMarker->hasLatLong())
		{
             
           
			$this->map->addMarkerByCoords($mapMarker->getLongitude(), 
										  $mapMarker->getLatitude(), 
										  $mapMarker->getTitle(), 
										  '<h2>' . $mapMarker->getTitle() . "</h2><br />{$mapMarker->getAddress()}<br/>" . $mapMarker->getContent());
 

		}
		else
		{
			$cord_found = $this->map->addMarkerByAddress($mapMarker->getAddress(), $mapMarker->getTitle(), 
			'<h2>' . $mapMarker->getTitle() . "</h2><br />{$mapMarker->getAddress()}<br/>" . $mapMarker->getContent());
        
            if($cord_found===false)
                return false; 
 
		}
		
	// print "$cc. ". $mapMarker->getTitle()." ".$mapMarker->getImageColor()."<br/>";
		$this->map->addMarkerIcon('/images/pins/' . 'pin_' . $mapMarker->getImageColor() . '.png',
								  '/images/' . 'pin_shadow_big.png', 10, 35, 10, 10);	

		// support for chaining
		return $this;
	}
}

?>
