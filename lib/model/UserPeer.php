<?php

/**
 * Subclass for performing query and update operations on the 'user' table.
 *
 * 
 *
 * @package lib.model
 */ 
class UserPeer extends BaseUserPeer
{
	/*
	 * We overrode this function so that when you look up the User
	 * objects for a call to object_select_tag, it will add a sort order
	 * automatically.  The default behaviour is to not add a sort; we 
	 * changed it.
	 */
	public static function doSelect(Criteria $criteria, $con = null)
	{
		if (sizeof($criteria->getOrderByColumns()) == 0)
		{
			$criteria->addAscendingOrderByColumn(UserPeer::LAST_NAME);
			$criteria->addAscendingOrderByColumn(UserPeer::FIRST_NAME);
		}
		
		return UserPeer::populateObjects(UserPeer::doSelectRS($criteria, $con));
	}
	
	/*
	 * Gets a list of users of a specific type (tech, office, etc)
	 *
	 * $typeId: The id# of the type of user to retrieve.
	 */
	public static function getUserByType($typeId)
	{
		$c = new Criteria();
		$c->add(UserPeer::USER_TYPE_ID, $typeId);
		
		return UserPeer::doSelect($c);
	}
	
	public static function getWorkorderSTech($workorderId, $techId)
	{
		$c = new Criteria ();
		$c->add(WorkorderTechPeer::WORKORDER_ID, $workorderId);
		$c->add(WorkorderTechPeer::USER_ID, $techId, Criteria::NOT_EQUAL);
		$c->addJoin(UserPeer::ID, WorkorderTechPeer::USER_ID, Criteria::INNER_JOIN);
		
		return UserPeer::doSelect($c);
	}
	public function getFullAddress(){
                return $this->getAddress().' '.$this->getCity().' '.$this->getState().' '.$this->getZip();
        } 
	
	
}
