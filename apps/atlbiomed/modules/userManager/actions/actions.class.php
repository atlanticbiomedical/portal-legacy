<?php

/**
 * userManager actions.
 *
 * @package    atlbiomed
 * @subpackage userManager
 * @author     nicholas hepner
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class userManagerActions extends sfActions
{

  protected $user_info;
  public function executeIndex()
  {
	//set values for start/end time radio boxes
	$this->start_time_am = true;
	$this->start_time_pm = false;
	$this->end_time_am = true;
	$this->end_time_pm = false;
	$this->start_time_hours = '';
	$this->start_time_minutes = '';
	$this->end_time_hours = '';
	$this->end_time_minutes = '';

	//populate user type dropdown
	$this->userTypes = UserTypePeer::doSelect(new Criteria());

	//Current Users;
	$this->current_user = UserPeer::doSelect(new Criteria());
	
	//Initialize "mode"
	if(!isset($this->mode))
	{
		$this->mode = '';
	}

	//Initialize "saveStatus"
	if($this->getRequestParameter('saveStatus') == 'success')
	{
		$this->saveStatus = 'success';
	} else {
		$this->saveStatus = '';
	}

	


	//Initialize form values
	$this->populateUser = new User();

	if($this->getRequestParameter('mode') == 'edit')
	{
		$user_id = $this->getRequestParameter('id');
		$this->populateUser = UserPeer::retrieveByPk($user_id);

		//parse start/end times

		
		$start_time = $this->populateUser->getStartTime();
		$end_time = $this->populateUser->getEndTime();

		$this->start_time_minutes = $start_time % 100;
		$this->start_time_hours = ($start_time - $this->start_time_minutes) / 100;

		$this->end_time_minutes = $end_time % 100;
		$this->end_time_hours = ($end_time - $this->end_time_minutes) / 100;

		if ($this->start_time_hours > 12)
		{
			$this->start_time_hours = $this->start_time_hours - 12;
			$this->start_time_am = false;
			$this->start_time_pm = true;
		}

		if ($this->end_time_hours > 12)
		{
			$this->end_time_hours = $this->end_time_hours - 12;
			$this->end_time_am = false;
			$this->end_time_pm = true;
		}

		//make minutes more visable in end production
		if ($this->start_time_minutes < 10)
		{
			$this->start_time_minutes = '0'.$this->start_time_minutes;
		}

		if ($this->end_time_minutes < 10)
		{
			$this->end_time_minutes = '0'.$this->end_time_minutes;
		}
		
		$this->mode = 'edit';

	}else{
		$this->populateUser->setUserName('');
		$this->populateUser->setFirstName('');
		$this->populateUser->setLastName('');
		$this->populateUser->setEmail('');
		$this->populateUser->setPhone('');
		$this->populateUser->setAddress('');
		$this->populateUser->setAddress2('');
		$this->populateUser->setCity('');
		$this->populateUser->setState('');
		$this->populateUser->setZip('');
		$this->populateUser->setPassword('');
	} 
  }

  public function executeAddUser()
  {

		$user = new User();

		if($this->getRequestParameter('mode') == 'edit')
		{
			$user_id = $this->getRequestParameter('id');
			$user = UserPeer::retrieveByPk($user_id);
		}

		$user->setUserName($this->getRequestParameter('user_name'));
		$user->setFirstName($this->getRequestParameter('first_name'));
		$user->setLastName($this->getRequestParameter('last_name'));
		$user->setEmail($this->getRequestParameter('email'));
		$user->setPhone($this->getRequestParameter('phone'));
		$user->setAddress($this->getRequestParameter('address'));
		$user->setAddress2($this->getRequestParameter('address2'));
		$user->setCity(ucfirst($this->getRequestParameter('city')));
		$user->setState($this->getRequestParameter('state'));
		$user->setZip($this->getRequestParameter('zip'));
		$user->setPassword($this->getRequestParameter('password'));
		$user->setUserTypeId($this->getRequestParameter('user_type_id'));
		$user->setWeight($this->getRequestParameter('order_weight'));
		
		
		$start_hrs = $this->getRequestParameter('start_time_hours');
		$start_min = $this->getRequestParameter('start_time_minutes');
		$start_ampm = $this->getRequestParameter('start_time_ampm');
		$end_hrs = $this->getRequestParameter('end_time_hours');
		$end_min = $this->getRequestParameter('end_time_minutes');
		$end_ampm = $this->getRequestParameter('end_time_ampm');
		
		if($start_ampm == 'am'){
			if($start_hrs < 10){
				$start_hrs = '0'.$start_hrs;
			}
			$start_hrs = $start_hrs;
		}
		if($start_ampm == 'pm'){
			$start_hrs = $start_hrs + 12;
		}
		$start_time = $start_hrs.$start_min;
		if($end_ampm == 'am'){
			if($end_hrs < 10){
				$end_hrs = '0'.$end_hrs;
			}
			$end_hrs = $end_hrs;
		}
		if($end_ampm == 'pm'){
			$end_hrs = $end_hrs + 12;
		}
		$end_time = $end_hrs.$end_min;

		
		$user->setStartTime($start_time);
		$user->setEndTime($end_time);
		
		
				
		$user->save();

		$this->redirect('userManager/index?mode=edit&id='.$user->getId().'&saveStatus=success');
 	}

	public function handleErrorAddUser()
	{
		$this->forward('userManager', 'index');
	}
   
	public function startEndTime($user_info)
	{

	    $start_time_hours = $user_info['start_time_hours'];
		$start_time_minutes = $user_info['start_time_minutes'];
		$start_time_ampm = $user_info['start_time_ampm'];

		unset($user_info['start_time_hours']);
		unset($user_info['start_time_minutes']);
		unset($user_info['start_time_ampm']);

		if ( $start_time_ampm == 'pm' )
		{
			$start_time_hours = $start_time_hours + 12;
		}

		$user_info['start_time'] = $start_time_hours.$start_time_minutes;

		$end_time_hours = $user_info['end_time_hours'];
		$end_time_minutes = $user_info['end_time_minutes'];
		$end_time_ampm = $user_info['end_time_ampm'];

		unset($user_info['end_time_hours']);
		unset($user_info['end_time_minutes']);
		unset($user_info['end_time_ampm']);

		$user_info['end_time'] = $end_time_hours.$end_time_minutes;
	}

	public function executeDeleteUser()
	{

		$user_id = $this->getRequestParameter('delete_user');

		$user = UserPeer::retrieveByPk($user_id);
		$user->delete();

		$this->redirect('userManager/index');
	}

}
?>
