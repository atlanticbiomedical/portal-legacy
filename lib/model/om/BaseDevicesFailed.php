<?php


abstract class BaseDevicesFailed extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $device_id;


	
	protected $report_id;


	
	protected $client_id;


	
	protected $status;

	
	protected $aDevice;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getDeviceId()
	{

		return $this->device_id;
	}

	
	public function getReportId()
	{

		return $this->report_id;
	}

	
	public function getClientId()
	{

		return $this->client_id;
	}

	
	public function getStatus()
	{

		return $this->status;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = DevicesFailedPeer::ID;
		}

	} 
	
	public function setDeviceId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->device_id !== $v) {
			$this->device_id = $v;
			$this->modifiedColumns[] = DevicesFailedPeer::DEVICE_ID;
		}

		if ($this->aDevice !== null && $this->aDevice->getId() !== $v) {
			$this->aDevice = null;
		}

	} 
	
	public function setReportId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->report_id !== $v) {
			$this->report_id = $v;
			$this->modifiedColumns[] = DevicesFailedPeer::REPORT_ID;
		}

	} 
	
	public function setClientId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->client_id !== $v) {
			$this->client_id = $v;
			$this->modifiedColumns[] = DevicesFailedPeer::CLIENT_ID;
		}

	} 
	
	public function setStatus($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = DevicesFailedPeer::STATUS;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->device_id = $rs->getInt($startcol + 1);

			$this->report_id = $rs->getInt($startcol + 2);

			$this->client_id = $rs->getString($startcol + 3);

			$this->status = $rs->getString($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DevicesFailed object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DevicesFailedPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DevicesFailedPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(DevicesFailedPeer::DATABASE_NAME);
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


												
			if ($this->aDevice !== null) {
				if ($this->aDevice->isModified()) {
					$affectedRows += $this->aDevice->save($con);
				}
				$this->setDevice($this->aDevice);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DevicesFailedPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DevicesFailedPeer::doUpdate($this, $con);
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


												
			if ($this->aDevice !== null) {
				if (!$this->aDevice->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDevice->getValidationFailures());
				}
			}


			if (($retval = DevicesFailedPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DevicesFailedPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getDeviceId();
				break;
			case 2:
				return $this->getReportId();
				break;
			case 3:
				return $this->getClientId();
				break;
			case 4:
				return $this->getStatus();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DevicesFailedPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDeviceId(),
			$keys[2] => $this->getReportId(),
			$keys[3] => $this->getClientId(),
			$keys[4] => $this->getStatus(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DevicesFailedPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setDeviceId($value);
				break;
			case 2:
				$this->setReportId($value);
				break;
			case 3:
				$this->setClientId($value);
				break;
			case 4:
				$this->setStatus($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DevicesFailedPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDeviceId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setReportId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setClientId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setStatus($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DevicesFailedPeer::DATABASE_NAME);

		if ($this->isColumnModified(DevicesFailedPeer::ID)) $criteria->add(DevicesFailedPeer::ID, $this->id);
		if ($this->isColumnModified(DevicesFailedPeer::DEVICE_ID)) $criteria->add(DevicesFailedPeer::DEVICE_ID, $this->device_id);
		if ($this->isColumnModified(DevicesFailedPeer::REPORT_ID)) $criteria->add(DevicesFailedPeer::REPORT_ID, $this->report_id);
		if ($this->isColumnModified(DevicesFailedPeer::CLIENT_ID)) $criteria->add(DevicesFailedPeer::CLIENT_ID, $this->client_id);
		if ($this->isColumnModified(DevicesFailedPeer::STATUS)) $criteria->add(DevicesFailedPeer::STATUS, $this->status);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DevicesFailedPeer::DATABASE_NAME);

		$criteria->add(DevicesFailedPeer::ID, $this->id);

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

		$copyObj->setDeviceId($this->device_id);

		$copyObj->setReportId($this->report_id);

		$copyObj->setClientId($this->client_id);

		$copyObj->setStatus($this->status);


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
			self::$peer = new DevicesFailedPeer();
		}
		return self::$peer;
	}

	
	public function setDevice($v)
	{


		if ($v === null) {
			$this->setDeviceId(NULL);
		} else {
			$this->setDeviceId($v->getId());
		}


		$this->aDevice = $v;
	}


	
	public function getDevice($con = null)
	{
				include_once 'lib/model/om/BaseDevicePeer.php';

		if ($this->aDevice === null && ($this->device_id !== null)) {

			$this->aDevice = DevicePeer::retrieveByPK($this->device_id, $con);

			
		}
		return $this->aDevice;
	}

} 