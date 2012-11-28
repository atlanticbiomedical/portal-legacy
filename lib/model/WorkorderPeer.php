<?php

/**
 * Subclass for performing query and update operations on the 'workorder' table.
 *
 * 
 *
 * @package lib.model
 */ 
class WorkorderPeer extends BaseWorkorderPeer
{
	/*
	 * Retrieves all workorders for a tech on a specific day.
	 */
	public static function getOrdersForTechnician($technicianId, $jobDate)
	{
		$c = new Criteria ();
		$c->add(WorkorderTechPeer::USER_ID, $technicianId);
		$c->addJoin(WorkorderPeer::ID, WorkorderTechPeer::WORKORDER_ID, Criteria::INNER_JOIN );
		$c->add(WorkorderPeer::JOB_DATE, $jobDate);
		$c->addDescendingOrderByColumn(WorkorderPeer::JOB_START);
		$c->addAscendingOrderByColumn(WorkorderPeer::JOB_END);
		$c->addAscendingOrderByColumn(WorkorderTechPeer::WORKORDER_ID);

		
		return WorkorderPeer::doSelect($c);
	}
}


 