<?php use_helper('Object'); ?>
<?php use_helper('Javascript'); ?>

<table class=tablewrapper><tr>
	<td><table><tr>
			<td><table><tr>
				<td><b>Manufacturer: </b></td>
				<td><?php //echo $workorder->getDevice()->getManufacturer(); ?></td>
			</tr><tr>
				<td><b>Instrument: </b></td>
				<td>EKG</td>
			</tr><tr>
				<td><b>Model #: </b></td>
				<td>BTEKG200</td>
			</tr><tr>
				<td><b>Serial #: </b></td>
				<td>329048-9</td>
		</tr></table></td>
		<td><table><tr>
				<td><table><tr>
						<td><b>Unit ID:</b></td>
						<td>2394</td>
					</tr><tr>
						<td><b>Customer ID:</b></td>
						<td>BIOTECH</td>
					</tr><tr>
						<td><b>Tech Assigned:</b></td>
						<td>Mike D.</td>
				</tr></table></td>
				<td><table><tr>
						<td><b>Travel: </b></td>
						<td>1</td>
					</tr><tr>
						<td><b>On Site: </b></td>
						<td>3</td>
					</tr><tr>
						<td><b>Zip</b></td>
						<td>93204</td>
				</tr></table></td>
			</tr><tr>
					<td colspan=2><table><tr>
						<td><b>Requested By: </b><td>
						<td>Kurdt Cobain</td>
					</tr></table></td>
			</tr></table></td>
		</tr><tr>
				<td colspan=2><table><tr>
						<td><b>Reason For: </b>
					</tr><tr>
						<td><?php echo textarea_tag('reason', '', "size=42x2"); ?></td>
				</tr></table></td>
	</tr></table></td>
	<td><table><tr>
			<td colspan=2><table><tr>
					<td><b>Ticket #: </b></td>
					<td><?php echo $ticket; ?></td>
			</tr></table></td>
		</tr><tr>
			<td><table><tr>
					<td><b>Recieved Date:</b></td>
				</tr><tr>
					<td>2/10/07</td>
			</tr></table></td>
			<td><table><tr>
					<td><b>Completed Date:</b></td>
				</tr><tr>
					<td>2/10/07</td>
			</tr></table></td>
		</tr><tr>
			<td colspan=2><table><tr>
					<td><b>Name: </b></td>
					<td>Muddy Waters</td>
				</tr><tr>
					<td><b>Address: </b></td>
					<td>3897 Bo Diddly Ln.	Suite 102</td>
				</tr><tr>
					<td><b>City:</b></td>
					<td>Opry</td>
				</tr><tr>
					<td><b>State:</b></td>
					<td>TN</td>
				</tr><tr>
					<td><b>Zip:</b></td>
					<td>90834</td>
				</tr><tr>
					<td><b>Attn:</b></td>
					<td>Count Basie</td>
				</tr><tr>
					<td><b>Phone:</b></td>
					<td>8902374098</td>
			</tr></table></td>
	</tr></table></td>
</tr><tr>
	<td colspan=2><table><tr>
			<td><b>Action Taken</b></td>
		</tr><tr>
			<td><?php echo textarea_tag('action', '', 'size=70x4'); ?></td>
	</tr></table></td>
</tr><tr>
	<td colspan=2><table><tr>
			<td><b>Remarks</b></td>
		</tr><tr>
			<td><?php echo textarea_tag('remarks', '', 'size=70x4'); ?></td>
	</tr></table></td>
</tr><tr>
	<td colspan=2><table><tr>
			<td></td>
			<td><table><tr>
					<td colspan=2><table><tr>
							<td><b>Job Type: </b></td>
							<td><?php echo select_tag('job_type'); ?></td>
						</tr><tr>
							<td><b>Job Status: </b></td>
							<td><?php echo select_tag('job_status'); ?></td>
					</tr></table></td>
				</tr><tr>
					<td><table><tr>
							<td><b>P.O. #: </b></td>
						</tr><tr>
							<td><?php echo input_tag('parts_order_number'); ?></td>
					</tr></table></td>
					<td><table><tr>
							<td><b>Invoice: </b></td>
						</tr><tr>
							<td><?php echo input_tag('invoice_number'); ?></td>
					</tr></table></td>
			</tr></table></td>
			<td><table><tr>
					<td><table><tr>
							<td>Subtotal: </td>
							<td><?php echo input_tag('subtotal'); ?></td>
						</tr><tr>
							<td>Service &amp; Travel: </td>
							<td><?php echo input_tag('service_travel'); ?></td>
						</tr><tr>
							<td>Zone Charge: </td>
							<td><?php echo input_tag('zone_charge'); ?></td>
						</tr><tr>
							<td>Shipping &amp; Handling: </td>
							<td><?php echo input_tag('shipping_handling'); ?></td>
						</tr><tr>
							<td>Sales Tax: </td>
							<td><?php echo input_tag('sales_tax'); ?></td>
						</tr><tr>
					</tr></table></td>
			</td></table></tr>
	</td></table></tr>
</tr></table>
		
</div>

<div id="submitButtons">
	<table class="unscheduledButtons"><tr>
			<td><h2>Unscheduled</h2></td>
		</tr><tr>
			<td><?php echo button_to_function('Unscheduled With Parts', 'save()'); ?></td>
		</tr><tr>
			<td><?php echo button_to_function('Unscheduled Without Parts', 'save()'); ?></td>
	</tr><table>

	<table class="Pending"><tr>
			<td colspan=2><h2>Pending</h2></td>
		</tr><tr>
			<td><?php echo button_to_function('Waiting Parts', 'save()'); ?></td>
			<td><?php echo button_to_function('Waiting Quote Approval', 'save()'); ?></td>
		</tr><tr>
			<td><?php echo button_to_function('Reopen As Warrenty', 'save()'); ?></td>
			<td><?php echo button_to_function('Next Visit', 'save()'); ?></td>
	</tr></table>

	<table class="completedButtons"><tr>
			<td><h2>Completed</h2></td>
		<tr></tr>
			<td><?php echo button_to_function('Job Completed', 'save()'); ?></td>
		<tr></tr>
			<td><?php echo button_to_function('Repair Declined', 'save()'); ?></td>
	</table>
		
