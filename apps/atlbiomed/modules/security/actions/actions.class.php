<?php

/**
 * security actions.
 *
 * @package    atlbiomed
 * @subpackage security
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class securityActions extends sfActions
{
  public function executeSecure()
  {
  }
  
  /**
   * Generates a random challenge string.
   *
   */
  private function generateChallenge()
  {
    return substr(preg_replace('/[\/\\\:*?"<>|.$^1]/', '', crypt(time())), 0, 16);
  }
  
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {    
  	if($this->getRequest()->getMethod() == sfRequest::POST)
  	{
  		// check fields
  		$username = $this->getRequestParameter('username');
  		$password = $this->getRequestParameter('password');
/*  		$password = hash('sha256', $password);*/
  		
  		// authenticate user
  		$c = new Criteria();
  		$c->add(UserPeer::USER_NAME, $username);
  		$c->add(UserPeer::PASSWORD, $password);
  		
  		$user = UserPeer::doSelectOne($c);
  
  		 
  		
  		if($user != null)
  		{
  			// success
  			$userId = $user->getId();
  			
  			$this->getUser()->setAuthenticated(true);
	  		$this->getUser()->addCredential($user->getUserType()->getTypeName());
	  		$this->getUser()->setAttribute('name', $user->getDisplayName());
	  		$this->getUser()->setAttribute('userId',$userId);
	  		
	  		$this->redirect('scheduler');
  		}
  	}
  	
  	$this->logoutUser();
  }
  
  public function executeLogout()
  {
  	$this->logoutUser();
  	$this->redirect('security/index');
  }
  
  private function logoutUser()
  {
	$this->getUser()->setAuthenticated(false);
    $this->getUser()->clearCredentials();
    $this->getUser()->getAttributeHolder()->remove('name');
  }
  
  public function handleErrorIndex()
  {
  	return sfView::SUCCESS;
  }
  
}
