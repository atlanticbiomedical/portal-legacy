<?php


abstract class BaseDeviceTestData extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $device_checkup_id;


	
	protected $name;


	
	protected $type;


	
	protected $value;


	
	protected $passfail;


	
	protected $unit;

	
	protected $aDeviceCheckup;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getDeviceCheckupId()
	{

		return $this->device_checkup_id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getType()
	{

		return $this->type;
	}

	
	public function getValue()
	{

		return $this->value;
	}

	
	public function getPassfail()
	{

		return $this->passfail;
	}

	
	public function getUnit()
	{

		return $this->unit;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = DeviceTestDataPeer::ID;
		}

	} 
	
	public function setDeviceCheckupId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->device_checkup_id !== $v) {
			$this->device_checkup_id = $v;
			$this->modifiedColumns[] = DeviceTestDataPeer::DEVICE_CHECKUP_ID;
		}

		if ($this->aDeviceCheckup !== null && $this->aDeviceCheckup->getId() !== $v) {
			$this->aDeviceCheckup = null;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = DeviceTestDataPeer::NAME;
		}

	} 
	
	public function setType($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = DeviceTestDataPeer::TYPE;
		}

	} 
	
	public function setValue($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->value !== $v) {
			$this->value = $v;
			$this->modifiedColumns[] = DeviceTestDataPeer::VALUE;
		}

	} 
	
	public function setPassfail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->passfail !== $v) {
			$this->passfail = $v;
			$this->modifiedColumns[] = DeviceTestDataPeer::PASSFAIL;
		}

	} 
	
	public function setUnit($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->unit !== $v) {
			$this->unit = $v;
			$this->modifiedColumns[] = DeviceTestDataPeer::UNIT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->device_checkup_id = $rs->getInt($startcol + 1);

			$this->name = $rs->getString($startcol + 2);

			$this->type = $rs->getString($startcol + 3);

			$this->value = $rs->getString($startcol + 4);

			$this->passfail = $rs->getString($startcol + 5);

			$this->unit = $rs->getString($startcol + 6);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DeviceTestData object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DeviceTestDataPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DeviceTestDataPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DeviceTestDataPeer::DATABASE_NAME);
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


												
			if ($this->aDeviceCheckup !== null) {
				if ($this->aDeviceCheckup->isModified()) {
					$affectedRows += $this->aDeviceCheckup->save($con);
				}
				$this->setDeviceCheckup($this->aDeviceCheckup);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DeviceTestDataPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DeviceTestDataPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


												
			if ($this->aDeviceCheckup !== null) {
				if (!$this->aDeviceCheckup->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDeviceCheckup->getValidationFailures());
				}
			}


			if (($retval = DeviceTestDataPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DeviceTestDataPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getDeviceCheckupId();
				break;
			case 2:
				return $this->getName();
				break;
			case 3:
				return $this->getType();
				break;
			case 4:
				return $this->getValue();
				break;
			case 5:
				return $this->getPassfail();
				break;
			case 6:
				return $this->getUnit();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DeviceTestDataPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDeviceCheckupId(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getType(),
			$keys[4] => $this->getValue(),
			$keys[5] => $this->getPassfail(),
			$keys[6] => $this->getUnit(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DeviceTestDataPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setDeviceCheckupId($value);
				break;
			case 2:
				$this->setName($value);
				break;
			case 3:
				$this->setType($value);
				break;
			case 4:
				$this->setValue($value);
				break;
			case 5:
				$this->setPassfail($value);
				break;
			case 6:
				$this->setUnit($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DeviceTestDataPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDeviceCheckupId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setType($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setValue($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPassfail($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUnit($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DeviceTestDataPeer::DATABASE_NAME);

		if ($this->isColumnModified(DeviceTestDataPeer::ID)) $criteria->add(DeviceTestDataPeer::ID, $this->id);
		if ($this->isColumnModified(DeviceTestDataPeer::DEVICE_CHECKUP_ID)) $criteria->add(DeviceTestDataPeer::DEVICE_CHECKUP_ID, $this->device_checkup_id);
		if ($this->isColumnModified(DeviceTestDataPeer::NAME)) $criteria->add(DeviceTestDataPeer::NAME, $this->name);
		if ($this->isColumnModified(DeviceTestDataPeer::TYPE)) $criteria->add(DeviceTestDataPeer::TYPE, $this->type);
		if ($this->isColumnModified(DeviceTestDataPeer::VALUE)) $criteria->add(DeviceTestDataPeer::VALUE, $this->value);
		if ($this->isColumnModified(DeviceTestDataPeer::PASSFAIL)) $criteria->add(DeviceTestDataPeer::PASSFAIL, $this->passfail);
		if ($this->isColumnModified(DeviceTestDataPeer::UNIT)) $criteria->add(DeviceTestDataPeer::UNIT, $this->unit);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DeviceTestDataPeer::DATABASE_NAME);

		$criteria->add(DeviceTestDataPeer::ID, $this->id);

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

		$copyObj->setDeviceCheckupId($this->device_checkup_id);

		$copyObj->setName($this->name);

		$copyObj->setType($this->type);

		$copyObj->setValue($this->value);

		$copyObj->setPassfail($this->passfail);

		$copyObj->setUnit($this->unit);


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
			self::$peer = new DeviceTestDataPeer();
		}
		return self::$peer;
	}

	
	public function setDeviceCheckup($v)
	{


		if ($v === null) {
			$this->setDeviceCheckupId(NULL);
		} else {
			$this->setDeviceCheckupId($v->getId());
		}


		$this->aDeviceCheckup = $v;
	}


	
	public function getDeviceCheckup($con = null)
	{
				include_once 'lib/model/om/BaseDeviceCheckupPeer.php';

		if ($this->aDeviceCheckup === null && ($this->device_checkup_id !== null)) {

			$this->aDeviceCheckup = DeviceCheckupPeer::retrieveByPK($this->device_checkup_id, $con);

			
		}
		return $this->aDeviceCheckup;
	}

} 