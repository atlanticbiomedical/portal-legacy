<?php



class UserMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.UserMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('user');
		$tMap->setPhpName('User');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('USER_NAME', 'UserName', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('FIRST_NAME', 'FirstName', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('LAST_NAME', 'LastName', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('PHONE', 'Phone', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ADDRESS', 'Address', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ADDRESS_2', 'Address2', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('CITY', 'City', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('STATE', 'State', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ZIP', 'Zip', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('PASSWORD', 'Password', 'string', CreoleTypes::VARCHAR, false, 64);

		$tMap->addColumn('START_TIME', 'StartTime', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('END_TIME', 'EndTime', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('LOCATION_ID', 'LocationId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('USER_TYPE_ID', 'UserTypeId', 'int', CreoleTypes::INTEGER, 'user_type', 'ID', false, null);

		$tMap->addColumn('WEIGHT', 'Weight', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ADMIN', 'Admin', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 