<?php

/**
 * Subclass for performing query and update operations on the 'workorder_tech' table.
 *
 * 
 *
 * @package lib.model
 */ 
class WorkorderTechPeer extends BaseWorkorderTechPeer
{

	public static function getWorkorderTechInfo($workorderId)
	{
		$c = new Criteria ();
		$c->add(WorkorderTechPeer::WORKORDER_ID, $workorderId);
		$c->addJoin(UserPeer::ID, WorkorderTechPeer::USER_ID, Criteria::INNER_JOIN);
		
		return UserPeer::doSelect($c);
	}
	
	public static function getWorkorderTechs($workorderId)
	{
		$c = new Criteria ();
		$c->add(WorkorderTechPeer::WORKORDER_ID, $workorderId);
		
		return WorkorderTechPeer::doSelect($c);
	}
	
	public static function getPrimaryTech($workorderId, $userId)
	{
		$c = new Criteria ();
		$c->add(WorkorderTechPeer::WORKORDER_ID, $workorderId);
		$c->add(WorkorderTechPeer::USER_ID, $userId);
		return WorkorderTechPeer::doSelect($c);
	}
	
	public static function getSecondaryTech($workorderId, $userId)
	{
		$c = new Criteria ();
		$c->add(WorkorderTechPeer::WORKORDER_ID, $workorderId);
		$c->add(WorkorderTechPeer::USER_ID, $userId, Criteria::NOT_EQUAL);
		return WorkorderTechPeer::doSelect($c);
	}


}
