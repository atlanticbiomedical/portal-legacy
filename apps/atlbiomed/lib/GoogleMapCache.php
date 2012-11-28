<?php
class GoogleMapCache{
	public function __construct(){
		
	}
	
	//get the cordinate of the client. if its not in there add it
	public function getCordinateCache($id){
		
		if(empty($id))
		 return array('lat'=>null,'lon'=> null);
		$c = new Criteria;
		$c->add(CordinatesPeer::CLIENT_ID, $id); 
		$cordCache = CordinatesPeer::doSelect($c);

		if($cordCache){
			return array('lat'=>$cordCache[0]->getLat(),'lon'=> $cordCache[0]->getLon());
		}
		
		$client1 = ClientPeer::retrieveByPk($id);
		$address = $client1->getAddress().' '.$client1->getCity().' '.$client1->getState().' '.$client1->getZip();
		
		$map = new GoogleMapAPI('map'); 
		$map->setAPIKey('ABQIAAAAbu56iy-6LS_GeUSAnMXHPxQYy8GCRil3btyRMCq9tZ8qFFyM6RT30TkD-cPNxYzl_SZslQgaOgpnFQ');
		$geodata = $map->getGeocode($address);
		 
		$cord = new Cordinates($id);
		($geodata) ? $cord->setFound(1) : $cord->setFound(0);
		$cord->setClientId($id);
		$cord->setLat($geodata['lat']);
		$cord->setLon($geodata['lon']);
		$cord->save();
		
		return array('lat'=>$cord->getLat(),'lon'=> $cord->getLon());
	}

	//update the latitude, longitude cordinate for the client
	public function updateCordinateCache($id){
		
		$client1 = ClientPeer::retrieveByPk($id);
		
		if(!$client1)
		   return false;
		
		$address = $client1->getAddress().' '.$client1->getCity().' '.$client1->getState().' '.$client1->getZip();
		
		if(!empty($address)){
			$map = new GoogleMapAPI('map');
			$map->setAPIKey('ABQIAAAAbu56iy-6LS_GeUSAnMXHPxQYy8GCRil3btyRMCq9tZ8qFFyM6RT30TkD-cPNxYzl_SZslQgaOgpnFQ');
			$geodata = $map->getGeocode($address);
			
			//save the cordinate for the new client
			$cord = new Cordinates();
			($geodata) ? $cord->setFound(1) : $cord->setFound(0);
			$cord->setClientId($id);
			$cord->setLat($geodata['lat']);
			$cord->setLon($geodata['lon']);
			$cord->save();
			
			//indicate that we've already updated the client
			$client1->setRequireCoordsUpdate(0);
			$client1->save();
			return true;
		}
	}
	
	//update the driving information for the client to all other clients
	//if overide = false dont update, only insert records if it doesn't exist
	public function updateCacheById($id, $overide = true){
		if(empty($id)) return false;
		
		$c = new Criteria();
		$clients = ClientPeer::doSelect($c);
		if(!$clients)
		  return;
		
		 $connection = Propel::getConnection();
		  
		foreach($clients as $client){
			$thisClientId = $client->getId();
			if($thisClientId == $id) continue;
			
			$query = "SELECT * FROM distances WHERE (client_id_1 = $id and client_id_2 = $thisClientId) or (client_id_2 = $id and client_id_1 = $thisClientId)";
			$statement = $connection->prepareStatement($query);
			$result = $statement->executeQuery();
			
			$dataFound = $result->next();
			//overide equals true we want to replace data
 
			if( $dataFound and $overide == true){
				//$hrs = 0; $min = 0; $distance = 0;
				$drivingInfo = $this->getDrivingDistanceNoCache($id,$thisClientId);
				$hrs = (int)$drivingInfo['hours'];
				$min = (int)$drivingInfo['min'];
				$distance = (int)$drivingInfo['distance'];
				
				$query = "UPDATE distances SET updated_at = NOW(), travel_time_hours = $hrs, travel_time_mins = $min, travel_distance = $distance WHERE (client_id_1 = $id and client_id_2 = $thisClientId) or (client_id_2 = $id and client_id_1 = $thisClientId)";
				
				$statement = $connection->prepareStatement($query);
			    $result = $statement->executeQuery();
				//overwrite date
			}elseif(!$dataFound){
				// $hrs =0; $min =0; $distance =0;
				$drivingInfo = $this->getDrivingDistanceNoCache($id,$thisClientId);
				$hrs = (int)$drivingInfo['hours'];
				$min = (int)$drivingInfo['min'];
				$distance = (int)$drivingInfo['distance'];
				
				$query = "INSERT INTO distances(updated_at,client_id_1, client_id_2, travel_time_hours,travel_time_mins,travel_distance) VALUE(NOW(),$id,$thisClientId,$hrs,$min,$distance)";
				 
				$statement = $connection->prepareStatement($query);
			    $result = $statement->executeQuery();
				//insert new record
			}
			
		}//if
	}//public

