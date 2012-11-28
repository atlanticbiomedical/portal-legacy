<?php 
	use_helper('Object'); 
	use_helper('Validation'); 
	use_helper('Javascript'); 
	echo javascript_include_tag('dropdown');

	//set field values
	if($sf_request->hasErrors())
	{
		$clientIdValue = $sf_params->get('client_identification');
		$clientNameValue = $sf_params->get('client_name');
		$addressValue = $sf_params->get('address');
		$address2Value = $sf_params->get('address2');
		$cityValue =  $sf_params->get('city');
		$stateValue = $sf_params->get('state');
		$zipValue =  $sf_params->get('zip');
		$attnValue =  $sf_params->get('attn');
		$emailValue =  $sf_params->get('email');
		$phoneValue =  $sf_params->get('phone');
		$extValue =  $sf_params->get('ext');
		$categoryValue =  $sf_params->get('category');
		$notesValue =  $sf_params->get('notes');
		$allDevicesValue = $sf_params->get('all_devices');

	} else {
		$clientIdValue = $populateClient->getClientIdentification();
		$clientNameValue = $populateClient->getClientName();
		$addressValue = $populateClient->getAddress();
		$address2Value = $populateClient->getAddress2();
		$cityValue = $populateClient->getCity();
		$stateValue = $populateClient->getState();
		$zipValue = $populateClient->getZip();
		$attnValue = $populateClient->getAttn();
		$emailValue = $populateClient->getEmail();
		$phoneValue = $populateClient->getPhone();
		$extValue = $populateClient->getExt();
		$categoryValue = $populateClient->getCategory();
		$notesValue = $populateClient->getNotes();
		$allDevicesValue = $populateClient->getAllDevices();
	}
?>
	
