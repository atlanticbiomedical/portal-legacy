<?php


abstract class BaseFinalDeviceReportPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'final_device_report';

	
	const CLASS_DEFAULT = 'lib.model.FinalDeviceReport';

	
	const NUM_COLUMNS = 13;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'final_device_report.ID';

	
	const CLIENT_ID = 'final_device_report.CLIENT_ID';

	
	const DATE = 'final_device_report.DATE';

	
	const PASS_FAIL = 'final_device_report.PASS_FAIL';

	
	const TOTAL_FAILED = 'final_device_report.TOTAL_FAILED';

	
	const TOTAL_PASSED = 'final_device_report.TOTAL_PASSED';

	
	const TOTAL_BP = 'final_device_report.TOTAL_BP';

	
	const TOTAL_TRACE = 'final_device_report.TOTAL_TRACE';

	
	const TOTAL_MISSED = 'final_device_report.TOTAL_MISSED';

	
	const TOTAL_OUTLETS = 'final_device_report.TOTAL_OUTLETS';

	
	const CONTACT = 'final_device_report.CONTACT';

	
	const CREATED_AT = 'final_device_report.CREATED_AT';

	
	const UPDATED_AT = 'final_device_report.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ClientId', 'Date', 'PassFail', 'TotalFailed', 'TotalPassed', 'TotalBp', 'TotalTrace', 'TotalMissed', 'TotalOutlets', 'Contact', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (FinalDeviceReportPeer::ID, FinalDeviceReportPeer::CLIENT_ID, FinalDeviceReportPeer::DATE, FinalDeviceReportPeer::PASS_FAIL, FinalDeviceReportPeer::TOTAL_FAILED, FinalDeviceReportPeer::TOTAL_PASSED, FinalDeviceReportPeer::TOTAL_BP, FinalDeviceReportPeer::TOTAL_TRACE, FinalDeviceReportPeer::TOTAL_MISSED, FinalDeviceReportPeer::TOTAL_OUTLETS, FinalDeviceReportPeer::CONTACT, FinalDeviceReportPeer::CREATED_AT, FinalDeviceReportPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'client_id', 'date', 'pass_fail', 'total_failed', 'total_passed', 'total_bp', 'total_trace', 'total_missed', 'total_outlets', 'contact', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ClientId' => 1, 'Date' => 2, 'PassFail' => 3, 'TotalFailed' => 4, 'TotalPassed' => 5, 'TotalBp' => 6, 'TotalTrace' => 7, 'TotalMissed' => 8, 'TotalOutlets' => 9, 'Contact' => 10, 'CreatedAt' => 11, 'UpdatedAt' => 12, ),
		BasePeer::TYPE_COLNAME => array (FinalDeviceReportPeer::ID => 0, FinalDeviceReportPeer::CLIENT_ID => 1, FinalDeviceReportPeer::DATE => 2, FinalDeviceReportPeer::PASS_FAIL => 3, FinalDeviceReportPeer::TOTAL_FAILED => 4, FinalDeviceReportPeer::TOTAL_PASSED => 5, FinalDeviceReportPeer::TOTAL_BP => 6, FinalDeviceReportPeer::TOTAL_TRACE => 7, FinalDeviceReportPeer::TOTAL_MISSED => 8, FinalDeviceReportPeer::TOTAL_OUTLETS => 9, FinalDeviceReportPeer::CONTACT => 10, FinalDeviceReportPeer::CREATED_AT => 11, FinalDeviceReportPeer::UPDATED_AT => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'client_id' => 1, 'date' => 2, 'pass_fail' => 3, 'total_failed' => 4, 'total_passed' => 5, 'total_bp' => 6, 'total_trace' => 7, 'total_missed' => 8, 'total_outlets' => 9, 'contact' => 10, 'created_at' => 11, 'updated_at' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/FinalDeviceReportMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.FinalDeviceReportMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = FinalDeviceReportPeer::getTableMap();
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
		return str_replace(FinalDeviceReportPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(FinalDeviceReportPeer::ID);

		$criteria->addSelectColumn(FinalDeviceReportPeer::CLIENT_ID);

		$criteria->addSelectColumn(FinalDeviceReportPeer::DATE);

		$criteria->addSelectColumn(FinalDeviceReportPeer::PASS_FAIL);

		$criteria->addSelectColumn(FinalDeviceReportPeer::TOTAL_FAILED);

		$criteria->addSelectColumn(FinalDeviceReportPeer::TOTAL_PASSED);

		$criteria->addSelectColumn(FinalDeviceReportPeer::TOTAL_BP);

		$criteria->addSelectColumn(FinalDeviceReportPeer::TOTAL_TRACE);

		$criteria->addSelectColumn(FinalDeviceReportPeer::TOTAL_MISSED);

		$criteria->addSelectColumn(FinalDeviceReportPeer::TOTAL_OUTLETS);

		$criteria->addSelectColumn(FinalDeviceReportPeer::CONTACT);

		$criteria->addSelectColumn(FinalDeviceReportPeer::CREATED_AT);

		$criteria->addSelectColumn(FinalDeviceReportPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(final_device_report.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT final_device_report.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FinalDeviceReportPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FinalDeviceReportPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = FinalDeviceReportPeer::doSelectRS($criteria, $con);
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
		$objects = FinalDeviceReportPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return FinalDeviceReportPeer::populateObjects(FinalDeviceReportPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			FinalDeviceReportPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = FinalDeviceReportPeer::getOMClass();
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
		return FinalDeviceReportPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(FinalDeviceReportPeer::ID); 

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
			$comparison = $criteria->getComparison(FinalDeviceReportPeer::ID);
			$selectCriteria->add(FinalDeviceReportPeer::ID, $criteria->remove(FinalDeviceReportPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(FinalDeviceReportPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(FinalDeviceReportPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof FinalDeviceReport) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(FinalDeviceReportPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(FinalDeviceReport $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(FinalDeviceReportPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(FinalDeviceReportPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(FinalDeviceReportPeer::DATABASE_NAME, FinalDeviceReportPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = FinalDeviceReportPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(FinalDeviceReportPeer::DATABASE_NAME);

		$criteria->add(FinalDeviceReportPeer::ID, $pk);


		$v = FinalDeviceReportPeer::doSelect($criteria, $con);

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
			$criteria->add(FinalDeviceReportPeer::ID, $pks, Criteria::IN);
			$objs = FinalDeviceReportPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseFinalDeviceReportPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/FinalDeviceReportMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.FinalDeviceReportMapBuilder');
}
