<?php

/**
 * dashboard actions.
 *
 * @package    atlbiomed
 * @subpackage dashboard
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class dashboardActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
	  		$this->date = date('Y-m-d');	
  }
}
