<?php


abstract class BaseDevicePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'device';

	
	const CLASS_DEFAULT = 'lib.model.Device';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'device.ID';

	
	const SPECIFICATION_ID = 'device.SPECIFICATION_ID';

	
	const CLIENT_ID = 'device.CLIENT_ID';

	
	const SERIAL_NUMBER = 'device.SERIAL_NUMBER';

	
	const LOCATION = 'device.LOCATION';

	
	const FREQUENCY = 'device.FREQUENCY';

	
	const STATUS = 'device.STATUS';

	
	const IDENTIFICATION = 'device.IDENTIFICATION';

	
	const CREATED_AT = 'device.CREATED_AT';

	
	const UPDATED_AT = 'device.UPDATED_AT';

	
	const COMMENTS = 'device.COMMENTS';

	
	const LAST_PM_DATE = 'device.LAST_PM_DATE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'SpecificationId', 'ClientId', 'SerialNumber', 'Location', 'Frequency', 'Status', 'Identification', 'CreatedAt', 'UpdatedAt', 'Comments', 'LastPmDate', ),
		BasePeer::TYPE_COLNAME => array (DevicePeer::ID, DevicePeer::SPECIFICATION_ID, DevicePeer::CLIENT_ID, DevicePeer::SERIAL_NUMBER, DevicePeer::LOCATION, DevicePeer::FREQUENCY, DevicePeer::STATUS, DevicePeer::IDENTIFICATION, DevicePeer::CREATED_AT, DevicePeer::UPDATED_AT, DevicePeer::COMMENTS, DevicePeer::LAST_PM_DATE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'specification_id', 'client_id', 'serial_number', 'location', 'frequency', 'status', 'identification', 'created_at', 'updated_at', 'comments', 'last_pm_date', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'SpecificationId' => 1, 'ClientId' => 2, 'SerialNumber' => 3, 'Location' => 4, 'Frequency' => 5, 'Status' => 6, 'Identification' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, 'Comments' => 10, 'LastPmDate' => 11, ),
		BasePeer::TYPE_COLNAME => array (DevicePeer::ID => 0, DevicePeer::SPECIFICATION_ID => 1, DevicePeer::CLIENT_ID => 2, DevicePeer::SERIAL_NUMBER => 3, DevicePeer::LOCATION => 4, DevicePeer::FREQUENCY => 5, DevicePeer::STATUS => 6, DevicePeer::IDENTIFICATION => 7, DevicePeer::CREATED_AT => 8, DevicePeer::UPDATED_AT => 9, DevicePeer::COMMENTS => 10, DevicePeer::LAST_PM_DATE => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'specification_id' => 1, 'client_id' => 2, 'serial_number' => 3, 'location' => 4, 'frequency' => 5, 'status' => 6, 'identification' => 7, 'created_at' => 8, 'updated_at' => 9, 'comments' => 10, 'last_pm_date' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/DeviceMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.DeviceMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = DevicePeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(DevicePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DevicePeer::ID);

		$criteria->addSelectColumn(DevicePeer::SPECIFICATION_ID);

		$criteria->addSelectColumn(DevicePeer::CLIENT_ID);

		$criteria->addSelectColumn(DevicePeer::SERIAL_NUMBER);

		$criteria->addSelectColumn(DevicePeer::LOCATION);

		$criteria->addSelectColumn(DevicePeer::FREQUENCY);

		$criteria->addSelectColumn(DevicePeer::STATUS);

		$criteria->addSelectColumn(DevicePeer::IDENTIFICATION);

		$criteria->addSelectColumn(DevicePeer::CREATED_AT);

		$criteria->addSelectColumn(DevicePeer::UPDATED_AT);

		$criteria->addSelectColumn(DevicePeer::COMMENTS);

		$criteria->addSelectColumn(DevicePeer::LAST_PM_DATE);

	}

	const COUNT = 'COUNT(device.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT device.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DevicePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DevicePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DevicePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = DevicePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DevicePeer::populateObjects(DevicePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DevicePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DevicePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinSpecification(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DevicePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DevicePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DevicePeer::SPECIFICATION_ID, SpecificationPeer::ID);

		$rs = DevicePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinClient(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DevicePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DevicePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DevicePeer::CLIENT_ID, ClientPeer::ID);

		$rs = DevicePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinSpecification(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DevicePeer::addSelectColumns($c);
		$startcol = (DevicePeer::NUM_COLUMNS - DevicePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SpecificationPeer::addSelectColumns($c);

		$c->addJoin(DevicePeer::SPECIFICATION_ID, SpecificationPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DevicePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SpecificationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getSpecification(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addDevice($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDevices();
				$obj2->addDevice($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinClient(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DevicePeer::addSelectColumns($c);
		$startcol = (DevicePeer::NUM_COLUMNS - DevicePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ClientPeer::addSelectColumns($c);

		$c->addJoin(DevicePeer::CLIENT_ID, ClientPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DevicePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ClientPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getClient(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addDevice($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDevices();
				$obj2->addDevice($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DevicePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DevicePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DevicePeer::SPECIFICATION_ID, SpecificationPeer::ID);

		$criteria->addJoin(DevicePeer::CLIENT_ID, ClientPeer::ID);

		$rs = DevicePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DevicePeer::addSelectColumns($c);
		$startcol2 = (DevicePeer::NUM_COLUMNS - DevicePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SpecificationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SpecificationPeer::NUM_COLUMNS;

		ClientPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ClientPeer::NUM_COLUMNS;

		$c->addJoin(DevicePeer::SPECIFICATION_ID, SpecificationPeer::ID);

		$c->addJoin(DevicePeer::CLIENT_ID, ClientPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DevicePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = SpecificationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSpecification(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDevice($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initDevices();
				$obj2->addDevice($obj1);
			}


					
			$omClass = ClientPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getClient(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDevice($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initDevices();
				$obj3->addDevice($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptSpecification(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DevicePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DevicePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DevicePeer::CLIENT_ID, ClientPeer::ID);

		$rs = DevicePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptClient(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DevicePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DevicePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DevicePeer::SPECIFICATION_ID, SpecificationPeer::ID);

		$rs = DevicePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptSpecification(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DevicePeer::addSelectColumns($c);
		$startcol2 = (DevicePeer::NUM_COLUMNS - DevicePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ClientPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ClientPeer::NUM_COLUMNS;

		$c->addJoin(DevicePeer::CLIENT_ID, ClientPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DevicePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ClientPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getClient(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDevice($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDevices();
				$obj2->addDevice($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptClient(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DevicePeer::addSelectColumns($c);
		$startcol2 = (DevicePeer::NUM_COLUMNS - DevicePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SpecificationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SpecificationPeer::NUM_COLUMNS;

		$c->addJoin(DevicePeer::SPECIFICATION_ID, SpecificationPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DevicePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SpecificationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSpecification(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDevice($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDevices();
				$obj2->addDevice($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return DevicePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(DevicePeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(DevicePeer::ID);
			$selectCriteria->add(DevicePeer::ID, $criteria->remove(DevicePeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(DevicePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(DevicePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Device) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(DevicePeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(Device $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DevicePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DevicePeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(DevicePeer::DATABASE_NAME, DevicePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DevicePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(DevicePeer::DATABASE_NAME);

		$criteria->add(DevicePeer::ID, $pk);


		$v = DevicePeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(DevicePeer::ID, $pks, Criteria::IN);
			$objs = DevicePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseDevicePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/DeviceMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.DeviceMapBuilder');
}
