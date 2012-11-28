<?php

/**
 * Subclass for performing query and update operations on the 'job_type' table.
 *
 * 
 *
 * @package lib.model
 */ 
class JobTypePeer extends BaseJobTypePeer
{
	/*
	 * We overrode this function so that when you look up the JobType
	 * objects for a call to object_select_tag, it will add a sort order
	 * automatically.  The default behaviour is to not add a sort; we 
	 * changed it.
	 */
	public static function doSelect(Criteria $criteria, $con = null)
	{
		if (sizeof($criteria->getOrderByColumns()) == 0)
		{
			$criteria->addAscendingOrderByColumn(JobTypePeer::TYPE_NAME);
		}
		
		return JobTypePeer::populateObjects(JobTypePeer::doSelectRS($criteria, $con));
	}
}
