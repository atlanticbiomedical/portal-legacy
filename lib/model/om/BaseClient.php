<?php


abstract class BaseClient extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $location_id;


	
	protected $client_identification;


	
	protected $client_name;


	
	protected $address;


	
	protected $address_2;


	
	protected $city;


	
	protected $state;


	
	protected $zip;


	
	protected $attn;


	
	protected $email;


	
	protected $phone;


	
	protected $ext;


	
	protected $category;


	
	protected $notes;


	
	protected $all_devices;


	
	protected $freq_approved = 0;


	
	protected $freq_locked = 0;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $frequency;


	
	protected $frequency_annual;


	
	protected $frequency_semi;


	
	protected $frequency_quarterly;


	
	protected $frequency_sterilizer;


	
	protected $frequency_tg;


	
	protected $frequency_ert;


	
	protected $frequency_rae;


	
	protected $frequency_medgas;


	
	protected $frequency_imaging;


	
	protected $frequency_neptune;


	
	protected $frequency_anesthesia;


	
	protected $anesthesia;


	
	protected $medgas;


	
	protected $require_coords_update = 1;


	
	protected $addresstype = 1;


	
	protected $secondary_address = 'null';


	
	protected $secondary_address_2 = 'null';


	
	protected $secondary_city = 'null';


	
	protected $secondary_state = 'null';


	
	protected $secondary_zip = 'null';


	
	protected $secondary_attn = 'null';

	
	protected $aLocation;

	
	protected $collDevices;

	
	protected $lastDeviceCriteria = null;

	
	protected $collDeviceCheckups;

	
	protected $lastDeviceCheckupCriteria = null;

	
	protected $collWorkorders;

	
	protected $lastWorkorderCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getLocationId()
	{

		return $this->location_id;
	}

	
	public function getClientIdentification()
	{

		return $this->client_identification;
	}

	
	public function getClientName()
	{

		return $this->client_name;
	}

	
	public function getAddress()
	{

		return $this->address;
	}

	
	public function getAddress2()
	{

		return $this->address_2;
	}

	
	public function getCity()
	{

		return $this->city;
	}

	
	public function getState()
	{

		return $this->state;
	}

	
	public function getZip()
	{

		return $this->zip;
	}

	
	public function getAttn()
	{

		return $this->attn;
	}

	
	public function getEmail()
	{

		return $this->email;
	}

	
	public function getPhone()
	{

		return $this->phone;
	}

	
	public function getExt()
	{

		return $this->ext;
	}

	
	public function getCategory()
	{

		return $this->category;
	}

	
	public function getNotes()
	{

		return $this->notes;
	}

	
	public function getAllDevices()
	{

		return $this->all_devices;
	}

	
	public function getFreqApproved()
	{

		return $this->freq_approved;
	}

	
	public function getFreqLocked()
	{

		return $this->freq_locked;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getFrequency()
	{

		return $this->frequency;
	}

	
	public function getFrequencyAnnual()
	{

		return $this->frequency_annual;
	}

	
	public function getFrequencySemi()
	{

		return $this->frequency_semi;
	}

	
	public function getFrequencyQuarterly()
	{

		return $this->frequency_quarterly;
	}

	
	public function getFrequencySterilizer()
	{

		return $this->frequency_sterilizer;
	}

	
	public function getFrequencyTg()
	{

		return $this->frequency_tg;
	}

	
	public function getFrequencyErt()
	{

		return $this->frequency_ert;
	}

	
	public function getFrequencyRae()
	{

		return $this->frequency_rae;
	}

	
	public function getFrequencyMedgas()
	{

		return $this->frequency_medgas;
	}

	
	public function getFrequencyImaging()
	{

		return $this->frequency_imaging;
	}

	
	public function getFrequencyNeptune()
	{

		return $this->frequency_neptune;
	}

	
	public function getFrequencyAnesthesia()
	{

		return $this->frequency_anesthesia;
	}

	
	public function getAnesthesia()
	{

		return $this->anesthesia;
	}

	
	public function getMedgas()
	{

		return $this->medgas;
	}

	
	public function getRequireCoordsUpdate()
	{

		return $this->require_coords_update;
	}

	
	public function getAddresstype()
	{

		return $this->addresstype;
	}

	
	public function getSecondaryAddress()
	{

		return $this->secondary_address;
	}

	
	public function getSecondaryAddress2()
	{

		return $this->secondary_address_2;
	}

	
	public function getSecondaryCity()
	{

		return $this->secondary_city;
	}

	
	public function getSecondaryState()
	{

		return $this->secondary_state;
	}

	
	public function getSecondaryZip()
	{

		return $this->secondary_zip;
	}

	
	public function getSecondaryAttn()
	{

		return $this->secondary_attn;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ClientPeer::ID;
		}

	} 
	
	public function setLocationId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->location_id !== $v) {
			$this->location_id = $v;
			$this->modifiedColumns[] = ClientPeer::LOCATION_ID;
		}

		if ($this->aLocation !== null && $this->aLocation->getId() !== $v) {
			$this->aLocation = null;
		}

	} 
	
	public function setClientIdentification($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->client_identification !== $v) {
			$this->client_identification = $v;
			$this->modifiedColumns[] = ClientPeer::CLIENT_IDENTIFICATION;
		}

	} 
	
	public function setClientName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->client_name !== $v) {
			$this->client_name = $v;
			$this->modifiedColumns[] = ClientPeer::CLIENT_NAME;
		}

	} 
	
	public function setAddress($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address !== $v) {
			$this->address = $v;
			$this->modifiedColumns[] = ClientPeer::ADDRESS;
		}

	} 
	
	public function setAddress2($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address_2 !== $v) {
			$this->address_2 = $v;
			$this->modifiedColumns[] = ClientPeer::ADDRESS_2;
		}

	} 
	
	public function setCity($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->city !== $v) {
			$this->city = $v;
			$this->modifiedColumns[] = ClientPeer::CITY;
		}

	} 
	
	public function setState($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->state !== $v) {
			$this->state = $v;
			$this->modifiedColumns[] = ClientPeer::STATE;
		}

	} 
	
	public function setZip($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->zip !== $v) {
			$this->zip = $v;
			$this->modifiedColumns[] = ClientPeer::ZIP;
		}

	} 
	
	public function setAttn($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->attn !== $v) {
			$this->attn = $v;
			$this->modifiedColumns[] = ClientPeer::ATTN;
		}

	} 
	
	public function setEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = ClientPeer::EMAIL;
		}

	} 
	
	public function setPhone($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->phone !== $v) {
			$this->phone = $v;
			$this->modifiedColumns[] = ClientPeer::PHONE;
		}

	} 
	
	public function setExt($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ext !== $v) {
			$this->ext = $v;
			$this->modifiedColumns[] = ClientPeer::EXT;
		}

	} 
	
	public function setCategory($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->category !== $v) {
			$this->category = $v;
			$this->modifiedColumns[] = ClientPeer::CATEGORY;
		}

	} 
	
	public function setNotes($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->notes !== $v) {
			$this->notes = $v;
			$this->modifiedColumns[] = ClientPeer::NOTES;
		}

	} 
	
	public function setAllDevices($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->all_devices !== $v) {
			$this->all_devices = $v;
			$this->modifiedColumns[] = ClientPeer::ALL_DEVICES;
		}

	} 
	
	public function setFreqApproved($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->freq_approved !== $v || $v === 0) {
			$this->freq_approved = $v;
			$this->modifiedColumns[] = ClientPeer::FREQ_APPROVED;
		}

	} 
	
	public function setFreqLocked($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->freq_locked !== $v || $v === 0) {
			$this->freq_locked = $v;
			$this->modifiedColumns[] = ClientPeer::FREQ_LOCKED;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = ClientPeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = ClientPeer::UPDATED_AT;
		}

	} 
	
	public function setFrequency($v)
	{

								if ($v instanceof Lob && $v === $this->frequency) {
			$changed = $v->isModified();
		} else {
			$changed = ($this->frequency !== $v);
		}
		if ($changed) {
			if ( !($v instanceof Lob) ) {
				$obj = new Clob();
				$obj->setContents($v);
			} else {
				$obj = $v;
			}
			$this->frequency = $obj;
			$this->modifiedColumns[] = ClientPeer::FREQUENCY;
		}

	} 
	
	public function setFrequencyAnnual($v)
	{

								if ($v instanceof Lob && $v === $this->frequency_annual) {
			$changed = $v->isModified();
		} else {
			$changed = ($this->frequency_annual !== $v);
		}
		if ($changed) {
			if ( !($v instanceof Lob) ) {
				$obj = new Clob();
				$obj->setContents($v);
			} else {
				$obj = $v;
			}
			$this->frequency_annual = $obj;
			$this->modifiedColumns[] = ClientPeer::FREQUENCY_ANNUAL;
		}

	} 
	
	public function setFrequencySemi($v)
	{

								if ($v instanceof Lob && $v === $this->frequency_semi) {
			$changed = $v->isModified();
		} else {
			$changed = ($this->frequency_semi !== $v);
		}
		if ($changed) {
			if ( !($v instanceof Lob) ) {
				$obj = new Clob();
				$obj->setContents($v);
			} else {
				$obj = $v;
			}
			$this->frequency_semi = $obj;
			$this->modifiedColumns[] = ClientPeer::FREQUENCY_SEMI;
		}

	} 
	
	public function setFrequencyQuarterly($v)
	{

								if ($v instanceof Lob && $v === $this->frequency_quarterly) {
			$changed = $v->isModified();
		} else {
			$changed = ($this->frequency_quarterly !== $v);
		}
		if ($changed) {
			if ( !($v instanceof Lob) ) {
				$obj = new Clob();
				$obj->setContents($v);
			} else {
				$obj = $v;
			}
			$this->frequency_quarterly = $obj;
			$this->modifiedColumns[] = ClientPeer::FREQUENCY_QUARTERLY;
		}

	} 
	
	public function setFrequencySterilizer($v)
	{

								if ($v instanceof Lob && $v === $this->frequency_sterilizer) {
			$changed = $v->isModified();
		} else {
			$changed = ($this->frequency_sterilizer !== $v);
		}
		if ($changed) {
			if ( !($v instanceof Lob) ) {
				$obj = new Clob();
				$obj->setContents($v);
			} else {
				$obj = $v;
			}
			$this->frequency_sterilizer = $obj;
			$this->modifiedColumns[] = ClientPeer::FREQUENCY_STERILIZER;
		}

	} 
	
	public function setFrequencyTg($v)
	{

								if ($v instanceof Lob && $v === $this->frequency_tg) {
			$changed = $v->isModified();
		} else {
			$changed = ($this->frequency_tg !== $v);
		}
		if ($changed) {
			if ( !($v instanceof Lob) ) {
				$obj = new Clob();
				$obj->setContents($v);
			} else {
				$obj = $v;
			}
			$this->frequency_tg = $obj;
			$this->modifiedColumns[] = ClientPeer::FREQUENCY_TG;
		}

	} 
	
	public function setFrequencyErt($v)
	{

								if ($v instanceof Lob && $v === $this->frequency_ert) {
			$changed = $v->isModified();
		} else {
			$changed = ($this->frequency_ert !== $v);
		}
		if ($changed) {
			if ( !($v instanceof Lob) ) {
				$obj = new Clob();
				$obj->setContents($v);
			} else {
				$obj = $v;
			}
			$this->frequency_ert = $obj;
			$this->modifiedColumns[] = ClientPeer::FREQUENCY_ERT;
		}

	} 
	
	public function setFrequencyRae($v)
	{

								if ($v instanceof Lob && $v === $this->frequency_rae) {
			$changed = $v->isModified();
		} else {
			$changed = ($this->frequency_rae !== $v);
		}
		if ($changed) {
			if ( !($v instanceof Lob) ) {
				$obj = new Clob();
				$obj->setContents($v);
			} else {
				$obj = $v;
			}
			$this->frequency_rae = $obj;
			$this->modifiedColumns[] = ClientPeer::FREQUENCY_RAE;
		}

	} 
	
	public function setFrequencyMedgas($v)
	{

								if ($v instanceof Lob && $v === $this->frequency_medgas) {
			$changed = $v->isModified();
		} else {
			$changed = ($this->frequency_medgas !== $v);
		}
		if ($changed) {
			if ( !($v instanceof Lob) ) {
				$obj = new Clob();
				$obj->setContents($v);
			} else {
				$obj = $v;
			}
			$this->frequency_medgas = $obj;
			$this->modifiedColumns[] = ClientPeer::FREQUENCY_MEDGAS;
		}

	} 
	
	public function setFrequencyImaging($v)
	{

								if ($v instanceof Lob && $v === $this->frequency_imaging) {
			$changed = $v->isModified();
		} else {
			$changed = ($this->frequency_imaging !== $v);
		}
		if ($changed) {
			if ( !($v instanceof Lob) ) {
				$obj = new Clob();
				$obj->setContents($v);
			} else {
				$obj = $v;
			}
			$this->frequency_imaging = $obj;
			$this->modifiedColumns[] = ClientPeer::FREQUENCY_IMAGING;
		}

	} 
	
	public function setFrequencyNeptune($v)
	{

								if ($v instanceof Lob && $v === $this->frequency_neptune) {
			$changed = $v->isModified();
		} else {
			$changed = ($this->frequency_neptune !== $v);
		}
		if ($changed) {
			if ( !($v instanceof Lob) ) {
				$obj = new Clob();
				$obj->setContents($v);
			} else {
				$obj = $v;
			}
			$this->frequency_neptune = $obj;
			$this->modifiedColumns[] = ClientPeer::FREQUENCY_NEPTUNE;
		}

	} 
	
	public function setFrequencyAnesthesia($v)
	{

								if ($v instanceof Lob && $v === $this->frequency_anesthesia) {
			$changed = $v->isModified();
		} else {
			$changed = ($this->frequency_anesthesia !== $v);
		}
		if ($changed) {
			if ( !($v instanceof Lob) ) {
				$obj = new Clob();
				$obj->setContents($v);
			} else {
				$obj = $v;
			}
			$this->frequency_anesthesia = $obj;
			$this->modifiedColumns[] = ClientPeer::FREQUENCY_ANESTHESIA;
		}

	} 
	
	public function setAnesthesia($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->anesthesia !== $v) {
			$this->anesthesia = $v;
			$this->modifiedColumns[] = ClientPeer::ANESTHESIA;
		}

	} 
	
	public function setMedgas($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->medgas !== $v) {
			$this->medgas = $v;
			$this->modifiedColumns[] = ClientPeer::MEDGAS;
		}

	} 
	
	public function setRequireCoordsUpdate($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->require_coords_update !== $v || $v === 1) {
			$this->require_coords_update = $v;
			$this->modifiedColumns[] = ClientPeer::REQUIRE_COORDS_UPDATE;
		}

	} 
	
	public function setAddresstype($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->addresstype !== $v || $v === 1) {
			$this->addresstype = $v;
			$this->modifiedColumns[] = ClientPeer::ADDRESSTYPE;
		}

	} 
	
	public function setSecondaryAddress($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->secondary_address !== $v || $v === 'null') {
			$this->secondary_address = $v;
			$this->modifiedColumns[] = ClientPeer::SECONDARY_ADDRESS;
		}

	} 
	
	public function setSecondaryAddress2($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->secondary_address_2 !== $v || $v === 'null') {
			$this->secondary_address_2 = $v;
			$this->modifiedColumns[] = ClientPeer::SECONDARY_ADDRESS_2;
		}

	} 
	
	public function setSecondaryCity($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->secondary_city !== $v || $v === 'null') {
			$this->secondary_city = $v;
			$this->modifiedColumns[] = ClientPeer::SECONDARY_CITY;
		}

	} 
	
	public function setSecondaryState($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->secondary_state !== $v || $v === 'null') {
			$this->secondary_state = $v;
			$this->modifiedColumns[] = ClientPeer::SECONDARY_STATE;
		}

	} 
	
	public function setSecondaryZip($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->secondary_zip !== $v || $v === 'null') {
			$this->secondary_zip = $v;
			$this->modifiedColumns[] = ClientPeer::SECONDARY_ZIP;
		}

	} 
	
	public function setSecondaryAttn($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->secondary_attn !== $v || $v === 'null') {
			$this->secondary_attn = $v;
			$this->modifiedColumns[] = ClientPeer::SECONDARY_ATTN;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->location_id = $rs->getInt($startcol + 1);

			$this->client_identification = $rs->getString($startcol + 2);

			$this->client_name = $rs->getString($startcol + 3);

			$this->address = $rs->getString($startcol + 4);

			$this->address_2 = $rs->getString($startcol + 5);

			$this->city = $rs->getString($startcol + 6);

			$this->state = $rs->getString($startcol + 7);

			$this->zip = $rs->getString($startcol + 8);

			$this->attn = $rs->getString($startcol + 9);

			$this->email = $rs->getString($startcol + 10);

			$this->phone = $rs->getString($startcol + 11);

			$this->ext = $rs->getString($startcol + 12);

			$this->category = $rs->getString($startcol + 13);

			$this->notes = $rs->getString($startcol + 14);

			$this->all_devices = $rs->getInt($startcol + 15);

			$this->freq_approved = $rs->getInt($startcol + 16);

			$this->freq_locked = $rs->getInt($startcol + 17);

			$this->created_at = $rs->getTimestamp($startcol + 18, null);

			$this->updated_at = $rs->getTimestamp($startcol + 19, null);

			$this->frequency = $rs->getBlob($startcol + 20);

			$this->frequency_annual = $rs->getBlob($startcol + 21);

			$this->frequency_semi = $rs->getBlob($startcol + 22);

			$this->frequency_quarterly = $rs->getBlob($startcol + 23);

			$this->frequency_sterilizer = $rs->getBlob($startcol + 24);

			$this->frequency_tg = $rs->getBlob($startcol + 25);

			$this->frequency_ert = $rs->getBlob($startcol + 26);

			$this->frequency_rae = $rs->getBlob($startcol + 27);

			$this->frequency_medgas = $rs->getBlob($startcol + 28);

			$this->frequency_imaging = $rs->getBlob($startcol + 29);

			$this->frequency_neptune = $rs->getBlob($startcol + 30);

			$this->frequency_anesthesia = $rs->getBlob($startcol + 31);

			$this->anesthesia = $rs->getString($startcol + 32);

			$this->medgas = $rs->getString($startcol + 33);

			$this->require_coords_update = $rs->getInt($startcol + 34);

			$this->addresstype = $rs->getInt($startcol + 35);

			$this->secondary_address = $rs->getString($startcol + 36);

			$this->secondary_address_2 = $rs->getString($startcol + 37);

			$this->secondary_city = $rs->getString($startcol + 38);

			$this->secondary_state = $rs->getString($startcol + 39);

			$this->secondary_zip = $rs->getString($startcol + 40);

			$this->secondary_attn = $rs->getString($startcol + 41);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 42; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Client object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ClientPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ClientPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ClientPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ClientPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ClientPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aLocation !== null) {
				if ($this->aLocation->isModified()) {
					$affectedRows += $this->aLocation->save($con);
				}
				$this->setLocation($this->aLocation);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ClientPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ClientPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collDevices !== null) {
				foreach($this->collDevices as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDeviceCheckups !== null) {
				foreach($this->collDeviceCheckups as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collWorkorders !== null) {
				foreach($this->collWorkorders as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aLocation !== null) {
				if (!$this->aLocation->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aLocation->getValidationFailures());
				}
			}


			if (($retval = ClientPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDevices !== null) {
					foreach($this->collDevices as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDeviceCheckups !== null) {
					foreach($this->collDeviceCheckups as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWorkorders !== null) {
					foreach($this->collWorkorders as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ClientPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getLocationId();
				break;
			case 2:
				return $this->getClientIdentification();
				break;
			case 3:
				return $this->getClientName();
				break;
			case 4:
				return $this->getAddress();
				break;
			case 5:
				return $this->getAddress2();
				break;
			case 6:
				return $this->getCity();
				break;
			case 7:
				return $this->getState();
				break;
			case 8:
				return $this->getZip();
				break;
			case 9:
				return $this->getAttn();
				break;
			case 10:
				return $this->getEmail();
				break;
			case 11:
				return $this->getPhone();
				break;
			case 12:
				return $this->getExt();
				break;
			case 13:
				return $this->getCategory();
				break;
			case 14:
				return $this->getNotes();
				break;
			case 15:
				return $this->getAllDevices();
				break;
			case 16:
				return $this->getFreqApproved();
				break;
			case 17:
				return $this->getFreqLocked();
				break;
			case 18:
				return $this->getCreatedAt();
				break;
			case 19:
				return $this->getUpdatedAt();
				break;
			case 20:
				return $this->getFrequency();
				break;
			case 21:
				return $this->getFrequencyAnnual();
				break;
			case 22:
				return $this->getFrequencySemi();
				break;
			case 23:
				return $this->getFrequencyQuarterly();
				break;
			case 24:
				return $this->getFrequencySterilizer();
				break;
			case 25:
				return $this->getFrequencyTg();
				break;
			case 26:
				return $this->getFrequencyErt();
				break;
			case 27:
				return $this->getFrequencyRae();
				break;
			case 28:
				return $this->getFrequencyMedgas();
				break;
			case 29:
				return $this->getFrequencyImaging();
				break;
			case 30:
				return $this->getFrequencyNeptune();
				break;
			case 31:
				return $this->getFrequencyAnesthesia();
				break;
			case 32:
				return $this->getAnesthesia();
				break;
			case 33:
				return $this->getMedgas();
				break;
			case 34:
				return $this->getRequireCoordsUpdate();
				break;
			case 35:
				return $this->getAddresstype();
				break;
			case 36:
				return $this->getSecondaryAddress();
				break;
			case 37:
				return $this->getSecondaryAddress2();
				break;
			case 38:
				return $this->getSecondaryCity();
				break;
			case 39:
				return $this->getSecondaryState();
				break;
			case 40:
				return $this->getSecondaryZip();
				break;
			case 41:
				return $this->getSecondaryAttn();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ClientPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getLocationId(),
			$keys[2] => $this->getClientIdentification(),
			$keys[3] => $this->getClientName(),
			$keys[4] => $this->getAddress(),
			$keys[5] => $this->getAddress2(),
			$keys[6] => $this->getCity(),
			$keys[7] => $this->getState(),
			$keys[8] => $this->getZip(),
			$keys[9] => $this->getAttn(),
			$keys[10] => $this->getEmail(),
			$keys[11] => $this->getPhone(),
			$keys[12] => $this->getExt(),
			$keys[13] => $this->getCategory(),
			$keys[14] => $this->getNotes(),
			$keys[15] => $this->getAllDevices(),
			$keys[16] => $this->getFreqApproved(),
			$keys[17] => $this->getFreqLocked(),
			$keys[18] => $this->getCreatedAt(),
			$keys[19] => $this->getUpdatedAt(),
			$keys[20] => $this->getFrequency(),
			$keys[21] => $this->getFrequencyAnnual(),
			$keys[22] => $this->getFrequencySemi(),
			$keys[23] => $this->getFrequencyQuarterly(),
			$keys[24] => $this->getFrequencySterilizer(),
			$keys[25] => $this->getFrequencyTg(),
			$keys[26] => $this->getFrequencyErt(),
			$keys[27] => $this->getFrequencyRae(),
			$keys[28] => $this->getFrequencyMedgas(),
			$keys[29] => $this->getFrequencyImaging(),
			$keys[30] => $this->getFrequencyNeptune(),
			$keys[31] => $this->getFrequencyAnesthesia(),
			$keys[32] => $this->getAnesthesia(),
			$keys[33] => $this->getMedgas(),
			$keys[34] => $this->getRequireCoordsUpdate(),
			$keys[35] => $this->getAddresstype(),
			$keys[36] => $this->getSecondaryAddress(),
			$keys[37] => $this->getSecondaryAddress2(),
			$keys[38] => $this->getSecondaryCity(),
			$keys[39] => $this->getSecondaryState(),
			$keys[40] => $this->getSecondaryZip(),
			$keys[41] => $this->getSecondaryAttn(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ClientPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setLocationId($value);
				break;
			case 2:
				$this->setClientIdentification($value);
				break;
			case 3:
				$this->setClientName($value);
				break;
			case 4:
				$this->setAddress($value);
				break;
			case 5:
				$this->setAddress2($value);
				break;
			case 6:
				$this->setCity($value);
				break;
			case 7:
				$this->setState($value);
				break;
			case 8:
				$this->setZip($value);
				break;
			case 9:
				$this->setAttn($value);
				break;
			case 10:
				$this->setEmail($value);
				break;
			case 11:
				$this->setPhone($value);
				break;
			case 12:
				$this->setExt($value);
				break;
			case 13:
				$this->setCategory($value);
				break;
			case 14:
				$this->setNotes($value);
				break;
			case 15:
				$this->setAllDevices($value);
				break;
			case 16:
				$this->setFreqApproved($value);
				break;
			case 17:
				$this->setFreqLocked($value);
				break;
			case 18:
				$this->setCreatedAt($value);
				break;
			case 19:
				$this->setUpdatedAt($value);
				break;
			case 20:
				$this->setFrequency($value);
				break;
			case 21:
				$this->setFrequencyAnnual($value);
				break;
			case 22:
				$this->setFrequencySemi($value);
				break;
			case 23:
				$this->setFrequencyQuarterly($value);
				break;
			case 24:
				$this->setFrequencySterilizer($value);
				break;
			case 25:
				$this->setFrequencyTg($value);
				break;
			case 26:
				$this->setFrequencyErt($value);
				break;
			case 27:
				$this->setFrequencyRae($value);
				break;
			case 28:
				$this->setFrequencyMedgas($value);
				break;
			case 29:
				$this->setFrequencyImaging($value);
				break;
			case 30:
				$this->setFrequencyNeptune($value);
				break;
			case 31:
				$this->setFrequencyAnesthesia($value);
				break;
			case 32:
				$this->setAnesthesia($value);
				break;
			case 33:
				$this->setMedgas($value);
				break;
			case 34:
				$this->setRequireCoordsUpdate($value);
				break;
			case 35:
				$this->setAddresstype($value);
				break;
			case 36:
				$this->setSecondaryAddress($value);
				break;
			case 37:
				$this->setSecondaryAddress2($value);
				break;
			case 38:
				$this->setSecondaryCity($value);
				break;
			case 39:
				$this->setSecondaryState($value);
				break;
			case 40:
				$this->setSecondaryZip($value);
				break;
			case 41:
				$this->setSecondaryAttn($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ClientPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setLocationId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setClientIdentification($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setClientName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAddress($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setAddress2($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCity($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setState($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setZip($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setAttn($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setEmail($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setPhone($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setExt($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCategory($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setNotes($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setAllDevices($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setFreqApproved($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setFreqLocked($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCreatedAt($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setUpdatedAt($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setFrequency($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setFrequencyAnnual($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setFrequencySemi($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setFrequencyQuarterly($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setFrequencySterilizer($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setFrequencyTg($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setFrequencyErt($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setFrequencyRae($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setFrequencyMedgas($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setFrequencyImaging($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setFrequencyNeptune($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setFrequencyAnesthesia($arr[$keys[31]]);
		if (array_key_exists($keys[32], $arr)) $this->setAnesthesia($arr[$keys[32]]);
		if (array_key_exists($keys[33], $arr)) $this->setMedgas($arr[$keys[33]]);
		if (array_key_exists($keys[34], $arr)) $this->setRequireCoordsUpdate($arr[$keys[34]]);
		if (array_key_exists($keys[35], $arr)) $this->setAddresstype($arr[$keys[35]]);
		if (array_key_exists($keys[36], $arr)) $this->setSecondaryAddress($arr[$keys[36]]);
		if (array_key_exists($keys[37], $arr)) $this->setSecondaryAddress2($arr[$keys[37]]);
		if (array_key_exists($keys[38], $arr)) $this->setSecondaryCity($arr[$keys[38]]);
		if (array_key_exists($keys[39], $arr)) $this->setSecondaryState($arr[$keys[39]]);
		if (array_key_exists($keys[40], $arr)) $this->setSecondaryZip($arr[$keys[40]]);
		if (array_key_exists($keys[41], $arr)) $this->setSecondaryAttn($arr[$keys[41]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ClientPeer::DATABASE_NAME);

		if ($this->isColumnModified(ClientPeer::ID)) $criteria->add(ClientPeer::ID, $this->id);
		if ($this->isColumnModified(ClientPeer::LOCATION_ID)) $criteria->add(ClientPeer::LOCATION_ID, $this->location_id);
		if ($this->isColumnModified(ClientPeer::CLIENT_IDENTIFICATION)) $criteria->add(ClientPeer::CLIENT_IDENTIFICATION, $this->client_identification);
		if ($this->isColumnModified(ClientPeer::CLIENT_NAME)) $criteria->add(ClientPeer::CLIENT_NAME, $this->client_name);
		if ($this->isColumnModified(ClientPeer::ADDRESS)) $criteria->add(ClientPeer::ADDRESS, $this->address);
		if ($this->isColumnModified(ClientPeer::ADDRESS_2)) $criteria->add(ClientPeer::ADDRESS_2, $this->address_2);
		if ($this->isColumnModified(ClientPeer::CITY)) $criteria->add(ClientPeer::CITY, $this->city);
		if ($this->isColumnModified(ClientPeer::STATE)) $criteria->add(ClientPeer::STATE, $this->state);
		if ($this->isColumnModified(ClientPeer::ZIP)) $criteria->add(ClientPeer::ZIP, $this->zip);
		if ($this->isColumnModified(ClientPeer::ATTN)) $criteria->add(ClientPeer::ATTN, $this->attn);
		if ($this->isColumnModified(ClientPeer::EMAIL)) $criteria->add(ClientPeer::EMAIL, $this->email);
		if ($this->isColumnModified(ClientPeer::PHONE)) $criteria->add(ClientPeer::PHONE, $this->phone);
		if ($this->isColumnModified(ClientPeer::EXT)) $criteria->add(ClientPeer::EXT, $this->ext);
		if ($this->isColumnModified(ClientPeer::CATEGORY)) $criteria->add(ClientPeer::CATEGORY, $this->category);
		if ($this->isColumnModified(ClientPeer::NOTES)) $criteria->add(ClientPeer::NOTES, $this->notes);
		if ($this->isColumnModified(ClientPeer::ALL_DEVICES)) $criteria->add(ClientPeer::ALL_DEVICES, $this->all_devices);
		if ($this->isColumnModified(ClientPeer::FREQ_APPROVED)) $criteria->add(ClientPeer::FREQ_APPROVED, $this->freq_approved);
		if ($this->isColumnModified(ClientPeer::FREQ_LOCKED)) $criteria->add(ClientPeer::FREQ_LOCKED, $this->freq_locked);
		if ($this->isColumnModified(ClientPeer::CREATED_AT)) $criteria->add(ClientPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ClientPeer::UPDATED_AT)) $criteria->add(ClientPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(ClientPeer::FREQUENCY)) $criteria->add(ClientPeer::FREQUENCY, $this->frequency);
		if ($this->isColumnModified(ClientPeer::FREQUENCY_ANNUAL)) $criteria->add(ClientPeer::FREQUENCY_ANNUAL, $this->frequency_annual);
		if ($this->isColumnModified(ClientPeer::FREQUENCY_SEMI)) $criteria->add(ClientPeer::FREQUENCY_SEMI, $this->frequency_semi);
		if ($this->isColumnModified(ClientPeer::FREQUENCY_QUARTERLY)) $criteria->add(ClientPeer::FREQUENCY_QUARTERLY, $this->frequency_quarterly);
		if ($this->isColumnModified(ClientPeer::FREQUENCY_STERILIZER)) $criteria->add(ClientPeer::FREQUENCY_STERILIZER, $this->frequency_sterilizer);
		if ($this->isColumnModified(ClientPeer::FREQUENCY_TG)) $criteria->add(ClientPeer::FREQUENCY_TG, $this->frequency_tg);
		if ($this->isColumnModified(ClientPeer::FREQUENCY_ERT)) $criteria->add(ClientPeer::FREQUENCY_ERT, $this->frequency_ert);
		if ($this->isColumnModified(ClientPeer::FREQUENCY_RAE)) $criteria->add(ClientPeer::FREQUENCY_RAE, $this->frequency_rae);
		if ($this->isColumnModified(ClientPeer::FREQUENCY_MEDGAS)) $criteria->add(ClientPeer::FREQUENCY_MEDGAS, $this->frequency_medgas);
		if ($this->isColumnModified(ClientPeer::FREQUENCY_IMAGING)) $criteria->add(ClientPeer::FREQUENCY_IMAGING, $this->frequency_imaging);
		if ($this->isColumnModified(ClientPeer::FREQUENCY_NEPTUNE)) $criteria->add(ClientPeer::FREQUENCY_NEPTUNE, $this->frequency_neptune);
		if ($this->isColumnModified(ClientPeer::FREQUENCY_ANESTHESIA)) $criteria->add(ClientPeer::FREQUENCY_ANESTHESIA, $this->frequency_anesthesia);
		if ($this->isColumnModified(ClientPeer::ANESTHESIA)) $criteria->add(ClientPeer::ANESTHESIA, $this->anesthesia);
		if ($this->isColumnModified(ClientPeer::MEDGAS)) $criteria->add(ClientPeer::MEDGAS, $this->medgas);
		if ($this->isColumnModified(ClientPeer::REQUIRE_COORDS_UPDATE)) $criteria->add(ClientPeer::REQUIRE_COORDS_UPDATE, $this->require_coords_update);
		if ($this->isColumnModified(ClientPeer::ADDRESSTYPE)) $criteria->add(ClientPeer::ADDRESSTYPE, $this->addresstype);
		if ($this->isColumnModified(ClientPeer::SECONDARY_ADDRESS)) $criteria->add(ClientPeer::SECONDARY_ADDRESS, $this->secondary_address);
		if ($this->isColumnModified(ClientPeer::SECONDARY_ADDRESS_2)) $criteria->add(ClientPeer::SECONDARY_ADDRESS_2, $this->secondary_address_2);
		if ($this->isColumnModified(ClientPeer::SECONDARY_CITY)) $criteria->add(ClientPeer::SECONDARY_CITY, $this->secondary_city);
		if ($this->isColumnModified(ClientPeer::SECONDARY_STATE)) $criteria->add(ClientPeer::SECONDARY_STATE, $this->secondary_state);
		if ($this->isColumnModified(ClientPeer::SECONDARY_ZIP)) $criteria->add(ClientPeer::SECONDARY_ZIP, $this->secondary_zip);
		if ($this->isColumnModified(ClientPeer::SECONDARY_ATTN)) $criteria->add(ClientPeer::SECONDARY_ATTN, $this->secondary_attn);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ClientPeer::DATABASE_NAME);

		$criteria->add(ClientPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setLocationId($this->location_id);

		$copyObj->setClientIdentification($this->client_identification);

		$copyObj->setClientName($this->client_name);

		$copyObj->setAddress($this->address);

		$copyObj->setAddress2($this->address_2);

		$copyObj->setCity($this->city);

		$copyObj->setState($this->state);

		$copyObj->setZip($this->zip);

		$copyObj->setAttn($this->attn);

		$copyObj->setEmail($this->email);

		$copyObj->setPhone($this->phone);

		$copyObj->setExt($this->ext);

		$copyObj->setCategory($this->category);

		$copyObj->setNotes($this->notes);

		$copyObj->setAllDevices($this->all_devices);

		$copyObj->setFreqApproved($this->freq_approved);

		$copyObj->setFreqLocked($this->freq_locked);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setFrequency($this->frequency);

		$copyObj->setFrequencyAnnual($this->frequency_annual);

		$copyObj->setFrequencySemi($this->frequency_semi);

		$copyObj->setFrequencyQuarterly($this->frequency_quarterly);

		$copyObj->setFrequencySterilizer($this->frequency_sterilizer);

		$copyObj->setFrequencyTg($this->frequency_tg);

		$copyObj->setFrequencyErt($this->frequency_ert);

		$copyObj->setFrequencyRae($this->frequency_rae);

		$copyObj->setFrequencyMedgas($this->frequency_medgas);

		$copyObj->setFrequencyImaging($this->frequency_imaging);

		$copyObj->setFrequencyNeptune($this->frequency_neptune);

		$copyObj->setFrequencyAnesthesia($this->frequency_anesthesia);

		$copyObj->setAnesthesia($this->anesthesia);

		$copyObj->setMedgas($this->medgas);

		$copyObj->setRequireCoordsUpdate($this->require_coords_update);

		$copyObj->setAddresstype($this->addresstype);

		$copyObj->setSecondaryAddress($this->secondary_address);

		$copyObj->setSecondaryAddress2($this->secondary_address_2);

		$copyObj->setSecondaryCity($this->secondary_city);

		$copyObj->setSecondaryState($this->secondary_state);

		$copyObj->setSecondaryZip($this->secondary_zip);

		$copyObj->setSecondaryAttn($this->secondary_attn);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getDevices() as $relObj) {
				$copyObj->addDevice($relObj->copy($deepCopy));
			}

			foreach($this->getDeviceCheckups() as $relObj) {
				$copyObj->addDeviceCheckup($relObj->copy($deepCopy));
			}

			foreach($this->getWorkorders() as $relObj) {
				$copyObj->addWorkorder($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ClientPeer();
		}
		return self::$peer;
	}

	
	public function setLocation($v)
	{


		if ($v === null) {
			$this->setLocationId(NULL);
		} else {
			$this->setLocationId($v->getId());
		}


		$this->aLocation = $v;
	}


	
	public function getLocation($con = null)
	{
				include_once 'lib/model/om/BaseLocationPeer.php';

		if ($this->aLocation === null && ($this->location_id !== null)) {

			$this->aLocation = LocationPeer::retrieveByPK($this->location_id, $con);

			
		}
		return $this->aLocation;
	}

	
	public function initDevices()
	{
		if ($this->collDevices === null) {
			$this->collDevices = array();
		}
	}

	
	public function getDevices($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDevicePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDevices === null) {
			if ($this->isNew()) {
			   $this->collDevices = array();
			} else {

				$criteria->add(DevicePeer::CLIENT_ID, $this->getId());

				DevicePeer::addSelectColumns($criteria);
				$this->collDevices = DevicePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DevicePeer::CLIENT_ID, $this->getId());

				DevicePeer::addSelectColumns($criteria);
				if (!isset($this->lastDeviceCriteria) || !$this->lastDeviceCriteria->equals($criteria)) {
					$this->collDevices = DevicePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDeviceCriteria = $criteria;
		return $this->collDevices;
	}

	
	public function countDevices($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDevicePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DevicePeer::CLIENT_ID, $this->getId());

		return DevicePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDevice(Device $l)
	{
		$this->collDevices[] = $l;
		$l->setClient($this);
	}


	
	public function getDevicesJoinSpecification($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDevicePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDevices === null) {
			if ($this->isNew()) {
				$this->collDevices = array();
			} else {

				$criteria->add(DevicePeer::CLIENT_ID, $this->getId());

				$this->collDevices = DevicePeer::doSelectJoinSpecification($criteria, $con);
			}
		} else {
									
			$criteria->add(DevicePeer::CLIENT_ID, $this->getId());

			if (!isset($this->lastDeviceCriteria) || !$this->lastDeviceCriteria->equals($criteria)) {
				$this->collDevices = DevicePeer::doSelectJoinSpecification($criteria, $con);
			}
		}
		$this->lastDeviceCriteria = $criteria;

		return $this->collDevices;
	}

	
	public function initDeviceCheckups()
	{
		if ($this->collDeviceCheckups === null) {
			$this->collDeviceCheckups = array();
		}
	}

	
	public function getDeviceCheckups($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDeviceCheckupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDeviceCheckups === null) {
			if ($this->isNew()) {
			   $this->collDeviceCheckups = array();
			} else {

				$criteria->add(DeviceCheckupPeer::CLIENT_ID, $this->getId());

				DeviceCheckupPeer::addSelectColumns($criteria);
				$this->collDeviceCheckups = DeviceCheckupPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DeviceCheckupPeer::CLIENT_ID, $this->getId());

				DeviceCheckupPeer::addSelectColumns($criteria);
				if (!isset($this->lastDeviceCheckupCriteria) || !$this->lastDeviceCheckupCriteria->equals($criteria)) {
					$this->collDeviceCheckups = DeviceCheckupPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDeviceCheckupCriteria = $criteria;
		return $this->collDeviceCheckups;
	}

	
	public function countDeviceCheckups($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDeviceCheckupPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DeviceCheckupPeer::CLIENT_ID, $this->getId());

		return DeviceCheckupPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDeviceCheckup(DeviceCheckup $l)
	{
		$this->collDeviceCheckups[] = $l;
		$l->setClient($this);
	}

	
	public function initWorkorders()
	{
		if ($this->collWorkorders === null) {
			$this->collWorkorders = array();
		}
	}

	
	public function getWorkorders($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseWorkorderPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkorders === null) {
			if ($this->isNew()) {
			   $this->collWorkorders = array();
			} else {

				$criteria->add(WorkorderPeer::CLIENT_ID, $this->getId());

				WorkorderPeer::addSelectColumns($criteria);
				$this->collWorkorders = WorkorderPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WorkorderPeer::CLIENT_ID, $this->getId());

				WorkorderPeer::addSelectColumns($criteria);
				if (!isset($this->lastWorkorderCriteria) || !$this->lastWorkorderCriteria->equals($criteria)) {
					$this->collWorkorders = WorkorderPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWorkorderCriteria = $criteria;
		return $this->collWorkorders;
	}

	
	public function countWorkorders($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseWorkorderPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(WorkorderPeer::CLIENT_ID, $this->getId());

		return WorkorderPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addWorkorder(Workorder $l)
	{
		$this->collWorkorders[] = $l;
		$l->setClient($this);
	}


	
	public function getWorkordersJoinDevice($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseWorkorderPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkorders === null) {
			if ($this->isNew()) {
				$this->collWorkorders = array();
			} else {

				$criteria->add(WorkorderPeer::CLIENT_ID, $this->getId());

				$this->collWorkorders = WorkorderPeer::doSelectJoinDevice($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkorderPeer::CLIENT_ID, $this->getId());

			if (!isset($this->lastWorkorderCriteria) || !$this->lastWorkorderCriteria->equals($criteria)) {
				$this->collWorkorders = WorkorderPeer::doSelectJoinDevice($criteria, $con);
			}
		}
		$this->lastWorkorderCriteria = $criteria;

		return $this->collWorkorders;
	}


	
	public function getWorkordersJoinJobStatus($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseWorkorderPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkorders === null) {
			if ($this->isNew()) {
				$this->collWorkorders = array();
			} else {

				$criteria->add(WorkorderPeer::CLIENT_ID, $this->getId());

				$this->collWorkorders = WorkorderPeer::doSelectJoinJobStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkorderPeer::CLIENT_ID, $this->getId());

			if (!isset($this->lastWorkorderCriteria) || !$this->lastWorkorderCriteria->equals($criteria)) {
				$this->collWorkorders = WorkorderPeer::doSelectJoinJobStatus($criteria, $con);
			}
		}
		$this->lastWorkorderCriteria = $criteria;

		return $this->collWorkorders;
	}


	
	public function getWorkordersJoinJobType($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseWorkorderPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkorders === null) {
			if ($this->isNew()) {
				$this->collWorkorders = array();
			} else {

				$criteria->add(WorkorderPeer::CLIENT_ID, $this->getId());

				$this->collWorkorders = WorkorderPeer::doSelectJoinJobType($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkorderPeer::CLIENT_ID, $this->getId());

			if (!isset($this->lastWorkorderCriteria) || !$this->lastWorkorderCriteria->equals($criteria)) {
				$this->collWorkorders = WorkorderPeer::doSelectJoinJobType($criteria, $con);
			}
		}
		$this->lastWorkorderCriteria = $criteria;

		return $this->collWorkorders;
	}


	
	public function getWorkordersJoinWorkorderType($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseWorkorderPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWorkorders === null) {
			if ($this->isNew()) {
				$this->collWorkorders = array();
			} else {

				$criteria->add(WorkorderPeer::CLIENT_ID, $this->getId());

				$this->collWorkorders = WorkorderPeer::doSelectJoinWorkorderType($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkorderPeer::CLIENT_ID, $this->getId());

			if (!isset($this->lastWorkorderCriteria) || !$this->lastWorkorderCriteria->equals($criteria)) {
				$this->collWorkorders = WorkorderPeer::doSelectJoinWorkorderType($criteria, $con);
			}
		}
		$this->lastWorkorderCriteria = $criteria;

		return $this->collWorkorders;
	}

} 