<?php



class WorkorderMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WorkorderMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('workorder');
		$tMap->setPhpName('Workorder');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('DEVICE_ID', 'DeviceId', 'int', CreoleTypes::INTEGER, 'device', 'ID', false, null);

		$tMap->addForeignKey('CLIENT_ID', 'ClientId', 'int', CreoleTypes::INTEGER, 'client', 'ID', false, null);

		$tMap->addColumn('TECH', 'Tech', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('OFFICE', 'Office', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('ASSIGNED_BY', 'AssignedBy', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PAGE_NUMBER', 'PageNumber', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('TRAVEL_TIME', 'TravelTime', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ONSITE_TIME', 'OnsiteTime', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ZIP', 'Zip', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('DATE_RECIEVED', 'DateRecieved', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('DATE_COMPLETED', 'DateCompleted', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('INVOICE', 'Invoice', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('REASON', 'Reason', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('ACTION_TAKEN', 'ActionTaken', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('REMARKS', 'Remarks', 'string', CreoleTypes::VARCHAR, false, 150);

		$tMap->addColumn('JOB_DATE', 'JobDate', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('JOB_START', 'JobStart', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('JOB_END', 'JobEnd', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('EXACT_TIME', 'ExactTime', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SALE_TAX', 'SaleTax', 'double', CreoleTypes::DOUBLE, false, null);

		$tMap->addColumn('ZONE_CHARGE', 'ZoneCharge', 'double', CreoleTypes::DOUBLE, false, null);

		$tMap->addColumn('SHIPPING_HANDLING', 'ShippingHandling', 'double', CreoleTypes::DOUBLE, false, null);

		$tMap->addColumn('TOTAL', 'Total', 'double', CreoleTypes::DOUBLE, false, null);

		$tMap->addColumn('SERVICE_TRAVEL', 'ServiceTravel', 'double', CreoleTypes::DOUBLE, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addForeignKey('JOB_STATUS_ID', 'JobStatusId', 'int', CreoleTypes::INTEGER, 'job_status', 'ID', false, null);

		$tMap->addForeignKey('JOB_TYPE_ID', 'JobTypeId', 'int', CreoleTypes::INTEGER, 'job_type', 'ID', false, null);

		$tMap->addForeignKey('WORKORDER_TYPE_ID', 'WorkorderTypeId', 'int', CreoleTypes::INTEGER, 'workorder_type', 'ID', false, null);

		$tMap->addColumn('CALLER', 'Caller', 'string', CreoleTypes::VARCHAR, false, 75);

		$tMap->addColumn('JOB_SCHEDULED_DATE', 'JobScheduledDate', 'string', CreoleTypes::VARCHAR, false, 50);

	} 
} 