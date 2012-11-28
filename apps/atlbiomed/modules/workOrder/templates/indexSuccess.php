<?php use_helper('Javascript') ?>
<?php use_helper('Object') ?>

<?php 

/*	Event.observe(window, 'load', initFunctions, false);

	function initFunctions(evt)
	{
		showWorkorder();
	}*/
	
echo javascript_tag("


	function showWorkorder(id)
	{".
		//initiate TechDisplay
		remote_function(array(
			'update' => 'workOrder',
			'url' => 'workOrder/populateWorkorder',
			'with' => '"ticket=" + id')).";"."


	}
	
	");
?>

<?php echo javascript_tag('
	function editSchedule(workorder_id)
		{ 
			window.location = "'.url_for('scheduler/index?mode=edit&ticket=').'" + "/" + workorder_id;
		} '); 
?>

<?php echo javascript_tag("
		function saveWorkorder(id)
		{
			{".
				remote_function(array(
					'url' => 'workOrder/saveWorkorder',
					'with' => '"ticket=" + id'))."
			}
		}"); ?>

	<div class="mapsCollapsingPanelContainer">
		<?php echo form_tag('workOrder/index'); ?>

			<?php include_partial('global/collapsingDivContainer',
								  array('title' => 'Filter by Client',
								  		'uniqueId' => 'filterByClient',
								  		'content' => select_tag('client_id', 
								  					options_for_select($clients, 
													$bogusWorkOrder->getClientId(), 
													'include_custom=All')))); ?>	

			<?php include_partial('global/collapsingDivContainer',
								  array('title' => 'Filter by Status',
								  		'uniqueId' => 'filterByStatus',
								  		'content' => object_select_tag($bogusWorkOrder, 'getJobStatusId', 'include_custom=All', ''))); ?>
			  			
			<?php include_partial('global/collapsingDivContainer',
								  array('title' => 'Filter by Technician',
								  		'uniqueId' => 'filterByTechnician',
								  		'content' => select_tag('technician_id', 
								  					options_for_select($technicians, 
													$bogusWorkOrder->getTech(), 
													'include_custom=All')))); ?>
													
			<?php include_partial('global/collapsingDivContainer',
								  array('title' => 'Filter by Date',
								  		'uniqueId' => 'filterByDate',
								  		'content' => get_partial('mapDateFilterControl', 
										 array('initialDate' => $dateFilter,
								  		'dateFilterType' => $dateFilterType)))); ?>		


								  			
			<div class="mapsCollapsingPanelContainerControl">
				<?php echo submit_tag('Filter'); ?>				
			</div>
						
		</form>
	</div>


<div id="workOrder_content" style="padding-left:10px;">

<div id="workOrder"></div>

<?php 
	if (!empty($orders) )
	{ ?>
<div id="searchResults">
<table class="workorder_search_results" cellpadding="3" cellspacing="1"><tr>
	<td><b><u>Client ID</u></b></td>
    <td><b><u>Invoice #</u></b></td>
	<td><b><u>Client Name</u></b></td>
	<td><b><u>Technician</u></b></td>
	<td><b><u>Job Date</u></b></td>
	<td><b><u>Remarks</u></b></td>
	<td><b><u>Reason</u></b></td>
    <td><b><u>Job Status</u></b></td>
	<td><b><u>Action</u></b></td>
</tr><tr>	
	<?php
		foreach($orders as $order)
		{ 
			$tech = UserPeer::retrieveByPk($order->getTech());
			$reason = DropdownPeer::retrieveByPk($order->getReason()); 
			
			if($order->getClient() != NULL){
			?>
            <tr>
			<td><?php echo $order->getClient()->getClientIdentification(); ?></td>
			<td><?php echo $order->getInvoice(); ?></td>
			<td><?php echo $order->getClient()->getClientName(); ?></td>
			<td><?php if(method_exists($tech,"getFirstName")) { echo $tech->getFirstName() .' '. $tech->getLastName(); } ?></td>
            <td><?php echo $order->getJobDate(); ?></td>
			<td><?php echo $order->getRemarks(); ?></td>
			<td><?php $c = new Criteria();
                      $c->add(DropdownPeer::ID, $order->getReason());
                      $dr = DropdownPeer::doSelectOne($c);
                      print $dr->getValue(); ?></td>
             <?php $cc=''; if($order->getJobStatusId() == 7){ $cc = "style='color:red'"; }elseif($order->getJobStatusId()== 9){ $cc = "style='color:green'"; }?>
			  <td><span <?php print $cc;?>> <?php echo $order->getJobStatus(); ?></span></td> 
			<td><?php echo link_to_function('Open', "showWorkorder(".$order->getId().")", array(
									'target' => '_top'));?></td>
			
			</tr>
		<?php
		}//if

       }//for ?>
		</tr></table></div>
	<?php } ?>
</div>

