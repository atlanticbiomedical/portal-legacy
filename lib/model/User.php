<?php

/**
 * Subclass for representing a row from the 'user' table.
 *
 * 
 *
 * @package lib.model
 */ 
class User extends BaseUser
{
	public function getDisplayName()
	{
		return $this->getLastName() . ', ' . $this->getFirstName();
	}
        public function getFullAddress(){
                return $this->getAddress().' '.$this->getCity().' '.$this->getState().' '.$this->getZip();
        } 
}