	public function updateTechDistanceCacheById($id, $overide = true){
		if(empty($id)) return false;
		
		$c = new Criteria();
		$clients = ClientPeer::doSelect($c);
		if(!$clients)
		  return;
		
		 $connection = Propel::getConnection();
		  
		foreach($clients as $client){
			$thisClientId = $client->getId();
			
			
			$query = "SELECT * FROM tech_distances WHERE (tech_id = $id and client_id = $thisClientId)";
			$statement = $connection->prepareStatement($query);
			$result = $statement->executeQuery();
			
			$dataFound = $result->next();
			//overide equals true we want to replace data
 
			if( $dataFound and $overide == true){
				//$hrs = 0; $min = 0; $distance = 0;
				$drivingInfo = $this->getDrivingDistanceNoCache($id,$thisClientId,true);  //true means tech to client NOT client to client
				$hrs = (int)$drivingInfo['hours'];
				$min = (int)$drivingInfo['min'];
				$distance = (int)$drivingInfo['distance'];
				
				$query = "UPDATE tech_distances SET updated_at = NOW(), travel_time_hours = $hrs, travel_time_mins = $min, travel_distance = $distance WHERE (tech_id = $id and client_id = $thisClientId)";
				
				$statement = $connection->prepareStatement($query);
			    $result = $statement->executeQuery();
				//overwrite date
			}elseif(!$dataFound){
				// $hrs =0; $min =0; $distance =0;
				$drivingInfo = $this->getDrivingDistanceNoCache($id,$thisClientId,true); //true means tech to client NOT client to client
				$hrs = (int)$drivingInfo['hours'];
				$min = (int)$drivingInfo['min'];
				$distance = (int)$drivingInfo['distance'];
				
				$query = "INSERT INTO tech_distances(updated_at,tech_id, client_id, travel_time_hours,travel_time_mins,travel_distance) VALUE(NOW(),$id,$thisClientId,$hrs,$min,$distance)";
				 
				$statement = $connection->prepareStatement($query);
			    $result = $statement->executeQuery();
				//insert new record
			}
			
		}//if
	}//public
		
	
public function getDrivingDistanceCache($id1,$id2, $forTech = false){
	
		if(empty($id1) || empty($id2)) 
	             return array('hours'=>0, 'min'=>0, 'distance'=>0);
		
	           
		$connection = Propel::getConnection();
		
		if(!$forTech){//checking cache for client to client
			$query = "SELECT * FROM distances WHERE (client_id_1 = $id1 and client_id_2 = $id2 )
			                                     or (client_id_2 = $id1 and client_id_1 = $id2)";
			$statement = $connection->prepareStatement($query);
			$result = $statement->executeQuery();
			while($result->next()){
				$hours = $result->getInt('travel_time_hours');
				$mins = $result->getInt("travel_time_mins");
				$travelDistance = (float)$result->get("travel_distance");
				 
				return array('hours'=>$hours, 'min'=>$mins, 'distance'=>$travelDistance);
			}
			
			$client1 = ClientPeer::retrieveByPk($id1);
			$client2 = ClientPeer::retrieveByPk($id2);
	
			$address1 = ($client1) ? $client1->getFullAddress() : '';
			$address2 = ($client2) ? $client2->getFullAddress() : '';
			
			$drivingT = $this->getDrivingDistance($address1, $address2);
			
			$distance = new Distances();
			$distance->setClientId1($id1);
			$distance->setClientId2($id2);
			$distance->setTravelTimeHours($drivingT['hours']);
			$distance->setTravelTimeMins($drivingT['min']);
			$distance->setTravelDistance($drivingT['distance']);
			$distance->save();
		}else{ //checking cache for tech to client
			$query = "SELECT * FROM tech_distances WHERE (tech_id = $id1 and client_id = $id2 )";
			$statement = $connection->prepareStatement($query);
			$result = $statement->executeQuery();
			while($result->next()){
				$hours = $result->getInt('travel_time_hours');
				$mins = $result->getInt("travel_time_mins");
				$travelDistance = (float)$result->get("travel_distance");
				 
				return array('hours'=>$hours, 'min'=>$mins, 'distance'=>$travelDistance);
			}
			
			$user = UserPeer::retrieveByPk($id1);
			$client = ClientPeer::retrieveByPk($id2);
	
			$address1 = ($user) ? $user->getFullAddress() : '';
			$address2 = ($client) ? $client->getFullAddress() : '';
			
			$drivingT = $this->getDrivingDistance($address1, $address2);
			
			$distance = new TechDistances();
			$distance->setTechId($id1);
			$distance->setClientId($id2);
			$distance->setTravelTimeHours($drivingT['hours']);
			$distance->setTravelTimeMins($drivingT['min']);
			$distance->setTravelDistance($drivingT['distance']);
			$distance->save();
		}
		return array('hours'=>$drivingT['hours'],'min'=>$drivingT['min'],'distance'=>$drivingT['distance']);
	}
	
