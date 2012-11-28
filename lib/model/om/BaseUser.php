<?php


abstract class BaseUser extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $user_name;


	
	protected $first_name;


	
	protected $last_name;


	
	protected $email;


	
	protected $phone;


	
	protected $address;


	
	protected $address_2;


	
	protected $city;


	
	protected $state;


	
	protected $zip;


	
	protected $password;


	
	protected $start_time;


	
	protected $end_time;


	
	protected $location_id;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $user_type_id;


	
	protected $weight;


	
	protected $admin = 0;

	
	protected $aUserType;

	
	protected $collQualificationss;

	
	protected $lastQualificationsCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getUserName()
	{

		return $this->user_name;
	}

	
	public function getFirstName()
	{

		return $this->first_name;
	}

	
	public function getLastName()
	{

		return $this->last_name;
	}

	
	public function getEmail()
	{

		return $this->email;
	}

	
	public function getPhone()
	{

		return $this->phone;
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

	
	public function getPassword()
	{

		return $this->password;
	}

	
	public function getStartTime()
	{

		return $this->start_time;
	}

	
	public function getEndTime()
	{

		return $this->end_time;
	}

	
	public function getLocationId()
	{

		return $this->location_id;
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

	
	public function getUserTypeId()
	{

		return $this->user_type_id;
	}

	
	public function getWeight()
	{

		return $this->weight;
	}

	
	public function getAdmin()
	{

		return $this->admin;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = UserPeer::ID;
		}

	} 
	
	public function setUserName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->user_name !== $v) {
			$this->user_name = $v;
			$this->modifiedColumns[] = UserPeer::USER_NAME;
		}

	} 
	
	public function setFirstName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = UserPeer::FIRST_NAME;
		}

	} 
	
	public function setLastName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = UserPeer::LAST_NAME;
		}

	} 
	
	public function setEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = UserPeer::EMAIL;
		}

	} 
	
	public function setPhone($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->phone !== $v) {
			$this->phone = $v;
			$this->modifiedColumns[] = UserPeer::PHONE;
		}

	} 
	
	public function setAddress($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address !== $v) {
			$this->address = $v;
			$this->modifiedColumns[] = UserPeer::ADDRESS;
		}

	} 
	
	public function setAddress2($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address_2 !== $v) {
			$this->address_2 = $v;
			$this->modifiedColumns[] = UserPeer::ADDRESS_2;
		}

	} 
	
	public function setCity($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->city !== $v) {
			$this->city = $v;
			$this->modifiedColumns[] = UserPeer::CITY;
		}

	} 
	
	public function setState($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->state !== $v) {
			$this->state = $v;
			$this->modifiedColumns[] = UserPeer::STATE;
		}

	} 
	
	public function setZip($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->zip !== $v) {
			$this->zip = $v;
			$this->modifiedColumns[] = UserPeer::ZIP;
		}

	} 
	
	public function setPassword($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->password !== $v) {
			$this->password = $v;
			$this->modifiedColumns[] = UserPeer::PASSWORD;
		}

	} 
	
	public function setStartTime($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->start_time !== $v) {
			$this->start_time = $v;
			$this->modifiedColumns[] = UserPeer::START_TIME;
		}

	} 
	
	public function setEndTime($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->end_time !== $v) {
			$this->end_time = $v;
			$this->modifiedColumns[] = UserPeer::END_TIME;
		}

	} 
	
	public function setLocationId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->location_id !== $v) {
			$this->location_id = $v;
			$this->modifiedColumns[] = UserPeer::LOCATION_ID;
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
			$this->modifiedColumns[] = UserPeer::CREATED_AT;
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
			$this->modifiedColumns[] = UserPeer::UPDATED_AT;
		}

	} 
	
	public function setUserTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_type_id !== $v) {
			$this->user_type_id = $v;
			$this->modifiedColumns[] = UserPeer::USER_TYPE_ID;
		}

		if ($this->aUserType !== null && $this->aUserType->getId() !== $v) {
			$this->aUserType = null;
		}

	} 
	
	public function setWeight($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->weight !== $v) {
			$this->weight = $v;
			$this->modifiedColumns[] = UserPeer::WEIGHT;
		}

	} 
	
	public function setAdmin($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->admin !== $v || $v === 0) {
			$this->admin = $v;
			$this->modifiedColumns[] = UserPeer::ADMIN;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->user_name = $rs->getString($startcol + 1);

			$this->first_name = $rs->getString($startcol + 2);

			$this->last_name = $rs->getString($startcol + 3);

			$this->email = $rs->getString($startcol + 4);

			$this->phone = $rs->getString($startcol + 5);

			$this->address = $rs->getString($startcol + 6);

			$this->address_2 = $rs->getString($startcol + 7);

			$this->city = $rs->getString($startcol + 8);

			$this->state = $rs->getString($startcol + 9);

			$this->zip = $rs->getString($startcol + 10);

			$this->password = $rs->getString($startcol + 11);

			$this->start_time = $rs->getString($startcol + 12);

			$this->end_time = $rs->getString($startcol + 13);

			$this->location_id = $rs->getInt($startcol + 14);

			$this->created_at = $rs->getTimestamp($startcol + 15, null);

			$this->updated_at = $rs->getTimestamp($startcol + 16, null);

			$this->user_type_id = $rs->getInt($startcol + 17);

			$this->weight = $rs->getInt($startcol + 18);

			$this->admin = $rs->getInt($startcol + 19);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 20; 
		} catch (Exception $e) {
			throw new PropelException("Error populating User object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			UserPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(UserPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(UserPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME);
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


												
			if ($this->aUserType !== null) {
				if ($this->aUserType->isModified()) {
					$affectedRows += $this->aUserType->save($con);
				}
				$this->setUserType($this->aUserType);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UserPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += UserPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collQualificationss !== null) {
				foreach($this->collQualificationss as $referrerFK) {
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


												
			if ($this->aUserType !== null) {
				if (!$this->aUserType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserType->getValidationFailures());
				}
			}


			if (($retval = UserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collQualificationss !== null) {
					foreach($this->collQualificationss as $referrerFK) {
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
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getUserName();
				break;
			case 2:
				return $this->getFirstName();
				break;
			case 3:
				return $this->getLastName();
				break;
			case 4:
				return $this->getEmail();
				break;
			case 5:
				return $this->getPhone();
				break;
			case 6:
				return $this->getAddress();
				break;
			case 7:
				return $this->getAddress2();
				break;
			case 8:
				return $this->getCity();
				break;
			case 9:
				return $this->getState();
				break;
			case 10:
				return $this->getZip();
				break;
			case 11:
				return $this->getPassword();
				break;
			case 12:
				return $this->getStartTime();
				break;
			case 13:
				return $this->getEndTime();
				break;
			case 14:
				return $this->getLocationId();
				break;
			case 15:
				return $this->getCreatedAt();
				break;
			case 16:
				return $this->getUpdatedAt();
				break;
			case 17:
				return $this->getUserTypeId();
				break;
			case 18:
				return $this->getWeight();
				break;
			case 19:
				return $this->getAdmin();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserName(),
			$keys[2] => $this->getFirstName(),
			$keys[3] => $this->getLastName(),
			$keys[4] => $this->getEmail(),
			$keys[5] => $this->getPhone(),
			$keys[6] => $this->getAddress(),
			$keys[7] => $this->getAddress2(),
			$keys[8] => $this->getCity(),
			$keys[9] => $this->getState(),
			$keys[10] => $this->getZip(),
			$keys[11] => $this->getPassword(),
			$keys[12] => $this->getStartTime(),
			$keys[13] => $this->getEndTime(),
			$keys[14] => $this->getLocationId(),
			$keys[15] => $this->getCreatedAt(),
			$keys[16] => $this->getUpdatedAt(),
			$keys[17] => $this->getUserTypeId(),
			$keys[18] => $this->getWeight(),
			$keys[19] => $this->getAdmin(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setUserName($value);
				break;
			case 2:
				$this->setFirstName($value);
				break;
			case 3:
				$this->setLastName($value);
				break;
			case 4:
				$this->setEmail($value);
				break;
			case 5:
				$this->setPhone($value);
				break;
			case 6:
				$this->setAddress($value);
				break;
			case 7:
				$this->setAddress2($value);
				break;
			case 8:
				$this->setCity($value);
				break;
			case 9:
				$this->setState($value);
				break;
			case 10:
				$this->setZip($value);
				break;
			case 11:
				$this->setPassword($value);
				break;
			case 12:
				$this->setStartTime($value);
				break;
			case 13:
				$this->setEndTime($value);
				break;
			case 14:
				$this->setLocationId($value);
				break;
			case 15:
				$this->setCreatedAt($value);
				break;
			case 16:
				$this->setUpdatedAt($value);
				break;
			case 17:
				$this->setUserTypeId($value);
				break;
			case 18:
				$this->setWeight($value);
				break;
			case 19:
				$this->setAdmin($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFirstName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLastName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEmail($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPhone($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setAddress($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setAddress2($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCity($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setState($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setZip($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setPassword($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setStartTime($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setEndTime($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setLocationId($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCreatedAt($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setUpdatedAt($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setUserTypeId($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setWeight($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setAdmin($arr[$keys[19]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(UserPeer::DATABASE_NAME);

		if ($this->isColumnModified(UserPeer::ID)) $criteria->add(UserPeer::ID, $this->id);
		if ($this->isColumnModified(UserPeer::USER_NAME)) $criteria->add(UserPeer::USER_NAME, $this->user_name);
		if ($this->isColumnModified(UserPeer::FIRST_NAME)) $criteria->add(UserPeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(UserPeer::LAST_NAME)) $criteria->add(UserPeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(UserPeer::EMAIL)) $criteria->add(UserPeer::EMAIL, $this->email);
		if ($this->isColumnModified(UserPeer::PHONE)) $criteria->add(UserPeer::PHONE, $this->phone);
		if ($this->isColumnModified(UserPeer::ADDRESS)) $criteria->add(UserPeer::ADDRESS, $this->address);
		if ($this->isColumnModified(UserPeer::ADDRESS_2)) $criteria->add(UserPeer::ADDRESS_2, $this->address_2);
		if ($this->isColumnModified(UserPeer::CITY)) $criteria->add(UserPeer::CITY, $this->city);
		if ($this->isColumnModified(UserPeer::STATE)) $criteria->add(UserPeer::STATE, $this->state);
		if ($this->isColumnModified(UserPeer::ZIP)) $criteria->add(UserPeer::ZIP, $this->zip);
		if ($this->isColumnModified(UserPeer::PASSWORD)) $criteria->add(UserPeer::PASSWORD, $this->password);
		if ($this->isColumnModified(UserPeer::START_TIME)) $criteria->add(UserPeer::START_TIME, $this->start_time);
		if ($this->isColumnModified(UserPeer::END_TIME)) $criteria->add(UserPeer::END_TIME, $this->end_time);
		if ($this->isColumnModified(UserPeer::LOCATION_ID)) $criteria->add(UserPeer::LOCATION_ID, $this->location_id);
		if ($this->isColumnModified(UserPeer::CREATED_AT)) $criteria->add(UserPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(UserPeer::UPDATED_AT)) $criteria->add(UserPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(UserPeer::USER_TYPE_ID)) $criteria->add(UserPeer::USER_TYPE_ID, $this->user_type_id);
		if ($this->isColumnModified(UserPeer::WEIGHT)) $criteria->add(UserPeer::WEIGHT, $this->weight);
		if ($this->isColumnModified(UserPeer::ADMIN)) $criteria->add(UserPeer::ADMIN, $this->admin);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(UserPeer::DATABASE_NAME);

		$criteria->add(UserPeer::ID, $this->id);

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

		$copyObj->setUserName($this->user_name);

		$copyObj->setFirstName($this->first_name);

		$copyObj->setLastName($this->last_name);

		$copyObj->setEmail($this->email);

		$copyObj->setPhone($this->phone);

		$copyObj->setAddress($this->address);

		$copyObj->setAddress2($this->address_2);

		$copyObj->setCity($this->city);

		$copyObj->setState($this->state);

		$copyObj->setZip($this->zip);

		$copyObj->setPassword($this->password);

		$copyObj->setStartTime($this->start_time);

		$copyObj->setEndTime($this->end_time);

		$copyObj->setLocationId($this->location_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setUserTypeId($this->user_type_id);

		$copyObj->setWeight($this->weight);

		$copyObj->setAdmin($this->admin);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getQualificationss() as $relObj) {
				$copyObj->addQualifications($relObj->copy($deepCopy));
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
			self::$peer = new UserPeer();
		}
		return self::$peer;
	}

	
	public function setUserType($v)
	{


		if ($v === null) {
			$this->setUserTypeId(NULL);
		} else {
			$this->setUserTypeId($v->getId());
		}


		$this->aUserType = $v;
	}


	
	public function getUserType($con = null)
	{
				include_once 'lib/model/om/BaseUserTypePeer.php';

		if ($this->aUserType === null && ($this->user_type_id !== null)) {

			$this->aUserType = UserTypePeer::retrieveByPK($this->user_type_id, $con);

			
		}
		return $this->aUserType;
	}

	
	public function initQualificationss()
	{
		if ($this->collQualificationss === null) {
			$this->collQualificationss = array();
		}
	}

	
	public function getQualificationss($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseQualificationsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collQualificationss === null) {
			if ($this->isNew()) {
			   $this->collQualificationss = array();
			} else {

				$criteria->add(QualificationsPeer::USER_ID, $this->getId());

				QualificationsPeer::addSelectColumns($criteria);
				$this->collQualificationss = QualificationsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(QualificationsPeer::USER_ID, $this->getId());

				QualificationsPeer::addSelectColumns($criteria);
				if (!isset($this->lastQualificationsCriteria) || !$this->lastQualificationsCriteria->equals($criteria)) {
					$this->collQualificationss = QualificationsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastQualificationsCriteria = $criteria;
		return $this->collQualificationss;
	}

	
	public function countQualificationss($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseQualificationsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(QualificationsPeer::USER_ID, $this->getId());

		return QualificationsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addQualifications(Qualifications $l)
	{
		$this->collQualificationss[] = $l;
		$l->setUser($this);
	}


	
	public function getQualificationssJoinDevice($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseQualificationsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collQualificationss === null) {
			if ($this->isNew()) {
				$this->collQualificationss = array();
			} else {

				$criteria->add(QualificationsPeer::USER_ID, $this->getId());

				$this->collQualificationss = QualificationsPeer::doSelectJoinDevice($criteria, $con);
			}
		} else {
									
			$criteria->add(QualificationsPeer::USER_ID, $this->getId());

			if (!isset($this->lastQualificationsCriteria) || !$this->lastQualificationsCriteria->equals($criteria)) {
				$this->collQualificationss = QualificationsPeer::doSelectJoinDevice($criteria, $con);
			}
		}
		$this->lastQualificationsCriteria = $criteria;

		return $this->collQualificationss;
	}

} 