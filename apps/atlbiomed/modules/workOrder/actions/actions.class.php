<?php

/**
 * workOrder actions.
 *
 * @package    atlbiomed
 * @subpackage workOrder
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class workOrderActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
        
		// default view values
		$this->bogusWorkOrder = new Workorder();
		$this->bogusWorkOrder->setJobStatusId('');
		$this->bogusWorkOrder->setJobTypeId('');
		$this->bogusWorkOrder->setTech('');
		$this->bogusWorkOrder->setClientId('');
		
		$this->technicians = array();
		$this->clients = array();
		
		$c = new Criteria();
		$c->addAscendingOrderByColumn(ClientPeer::CLIENT_IDENTIFICATION);
		$this->client_dropdown = ClientPeer::doSelect($c);
		
		$t = new Criteria();
		$t->addAscendingOrderByColumn(JobTypePeer::TYPE_NAME);
		$this->jobtype_dropdown = JobTypePeer::doSelect($t);
		
		$s = new Criteria();
		$s->addAscendingOrderByColumn(JobStatusPeer::STATUS_NAME);
		$this->jobstatus_dropdown = JobStatusPeer::doSelect($s);

		foreach($this->client_dropdown as $client)
		{
			$this->clients[$client->getId()] = $client->getClientIdentification();
		}
		
		foreach(UserPeer::getUserByType(1) as $tech)
		{
			$this->technicians[$tech->getId()] = $tech->getDisplayName();
		}
		
		$this->dateFilter = date('Y-m-d');
		$this->dateFilterType = 'day';	
		
			// show jobs
			$jobDate = date('Ymd');
			$usersWithWork = new Criteria();
			$workorders = new Criteria();
			
			if($this->getRequest()->getMethod() == sfRequest::POST)
			{
                 
				$this->dateFilter = $this->getRequestParameter('jobDate');
				$this->dateFilterType = $this->getRequestParameter('dateFilterType');
				
				if($this->getRequestParameter('client_id') != '')
				{
					$workorders->add(WorkorderPeer::CLIENT_ID, $this->getRequestParameter('client_id'));				
					$this->bogusWorkOrder->setClientId($this->getRequestParameter('client_id'));
				}	
			
				if($this->getRequestParameter('technician_id') != '')
				{
					$usersWithWork->add(UserPeer::ID, $this->getRequestParameter('technician_id'));
					$workorders->add(WorkorderTechPeer::USER_ID, $this->getRequestParameter('technician_id'));
					$workorders->addJoin(WorkorderPeer::ID, WorkorderTechPeer::WORKORDER_ID, Criteria::INNER_JOIN);
					
					$this->bogusWorkOrder->setTech($this->getRequestParameter('technician_id'));
				}
				
				if($this->getRequestParameter('job_status_id') != '')
				{
					$usersWithWork->add(WorkorderPeer::JOB_STATUS_ID, $this->getRequestParameter('job_status_id'));
					$workorders->add(WorkorderPeer::JOB_STATUS_ID, $this->getRequestParameter('job_status_id'));
					
					$this->bogusWorkOrder->setJobStatusId($this->getRequestParameter('job_status_id'));
				}
		
		
			}
			
			$usersWithWork->addJoin(UserPeer::ID, WorkorderPeer::TECH);
			$usersWithWork->setDistinct(true);
			
			if ($this->dateFilterType == 'day')
			{
				$usersWithWork->add(WorkorderPeer::JOB_DATE, $this->getRequestParameter('jobDate'));
				$workorders->add(WorkorderPeer::JOB_DATE, $this->getRequestParameter('jobDate'));	
			}
			else if ($this->dateFilterType == 'month')
			{
				$year = substr($this->getRequestParameter('jobDate'), 0, 4);
				$month = substr($this->getRequestParameter('jobDate'), 5, 2);
				
				$start = $year . '-' . $month . '-01';
				$end = $year . '-' . $month . '-31'; // easy check, even for months without 31 days since all dates are 
											  		 // strings in our database
											  
				$usersWithWork->add(WorkorderPeer::JOB_DATE, $start, Criteria::GREATER_EQUAL);
				$usersWithWork->addAnd($usersWithWork->getNewCriterion(WorkorderPeer::JOB_DATE, $end, Criteria::LESS_EQUAL)); // inclusive
				
				$workorders->add(WorkorderPeer::JOB_DATE, $start, Criteria::GREATER_EQUAL);
				$workorders->addAnd($workorders->getNewCriterion(WorkorderPeer::JOB_DATE, $end, Criteria::LESS_EQUAL)); // inclusive
			}
  			else if ($this->dateFilterType == 'year')
			{
				
				$year = substr($this->getRequestParameter('jobDate'), 0, 4);
				$startMonth = "01";
				$endMonth = "12";
				
				$start = $year . '-' . $startMonth . '-01';
				$end = $year . '-' . $endMonth . '-31'; // easy check, even for months without 31 days since all dates are 
											  		 // strings in our database

				
				$usersWithWork->add(WorkorderPeer::JOB_DATE, $start, Criteria::GREATER_EQUAL);
				$usersWithWork->addAnd($usersWithWork->getNewCriterion(WorkorderPeer::JOB_DATE, $end, Criteria::LESS_EQUAL)); // inclusive
				
				$workorders->add(WorkorderPeer::JOB_DATE, $start, Criteria::GREATER_EQUAL);
				$workorders->addAnd($workorders->getNewCriterion(WorkorderPeer::JOB_DATE, $end, Criteria::LESS_EQUAL)); // inclusive
			}
			else
			{
				// week from the selected date
				$start = date('Y-m-d', strtotime($this->getRequestParameter('jobDate')));
				$end = date('Y-m-d', strtotime('+7 days', strtotime($this->getRequestParameter('jobDate'))));
				
				//$this->renderText($start . $end); return sfView::NONE;
				$usersWithWork->add(WorkorderPeer::JOB_DATE, $end, Criteria::LESS_THAN); // exclusive
				$usersWithWork->addAnd($usersWithWork->getNewCriterion(WorkorderPeer::JOB_DATE, $start, Criteria::GREATER_EQUAL));
				
				$workorders->add(WorkorderPeer::JOB_DATE, $end, Criteria::LESS_THAN); // exclusive
				$workorders->addAnd($workorders->getNewCriterion(WorkorderPeer::JOB_DATE, $start, Criteria::GREATER_EQUAL));
			}
			
			$this->techs = UserPeer::doSelect($usersWithWork);
			$this->orders = WorkorderPeer::doSelect($workorders);
	
		
	}
	
	public function executePopulateWorkorder()
	{
		$ticket = $this->getRequestParameter('ticket');
	
		$t = new Criteria();
		$t->addAscendingOrderByColumn(JobTypePeer::TYPE_NAME);
		$this->jobtype_dropdown = JobTypePeer::doSelect($t);
		
		$s = new Criteria();
		$s->addAscendingOrderByColumn(JobStatusPeer::STATUS_NAME);
		$this->jobstatus_dropdown = JobStatusPeer::doSelect($s);
		
		$g = new Criteria();
		$g->add(DropdownPeer::MENU, 'reason');
		$g->addAscendingOrderByColumn(DropdownPeer::VALUE);
		$this->reason_dropdown = DropdownPeer::doSelect($g);	
	
		$this->openWorkorder = WorkorderPeer::retrieveByPk($ticket);
		$this->openClient = ClientPeer::retrieveByPk($this->openWorkorder->getClientId());
		$this->openTech = UserPeer::retrieveByPk($this->openWorkorder->getTech());
		$this->openDevice = DevicePeer::retrieveByPk($this->openWorkorder->getDeviceId());
		$reason = $this->openWorkorder->getReason();
		if (!empty($reason)){
		$this->openReason = DropdownPeer::retrieveByPk($this->openWorkorder->getReason());
		}
		$this->type_select = $this->openWorkorder->getJobTypeId();
		$this->status_select = $this->openWorkorder->getJobStatusId();
		
	}
    public function executeUpdateworkorder(){
        $wid_y = $this->getRequestParameter('wid');
        $invoice_num = $this->getRequestParameter('invoice_num');
        $action = $this->getRequestParameter('action_taken');
        $remarks_y = $this->getRequestParameter('remarks');
        $job_status = $this->getRequestParameter('job_status');
        $job_type = $this->getRequestParameter('job_type');
        $reason_select_y = $this->getRequestParameter('reason_select');
        $onsite_time = $this->getRequestParameter('onsite_time');
        $travel_time = $this->getRequestParameter('travel_time');

        $travel_service = $this->getRequestParameter('travel_service');
        $zone_charge = $this->getRequestParameter('zone_charge');
        $salestax = $this->getRequestParameter('salestax');
        $shipping = $this->getRequestParameter('shipping');
        $cid = $this->getRequestParameter('cid');
        $name = $this->getRequestParameter('print_name');

 

        $c = new Criteria();
        $c->add(WorkorderPeer::ID,$wid_y);
        $wo = WorkorderPeer::doSelectOne($c);

        if(!$wo){
          print "<script type='text/javascript'>alert('Unable to save data');</script>";
          return sfView::NONE;
        }

        $c = new Criteria();
        $c->add(ClientPeer::ID,$cid);
        $client = ClientPeer::doSelectOne($c);
        if($client){
           $client->setAttn($name);
           $client->save();
        }
          
        $wo->setTravelTime($travel_time);
        $wo->setOnsiteTime($onsite_time);
        $wo->setReason($reason_select_y);
        $wo->setJobTypeId($job_type);
        $wo->setJobStatusId($job_status);
        $wo->setInvoice($invoice_num);
        $wo->setRemarks($remarks_y);
        $wo->setActionTaken($action);
        $wo->setSaletax($salestax);
        $wo->setServiceTravel($travel_service);
        $wo->setShippingHandling($shipping);
        $wo->setZoneCharge($zone_charge);
        if(!empty($invoice_num))
           $wo->setJobStatusId(7);
        $wo->save();
        print "<script type='text/javascript'>alert('Data was save successfully');</script>";
        return sfView::NONE;
          
    }

 /* public function executeInformation()
  {
	  $r = new Criteria();
			$this->result = array();

			$search_select = $this->getRequestParameter('search_select');

			if (isset($search_select))
			{

//				$search_by = $this->getRequestParameter('search_by');

				switch($this->search_by)
				{
					case 'Client':
						$r->add(WorkorderPeer::CLIENT_ID, $this->getRequestParameter('search_select'));
						
						break;
					case 'Technician':
						$r->add(WorkorderPeer::TECH, $this->getRequestParameter('search_select'));
						break;
					case 'Date':
						$r->add(WorkorderPeer::DATE_RECIEVED, $this->getRequestParameter('search_select'));
						break;
					case 'Status':
						$r->add(workorderPeer::JOB_STATUS, $this->getRequestParameter('search_select'));
						break;					
				}
			$r->addJoin(WorkorderPeer::CLIENT_ID, ClientPeer::ID);
			$r->addJoin(WorkorderPeer::TECH, UserPeer::ID);
			$join = new sfPropelCustomJoinHelper('Workorder');
			$join->addSelectTables('Client', 'User');
			$join->setHas('Workorder', 'User');
			$join->setHas('Workorder', 'Client');

			$this->result = $join->doSelect($r); 

			}
			

	$this->redirect('workOrder/search_by/'.$search_by);

  }*/

/*  public function executeSelectWorkorder()
  {
		$search_by = $this->getRequestParameter('search_by');

		$r = new Criteria();
		$result = new Workorder();


		switch($search_by)
		{
			case 'Client':
				$r->add(WorkorderPeer::CLIENT_ID, $this->getRequestParameter('search_select'));
				$result = WorkorderPeer::doSelect($r);
				break;
			case 'Technician':
				$r->add(WorkorderPeer::TECH, $this->getRequestParameter('search_select'));
				$result = WorkorderPeer::doSelect($r);
				break;
//			case 'Date':
//				$r->add(WorkorderPeer::DATE, $this->getRequestParameter('search_select'
//				break;
			case 'Status':
				$r->add(workorderPeer::STATUS, $this->getRequestParameter('search_select'));
				$result = WorkorderPeer::doSelect($r);
				break;					
		}
		$this->redirect('workOrder/index?searchby='.$this->getRequestParameter('search_by'));
  }*/
}

