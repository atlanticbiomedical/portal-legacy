<?php



class SpecificationMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SpecificationMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('specification');
		$tMap->setPhpName('Specification');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('DEVICE_NAME', 'DeviceName', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('MANUFACTURER', 'Manufacturer', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('MODEL_NUMBER', 'ModelNumber', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 