<?php


abstract class BaseDevice extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $specification_id;


	
	protected $client_id;


	
	protected $serial_number;


	
	protected $location;


	
	protected $frequency;


	
	protected $status;


	
	protected $identification;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $comments;


	
	protected $last_pm_date;

	
	protected $aSpecification;

	
	protected $aClient;

	
	protected $collDevicesFaileds;

	
	protected $lastDevicesFailedCriteria = null;

	
	protected $collQualificationss;

	
	protected $lastQualificationsCriteria = null;

	
	protected $collWorkorders;

	
	protected $lastWorkorderCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getSpecificationId()
	{

		return $this->specification_id;
	}

	
	public function getClientId()
	{

		return $this->client_id;
	}

	
	public function getSerialNumber()
	{

		return $this->serial_number;
	}

	
	public function getLocation()
	{

		return $this->location;
	}

	
	public function getFrequency()
	{

		return $this->frequency;
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function getIdentification()
	{

		return $this->identification;
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

	
	public function getComments()
	{

		return $this->comments;
	}

	
	public function getLastPmDate()
	{

		return $this->last_pm_date;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = DevicePeer::ID;
		}

	} 
	
	public function setSpecificationId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->specification_id !== $v) {
			$this->specification_id = $v;
			$this->modifiedColumns[] = DevicePeer::SPECIFICATION_ID;
		}

		if ($this->aSpecification !== null && $this->aSpecification->getId() !== $v) {
			$this->aSpecification = null;
		}

	} 
	
	public function setClientId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->client_id !== $v) {
			$this->client_id = $v;
			$this->modifiedColumns[] = DevicePeer::CLIENT_ID;
		}

		if ($this->aClient !== null && $this->aClient->getId() !== $v) {
			$this->aClient = null;
		}

	} 
	
	public function setSerialNumber($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->serial_number !== $v) {
			$this->serial_number = $v;
			$this->modifiedColumns[] = DevicePeer::SERIAL_NUMBER;
		}

	} 
	
	public function setLocation($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->location !== $v) {
			$this->location = $v;
			$this->modifiedColumns[] = DevicePeer::LOCATION;
		}

	} 
	
	public function setFrequency($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->frequency !== $v) {
			$this->frequency = $v;
			$this->modifiedColumns[] = DevicePeer::FREQUENCY;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = DevicePeer::STATUS;
		}

	} 
	
	public function setIdentification($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->identification !== $v) {
			$this->identification = $v;
			$this->modifiedColumns[] = DevicePeer::IDENTIFICATION;
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
			$this->modifiedColumns[] = DevicePeer::CREATED_AT;
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
			$this->modifiedColumns[] = DevicePeer::UPDATED_AT;
		}

	} 
	
	public function setComments($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comments !== $v) {
			$this->comments = $v;
			$this->modifiedColumns[] = DevicePeer::COMMENTS;
		}

	} 
	
	public function setLastPmDate($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->last_pm_date !== $v) {
			$this->last_pm_date = $v;
			$this->modifiedColumns[] = DevicePeer::LAST_PM_DATE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->specification_id = $rs->getInt($startcol + 1);

			$this->client_id = $rs->getInt($startcol + 2);

			$this->serial_number = $rs->getString($startcol + 3);

			$this->location = $rs->getString($startcol + 4);

			$this->frequency = $rs->getString($startcol + 5);

			$this->status = $rs->getString($startcol + 6);

			$this->identification = $rs->getString($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->comments = $rs->getString($startcol + 10);

			$this->last_pm_date = $rs->getString($startcol + 11);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Device object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DevicePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DevicePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(DevicePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DevicePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DevicePeer::DATABASE_NAME);
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


												
			if ($this->aSpecification !== null) {
				if ($this->aSpecification->isModified()) {
					$affectedRows += $this->aSpecification->save($con);
				}
				$this->setSpecification($this->aSpecification);
			}

			if ($this->aClient !== null) {
				if ($this->aClient->isModified()) {
					$affectedRows += $this->aClient->save($con);
				}
				$this->setClient($this->aClient);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DevicePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DevicePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collDevicesFaileds !== null) {
				foreach($this->collDevicesFaileds as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collQualificationss !== null) {
				foreach($this->collQualificationss as $referrerFK) {
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


												
			if ($this->aSpecification !== null) {
				if (!$this->aSpecification->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSpecification->getValidationFailures());
				}
			}

			if ($this->aClient !== null) {
				if (!$this->aClient->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aClient->getValidationFailures());
				}
			}


			if (($retval = DevicePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDevicesFaileds !== null) {
					foreach($this->collDevicesFaileds as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collQualificationss !== null) {
					foreach($this->collQualificationss as $referrerFK) {
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
		$pos = DevicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getSpecificationId();
				break;
			case 2:
				return $this->getClientId();
				break;
			case 3:
				return $this->getSerialNumber();
				break;
			case 4:
				return $this->getLocation();
				break;
			case 5:
				return $this->getFrequency();
				break;
			case 6:
				return $this->getStatus();
				break;
			case 7:
				return $this->getIdentification();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			case 9:
				return $this->getUpdatedAt();
				break;
			case 10:
				return $this->getComments();
				break;
			case 11:
				return $this->getLastPmDate();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DevicePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getSpecificationId(),
			$keys[2] => $this->getClientId(),
			$keys[3] => $this->getSerialNumber(),
			$keys[4] => $this->getLocation(),
			$keys[5] => $this->getFrequency(),
			$keys[6] => $this->getStatus(),
			$keys[7] => $this->getIdentification(),
			$keys[8] => $this->getCreatedAt(),
			$keys[9] => $this->getUpdatedAt(),
			$keys[10] => $this->getComments(),
			$keys[11] => $this->getLastPmDate(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DevicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setSpecificationId($value);
				break;
			case 2:
				$this->setClientId($value);
				break;
			case 3:
				$this->setSerialNumber($value);
				break;
			case 4:
				$this->setLocation($value);
				break;
			case 5:
				$this->setFrequency($value);
				break;
			case 6:
				$this->setStatus($value);
				break;
			case 7:
				$this->setIdentification($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
			case 9:
				$this->setUpdatedAt($value);
				break;
			case 10:
				$this->setComments($value);
				break;
			case 11:
				$this->setLastPmDate($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DevicePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSpecificationId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setClientId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSerialNumber($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setLocation($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setFrequency($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setStatus($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIdentification($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setComments($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setLastPmDate($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DevicePeer::DATABASE_NAME);

		if ($this->isColumnModified(DevicePeer::ID)) $criteria->add(DevicePeer::ID, $this->id);
		if ($this->isColumnModified(DevicePeer::SPECIFICATION_ID)) $criteria->add(DevicePeer::SPECIFICATION_ID, $this->specification_id);
		if ($this->isColumnModified(DevicePeer::CLIENT_ID)) $criteria->add(DevicePeer::CLIENT_ID, $this->client_id);
		if ($this->isColumnModified(DevicePeer::SERIAL_NUMBER)) $criteria->add(DevicePeer::SERIAL_NUMBER, $this->serial_number);
		if ($this->isColumnModified(DevicePeer::LOCATION)) $criteria->add(DevicePeer::LOCATION, $this->location);
		if ($this->isColumnModified(DevicePeer::FREQUENCY)) $criteria->add(DevicePeer::FREQUENCY, $this->frequency);
		if ($this->isColumnModified(DevicePeer::STATUS)) $criteria->add(DevicePeer::STATUS, $this->status);
		if ($this->isColumnModified(DevicePeer::IDENTIFICATION)) $criteria->add(DevicePeer::IDENTIFICATION, $this->identification);
		if ($this->isColumnModified(DevicePeer::CREATED_AT)) $criteria->add(DevicePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DevicePeer::UPDATED_AT)) $criteria->add(DevicePeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(DevicePeer::COMMENTS)) $criteria->add(DevicePeer::COMMENTS, $this->comments);
		if ($this->isColumnModified(DevicePeer::LAST_PM_DATE)) $criteria->add(DevicePeer::LAST_PM_DATE, $this->last_pm_date);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DevicePeer::DATABASE_NAME);

		$criteria->add(DevicePeer::ID, $this->id);

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

		$copyObj->setSpecificationId($this->specification_id);

		$copyObj->setClientId($this->client_id);

		$copyObj->setSerialNumber($this->serial_number);

		$copyObj->setLocation($this->location);

		$copyObj->setFrequency($this->frequency);

		$copyObj->setStatus($this->status);

		$copyObj->setIdentification($this->identification);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setComments($this->comments);

		$copyObj->setLastPmDate($this->last_pm_date);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getDevicesFaileds() as $relObj) {
				$copyObj->addDevicesFailed($relObj->copy($deepCopy));
			}

			foreach($this->getQualificationss() as $relObj) {
				$copyObj->addQualifications($relObj->copy($deepCopy));
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
			self::$peer = new DevicePeer();
		}
		return self::$peer;
	}

	
	public function setSpecification($v)
	{


		if ($v === null) {
			$this->setSpecificationId(NULL);
		} else {
			$this->setSpecificationId($v->getId());
		}


		$this->aSpecification = $v;
	}


	
	public function getSpecification($con = null)
	{
				include_once 'lib/model/om/BaseSpecificationPeer.php';

		if ($this->aSpecification === null && ($this->specification_id !== null)) {

			$this->aSpecification = SpecificationPeer::retrieveByPK($this->specification_id, $con);

			
		}
		return $this->aSpecification;
	}

	
	public function setClient($v)
	{


		if ($v === null) {
			$this->setClientId(NULL);
		} else {
			$this->setClientId($v->getId());
		}


		$this->aClient = $v;
	}


	
	public function getClient($con = null)
	{
				include_once 'lib/model/om/BaseClientPeer.php';

		if ($this->aClient === null && ($this->client_id !== null)) {

			$this->aClient = ClientPeer::retrieveByPK($this->client_id, $con);

			
		}
		return $this->aClient;
	}

	
	public function initDevicesFaileds()
	{
		if ($this->collDevicesFaileds === null) {
			$this->collDevicesFaileds = array();
		}
	}

	
	public function getDevicesFaileds($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDevicesFailedPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDevicesFaileds === null) {
			if ($this->isNew()) {
			   $this->collDevicesFaileds = array();
			} else {

				$criteria->add(DevicesFailedPeer::DEVICE_ID, $this->getId());

				DevicesFailedPeer::addSelectColumns($criteria);
				$this->collDevicesFaileds = DevicesFailedPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DevicesFailedPeer::DEVICE_ID, $this->getId());

				DevicesFailedPeer::addSelectColumns($criteria);
				if (!isset($this->lastDevicesFailedCriteria) || !$this->lastDevicesFailedCriteria->equals($criteria)) {
					$this->collDevicesFaileds = DevicesFailedPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDevicesFailedCriteria = $criteria;
		return $this->collDevicesFaileds;
	}

	
	public function countDevicesFaileds($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDevicesFailedPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DevicesFailedPeer::DEVICE_ID, $this->getId());

		return DevicesFailedPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDevicesFailed(DevicesFailed $l)
	{
		$this->collDevicesFaileds[] = $l;
		$l->setDevice($this);
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

				$criteria->add(QualificationsPeer::DEVICE_ID, $this->getId());

				QualificationsPeer::addSelectColumns($criteria);
				$this->collQualificationss = QualificationsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(QualificationsPeer::DEVICE_ID, $this->getId());

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

		$criteria->add(QualificationsPeer::DEVICE_ID, $this->getId());

		return QualificationsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addQualifications(Qualifications $l)
	{
		$this->collQualificationss[] = $l;
		$l->setDevice($this);
	}


	
	public function getQualificationssJoinUser($criteria = null, $con = null)
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

				$criteria->add(QualificationsPeer::DEVICE_ID, $this->getId());

				$this->collQualificationss = QualificationsPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(QualificationsPeer::DEVICE_ID, $this->getId());

			if (!isset($this->lastQualificationsCriteria) || !$this->lastQualificationsCriteria->equals($criteria)) {
				$this->collQualificationss = QualificationsPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastQualificationsCriteria = $criteria;

		return $this->collQualificationss;
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

				$criteria->add(WorkorderPeer::DEVICE_ID, $this->getId());

				WorkorderPeer::addSelectColumns($criteria);
				$this->collWorkorders = WorkorderPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WorkorderPeer::DEVICE_ID, $this->getId());

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

		$criteria->add(WorkorderPeer::DEVICE_ID, $this->getId());

		return WorkorderPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addWorkorder(Workorder $l)
	{
		$this->collWorkorders[] = $l;
		$l->setDevice($this);
	}


	
	public function getWorkordersJoinClient($criteria = null, $con = null)
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

				$criteria->add(WorkorderPeer::DEVICE_ID, $this->getId());

				$this->collWorkorders = WorkorderPeer::doSelectJoinClient($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkorderPeer::DEVICE_ID, $this->getId());

			if (!isset($this->lastWorkorderCriteria) || !$this->lastWorkorderCriteria->equals($criteria)) {
				$this->collWorkorders = WorkorderPeer::doSelectJoinClient($criteria, $con);
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

				$criteria->add(WorkorderPeer::DEVICE_ID, $this->getId());

				$this->collWorkorders = WorkorderPeer::doSelectJoinJobStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkorderPeer::DEVICE_ID, $this->getId());

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

				$criteria->add(WorkorderPeer::DEVICE_ID, $this->getId());

				$this->collWorkorders = WorkorderPeer::doSelectJoinJobType($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkorderPeer::DEVICE_ID, $this->getId());

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

				$criteria->add(WorkorderPeer::DEVICE_ID, $this->getId());

				$this->collWorkorders = WorkorderPeer::doSelectJoinWorkorderType($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkorderPeer::DEVICE_ID, $this->getId());

			if (!isset($this->lastWorkorderCriteria) || !$this->lastWorkorderCriteria->equals($criteria)) {
				$this->collWorkorders = WorkorderPeer::doSelectJoinWorkorderType($criteria, $con);
			}
		}
		$this->lastWorkorderCriteria = $criteria;

		return $this->collWorkorders;
	}

} 