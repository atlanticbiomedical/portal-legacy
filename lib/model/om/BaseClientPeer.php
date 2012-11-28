<?php


abstract class BaseClientPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'client';

	
	const CLASS_DEFAULT = 'lib.model.Client';

	
	const NUM_COLUMNS = 42;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'client.ID';

	
	const LOCATION_ID = 'client.LOCATION_ID';

	
	const CLIENT_IDENTIFICATION = 'client.CLIENT_IDENTIFICATION';

	
	const CLIENT_NAME = 'client.CLIENT_NAME';

	
	const ADDRESS = 'client.ADDRESS';

	
	const ADDRESS_2 = 'client.ADDRESS_2';

	
	const CITY = 'client.CITY';

	
	const STATE = 'client.STATE';

	
	const ZIP = 'client.ZIP';

	
	const ATTN = 'client.ATTN';

	
	const EMAIL = 'client.EMAIL';

	
	const PHONE = 'client.PHONE';

	
	const EXT = 'client.EXT';

	
	const CATEGORY = 'client.CATEGORY';

	
	const NOTES = 'client.NOTES';

	
	const ALL_DEVICES = 'client.ALL_DEVICES';

	
	const FREQ_APPROVED = 'client.FREQ_APPROVED';

	
	const FREQ_LOCKED = 'client.FREQ_LOCKED';

	
	const CREATED_AT = 'client.CREATED_AT';

	
	const UPDATED_AT = 'client.UPDATED_AT';

	
	const FREQUENCY = 'client.FREQUENCY';

	
	const FREQUENCY_ANNUAL = 'client.FREQUENCY_ANNUAL';

	
	const FREQUENCY_SEMI = 'client.FREQUENCY_SEMI';

	
	const FREQUENCY_QUARTERLY = 'client.FREQUENCY_QUARTERLY';

	
	const FREQUENCY_STERILIZER = 'client.FREQUENCY_STERILIZER';

	
	const FREQUENCY_TG = 'client.FREQUENCY_TG';

	
	const FREQUENCY_ERT = 'client.FREQUENCY_ERT';

	
	const FREQUENCY_RAE = 'client.FREQUENCY_RAE';

	
	const FREQUENCY_MEDGAS = 'client.FREQUENCY_MEDGAS';

	
	const FREQUENCY_IMAGING = 'client.FREQUENCY_IMAGING';

	
	const FREQUENCY_NEPTUNE = 'client.FREQUENCY_NEPTUNE';

	
	const FREQUENCY_ANESTHESIA = 'client.FREQUENCY_ANESTHESIA';

	
	const ANESTHESIA = 'client.ANESTHESIA';

	
	const MEDGAS = 'client.MEDGAS';

	
	const REQUIRE_COORDS_UPDATE = 'client.REQUIRE_COORDS_UPDATE';

	
	const ADDRESSTYPE = 'client.ADDRESSTYPE';

	
	const SECONDARY_ADDRESS = 'client.SECONDARY_ADDRESS';

	
	const SECONDARY_ADDRESS_2 = 'client.SECONDARY_ADDRESS_2';

	
	const SECONDARY_CITY = 'client.SECONDARY_CITY';

	
	const SECONDARY_STATE = 'client.SECONDARY_STATE';

	
	const SECONDARY_ZIP = 'client.SECONDARY_ZIP';

	
	const SECONDARY_ATTN = 'client.SECONDARY_ATTN';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'LocationId', 'ClientIdentification', 'ClientName', 'Address', 'Address2', 'City', 'State', 'Zip', 'Attn', 'Email', 'Phone', 'Ext', 'Category', 'Notes', 'AllDevices', 'FreqApproved', 'FreqLocked', 'CreatedAt', 'UpdatedAt', 'Frequency', 'FrequencyAnnual', 'FrequencySemi', 'FrequencyQuarterly', 'FrequencySterilizer', 'FrequencyTg', 'FrequencyErt', 'FrequencyRae', 'FrequencyMedgas', 'FrequencyImaging', 'FrequencyNeptune', 'FrequencyAnesthesia', 'Anesthesia', 'Medgas', 'RequireCoordsUpdate', 'Addresstype', 'SecondaryAddress', 'SecondaryAddress2', 'SecondaryCity', 'SecondaryState', 'SecondaryZip', 'SecondaryAttn', ),
		BasePeer::TYPE_COLNAME => array (ClientPeer::ID, ClientPeer::LOCATION_ID, ClientPeer::CLIENT_IDENTIFICATION, ClientPeer::CLIENT_NAME, ClientPeer::ADDRESS, ClientPeer::ADDRESS_2, ClientPeer::CITY, ClientPeer::STATE, ClientPeer::ZIP, ClientPeer::ATTN, ClientPeer::EMAIL, ClientPeer::PHONE, ClientPeer::EXT, ClientPeer::CATEGORY, ClientPeer::NOTES, ClientPeer::ALL_DEVICES, ClientPeer::FREQ_APPROVED, ClientPeer::FREQ_LOCKED, ClientPeer::CREATED_AT, ClientPeer::UPDATED_AT, ClientPeer::FREQUENCY, ClientPeer::FREQUENCY_ANNUAL, ClientPeer::FREQUENCY_SEMI, ClientPeer::FREQUENCY_QUARTERLY, ClientPeer::FREQUENCY_STERILIZER, ClientPeer::FREQUENCY_TG, ClientPeer::FREQUENCY_ERT, ClientPeer::FREQUENCY_RAE, ClientPeer::FREQUENCY_MEDGAS, ClientPeer::FREQUENCY_IMAGING, ClientPeer::FREQUENCY_NEPTUNE, ClientPeer::FREQUENCY_ANESTHESIA, ClientPeer::ANESTHESIA, ClientPeer::MEDGAS, ClientPeer::REQUIRE_COORDS_UPDATE, ClientPeer::ADDRESSTYPE, ClientPeer::SECONDARY_ADDRESS, ClientPeer::SECONDARY_ADDRESS_2, ClientPeer::SECONDARY_CITY, ClientPeer::SECONDARY_STATE, ClientPeer::SECONDARY_ZIP, ClientPeer::SECONDARY_ATTN, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'location_id', 'client_identification', 'client_name', 'address', 'address_2', 'city', 'state', 'zip', 'attn', 'email', 'phone', 'ext', 'category', 'notes', 'all_devices', 'freq_approved', 'freq_locked', 'created_at', 'updated_at', 'frequency', 'frequency_annual', 'frequency_semi', 'frequency_quarterly', 'frequency_sterilizer', 'frequency_tg', 'frequency_ert', 'frequency_rae', 'frequency_medgas', 'frequency_imaging', 'frequency_neptune', 'frequency_anesthesia', 'anesthesia', 'medgas', 'require_coords_update', 'addressType', 'secondary_address', 'secondary_address_2', 'secondary_city', 'secondary_state', 'secondary_zip', 'secondary_attn', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'LocationId' => 1, 'ClientIdentification' => 2, 'ClientName' => 3, 'Address' => 4, 'Address2' => 5, 'City' => 6, 'State' => 7, 'Zip' => 8, 'Attn' => 9, 'Email' => 10, 'Phone' => 11, 'Ext' => 12, 'Category' => 13, 'Notes' => 14, 'AllDevices' => 15, 'FreqApproved' => 16, 'FreqLocked' => 17, 'CreatedAt' => 18, 'UpdatedAt' => 19, 'Frequency' => 20, 'FrequencyAnnual' => 21, 'FrequencySemi' => 22, 'FrequencyQuarterly' => 23, 'FrequencySterilizer' => 24, 'FrequencyTg' => 25, 'FrequencyErt' => 26, 'FrequencyRae' => 27, 'FrequencyMedgas' => 28, 'FrequencyImaging' => 29, 'FrequencyNeptune' => 30, 'FrequencyAnesthesia' => 31, 'Anesthesia' => 32, 'Medgas' => 33, 'RequireCoordsUpdate' => 34, 'Addresstype' => 35, 'SecondaryAddress' => 36, 'SecondaryAddress2' => 37, 'SecondaryCity' => 38, 'SecondaryState' => 39, 'SecondaryZip' => 40, 'SecondaryAttn' => 41, ),
		BasePeer::TYPE_COLNAME => array (ClientPeer::ID => 0, ClientPeer::LOCATION_ID => 1, ClientPeer::CLIENT_IDENTIFICATION => 2, ClientPeer::CLIENT_NAME => 3, ClientPeer::ADDRESS => 4, ClientPeer::ADDRESS_2 => 5, ClientPeer::CITY => 6, ClientPeer::STATE => 7, ClientPeer::ZIP => 8, ClientPeer::ATTN => 9, ClientPeer::EMAIL => 10, ClientPeer::PHONE => 11, ClientPeer::EXT => 12, ClientPeer::CATEGORY => 13, ClientPeer::NOTES => 14, ClientPeer::ALL_DEVICES => 15, ClientPeer::FREQ_APPROVED => 16, ClientPeer::FREQ_LOCKED => 17, ClientPeer::CREATED_AT => 18, ClientPeer::UPDATED_AT => 19, ClientPeer::FREQUENCY => 20, ClientPeer::FREQUENCY_ANNUAL => 21, ClientPeer::FREQUENCY_SEMI => 22, ClientPeer::FREQUENCY_QUARTERLY => 23, ClientPeer::FREQUENCY_STERILIZER => 24, ClientPeer::FREQUENCY_TG => 25, ClientPeer::FREQUENCY_ERT => 26, ClientPeer::FREQUENCY_RAE => 27, ClientPeer::FREQUENCY_MEDGAS => 28, ClientPeer::FREQUENCY_IMAGING => 29, ClientPeer::FREQUENCY_NEPTUNE => 30, ClientPeer::FREQUENCY_ANESTHESIA => 31, ClientPeer::ANESTHESIA => 32, ClientPeer::MEDGAS => 33, ClientPeer::REQUIRE_COORDS_UPDATE => 34, ClientPeer::ADDRESSTYPE => 35, ClientPeer::SECONDARY_ADDRESS => 36, ClientPeer::SECONDARY_ADDRESS_2 => 37, ClientPeer::SECONDARY_CITY => 38, ClientPeer::SECONDARY_STATE => 39, ClientPeer::SECONDARY_ZIP => 40, ClientPeer::SECONDARY_ATTN => 41, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'location_id' => 1, 'client_identification' => 2, 'client_name' => 3, 'address' => 4, 'address_2' => 5, 'city' => 6, 'state' => 7, 'zip' => 8, 'attn' => 9, 'email' => 10, 'phone' => 11, 'ext' => 12, 'category' => 13, 'notes' => 14, 'all_devices' => 15, 'freq_approved' => 16, 'freq_locked' => 17, 'created_at' => 18, 'updated_at' => 19, 'frequency' => 20, 'frequency_annual' => 21, 'frequency_semi' => 22, 'frequency_quarterly' => 23, 'frequency_sterilizer' => 24, 'frequency_tg' => 25, 'frequency_ert' => 26, 'frequency_rae' => 27, 'frequency_medgas' => 28, 'frequency_imaging' => 29, 'frequency_neptune' => 30, 'frequency_anesthesia' => 31, 'anesthesia' => 32, 'medgas' => 33, 'require_coords_update' => 34, 'addressType' => 35, 'secondary_address' => 36, 'secondary_address_2' => 37, 'secondary_city' => 38, 'secondary_state' => 39, 'secondary_zip' => 40, 'secondary_attn' => 41, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ClientMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ClientMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ClientPeer::getTableMap();
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
		return str_replace(ClientPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ClientPeer::ID);

		$criteria->addSelectColumn(ClientPeer::LOCATION_ID);

		$criteria->addSelectColumn(ClientPeer::CLIENT_IDENTIFICATION);

		$criteria->addSelectColumn(ClientPeer::CLIENT_NAME);

		$criteria->addSelectColumn(ClientPeer::ADDRESS);

		$criteria->addSelectColumn(ClientPeer::ADDRESS_2);

		$criteria->addSelectColumn(ClientPeer::CITY);

		$criteria->addSelectColumn(ClientPeer::STATE);

		$criteria->addSelectColumn(ClientPeer::ZIP);

		$criteria->addSelectColumn(ClientPeer::ATTN);

		$criteria->addSelectColumn(ClientPeer::EMAIL);

		$criteria->addSelectColumn(ClientPeer::PHONE);

		$criteria->addSelectColumn(ClientPeer::EXT);

		$criteria->addSelectColumn(ClientPeer::CATEGORY);

		$criteria->addSelectColumn(ClientPeer::NOTES);

		$criteria->addSelectColumn(ClientPeer::ALL_DEVICES);

		$criteria->addSelectColumn(ClientPeer::FREQ_APPROVED);

		$criteria->addSelectColumn(ClientPeer::FREQ_LOCKED);

		$criteria->addSelectColumn(ClientPeer::CREATED_AT);

		$criteria->addSelectColumn(ClientPeer::UPDATED_AT);

		$criteria->addSelectColumn(ClientPeer::FREQUENCY);

		$criteria->addSelectColumn(ClientPeer::FREQUENCY_ANNUAL);

		$criteria->addSelectColumn(ClientPeer::FREQUENCY_SEMI);

		$criteria->addSelectColumn(ClientPeer::FREQUENCY_QUARTERLY);

		$criteria->addSelectColumn(ClientPeer::FREQUENCY_STERILIZER);

		$criteria->addSelectColumn(ClientPeer::FREQUENCY_TG);

		$criteria->addSelectColumn(ClientPeer::FREQUENCY_ERT);

		$criteria->addSelectColumn(ClientPeer::FREQUENCY_RAE);

		$criteria->addSelectColumn(ClientPeer::FREQUENCY_MEDGAS);

		$criteria->addSelectColumn(ClientPeer::FREQUENCY_IMAGING);

		$criteria->addSelectColumn(ClientPeer::FREQUENCY_NEPTUNE);

		$criteria->addSelectColumn(ClientPeer::FREQUENCY_ANESTHESIA);

		$criteria->addSelectColumn(ClientPeer::ANESTHESIA);

		$criteria->addSelectColumn(ClientPeer::MEDGAS);

		$criteria->addSelectColumn(ClientPeer::REQUIRE_COORDS_UPDATE);

		$criteria->addSelectColumn(ClientPeer::ADDRESSTYPE);

		$criteria->addSelectColumn(ClientPeer::SECONDARY_ADDRESS);

		$criteria->addSelectColumn(ClientPeer::SECONDARY_ADDRESS_2);

		$criteria->addSelectColumn(ClientPeer::SECONDARY_CITY);

		$criteria->addSelectColumn(ClientPeer::SECONDARY_STATE);

		$criteria->addSelectColumn(ClientPeer::SECONDARY_ZIP);

		$criteria->addSelectColumn(ClientPeer::SECONDARY_ATTN);

	}

	const COUNT = 'COUNT(client.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT client.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClientPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClientPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ClientPeer::doSelectRS($criteria, $con);
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
		$objects = ClientPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ClientPeer::populateObjects(ClientPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ClientPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ClientPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinLocation(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClientPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClientPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClientPeer::LOCATION_ID, LocationPeer::ID);

		$rs = ClientPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinLocation(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ClientPeer::addSelectColumns($c);
		$startcol = (ClientPeer::NUM_COLUMNS - ClientPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		LocationPeer::addSelectColumns($c);

		$c->addJoin(ClientPeer::LOCATION_ID, LocationPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClientPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = LocationPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getLocation(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addClient($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initClients();
				$obj2->addClient($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ClientPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ClientPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ClientPeer::LOCATION_ID, LocationPeer::ID);

		$rs = ClientPeer::doSelectRS($criteria, $con);
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

		ClientPeer::addSelectColumns($c);
		$startcol2 = (ClientPeer::NUM_COLUMNS - ClientPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		LocationPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + LocationPeer::NUM_COLUMNS;

		$c->addJoin(ClientPeer::LOCATION_ID, LocationPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ClientPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = LocationPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getLocation(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addClient($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initClients();
				$obj2->addClient($obj1);
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
		return ClientPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ClientPeer::ID); 

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
			$comparison = $criteria->getComparison(ClientPeer::ID);
			$selectCriteria->add(ClientPeer::ID, $criteria->remove(ClientPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ClientPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ClientPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Client) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ClientPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Client $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ClientPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ClientPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ClientPeer::DATABASE_NAME, ClientPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ClientPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ClientPeer::DATABASE_NAME);

		$criteria->add(ClientPeer::ID, $pk);


		$v = ClientPeer::doSelect($criteria, $con);

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
			$criteria->add(ClientPeer::ID, $pks, Criteria::IN);
			$objs = ClientPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseClientPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ClientMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ClientMapBuilder');
}
