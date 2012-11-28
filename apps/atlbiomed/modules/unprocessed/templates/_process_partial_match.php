
<div>
<div class='regularCont'>
<div class='titleBar'>Partial Match</div>
<div class='innerCont'>
<table id='noMatchTable'>
<tr>
	<td class='partial_match_column_title'>New Client</td>
	<td class='partial_match_column_title'>Device ID</td>
	<td class='partial_match_column_title'>Device Name</td>
	<td class='partial_match_column_title'>Manufacturer</td>
	<td class='partial_match_column_title'>Model</td>
	<td class='partial_match_column_title'>Serial</td>
	<td class='partial_match_column_title'></td>
</tr>
<?php 
foreach($partialMatch as $partial) { ?>
<tr>
	<td >
		<select id='new_client_partial_<?php print $partial['random_id']; ?>' >
			<option value='-1' selected='selected'>Existing Client</option>
			<?php foreach($clients as $client) { ?>
				   <option value='<?print $client->getId(); ?>'><?print $client->getClientIdentification(); ?></option>>
			<?php } ?>
		</select>
	</td>
	<td >
		<select id='device_id_<?php print $partial['random_id']; ?>' style='width: 120px'>
		<option value='<?php print $partial['device_id']; ?>'><?php print $partial['device_id']; ?></option>
		</select>
	</td>
	<td>
		<select id='device_name_<?php print $partial['random_id']; ?>' style='width: 120px<?php if($partial['misMatch']['device_name']==true){ print ";border: 1px solid red";}?>'>
		    <?php foreach($partial['device_name'] as $device_name) { ?>
		          <option value='<?php print $device_name; ?>'><?php print $device_name; ?></option>
		    <?php }?>
		</select>
	</td>
	<td>
		<select id='manufacturer_<?php print $partial['random_id']; ?>' style='width: 120px<?php if($partial['misMatch']['manufacturer']==true){ print ";border: 1px solid red";}?>'>
		 <?php foreach($partial['manufacturer'] as $manufacturer) { ?>
		          <option value='<?php print $manufacturer; ?>'><?php print $manufacturer; ?></option>
		    <?php }?>
		</select>
	</td>
	<td>
		<select id='model_<?php print $partial['random_id']; ?>' style='width: 120px<?php if($partial['misMatch']['model']==true){ print ";border: 1px solid red";}?>'>
		 <?php foreach($partial['model'] as $model) { ?>
		          <option value='<?php print $model; ?>'><?php print $model; ?></option>
		    <?php }?>
		</select>
	</td>
	<td>
		<select id='serial_<?php print $partial['random_id']; ?>' style='width: 120px<?php if($partial['misMatch']['serial']==true){ print ";border: 1px solid red";}?>'>
		 <?php foreach($partial['serial'] as $serial) { ?>
		          <option value='<?php print $serial; ?>'><?php print $serial; ?></option>
		    <?php }?>
		</select>
	</td>
	<td>
		<input id='input_<?php print $partial['random_id']; ?>' type='button' value='save' onclick='save_partial_match(<?php print $partial['random_id']; ?>)'>
	    <input type='hidden' id='location_<?php print $partial['random_id']; ?>' value='<?php print $partial['location']; ?>'>
	    <input type='hidden' id='date_<?php print $partial['random_id']; ?>' value='<?php print $partial['date']; ?>'>
	    <input type='hidden' id='pass_fail_<?php print $partial['random_id']; ?>' value='<?php print $partial['pass_fail']; ?>'>
	    <input type='hidden' id='extra_data_<?php print $partial['random_id']; ?>' value='<?php  print serialize($partial['extraData']); ?>'>
	    <input type='hidden' id='test_data_<?php print $partial['random_id']; ?>' value='<?php  print serialize($partial['testData']); ?>'>
	    <input type='hidden' id='comments_<?php print $partial['random_id']; ?>' value='<?php  print $partial['comments']; ?>'>
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
