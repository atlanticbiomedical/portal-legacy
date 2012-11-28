<?php

/**
 * support actions.
 *
 * @package    atlbiomed
 * @subpackage support
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class supportActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
	$c = new Criteria();
	$c->add(UserPeer::USER_TYPE, 'Administrator');
	$c->add(UserPeer::USER_TYPE, 'Office');
	$this->administrator = UserPeer::doSelect($c);
  }
}
