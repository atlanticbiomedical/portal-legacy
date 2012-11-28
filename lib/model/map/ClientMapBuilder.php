<?php



class ClientMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.ClientMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('client');
		$tMap->setPhpName('Client');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('LOCATION_ID', 'LocationId', 'int', CreoleTypes::INTEGER, 'location', 'ID', false, null);

		$tMap->addColumn('CLIENT_IDENTIFICATION', 'ClientIdentification', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('CLIENT_NAME', 'ClientName', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ADDRESS', 'Address', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ADDRESS_2', 'Address2', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('CITY', 'City', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('STATE', 'State', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ZIP', 'Zip', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ATTN', 'Attn', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('PHONE', 'Phone', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('EXT', 'Ext', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('CATEGORY', 'Category', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('NOTES', 'Notes', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ALL_DEVICES', 'AllDevices', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('FREQ_APPROVED', 'FreqApproved', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('FREQ_LOCKED', 'FreqLocked', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('FREQUENCY', 'Frequency', 'string', CreoleTypes::VARBINARY, false, null);

		$tMap->addColumn('FREQUENCY_ANNUAL', 'FrequencyAnnual', 'string', CreoleTypes::VARBINARY, false, null);

		$tMap->addColumn('FREQUENCY_SEMI', 'FrequencySemi', 'string', CreoleTypes::VARBINARY, false, null);

		$tMap->addColumn('FREQUENCY_QUARTERLY', 'FrequencyQuarterly', 'string', CreoleTypes::VARBINARY, false, null);

		$tMap->addColumn('FREQUENCY_STERILIZER', 'FrequencySterilizer', 'string', CreoleTypes::VARBINARY, false, null);

		$tMap->addColumn('FREQUENCY_TG', 'FrequencyTg', 'string', CreoleTypes::VARBINARY, false, null);

		$tMap->addColumn('FREQUENCY_ERT', 'FrequencyErt', 'string', CreoleTypes::VARBINARY, false, null);

		$tMap->addColumn('FREQUENCY_RAE', 'FrequencyRae', 'string', CreoleTypes::VARBINARY, false, null);

		$tMap->addColumn('FREQUENCY_MEDGAS', 'FrequencyMedgas', 'string', CreoleTypes::VARBINARY, false, null);

		$tMap->addColumn('FREQUENCY_IMAGING', 'FrequencyImaging', 'string', CreoleTypes::VARBINARY, false, null);

		$tMap->addColumn('FREQUENCY_NEPTUNE', 'FrequencyNeptune', 'string', CreoleTypes::VARBINARY, false, null);

		$tMap->addColumn('FREQUENCY_ANESTHESIA', 'FrequencyAnesthesia', 'string', CreoleTypes::VARBINARY, false, null);

		$tMap->addColumn('ANESTHESIA', 'Anesthesia', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('MEDGAS', 'Medgas', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('REQUIRE_COORDS_UPDATE', 'RequireCoordsUpdate', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ADDRESSTYPE', 'Addresstype', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SECONDARY_ADDRESS', 'SecondaryAddress', 'string', CreoleTypes::VARCHAR, true, 50);

		$tMap->addColumn('SECONDARY_ADDRESS_2', 'SecondaryAddress2', 'string', CreoleTypes::VARCHAR, true, 50);

		$tMap->addColumn('SECONDARY_CITY', 'SecondaryCity', 'string', CreoleTypes::VARCHAR, true, 50);

		$tMap->addColumn('SECONDARY_STATE', 'SecondaryState', 'string', CreoleTypes::VARCHAR, true, 50);

		$tMap->addColumn('SECONDARY_ZIP', 'SecondaryZip', 'string', CreoleTypes::VARCHAR, true, 50);

		$tMap->addColumn('SECONDARY_ATTN', 'SecondaryAttn', 'string', CreoleTypes::VARCHAR, true, 50);

	} 
} 