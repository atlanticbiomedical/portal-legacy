<?php


abstract class BaseDeviceTestDataPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'device_test_data';

	
	const CLASS_DEFAULT = 'lib.model.DeviceTestData';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'device_test_data.ID';

	
	const DEVICE_CHECKUP_ID = 'device_test_data.DEVICE_CHECKUP_ID';

	
	const NAME = 'device_test_data.NAME';

	
	const TYPE = 'device_test_data.TYPE';

	
	const VALUE = 'device_test_data.VALUE';

	
	const PASSFAIL = 'device_test_data.PASSFAIL';

	
	const UNIT = 'device_test_data.UNIT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'DeviceCheckupId', 'Name', 'Type', 'Value', 'Passfail', 'Unit', ),
		BasePeer::TYPE_COLNAME => array (DeviceTestDataPeer::ID, DeviceTestDataPeer::DEVICE_CHECKUP_ID, DeviceTestDataPeer::NAME, DeviceTestDataPeer::TYPE, DeviceTestDataPeer::VALUE, DeviceTestDataPeer::PASSFAIL, DeviceTestDataPeer::UNIT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'device_checkup_id', 'name', 'type', 'value', 'passFail', 'unit', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'DeviceCheckupId' => 1, 'Name' => 2, 'Type' => 3, 'Value' => 4, 'Passfail' => 5, 'Unit' => 6, ),
		BasePeer::TYPE_COLNAME => array (DeviceTestDataPeer::ID => 0, DeviceTestDataPeer::DEVICE_CHECKUP_ID => 1, DeviceTestDataPeer::NAME => 2, DeviceTestDataPeer::TYPE => 3, DeviceTestDataPeer::VALUE => 4, DeviceTestDataPeer::PASSFAIL => 5, DeviceTestDataPeer::UNIT => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'device_checkup_id' => 1, 'name' => 2, 'type' => 3, 'value' => 4, 'passFail' => 5, 'unit' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/DeviceTestDataMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.DeviceTestDataMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = DeviceTestDataPeer::getTableMap();
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
		return str_replace(DeviceTestDataPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DeviceTestDataPeer::ID);

		$criteria->addSelectColumn(DeviceTestDataPeer::DEVICE_CHECKUP_ID);

		$criteria->addSelectColumn(DeviceTestDataPeer::NAME);

		$criteria->addSelectColumn(DeviceTestDataPeer::TYPE);

		$criteria->addSelectColumn(DeviceTestDataPeer::VALUE);

		$criteria->addSelectColumn(DeviceTestDataPeer::PASSFAIL);

		$criteria->addSelectColumn(DeviceTestDataPeer::UNIT);

	}

	const COUNT = 'COUNT(device_test_data.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT device_test_data.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DeviceTestDataPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DeviceTestDataPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DeviceTestDataPeer::doSelectRS($criteria, $con);
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
		$objects = DeviceTestDataPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DeviceTestDataPeer::populateObjects(DeviceTestDataPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DeviceTestDataPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DeviceTestDataPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinDeviceCheckup(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DeviceTestDataPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DeviceTestDataPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DeviceTestDataPeer::DEVICE_CHECKUP_ID, DeviceCheckupPeer::ID);

		$rs = DeviceTestDataPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinDeviceCheckup(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DeviceTestDataPeer::addSelectColumns($c);
		$startcol = (DeviceTestDataPeer::NUM_COLUMNS - DeviceTestDataPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DeviceCheckupPeer::addSelectColumns($c);

		$c->addJoin(DeviceTestDataPeer::DEVICE_CHECKUP_ID, DeviceCheckupPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DeviceTestDataPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DeviceCheckupPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getDeviceCheckup(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addDeviceTestData($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDeviceTestDatas();
				$obj2->addDeviceTestData($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DeviceTestDataPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DeviceTestDataPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DeviceTestDataPeer::DEVICE_CHECKUP_ID, DeviceCheckupPeer::ID);

		$rs = DeviceTestDataPeer::doSelectRS($criteria, $con);
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

		DeviceTestDataPeer::addSelectColumns($c);
		$startcol2 = (DeviceTestDataPeer::NUM_COLUMNS - DeviceTestDataPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DeviceCheckupPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DeviceCheckupPeer::NUM_COLUMNS;

		$c->addJoin(DeviceTestDataPeer::DEVICE_CHECKUP_ID, DeviceCheckupPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DeviceTestDataPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = DeviceCheckupPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDeviceCheckup(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDeviceTestData($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initDeviceTestDatas();
				$obj2->addDeviceTestData($obj1);
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
		return DeviceTestDataPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(DeviceTestDataPeer::ID); 

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
			$comparison = $criteria->getComparison(DeviceTestDataPeer::ID);
			$selectCriteria->add(DeviceTestDataPeer::ID, $criteria->remove(DeviceTestDataPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(DeviceTestDataPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(DeviceTestDataPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof DeviceTestData) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(DeviceTestDataPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(DeviceTestData $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DeviceTestDataPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DeviceTestDataPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(DeviceTestDataPeer::DATABASE_NAME, DeviceTestDataPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DeviceTestDataPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(DeviceTestDataPeer::DATABASE_NAME);

		$criteria->add(DeviceTestDataPeer::ID, $pk);


		$v = DeviceTestDataPeer::doSelect($criteria, $con);

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
			$criteria->add(DeviceTestDataPeer::ID, $pks, Criteria::IN);
			$objs = DeviceTestDataPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseDeviceTestDataPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/DeviceTestDataMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.DeviceTestDataMapBuilder');
}
