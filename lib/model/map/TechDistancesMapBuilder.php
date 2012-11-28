<?php



class TechDistancesMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TechDistancesMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('tech_distances');
		$tMap->setPhpName('TechDistances');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TECH_ID', 'TechId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CLIENT_ID', 'ClientId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TRAVEL_TIME_HOURS', 'TravelTimeHours', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TRAVEL_TIME_MINS', 'TravelTimeMins', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TRAVEL_DISTANCE', 'TravelDistance', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 