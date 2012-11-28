<?php

/**
 * messages actions.
 *
 * @package    atlbiomed
 * @subpackage messages
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class messagesActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
  	$userId = $this->getUser()->getAttribute('userId');
  		
     	$user = UserPeer::retrieveByPk ($userId);
	    if($user){
	  		$email = $user->getEmail();
	     	$firstName = $user->getFirstName();
     	}
        $signed_info = $firstName."||".$email;
        

 
     if($this->getRequest()->getMethod() == sfRequest::POST && !empty($userId)){
     	
     	
     	
		$for = $this->getRequestParameter('for');
		$name = $this->getRequestParameter('name');
		$company = $this->getRequestParameter('company');
		$phone = "(".$this->getRequestParameter('phone').")".$this->getRequestParameter('phone-2')."-".$this->getRequestParameter('phone-3');
		$ext = "ext. ".$this->getRequestParameter('ext');
		$time_to_call = $this->getRequestParameter('time_to_call');
		$mobile = "(".$this->getRequestParameter('mobile').")".$this->getRequestParameter('mobile-2')."-".$this->getRequestParameter('mobile-3');
		$time_to_call_mobile = $this->getRequestParameter('time_to_call_mobile');
		$fax = "(".$this->getRequestParameter('fax').")".$this->getRequestParameter('fax-2')."-".$this->getRequestParameter('fax-3');
		$telephoned = $this->getRequestParameter('telephoned');
		$came_to_see_you = $this->getRequestParameter('came_to_see_you');
		$wants_to_see_you = $this->getRequestParameter('wants_to_see_you');
		$returned_your_call = $this->getRequestParameter('returned_your_call');
		$please_call = $this->getRequestParameter('please_call');
		$will_call_again = $this->getRequestParameter('will_call_again');
		$rush = $this->getRequestParameter('rush');
		$special_attention = $this->getRequestParameter('special_attention');
		$callers_message = $this->getRequestParameter('callers_message');
		$signed_data = explode('||',$signed_info);
		
		//$signed = $_POST['signed'];
		//$from = $_POST['signed'];
		$signed = $signed_data[0];
		$from = $signed_data[0];
		$reply_to = $signed_data[1];
		

 
		
		$date = "Time of call: ".date("F j, Y, g:i a");
		$time = date("F j, Y, g:i a");
		
		if($ext == 'ext. ')
		  $ext = '';
		  else $ext = $ext;
		
		if($time_to_call != '')
		  $time_to_call = 'Time to call: '.$time_to_call;
		
		if($mobile != '()-')
		  $mobile = 'Mobile: '.$mobile;
		  else $mobile = '';
		
		if($time_to_call_mobile != '')
		  $time_to_call_mobile = 'Time to call mobile: '.$time_to_call_mobile;
		
		if($fax != '()-')
		  $fax = 'Fax: '.$fax;
		  else $fax = '';
		
		if($telephoned == 'on')
		  $telephoned = 'Telephoned';
		  else $telephoned = '';
		
		if($came_to_see_you == 'on')
		  $came_to_see_you = 'Came to see you';
		  else $came_to_see_you = '';
		
		if($wants_to_see_you == 'on')
		  $wants_to_see_you = 'Wants to see you';
		  else $wants_to_see_you = '';
		
		if($returned_your_call == 'on')
		  $returned_your_call = 'Returned your call';
		  else $returned_your_call = '';
		
		if($please_call == 'on')
		  $please_call = 'Please call';
		  else $please_call = '';
		
		if($will_call_again == 'on')
		  $will_call_again = 'Will call again';
		  else $will_call_again = '';
		
		if($rush == 'on')
		  $rush = 'Rush';
		  else $rush = '';
		
		if($special_attention == 'on')
		  $special_attention = 'Special Attention';
		  else $special_attention = '';
		  
		if($callers_message != '')
		  $callers_message = 'Message: '.$callers_message;
		  
		if($signed != '')
		  $signed = 'Signed: '.$signed;
		
		$body = "$date
		
		Name: $name
		Company: $company
		
		Phone: $phone $ext
		
		";
		
		if($time_to_call != '')
		$body .= $time_to_call;
		
		if($mobile != '')
		$body .= $mobile;
		if($time_to_call_mobile != '')
		$body .= $time_to_call_mobile;
		
		if($fax != '')
		$body .= $fax;
		
		if($telephoned != '' || $came_to_see_you != '' || $wants_to_see_you != '' || $returned_your_call != '' || $please_call != '' || $will_call_again != '' || $rush != '' || $special_attention != '')
		$body .= "
		
		Please:
		";
		
		if($telephoned != '')
		$body .= $telephoned."\n";
		if($came_to_see_you != '')
		$body .= $came_to_see_you."\n";
		if($wants_to_see_you != '')
		$body .= $wants_to_see_you."\n";
		if($returned_your_call != '')
		$body .= $returned_your_call."\n";
		if($please_call != '')
		$body .= $please_call."\n";
		if($will_call_again != '')
		$body .= $will_call_again."\n";
		if($rush != '')
		$body .= $rush."\n";
		if($special_attention != '')
		$body .= $special_attention."\n";
		
		$body .= "
		
		$callers_message
		
		$signed";
		
		$subject = "Important Message From " . $name ." - ". $time;
		
		//mail($for, $subject, $body, 'from: messages@atlanticbiomedical.com');
		mail($for, $subject, $body, "from: $reply_to");
		$this->redirect('messages/index');
		//header('Location: /messages/index.php');
     }
  }
}
