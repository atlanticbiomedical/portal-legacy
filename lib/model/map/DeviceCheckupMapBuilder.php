<?php



class DeviceCheckupMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DeviceCheckupMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('device_checkup');
		$tMap->setPhpName('DeviceCheckup');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('DEVICE_ID', 'DeviceId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignKey('CLIENT_ID', 'ClientId', 'int', CreoleTypes::INTEGER, 'client', 'ID', false, null);

		$tMap->addColumn('DEVICE_IDENTIFICATION', 'DeviceIdentification', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ROW_INDICATOR', 'RowIndicator', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('DEVICE_TECH_ID', 'DeviceTechId', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('PASS_FAIL_CODE', 'PassFailCode', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('REC_NUMBER', 'RecNumber', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ROW_PURPOSE', 'RowPurpose', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('PHYSICAL_INSPECTION', 'PhysicalInspection', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ROOM', 'Room', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('TIME', 'Time', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('DATE', 'Date', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('PASS_FAIL', 'PassFail', 'string', CreoleTypes::VARCHAR, false, 50);

	} 
} 