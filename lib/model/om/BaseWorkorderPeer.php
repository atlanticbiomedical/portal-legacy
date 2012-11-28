<?php


abstract class BaseWorkorderPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'workorder';

	
	const CLASS_DEFAULT = 'lib.model.Workorder';

	
	const NUM_COLUMNS = 32;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'workorder.ID';

	
	const DEVICE_ID = 'workorder.DEVICE_ID';

	
	const CLIENT_ID = 'workorder.CLIENT_ID';

	
	const TECH = 'workorder.TECH';

	
	const OFFICE = 'workorder.OFFICE';

	
	const ASSIGNED_BY = 'workorder.ASSIGNED_BY';

	
	const PAGE_NUMBER = 'workorder.PAGE_NUMBER';

	
	const TRAVEL_TIME = 'workorder.TRAVEL_TIME';

	
	const ONSITE_TIME = 'workorder.ONSITE_TIME';

	
	const ZIP = 'workorder.ZIP';

	
	const DATE_RECIEVED = 'workorder.DATE_RECIEVED';

	
	const DATE_COMPLETED = 'workorder.DATE_COMPLETED';

	
	const INVOICE = 'workorder.INVOICE';

	
	const REASON = 'workorder.REASON';

	
	const ACTION_TAKEN = 'workorder.ACTION_TAKEN';

	
	const REMARKS = 'workorder.REMARKS';

	
	const JOB_DATE = 'workorder.JOB_DATE';

	
	const JOB_START = 'workorder.JOB_START';

	
	const JOB_END = 'workorder.JOB_END';

	
	const EXACT_TIME = 'workorder.EXACT_TIME';

	
	const SALE_TAX = 'workorder.SALE_TAX';

	
	const ZONE_CHARGE = 'workorder.ZONE_CHARGE';

	
	const SHIPPING_HANDLING = 'workorder.SHIPPING_HANDLING';

	
	const TOTAL = 'workorder.TOTAL';

	
	const SERVICE_TRAVEL = 'workorder.SERVICE_TRAVEL';

	
	const CREATED_AT = 'workorder.CREATED_AT';

	
	const UPDATED_AT = 'workorder.UPDATED_AT';

	
	const JOB_STATUS_ID = 'workorder.JOB_STATUS_ID';

	
	const JOB_TYPE_ID = 'workorder.JOB_TYPE_ID';

	
	const WORKORDER_TYPE_ID = 'workorder.WORKORDER_TYPE_ID';

	
	const CALLER = 'workorder.CALLER';

	
	const JOB_SCHEDULED_DATE = 'workorder.JOB_SCHEDULED_DATE';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'DeviceId', 'ClientId', 'Tech', 'Office', 'AssignedBy', 'PageNumber', 'TravelTime', 'OnsiteTime', 'Zip', 'DateRecieved', 'DateCompleted', 'Invoice', 'Reason', 'ActionTaken', 'Remarks', 'JobDate', 'JobStart', 'JobEnd', 'ExactTime', 'SaleTax', 'ZoneCharge', 'ShippingHandling', 'Total', 'ServiceTravel', 'CreatedAt', 'UpdatedAt', 'JobStatusId', 'JobTypeId', 'WorkorderTypeId', 'Caller', 'JobScheduledDate', ),
		BasePeer::TYPE_COLNAME => array (WorkorderPeer::ID, WorkorderPeer::DEVICE_ID, WorkorderPeer::CLIENT_ID, WorkorderPeer::TECH, WorkorderPeer::OFFICE, WorkorderPeer::ASSIGNED_BY, WorkorderPeer::PAGE_NUMBER, WorkorderPeer::TRAVEL_TIME, WorkorderPeer::ONSITE_TIME, WorkorderPeer::ZIP, WorkorderPeer::DATE_RECIEVED, WorkorderPeer::DATE_COMPLETED, WorkorderPeer::INVOICE, WorkorderPeer::REASON, WorkorderPeer::ACTION_TAKEN, WorkorderPeer::REMARKS, WorkorderPeer::JOB_DATE, WorkorderPeer::JOB_START, WorkorderPeer::JOB_END, WorkorderPeer::EXACT_TIME, WorkorderPeer::SALE_TAX, WorkorderPeer::ZONE_CHARGE, WorkorderPeer::SHIPPING_HANDLING, WorkorderPeer::TOTAL, WorkorderPeer::SERVICE_TRAVEL, WorkorderPeer::CREATED_AT, WorkorderPeer::UPDATED_AT, WorkorderPeer::JOB_STATUS_ID, WorkorderPeer::JOB_TYPE_ID, WorkorderPeer::WORKORDER_TYPE_ID, WorkorderPeer::CALLER, WorkorderPeer::JOB_SCHEDULED_DATE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'device_id', 'client_id', 'tech', 'office', 'assigned_by', 'page_number', 'travel_time', 'onsite_time', 'zip', 'date_recieved', 'date_completed', 'invoice', 'reason', 'action_taken', 'remarks', 'job_date', 'job_start', 'job_end', 'exact_time', 'sale_tax', 'zone_charge', 'shipping_handling', 'total', 'service_travel', 'created_at', 'updated_at', 'job_status_id', 'job_type_id', 'workorder_type_id', 'caller', 'job_scheduled_date', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'DeviceId' => 1, 'ClientId' => 2, 'Tech' => 3, 'Office' => 4, 'AssignedBy' => 5, 'PageNumber' => 6, 'TravelTime' => 7, 'OnsiteTime' => 8, 'Zip' => 9, 'DateRecieved' => 10, 'DateCompleted' => 11, 'Invoice' => 12, 'Reason' => 13, 'ActionTaken' => 14, 'Remarks' => 15, 'JobDate' => 16, 'JobStart' => 17, 'JobEnd' => 18, 'ExactTime' => 19, 'SaleTax' => 20, 'ZoneCharge' => 21, 'ShippingHandling' => 22, 'Total' => 23, 'ServiceTravel' => 24, 'CreatedAt' => 25, 'UpdatedAt' => 26, 'JobStatusId' => 27, 'JobTypeId' => 28, 'WorkorderTypeId' => 29, 'Caller' => 30, 'JobScheduledDate' => 31, ),
		BasePeer::TYPE_COLNAME => array (WorkorderPeer::ID => 0, WorkorderPeer::DEVICE_ID => 1, WorkorderPeer::CLIENT_ID => 2, WorkorderPeer::TECH => 3, WorkorderPeer::OFFICE => 4, WorkorderPeer::ASSIGNED_BY => 5, WorkorderPeer::PAGE_NUMBER => 6, WorkorderPeer::TRAVEL_TIME => 7, WorkorderPeer::ONSITE_TIME => 8, WorkorderPeer::ZIP => 9, WorkorderPeer::DATE_RECIEVED => 10, WorkorderPeer::DATE_COMPLETED => 11, WorkorderPeer::INVOICE => 12, WorkorderPeer::REASON => 13, WorkorderPeer::ACTION_TAKEN => 14, WorkorderPeer::REMARKS => 15, WorkorderPeer::JOB_DATE => 16, WorkorderPeer::JOB_START => 17, WorkorderPeer::JOB_END => 18, WorkorderPeer::EXACT_TIME => 19, WorkorderPeer::SALE_TAX => 20, WorkorderPeer::ZONE_CHARGE => 21, WorkorderPeer::SHIPPING_HANDLING => 22, WorkorderPeer::TOTAL => 23, WorkorderPeer::SERVICE_TRAVEL => 24, WorkorderPeer::CREATED_AT => 25, WorkorderPeer::UPDATED_AT => 26, WorkorderPeer::JOB_STATUS_ID => 27, WorkorderPeer::JOB_TYPE_ID => 28, WorkorderPeer::WORKORDER_TYPE_ID => 29, WorkorderPeer::CALLER => 30, WorkorderPeer::JOB_SCHEDULED_DATE => 31, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'device_id' => 1, 'client_id' => 2, 'tech' => 3, 'office' => 4, 'assigned_by' => 5, 'page_number' => 6, 'travel_time' => 7, 'onsite_time' => 8, 'zip' => 9, 'date_recieved' => 10, 'date_completed' => 11, 'invoice' => 12, 'reason' => 13, 'action_taken' => 14, 'remarks' => 15, 'job_date' => 16, 'job_start' => 17, 'job_end' => 18, 'exact_time' => 19, 'sale_tax' => 20, 'zone_charge' => 21, 'shipping_handling' => 22, 'total' => 23, 'service_travel' => 24, 'created_at' => 25, 'updated_at' => 26, 'job_status_id' => 27, 'job_type_id' => 28, 'workorder_type_id' => 29, 'caller' => 30, 'job_scheduled_date' => 31, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/WorkorderMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.WorkorderMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = WorkorderPeer::getTableMap();
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
		return str_replace(WorkorderPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(WorkorderPeer::ID);

		$criteria->addSelectColumn(WorkorderPeer::DEVICE_ID);

		$criteria->addSelectColumn(WorkorderPeer::CLIENT_ID);

		$criteria->addSelectColumn(WorkorderPeer::TECH);

		$criteria->addSelectColumn(WorkorderPeer::OFFICE);

		$criteria->addSelectColumn(WorkorderPeer::ASSIGNED_BY);

		$criteria->addSelectColumn(WorkorderPeer::PAGE_NUMBER);

		$criteria->addSelectColumn(WorkorderPeer::TRAVEL_TIME);

		$criteria->addSelectColumn(WorkorderPeer::ONSITE_TIME);

		$criteria->addSelectColumn(WorkorderPeer::ZIP);

		$criteria->addSelectColumn(WorkorderPeer::DATE_RECIEVED);

		$criteria->addSelectColumn(WorkorderPeer::DATE_COMPLETED);

		$criteria->addSelectColumn(WorkorderPeer::INVOICE);

		$criteria->addSelectColumn(WorkorderPeer::REASON);

		$criteria->addSelectColumn(WorkorderPeer::ACTION_TAKEN);

		$criteria->addSelectColumn(WorkorderPeer::REMARKS);

		$criteria->addSelectColumn(WorkorderPeer::JOB_DATE);

		$criteria->addSelectColumn(WorkorderPeer::JOB_START);

		$criteria->addSelectColumn(WorkorderPeer::JOB_END);

		$criteria->addSelectColumn(WorkorderPeer::EXACT_TIME);

		$criteria->addSelectColumn(WorkorderPeer::SALE_TAX);

		$criteria->addSelectColumn(WorkorderPeer::ZONE_CHARGE);

		$criteria->addSelectColumn(WorkorderPeer::SHIPPING_HANDLING);

		$criteria->addSelectColumn(WorkorderPeer::TOTAL);

		$criteria->addSelectColumn(WorkorderPeer::SERVICE_TRAVEL);

		$criteria->addSelectColumn(WorkorderPeer::CREATED_AT);

		$criteria->addSelectColumn(WorkorderPeer::UPDATED_AT);

		$criteria->addSelectColumn(WorkorderPeer::JOB_STATUS_ID);

		$criteria->addSelectColumn(WorkorderPeer::JOB_TYPE_ID);

		$criteria->addSelectColumn(WorkorderPeer::WORKORDER_TYPE_ID);

		$criteria->addSelectColumn(WorkorderPeer::CALLER);

		$criteria->addSelectColumn(WorkorderPeer::JOB_SCHEDULED_DATE);

	}

	const COUNT = 'COUNT(workorder.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT workorder.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WorkorderPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkorderPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = WorkorderPeer::doSelectRS($criteria, $con);
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
		$objects = WorkorderPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return WorkorderPeer::populateObjects(WorkorderPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			WorkorderPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = WorkorderPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinDevice(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WorkorderPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkorderPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WorkorderPeer::DEVICE_ID, DevicePeer::ID);

		$rs = WorkorderPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(WorkorderPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkorderPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WorkorderPeer::CLIENT_ID, ClientPeer::ID);

		$rs = WorkorderPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinJobStatus(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WorkorderPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkorderPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WorkorderPeer::JOB_STATUS_ID, JobStatusPeer::ID);

		$rs = WorkorderPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinJobType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WorkorderPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkorderPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WorkorderPeer::JOB_TYPE_ID, JobTypePeer::ID);

		$rs = WorkorderPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinWorkorderType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WorkorderPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkorderPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WorkorderPeer::WORKORDER_TYPE_ID, WorkorderTypePeer::ID);

		$rs = WorkorderPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinDevice(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		WorkorderPeer::addSelectColumns($c);
		$startcol = (WorkorderPeer::NUM_COLUMNS - WorkorderPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DevicePeer::addSelectColumns($c);

		$c->addJoin(WorkorderPeer::DEVICE_ID, DevicePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WorkorderPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DevicePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getDevice(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addWorkorder($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initWorkorders();
				$obj2->addWorkorder($obj1); 			}
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

		WorkorderPeer::addSelectColumns($c);
		$startcol = (WorkorderPeer::NUM_COLUMNS - WorkorderPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ClientPeer::addSelectColumns($c);

		$c->addJoin(WorkorderPeer::CLIENT_ID, ClientPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WorkorderPeer::getOMClass();

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
										$temp_obj2->addWorkorder($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initWorkorders();
				$obj2->addWorkorder($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinJobStatus(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		WorkorderPeer::addSelectColumns($c);
		$startcol = (WorkorderPeer::NUM_COLUMNS - WorkorderPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		JobStatusPeer::addSelectColumns($c);

		$c->addJoin(WorkorderPeer::JOB_STATUS_ID, JobStatusPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WorkorderPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = JobStatusPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getJobStatus(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addWorkorder($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initWorkorders();
				$obj2->addWorkorder($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinJobType(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		WorkorderPeer::addSelectColumns($c);
		$startcol = (WorkorderPeer::NUM_COLUMNS - WorkorderPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		JobTypePeer::addSelectColumns($c);

		$c->addJoin(WorkorderPeer::JOB_TYPE_ID, JobTypePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WorkorderPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = JobTypePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getJobType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addWorkorder($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initWorkorders();
				$obj2->addWorkorder($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinWorkorderType(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		WorkorderPeer::addSelectColumns($c);
		$startcol = (WorkorderPeer::NUM_COLUMNS - WorkorderPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		WorkorderTypePeer::addSelectColumns($c);

		$c->addJoin(WorkorderPeer::WORKORDER_TYPE_ID, WorkorderTypePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WorkorderPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = WorkorderTypePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getWorkorderType(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addWorkorder($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initWorkorders();
				$obj2->addWorkorder($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WorkorderPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkorderPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WorkorderPeer::DEVICE_ID, DevicePeer::ID);

		$criteria->addJoin(WorkorderPeer::CLIENT_ID, ClientPeer::ID);

		$criteria->addJoin(WorkorderPeer::JOB_STATUS_ID, JobStatusPeer::ID);

		$criteria->addJoin(WorkorderPeer::JOB_TYPE_ID, JobTypePeer::ID);

		$criteria->addJoin(WorkorderPeer::WORKORDER_TYPE_ID, WorkorderTypePeer::ID);

		$rs = WorkorderPeer::doSelectRS($criteria, $con);
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

		WorkorderPeer::addSelectColumns($c);
		$startcol2 = (WorkorderPeer::NUM_COLUMNS - WorkorderPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DevicePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DevicePeer::NUM_COLUMNS;

		ClientPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ClientPeer::NUM_COLUMNS;

		JobStatusPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + JobStatusPeer::NUM_COLUMNS;

		JobTypePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + JobTypePeer::NUM_COLUMNS;

		WorkorderTypePeer::addSelectColumns($c);
		$startcol7 = $startcol6 + WorkorderTypePeer::NUM_COLUMNS;

		$c->addJoin(WorkorderPeer::DEVICE_ID, DevicePeer::ID);

		$c->addJoin(WorkorderPeer::CLIENT_ID, ClientPeer::ID);

		$c->addJoin(WorkorderPeer::JOB_STATUS_ID, JobStatusPeer::ID);

		$c->addJoin(WorkorderPeer::JOB_TYPE_ID, JobTypePeer::ID);

		$c->addJoin(WorkorderPeer::WORKORDER_TYPE_ID, WorkorderTypePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WorkorderPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = DevicePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDevice(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addWorkorder($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initWorkorders();
				$obj2->addWorkorder($obj1);
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
					$temp_obj3->addWorkorder($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initWorkorders();
				$obj3->addWorkorder($obj1);
			}


					
			$omClass = JobStatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getJobStatus(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addWorkorder($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initWorkorders();
				$obj4->addWorkorder($obj1);
			}


					
			$omClass = JobTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getJobType(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addWorkorder($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initWorkorders();
				$obj5->addWorkorder($obj1);
			}


					
			$omClass = WorkorderTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getWorkorderType(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addWorkorder($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj6->initWorkorders();
				$obj6->addWorkorder($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptDevice(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WorkorderPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkorderPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WorkorderPeer::CLIENT_ID, ClientPeer::ID);

		$criteria->addJoin(WorkorderPeer::JOB_STATUS_ID, JobStatusPeer::ID);

		$criteria->addJoin(WorkorderPeer::JOB_TYPE_ID, JobTypePeer::ID);

		$criteria->addJoin(WorkorderPeer::WORKORDER_TYPE_ID, WorkorderTypePeer::ID);

		$rs = WorkorderPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(WorkorderPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkorderPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WorkorderPeer::DEVICE_ID, DevicePeer::ID);

		$criteria->addJoin(WorkorderPeer::JOB_STATUS_ID, JobStatusPeer::ID);

		$criteria->addJoin(WorkorderPeer::JOB_TYPE_ID, JobTypePeer::ID);

		$criteria->addJoin(WorkorderPeer::WORKORDER_TYPE_ID, WorkorderTypePeer::ID);

		$rs = WorkorderPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptJobStatus(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WorkorderPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkorderPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WorkorderPeer::DEVICE_ID, DevicePeer::ID);

		$criteria->addJoin(WorkorderPeer::CLIENT_ID, ClientPeer::ID);

		$criteria->addJoin(WorkorderPeer::JOB_TYPE_ID, JobTypePeer::ID);

		$criteria->addJoin(WorkorderPeer::WORKORDER_TYPE_ID, WorkorderTypePeer::ID);

		$rs = WorkorderPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptJobType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WorkorderPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkorderPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WorkorderPeer::DEVICE_ID, DevicePeer::ID);

		$criteria->addJoin(WorkorderPeer::CLIENT_ID, ClientPeer::ID);

		$criteria->addJoin(WorkorderPeer::JOB_STATUS_ID, JobStatusPeer::ID);

		$criteria->addJoin(WorkorderPeer::WORKORDER_TYPE_ID, WorkorderTypePeer::ID);

		$rs = WorkorderPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptWorkorderType(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(WorkorderPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(WorkorderPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(WorkorderPeer::DEVICE_ID, DevicePeer::ID);

		$criteria->addJoin(WorkorderPeer::CLIENT_ID, ClientPeer::ID);

		$criteria->addJoin(WorkorderPeer::JOB_STATUS_ID, JobStatusPeer::ID);

		$criteria->addJoin(WorkorderPeer::JOB_TYPE_ID, JobTypePeer::ID);

		$rs = WorkorderPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptDevice(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		WorkorderPeer::addSelectColumns($c);
		$startcol2 = (WorkorderPeer::NUM_COLUMNS - WorkorderPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ClientPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ClientPeer::NUM_COLUMNS;

		JobStatusPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + JobStatusPeer::NUM_COLUMNS;

		JobTypePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + JobTypePeer::NUM_COLUMNS;

		WorkorderTypePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + WorkorderTypePeer::NUM_COLUMNS;

		$c->addJoin(WorkorderPeer::CLIENT_ID, ClientPeer::ID);

		$c->addJoin(WorkorderPeer::JOB_STATUS_ID, JobStatusPeer::ID);

		$c->addJoin(WorkorderPeer::JOB_TYPE_ID, JobTypePeer::ID);

		$c->addJoin(WorkorderPeer::WORKORDER_TYPE_ID, WorkorderTypePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WorkorderPeer::getOMClass();

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
					$temp_obj2->addWorkorder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initWorkorders();
				$obj2->addWorkorder($obj1);
			}

			$omClass = JobStatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getJobStatus(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addWorkorder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initWorkorders();
				$obj3->addWorkorder($obj1);
			}

			$omClass = JobTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getJobType(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addWorkorder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initWorkorders();
				$obj4->addWorkorder($obj1);
			}

			$omClass = WorkorderTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getWorkorderType(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addWorkorder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initWorkorders();
				$obj5->addWorkorder($obj1);
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

		WorkorderPeer::addSelectColumns($c);
		$startcol2 = (WorkorderPeer::NUM_COLUMNS - WorkorderPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DevicePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DevicePeer::NUM_COLUMNS;

		JobStatusPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + JobStatusPeer::NUM_COLUMNS;

		JobTypePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + JobTypePeer::NUM_COLUMNS;

		WorkorderTypePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + WorkorderTypePeer::NUM_COLUMNS;

		$c->addJoin(WorkorderPeer::DEVICE_ID, DevicePeer::ID);

		$c->addJoin(WorkorderPeer::JOB_STATUS_ID, JobStatusPeer::ID);

		$c->addJoin(WorkorderPeer::JOB_TYPE_ID, JobTypePeer::ID);

		$c->addJoin(WorkorderPeer::WORKORDER_TYPE_ID, WorkorderTypePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WorkorderPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DevicePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDevice(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addWorkorder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initWorkorders();
				$obj2->addWorkorder($obj1);
			}

			$omClass = JobStatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getJobStatus(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addWorkorder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initWorkorders();
				$obj3->addWorkorder($obj1);
			}

			$omClass = JobTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getJobType(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addWorkorder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initWorkorders();
				$obj4->addWorkorder($obj1);
			}

			$omClass = WorkorderTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getWorkorderType(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addWorkorder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initWorkorders();
				$obj5->addWorkorder($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptJobStatus(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		WorkorderPeer::addSelectColumns($c);
		$startcol2 = (WorkorderPeer::NUM_COLUMNS - WorkorderPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DevicePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DevicePeer::NUM_COLUMNS;

		ClientPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ClientPeer::NUM_COLUMNS;

		JobTypePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + JobTypePeer::NUM_COLUMNS;

		WorkorderTypePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + WorkorderTypePeer::NUM_COLUMNS;

		$c->addJoin(WorkorderPeer::DEVICE_ID, DevicePeer::ID);

		$c->addJoin(WorkorderPeer::CLIENT_ID, ClientPeer::ID);

		$c->addJoin(WorkorderPeer::JOB_TYPE_ID, JobTypePeer::ID);

		$c->addJoin(WorkorderPeer::WORKORDER_TYPE_ID, WorkorderTypePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WorkorderPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DevicePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDevice(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addWorkorder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initWorkorders();
				$obj2->addWorkorder($obj1);
			}

			$omClass = ClientPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getClient(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addWorkorder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initWorkorders();
				$obj3->addWorkorder($obj1);
			}

			$omClass = JobTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getJobType(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addWorkorder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initWorkorders();
				$obj4->addWorkorder($obj1);
			}

			$omClass = WorkorderTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getWorkorderType(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addWorkorder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initWorkorders();
				$obj5->addWorkorder($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptJobType(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		WorkorderPeer::addSelectColumns($c);
		$startcol2 = (WorkorderPeer::NUM_COLUMNS - WorkorderPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DevicePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DevicePeer::NUM_COLUMNS;

		ClientPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ClientPeer::NUM_COLUMNS;

		JobStatusPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + JobStatusPeer::NUM_COLUMNS;

		WorkorderTypePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + WorkorderTypePeer::NUM_COLUMNS;

		$c->addJoin(WorkorderPeer::DEVICE_ID, DevicePeer::ID);

		$c->addJoin(WorkorderPeer::CLIENT_ID, ClientPeer::ID);

		$c->addJoin(WorkorderPeer::JOB_STATUS_ID, JobStatusPeer::ID);

		$c->addJoin(WorkorderPeer::WORKORDER_TYPE_ID, WorkorderTypePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WorkorderPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DevicePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDevice(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addWorkorder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initWorkorders();
				$obj2->addWorkorder($obj1);
			}

			$omClass = ClientPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getClient(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addWorkorder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initWorkorders();
				$obj3->addWorkorder($obj1);
			}

			$omClass = JobStatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getJobStatus(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addWorkorder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initWorkorders();
				$obj4->addWorkorder($obj1);
			}

			$omClass = WorkorderTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getWorkorderType(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addWorkorder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initWorkorders();
				$obj5->addWorkorder($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptWorkorderType(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		WorkorderPeer::addSelectColumns($c);
		$startcol2 = (WorkorderPeer::NUM_COLUMNS - WorkorderPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DevicePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DevicePeer::NUM_COLUMNS;

		ClientPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ClientPeer::NUM_COLUMNS;

		JobStatusPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + JobStatusPeer::NUM_COLUMNS;

		JobTypePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + JobTypePeer::NUM_COLUMNS;

		$c->addJoin(WorkorderPeer::DEVICE_ID, DevicePeer::ID);

		$c->addJoin(WorkorderPeer::CLIENT_ID, ClientPeer::ID);

		$c->addJoin(WorkorderPeer::JOB_STATUS_ID, JobStatusPeer::ID);

		$c->addJoin(WorkorderPeer::JOB_TYPE_ID, JobTypePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = WorkorderPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DevicePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDevice(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addWorkorder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initWorkorders();
				$obj2->addWorkorder($obj1);
			}

			$omClass = ClientPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getClient(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addWorkorder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initWorkorders();
				$obj3->addWorkorder($obj1);
			}

			$omClass = JobStatusPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getJobStatus(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addWorkorder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initWorkorders();
				$obj4->addWorkorder($obj1);
			}

			$omClass = JobTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getJobType(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addWorkorder($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initWorkorders();
				$obj5->addWorkorder($obj1);
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
		return WorkorderPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(WorkorderPeer::ID); 

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
			$comparison = $criteria->getComparison(WorkorderPeer::ID);
			$selectCriteria->add(WorkorderPeer::ID, $criteria->remove(WorkorderPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(WorkorderPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(WorkorderPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Workorder) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(WorkorderPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Workorder $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(WorkorderPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(WorkorderPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(WorkorderPeer::DATABASE_NAME, WorkorderPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = WorkorderPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(WorkorderPeer::DATABASE_NAME);

		$criteria->add(WorkorderPeer::ID, $pk);


		$v = WorkorderPeer::doSelect($criteria, $con);

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
			$criteria->add(WorkorderPeer::ID, $pks, Criteria::IN);
			$objs = WorkorderPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseWorkorderPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/WorkorderMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.WorkorderMapBuilder');
}
