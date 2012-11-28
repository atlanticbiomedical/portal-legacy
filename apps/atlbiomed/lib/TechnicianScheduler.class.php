<?php

class TechnicianScheduler
{
	var $technician;
	var $workorders;
	var $tempWorkorder;
	
	public function TechnicianScheduler($technician, $workDate)
	{
		$this->technician = $technician;
		$this->workorders = WorkorderPeer::getOrdersForTechnician($technician->getId(), $workDate);
	}
	
	/*
     * Determines if a workorder can be slotted into the current schedule.
     */
	public function isSchedulable($workOrder)
	{
		// easy check, is it outside of this technician's working hours
		if($this->technician->getStartTime() > $workOrder->getJobStart() 
			|| $this->technician->getEndTime() < $workOrder->getJobEnd())
		{
			return false;
		}
		else
			{
			// we will search through the workorders using an anonymous function which checks to see if the proposed
			// work order starts or ends within the time span for any of the orders.
			$overlappingOrder = create_function('$order',
							'return (' . abs($workOrder->getJobEnd()) . ' >= $order->getJobStart()'
							. ' && ' . abs($workOrder->getJobEnd()) . ' <= $order->getJobEnd())'
							. ' || (' . abs($workOrder->getJobStart()) . ' >= $order->getJobStart()'
							. ' && ' . abs($workOrder->getJobStart()) . ' < $order->getJobEnd());');

			
			//return count(array_filter($this->workorders, $overlappingOrder)) == 0;
			$this->tempWorkorder = $workOrder;
			//count(array_filter($this->workorders, array('TechnicianScheduler','callbackfunc'))) == 0;
		
			return count(array_filter($this->workorders, array('TechnicianScheduler','callbackfunc'))) == 0;
			
		}
	}
	
	public function callbackfunc($order){
	
		$workOrder = $this->tempWorkorder;
		
/*		
 * DEBUGGING PURPOSES
        print $workOrder->getJobStart() . " == " . $order->getJobStart()."<br/>";
        print $workOrder->getJobStart() . " > " . $order->getJobStart() . " && ". $workOrder->getJobStart() ." < ". $order->getJobEnd() ."<br/>";
	    print $workOrder->getJobEnd() . " > " . $order->getJobStart() . " && ". $workOrder->getJobEnd() ." <= ". $order->getJobEnd()."<br/>"; // job end falls between job
        print $workOrder->getJobStart() . " < ". $order->getJobStart() . " && " . $workOrder->getJobEnd() . " >= " . $order->getJobEnd() . "<br/><br/><br/>";
        print "return: ";

        var_dump(( 
		       ($workOrder->getJobStart() == $order->getJobStart()) ||  //PROBLEM both jobs
		       ($workOrder->getJobStart() > $order->getJobStart() && $workOrder->getJobStart() < $order->getJobEnd()) || //start time falls in the rage of another job
	           ($workOrder->getJobEnd() > $order->getJobStart() && $workOrder->getJobEnd() <= $order->getJobEnd()) || // job end falls between job
		       ($workOrder->getJobStart() < $order->getJobStart() && $workOrder->getJobEnd() >= $order->getJobEnd()) // enclose a current job
	           ));
*/

		
		return ( 
		       ($workOrder->getJobStart() == $order->getJobStart()) ||  //PROBLEM both jobs
		       ($workOrder->getJobStart() > $order->getJobStart() && $workOrder->getJobStart() < $order->getJobEnd()) || //start time falls in the rage of another job
	           ($workOrder->getJobEnd() > $order->getJobStart() && $workOrder->getJobEnd() <= $order->getJobEnd()) || // job end falls between job
		       ($workOrder->getJobStart() < $order->getJobStart() && $workOrder->getJobEnd() >= $order->getJobEnd()) // enclose a current job
	           );
				
            
	}
	
	/*
	 * Attempts to add a workorder to this schedule.  NOTE: This performs no insert/update
	 * operations to the database.
	 */
	public function scheduleWorkorder($workOrder)
	{
		if($this->isSchedulable($workOrder))
		{
			$this->workorders[] = $workOrder;
		}
	}
	
	/*
	 * Gets the technician in this schedule.
	 */
	public function getTechnician()
	{
		return $this->technician;
	}
	
	/*
	 * Gets the workorders in this schedule.
	 */
	public function getWorkorders()
	{
		return $this->workorders;
	}
	
	/*
	 * Gets the order scheduled at the time slot.
	 */
	public function getWorkorderAtTime($time)
	{
		$isInSlot = create_function('$order',
									'return ' . abs($time) . ' >= abs($order->getJobStart())'
											. ' && ' . abs($time) . ' < abs($order->getJobEnd());');

		$orders = array_filter($this->workorders, $isInSlot);

		return array_pop($orders);
	}
	
	/*
	 * Gets the earliest start time for this schedule.  Returns null if the tech is booked.
	 */
	public function getFirstAvailableStartTime()
	{
		$firstAvailable = null;
		$start = $this->technician->getStartTime();
		$counter = 0;
		while( $start < $this->technician->getEndTime() )
		{	
			if ($this->getWorkorderAtTime($start) == null)
			{
				$counter++;
				
				if ($counter == 4)
				{
					break;
				}
				else if ($counter == 1)
				{
					$firstAvailable = $start;
				}
			}
			else
			{
				$counter = 0;
				$firstAvailable = null;
			}
			
			// increment time
			if (substr($start, 2, 2) == '30')
			{			
				$start = abs(substr($start, 0, 2)) + 1 . '00';
				
				if(strlen($start) != 4)
				{
					$start = '0' . $start;
				}
			}
			else
			{
				$start = substr($start, 0, 2) . '30';
			}
		}		
		return $firstAvailable;
	}

	
    public function sortWorkorder($workorders){
    	usort(&$workorders, array(get_class($this), 'uksort_workers'));
    	return $workorders;
    }
    private function uksort_workers($a, $b)
	{
		if ($a->getJobStart() == $b->getJobStart()) return 0;
		   	return ($a->getJobStart() < $b->getJobStart()) ? -1 : 1;
	}
}