	// return the driving time and distances between the 2 clients skip cache
	public function getDrivingDistanceNoCache($id1,$id2, $forTech = false){

		//client to client
		if(!$forTech){
			$client1 = ClientPeer::retrieveByPk($id1);
			$client2 = ClientPeer::retrieveByPk($id2);
	
			$address1 = ($client1) ? $client1->getFullAddress() : '';
			$address2 = ($client2) ? $client2->getFullAddress() : '';
		}else{
			$tech = UserPeer::retrieveByPk($id1);
			$client = ClientPeer::retrieveByPk($id2);
	
			$address1 = ($tech) ? $tech->getFullAddress() : '';
			$address2 = ($client) ? $client->getFullAddress() : '';
			
		}
		
		$drivingT = $this->getDrivingDistance($address1, $address2);
		

		
		return array('hours'=>$drivingT['hours'],'min'=>$drivingT['min'],'distance'=>$drivingT['distance']);
	}
	
	// get driving time and distances base on address
	public function getDrivingDistance($address1,$address2){
		
		$a = urlencode($address1);
		$b = urlencode($address2);
		 
		 
		$url = "http://maps.google.com/maps";
		$query = "q=from+$a+to+$b&output=kml";
		$full_url= $url."?".$query;
				
		
		$fp = fopen($full_url,'r');
		while($data = fread(($fp),1024)){
		    $kml .= $data;
		}
//Commented this out second. Everything seems to be working again. 
//I commented out a section in apps/atlbiomed/modules/scheduler/actions/actions.class.php 
//and then got the second line in this section as broken. Commenting out the entire section
//fixed everything.
// -Chris
 /*		if(!empty($kml)){
			$xml_object = new SimpleXMLElement($kml);
			$totalPlacemark = count($xml_object->Document->Placemark);
			$lastPlacemark = $xml_object->Document->Placemark[$totalPlacemark-1];
			
			$distance_info = split ('mi', $lastPlacemark->description[0]);
			$mileage = (float)str_replace('Distance: ','',$distance_info[0]);
			$time_str = str_replace('(about','',$distance_info[1]);
			$time_str = str_replace('hours','hour',$time_str);
			$hourTextPos = strrpos($time_str, "hour");
			
			$time_arr = explode('hour', $time_str);
			
			if($hourTextPos!==false){
				$hours = (int)$time_arr[0];
				$min= (int)$time_arr[1];
			}
			else{ 
				$hours = 0;
			    $min = (int)$time_arr[0];
			}
		}//if
*/		
 
		return array('hours'=>$hours,'min'=>$min,'distance'=>$mileage);
	}
}
 ?>
