<?php

/**
 * Subclass for performing query and update operations on the 'client' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ClientPeer extends BaseClientPeer
{
      public function getFullAddress(){
       return $this->getAddress().' '.$this->getCity().' '.$this->getState().' '.$this->getZip();
   }
}
