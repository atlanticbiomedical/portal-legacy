<?php


abstract class BaseTechDistancesPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tech_distances';

	
	const CLASS_DEFAULT = 'lib.model.TechDistances';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'tech_distances.ID';

	
	const TECH_ID = 'tech_distances.TECH_ID';

	
	const CLIENT_ID = 'tech_distances.CLIENT_ID';

	
	const TRAVEL_TIME_HOURS = 'tech_distances.TRAVEL_TIME_HOURS';

	
	const TRAVEL_TIME_MINS = 'tech_distances.TRAVEL_TIME_MINS';

	
	const TRAVEL_DISTANCE = 'tech_distances.TRAVEL_DISTANCE';

	
	const UPDATED_AT = 'tech_distances.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'TechId', 'ClientId', 'TravelTimeHours', 'TravelTimeMins', 'TravelDistance', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (TechDistancesPeer::ID, TechDistancesPeer::TECH_ID, TechDistancesPeer::CLIENT_ID, TechDistancesPeer::TRAVEL_TIME_HOURS, TechDistancesPeer::TRAVEL_TIME_MINS, TechDistancesPeer::TRAVEL_DISTANCE, TechDistancesPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'tech_id', 'client_id', 'travel_time_hours', 'travel_time_mins', 'travel_distance', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'TechId' => 1, 'ClientId' => 2, 'TravelTimeHours' => 3, 'TravelTimeMins' => 4, 'TravelDistance' => 5, 'UpdatedAt' => 6, ),
		BasePeer::TYPE_COLNAME => array (TechDistancesPeer::ID => 0, TechDistancesPeer::TECH_ID => 1, TechDistancesPeer::CLIENT_ID => 2, TechDistancesPeer::TRAVEL_TIME_HOURS => 3, TechDistancesPeer::TRAVEL_TIME_MINS => 4, TechDistancesPeer::TRAVEL_DISTANCE => 5, TechDistancesPeer::UPDATED_AT => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'tech_id' => 1, 'client_id' => 2, 'travel_time_hours' => 3, 'travel_time_mins' => 4, 'travel_distance' => 5, 'updated_at' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/TechDistancesMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.TechDistancesMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = TechDistancesPeer::getTableMap();
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
		return str_replace(TechDistancesPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(TechDistancesPeer::ID);

		$criteria->addSelectColumn(TechDistancesPeer::TECH_ID);

		$criteria->addSelectColumn(TechDistancesPeer::CLIENT_ID);

		$criteria->addSelectColumn(TechDistancesPeer::TRAVEL_TIME_HOURS);

		$criteria->addSelectColumn(TechDistancesPeer::TRAVEL_TIME_MINS);

		$criteria->addSelectColumn(TechDistancesPeer::TRAVEL_DISTANCE);

		$criteria->addSelectColumn(TechDistancesPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(tech_distances.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tech_distances.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TechDistancesPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TechDistancesPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = TechDistancesPeer::doSelectRS($criteria, $con);
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
		$objects = TechDistancesPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return TechDistancesPeer::populateObjects(TechDistancesPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			TechDistancesPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = TechDistancesPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return TechDistancesPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(TechDistancesPeer::ID); 

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
			$comparison = $criteria->getComparison(TechDistancesPeer::ID);
			$selectCriteria->add(TechDistancesPeer::ID, $criteria->remove(TechDistancesPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(TechDistancesPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(TechDistancesPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof TechDistances) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(TechDistancesPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(TechDistances $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(TechDistancesPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(TechDistancesPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(TechDistancesPeer::DATABASE_NAME, TechDistancesPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = TechDistancesPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(TechDistancesPeer::DATABASE_NAME);

		$criteria->add(TechDistancesPeer::ID, $pk);


		$v = TechDistancesPeer::doSelect($criteria, $con);

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
			$criteria->add(TechDistancesPeer::ID, $pks, Criteria::IN);
			$objs = TechDistancesPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseTechDistancesPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/TechDistancesMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.TechDistancesMapBuilder');
}
