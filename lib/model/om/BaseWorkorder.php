<?php


abstract class BaseWorkorder extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $device_id;


	
	protected $client_id;


	
	protected $tech;


	
	protected $office;


	
	protected $assigned_by;


	
	protected $page_number;


	
	protected $travel_time;


	
	protected $onsite_time;


	
	protected $zip;


	
	protected $date_recieved;


	
	protected $date_completed;


	
	protected $invoice;


	
	protected $reason;


	
	protected $action_taken;


	
	protected $remarks;


	
	protected $job_date;


	
	protected $job_start;


	
	protected $job_end;


	
	protected $exact_time;


	
	protected $sale_tax = 0;


	
	protected $zone_charge = 0;


	
	protected $shipping_handling = 0;


	
	protected $total = 0;


	
	protected $service_travel = 0;


	
	protected $created_at;


	
	protected $updated_at;


	
	protected $job_status_id;


	
	protected $job_type_id;


	
	protected $workorder_type_id;


	
	protected $caller;


	
	protected $job_scheduled_date;

	
	protected $aDevice;

	
	protected $aClient;

	
	protected $aJobStatus;

	
	protected $aJobType;

	
	protected $aWorkorderType;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getDeviceId()
	{

		return $this->device_id;
	}

	
	public function getClientId()
	{

		return $this->client_id;
	}

	
	public function getTech()
	{

		return $this->tech;
	}

	
	public function getOffice()
	{

		return $this->office;
	}

	
	public function getAssignedBy()
	{

		return $this->assigned_by;
	}

	
	public function getPageNumber()
	{

		return $this->page_number;
	}

	
	public function getTravelTime()
	{

		return $this->travel_time;
	}

	
	public function getOnsiteTime()
	{

		return $this->onsite_time;
	}

	
	public function getZip()
	{

		return $this->zip;
	}

	
	public function getDateRecieved()
	{

		return $this->date_recieved;
	}

	
	public function getDateCompleted()
	{

		return $this->date_completed;
	}

	
	public function getInvoice()
	{

		return $this->invoice;
	}

	
	public function getReason()
	{

		return $this->reason;
	}

	
	public function getActionTaken()
	{

		return $this->action_taken;
	}

	
	public function getRemarks()
	{

		return $this->remarks;
	}

	
	public function getJobDate()
	{

		return $this->job_date;
	}

	
	public function getJobStart()
	{

		return $this->job_start;
	}

	
	public function getJobEnd()
	{

		return $this->job_end;
	}

	
	public function getExactTime()
	{

		return $this->exact_time;
	}

	
	public function getSaleTax()
	{

		return $this->sale_tax;
	}

	
	public function getZoneCharge()
	{

		return $this->zone_charge;
	}

	
	public function getShippingHandling()
	{

		return $this->shipping_handling;
	}

	
	public function getTotal()
	{

		return $this->total;
	}

	
	public function getServiceTravel()
	{

		return $this->service_travel;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getJobStatusId()
	{

		return $this->job_status_id;
	}

	
	public function getJobTypeId()
	{

		return $this->job_type_id;
	}

	
	public function getWorkorderTypeId()
	{

		return $this->workorder_type_id;
	}

	
	public function getCaller()
	{

		return $this->caller;
	}

	
	public function getJobScheduledDate()
	{

		return $this->job_scheduled_date;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = WorkorderPeer::ID;
		}

	} 
	
	public function setDeviceId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->device_id !== $v) {
			$this->device_id = $v;
			$this->modifiedColumns[] = WorkorderPeer::DEVICE_ID;
		}

		if ($this->aDevice !== null && $this->aDevice->getId() !== $v) {
			$this->aDevice = null;
		}

	} 
	
	public function setClientId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->client_id !== $v) {
			$this->client_id = $v;
			$this->modifiedColumns[] = WorkorderPeer::CLIENT_ID;
		}

		if ($this->aClient !== null && $this->aClient->getId() !== $v) {
			$this->aClient = null;
		}

	} 
	
	public function setTech($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tech !== $v) {
			$this->tech = $v;
			$this->modifiedColumns[] = WorkorderPeer::TECH;
		}

	} 
	
	public function setOffice($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->office !== $v) {
			$this->office = $v;
			$this->modifiedColumns[] = WorkorderPeer::OFFICE;
		}

	} 
	
	public function setAssignedBy($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->assigned_by !== $v) {
			$this->assigned_by = $v;
			$this->modifiedColumns[] = WorkorderPeer::ASSIGNED_BY;
		}

	} 
	
	public function setPageNumber($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->page_number !== $v) {
			$this->page_number = $v;
			$this->modifiedColumns[] = WorkorderPeer::PAGE_NUMBER;
		}

	} 
	
	public function setTravelTime($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->travel_time !== $v) {
			$this->travel_time = $v;
			$this->modifiedColumns[] = WorkorderPeer::TRAVEL_TIME;
		}

	} 
	
	public function setOnsiteTime($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->onsite_time !== $v) {
			$this->onsite_time = $v;
			$this->modifiedColumns[] = WorkorderPeer::ONSITE_TIME;
		}

	} 
	
	public function setZip($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->zip !== $v) {
			$this->zip = $v;
			$this->modifiedColumns[] = WorkorderPeer::ZIP;
		}

	} 
	
	public function setDateRecieved($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->date_recieved !== $v) {
			$this->date_recieved = $v;
			$this->modifiedColumns[] = WorkorderPeer::DATE_RECIEVED;
		}

	} 
	
	public function setDateCompleted($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->date_completed !== $v) {
			$this->date_completed = $v;
			$this->modifiedColumns[] = WorkorderPeer::DATE_COMPLETED;
		}

	} 
	
	public function setInvoice($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->invoice !== $v) {
			$this->invoice = $v;
			$this->modifiedColumns[] = WorkorderPeer::INVOICE;
		}

	} 
	
	public function setReason($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->reason !== $v) {
			$this->reason = $v;
			$this->modifiedColumns[] = WorkorderPeer::REASON;
		}

	} 
	
	public function setActionTaken($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->action_taken !== $v) {
			$this->action_taken = $v;
			$this->modifiedColumns[] = WorkorderPeer::ACTION_TAKEN;
		}

	} 
	
	public function setRemarks($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->remarks !== $v) {
			$this->remarks = $v;
			$this->modifiedColumns[] = WorkorderPeer::REMARKS;
		}

	} 
	
	public function setJobDate($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->job_date !== $v) {
			$this->job_date = $v;
			$this->modifiedColumns[] = WorkorderPeer::JOB_DATE;
		}

	} 
	
	public function setJobStart($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->job_start !== $v) {
			$this->job_start = $v;
			$this->modifiedColumns[] = WorkorderPeer::JOB_START;
		}

	} 
	
	public function setJobEnd($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->job_end !== $v) {
			$this->job_end = $v;
			$this->modifiedColumns[] = WorkorderPeer::JOB_END;
		}

	} 
	
	public function setExactTime($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->exact_time !== $v) {
			$this->exact_time = $v;
			$this->modifiedColumns[] = WorkorderPeer::EXACT_TIME;
		}

	} 
	
	public function setSaleTax($v)
	{

		if ($this->sale_tax !== $v || $v === 0) {
			$this->sale_tax = $v;
			$this->modifiedColumns[] = WorkorderPeer::SALE_TAX;
		}

	} 
	
	public function setZoneCharge($v)
	{

		if ($this->zone_charge !== $v || $v === 0) {
			$this->zone_charge = $v;
			$this->modifiedColumns[] = WorkorderPeer::ZONE_CHARGE;
		}

	} 
	
	public function setShippingHandling($v)
	{

		if ($this->shipping_handling !== $v || $v === 0) {
			$this->shipping_handling = $v;
			$this->modifiedColumns[] = WorkorderPeer::SHIPPING_HANDLING;
		}

	} 
	
	public function setTotal($v)
	{

		if ($this->total !== $v || $v === 0) {
			$this->total = $v;
			$this->modifiedColumns[] = WorkorderPeer::TOTAL;
		}

	} 
	
	public function setServiceTravel($v)
	{

		if ($this->service_travel !== $v || $v === 0) {
			$this->service_travel = $v;
			$this->modifiedColumns[] = WorkorderPeer::SERVICE_TRAVEL;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = WorkorderPeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = WorkorderPeer::UPDATED_AT;
		}

	} 
	
	public function setJobStatusId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->job_status_id !== $v) {
			$this->job_status_id = $v;
			$this->modifiedColumns[] = WorkorderPeer::JOB_STATUS_ID;
		}

		if ($this->aJobStatus !== null && $this->aJobStatus->getId() !== $v) {
			$this->aJobStatus = null;
		}

	} 
	
	public function setJobTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->job_type_id !== $v) {
			$this->job_type_id = $v;
			$this->modifiedColumns[] = WorkorderPeer::JOB_TYPE_ID;
		}

		if ($this->aJobType !== null && $this->aJobType->getId() !== $v) {
			$this->aJobType = null;
		}

	} 
	
	public function setWorkorderTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->workorder_type_id !== $v) {
			$this->workorder_type_id = $v;
			$this->modifiedColumns[] = WorkorderPeer::WORKORDER_TYPE_ID;
		}

		if ($this->aWorkorderType !== null && $this->aWorkorderType->getId() !== $v) {
			$this->aWorkorderType = null;
		}

	} 
	
	public function setCaller($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->caller !== $v) {
			$this->caller = $v;
			$this->modifiedColumns[] = WorkorderPeer::CALLER;
		}

	} 
	
	public function setJobScheduledDate($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->job_scheduled_date !== $v) {
			$this->job_scheduled_date = $v;
			$this->modifiedColumns[] = WorkorderPeer::JOB_SCHEDULED_DATE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->device_id = $rs->getInt($startcol + 1);

			$this->client_id = $rs->getInt($startcol + 2);

			$this->tech = $rs->getInt($startcol + 3);

			$this->office = $rs->getInt($startcol + 4);

			$this->assigned_by = $rs->getInt($startcol + 5);

			$this->page_number = $rs->getString($startcol + 6);

			$this->travel_time = $rs->getString($startcol + 7);

			$this->onsite_time = $rs->getString($startcol + 8);

			$this->zip = $rs->getString($startcol + 9);

			$this->date_recieved = $rs->getString($startcol + 10);

			$this->date_completed = $rs->getString($startcol + 11);

			$this->invoice = $rs->getString($startcol + 12);

			$this->reason = $rs->getString($startcol + 13);

			$this->action_taken = $rs->getString($startcol + 14);

			$this->remarks = $rs->getString($startcol + 15);

			$this->job_date = $rs->getString($startcol + 16);

			$this->job_start = $rs->getString($startcol + 17);

			$this->job_end = $rs->getString($startcol + 18);

			$this->exact_time = $rs->getInt($startcol + 19);

			$this->sale_tax = $rs->getFloat($startcol + 20);

			$this->zone_charge = $rs->getFloat($startcol + 21);

			$this->shipping_handling = $rs->getFloat($startcol + 22);

			$this->total = $rs->getFloat($startcol + 23);

			$this->service_travel = $rs->getFloat($startcol + 24);

			$this->created_at = $rs->getTimestamp($startcol + 25, null);

			$this->updated_at = $rs->getTimestamp($startcol + 26, null);

			$this->job_status_id = $rs->getInt($startcol + 27);

			$this->job_type_id = $rs->getInt($startcol + 28);

			$this->workorder_type_id = $rs->getInt($startcol + 29);

			$this->caller = $rs->getString($startcol + 30);

			$this->job_scheduled_date = $rs->getString($startcol + 31);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 32; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Workorder object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WorkorderPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			WorkorderPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(WorkorderPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(WorkorderPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WorkorderPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aDevice !== null) {
				if ($this->aDevice->isModified()) {
					$affectedRows += $this->aDevice->save($con);
				}
				$this->setDevice($this->aDevice);
			}

			if ($this->aClient !== null) {
				if ($this->aClient->isModified()) {
					$affectedRows += $this->aClient->save($con);
				}
				$this->setClient($this->aClient);
			}

			if ($this->aJobStatus !== null) {
				if ($this->aJobStatus->isModified()) {
					$affectedRows += $this->aJobStatus->save($con);
				}
				$this->setJobStatus($this->aJobStatus);
			}

			if ($this->aJobType !== null) {
				if ($this->aJobType->isModified()) {
					$affectedRows += $this->aJobType->save($con);
				}
				$this->setJobType($this->aJobType);
			}

			if ($this->aWorkorderType !== null) {
				if ($this->aWorkorderType->isModified()) {
					$affectedRows += $this->aWorkorderType->save($con);
				}
				$this->setWorkorderType($this->aWorkorderType);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WorkorderPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += WorkorderPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aDevice !== null) {
				if (!$this->aDevice->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDevice->getValidationFailures());
				}
			}

			if ($this->aClient !== null) {
				if (!$this->aClient->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aClient->getValidationFailures());
				}
			}

			if ($this->aJobStatus !== null) {
				if (!$this->aJobStatus->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aJobStatus->getValidationFailures());
				}
			}

			if ($this->aJobType !== null) {
				if (!$this->aJobType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aJobType->getValidationFailures());
				}
			}

			if ($this->aWorkorderType !== null) {
				if (!$this->aWorkorderType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aWorkorderType->getValidationFailures());
				}
			}


			if (($retval = WorkorderPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WorkorderPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getDeviceId();
				break;
			case 2:
				return $this->getClientId();
				break;
			case 3:
				return $this->getTech();
				break;
			case 4:
				return $this->getOffice();
				break;
			case 5:
				return $this->getAssignedBy();
				break;
			case 6:
				return $this->getPageNumber();
				break;
			case 7:
				return $this->getTravelTime();
				break;
			case 8:
				return $this->getOnsiteTime();
				break;
			case 9:
				return $this->getZip();
				break;
			case 10:
				return $this->getDateRecieved();
				break;
			case 11:
				return $this->getDateCompleted();
				break;
			case 12:
				return $this->getInvoice();
				break;
			case 13:
				return $this->getReason();
				break;
			case 14:
				return $this->getActionTaken();
				break;
			case 15:
				return $this->getRemarks();
				break;
			case 16:
				return $this->getJobDate();
				break;
			case 17:
				return $this->getJobStart();
				break;
			case 18:
				return $this->getJobEnd();
				break;
			case 19:
				return $this->getExactTime();
				break;
			case 20:
				return $this->getSaleTax();
				break;
			case 21:
				return $this->getZoneCharge();
				break;
			case 22:
				return $this->getShippingHandling();
				break;
			case 23:
				return $this->getTotal();
				break;
			case 24:
				return $this->getServiceTravel();
				break;
			case 25:
				return $this->getCreatedAt();
				break;
			case 26:
				return $this->getUpdatedAt();
				break;
			case 27:
				return $this->getJobStatusId();
				break;
			case 28:
				return $this->getJobTypeId();
				break;
			case 29:
				return $this->getWorkorderTypeId();
				break;
			case 30:
				return $this->getCaller();
				break;
			case 31:
				return $this->getJobScheduledDate();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WorkorderPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDeviceId(),
			$keys[2] => $this->getClientId(),
			$keys[3] => $this->getTech(),
			$keys[4] => $this->getOffice(),
			$keys[5] => $this->getAssignedBy(),
			$keys[6] => $this->getPageNumber(),
			$keys[7] => $this->getTravelTime(),
			$keys[8] => $this->getOnsiteTime(),
			$keys[9] => $this->getZip(),
			$keys[10] => $this->getDateRecieved(),
			$keys[11] => $this->getDateCompleted(),
			$keys[12] => $this->getInvoice(),
			$keys[13] => $this->getReason(),
			$keys[14] => $this->getActionTaken(),
			$keys[15] => $this->getRemarks(),
			$keys[16] => $this->getJobDate(),
			$keys[17] => $this->getJobStart(),
			$keys[18] => $this->getJobEnd(),
			$keys[19] => $this->getExactTime(),
			$keys[20] => $this->getSaleTax(),
			$keys[21] => $this->getZoneCharge(),
			$keys[22] => $this->getShippingHandling(),
			$keys[23] => $this->getTotal(),
			$keys[24] => $this->getServiceTravel(),
			$keys[25] => $this->getCreatedAt(),
			$keys[26] => $this->getUpdatedAt(),
			$keys[27] => $this->getJobStatusId(),
			$keys[28] => $this->getJobTypeId(),
			$keys[29] => $this->getWorkorderTypeId(),
			$keys[30] => $this->getCaller(),
			$keys[31] => $this->getJobScheduledDate(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WorkorderPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setDeviceId($value);
				break;
			case 2:
				$this->setClientId($value);
				break;
			case 3:
				$this->setTech($value);
				break;
			case 4:
				$this->setOffice($value);
				break;
			case 5:
				$this->setAssignedBy($value);
				break;
			case 6:
				$this->setPageNumber($value);
				break;
			case 7:
				$this->setTravelTime($value);
				break;
			case 8:
				$this->setOnsiteTime($value);
				break;
			case 9:
				$this->setZip($value);
				break;
			case 10:
				$this->setDateRecieved($value);
				break;
			case 11:
				$this->setDateCompleted($value);
				break;
			case 12:
				$this->setInvoice($value);
				break;
			case 13:
				$this->setReason($value);
				break;
			case 14:
				$this->setActionTaken($value);
				break;
			case 15:
				$this->setRemarks($value);
				break;
			case 16:
				$this->setJobDate($value);
				break;
			case 17:
				$this->setJobStart($value);
				break;
			case 18:
				$this->setJobEnd($value);
				break;
			case 19:
				$this->setExactTime($value);
				break;
			case 20:
				$this->setSaleTax($value);
				break;
			case 21:
				$this->setZoneCharge($value);
				break;
			case 22:
				$this->setShippingHandling($value);
				break;
			case 23:
				$this->setTotal($value);
				break;
			case 24:
				$this->setServiceTravel($value);
				break;
			case 25:
				$this->setCreatedAt($value);
				break;
			case 26:
				$this->setUpdatedAt($value);
				break;
			case 27:
				$this->setJobStatusId($value);
				break;
			case 28:
				$this->setJobTypeId($value);
				break;
			case 29:
				$this->setWorkorderTypeId($value);
				break;
			case 30:
				$this->setCaller($value);
				break;
			case 31:
				$this->setJobScheduledDate($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WorkorderPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDeviceId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setClientId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTech($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setOffice($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setAssignedBy($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPageNumber($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setTravelTime($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setOnsiteTime($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setZip($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setDateRecieved($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setDateCompleted($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setInvoice($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setReason($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setActionTaken($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setRemarks($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setJobDate($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setJobStart($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setJobEnd($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setExactTime($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setSaleTax($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setZoneCharge($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setShippingHandling($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setTotal($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setServiceTravel($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setCreatedAt($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setUpdatedAt($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setJobStatusId($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setJobTypeId($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setWorkorderTypeId($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setCaller($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setJobScheduledDate($arr[$keys[31]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WorkorderPeer::DATABASE_NAME);

		if ($this->isColumnModified(WorkorderPeer::ID)) $criteria->add(WorkorderPeer::ID, $this->id);
		if ($this->isColumnModified(WorkorderPeer::DEVICE_ID)) $criteria->add(WorkorderPeer::DEVICE_ID, $this->device_id);
		if ($this->isColumnModified(WorkorderPeer::CLIENT_ID)) $criteria->add(WorkorderPeer::CLIENT_ID, $this->client_id);
		if ($this->isColumnModified(WorkorderPeer::TECH)) $criteria->add(WorkorderPeer::TECH, $this->tech);
		if ($this->isColumnModified(WorkorderPeer::OFFICE)) $criteria->add(WorkorderPeer::OFFICE, $this->office);
		if ($this->isColumnModified(WorkorderPeer::ASSIGNED_BY)) $criteria->add(WorkorderPeer::ASSIGNED_BY, $this->assigned_by);
		if ($this->isColumnModified(WorkorderPeer::PAGE_NUMBER)) $criteria->add(WorkorderPeer::PAGE_NUMBER, $this->page_number);
		if ($this->isColumnModified(WorkorderPeer::TRAVEL_TIME)) $criteria->add(WorkorderPeer::TRAVEL_TIME, $this->travel_time);
		if ($this->isColumnModified(WorkorderPeer::ONSITE_TIME)) $criteria->add(WorkorderPeer::ONSITE_TIME, $this->onsite_time);
		if ($this->isColumnModified(WorkorderPeer::ZIP)) $criteria->add(WorkorderPeer::ZIP, $this->zip);
		if ($this->isColumnModified(WorkorderPeer::DATE_RECIEVED)) $criteria->add(WorkorderPeer::DATE_RECIEVED, $this->date_recieved);
		if ($this->isColumnModified(WorkorderPeer::DATE_COMPLETED)) $criteria->add(WorkorderPeer::DATE_COMPLETED, $this->date_completed);
		if ($this->isColumnModified(WorkorderPeer::INVOICE)) $criteria->add(WorkorderPeer::INVOICE, $this->invoice);
		if ($this->isColumnModified(WorkorderPeer::REASON)) $criteria->add(WorkorderPeer::REASON, $this->reason);
		if ($this->isColumnModified(WorkorderPeer::ACTION_TAKEN)) $criteria->add(WorkorderPeer::ACTION_TAKEN, $this->action_taken);
		if ($this->isColumnModified(WorkorderPeer::REMARKS)) $criteria->add(WorkorderPeer::REMARKS, $this->remarks);
		if ($this->isColumnModified(WorkorderPeer::JOB_DATE)) $criteria->add(WorkorderPeer::JOB_DATE, $this->job_date);
		if ($this->isColumnModified(WorkorderPeer::JOB_START)) $criteria->add(WorkorderPeer::JOB_START, $this->job_start);
		if ($this->isColumnModified(WorkorderPeer::JOB_END)) $criteria->add(WorkorderPeer::JOB_END, $this->job_end);
		if ($this->isColumnModified(WorkorderPeer::EXACT_TIME)) $criteria->add(WorkorderPeer::EXACT_TIME, $this->exact_time);
		if ($this->isColumnModified(WorkorderPeer::SALE_TAX)) $criteria->add(WorkorderPeer::SALE_TAX, $this->sale_tax);
		if ($this->isColumnModified(WorkorderPeer::ZONE_CHARGE)) $criteria->add(WorkorderPeer::ZONE_CHARGE, $this->zone_charge);
		if ($this->isColumnModified(WorkorderPeer::SHIPPING_HANDLING)) $criteria->add(WorkorderPeer::SHIPPING_HANDLING, $this->shipping_handling);
		if ($this->isColumnModified(WorkorderPeer::TOTAL)) $criteria->add(WorkorderPeer::TOTAL, $this->total);
		if ($this->isColumnModified(WorkorderPeer::SERVICE_TRAVEL)) $criteria->add(WorkorderPeer::SERVICE_TRAVEL, $this->service_travel);
		if ($this->isColumnModified(WorkorderPeer::CREATED_AT)) $criteria->add(WorkorderPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(WorkorderPeer::UPDATED_AT)) $criteria->add(WorkorderPeer::UPDATED_AT, $this->updated_at);
		if ($this->isColumnModified(WorkorderPeer::JOB_STATUS_ID)) $criteria->add(WorkorderPeer::JOB_STATUS_ID, $this->job_status_id);
		if ($this->isColumnModified(WorkorderPeer::JOB_TYPE_ID)) $criteria->add(WorkorderPeer::JOB_TYPE_ID, $this->job_type_id);
		if ($this->isColumnModified(WorkorderPeer::WORKORDER_TYPE_ID)) $criteria->add(WorkorderPeer::WORKORDER_TYPE_ID, $this->workorder_type_id);
		if ($this->isColumnModified(WorkorderPeer::CALLER)) $criteria->add(WorkorderPeer::CALLER, $this->caller);
		if ($this->isColumnModified(WorkorderPeer::JOB_SCHEDULED_DATE)) $criteria->add(WorkorderPeer::JOB_SCHEDULED_DATE, $this->job_scheduled_date);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WorkorderPeer::DATABASE_NAME);

		$criteria->add(WorkorderPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setDeviceId($this->device_id);

		$copyObj->setClientId($this->client_id);

		$copyObj->setTech($this->tech);

		$copyObj->setOffice($this->office);

		$copyObj->setAssignedBy($this->assigned_by);

		$copyObj->setPageNumber($this->page_number);

		$copyObj->setTravelTime($this->travel_time);

		$copyObj->setOnsiteTime($this->onsite_time);

		$copyObj->setZip($this->zip);

		$copyObj->setDateRecieved($this->date_recieved);

		$copyObj->setDateCompleted($this->date_completed);

		$copyObj->setInvoice($this->invoice);

		$copyObj->setReason($this->reason);

		$copyObj->setActionTaken($this->action_taken);

		$copyObj->setRemarks($this->remarks);

		$copyObj->setJobDate($this->job_date);

		$copyObj->setJobStart($this->job_start);

		$copyObj->setJobEnd($this->job_end);

		$copyObj->setExactTime($this->exact_time);

		$copyObj->setSaleTax($this->sale_tax);

		$copyObj->setZoneCharge($this->zone_charge);

		$copyObj->setShippingHandling($this->shipping_handling);

		$copyObj->setTotal($this->total);

		$copyObj->setServiceTravel($this->service_travel);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);

		$copyObj->setJobStatusId($this->job_status_id);

		$copyObj->setJobTypeId($this->job_type_id);

		$copyObj->setWorkorderTypeId($this->workorder_type_id);

		$copyObj->setCaller($this->caller);

		$copyObj->setJobScheduledDate($this->job_scheduled_date);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new WorkorderPeer();
		}
		return self::$peer;
	}

	
	public function setDevice($v)
	{


		if ($v === null) {
			$this->setDeviceId(NULL);
		} else {
			$this->setDeviceId($v->getId());
		}


		$this->aDevice = $v;
	}


	
	public function getDevice($con = null)
	{
				include_once 'lib/model/om/BaseDevicePeer.php';

		if ($this->aDevice === null && ($this->device_id !== null)) {

			$this->aDevice = DevicePeer::retrieveByPK($this->device_id, $con);

			
		}
		return $this->aDevice;
	}

	
	public function setClient($v)
	{


		if ($v === null) {
			$this->setClientId(NULL);
		} else {
			$this->setClientId($v->getId());
		}


		$this->aClient = $v;
	}


	
	public function getClient($con = null)
	{
				include_once 'lib/model/om/BaseClientPeer.php';

		if ($this->aClient === null && ($this->client_id !== null)) {

			$this->aClient = ClientPeer::retrieveByPK($this->client_id, $con);

			
		}
		return $this->aClient;
	}

	
	public function setJobStatus($v)
	{


		if ($v === null) {
			$this->setJobStatusId(NULL);
		} else {
			$this->setJobStatusId($v->getId());
		}


		$this->aJobStatus = $v;
	}


	
	public function getJobStatus($con = null)
	{
				include_once 'lib/model/om/BaseJobStatusPeer.php';

		if ($this->aJobStatus === null && ($this->job_status_id !== null)) {

			$this->aJobStatus = JobStatusPeer::retrieveByPK($this->job_status_id, $con);

			
		}
		return $this->aJobStatus;
	}

	
	public function setJobType($v)
	{


		if ($v === null) {
			$this->setJobTypeId(NULL);
		} else {
			$this->setJobTypeId($v->getId());
		}


		$this->aJobType = $v;
	}


	
	public function getJobType($con = null)
	{
				include_once 'lib/model/om/BaseJobTypePeer.php';

		if ($this->aJobType === null && ($this->job_type_id !== null)) {

			$this->aJobType = JobTypePeer::retrieveByPK($this->job_type_id, $con);

			
		}
		return $this->aJobType;
	}

	
	public function setWorkorderType($v)
	{


		if ($v === null) {
			$this->setWorkorderTypeId(NULL);
		} else {
			$this->setWorkorderTypeId($v->getId());
		}


		$this->aWorkorderType = $v;
	}


	
	public function getWorkorderType($con = null)
	{
				include_once 'lib/model/om/BaseWorkorderTypePeer.php';

		if ($this->aWorkorderType === null && ($this->workorder_type_id !== null)) {

			$this->aWorkorderType = WorkorderTypePeer::retrieveByPK($this->workorder_type_id, $con);

			
		}
		return $this->aWorkorderType;
	}

} 