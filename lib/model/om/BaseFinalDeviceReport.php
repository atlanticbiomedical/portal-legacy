<?php


abstract class BaseFinalDeviceReport extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $client_id;


	
	protected $date;


	
	protected $pass_fail;


	
	protected $total_failed;


	
	protected $total_passed;


	
	protected $total_bp;


	
	protected $total_trace;


	
	protected $total_missed;


	
	protected $total_outlets;


	
	protected $contact;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getClientId()
	{

		return $this->client_id;
	}

	
	public function getDate()
	{

		return $this->date;
	}

	
	public function getPassFail()
	{

		return $this->pass_fail;
	}

	
	public function getTotalFailed()
	{

		return $this->total_failed;
	}

	
	public function getTotalPassed()
	{

		return $this->total_passed;
	}

	
	public function getTotalBp()
	{

		return $this->total_bp;
	}

	
	public function getTotalTrace()
	{

		return $this->total_trace;
	}

	
	public function getTotalMissed()
	{

		return $this->total_missed;
	}

	
	public function getTotalOutlets()
	{

		return $this->total_outlets;
	}

	
	public function getContact()
	{

		return $this->contact;
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
			$this->modifiedColumns[] = FinalDeviceReportPeer::ID;
		}

	} 
	
	public function setClientId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->client_id !== $v) {
			$this->client_id = $v;
			$this->modifiedColumns[] = FinalDeviceReportPeer::CLIENT_ID;
		}

	} 
	
	public function setDate($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->date !== $v) {
			$this->date = $v;
			$this->modifiedColumns[] = FinalDeviceReportPeer::DATE;
		}

	} 
	
	public function setPassFail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->pass_fail !== $v) {
			$this->pass_fail = $v;
			$this->modifiedColumns[] = FinalDeviceReportPeer::PASS_FAIL;
		}

	} 
	
	public function setTotalFailed($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->total_failed !== $v) {
			$this->total_failed = $v;
			$this->modifiedColumns[] = FinalDeviceReportPeer::TOTAL_FAILED;
		}

	} 
	
	public function setTotalPassed($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->total_passed !== $v) {
			$this->total_passed = $v;
			$this->modifiedColumns[] = FinalDeviceReportPeer::TOTAL_PASSED;
		}

	} 
	
	public function setTotalBp($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->total_bp !== $v) {
			$this->total_bp = $v;
			$this->modifiedColumns[] = FinalDeviceReportPeer::TOTAL_BP;
		}

	} 
	
	public function setTotalTrace($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->total_trace !== $v) {
			$this->total_trace = $v;
			$this->modifiedColumns[] = FinalDeviceReportPeer::TOTAL_TRACE;
		}

	} 
	
	public function setTotalMissed($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->total_missed !== $v) {
			$this->total_missed = $v;
			$this->modifiedColumns[] = FinalDeviceReportPeer::TOTAL_MISSED;
		}

	} 
	
	public function setTotalOutlets($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->total_outlets !== $v) {
			$this->total_outlets = $v;
			$this->modifiedColumns[] = FinalDeviceReportPeer::TOTAL_OUTLETS;
		}

	} 
	
	public function setContact($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->contact !== $v) {
			$this->contact = $v;
			$this->modifiedColumns[] = FinalDeviceReportPeer::CONTACT;
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
			$this->modifiedColumns[] = FinalDeviceReportPeer::CREATED_AT;
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
			$this->modifiedColumns[] = FinalDeviceReportPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->client_id = $rs->getString($startcol + 1);

			$this->date = $rs->getString($startcol + 2);

			$this->pass_fail = $rs->getString($startcol + 3);

			$this->total_failed = $rs->getInt($startcol + 4);

			$this->total_passed = $rs->getInt($startcol + 5);

			$this->total_bp = $rs->getInt($startcol + 6);

			$this->total_trace = $rs->getInt($startcol + 7);

			$this->total_missed = $rs->getInt($startcol + 8);

			$this->total_outlets = $rs->getInt($startcol + 9);

			$this->contact = $rs->getString($startcol + 10);

			$this->created_at = $rs->getTimestamp($startcol + 11, null);

			$this->updated_at = $rs->getTimestamp($startcol + 12, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 13; 
		} catch (Exception $e) {
			throw new PropelException("Error populating FinalDeviceReport object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FinalDeviceReportPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FinalDeviceReportPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(FinalDeviceReportPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(FinalDeviceReportPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FinalDeviceReportPeer::DATABASE_NAME);
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
					$pk = FinalDeviceReportPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += FinalDeviceReportPeer::doUpdate($this, $con);
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


			if (($retval = FinalDeviceReportPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FinalDeviceReportPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getClientId();
				break;
			case 2:
				return $this->getDate();
				break;
			case 3:
				return $this->getPassFail();
				break;
			case 4:
				return $this->getTotalFailed();
				break;
			case 5:
				return $this->getTotalPassed();
				break;
			case 6:
				return $this->getTotalBp();
				break;
			case 7:
				return $this->getTotalTrace();
				break;
			case 8:
				return $this->getTotalMissed();
				break;
			case 9:
				return $this->getTotalOutlets();
				break;
			case 10:
				return $this->getContact();
				break;
			case 11:
				return $this->getCreatedAt();
				break;
			case 12:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FinalDeviceReportPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getClientId(),
			$keys[2] => $this->getDate(),
			$keys[3] => $this->getPassFail(),
			$keys[4] => $this->getTotalFailed(),
			$keys[5] => $this->getTotalPassed(),
			$keys[6] => $this->getTotalBp(),
			$keys[7] => $this->getTotalTrace(),
			$keys[8] => $this->getTotalMissed(),
			$keys[9] => $this->getTotalOutlets(),
			$keys[10] => $this->getContact(),
			$keys[11] => $this->getCreatedAt(),
			$keys[12] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FinalDeviceReportPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setClientId($value);
				break;
			case 2:
				$this->setDate($value);
				break;
			case 3:
				$this->setPassFail($value);
				break;
			case 4:
				$this->setTotalFailed($value);
				break;
			case 5:
				$this->setTotalPassed($value);
				break;
			case 6:
				$this->setTotalBp($value);
				break;
			case 7:
				$this->setTotalTrace($value);
				break;
			case 8:
				$this->setTotalMissed($value);
				break;
			case 9:
				$this->setTotalOutlets($value);
				break;
			case 10:
				$this->setContact($value);
				break;
			case 11:
				$this->setCreatedAt($value);
				break;
			case 12:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FinalDeviceReportPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setClientId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDate($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPassFail($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTotalFailed($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTotalPassed($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setTotalBp($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setTotalTrace($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setTotalMissed($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setTotalOutlets($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setContact($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCreatedAt($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setUpdatedAt($arr[$keys[12]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FinalDeviceReportPeer::DATABASE_NAME);

		if ($this->isColumnModified(FinalDeviceReportPeer::ID)) $criteria->add(FinalDeviceReportPeer::ID, $this->id);
		if ($this->isColumnModified(FinalDeviceReportPeer::CLIENT_ID)) $criteria->add(FinalDeviceReportPeer::CLIENT_ID, $this->client_id);
		if ($this->isColumnModified(FinalDeviceReportPeer::DATE)) $criteria->add(FinalDeviceReportPeer::DATE, $this->date);
		if ($this->isColumnModified(FinalDeviceReportPeer::PASS_FAIL)) $criteria->add(FinalDeviceReportPeer::PASS_FAIL, $this->pass_fail);
		if ($this->isColumnModified(FinalDeviceReportPeer::TOTAL_FAILED)) $criteria->add(FinalDeviceReportPeer::TOTAL_FAILED, $this->total_failed);
		if ($this->isColumnModified(FinalDeviceReportPeer::TOTAL_PASSED)) $criteria->add(FinalDeviceReportPeer::TOTAL_PASSED, $this->total_passed);
		if ($this->isColumnModified(FinalDeviceReportPeer::TOTAL_BP)) $criteria->add(FinalDeviceReportPeer::TOTAL_BP, $this->total_bp);
		if ($this->isColumnModified(FinalDeviceReportPeer::TOTAL_TRACE)) $criteria->add(FinalDeviceReportPeer::TOTAL_TRACE, $this->total_trace);
		if ($this->isColumnModified(FinalDeviceReportPeer::TOTAL_MISSED)) $criteria->add(FinalDeviceReportPeer::TOTAL_MISSED, $this->total_missed);
		if ($this->isColumnModified(FinalDeviceReportPeer::TOTAL_OUTLETS)) $criteria->add(FinalDeviceReportPeer::TOTAL_OUTLETS, $this->total_outlets);
		if ($this->isColumnModified(FinalDeviceReportPeer::CONTACT)) $criteria->add(FinalDeviceReportPeer::CONTACT, $this->contact);
		if ($this->isColumnModified(FinalDeviceReportPeer::CREATED_AT)) $criteria->add(FinalDeviceReportPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(FinalDeviceReportPeer::UPDATED_AT)) $criteria->add(FinalDeviceReportPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FinalDeviceReportPeer::DATABASE_NAME);

		$criteria->add(FinalDeviceReportPeer::ID, $this->id);

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

		$copyObj->setClientId($this->client_id);

		$copyObj->setDate($this->date);

		$copyObj->setPassFail($this->pass_fail);

		$copyObj->setTotalFailed($this->total_failed);

		$copyObj->setTotalPassed($this->total_passed);

		$copyObj->setTotalBp($this->total_bp);

		$copyObj->setTotalTrace($this->total_trace);

		$copyObj->setTotalMissed($this->total_missed);

		$copyObj->setTotalOutlets($this->total_outlets);

		$copyObj->setContact($this->contact);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


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
			self::$peer = new FinalDeviceReportPeer();
		}
		return self::$peer;
	}

} 