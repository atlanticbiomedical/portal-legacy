<?php


abstract class BaseJobStatus extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $status_name = '<null>';


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $workorder_type_id;

	
	protected $collWorkorders;

	
	protected $lastWorkorderCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getStatusName()
	{

		return $this->status_name;
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

	
	public function getWorkorderTypeId()
	{

		return $this->workorder_type_id;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = JobStatusPeer::ID;
		}

	} 
	
	public function setStatusName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->status_name !== $v || $v === '<null>') {
			$this->status_name = $v;
			$this->modifiedColumns[] = JobStatusPeer::STATUS_NAME;
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
			$this->modifiedColumns[] = JobStatusPeer::CREATED_AT;
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
			$this->modifiedColumns[] = JobStatusPeer::UPDATED_AT;
		}

	} 
	
	public function setWorkorderTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->workorder_type_id !== $v) {
			$this->workorder_type_id = $v;
			$this->modifiedColumns[] = JobStatusPeer::WORKORDER_TYPE_ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->status_name = $rs->getString($startcol + 1);

			$this->created_at = $rs->getTimestamp($startcol + 2, null);

			$this->updated_at = $rs->getTimestamp($startcol + 3, null);

			$this->workorder_type_id = $rs->getInt($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating JobStatus object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(JobStatusPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			JobStatusPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(JobStatusPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(JobStatusPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(JobStatusPeer::DATABASE_NAME);
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
					$pk = JobStatusPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += JobStatusPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


			if (($retval = JobStatusPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = JobStatusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getStatusName();
				break;
			case 2:
				return $this->getCreatedAt();
				break;
			case 3:
				return $this->getUpdatedAt();
				break;
			case 4:
				return $this->getWorkorderTypeId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = JobStatusPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getStatusName(),
			$keys[2] => $this->getCreatedAt(),
			$keys[3] => $this->getUpdatedAt(),
			$keys[4] => $this->getWorkorderTypeId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = JobStatusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setStatusName($value);
				break;
			case 2:
				$this->setCreatedAt($value);
				break;
			case 3:
				$this->setUpdatedAt($value);
				break;
			case 4:
				$this->setWorkorderTypeId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = JobStatusPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setStatusName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUpdatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setWorkorderTypeId($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(JobStatusPeer::DATABASE_NAME);

		if ($this->isColumnModified(JobStatusPeer::ID)) $criteria->add(JobStatusPeer::ID, $this->id);
		if ($this->isColumnModified(JobStatusPeer::STATUS_NAME)) $criteria->add(JobStatusPeer::STATUS_NAME, $this->status_name);
		if ($this->isColumnModified(JobStatusPeer::CREATED_AT)) $criteria->add(JobStatusPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(JobStatusPeer::UPDATED_AT)) $criteria->add(JobStatusPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(JobStatusPeer::WORKORDER_TYPE_ID)) $criteria->add(JobStatusPeer::WORKORDER_TYPE_ID, $this->workorder_type_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(JobStatusPeer::DATABASE_NAME);

		$criteria->add(JobStatusPeer::ID, $this->id);

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

		$copyObj->setStatusName($this->status_name);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setWorkorderTypeId($this->workorder_type_id);


		if ($deepCopy) {
									$copyObj->setNew(false);

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
			self::$peer = new JobStatusPeer();
		}
		return self::$peer;
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

				$criteria->add(WorkorderPeer::JOB_STATUS_ID, $this->getId());

				WorkorderPeer::addSelectColumns($criteria);
				$this->collWorkorders = WorkorderPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WorkorderPeer::JOB_STATUS_ID, $this->getId());

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

		$criteria->add(WorkorderPeer::JOB_STATUS_ID, $this->getId());

		return WorkorderPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addWorkorder(Workorder $l)
	{
		$this->collWorkorders[] = $l;
		$l->setJobStatus($this);
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

				$criteria->add(WorkorderPeer::JOB_STATUS_ID, $this->getId());

				$this->collWorkorders = WorkorderPeer::doSelectJoinDevice($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkorderPeer::JOB_STATUS_ID, $this->getId());

			if (!isset($this->lastWorkorderCriteria) || !$this->lastWorkorderCriteria->equals($criteria)) {
				$this->collWorkorders = WorkorderPeer::doSelectJoinDevice($criteria, $con);
			}
		}
		$this->lastWorkorderCriteria = $criteria;

		return $this->collWorkorders;
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

				$criteria->add(WorkorderPeer::JOB_STATUS_ID, $this->getId());

				$this->collWorkorders = WorkorderPeer::doSelectJoinClient($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkorderPeer::JOB_STATUS_ID, $this->getId());

			if (!isset($this->lastWorkorderCriteria) || !$this->lastWorkorderCriteria->equals($criteria)) {
				$this->collWorkorders = WorkorderPeer::doSelectJoinClient($criteria, $con);
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

				$criteria->add(WorkorderPeer::JOB_STATUS_ID, $this->getId());

				$this->collWorkorders = WorkorderPeer::doSelectJoinJobType($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkorderPeer::JOB_STATUS_ID, $this->getId());

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

				$criteria->add(WorkorderPeer::JOB_STATUS_ID, $this->getId());

				$this->collWorkorders = WorkorderPeer::doSelectJoinWorkorderType($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkorderPeer::JOB_STATUS_ID, $this->getId());

			if (!isset($this->lastWorkorderCriteria) || !$this->lastWorkorderCriteria->equals($criteria)) {
				$this->collWorkorders = WorkorderPeer::doSelectJoinWorkorderType($criteria, $con);
			}
		}
		$this->lastWorkorderCriteria = $criteria;

		return $this->collWorkorders;
	}

} 