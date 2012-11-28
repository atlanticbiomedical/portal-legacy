<?php

/**
 * maps actions.
 *
 * @package    atlbiomed
 * @subpackage maps
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class mapsActions extends sfActions
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
		
		$this->technicians = array();

		foreach(UserPeer::getUserByType(1) as $tech)
		{
			$this->technicians[$tech->getId()] = $tech->getDisplayName();
		}
		
		$this->dateFilter = date('Y-m-d');
		$this->dateFilterType = 'day';	
		
		$this->markers = array();
		if ($this->getRequestParameter('viewMode', 0) == 1)
		{
			// show all clients
			
			foreach(ClientPeer::doSelect(new Criteria()) as $client)
			{
				$title = $client->getClientIdentification() . ' - ' . $client->getClientName();
				
				$address = $client->getAddress() . ' ' . 
						   $client->getCity() . ' ' . 
						   $client->getState() . ' ' .
						   $client->getZip();
						   
				$content = $address . '<br />' .
						   'ATTN: ' . $client->getAttn() . '<br />' .
						   'Phone: ' . $client->getPhone();
				
				if(!$client->getLocation())
					$this->markers[] = new GMapMarker($address, '', '',$title, $content, 'green');
				else
					$this->markers[] = new GMapMarker($address, 
													  $client->getLocation()->getLatitude(), 
													  $client->getLocation()->getLongitude(), $title, $content, 'green');
			}
		}
		else
		{
			// show jobs
			$jobDate = date('Ymd');
			$usersWithWork = new Criteria();
			$workorders = new Criteria();
			
			if($this->getRequest()->getMethod() == sfRequest::POST)
			{
				$this->dateFilter = $this->getRequestParameter('jobDate');
				$this->dateFilterType = $this->getRequestParameter('dateFilterType');
			
				if($this->getRequestParameter('technicianId') != '')
				{
					$usersWithWork->add(UserPeer::ID, $this->getRequestParameter('technicianId'));
					$workorders->add(WorkorderTechPeer::USER_ID, $this->getRequestParameter('technicianId'));
					$workorders->addJoin(WorkorderPeer::ID, WorkorderTechPeer::WORKORDER_ID, Criteria::INNER_JOIN);
					
					$this->bogusWorkOrder->setTech($this->getRequestParameter('technicianId'));
				}
				
				if($this->getRequestParameter('job_status_id') != '')
				{
					$usersWithWork->add(WorkorderPeer::JOB_STATUS_ID, $this->getRequestParameter('job_status_id'));
					$workorders->add(WorkorderPeer::JOB_STATUS_ID, $this->getRequestParameter('job_status_id'));
					
					$this->bogusWorkOrder->setJobStatusId($this->getRequestParameter('job_status_id'));
				}
		
				if($this->getRequestParameter('job_type_id') != '')
				{
					$workorders->add(WorkorderPeer::JOB_TYPE_ID, $this->getRequestParameter('job_type_id'));
					
					$this->bogusWorkOrder->setJobTypeId($this->getRequestParameter('job_type_id'));
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
			
			$techs = UserPeer::doSelect($usersWithWork);
			$orders = WorkorderPeer::doSelect($workorders);
	
			foreach($orders as $order)
			{
				$findTech = create_function('$tech', 'return $tech->getId() ==' . $order->getTech() . ';');
				$theTech = array_filter($techs, $findTech);
				
				if(isset($theTech) && count($theTech) == 1)
				{
					$address = $order->getClient()->getAddress() . ' ' . 
								$order->getClient()->getCity() . ' ' .
								$order->getClient()->getState() . ' ' .
								$order->getClient()->getZip();
					
					$jobDate = $order->getJobDate();
							   
					$tech = array_pop($theTech);
					$content = 'Contact: ' . $order->getClient()->getAttn() . '<br />' . 
							   'Phone: ' . $order->getClient()->getPhone() . '<br />' . 
							   'City: ' . $order->getClient()->getCity() . ', ' . $order->getClient()->getState() . '<br/><span class="red">';
					if($order->getClient()->getAnesthesia() != null){		
						$content .= $order->getClient()->getAnesthesia();
					}
					if($order->getClient()->getAnesthesia() != null && $order->getClient()->getMedgas() != null){
						$content .= '&nbsp;&frasl;&nbsp;';
					}
					if($order->getClient()->getMedgas() != null){
						$content .= $order->getClient()->getMedgas();
					}
					$content .= '</span><br/><br/>' .
							   '<a href="/index.php/scheduler/index/mode/edit/ticket/' .$order->getId().'" >Schedule</a>';
							   
				if(!$order->getClient()->getLocation())
					$this->markers[] = new GMapMarker($address, '', '',$order->getClient()->getClientName(), $content, 'green');
				else
					$this->markers[] = new GMapMarker($address, 
													  $order->getClient()->getLocation()->getLatitude(), 
													  $order->getClient()->getLocation()->getLongitude(), 
													  $order->getClient()->getClientName(), $content, 'green');
				}
				unset($theTech);
			}
		}
	}
}
