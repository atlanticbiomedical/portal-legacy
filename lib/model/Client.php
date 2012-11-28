<?php

/**
 * Subclass for representing a row from the 'client' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Client extends BaseClient
{
   public function getFullAddress(){
       return $this->getAddress().' '.$this->getCity().' '.$this->getState().' '.$this->getZip();
   }
}
