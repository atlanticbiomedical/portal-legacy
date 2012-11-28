<?php



class FinalDeviceReportMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.FinalDeviceReportMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('final_device_report');
		$tMap->setPhpName('FinalDeviceReport');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CLIENT_ID', 'ClientId', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('DATE', 'Date', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('PASS_FAIL', 'PassFail', 'string', CreoleTypes::VARCHAR, false, 250);

		$tMap->addColumn('TOTAL_FAILED', 'TotalFailed', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TOTAL_PASSED', 'TotalPassed', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TOTAL_BP', 'TotalBp', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TOTAL_TRACE', 'TotalTrace', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TOTAL_MISSED', 'TotalMissed', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TOTAL_OUTLETS', 'TotalOutlets', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CONTACT', 'Contact', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 