<?php


abstract class BaseSpecification extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $device_name;


	
	protected $manufacturer;


	
	protected $model_number;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collDevices;

	
	protected $lastDeviceCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getDeviceName()
	{

		return $this->device_name;
	}

	
	public function getManufacturer()
	{

		return $this->manufacturer;
	}

	
	public function getModelNumber()
	{

		return $this->model_number;
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

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SpecificationPeer::ID;
		}

	} 
	
	public function setDeviceName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->device_name !== $v) {
			$this->device_name = $v;
			$this->modifiedColumns[] = SpecificationPeer::DEVICE_NAME;
		}

	} 
	
	public function setManufacturer($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->manufacturer !== $v) {
			$this->manufacturer = $v;
			$this->modifiedColumns[] = SpecificationPeer::MANUFACTURER;
		}

	} 
	
	public function setModelNumber($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->model_number !== $v) {
			$this->model_number = $v;
			$this->modifiedColumns[] = SpecificationPeer::MODEL_NUMBER;
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
			$this->modifiedColumns[] = SpecificationPeer::CREATED_AT;
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
			$this->modifiedColumns[] = SpecificationPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->device_name = $rs->getString($startcol + 1);

			$this->manufacturer = $rs->getString($startcol + 2);

			$this->model_number = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Specification object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SpecificationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SpecificationPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(SpecificationPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SpecificationPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SpecificationPeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SpecificationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SpecificationPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collDevices !== null) {
				foreach($this->collDevices as $referrerFK) {
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


			if (($retval = SpecificationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDevices !== null) {
					foreach($this->collDevices as $referrerFK) {
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
		$pos = SpecificationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getDeviceName();
				break;
			case 2:
				return $this->getManufacturer();
				break;
			case 3:
				return $this->getModelNumber();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			case 5:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SpecificationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDeviceName(),
			$keys[2] => $this->getManufacturer(),
			$keys[3] => $this->getModelNumber(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SpecificationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setDeviceName($value);
				break;
			case 2:
				$this->setManufacturer($value);
				break;
			case 3:
				$this->setModelNumber($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
			case 5:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SpecificationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDeviceName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setManufacturer($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setModelNumber($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SpecificationPeer::DATABASE_NAME);

		if ($this->isColumnModified(SpecificationPeer::ID)) $criteria->add(SpecificationPeer::ID, $this->id);
		if ($this->isColumnModified(SpecificationPeer::DEVICE_NAME)) $criteria->add(SpecificationPeer::DEVICE_NAME, $this->device_name);
		if ($this->isColumnModified(SpecificationPeer::MANUFACTURER)) $criteria->add(SpecificationPeer::MANUFACTURER, $this->manufacturer);
		if ($this->isColumnModified(SpecificationPeer::MODEL_NUMBER)) $criteria->add(SpecificationPeer::MODEL_NUMBER, $this->model_number);
		if ($this->isColumnModified(SpecificationPeer::CREATED_AT)) $criteria->add(SpecificationPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SpecificationPeer::UPDATED_AT)) $criteria->add(SpecificationPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SpecificationPeer::DATABASE_NAME);

		$criteria->add(SpecificationPeer::ID, $this->id);

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

		$copyObj->setDeviceName($this->device_name);

		$copyObj->setManufacturer($this->manufacturer);

		$copyObj->setModelNumber($this->model_number);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getDevices() as $relObj) {
				$copyObj->addDevice($relObj->copy($deepCopy));
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
			self::$peer = new SpecificationPeer();
		}
		return self::$peer;
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

				$criteria->add(DevicePeer::SPECIFICATION_ID, $this->getId());

				DevicePeer::addSelectColumns($criteria);
				$this->collDevices = DevicePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DevicePeer::SPECIFICATION_ID, $this->getId());

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

		$criteria->add(DevicePeer::SPECIFICATION_ID, $this->getId());

		return DevicePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDevice(Device $l)
	{
		$this->collDevices[] = $l;
		$l->setSpecification($this);
	}


	
	public function getDevicesJoinClient($criteria = null, $con = null)
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

				$criteria->add(DevicePeer::SPECIFICATION_ID, $this->getId());

				$this->collDevices = DevicePeer::doSelectJoinClient($criteria, $con);
			}
		} else {
									
			$criteria->add(DevicePeer::SPECIFICATION_ID, $this->getId());

			if (!isset($this->lastDeviceCriteria) || !$this->lastDeviceCriteria->equals($criteria)) {
				$this->collDevices = DevicePeer::doSelectJoinClient($criteria, $con);
			}
		}
		$this->lastDeviceCriteria = $criteria;

		return $this->collDevices;
	}

} 