<?php echo javascript_tag('
		function submitClientSelect()
		{
			clientSelect = document.getElementById("id").value;
			
			if(clientSelect == "")
			{
				alert("Please select a client before continuing.");
			} else {
				document.getElementById("clientSelect").submit();
			}
		} ');

?>

<div class="newClient">

<?php echo form_tag('clientManager/index', array('id' => 'clientSelect')); ?>
<?php echo input_hidden_tag('mode', 'edit'); ?>
<table class="clientSelect"><tr>
	<td width="100">Select Client</td>
	<td><?php echo select_tag('id', options_for_select($clients, $client_id,'include_custom=Please Select a Client'), array('onFocus' => "this.enteredText='';", 'onkeydown' => "return handleKey();", 'onkeyup' => "event.cancelbubble=true;return false;", 'onkeypress' => "return selectItem();") );?></td>
</tr></table>
</form>

</form>
</tr></table>

<?php echo form_tag('clientManager/addClient'); ?>
<?php echo input_hidden_tag('mode', $mode); ?>
<?php echo input_hidden_tag('id', $populateClient->getId()); ?>

<table class="clientInfo"><tr>
	<td colspan=2><?php echo form_error('client_identification'); ?></td>
<tr></tr>
	<td width="100">Client ID:</td>
	<td><?php echo input_tag('client_identification', $clientIdValue, array('size' => '30')); ?></td>
</tr><tr>
	<td colspan=2><?php echo form_error('client_name'); ?></td>
<tr></tr>
	<td>Client Name:</td>
	<td><?php echo input_tag('client_name', $clientNameValue, array('size' => '30')); ?></td>
</tr><tr>
	<td colspan=2><?php echo form_error('address'); ?></td>
<tr></tr>
	<td>Address:</td>
	<td><?php echo input_tag('address', $addressValue, array('size' => '30')); ?></td>
</tr><tr>
	<td></td>
	<td><?php echo input_tag('address_2', $address2Value, array('size' => '30')); ?></td>
</tr><tr>
	<td colspan=2><?php echo form_error('city'); ?></td>
<tr></tr>
	<td>City:</td>
	<td><?php echo input_tag('city', $cityValue, array('size' => '30')); ?></td>
</tr><tr>
	<td colspan=2><?php echo form_error('state'); ?></td>
<tr></tr>
	<td>State:</td>
	<td><?php echo select_tag('state', options_for_select(array(
				'' => 'Please Select...',
				'AL' => 'Alabama',
				'AK' => 'Alaska',
				'AZ' => 'Arizona',
				'AR' => 'Arkansas',
				'CA' => 'California',
				'CO' => 'Colorado',
				'CT' => 'Connecticut',
				'DE' => 'Deleware',
				'DC' => 'District of Columbia',
				'FL' => 'Florida',
				'GA' => 'Georgia',
				'HI' => 'Hawaii',
				'ID' => 'Idaho',
				'IL' => 'Illinois',
				'IN' => 'Indiana',
				'IA' => 'Iowa',
				'KS' => 'Kansas',
				'KY' => 'Kentucky',
				'LA' => 'Louisiana',
				'ME' => 'Maine',
				'MD' => 'Maryland',
				'MA' => 'Massachusetts',
				'MI' => 'Michigan',
				'MN' => 'Minnesota',
				'MS' => 'Mississippi',
				'MO' => 'Missouri',
				'MT' => 'Montana',
				'NE' => 'Nebraska',
				'NV' => 'Nevada',
				'NH' => 'New Hampshire',
				'NJ' => 'New Jersey',
				'NM' => 'New Mexico',
				'NY' => 'New York',
				'NC' => 'North Carolina',
				'ND' => 'North Dakota',
				'OH' => 'Ohio',
				'OK' => 'Oklahoma',
				'OR' => 'Oregon',
				'PA' => 'Pennsylvania',
				'RI' => 'Rhode Island',
				'SC' => 'South Carolina',
				'SD' => 'South Dakota',
				'TN' => 'Tennessee',
				'TX' => 'Texas',
				'UT' => 'Utah',
				'VT' => 'Vermont',
				'VA' => 'Virginia',
				'WA' => 'Washington',
				'WV' => 'West Virginia',
				'WI' => 'Wisconsin',
				'WY' => 'Wyoming'), $stateValue)); ?></td>
</tr><tr>
	<td colspan=2><?php echo form_error('zip'); ?></td>
<tr></tr>
	<td>Zip:</td>
	<td><?php echo input_tag('zip', $zipValue, array('size' => '5')); ?></td>
</tr><tr>
	<td colspan=2><?php echo form_error('attn'); ?></td>
<tr></tr>
	<td>Attn:</td>
	<td><?php echo input_tag('attn', $attnValue, array('size' => '30')); ?></td>
</tr><tr>
	<td colspan=2><?php echo form_error('email'); ?></td>
<tr></tr>
	<td>Email:</td>
	<td><?php echo input_tag('email', $emailValue, array('size' => '30')); ?></td>
</tr><tr>
	<td colspan=2><?php echo form_error('phone'); echo form_error('ext'); ?></td>
<tr></tr>
	<td>Phone:</td>
	<td><?php echo input_tag('phone', $phoneValue, 'size=8').' ext.:'.input_tag('ext', $extValue, 'size=4'); ?></td>
</tr><tr>
	<td colspan=2><?php echo form_error('category'); ?></td>
<tr></tr>
	<td>Category:</td>
	<td><?php echo select_tag('category', options_for_select(array(
					'' 				=> 'Please Select...',
					'orthopedics'	=> 'Orthopedics',
					'pediatrics'	=> 'Pediatrics',
					'radiology'		=> 'Radiology'), $categoryValue)); ?></td>
					
</tr><tr>
	<td>Notes:</td>
	<td><?php echo textarea_tag('notes', $notesValue, array('width' => '30')); ?></td>
</tr><tr>
	<td></td>
	<td><?php echo submit_tag('Save'); ?></td>
</tr></table>

</form>
	<div id="clientOptions">
		<?php
			if($mode == 'edit')
			{
				// Delete Button
				echo form_tag('clientManager/deleteClient');
				echo input_hidden_tag('delete_client', $populateClient->getId());
				echo submit_tag('Delete'); 
				?></form><?php
	
				// New client Button (refresh form)
				echo form_tag('clientManager/index');
				echo submit_tag('New Client');
			}	?>
		</form>
	</div>
</div>


<?php 	if ($mode == 'edit')
{ ?>
	<div class="clientDevice"> 
		<?php echo form_tag('clientManager/addDevice?mode=edit&id='.$populateClient->getId()); ?>
	<table><tr>
		<td class='deviceId'><b><u>Device ID</u></b></td>
		<td><b><u>Device</u></b></td>
		<td><b><u>Manufacturer</u></b></td>
		<td><b><u>Model #</u></b></td>
		<td><b><u>Serial #</u></b></td>
		<td><b><u>Loc.</u></b></td>
		<td><b><u>Frequency</u></b></td>
		<td><b><u>Status</u></b></td>
	</tr><tr>
	<?php	
		foreach ($populateDevice as $device)
		{ ?>
			<td><?php echo input_tag('device_update['.$device->getDevice()->getId().'][identification]', $device->getIdentification(), 'size=8'); echo input_hidden_tag('device_update['.$device->getDevice()->getId().'][specification_id]', $device->getSpecification()->getId()); ?></td>
		 
 			<td><?php echo input_tag('device_update_'.$device->getDevice()->getId().'_name', $device->getSpecification()->getDeviceName()); ?></td>  
			<td><?php echo input_tag('device_update['.$device->getDevice()->getId().'][manufacturer]', $device->getSpecification()->getManufacturer()); ?></td>
			<td><?php echo input_tag('device_update['.$device->getDevice()->getId().'][model_number]', $device->getSpecification()->getModelNumber(), 'size=4'); //$device->getModelNumber()); ?></td>
			<td><?php echo input_tag('device_update['.$device->getDevice()->getId().'][serial_number]', $device->getDevice()->getSerialNumber(), 'size=4'); ?></td>
			<td><?php echo input_tag('device_update['.$device->getDevice()->getId().'][location]', $device->getDevice()->getLocation(),'size=4'); ?></td>
			<td><?php echo select_tag('device_update['.$device->getDevice()->getId().'][frequency]', options_for_select(array(
					''				=>	'Please Select...',
					'annual'		=>	'Annually',
					'monthly'		=>	'Monthly',
					'biannually'	=>	'Bi-annually',
					'bimonthly'		=>	'Bi-monthly',
					'twice_annually'=>	'Twice Annually',
					'twice_monthly'	=>	'Twice Montly'),$device->getDevice()->getFrequency())); ?></td>
			<td><?php echo select_tag('device_update['.$device->getDevice()->getId().'][status]', options_for_select(array(
				''			=>	'Please Select...',
				'active'	=>	'Active',
				'retired'	=>	'Retired'), $device->getDevice()->getStatus())); ?></td>
			</tr><tr> 
		<?php } ?>
	<td></td>
	<td><?php echo input_tag('new_device_name', ''); ?></td>
	<td><?php echo input_tag('new_manufacturer', ''); ?></td>
	<td><?php echo input_tag('new_model_number', '','size=4'); ?></td>
	<td><?php echo input_tag('new_serial_number', '','size=4'); ?></td>
	<td><?php echo input_tag('new_location', '', 'size=4'); ?></td>
	<td><?php echo select_tag('new_frequency', options_for_select(array(
					''				=>	'Please Select...',
					'annually'		=>	'Annually',
					'monthly'		=>	'Monthly',
					'biannually'	=>	'Bi-annually',
					'bimonthly'		=>	'Bi-monthly',
					'twice_annually'=>	'Twice Annually',
					'twice_monthly'	=>	'Twice Montly'))); ?></td>
	<td><?php echo select_tag('new_status', options_for_select(array(
					''			=>	'Please Select...',
					'active'	=>	'Active',
					'retired'	=>	'Retired'))); ?></td>
</tr></table>
<?php echo submit_tag('Save'); ?>
<?php echo ' Time for All Devices: '.input_tag('all_devices', $allDevicesValue, 'size=4'); ?>

</form>
</div>
<?php } ?>

