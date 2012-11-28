<?php



class DeviceMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DeviceMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('device');
		$tMap->setPhpName('Device');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('SPECIFICATION_ID', 'SpecificationId', 'int', CreoleTypes::INTEGER, 'specification', 'ID', false, null);

		$tMap->addForeignKey('CLIENT_ID', 'ClientId', 'int', CreoleTypes::INTEGER, 'client', 'ID', false, null);

		$tMap->addColumn('SERIAL_NUMBER', 'SerialNumber', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('LOCATION', 'Location', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('FREQUENCY', 'Frequency', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('STATUS', 'Status', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('IDENTIFICATION', 'Identification', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('COMMENTS', 'Comments', 'string', CreoleTypes::VARCHAR, false, 300);

		$tMap->addColumn('LAST_PM_DATE', 'LastPmDate', 'string', CreoleTypes::VARCHAR, false, 50);

	} 
} 