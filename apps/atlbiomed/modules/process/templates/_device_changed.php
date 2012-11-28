<? 

$oldDevice_name = ($oldDevice->getSpecification()) ? $oldDevice->getSpecification()->getDeviceName() : ''; 
$oldDevice_manufacturer = ($oldDevice->getSpecification()) ?  $oldDevice->getSpecification()->getManufacturer()  : '';
$oldDevice_serial = $oldDevice->getSerialNumber();
$oldDevice_model = ($oldDevice->getSpecification()) ? $oldDevice->getSpecification()->getModelNumber()  : '';
?>

<?php
//$_device_name = "<select>";
if(!empty($newDevice)){
	$_device_name .= "<option value='".$newDevice['device_name']."'>".$newDevice['device_name']."</option>";
	if(!empty($oldDevice_name)){
		$_device_name .= "<option value='$oldDevice_name'>$oldDevice_name</option>";
	}
}
//$_device_name .= "</select>";
//print $_device_name;


//$_manufacturer = "<select>";
if(!empty($newDevice)){ 
	$_manufacturer .= "<option value='".$newDevice['manufacturer']."'>".$newDevice['manufacturer']."</option>";
}
if(!empty($oldDevice_manufacturer)){
	$_manufacturer .= "<option value='$oldDevice_manufacturer'>$oldDevice_manufacturer</option>";
}
//$_manufacturer .=  "</select>";
//print $_manufacturer;


//$_serial ="<select>";
if(!empty($newDevice))
    $_serial.= "<option value='".$newDevice['serial']."'>".$newDevice['serial']."</option>";
if(!empty($oldDevice_serial))
		$_serial.= "<option value='$oldDevice_serial'>$oldDevice_serial</option>";
//$_serial.= "</select>";
//print $_serial;

//$_model = "<select>";
if(!empty($newDevice))
	$_model .= "<option value='".$newDevice['model']."'>".$newDevice['model']."</option>";
if(!empty($oldDevice_model))
	$_model .= "<option value='$oldDevice_model'>$oldDevice_model</option>";
//$_model .= "</select>";
//print $_model;

print "
	{
	serial: \"$_serial\",
	model: \"$_model\",
	manufacturer: \"$_manufacturer\",
	device_name: \"$_device_name\"
	}";
?>


