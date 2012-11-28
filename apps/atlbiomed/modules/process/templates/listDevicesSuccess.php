<br><br>
<div class='regularCont'>
<div class='titleBar'>Client Devices</div>
<div class='innerCont'>

<div >
<? if(!empty($devices)){?>
<input type='button' value='Quote Failed Item' onclick='quoted()'> 
<input type='button' value='Pending Repairs' onClick='pendingRepair()'> 
<input type='button' value='Schedule Repair' onClick="scheduleRepair(<?php print $client_id;?>)">
<input type='button' value='Reschedule Missing' onClick="rescheduleMissing(<?php print $client_id;?>)"> 
<input type='button' value='Print Final Report' onClick="generateReport()">
<? }else{
	?>
<input type='button' value='Quote Failed Item' disabled='disabled'> 
<input type='button' value='Pending Repairs' disabled='disabled'> 
<input type='button' value='Schedule Repair' disabled='disabled'> 
<input type='button' value='Reschedule Missing' disabled='disabled'> 
<input type='button' value='Print Final Report' disabled='disabled'>
	<?php
} ?>
</div>
<br/>
<table style='margin-left: 30px;'>

<tr>
<td style='width: 20px; font-weight:bold'>
 
</td>
<td style='width:150px; font-weight:bold'>
	Device Id
</td>
<td style='width:150px; font-weight:bold'>
	Device
</td>
<td  style='width:150px;font-weight:bold'>
	Manufacturer
</td>
<td  style='width:150px;font-weight:bold'>
	Model
</td>
<td  style='width:150px;font-weight:bold'>
	Serial
</td>
<td  style='width:150px;font-weight:bold'>
	Location
</td>
<td  style='width:150px;font-weight:bold'>
	Status
</td>
<td style='width:150px;font-weight:bold'>
	Comments
</td>
</tr>
<?php 

$listDeviceIdAr = array();

foreach($devices as $device){
if($device->getSpecification()){
	$manufacturer = $device->getSpecification()->getManufacturer();
	$model = $device->getSpecification()->getModelNumber();
$d_name = $device->getSpecification()->getDeviceName();
}

$listDeviceIdAr[] = $device->getId();
	?>
<tr>
<td>
	<input type='checkbox'  id='checkbox_<?php print $device->getId(); ?>' /> 
</td>
<td>
	<input type='text' id='device_' value='<?php print $device->getIdentification(); ?>'/>
</td>
<td>
	<input type='text' id='dd_name_' value='<?php  print $d_name; ?>'/>
</td>
<td>
	<input type='text' id='manufacturer_' value='<?php  print $manufacturer; ?>'/>
</td>
<td>
	<input type='text' id='serial_' value='<?php print $model; ?>'/>
</td>
<td>
	<input type='text' id='serial_' value='<?php print $device->getSerialNumber(); ?>'/>
</td>
<td>
<input type='text' id='serial_' value='<?php print $device->getLocation(); ?>'/>
</td>
<td>
	<select style='width: 140px'>
	<option value='<?php print ucwords($device->getStatus()); ?>'/><?php print ucwords($device->getStatus()); ?></option>
	</select>
</td>
<td>
	<input type='text' id='device_comment_' value='<?php print $device->getComments(); ?>' onblur='save_comments(this,<?php print $device->getId(); ?>)'/>
</td>
</tr>
<?php } 
if(empty($devices)){
?><td>
	 <!--checkboxes would be here -->
</td>
<tr>
<td>
	<input type='checkbox'    /> 
</td>
<td>
	<input type='text' id='device_' value=' '/>
</td>
<td>
	<input type='text' id='dd_name_' />
</td>
<td>
	<input type='text' id='manufacturer_'  />
</td>
<td>
	<input type='text' id='serial_' />
</td>
<td>
	<input type='text' id='serial_'  />
</td>
<td>
	<input type='text' id='serial_'  />
</td>
<td>
	<input type='text' id='device_comment_'  />
</td>
</tr>
<?php
}
?>
</table>
<input type='hidden' id='hidden_device_id' value='<?php print implode(',',$listDeviceIdAr); ?>'/>
</div>
</div>

<script type='text/javascript'>
window.insertContact('<?php print $contact; ?>');
</script>
