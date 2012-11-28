<?php


abstract class BaseDeviceCheckupPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'device_checkup';

	
	const CLASS_DEFAULT = 'lib.model.DeviceCheckup';

	
	const NUM_COLUMNS = 14;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'device_checkup.ID';

	
	const DEVICE_ID = 'device_checkup.DEVICE_ID';

	
	const CLIENT_ID = 'device_checkup.CLIENT_ID';

	
	const DEVICE_IDENTIFICATION = 'device_checkup.DEVICE_IDENTIFICATION';

	
	const ROW_INDICATOR = 'device_checkup.ROW_INDICATOR';

	
	const DEVICE_TECH_ID = 'device_checkup.DEVICE_TECH_ID';

	
	const PASS_FAIL_CODE = 'device_checkup.PASS_FAIL_CODE';

	
	const REC_NUMBER = 'device_checkup.REC_NUMBER';

	
	const ROW_PURPOSE = 'device_checkup.ROW_PURPOSE';

	
	const PHYSICAL_INSPECTION = 'device_checkup.PHYSICAL_INSPECTION';

	
	const ROOM = 'device_checkup.ROOM';

	
	const TIME = 'device_checkup.TIME';

	
	const DATE = 'device_checkup.DATE';

	
	const PASS_FAIL = 'device_checkup.PASS_FAIL';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'DeviceId', 'ClientId', 'DeviceIdentification', 'RowIndicator', 'DeviceTechId', 'PassFailCode', 'RecNumber', 'RowPurpose', 'PhysicalInspection', 'Room', 'Time', 'Date', 'PassFail', ),
		BasePeer::TYPE_COLNAME => array (DeviceCheckupPeer::ID, DeviceCheckupPeer::DEVICE_ID, DeviceCheckupPeer::CLIENT_ID, DeviceCheckupPeer::DEVICE_IDENTIFICATION, DeviceCheckupPeer::ROW_INDICATOR, DeviceCheckupPeer::DEVICE_TECH_ID, DeviceCheckupPeer::PASS_FAIL_CODE, DeviceCheckupPeer::REC_NUMBER, DeviceCheckupPeer::ROW_PURPOSE, DeviceCheckupPeer::PHYSICAL_INSPECTION, DeviceCheckupPeer::ROOM, DeviceCheckupPeer::TIME, DeviceCheckupPeer::DATE, DeviceCheckupPeer::PASS_FAIL, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'device_id', 'client_id', 'device_identification', 'row_indicator', 'device_tech_id', 'pass_fail_code', 'rec_number', 'row_purpose', 'physical_inspection', 'room', 'time', 'date', 'pass_fail', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'DeviceId' => 1, 'ClientId' => 2, 'DeviceIdentification' => 3, 'RowIndicator' => 4, 'DeviceTechId' => 5, 'PassFailCode' => 6, 'RecNumber' => 7, 'RowPurpose' => 8, 'PhysicalInspection' => 9, 'Room' => 10, 'Time' => 11, 'Date' => 12, 'PassFail' => 13, ),
		BasePeer::TYPE_COLNAME => array (DeviceCheckupPeer::ID => 0, DeviceCheckupPeer::DEVICE_ID => 1, DeviceCheckupPeer::CLIENT_ID => 2, DeviceCheckupPeer::DEVICE_IDENTIFICATION => 3, DeviceCheckupPeer::ROW_INDICATOR => 4, DeviceCheckupPeer::DEVICE_TECH_ID => 5, DeviceCheckupPeer::PASS_FAIL_CODE => 6, DeviceCheckupPeer::REC_NUMBER => 7, DeviceCheckupPeer::ROW_PURPOSE => 8, DeviceCheckupPeer::PHYSICAL_INSPECTION => 9, DeviceCheckupPeer::ROOM => 10, DeviceCheckupPeer::TIME => 11, DeviceCheckupPeer::DATE => 12, DeviceCheckupPeer::PASS_FAIL => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'device_id' => 1, 'client_id' => 2, 'device_identification' => 3, 'row_indicator' => 4, 'device_tech_id' => 5, 'pass_fail_code' => 6, 'rec_number' => 7, 'row_purpose' => 8, 'physical_inspection' => 9, 'room' => 10, 'time' => 11, 'date' => 12, 'pass_fail' => 13, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/DeviceCheckupMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.DeviceCheckupMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = DeviceCheckupPeer::getTableMap();
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
		return str_replace(DeviceCheckupPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DeviceCheckupPeer::ID);

		$criteria->addSelectColumn(DeviceCheckupPeer::DEVICE_ID);

		$criteria->addSelectColumn(DeviceCheckupPeer::CLIENT_ID);

		$criteria->addSelectColumn(DeviceCheckupPeer::DEVICE_IDENTIFICATION);

		$criteria->addSelectColumn(DeviceCheckupPeer::ROW_INDICATOR);

		$criteria->addSelectColumn(DeviceCheckupPeer::DEVICE_TECH_ID);

		$criteria->addSelectColumn(DeviceCheckupPeer::PASS_FAIL_CODE);

		$criteria->addSelectColumn(DeviceCheckupPeer::REC_NUMBER);

		$criteria->addSelectColumn(DeviceCheckupPeer::ROW_PURPOSE);

		$criteria->addSelectColumn(DeviceCheckupPeer::PHYSICAL_INSPECTION);

		$criteria->addSelectColumn(DeviceCheckupPeer::ROOM);

		$criteria->addSelectColumn(DeviceCheckupPeer::TIME);

		$criteria->addSelectColumn(DeviceCheckupPeer::DATE);

		$criteria->addSelectColumn(DeviceCheckupPeer::PASS_FAIL);

	}

	const COUNT = 'COUNT(device_checkup.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT device_checkup.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DeviceCheckupPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DeviceCheckupPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DeviceCheckupPeer::doSelectRS($criteria, $con);
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
		$objects = DeviceCheckupPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DeviceCheckupPeer::populateObjects(DeviceCheckupPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DeviceCheckupPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DeviceCheckupPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinClient(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DeviceCheckupPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DeviceCheckupPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DeviceCheckupPeer::CLIENT_ID, ClientPeer::ID);

		$rs = DeviceCheckupPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinClient(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DeviceCheckupPeer::addSelectColumns($c);
		$startcol = (DeviceCheckupPeer::NUM_COLUMNS - DeviceCheckupPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ClientPeer::addSelectColumns($c);

		$c->addJoin(DeviceCheckupPeer::CLIENT_ID, ClientPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DeviceCheckupPeer::getOMClass();

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
										$temp_obj2->addDeviceCheckup($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDeviceCheckups();
				$obj2->addDeviceCheckup($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DeviceCheckupPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DeviceCheckupPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DeviceCheckupPeer::CLIENT_ID, ClientPeer::ID);

		$rs = DeviceCheckupPeer::doSelectRS($criteria, $con);
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

		DeviceCheckupPeer::addSelectColumns($c);
		$startcol2 = (DeviceCheckupPeer::NUM_COLUMNS - DeviceCheckupPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ClientPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ClientPeer::NUM_COLUMNS;

		$c->addJoin(DeviceCheckupPeer::CLIENT_ID, ClientPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DeviceCheckupPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = ClientPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getClient(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDeviceCheckup($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initDeviceCheckups();
				$obj2->addDeviceCheckup($obj1);
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
		return DeviceCheckupPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(DeviceCheckupPeer::ID); 

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
			$comparison = $criteria->getComparison(DeviceCheckupPeer::ID);
			$selectCriteria->add(DeviceCheckupPeer::ID, $criteria->remove(DeviceCheckupPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(DeviceCheckupPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(DeviceCheckupPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof DeviceCheckup) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(DeviceCheckupPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(DeviceCheckup $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DeviceCheckupPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DeviceCheckupPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(DeviceCheckupPeer::DATABASE_NAME, DeviceCheckupPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DeviceCheckupPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(DeviceCheckupPeer::DATABASE_NAME);

		$criteria->add(DeviceCheckupPeer::ID, $pk);


		$v = DeviceCheckupPeer::doSelect($criteria, $con);

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
			$criteria->add(DeviceCheckupPeer::ID, $pks, Criteria::IN);
			$objs = DeviceCheckupPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseDeviceCheckupPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/DeviceCheckupMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.DeviceCheckupMapBuilder');
}
