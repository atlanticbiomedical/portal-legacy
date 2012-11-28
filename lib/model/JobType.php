<?php

/**
 * Subclass for representing a row from the 'job_type' table.
 *
 * 
 *
 * @package lib.model
 */ 
class JobType extends BaseJobType
{	
	public function __toString()
	{
		return $this->getTypeName();
	}
}
