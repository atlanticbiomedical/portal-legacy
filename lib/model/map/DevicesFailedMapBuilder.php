<?php



class DevicesFailedMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DevicesFailedMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('devices_failed');
		$tMap->setPhpName('DevicesFailed');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('DEVICE_ID', 'DeviceId', 'int', CreoleTypes::INTEGER, 'device', 'ID', false, null);

		$tMap->addColumn('REPORT_ID', 'ReportId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CLIENT_ID', 'ClientId', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('STATUS', 'Status', 'string', CreoleTypes::VARCHAR, false, 50);

	} 
} 