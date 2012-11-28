<?php



class CordinatesMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.CordinatesMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('cordinates');
		$tMap->setPhpName('Cordinates');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CLIENT_ID', 'ClientId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('LAT', 'Lat', 'double', CreoleTypes::DOUBLE, false, null);

		$tMap->addColumn('LON', 'Lon', 'double', CreoleTypes::DOUBLE, false, null);

		$tMap->addColumn('FOUND', 'Found', 'int', CreoleTypes::INTEGER, false, null);

	} 
} 