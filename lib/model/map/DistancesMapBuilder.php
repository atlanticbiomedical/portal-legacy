<?php



class DistancesMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.DistancesMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('distances');
		$tMap->setPhpName('Distances');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CLIENT_ID_1', 'ClientId1', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CLIENT_ID_2', 'ClientId2', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TRAVEL_TIME_HOURS', 'TravelTimeHours', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TRAVEL_TIME_MINS', 'TravelTimeMins', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TRAVEL_DISTANCE', 'TravelDistance', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 