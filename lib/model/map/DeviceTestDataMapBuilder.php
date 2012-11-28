<?php



class DeviceTestDataMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DeviceTestDataMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('device_test_data');
		$tMap->setPhpName('DeviceTestData');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('DEVICE_CHECKUP_ID', 'DeviceCheckupId', 'int', CreoleTypes::INTEGER, 'device_checkup', 'ID', false, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('TYPE', 'Type', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('VALUE', 'Value', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('PASSFAIL', 'Passfail', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('UNIT', 'Unit', 'string', CreoleTypes::VARCHAR, false, 50);

	} 
} 