<?php use_helper('Object'); ?>
<?php use_helper('Javascript'); ?>



<table id="workorder_report" border="0" cellspacing="1" cellpadding="3">
	<tr class="report_row">
		<td>
		
			<table id="order_info">
				<tr class="order_info_row">
					<td class="order_label">MANUFACTURER:</td>
					<td class="auto_enter" id="workorder_manufacturer"><?php if ($openDevice != null){echo $openDevice->getSpecification()->getManufacturer(); }?></td>
					<td class="order_label">UNIT ID NO:</td>
					<td class="auto_enter" id="workorder_unit_id"><?php if ($openDevice != null){ echo $openDevice->getIdentification(); }?></td>
					<td class="order_label">TRAVEL:</td>
					<td class="enter" id="workorder_traveltime"><?php echo input_tag('travel_time', $openWorkorder->getTravelTime(),	array('size' => "4", 'MAXLENGTH' => "6")); ?></td>	
				</tr>
				<tr class="order_info_row">
					<td class="order_label">INSTRUMENT:</td>
					<td class="auto_enter" id="workorder_instrument"><?php if ($openDevice != null){ echo $openDevice->getSpecification()->getDeviceName(); }?></td>
					<td class="order_label">CUSTOMER ID:</td>
					<td class="auto_enter" id="workorder_customer_ID"><?php echo $openClient->getClientIdentification(); ?></td>
					<td class="order_label">ON SITE:</td>
					<td class="enter" id="workorder_onsite"><?php echo input_tag('onsite_time', $openWorkorder->getOnsiteTime(),	array('size' => "4", 'MAXLENGTH' => "6")); ?></td>	
				</tr>
				<tr class="order_info_row">
					<td class="order_label">MODEL NO:</td>
					<td class="auto_enter" id="workorder_model"><?php if ($openDevice != null){ echo $openDevice->getSpecification()->getModelNumber();} ?></td>
					<td class="order_label">CSR ASSIGNED:</td>
					<td class="auto_enter" id="workorder_technician"> <?php echo $openTech->getLastName().", ".$openTech->getFirstName(); ?></td>
					<td class="order_label">ZIP:</td>
					<td class="auto_enter" id="workorder_zipcode"><?php echo $openClient->getZip(); ?></td>	
				</tr>
				<tr class="order_info_row">
					<td class="order_label">SERIAL NO:</td>
					<td class="auto_enter" id="workorder_serial"><?php if ($openDevice != null){ echo $openDevice->getSerialNumber(); } ?></td>
					<td class="order_label">REQUESTED BY:</td>
					<td class="auto_enter" colspan="3" id="workorder_requested"><?php echo $openWorkorder->getCaller(); ?></td>
				</tr>
				<tr class="order_info_row">
					<td class="order_label">REASON FOR CALL:</td>
					<td class="auto_enter" colspan="5" id="workorder_reason"><?php echo select_tag('reason_select_y', objects_for_select($reason_dropdown, 'getid', 'getvalue', $openWorkorder->getReason())); ?></td>
				</tr>
				<tr class="order_info_row">
					<td colspan="6"></td>	
				</tr>
			</table>
		
		</td>
		
		<td>
		
			<table id="contact_info">
				<tr class="contact_info_row">
					<td class="order_label">PAGE:</td>
					<td class="auto_enter" id="workorder_page"></td>
					<td class="order_label">OF:</td>
					<td class="auto_enter" id="workorder_of"></td>
					<td class="order_label">ORDER #</td>
					<td class="enter" id="workorder_ticket"><?php echo $openWorkorder->getId(); ?></td>	
				</tr>
				<tr class="contact_info_row">
					<td class="order_label">RECEIVED:</td>
					<td class="auto_enter" colspan="3" id="workorder_date_recieved"><?php echo $openWorkorder->getDateRecieved(); ?></td>
					<td class="order_label">COMPLETED:</td>
					<td class="enter" id="workorder_date_completed" ><?php echo input_tag('completed', $openWorkorder->getDateCompleted(),	array('size' => "8", 'MAXLENGTH' => "10")); ?></td>
				</tr>
				<tr class="contact_info_row">
					<td class="order_label">NAME:</td>
					<td class="auto_enter" colspan="5" id="workorder_client_name"><?php echo $openClient->getClientName(); ?></td>
				</tr>
				<tr class="contact_info_row">
					<td class="order_label">ADDRESS:</td>
					<td class="auto_enter" colspan="5" id="workorder_client_address"><?php echo $openClient->getAddress(); ?><br/><?php echo $openClient->getAddress2(); ?></td>
				</tr>
				<tr class="contact_info_row">
					<td class="order_label">CITY:</td>
					<td class="auto_enter" id="workorder_client_city"><?php echo $openClient->getCity(); ?></td>
					<td class="order_label">STATE:</td>
					<td class="auto_enter" id="workorder_client_state"><?php echo $openClient->getState(); ?></td>
					<td class="order_label">ZIP:</td>
					<td class="auto_enter" id="workorder_client_zip"><?php echo $openClient->getZip(); ?></td>
				</tr>
				<tr class="contact_info_row">
					<td class="order_label">ATTN:</td>
					<td class="auto_enter" colspan="2" id="workorder_client_attn"><?php echo $openClient->getAttn(); ?></td>
					<td class="order_label">PHONE:</td>
					<td class="auto_enter" colspan="2" id="workorder_client_phone"><?php echo $openClient->getPhone(); ?></td>
				</tr>
			</table>
		
		</td>
		
	</tr>
	<tr class="report_row">
		<td colspan="2">
			<table id="action_taken">
				<tr>
					<td class="order_label">ACTION TAKEN:</td>
					<td class="enter" id="workorder_action_taken"><?php echo textarea_tag('action', $openWorkorder->getActionTaken(), 'size=90x6'); ?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr class="report_row">
	
	</tr>
	<tr class="report_row">
		<td colspan="2">
			<table id="remarks">
				<tr>
					<td class="order_label">REMARKS:</td>
					<td class="enter" id="workorder_remarks"><?php echo textarea_tag('remarks_y', $openWorkorder->getRemarks(), 'size=94x2'); ?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr class="report_row">
		<td>
			<table id="lower_info">
				<tr>
					<td class="order_label">JOB STATUS:</td>
					<td class="enter" colspan="2" id="workorder_job_status"><?php echo select_tag('job_status', objects_for_select($jobstatus_dropdown, 'getid', 'getstatusname', $status_select));	?></td>
					<td class="order_label">INVOICE #</td>
					<td class="enter"><input type='invoice_num' id = 'invoice_num' value='<?php print $openWorkorder->getInvoice(); ?>'></td>
				</tr>
				<tr>
					<td class="order_label">JOB TYPE:</td>
					<td class="enter" colspan="2" id="workorder_job_type"><?php echo select_tag('job_type', objects_for_select($jobtype_dropdown, 'getid', 'gettypename', $type_select)); ?></td>
					<td class="order_label">P.O. #</td>
					<td class="enter"></td>
				</tr>
				<tr>
					<td class="order_label">PRINT NAME:</td>
					<td class="auto_edit" colspan="4" id="workorder_print_name"><?php echo input_tag('print_name', $openClient->getAttn()); ?></td>
				</tr>
			</table>
		</td>	
		<td>
			<table id="pricing_info">
				<tr>
					<td class="order_label">SERVICE &amp; TRAVEL:</td>
					<td class="enter" id="workorder_service_travel"><?php echo '$ '. input_tag('travel_service', $openWorkorder->getServiceTravel(), 
									array(
									'size' => "5",
									'MAXLENGTH' => "9")); ?></td>
				</tr>
				<tr>
					<td class="order_label">ZONE CHARGE:</td>
					<td class="enter" id="workorder_zone_charge"><?php echo '$ '. input_tag('zone_charge_y', $openWorkorder->getZoneCharge(), 
									array(
									'size' => "5",
									'MAXLENGTH' => "9")); ?></td>
				</tr>
				<tr>
					<td class="order_label">SALES TAX:</td>
					<td class="enter" id="workorder_sales_tax"><?php echo '$ '. input_tag('salestax', $openWorkorder->getSaleTax(), 
									array(
									'size' => "5",
									'MAXLENGTH' => "9")); ?></td>
				</tr>
				<tr>
					<td class="order_label">SHIPPING &amp; HANDLING:</td>
					<td class="enter" id="workorder_shipping_handling"><?php echo '$ '. input_tag('shipping', $openWorkorder->getShippingHandling(), 
									array(
									'size' => "5",
									'MAXLENGTH' => "9")); ?></td>
				</tr>
				<tr>
					<td class="order_label">TOTAL:</td>
					<td class="enter" id="workorder_totalcost"><?php echo '$ '. input_tag('totalcost', 
                                     ($openWorkorder->getServiceTravel()+$openWorkorder->getZoneCharge()
                                      +$openWorkorder->getSaleTax()+$openWorkorder->getShippingHandling()), 
									array(
									'size' => "5",
									'MAXLENGTH' => "9",'disabled'=>"'disabled'")); ?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="right">	
        <input type='hidden' value='<?php print $openWorkorder->getId(); ?>' name='wid' id='wid' />
        <input type='hidden' value='<?php print $openClient->getId(); ?>' name='cid' id='cid' />
		<?php 
			echo button_to_function('Edit Schedule', 'editSchedule('.$openWorkorder->getId().')')."&nbsp;&nbsp;";
			//echo button_to_function('Save Changes', 'saveWorkorder('.$openWorkorder->getId().')');
            echo button_to_function('Save Changes', 'updateWorkorder('.$openWorkorder->getId().')');
		?>
		</td>
	</tr>
</table>
<div id='res'></div>
