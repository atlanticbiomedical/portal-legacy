

<div class='regularCont'>
<div class='titleBar'>No Match</div>
<div class='innerCont'>
<table>
<tr>
    <td class='partial_match_column_title'>Client</td>
    <td class='partial_match_column_title'>Option</td>
	<td class='partial_match_column_title'>Device ID</td>
	<td class='partial_match_column_title' style='width: 130px'>ID Options</td>
	<td class='partial_match_column_title'>Device Name</td>
	<td class='partial_match_column_title'>Manufacturer</td>
	<td class='partial_match_column_title'>Model</td>
	<td class='partial_match_column_title'>Serial</td>
	<td></td>
</tr>
<?php foreach($noMatch as $partial) { ?>
<tr>
	<td>
		<select id='client_<?php print $partial['random_id']; ?>' onChange='updateDevices(<?php print $partial['random_id']; ?>); restoreFields(<?php print $partial['random_id']; ?>)'>
			<option value='-1' selected='selected'>Select A Client</option>
			<?php foreach($clients as $client) { ?>
				   <option value='<?print $client->getId(); ?>'><?print $client->getClientIdentification(); ?></option>>
			<?php } ?>
		</select>
	</td>
	<td>
		<select id='option_<?php print $partial['random_id']; ?>' onchange='optionChanged(<?php print $partial['random_id']; ?>)'>
			<option value='1'>Add As New Device</option>
			<option value='2'>Associate Device</option>
		</select>

	</td>
	<td>
		<select id='device_id_<?php print $partial['random_id']; ?>' style='width: 100px'>
			<option value='<?php print $partial['device_id']; ?>'><?php print $partial['device_id']; ?></option>
		</select>
		<select id='get_devices_<?php print $partial['random_id']; ?>' style='width: 100px; display:none' onChange='device_id_changed(<?php print $partial['random_id']; ?>)'>
		</select>
	</td>
	<td>
		<select id='device_id_option_<?php print $partial['random_id']; ?>' style='width: 130px' disabled='disabled'>
                        <option value='-1'>-Use Existing Id-</option>
			<option value='<?php print $partial['device_id']; ?>'><?php print $partial['device_id']; ?></option>
		</select>
	</td>
	<td>
		<select id='device_name_<?php print $partial['random_id']; ?>' style='width: 120px'>  
		          <option value='<?php print $partial['device_name']; ?>'><?php print $partial['device_name']; ?></option>  
		</select>
		<input type='hidden' id='hidden_device_name_<?php print $partial['random_id']; ?>' value='<?php print $partial['device_name']; ?>'>
	</td>
	<td>
		<select id='manufacturer_<?php print $partial['random_id']; ?>' style='width: 120px'> 
		          <option value='<?php print $partial['manufacturer']; ?>'><?php print $partial['manufacturer']; ?></option>  
		</select>
		<input type='hidden' id='hidden_manufacturer_<?php print $partial['random_id']; ?>' value='<?php print $partial['manufacturer']; ?>'>
	</td>
	<td>
		<select id='model_<?php print $partial['random_id']; ?>' style='width: 120px'> 
		          <option value='<?php print $partial['model']; ?>'><?php print $partial['model']; ?></option> 
		</select>
		<input type='hidden' id='hidden_model_<?php print $partial['random_id']; ?>' value='<?php print $partial['model']; ?>'> 
	</td>
	<td>
		<select id='serial_<?php print $partial['random_id']; ?>' style='width: 120px'> 
		          <option value='<?php print $partial['serial']; ?>'><?php print $partial['serial']; ?></option> 
		</select>
		<input type='hidden' id='hidden_serial_<?php print $partial['random_id']; ?>' value='<?php print $partial['serial']; ?>'> 
	</td>
	<td>
		<input id='input_<?php print $partial['random_id']; ?>' type='button' value='save' onclick='save_no_match(<?php print $partial['random_id']; ?>)'>
	    <input type='hidden' id='location_<?php print $partial['random_id']; ?>' value='<?php print $partial['location']; ?>'>
	    <input type='hidden' id='date_<?php print $partial['random_id']; ?>' value='<?php print $partial['date']; ?>'>
	    <input type='hidden' id='pass_fail_<?php print $partial['random_id']; ?>' value='<?php print $partial['pass_fail']; ?>'>
	    <input type='hidden' id='extra_data_<?php print $partial['random_id']; ?>' value='<?php  print serialize($partial['extraData']); ?>'>
	    <input type='hidden' id='test_data_<?php print $partial['random_id']; ?>' value='<?php  print serialize($partial['testData']); ?>'>
	    <input type='hidden' id='comments_<?php print $partial['random_id']; ?>' value='<?php  print $partial['comments']; ?>'>
	</td>
</tr>
<?php } ?>
</table>
</div>
</div>

