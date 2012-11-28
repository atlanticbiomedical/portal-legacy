<?php 

/**
 * Defines components for the map actions, namely the ability to easily print a technician
 * map.
 *
 * @author Ciphent
 **/
class mapsComponents extends sfComponents
{
	/**
	 * Displays the google map for all technicians.  You can only have one instance of this component on a page.
	 *
	 * Call it as so: include_component('maps', 'displayTechnicianMap', array('markers' => array(elements of type GMapMarer))
	 *
	 **/
	public function executeDisplayTechnicianMap()
	{
  	    $map = new GoogleMap('map');

		$map->includeDefaultLocation()->setWidth($this->mapwidth)->addMarkers($this->markers);
		$map->setHeight($this->mapheight);
    	$this->map = $map;
	}
}
