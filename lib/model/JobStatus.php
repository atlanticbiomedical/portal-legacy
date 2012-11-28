<?php

/**
 * Subclass for representing a row from the 'job_status' table.
 *
 * 
 *
 * @package lib.model
 */ 
class JobStatus extends BaseJobStatus
{
	public function __toString()
	{
		return $this->getStatusName();
	}
}
