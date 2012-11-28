
<div>
<div class='regularCont'>
<div class='titleBar'>Match (<a href='javascript:void(0);' onclick='toggle_matched()' id='toggle_matched_but'>Show</a>)</div>
<div class='innerCont' id='matched_cont'  style='display:NONE'>
<table id='noMatchTable'>
<tr>
<td class='partial_match_column_title'>Assoc. Client</td>
	<td class='partial_match_column_title'>Device ID</td>
	<td class='partial_match_column_title'>Device Name</td>
	<td class='partial_match_column_title'>Manufacturer</td>
	<td class='partial_match_column_title'>Model</td>
	<td class='partial_match_column_title'>Serial</td>
	<td class='partial_match_column_title'></td>
</tr>
<?php 
foreach($match as $partial) { ?>
<tr>
	<td >
		<select id='new_client_match_<?php print $partial['random_id']; ?>' >
			<option value='-1' selected='selected'>Existing Client</option>
			<?php foreach($clients as $client) { ?>
				   <option value='<?print $client->getId(); ?>'><?print $client->getClientIdentification(); ?></option>>
			<?php } ?>
		</select>
	</td>
	<td>
		<select id='device_id_match_<?php print $partial['random_id']; ?>' style='width: 120px'>
		<option value='<?php print $partial['device_id']; ?>'><?php print $partial['device_id']; ?></option>
		</select>
	</td>
	<td>
		<select id='device_name_match_<?php print $partial['random_id']; ?>' style='width: 120px'>
		          <option value='<?php print $partial['device_name']; ?>'><?php print print $partial['device_name']; ?></option>
		</select>
	</td>
	<td>
		<select id='manufacturer_match_<?php print $partial['random_id']; ?>' style='width: 120px'>
		          <option value='<?php print $partial['manufacturer']; ?>'><?php print $partial['manufacturer']; ?></option>
		</select>
	</td>
	<td>
		<select id='model_match_<?php print $partial['random_id']; ?>' style='width: 120px'>
		          <option value='<?php print $partial['model']; ?>'><?php print $partial['model']; ?></option>
		</select>
	</td>
	<td>
		<select id='serial_match_<?php print $partial['random_id']; ?>' style='width: 120px'>
		          <option value='<?php print $partial['serial']; ?>'><?php print $partial['serial']; ?></option>
		</select>
	</td>
	<td>
		 	<input id='input_<?php print $partial['random_id']; ?>' type='button' value='save' onclick="saveFullMatchUpdate(<?php print $partial['id']; ?>,<?php print $partial['random_id']; ?>)"> 
	 
	    <input type='hidden' id='location_match_<?php print $partial['random_id']; ?>' value='<?php print $partial['location']; ?>'>
	    <input type='hidden' id='date_match_<?php print $partial['random_id']; ?>' value='<?php print $partial['date']; ?>'>
	    <input type='hidden' id='pass_fail_match_<?php print $partial['random_id']; ?>' value='<?php print $partial['pass_fail']; ?>'>
	    <input type='hidden' id='extra_data_match_<?php print $partial['random_id']; ?>' value='<?php  print serialize($partial['extraData']); ?>'>
	    <input type='hidden' id='test_data_match_<?php print $partial['random_id']; ?>' value='<?php  print serialize($partial['testData']); ?>'>
	    <input type='hidden' id='comments_match_<?php print $partial['random_id']; ?>' value='<?php  print $partial['comments']; ?>'>
	</td>
	<td>
  (<?php print $partial['client_name']?>)<?php print  $partial['warning'];?>
	</td>
</tr>
<?php } ?>
</table>
</div>
</div>
</div>
