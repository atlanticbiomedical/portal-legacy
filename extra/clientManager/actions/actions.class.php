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

		//initialize form values
		$this->populateClient = new Client();
		$this->populateDevice = new Device();
//		$this->populateSpecification = new Specification();

		if($this->getRequestParameter('mode') == 'edit')
		{
			//retrieve client information
			$client_id = $this->getRequestParameter('id');
			$this->client_id = $client_id;
			$this->populateClient = ClientPeer::retrieveByPk($client_id);
			$this->mode = 'edit';

			$locationId = $this->populateClient->getLocationId();

			//link devices to clients
			$c = new Criteria();
			$c->add(DevicePeer::CLIENT_ID, $client_id);
			$c->addjoin(DevicePeer::SPECIFICATION_ID, SpecificationPeer::ID, Criteria::LEFT_JOIN);
						$join = new sfPropelCustomJoinHelper('Device');
			$join->addSelectTables('Device', 'Specification');
			$join->setHas('Device', 'Specification');
			$this->populateDevice  = $join->doSelect($c); 

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

		//check for initial post
		if ($this->getRequest()->getMethod() != sfRequest::POST)
		{
			return sfView::SUCCESS;
		}
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
				$this->deviceAddUpdate($key,
								$device_info['id'], 
								$this->getRequestParameter('device_update['.$key.'][device_name]'), 
								$this->getRequestParameter('device_update['.$key.'][manufacturer]'),
								$this->getRequestParameter('device_update['.$key.'][model_number]'),
								$this->getRequestParameter('device_update['.$key.'][serial_number]'),
								$this->getRequestParameter('device_update['.$key.'][location]'),
								$this->getRequestParameter('device_update['.$key.'][frequency]'),
								$this->getRequestParameter('device_update['.$key.'][status]')
							);

		/*
				$update_device = new Device();
				$update_specification = new Specification();
	
				// Test for duplicate specification entries, based on "manufacturer" and "model_number"
				$q = new Criteria();
				$q->add(SpecificationPeer::MANUFACTURER, $this->getRequestParameter('device_update['.$key.'][manufacturer]'));
				$q->add(SpecificationPeer::MODEL_NUMBER, $this->getRequestParameter('device_update['.$key.'][model_number]'));

				$specification_count_update = SpecificationPeer::doCount($q);
			//	print_r($this->getRequestParameter('device_update'));

				?><b><?php print_r($specification_count_update) ?></b><?
				if($specification_count_update == 0)
				{
					$update_specification->setDeviceName($this->getRequestParameter('device_update['.$key.'][device_name]'));
					$update_specification->setManufacturer($this->getRequestParameter('device_update['.$key.'][manufacturer]'));
					$update_specification->setModelNumber($this->getRequestParameter('device_update['.$key.'][model_number]'));
	
					$update_specification->save();
				} 

				$update_specificication = SpecificationPeer::doSelectOne($q);
			//	print_r($update_specification);
			
				$update_device = DevicePeer::retrieveByPk($key);
				$update_device->setSpecificationId($update_specification->getId());
				$update_device->setSerialNumber($this->getRequestParameter('device_update['.$key.'][serial_number]'));
				$update_device->setLocation($this->getRequestParameter('device_update['.$key.'][location]'));
				$update_device->setFrequency($this->getRequestParameter('device_update['.$key.'][frequency]'));
				$update_device->setStatus($this->getRequestParameter('device_update['.$key.'][status]'));

				if ($update_device->isModified())
				{
					$update_device->save();
				}

/*				if ($update_specification->isModified())
				{
					$update_specification->save();
				}*/
			}
		}

		//Test for blank entries in "new" entry fields
		if(!(($device_info['new_device_name'] == '') && ($device_info['new_manufacturer'] == '') && ($device_info['new_model_number'] == '') && ($device_info['new_serial_number'] == '') && ($device_info['new_frequency'] == '') && ($device_info['new_status'] == '')))
		{
				$this->deviceAddUpdate(-1,
								$device_info['id'], 
								$this->getRequestParameter('new_device_name'), 
								$this->getRequestParameter('new_manufacturer'),
								$this->getRequestParameter('new_model_number'),
								$this->getRequestParameter('new_serial_number'),
								$this->getRequestParameter('new_location'),
								$this->getRequestParameter('new_frequency'),
								$this->getRequestParameter('new_status')
							);
/*
			//Add New device					
			$device = new Device();
			$specification = new Specification();

			// Test for duplicate Specification data
			$c = new Criteria;
			$c->add(SpecificationPeer::MANUFACTURER, $device_info['new_manufacturer']);
			$c->add(SpecificationPeer::MODEL_NUMBER, $device_info['new_model_number']);
			$specification_count_new = SpecificationPeer::doCount($c);

			if($specification_count_new == 0)
			{
				//Set Specifications to database
				$specification->setDeviceName($device_info['new_device_name']);
				$specification->setManufacturer($device_info['new_manufacturer']);
				$specification->setModelNumber($device_info['new_model_number']);

				$specification->save();
			}
		
			//retrieve Specification ID
			$specification = SpecificationPeer::doSelectOne($c);

			//Test for duplicate database entries.
			$r = new Criteria();
			$r->add(DevicePeer::SPECIFICATION_ID, $specification->getId());
			$r->add(DevicePeer::SERIAL_NUMBER, $device_info['new_serial_number']);

			$duplicate_count = DevicePeer::doCount($r);

			if ($duplicate_count == 0)
			{
				//Set Device information to database
				$device->setSpecificationId($specification->getId());
				$device->setClientId($device_info['id']);
				$device->setSerialNumber($device_info['new_serial_number']);
				$device->setLocation($device_info['new_location']);
				$device->setFrequency($device_info['new_frequency']);
				$device->setStatus($device_info['new_status']);
	
				$device->save();

			}
*/		
		}

		$this->redirect('clientManager/index?mode=edit&id='.$device_info['id']);
	}

	/* This function saves our client form data to the database */
	public function executeAddClient()
	{
		// Create a client object to store parsed information
		$client = new Client();
		
		if ($this->getRequestParameter('mode') == 'edit')
		{
				$client_id = $this->getRequestParameter('id');
				$client = ClientPeer::retrieveByPk($client_id);
		}

		$client->setClientIdentification($this->getRequestParameter('client_identification'));
		$client->setClientName($this->getRequestParameter('client_name'));
		$client->setAddress($this->getRequestParameter('address'));
		$client->setAddress2($this->getRequestParameter('address2'));
		$client->setCity($this->getRequestParameter('city'));
		$client->setState($this->getRequestParameter('state'));
		$client->setZip($this->getRequestParameter('zip'));
		$client->setAttn($this->getRequestParameter('attn'));
		$client->setEmail($this->getRequestParameter('email'));
		$client->setPhone($this->getRequestParameter('phone'));
		$client->setExt($this->getRequestParameter('ext'));
		$client->setCategory($this->getRequestParameter('category'));
		$client->setNotes($this->getRequestParameter('notes'));

		if ($client->isModified())
		{	
			$client->save();
		}


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

		$this->redirect('clientManager/index?mode=edit&id='.$client_id);
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

	private function deviceAddUpdate($device_id, $client_id, $device_name, $manufacturer, $model_number, $serial_number, $location, $frequency, $status)
	{
			//Add New device					
			$device = new Device();
			$specification = new Specification();

			// Test for duplicate Specification data
			$c = new Criteria;
			$c->add(SpecificationPeer::MANUFACTURER, $manufacturer);
			$c->add(SpecificationPeer::MODEL_NUMBER, $model_number);
			$specification_count_new = SpecificationPeer::doCount($c);
//			print_r($specification_count_new);

/*			if( !($specification = SpecificationPeer::doSelectOne($c)) )
			{
				$specification = new Specification();
				//Set Specifications to database
				$specification->setDeviceName($device_name);
				$specification->setManufacturer($manufacturer);
				$specification->setModelNumber($model_number);

				$specification->save();
			} */

			//If the specification doesn't exist already create it
			if($specification_count_new == 0)
			{
				//Set Specifications to database
				$specification->setDeviceName($device_name);
				$specification->setManufacturer($manufacturer);
				$specification->setModelNumber($model_number);

				$specification->save();
			}
		
			//retrieve Specification ID
			$specification = SpecificationPeer::doSelectOne($c);
//			print_r($specification);

			echo "<h1> ".$specification->getId()."</h1>";
			//Test for duplicate database entries.
			$r = new Criteria();
			$r->add(DevicePeer::SPECIFICATION_ID, $specification->getId());
			$r->add(DevicePeer::SERIAL_NUMBER, $serial_number);

			$duplicate_count = DevicePeer::doCount($r);

/*			// If true this entry is already in the database
			if ($duplicate_count == 1)
			{
//				$device = DevicePeer::retrieveByPk($device_id);
				if( $device_id < 0 ) // This is a new entry and it is a duplicate this is an error
				{
					/// PRINTER ERROR FOR DUPLICATE NEW!!!
				}
				else // we are modifying the existing entry
				{
					$bbb = new Criteria();
					$bbb->add(DevicePeer::ID, $device_id);

					$device = DevicePeer::doSelectOne($bbb);
				}
			} */

			if ($duplicate_count == 1)
			{
				$device = DevicePeer::retrieveByPk($device_id);
			}


//			print_r($device);

			//Set Device information to database
			$device->setSpecificationId($specification->getId());
			$device->setClientId($client_id);
			$device->setSerialNumber($serial_number);
			$device->setLocation($location);
			$device->setFrequency($frequency);
			$device->setStatus($status);

			// Write any additions or modifications
			if($device->isModified())
			{
				$device->save();
			}
	}
	
	public function executeQualifications()
	{
		$this->techId = $this->getRequestParameter('techId');
	}
}
