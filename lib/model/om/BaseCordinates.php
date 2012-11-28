<?php


abstract class BaseCordinates extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $client_id;


	
	protected $lat;


	
	protected $lon;


	
	protected $found = 0;

	
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

	
	public function getLat()
	{

		return $this->lat;
	}

	
	public function getLon()
	{

		return $this->lon;
	}

	
	public function getFound()
	{

		return $this->found;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = CordinatesPeer::ID;
		}

	} 
	
	public function setClientId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->client_id !== $v) {
			$this->client_id = $v;
			$this->modifiedColumns[] = CordinatesPeer::CLIENT_ID;
		}

	} 
	
	public function setLat($v)
	{

		if ($this->lat !== $v) {
			$this->lat = $v;
			$this->modifiedColumns[] = CordinatesPeer::LAT;
		}

	} 
	
	public function setLon($v)
	{

		if ($this->lon !== $v) {
			$this->lon = $v;
			$this->modifiedColumns[] = CordinatesPeer::LON;
		}

	} 
	
	public function setFound($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->found !== $v || $v === 0) {
			$this->found = $v;
			$this->modifiedColumns[] = CordinatesPeer::FOUND;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->client_id = $rs->getInt($startcol + 1);

			$this->lat = $rs->getFloat($startcol + 2);

			$this->lon = $rs->getFloat($startcol + 3);

			$this->found = $rs->getInt($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Cordinates object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CordinatesPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CordinatesPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(CordinatesPeer::DATABASE_NAME);
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
					$pk = CordinatesPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CordinatesPeer::doUpdate($this, $con);
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


			if (($retval = CordinatesPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CordinatesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getLat();
				break;
			case 3:
				return $this->getLon();
				break;
			case 4:
				return $this->getFound();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CordinatesPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getClientId(),
			$keys[2] => $this->getLat(),
			$keys[3] => $this->getLon(),
			$keys[4] => $this->getFound(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CordinatesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setLat($value);
				break;
			case 3:
				$this->setLon($value);
				break;
			case 4:
				$this->setFound($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CordinatesPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setClientId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setLat($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLon($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFound($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CordinatesPeer::DATABASE_NAME);

		if ($this->isColumnModified(CordinatesPeer::ID)) $criteria->add(CordinatesPeer::ID, $this->id);
		if ($this->isColumnModified(CordinatesPeer::CLIENT_ID)) $criteria->add(CordinatesPeer::CLIENT_ID, $this->client_id);
		if ($this->isColumnModified(CordinatesPeer::LAT)) $criteria->add(CordinatesPeer::LAT, $this->lat);
		if ($this->isColumnModified(CordinatesPeer::LON)) $criteria->add(CordinatesPeer::LON, $this->lon);
		if ($this->isColumnModified(CordinatesPeer::FOUND)) $criteria->add(CordinatesPeer::FOUND, $this->found);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CordinatesPeer::DATABASE_NAME);

		$criteria->add(CordinatesPeer::ID, $this->id);

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

		$copyObj->setLat($this->lat);

		$copyObj->setLon($this->lon);

		$copyObj->setFound($this->found);


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
			self::$peer = new CordinatesPeer();
		}
		return self::$peer;
	}

} 