<?php


abstract class BaseWorkorderType extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $type_name = '<null>';


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collWorkorders;

	
	protected $lastWorkorderCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTypeName()
	{

		return $this->type_name;
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
			$this->modifiedColumns[] = WorkorderTypePeer::ID;
		}

	} 
	
	public function setTypeName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->type_name !== $v || $v === '<null>') {
			$this->type_name = $v;
			$this->modifiedColumns[] = WorkorderTypePeer::TYPE_NAME;
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
			$this->modifiedColumns[] = WorkorderTypePeer::CREATED_AT;
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
			$this->modifiedColumns[] = WorkorderTypePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->type_name = $rs->getString($startcol + 1);

			$this->created_at = $rs->getTimestamp($startcol + 2, null);

			$this->updated_at = $rs->getTimestamp($startcol + 3, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating WorkorderType object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WorkorderTypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			WorkorderTypePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(WorkorderTypePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(WorkorderTypePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WorkorderTypePeer::DATABASE_NAME);
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
					$pk = WorkorderTypePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += WorkorderTypePeer::doUpdate($this, $con);
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


			if (($retval = WorkorderTypePeer::doValidate($this, $columns)) !== true) {
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
		$pos = WorkorderTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTypeName();
				break;
			case 2:
				return $this->getCreatedAt();
				break;
			case 3:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WorkorderTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTypeName(),
			$keys[2] => $this->getCreatedAt(),
			$keys[3] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WorkorderTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTypeName($value);
				break;
			case 2:
				$this->setCreatedAt($value);
				break;
			case 3:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WorkorderTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTypeName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUpdatedAt($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WorkorderTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(WorkorderTypePeer::ID)) $criteria->add(WorkorderTypePeer::ID, $this->id);
		if ($this->isColumnModified(WorkorderTypePeer::TYPE_NAME)) $criteria->add(WorkorderTypePeer::TYPE_NAME, $this->type_name);
		if ($this->isColumnModified(WorkorderTypePeer::CREATED_AT)) $criteria->add(WorkorderTypePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(WorkorderTypePeer::UPDATED_AT)) $criteria->add(WorkorderTypePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WorkorderTypePeer::DATABASE_NAME);

		$criteria->add(WorkorderTypePeer::ID, $this->id);

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

		$copyObj->setTypeName($this->type_name);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


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
			self::$peer = new WorkorderTypePeer();
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

				$criteria->add(WorkorderPeer::WORKORDER_TYPE_ID, $this->getId());

				WorkorderPeer::addSelectColumns($criteria);
				$this->collWorkorders = WorkorderPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(WorkorderPeer::WORKORDER_TYPE_ID, $this->getId());

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

		$criteria->add(WorkorderPeer::WORKORDER_TYPE_ID, $this->getId());

		return WorkorderPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addWorkorder(Workorder $l)
	{
		$this->collWorkorders[] = $l;
		$l->setWorkorderType($this);
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

				$criteria->add(WorkorderPeer::WORKORDER_TYPE_ID, $this->getId());

				$this->collWorkorders = WorkorderPeer::doSelectJoinDevice($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkorderPeer::WORKORDER_TYPE_ID, $this->getId());

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

				$criteria->add(WorkorderPeer::WORKORDER_TYPE_ID, $this->getId());

				$this->collWorkorders = WorkorderPeer::doSelectJoinClient($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkorderPeer::WORKORDER_TYPE_ID, $this->getId());

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

				$criteria->add(WorkorderPeer::WORKORDER_TYPE_ID, $this->getId());

				$this->collWorkorders = WorkorderPeer::doSelectJoinJobStatus($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkorderPeer::WORKORDER_TYPE_ID, $this->getId());

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

				$criteria->add(WorkorderPeer::WORKORDER_TYPE_ID, $this->getId());

				$this->collWorkorders = WorkorderPeer::doSelectJoinJobType($criteria, $con);
			}
		} else {
									
			$criteria->add(WorkorderPeer::WORKORDER_TYPE_ID, $this->getId());

			if (!isset($this->lastWorkorderCriteria) || !$this->lastWorkorderCriteria->equals($criteria)) {
				$this->collWorkorders = WorkorderPeer::doSelectJoinJobType($criteria, $con);
			}
		}
		$this->lastWorkorderCriteria = $criteria;

		return $this->collWorkorders;
	}

} 