<?php


abstract class BaseDistances extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $client_id_1;


	
	protected $client_id_2;


	
	protected $travel_time_hours;


	
	protected $travel_time_mins;


	
	protected $travel_distance;


	
	protected $updated_at;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getClientId1()
	{

		return $this->client_id_1;
	}

	
	public function getClientId2()
	{

		return $this->client_id_2;
	}

	
	public function getTravelTimeHours()
	{

		return $this->travel_time_hours;
	}

	
	public function getTravelTimeMins()
	{

		return $this->travel_time_mins;
	}

	
	public function getTravelDistance()
	{

		return $this->travel_distance;
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
			$this->modifiedColumns[] = DistancesPeer::ID;
		}

	} 
	
	public function setClientId1($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->client_id_1 !== $v) {
			$this->client_id_1 = $v;
			$this->modifiedColumns[] = DistancesPeer::CLIENT_ID_1;
		}

	} 
	
	public function setClientId2($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->client_id_2 !== $v) {
			$this->client_id_2 = $v;
			$this->modifiedColumns[] = DistancesPeer::CLIENT_ID_2;
		}

	} 
	
	public function setTravelTimeHours($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->travel_time_hours !== $v) {
			$this->travel_time_hours = $v;
			$this->modifiedColumns[] = DistancesPeer::TRAVEL_TIME_HOURS;
		}

	} 
	
	public function setTravelTimeMins($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->travel_time_mins !== $v) {
			$this->travel_time_mins = $v;
			$this->modifiedColumns[] = DistancesPeer::TRAVEL_TIME_MINS;
		}

	} 
	
	public function setTravelDistance($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->travel_distance !== $v) {
			$this->travel_distance = $v;
			$this->modifiedColumns[] = DistancesPeer::TRAVEL_DISTANCE;
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
			$this->modifiedColumns[] = DistancesPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->client_id_1 = $rs->getInt($startcol + 1);

			$this->client_id_2 = $rs->getInt($startcol + 2);

			$this->travel_time_hours = $rs->getInt($startcol + 3);

			$this->travel_time_mins = $rs->getInt($startcol + 4);

			$this->travel_distance = $rs->getInt($startcol + 5);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Distances object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DistancesPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DistancesPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isModified() && !$this->isColumnModified(DistancesPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DistancesPeer::DATABASE_NAME);
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
					$pk = DistancesPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DistancesPeer::doUpdate($this, $con);
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


			if (($retval = DistancesPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DistancesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getClientId1();
				break;
			case 2:
				return $this->getClientId2();
				break;
			case 3:
				return $this->getTravelTimeHours();
				break;
			case 4:
				return $this->getTravelTimeMins();
				break;
			case 5:
				return $this->getTravelDistance();
				break;
			case 6:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DistancesPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getClientId1(),
			$keys[2] => $this->getClientId2(),
			$keys[3] => $this->getTravelTimeHours(),
			$keys[4] => $this->getTravelTimeMins(),
			$keys[5] => $this->getTravelDistance(),
			$keys[6] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DistancesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setClientId1($value);
				break;
			case 2:
				$this->setClientId2($value);
				break;
			case 3:
				$this->setTravelTimeHours($value);
				break;
			case 4:
				$this->setTravelTimeMins($value);
				break;
			case 5:
				$this->setTravelDistance($value);
				break;
			case 6:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DistancesPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setClientId1($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setClientId2($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTravelTimeHours($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTravelTimeMins($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTravelDistance($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DistancesPeer::DATABASE_NAME);

		if ($this->isColumnModified(DistancesPeer::ID)) $criteria->add(DistancesPeer::ID, $this->id);
		if ($this->isColumnModified(DistancesPeer::CLIENT_ID_1)) $criteria->add(DistancesPeer::CLIENT_ID_1, $this->client_id_1);
		if ($this->isColumnModified(DistancesPeer::CLIENT_ID_2)) $criteria->add(DistancesPeer::CLIENT_ID_2, $this->client_id_2);
		if ($this->isColumnModified(DistancesPeer::TRAVEL_TIME_HOURS)) $criteria->add(DistancesPeer::TRAVEL_TIME_HOURS, $this->travel_time_hours);
		if ($this->isColumnModified(DistancesPeer::TRAVEL_TIME_MINS)) $criteria->add(DistancesPeer::TRAVEL_TIME_MINS, $this->travel_time_mins);
		if ($this->isColumnModified(DistancesPeer::TRAVEL_DISTANCE)) $criteria->add(DistancesPeer::TRAVEL_DISTANCE, $this->travel_distance);
		if ($this->isColumnModified(DistancesPeer::UPDATED_AT)) $criteria->add(DistancesPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DistancesPeer::DATABASE_NAME);

		$criteria->add(DistancesPeer::ID, $this->id);

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

		$copyObj->setClientId1($this->client_id_1);

		$copyObj->setClientId2($this->client_id_2);

		$copyObj->setTravelTimeHours($this->travel_time_hours);

		$copyObj->setTravelTimeMins($this->travel_time_mins);

		$copyObj->setTravelDistance($this->travel_distance);

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
			self::$peer = new DistancesPeer();
		}
		return self::$peer;
	}

} 