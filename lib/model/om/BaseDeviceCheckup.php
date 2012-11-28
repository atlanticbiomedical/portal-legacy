<?php


abstract class BaseDeviceCheckup extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $device_id;


	
	protected $client_id;


	
	protected $device_identification;


	
	protected $row_indicator;


	
	protected $device_tech_id;


	
	protected $pass_fail_code;


	
	protected $rec_number;


	
	protected $row_purpose;


	
	protected $physical_inspection;


	
	protected $room;


	
	protected $time;


	
	protected $date;


	
	protected $pass_fail;

	
	protected $aClient;

	
	protected $collDeviceTestDatas;

	
	protected $lastDeviceTestDataCriteria = null;

	
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

	
	public function getClientId()
	{

		return $this->client_id;
	}

	
	public function getDeviceIdentification()
	{

		return $this->device_identification;
	}

	
	public function getRowIndicator()
	{

		return $this->row_indicator;
	}

	
	public function getDeviceTechId()
	{

		return $this->device_tech_id;
	}

	
	public function getPassFailCode()
	{

		return $this->pass_fail_code;
	}

	
	public function getRecNumber()
	{

		return $this->rec_number;
	}

	
	public function getRowPurpose()
	{

		return $this->row_purpose;
	}

	
	public function getPhysicalInspection()
	{

		return $this->physical_inspection;
	}

	
	public function getRoom()
	{

		return $this->room;
	}

	
	public function getTime()
	{

		return $this->time;
	}

	
	public function getDate()
	{

		return $this->date;
	}

	
	public function getPassFail()
	{

		return $this->pass_fail;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = DeviceCheckupPeer::ID;
		}

	} 
	
	public function setDeviceId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->device_id !== $v) {
			$this->device_id = $v;
			$this->modifiedColumns[] = DeviceCheckupPeer::DEVICE_ID;
		}

	} 
	
	public function setClientId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->client_id !== $v) {
			$this->client_id = $v;
			$this->modifiedColumns[] = DeviceCheckupPeer::CLIENT_ID;
		}

		if ($this->aClient !== null && $this->aClient->getId() !== $v) {
			$this->aClient = null;
		}

	} 
	
	public function setDeviceIdentification($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->device_identification !== $v) {
			$this->device_identification = $v;
			$this->modifiedColumns[] = DeviceCheckupPeer::DEVICE_IDENTIFICATION;
		}

	} 
	
	public function setRowIndicator($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->row_indicator !== $v) {
			$this->row_indicator = $v;
			$this->modifiedColumns[] = DeviceCheckupPeer::ROW_INDICATOR;
		}

	} 
	
	public function setDeviceTechId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->device_tech_id !== $v) {
			$this->device_tech_id = $v;
			$this->modifiedColumns[] = DeviceCheckupPeer::DEVICE_TECH_ID;
		}

	} 
	
	public function setPassFailCode($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->pass_fail_code !== $v) {
			$this->pass_fail_code = $v;
			$this->modifiedColumns[] = DeviceCheckupPeer::PASS_FAIL_CODE;
		}

	} 
	
	public function setRecNumber($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->rec_number !== $v) {
			$this->rec_number = $v;
			$this->modifiedColumns[] = DeviceCheckupPeer::REC_NUMBER;
		}

	} 
	
	public function setRowPurpose($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->row_purpose !== $v) {
			$this->row_purpose = $v;
			$this->modifiedColumns[] = DeviceCheckupPeer::ROW_PURPOSE;
		}

	} 
	
	public function setPhysicalInspection($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->physical_inspection !== $v) {
			$this->physical_inspection = $v;
			$this->modifiedColumns[] = DeviceCheckupPeer::PHYSICAL_INSPECTION;
		}

	} 
	
	public function setRoom($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->room !== $v) {
			$this->room = $v;
			$this->modifiedColumns[] = DeviceCheckupPeer::ROOM;
		}

	} 
	
	public function setTime($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->time !== $v) {
			$this->time = $v;
			$this->modifiedColumns[] = DeviceCheckupPeer::TIME;
		}

	} 
	
	public function setDate($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->date !== $v) {
			$this->date = $v;
			$this->modifiedColumns[] = DeviceCheckupPeer::DATE;
		}

	} 
	
	public function setPassFail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->pass_fail !== $v) {
			$this->pass_fail = $v;
			$this->modifiedColumns[] = DeviceCheckupPeer::PASS_FAIL;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->device_id = $rs->getInt($startcol + 1);

			$this->client_id = $rs->getInt($startcol + 2);

			$this->device_identification = $rs->getString($startcol + 3);

			$this->row_indicator = $rs->getString($startcol + 4);

			$this->device_tech_id = $rs->getString($startcol + 5);

			$this->pass_fail_code = $rs->getString($startcol + 6);

			$this->rec_number = $rs->getString($startcol + 7);

			$this->row_purpose = $rs->getString($startcol + 8);

			$this->physical_inspection = $rs->getString($startcol + 9);

			$this->room = $rs->getString($startcol + 10);

			$this->time = $rs->getString($startcol + 11);

			$this->date = $rs->getString($startcol + 12);

			$this->pass_fail = $rs->getString($startcol + 13);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DeviceCheckup object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DeviceCheckupPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DeviceCheckupPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(DeviceCheckupPeer::DATABASE_NAME);
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


												
			if ($this->aClient !== null) {
				if ($this->aClient->isModified()) {
					$affectedRows += $this->aClient->save($con);
				}
				$this->setClient($this->aClient);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DeviceCheckupPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DeviceCheckupPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collDeviceTestDatas !== null) {
				foreach($this->collDeviceTestDatas as $referrerFK) {
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


												
			if ($this->aClient !== null) {
				if (!$this->aClient->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aClient->getValidationFailures());
				}
			}


			if (($retval = DeviceCheckupPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDeviceTestDatas !== null) {
					foreach($this->collDeviceTestDatas as $referrerFK) {
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
		$pos = DeviceCheckupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getClientId();
				break;
			case 3:
				return $this->getDeviceIdentification();
				break;
			case 4:
				return $this->getRowIndicator();
				break;
			case 5:
				return $this->getDeviceTechId();
				break;
			case 6:
				return $this->getPassFailCode();
				break;
			case 7:
				return $this->getRecNumber();
				break;
			case 8:
				return $this->getRowPurpose();
				break;
			case 9:
				return $this->getPhysicalInspection();
				break;
			case 10:
				return $this->getRoom();
				break;
			case 11:
				return $this->getTime();
				break;
			case 12:
				return $this->getDate();
				break;
			case 13:
				return $this->getPassFail();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DeviceCheckupPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDeviceId(),
			$keys[2] => $this->getClientId(),
			$keys[3] => $this->getDeviceIdentification(),
			$keys[4] => $this->getRowIndicator(),
			$keys[5] => $this->getDeviceTechId(),
			$keys[6] => $this->getPassFailCode(),
			$keys[7] => $this->getRecNumber(),
			$keys[8] => $this->getRowPurpose(),
			$keys[9] => $this->getPhysicalInspection(),
			$keys[10] => $this->getRoom(),
			$keys[11] => $this->getTime(),
			$keys[12] => $this->getDate(),
			$keys[13] => $this->getPassFail(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DeviceCheckupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setClientId($value);
				break;
			case 3:
				$this->setDeviceIdentification($value);
				break;
			case 4:
				$this->setRowIndicator($value);
				break;
			case 5:
				$this->setDeviceTechId($value);
				break;
			case 6:
				$this->setPassFailCode($value);
				break;
			case 7:
				$this->setRecNumber($value);
				break;
			case 8:
				$this->setRowPurpose($value);
				break;
			case 9:
				$this->setPhysicalInspection($value);
				break;
			case 10:
				$this->setRoom($value);
				break;
			case 11:
				$this->setTime($value);
				break;
			case 12:
				$this->setDate($value);
				break;
			case 13:
				$this->setPassFail($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DeviceCheckupPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDeviceId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setClientId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDeviceIdentification($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRowIndicator($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDeviceTechId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPassFailCode($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setRecNumber($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setRowPurpose($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setPhysicalInspection($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setRoom($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setTime($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setDate($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setPassFail($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DeviceCheckupPeer::DATABASE_NAME);

		if ($this->isColumnModified(DeviceCheckupPeer::ID)) $criteria->add(DeviceCheckupPeer::ID, $this->id);
		if ($this->isColumnModified(DeviceCheckupPeer::DEVICE_ID)) $criteria->add(DeviceCheckupPeer::DEVICE_ID, $this->device_id);
		if ($this->isColumnModified(DeviceCheckupPeer::CLIENT_ID)) $criteria->add(DeviceCheckupPeer::CLIENT_ID, $this->client_id);
		if ($this->isColumnModified(DeviceCheckupPeer::DEVICE_IDENTIFICATION)) $criteria->add(DeviceCheckupPeer::DEVICE_IDENTIFICATION, $this->device_identification);
		if ($this->isColumnModified(DeviceCheckupPeer::ROW_INDICATOR)) $criteria->add(DeviceCheckupPeer::ROW_INDICATOR, $this->row_indicator);
		if ($this->isColumnModified(DeviceCheckupPeer::DEVICE_TECH_ID)) $criteria->add(DeviceCheckupPeer::DEVICE_TECH_ID, $this->device_tech_id);
		if ($this->isColumnModified(DeviceCheckupPeer::PASS_FAIL_CODE)) $criteria->add(DeviceCheckupPeer::PASS_FAIL_CODE, $this->pass_fail_code);
		if ($this->isColumnModified(DeviceCheckupPeer::REC_NUMBER)) $criteria->add(DeviceCheckupPeer::REC_NUMBER, $this->rec_number);
		if ($this->isColumnModified(DeviceCheckupPeer::ROW_PURPOSE)) $criteria->add(DeviceCheckupPeer::ROW_PURPOSE, $this->row_purpose);
		if ($this->isColumnModified(DeviceCheckupPeer::PHYSICAL_INSPECTION)) $criteria->add(DeviceCheckupPeer::PHYSICAL_INSPECTION, $this->physical_inspection);
		if ($this->isColumnModified(DeviceCheckupPeer::ROOM)) $criteria->add(DeviceCheckupPeer::ROOM, $this->room);
		if ($this->isColumnModified(DeviceCheckupPeer::TIME)) $criteria->add(DeviceCheckupPeer::TIME, $this->time);
		if ($this->isColumnModified(DeviceCheckupPeer::DATE)) $criteria->add(DeviceCheckupPeer::DATE, $this->date);
		if ($this->isColumnModified(DeviceCheckupPeer::PASS_FAIL)) $criteria->add(DeviceCheckupPeer::PASS_FAIL, $this->pass_fail);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DeviceCheckupPeer::DATABASE_NAME);

		$criteria->add(DeviceCheckupPeer::ID, $this->id);

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

		$copyObj->setClientId($this->client_id);

		$copyObj->setDeviceIdentification($this->device_identification);

		$copyObj->setRowIndicator($this->row_indicator);

		$copyObj->setDeviceTechId($this->device_tech_id);

		$copyObj->setPassFailCode($this->pass_fail_code);

		$copyObj->setRecNumber($this->rec_number);

		$copyObj->setRowPurpose($this->row_purpose);

		$copyObj->setPhysicalInspection($this->physical_inspection);

		$copyObj->setRoom($this->room);

		$copyObj->setTime($this->time);

		$copyObj->setDate($this->date);

		$copyObj->setPassFail($this->pass_fail);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getDeviceTestDatas() as $relObj) {
				$copyObj->addDeviceTestData($relObj->copy($deepCopy));
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
			self::$peer = new DeviceCheckupPeer();
		}
		return self::$peer;
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

	
	public function initDeviceTestDatas()
	{
		if ($this->collDeviceTestDatas === null) {
			$this->collDeviceTestDatas = array();
		}
	}

	
	public function getDeviceTestDatas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDeviceTestDataPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDeviceTestDatas === null) {
			if ($this->isNew()) {
			   $this->collDeviceTestDatas = array();
			} else {

				$criteria->add(DeviceTestDataPeer::DEVICE_CHECKUP_ID, $this->getId());

				DeviceTestDataPeer::addSelectColumns($criteria);
				$this->collDeviceTestDatas = DeviceTestDataPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DeviceTestDataPeer::DEVICE_CHECKUP_ID, $this->getId());

				DeviceTestDataPeer::addSelectColumns($criteria);
				if (!isset($this->lastDeviceTestDataCriteria) || !$this->lastDeviceTestDataCriteria->equals($criteria)) {
					$this->collDeviceTestDatas = DeviceTestDataPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDeviceTestDataCriteria = $criteria;
		return $this->collDeviceTestDatas;
	}

	
	public function countDeviceTestDatas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDeviceTestDataPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DeviceTestDataPeer::DEVICE_CHECKUP_ID, $this->getId());

		return DeviceTestDataPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDeviceTestData(DeviceTestData $l)
	{
		$this->collDeviceTestDatas[] = $l;
		$l->setDeviceCheckup($this);
	}

} 