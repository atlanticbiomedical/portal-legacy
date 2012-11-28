<div id='mainFreqContainer'>
<div id='clost_text_cont'><a id='clost_text' href='javascript:void(0);' onclick='Element.hide("mainFreqContainer");'>CLOSE</a></div>
<div style='padding: 4px'>
You are removing the frequency for months with a scheduled job.
You may edit/reschedule these job, otherwise it will be deleted.<br/><br/>
</div>
<div id ='frequencyInner'>

</div>
<div><input style='margin: 0px 0px 0px 200px' type='button' value="Save" onclick='saveClient()'/></div>
</div>


<?php   //
	use_helper('Object');
	use_helper('Validation');
	use_helper('Javascript');
	echo javascript_include_tag('dropdown');

$frequencyLegacy = ($mode == 'edit' and $populateClient->getFrequency() != null)
	? explode(",", $populateClient->getFrequency()->getContents()) : explode(",", $populateClient->getFrequency());

$frequencyAnnual = ($mode == 'edit' and $populateClient->getFrequencyAnnual() != null)
	? explode(",", $populateClient->getFrequencyAnnual()->getContents()) : explode(",", $populateClient->getFrequencyAnnual());

$frequencySemi = ($mode == 'edit' and $populateClient->getFrequencySemi() != null)
	? explode(",", $populateClient->getFrequencySemi()->getContents()) : explode(",", $populateClient->getFrequencySemi());

$frequencyQuarterly = ($mode == 'edit' and $populateClient->getFrequencyQuarterly() != null)
	? explode(",", $populateClient->getFrequencyQuarterly()->getContents()) : explode(",", $populateClient->getFrequencyQuarterly());

$frequencySterilizer = ($mode == 'edit' and $populateClient->getFrequencySterilizer() != null)
	? explode(",", $populateClient->getFrequencySterilizer()->getContents()) : explode(",", $populateClient->getFrequencySterilizer());

$frequencyTg = ($mode == 'edit' and $populateClient->getFrequencyTg() != null)
	? explode(",", $populateClient->getFrequencyTg()->getContents()) : explode(",", $populateClient->getFrequencyTg());

$frequencyErt = ($mode == 'edit' and $populateClient->getFrequencyErt() != null)
	? explode(",", $populateClient->getFrequencyErt()->getContents()) : explode(",", $populateClient->getFrequencyErt());

$frequencyRae = ($mode == 'edit' and $populateClient->getFrequencyRae() != null)
	? explode(",", $populateClient->getFrequencyRae()->getContents()) : explode(",", $populateClient->getFrequencyRae());

$frequencyMedgas = ($mode == 'edit' and $populateClient->getFrequencyMedgas() != null)
	? explode(",", $populateClient->getFrequencyMedgas()->getContents()) : explode(",", $populateClient->getFrequencyMedgas());

$frequencyImaging = ($mode == 'edit' and $populateClient->getFrequencyImaging() != null)
	? explode(",", $populateClient->getFrequencyImaging()->getContents()) : explode(",", $populateClient->getFrequencyImaging());

$frequencyNeptune = ($mode == 'edit' and $populateClient->getFrequencyNeptune() != null)
	? explode(",", $populateClient->getFrequencyNeptune()->getContents()) : explode(",", $populateClient->getFrequencyNeptune());

$frequencyAnesthesia = ($mode == 'edit' and $populateClient->getFrequencyAnesthesia() != null)
        ? explode(",", $populateClient->getFrequencyAnesthesia()->getContents()) : explode(",", $populateClient->getFrequencyAnesthesia());

$freqLegacyJAN = 0; $freqLegacyFEB = 0; $freqLegacyMAR = 0; $freqLegacyAPR = 0; $freqLegacyMAY = 0; $freqLegacyJUN = 0; $freqLegacyJUL = 0; $freqLegacyAUG = 0; $freqLegacySEP = 0; $freqLegacyOCT = 0; $freqLegacyNOV = 0; $freqLegacyDEC = 0; 
$freqAnnualJAN = 0; $freqAnnualFEB = 0; $freqAnnualMAR = 0; $freqAnnualAPR = 0; $freqAnnualMAY = 0; $freqAnnualJUN = 0; $freqAnnualJUL = 0; $freqAnnualAUG = 0; $freqAnnualSEP = 0; $freqAnnualOCT = 0; $freqAnnualNOV = 0; $freqAnnualDEC = 0; 
$freqSemiJAN = 0; $freqSemiFEB = 0; $freqSemiMAR = 0; $freqSemiAPR = 0; $freqSemiMAY = 0; $freqSemiJUN = 0; $freqSemiJUL = 0; $freqSemiAUG = 0; $freqSemiSEP = 0; $freqSemiOCT = 0; $freqSemiNOV = 0; $freqSemiDEC = 0; 
$freqQuarterlyJAN = 0; $freqQuarterlyFEB = 0; $freqQuarterlyMAR = 0; $freqQuarterlyAPR = 0; $freqQuarterlyMAY = 0; $freqQuarterlyJUN = 0; $freqQuarterlyJUL = 0; $freqQuarterlyAUG = 0; $freqQuarterlySEP = 0; $freqQuarterlyOCT = 0; $freqQuarterlyNOV = 0; $freqQuarterlyDEC = 0; 
$freqSterilizerJAN = 0; $freqSterilizerFEB = 0; $freqSterilizerMAR = 0; $freqSterilizerAPR = 0; $freqSterilizerMAY = 0; $freqSterilizerJUN = 0; $freqSterilizerJUL = 0; $freqSterilizerAUG = 0; $freqSterilizerSEP = 0; $freqSterilizerOCT = 0; $freqSterilizerNOV = 0; $freqSterilizerDEC = 0; 
$freqTgJAN = 0; $freqTgFEB = 0; $freqTgMAR = 0; $freqTgAPR = 0; $freqTgMAY = 0; $freqTgJUN = 0; $freqTgJUL = 0; $freqTgAUG = 0; $freqTgSEP = 0; $freqTgOCT = 0; $freqTgNOV = 0; $freqTgDEC = 0; 
$freqErtJAN = 0; $freqErtFEB = 0; $freqErtMAR = 0; $freqErtAPR = 0; $freqErtMAY = 0; $freqErtJUN = 0; $freqErtJUL = 0; $freqErtAUG = 0; $freqErtSEP = 0; $freqErtOCT = 0; $freqErtNOV = 0; $freqErtDEC = 0; 
$freqRaeJAN = 0; $freqRaeFEB = 0; $freqRaeMAR = 0; $freqRaeAPR = 0; $freqRaeMAY = 0; $freqRaeJUN = 0; $freqRaeJUL = 0; $freqRaeAUG = 0; $freqRaeSEP = 0; $freqRaeOCT = 0; $freqRaeNOV = 0; $freqRaeDEC = 0; 
$freqMedgasJAN = 0; $freqMedgasFEB = 0; $freqMedgasMAR = 0; $freqMedgasAPR = 0; $freqMedgasMAY = 0; $freqMedgasJUN = 0; $freqMedgasJUL = 0; $freqMedgasAUG = 0; $freqMedgasSEP = 0; $freqMedgasOCT = 0; $freqMedgasNOV = 0; $freqMedgasDEC = 0; 
$freqImagingJAN = 0; $freqImagingFEB = 0; $freqImagingMAR = 0; $freqImagingAPR = 0; $freqImagingMAY = 0; $freqImagingJUN = 0; $freqImagingJUL = 0; $freqImagingAUG = 0; $freqImagingSEP = 0; $freqImagingOCT = 0; $freqImagingNOV = 0; $freqImagingDEC = 0; 
$freqNeptuneJAN = 0; $freqNeptuneFEB = 0; $freqNeptuneMAR = 0; $freqNeptuneAPR = 0; $freqNeptuneMAY = 0; $freqNeptuneJUN = 0; $freqNeptuneJUL = 0; $freqNeptuneAUG = 0; $freqNeptuneSEP = 0; $freqNeptuneOCT = 0; $freqNeptuneNOV = 0; $freqNeptuneDEC = 0; 
$freqAnesthesiaJAN = 0; $freqAnesthesiaFEB = 0; $freqAnesthesiaMAR = 0; $freqAnesthesiaAPR = 0; $freqAnesthesiaMAY = 0; $freqAnesthesiaJUN = 0; $freqAnesthesiaJUL = 0; $freqAnesthesiaAUG = 0; $freqAnesthesiaSEP = 0; $freqAnesthesiaOCT = 0; $freqAnesthesiaNOV = 0; $freqAnesthesiaDEC = 0;

foreach ($frequencyLegacy as $freq) {
	if($freq == 'JAN'){$freqLegacyJAN = 1;}
	if($freq == 'FEB'){$freqLegacyFEB = 1;}
	if($freq == 'MAR'){$freqLegacyMAR = 1;}
	if($freq == 'APR'){$freqLegacyAPR = 1;}
	if($freq == 'MAY'){$freqLegacyMAY = 1;}
	if($freq == 'JUN'){$freqLegacyJUN = 1;}
	if($freq == 'JUL'){$freqLegacyJUL = 1;}
	if($freq == 'AUG'){$freqLegacyAUG = 1;}
	if($freq == 'SEP'){$freqLegacySEP = 1;}
	if($freq == 'OCT'){$freqLegacyOCT = 1;}
	if($freq == 'NOV'){$freqLegacyNOV = 1;}
	if($freq == 'DEC'){$freqLegacyDEC = 1;}
}

foreach ($frequencyAnnual as $freq) {
	if($freq == 'JAN'){$freqAnnualJAN = 1;}
	if($freq == 'FEB'){$freqAnnualFEB = 1;}
	if($freq == 'MAR'){$freqAnnualMAR = 1;}
	if($freq == 'APR'){$freqAnnualAPR = 1;}
	if($freq == 'MAY'){$freqAnnualMAY = 1;}
	if($freq == 'JUN'){$freqAnnualJUN = 1;}
	if($freq == 'JUL'){$freqAnnualJUL = 1;}
	if($freq == 'AUG'){$freqAnnualAUG = 1;}
	if($freq == 'SEP'){$freqAnnualSEP = 1;}
	if($freq == 'OCT'){$freqAnnualOCT = 1;}
	if($freq == 'NOV'){$freqAnnualNOV = 1;}
	if($freq == 'DEC'){$freqAnnualDEC = 1;}
}

foreach ($frequencySemi as $freq) {
	if($freq == 'JAN'){$freqSemiJAN = 1;}
	if($freq == 'FEB'){$freqSemiFEB = 1;}
	if($freq == 'MAR'){$freqSemiMAR = 1;}
	if($freq == 'APR'){$freqSemiAPR = 1;}
	if($freq == 'MAY'){$freqSemiMAY = 1;}
	if($freq == 'JUN'){$freqSemiJUN = 1;}
	if($freq == 'JUL'){$freqSemiJUL = 1;}
	if($freq == 'AUG'){$freqSemiAUG = 1;}
	if($freq == 'SEP'){$freqSemiSEP = 1;}
	if($freq == 'OCT'){$freqSemiOCT = 1;}
	if($freq == 'NOV'){$freqSemiNOV = 1;}
	if($freq == 'DEC'){$freqSemiDEC = 1;}
}

foreach ($frequencyQuarterly as $freq) {
	if($freq == 'JAN'){$freqQuarterlyJAN = 1;}
	if($freq == 'FEB'){$freqQuarterlyFEB = 1;}
	if($freq == 'MAR'){$freqQuarterlyMAR = 1;}
	if($freq == 'APR'){$freqQuarterlyAPR = 1;}
	if($freq == 'MAY'){$freqQuarterlyMAY = 1;}
	if($freq == 'JUN'){$freqQuarterlyJUN = 1;}
	if($freq == 'JUL'){$freqQuarterlyJUL = 1;}
	if($freq == 'AUG'){$freqQuarterlyAUG = 1;}
	if($freq == 'SEP'){$freqQuarterlySEP = 1;}
	if($freq == 'OCT'){$freqQuarterlyOCT = 1;}
	if($freq == 'NOV'){$freqQuarterlyNOV = 1;}
	if($freq == 'DEC'){$freqQuarterlyDEC = 1;}
}

foreach ($frequencySterilizer as $freq) {
	if($freq == 'JAN'){$freqSterilizerJAN = 1;}
	if($freq == 'FEB'){$freqSterilizerFEB = 1;}
	if($freq == 'MAR'){$freqSterilizerMAR = 1;}
	if($freq == 'APR'){$freqSterilizerAPR = 1;}
	if($freq == 'MAY'){$freqSterilizerMAY = 1;}
	if($freq == 'JUN'){$freqSterilizerJUN = 1;}
	if($freq == 'JUL'){$freqSterilizerJUL = 1;}
	if($freq == 'AUG'){$freqSterilizerAUG = 1;}
	if($freq == 'SEP'){$freqSterilizerSEP = 1;}
	if($freq == 'OCT'){$freqSterilizerOCT = 1;}
	if($freq == 'NOV'){$freqSterilizerNOV = 1;}
	if($freq == 'DEC'){$freqSterilizerDEC = 1;}
}

foreach ($frequencyTg as $freq) {
	if($freq == 'JAN'){$freqTgJAN = 1;}
	if($freq == 'FEB'){$freqTgFEB = 1;}
	if($freq == 'MAR'){$freqTgMAR = 1;}
	if($freq == 'APR'){$freqTgAPR = 1;}
	if($freq == 'MAY'){$freqTgMAY = 1;}
	if($freq == 'JUN'){$freqTgJUN = 1;}
	if($freq == 'JUL'){$freqTgJUL = 1;}
	if($freq == 'AUG'){$freqTgAUG = 1;}
	if($freq == 'SEP'){$freqTgSEP = 1;}
	if($freq == 'OCT'){$freqTgOCT = 1;}
	if($freq == 'NOV'){$freqTgNOV = 1;}
	if($freq == 'DEC'){$freqTgDEC = 1;}
}

foreach ($frequencyErt as $freq) {
	if($freq == 'JAN'){$freqErtJAN = 1;}
	if($freq == 'FEB'){$freqErtFEB = 1;}
	if($freq == 'MAR'){$freqErtMAR = 1;}
	if($freq == 'APR'){$freqErtAPR = 1;}
	if($freq == 'MAY'){$freqErtMAY = 1;}
	if($freq == 'JUN'){$freqErtJUN = 1;}
	if($freq == 'JUL'){$freqErtJUL = 1;}
	if($freq == 'AUG'){$freqErtAUG = 1;}
	if($freq == 'SEP'){$freqErtSEP = 1;}
	if($freq == 'OCT'){$freqErtOCT = 1;}
	if($freq == 'NOV'){$freqErtNOV = 1;}
	if($freq == 'DEC'){$freqErtDEC = 1;}
}

foreach ($frequencyRae as $freq) {
	if($freq == 'JAN'){$freqRaeJAN = 1;}
	if($freq == 'FEB'){$freqRaeFEB = 1;}
	if($freq == 'MAR'){$freqRaeMAR = 1;}
	if($freq == 'APR'){$freqRaeAPR = 1;}
	if($freq == 'MAY'){$freqRaeMAY = 1;}
	if($freq == 'JUN'){$freqRaeJUN = 1;}
	if($freq == 'JUL'){$freqRaeJUL = 1;}
	if($freq == 'AUG'){$freqRaeAUG = 1;}
	if($freq == 'SEP'){$freqRaeSEP = 1;}
	if($freq == 'OCT'){$freqRaeOCT = 1;}
	if($freq == 'NOV'){$freqRaeNOV = 1;}
	if($freq == 'DEC'){$freqRaeDEC = 1;}
}

foreach ($frequencyMedgas as $freq) {
	if($freq == 'JAN'){$freqMedgasJAN = 1;}
	if($freq == 'FEB'){$freqMedgasFEB = 1;}
	if($freq == 'MAR'){$freqMedgasMAR = 1;}
	if($freq == 'APR'){$freqMedgasAPR = 1;}
	if($freq == 'MAY'){$freqMedgasMAY = 1;}
	if($freq == 'JUN'){$freqMedgasJUN = 1;}
	if($freq == 'JUL'){$freqMedgasJUL = 1;}
	if($freq == 'AUG'){$freqMedgasAUG = 1;}
	if($freq == 'SEP'){$freqMedgasSEP = 1;}
	if($freq == 'OCT'){$freqMedgasOCT = 1;}
	if($freq == 'NOV'){$freqMedgasNOV = 1;}
	if($freq == 'DEC'){$freqMedgasDEC = 1;}
}

foreach ($frequencyImaging as $freq) {
	if($freq == 'JAN'){$freqImagingJAN = 1;}
	if($freq == 'FEB'){$freqImagingFEB = 1;}
	if($freq == 'MAR'){$freqImagingMAR = 1;}
	if($freq == 'APR'){$freqImagingAPR = 1;}
	if($freq == 'MAY'){$freqImagingMAY = 1;}
	if($freq == 'JUN'){$freqImagingJUN = 1;}
	if($freq == 'JUL'){$freqImagingJUL = 1;}
	if($freq == 'AUG'){$freqImagingAUG = 1;}
	if($freq == 'SEP'){$freqImagingSEP = 1;}
	if($freq == 'OCT'){$freqImagingOCT = 1;}
	if($freq == 'NOV'){$freqImagingNOV = 1;}
	if($freq == 'DEC'){$freqImagingDEC = 1;}
}

foreach ($frequencyNeptune as $freq) {
	if($freq == 'JAN'){$freqNeptuneJAN = 1;}
	if($freq == 'FEB'){$freqNeptuneFEB = 1;}
	if($freq == 'MAR'){$freqNeptuneMAR = 1;}
	if($freq == 'APR'){$freqNeptuneAPR = 1;}
	if($freq == 'MAY'){$freqNeptuneMAY = 1;}
	if($freq == 'JUN'){$freqNeptuneJUN = 1;}
	if($freq == 'JUL'){$freqNeptuneJUL = 1;}
	if($freq == 'AUG'){$freqNeptuneAUG = 1;}
	if($freq == 'SEP'){$freqNeptuneSEP = 1;}
	if($freq == 'OCT'){$freqNeptuneOCT = 1;}
	if($freq == 'NOV'){$freqNeptuneNOV = 1;}
	if($freq == 'DEC'){$freqNeptuneDEC = 1;}
}
foreach ($frequencyAnesthesia as $freq) {
        if($freq == 'JAN'){$freqAnesthesiaJAN = 1;}
        if($freq == 'FEB'){$freqAnesthesiaFEB = 1;}
        if($freq == 'MAR'){$freqAnesthesiaMAR = 1;}
        if($freq == 'APR'){$freqAnesthesiaAPR = 1;}
        if($freq == 'MAY'){$freqAnesthesiaMAY = 1;}
        if($freq == 'JUN'){$freqAnesthesiaJUN = 1;}
        if($freq == 'JUL'){$freqAnesthesiaJUL = 1;}
        if($freq == 'AUG'){$freqAnesthesiaAUG = 1;}
        if($freq == 'SEP'){$freqAnesthesiaSEP = 1;}
        if($freq == 'OCT'){$freqAnesthesiaOCT = 1;}
        if($freq == 'NOV'){$freqAnesthesiaNOV = 1;}
        if($freq == 'DEC'){$freqAnesthesiaDEC = 1;}
}

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
		
		$secondaryAddress = $populateClient->getSecondaryAddress();
		$secondaryAddress2 = $populateClient->getSecondaryAddress2();
		$secondaryCity = $populateClient->getSecondaryCity();
		$secondaryState = $populateClient->getSecondaryState();
		$secondaryZip = $populateClient->getSecondaryZip();
		$secondaryAttn = $populateClient->getSecondaryAttn();
		$addressType = $populateClient->getAddressType();

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
<table class="clientSelect" width="100%">
<tr>
	<td width="100">Device Search</td>
	<td ><input type='text' size="25" name='input_device_id' id='input_device_id' value='<?php print $foundDeviceId; ?>'/></td>
	<td><?php echo submit_tag('Search',array('style'=>'float:right')); ?></td>
</tr>
</table>
</form>

<?php echo form_tag('clientManager/index', array('id' => 'clientSelect')); ?>
<?php echo input_hidden_tag('mode', 'report-view'); ?>
<table class="clientSelect" width="100%">
<tr>
	<td width="100">Frequency Report</td>
        <td><?php echo select_tag('month', options_for_select(array(
                                '' => 'Please Select...',
                                'JAN' => 'January',
                                'FEB' => 'Febuary',
                                'MAR' => 'March',
                                'APR' => 'April',
                                'MAY' => 'May',
                                'JUN' => 'June',
                                'JUL' => 'July',
                                'AUG' => 'August',
                                'SEP' => 'September',
                                'OCT' => 'October',
                                'NOV' => 'November',
                                'DEC' => 'December'))); ?></td>
	<td><?php echo submit_tag('Generate', array('style'=>'float:right')); ?></td>
</tr>
</table>
</form>

<?php echo form_tag('clientManager/index', array('id' => 'clientSelect')); ?>

<?php echo input_hidden_tag('mode', 'edit'); ?>
<table class="clientSelect" width="100%">
<tr>
	<td width="100">Select Client</td>
	<td><?php echo select_tag('id', options_for_select($clients, $client_id,'include_custom=Please Select a Client'), array('onFocus' => "this.enteredText='';", 'onkeydown' => "return handleKey();", 'onkeyup' => "event.cancelbubble=true;return false;", 'onkeypress' => "return selectItem();") );?></td>
	<td><?php echo submit_tag('Select',array('style'=>'float:right')); ?></td>
</tr>
</table>
</form>

<?php echo form_tag('clientManager/addClient',array('id'=>'addClientForm','onsubmit'=>'return checkFrequencyStatus()')); ?>
<?php echo input_hidden_tag('mode', $mode); ?>
<?php echo input_hidden_tag('updatedFreqCount', ''); ?>
<?php echo input_hidden_tag('id', $populateClient->getId()); ?>

<table class="clientInfo">
<tr>
	<td colspan=2><?php echo form_error('client_identification'); ?></td>
</tr>

<tr>
	<td width="100">Client ID:</td>
	<td><?php echo input_tag('client_identification', $clientIdValue, array('size' => '30')); ?></td>
</tr>

<tr>
	<td colspan=2><?php echo form_error('client_name'); ?></td>
</tr>

<tr>
	<td>Client Name:</td>
	<td><?php echo input_tag('client_name', $clientNameValue, array('size' => '30')); ?></td>
</tr>

<tr>
	<td colspan=2><?php echo form_error('address'); ?></td>
</tr>

<tr>
	<td>Address:</td>
	<td><?php echo input_tag('address', $addressValue, array('size' => '30')); ?></td>
</tr>

<tr>
	<td></td>
	<td><?php echo input_tag('address_2', $address2Value, array('size' => '30')); ?></td>
</tr>

<tr>
	<td colspan=2><?php echo form_error('city'); ?></td>
</tr>

<tr>
	<td>City:</td>
	<td><?php echo input_tag('city', $cityValue, array('size' => '30')); ?></td>
</tr>

<tr>
	<td colspan=2><?php echo form_error('state'); ?></td>
</tr>

<tr>
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
				'DE' => 'Delaware',
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
</tr>

<tr>
	<td colspan=2><?php echo form_error('zip'); ?></td>
</tr>

<tr>
	<td>Zip:</td>
	<td><?php echo input_tag('zip', $zipValue, array('size' => '5')); ?></td>
</tr>

<tr>
	<td colspan=2><?php echo form_error('attn'); ?></td>
</tr>

<tr>
	<td>Attn:</td>
	<td><?php echo input_tag('attn', $attnValue, array('size' => '30')); ?></td>
</tr>

<tr>
	<td colspan=2><?php echo form_error('email'); ?></td>
</tr>

<tr>
	<td>Email:</td>
	<td><?php echo input_tag('email', $emailValue, array('size' => '30')); ?></td>
</tr>

<tr>
	<td colspan=2><?php echo form_error('phone'); echo form_error('ext'); ?></td>
</tr>

<tr>
	<td>Phone:</td>
	<td><?php echo input_tag('phone', $phoneValue, 'size=14').' ext.:'.input_tag('ext', $extValue, 'size=4'); ?></td>
</tr>
<tr>
	<td></td>
	<td colspan='2'>
		Primary Address:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='address_type' value='1' <?php if($addressType == 1){ print "checked"; }?> ><br/> 
		Secondary Address<a href="javascript:void(0)" onclick="$('secondary_info').show();">(Edit)</a>: <input type='radio' name='address_type' value='2' <?php if($addressType == 2){ print "checked"; }?>>
        </td>
</tr>
<tr><td colspan='2'>

<div id='secondary_info' style='border: 1px solid #000; margin: 10px 0px 10px 0px; display:NONE;'>
<table>
<div style='text-align: center; background-color: #333339; margin-bottom: 5px; color:#fff; font-weight:bold;'> Secondary Address</div>
<tr>
<td style='width: 76px'>Address </td><td><input type='text' value='<?php print $secondaryAddress; ?>' id='secondary_address' size='28' /></td>
</tr>
<tr>
<td></td><td><input type='text' value='<?php print $secondaryAddress2; ?>' id='secondary_address2' size='28' /></td>
</tr><tr>
<td>City </td><td><input type='text' value='<?php print $secondaryCity; ?>' id='secondary_city' size='28' /></td>
</tr><tr>
<td>State </td><td><?php echo select_tag('secondary_state', options_for_select(array(
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
				'WY' => 'Wyoming'), $secondaryState)); ?></td>
</tr><tr>
<td>Zip </td><td><input type='text' value='<?php print $secondaryZip; ?>' id='secondary_zip' style='width:60px' /></td>
</tr>
<tr>
<td>Attn </td><td><input type='text' value='<?php print $secondaryAttn; ?>' id='secondary_attn' size='28'/></td>
</tr>
<tr>
<td></td><td align='right'><input type='button' value='Save' name='Save' onclick='saveSecondaryAddress()' /> <input type='button' value='Close' name='Close' onclick="$('secondary_info').hide();" /> </td>
</tr>
</table>

</div>
</td></tr>
<tr>
	<td colspan=2><?php echo form_error('category'); ?></td>
</tr>

<tr>
	<td>Category:</td>
	<td><?php echo select_tag('category', options_for_select(array(
					'' 				=> 'Please Select...',
					'cardiology'	=> 'Cardiology',
					'chiropractic'		=> 'Chiropractic',
					'endoscopy'	=> 'Endoscopy',
					'entsurgery'	=> 'Ent Surgery',
					'eyesurgery'	=> 'Eye Surgery',
					'hospital'	=> 'Hospital',
					'hospitalsatellite'	=> 'Hospital Satellite',
					'plasticsurgery'	=> 'Plastic Surgery',
					'podiatrist'	=> 'Podiatrist',
					'physicaltherapy'	=> 'Physical Therapy',
					'veterinary'	=> 'Veterinary'), $categoryValue)); ?></td>
					
</tr>
 

<tr>
<td>All Devices:</td>
<td valign="middle">
	<?php echo input_tag('all_devices', $populateClient->getAllDevices(), 'size=1').' hrs'; ?>
	<?php echo input_hidden_tag('anesthesia', $anestValue); ?>
	<?php echo input_hidden_tag('medgas', $medgasValue); ?>
</td>

</tr>

<tr>
	<td>Notes:</td>
	<td><?php echo textarea_tag('notes', $notesValue, array('width' => '30')); ?></td>
</tr>

<tr>
	<td colspan="2">
	<div><a target='_blank' href='/index.php/clientManager/ReportAll'>Frequency</a>:</div>
		<?php 	if ($mode == 'edit') {

        $paramArray = ($freqLocked) ? array('disabled'=>'disabled') : array();
        
        ?>
<table class="frequency_table">
<tr>
	<td></td>
	<td class="frequency_header">JAN</td>
	<td class="frequency_header alt">FEB</td>
	<td class="frequency_header">MAR</td>
	<td class="frequency_header alt">APR</td>
	<td class="frequency_header">MAY</td>
	<td class="frequency_header alt">JUN</td>
	<td class="frequency_header">JUL</td>
	<td class="frequency_header alt">AUG</td>
	<td class="frequency_header">SEPT</td>
	<td class="frequency_header alt">OCT</td>
	<td class="frequency_header">NOV</td>
	<td class="frequency_header alt">DEC</td>
</tr>
<tr>
	<td class="frequency_type"><i>Legacy</i></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_legacy[]', 'JAN', $freqLegacyJAN, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_legacy[]', 'FEB', $freqLegacyFEB, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_legacy[]', 'MAR', $freqLegacyMAR, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_legacy[]', 'APR', $freqLegacyAPR, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_legacy[]', 'MAY', $freqLegacyMAY, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_legacy[]', 'JUN', $freqLegacyJUN, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_legacy[]', 'JUL', $freqLegacyJUL, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_legacy[]', 'AUG', $freqLegacyAUG, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_legacy[]', 'SEP', $freqLegacySEP, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_legacy[]', 'OCT', $freqLegacyOCT, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_legacy[]', 'NOV', $freqLegacyNOV, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_legacy[]', 'DEC', $freqLegacyDEC, $paramArray); ?></td>
</tr>
<tr>
	<td class="frequency_type">Annual</td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_annual[]', 'JAN', $freqAnnualJAN, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_annual[]', 'FEB', $freqAnnualFEB, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_annual[]', 'MAR', $freqAnnualMAR, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_annual[]', 'APR', $freqAnnualAPR, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_annual[]', 'MAY', $freqAnnualMAY, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_annual[]', 'JUN', $freqAnnualJUN, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_annual[]', 'JUL', $freqAnnualJUL, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_annual[]', 'AUG', $freqAnnualAUG, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_annual[]', 'SEP', $freqAnnualSEP, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_annual[]', 'OCT', $freqAnnualOCT, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_annual[]', 'NOV', $freqAnnualNOV, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_annual[]', 'DEC', $freqAnnualDEC, $paramArray); ?></td>
</tr>
<tr>
	<td class="frequency_type">Semi</td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_semi[]', 'JAN', $freqSemiJAN, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_semi[]', 'FEB', $freqSemiFEB, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_semi[]', 'MAR', $freqSemiMAR, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_semi[]', 'APR', $freqSemiAPR, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_semi[]', 'MAY', $freqSemiMAY, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_semi[]', 'JUN', $freqSemiJUN, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_semi[]', 'JUL', $freqSemiJUL, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_semi[]', 'AUG', $freqSemiAUG, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_semi[]', 'SEP', $freqSemiSEP, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_semi[]', 'OCT', $freqSemiOCT, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_semi[]', 'NOV', $freqSemiNOV, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_semi[]', 'DEC', $freqSemiDEC, $paramArray); ?></td>
</tr>
<tr>
	<td class="frequency_type">Quarterly</td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_quarterly[]', 'JAN', $freqQuarterlyJAN, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_quarterly[]', 'FEB', $freqQuarterlyFEB, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_quarterly[]', 'MAR', $freqQuarterlyMAR, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_quarterly[]', 'APR', $freqQuarterlyAPR, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_quarterly[]', 'MAY', $freqQuarterlyMAY, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_quarterly[]', 'JUN', $freqQuarterlyJUN, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_quarterly[]', 'JUL', $freqQuarterlyJUL, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_quarterly[]', 'AUG', $freqQuarterlyAUG, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_quarterly[]', 'SEP', $freqQuarterlySEP, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_quarterly[]', 'OCT', $freqQuarterlyOCT, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_quarterly[]', 'NOV', $freqQuarterlyNOV, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_quarterly[]', 'DEC', $freqQuarterlyDEC, $paramArray); ?></td>
</tr>
<tr>
	<td class="frequency_type">Sterilizer</td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_sterilizer[]', 'JAN', $freqSterilizerJAN, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_sterilizer[]', 'FEB', $freqSterilizerFEB, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_sterilizer[]', 'MAR', $freqSterilizerMAR, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_sterilizer[]', 'APR', $freqSterilizerAPR, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_sterilizer[]', 'MAY', $freqSterilizerMAY, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_sterilizer[]', 'JUN', $freqSterilizerJUN, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_sterilizer[]', 'JUL', $freqSterilizerJUL, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_sterilizer[]', 'AUG', $freqSterilizerAUG, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_sterilizer[]', 'SEP', $freqSterilizerSEP, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_sterilizer[]', 'OCT', $freqSterilizerOCT, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_sterilizer[]', 'NOV', $freqSterilizerNOV, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_sterilizer[]', 'DEC', $freqSterilizerDEC, $paramArray); ?></td>
</tr>
<tr>
	<td class="frequency_type">Trace gas</td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_tg[]', 'JAN', $freqTgJAN, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_tg[]', 'FEB', $freqTgFEB, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_tg[]', 'MAR', $freqTgMAR, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_tg[]', 'APR', $freqTgAPR, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_tg[]', 'MAY', $freqTgMAY, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_tg[]', 'JUN', $freqTgJUN, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_tg[]', 'JUL', $freqTgJUL, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_tg[]', 'AUG', $freqTgAUG, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_tg[]', 'SEP', $freqTgSEP, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_tg[]', 'OCT', $freqTgOCT, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_tg[]', 'NOV', $freqTgNOV, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_tg[]', 'DEC', $freqTgDEC, $paramArray); ?></td>
</tr>
<tr>
	<td class="frequency_type">ERT</td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_ert[]', 'JAN', $freqErtJAN, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_ert[]', 'FEB', $freqErtFEB, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_ert[]', 'MAR', $freqErtMAR, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_ert[]', 'APR', $freqErtAPR, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_ert[]', 'MAY', $freqErtMAY, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_ert[]', 'JUN', $freqErtJUN, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_ert[]', 'JUL', $freqErtJUL, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_ert[]', 'AUG', $freqErtAUG, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_ert[]', 'SEP', $freqErtSEP, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_ert[]', 'OCT', $freqErtOCT, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_ert[]', 'NOV', $freqErtNOV, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_ert[]', 'DEC', $freqErtDEC, $paramArray); ?></td>
</tr>
<tr>
	<td class="frequency_type">Room air exchange</td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_rae[]', 'JAN', $freqRaeJAN, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_rae[]', 'FEB', $freqRaeFEB, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_rae[]', 'MAR', $freqRaeMAR, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_rae[]', 'APR', $freqRaeAPR, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_rae[]', 'MAY', $freqRaeMAY, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_rae[]', 'JUN', $freqRaeJUN, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_rae[]', 'JUL', $freqRaeJUL, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_rae[]', 'AUG', $freqRaeAUG, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_rae[]', 'SEP', $freqRaeSEP, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_rae[]', 'OCT', $freqRaeOCT, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_rae[]', 'NOV', $freqRaeNOV, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_rae[]', 'DEC', $freqRaeDEC, $paramArray); ?></td>
</tr>
<tr>
	<td class="frequency_type">Medgas</td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_medgas[]', 'JAN', $freqMedgasJAN, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_medgas[]', 'FEB', $freqMedgasFEB, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_medgas[]', 'MAR', $freqMedgasMAR, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_medgas[]', 'APR', $freqMedgasAPR, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_medgas[]', 'MAY', $freqMedgasMAY, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_medgas[]', 'JUN', $freqMedgasJUN, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_medgas[]', 'JUL', $freqMedgasJUL, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_medgas[]', 'AUG', $freqMedgasAUG, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_medgas[]', 'SEP', $freqMedgasSEP, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_medgas[]', 'OCT', $freqMedgasOCT, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_medgas[]', 'NOV', $freqMedgasNOV, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_medgas[]', 'DEC', $freqMedgasDEC, $paramArray); ?></td>
</tr>
<tr>
	<td class="frequency_type">Imaging</td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_imaging[]', 'JAN', $freqImagingJAN, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_imaging[]', 'FEB', $freqImagingFEB, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_imaging[]', 'MAR', $freqImagingMAR, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_imaging[]', 'APR', $freqImagingAPR, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_imaging[]', 'MAY', $freqImagingMAY, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_imaging[]', 'JUN', $freqImagingJUN, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_imaging[]', 'JUL', $freqImagingJUL, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_imaging[]', 'AUG', $freqImagingAUG, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_imaging[]', 'SEP', $freqImagingSEP, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_imaging[]', 'OCT', $freqImagingOCT, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_imaging[]', 'NOV', $freqImagingNOV, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_imaging[]', 'DEC', $freqImagingDEC, $paramArray); ?></td>
</tr>
<tr>
	<td class="frequency_type">Neptune</td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_neptune[]', 'JAN', $freqNeptuneJAN, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_neptune[]', 'FEB', $freqNeptuneFEB, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_neptune[]', 'MAR', $freqNeptuneMAR, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_neptune[]', 'APR', $freqNeptuneAPR, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_neptune[]', 'MAY', $freqNeptuneMAY, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_neptune[]', 'JUN', $freqNeptuneJUN, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_neptune[]', 'JUL', $freqNeptuneJUL, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_neptune[]', 'AUG', $freqNeptuneAUG, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_neptune[]', 'SEP', $freqNeptuneSEP, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_neptune[]', 'OCT', $freqNeptuneOCT, $paramArray); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_neptune[]', 'NOV', $freqNeptuneNOV, $paramArray); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_neptune[]', 'DEC', $freqNeptuneDEC, $paramArray); ?></td>
</tr>
<tr>
        <td class="frequency_type">Anesthesia</td>
        <td class="frequency_item"><?php echo checkbox_tag('frequency_anesthesia[]', 'JAN', $freqAnesthesiaJAN, $paramArray); ?></td>
        <td class="frequency_item alt"><?php echo checkbox_tag('frequency_anesthesia[]', 'FEB', $freqAnesthesiaFEB, $paramArray); ?></td>
        <td class="frequency_item"><?php echo checkbox_tag('frequency_anesthesia[]', 'MAR', $freqAnesthesiaMAR, $paramArray); ?></td>
        <td class="frequency_item alt"><?php echo checkbox_tag('frequency_anesthesia[]', 'APR', $freqAnesthesiaAPR, $paramArray); ?></td>
        <td class="frequency_item"><?php echo checkbox_tag('frequency_anesthesia[]', 'MAY', $freqAnesthesiaMAY, $paramArray); ?></td>
        <td class="frequency_item alt"><?php echo checkbox_tag('frequency_anesthesia[]', 'JUN', $freqAnesthesiaJUN, $paramArray); ?></td>
        <td class="frequency_item"><?php echo checkbox_tag('frequency_anesthesia[]', 'JUL', $freqAnesthesiaJUL, $paramArray); ?></td>
        <td class="frequency_item alt"><?php echo checkbox_tag('frequency_anesthesia[]', 'AUG', $freqAnesthesiaAUG, $paramArray); ?></td>
        <td class="frequency_item"><?php echo checkbox_tag('frequency_anesthesia[]', 'SEP', $freqAnesthesiaSEP, $paramArray); ?></td>
        <td class="frequency_item alt"><?php echo checkbox_tag('frequency_anesthesia[]', 'OCT', $freqAnesthesiaOCT, $paramArray); ?></td>
        <td class="frequency_item"><?php echo checkbox_tag('frequency_anesthesia[]', 'NOV', $freqAnesthesiaNOV, $paramArray); ?></td>
        <td class="frequency_item alt"><?php echo checkbox_tag('frequency_anesthesia[]', 'DEC', $freqAnesthesiaDEC, $paramArray); ?></td>
</tr>
</table>
		<?php } else{ ?>
<table class="frequency_table">
<tr>
	<td></td>
	<td class="frequency_header">JAN</td>
	<td class="frequency_header alt">FEB</td>
	<td class="frequency_header">MAR</td>
	<td class="frequency_header alt">APR</td>
	<td class="frequency_header">MAY</td>
	<td class="frequency_header alt">JUN</td>
	<td class="frequency_header">JUL</td>
	<td class="frequency_header alt">AUG</td>
	<td class="frequency_header">SEPT</td>
	<td class="frequency_header alt">OCT</td>
	<td class="frequency_header">NOV</td>
	<td class="frequency_header alt">DEC</td>
</tr>
<tr>
	<td class="frequency_type"><i>Legacy</i></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_legacy[]', 'JAN', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_legacy[]', 'FEB', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_legacy[]', 'MAR', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_legacy[]', 'APR', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_legacy[]', 'MAY', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_legacy[]', 'JUN', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_legacy[]', 'JUL', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_legacy[]', 'AUG', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_legacy[]', 'SEP', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_legacy[]', 'OCT', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_legacy[]', 'NOV', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_legacy[]', 'DEC', 0); ?></td>
</tr>
<tr>
	<td class="frequency_type">Annual</td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_annual[]', 'JAN', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_annual[]', 'FEB', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_annual[]', 'MAR', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_annual[]', 'APR', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_annual[]', 'MAY', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_annual[]', 'JUN', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_annual[]', 'JUL', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_annual[]', 'AUG', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_annual[]', 'SEP', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_annual[]', 'OCT', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_annual[]', 'NOV', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_annual[]', 'DEC', 0); ?></td>
</tr>
<tr>
	<td class="frequency_type">Semi</td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_semi[]', 'JAN', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_semi[]', 'FEB', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_semi[]', 'MAR', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_semi[]', 'APR', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_semi[]', 'MAY', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_semi[]', 'JUN', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_semi[]', 'JUL', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_semi[]', 'AUG', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_semi[]', 'SEP', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_semi[]', 'OCT', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_semi[]', 'NOV', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_semi[]', 'DEC', 0); ?></td>
</tr>
<tr>
	<td class="frequency_type">Quarterly</td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_quarterly[]', 'JAN', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_quarterly[]', 'FEB', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_quarterly[]', 'MAR', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_quarterly[]', 'APR', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_quarterly[]', 'MAY', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_quarterly[]', 'JUN', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_quarterly[]', 'JUL', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_quarterly[]', 'AUG', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_quarterly[]', 'SEP', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_quarterly[]', 'OCT', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_quarterly[]', 'NOV', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_quarterly[]', 'DEC', 0); ?></td>
</tr>
<tr>
	<td class="frequency_type">Sterilizer</td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_sterilizer[]', 'JAN', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_sterilizer[]', 'FEB', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_sterilizer[]', 'MAR', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_sterilizer[]', 'APR', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_sterilizer[]', 'MAY', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_sterilizer[]', 'JUN', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_sterilizer[]', 'JUL', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_sterilizer[]', 'AUG', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_sterilizer[]', 'SEP', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_sterilizer[]', 'OCT', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_sterilizer[]', 'NOV', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_sterilizer[]', 'DEC', 0); ?></td>
</tr>
<tr>
	<td class="frequency_type">Trace gas</td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_tg[]', 'JAN', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_tg[]', 'FEB', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_tg[]', 'MAR', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_tg[]', 'APR', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_tg[]', 'MAY', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_tg[]', 'JUN', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_tg[]', 'JUL', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_tg[]', 'AUG', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_tg[]', 'SEP', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_tg[]', 'OCT', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_tg[]', 'NOV', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_tg[]', 'DEC', 0); ?></td>
</tr>
<tr>
	<td class="frequency_type">ERT</td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_ert[]', 'JAN', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_ert[]', 'FEB', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_ert[]', 'MAR', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_ert[]', 'APR', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_ert[]', 'MAY', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_ert[]', 'JUN', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_ert[]', 'JUL', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_ert[]', 'AUG', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_ert[]', 'SEP', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_ert[]', 'OCT', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_ert[]', 'NOV', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_ert[]', 'DEC', 0); ?></td>
</tr>
<tr>
	<td class="frequency_type">Room air exchange</td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_rae[]', 'JAN', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_rae[]', 'FEB', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_rae[]', 'MAR', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_rae[]', 'APR', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_rae[]', 'MAY', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_rae[]', 'JUN', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_rae[]', 'JUL', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_rae[]', 'AUG', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_rae[]', 'SEP', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_rae[]', 'OCT', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_rae[]', 'NOV', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_rae[]', 'DEC', 0); ?></td>
</tr>
<tr>
	<td class="frequency_type">Medgas</td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_medgas[]', 'JAN', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_medgas[]', 'FEB', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_medgas[]', 'MAR', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_medgas[]', 'APR', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_medgas[]', 'MAY', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_medgas[]', 'JUN', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_medgas[]', 'JUL', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_medgas[]', 'AUG', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_medgas[]', 'SEP', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_medgas[]', 'OCT', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_medgas[]', 'NOV', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_medgas[]', 'DEC', 0); ?></td>
</tr>
<tr>
	<td class="frequency_type">Imaging</td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_imaging[]', 'JAN', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_imaging[]', 'FEB', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_imaging[]', 'MAR', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_imaging[]', 'APR', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_imaging[]', 'MAY', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_imaging[]', 'JUN', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_imaging[]', 'JUL', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_imaging[]', 'AUG', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_imaging[]', 'SEP', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_imaging[]', 'OCT', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_imaging[]', 'NOV', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_imaging[]', 'DEC', 0); ?></td>
</tr>
<tr>
	<td class="frequency_type">Neptune</td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_neptune[]', 'JAN', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_neptune[]', 'FEB', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_neptune[]', 'MAR', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_neptune[]', 'APR', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_neptune[]', 'MAY', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_neptune[]', 'JUN', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_neptune[]', 'JUL', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_neptune[]', 'AUG', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_neptune[]', 'SEP', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_neptune[]', 'OCT', 0); ?></td>
	<td class="frequency_item"><?php echo checkbox_tag('frequency_neptune[]', 'NOV', 0); ?></td>
	<td class="frequency_item alt"><?php echo checkbox_tag('frequency_neptune[]', 'DEC', 0); ?></td>
</tr>
<tr>
        <td class="frequency_type">Anesthesia</td>
        <td class="frequency_item"><?php echo checkbox_tag('frequency_anesthesia[]', 'JAN', 0); ?></td>
        <td class="frequency_item alt"><?php echo checkbox_tag('frequency_anesthesia[]', 'FEB', 0); ?></td>
        <td class="frequency_item"><?php echo checkbox_tag('frequency_anesthesia[]', 'MAR', 0); ?></td>
        <td class="frequency_item alt"><?php echo checkbox_tag('frequency_anesthesia[]', 'APR', 0); ?></td>
        <td class="frequency_item"><?php echo checkbox_tag('frequency_anesthesia[]', 'MAY', 0); ?></td>
        <td class="frequency_item alt"><?php echo checkbox_tag('frequency_anesthesia[]', 'JUN', 0); ?></td>
        <td class="frequency_item"><?php echo checkbox_tag('frequency_anesthesia[]', 'JUL', 0); ?></td>
        <td class="frequency_item alt"><?php echo checkbox_tag('frequency_anesthesia[]', 'AUG', 0); ?></td>
        <td class="frequency_item"><?php echo checkbox_tag('frequency_anesthesia[]', 'SEP', 0); ?></td>
        <td class="frequency_item alt"><?php echo checkbox_tag('frequency_anesthesia[]', 'OCT', 0); ?></td>
        <td class="frequency_item"><?php echo checkbox_tag('frequency_anesthesia[]', 'NOV', 0); ?></td>
        <td class="frequency_item alt"><?php echo checkbox_tag('frequency_anesthesia[]', 'DEC', 0); ?></td>
</tr>

</table>
		<?php } ?>
	</td>
</tr>

<tr>
	<td></td>
	<td><?php echo submit_tag('Save'); 
    ?>
    <span id='dom_input'>
    <?php
	if($isAdmin && $freqLocked){
	        ?>
	         <input type='button' value='Unlock Freq' id = 'approveFreqButt' onclick='unlockFreq()'>
	        <?php  
    }  
	if($displayFreqApprove && !$freqLocked){
	        ?>
	         <input type='button' value='Approve Freq.' id = 'approveFreqButt' onclick='approveFrequency()'>
	        <?php  
    } ?>

    </span>
	<?php 
	 if($isAdmin)
	 		print link_to($unapproveLinkText, 'clientManager/UnapproveFreq', array('target'=>'_blank'));
	 ?>
	</td>
</tr>
</table>

</form>
	<div id="clientOptions">
		<?php
			if($mode == 'edit')
			{
				// Delete Button
				echo form_tag('clientManager/deleteClient',array('onSubmit'=>'return checkClientDelete()'));
                                ?>
                                <!-- <input type='button' value='Move' onclick='sureBmove()'/> -->
                                <?php
				echo input_hidden_tag('delete_client', $populateClient->getId());
				echo submit_tag('Delete'); 
				?>
                                 
                                </form>
                                <?php
				// New client Button (refresh form)
				echo form_tag('clientManager/index');
				echo submit_tag('New Client');
			}	?>
		</form>
               <div style='clear:both; display: NONE' id='moveDeviceCont'>
<div class="clientHeader">
		<h2>Move Device</h2>
	</div>
                   <div id='move_stats' style='color:red;display:none' >&nbsp;&nbsp;Device Not Found</div>

                    <table>
                    <tr><td>Client Name</td><td>
                    <?php echo select_tag('move_client_id', options_for_select($clients, $client_id,'include_custom=Please Select a Client'), array('onFocus' => "this.enteredText='';", 'onkeydown' => "return handleKey();", 'onkeyup' => "event.cancelbubble=true;return false;", 'onkeypress' => "return selectItem();") );?>
                    </td>
                    </tr>
                    <tr><td>Device Id</td><td><input type='input' id = 'm_device_id' name='m_device_id' /></td></tr>
                    <tr><td></td><td><input type='button' name='m_device_submit' value='Cancel' onclick='sureBmoveHide()'/><input value='Submit' onclick='moveDevice()' type='button' name='m_device_submit' /></td></tr>
                    </table>
               </div>
	</div>

<?php
if($mode == 'edit')
{	?>
	<div class="clientHeader">
		<h2>Past Workorder(s)</h2>
	</div>
	<table class="oldWorkorders">
		<?php
			foreach ($oldWork as $oldW)
			{
				$extraText = ($oldW->getJobStatus()->getStatusName() == 'Scheduled') ? ' for '.$oldW->getJobDate() : '';
				echo '<tr><td>'.$oldW->getJobScheduledDate().'</td><td><b>'.$oldW->getJobStatus()->getStatusName()."</b> $extraText </td>";
				if ($oldW->getJobStatus()->getStatusName() == 'Scheduled'){
					echo ' <td>  <a href="/index.php/scheduler/index/mode/edit/ticket/' .$oldW->getId().'" >Edit</a></td></tr>';
				}
				if ($oldW->getJobStatus()->getStatusName() == 'Unscheduled'){
					echo '<td><a href="/index.php/scheduler/index/mode/edit/ticket/' .$oldW->getId().'" >Schedule</a></td></tr>';
				}
			}
		?>
	</table>
	
	<div class="clientHeader">
		<h2>Upcoming Workorder(s)</h2>
	</div>
	<table class="upWorkorders">
		<?php
		
			foreach ($upcomingWork as $upW)
			{
				if($upW->getJobStatus()!= null){
					$extraText = ($upW->getJobStatus()->getStatusName() == 'Scheduled') ? ' for '.$upW->getJobDate() : '';
					echo '<tr><td>'.$upW->getJobScheduledDate().'</td><td><b>'.$upW->getJobStatus()->getStatusName()."</b> $extraText </td>";
					if ($upW->getJobStatus()->getStatusName() == 'Scheduled'){
						echo '<td><a href="/index.php/scheduler/index/mode/edit/ticket/' .$upW->getId().'" >Edit</a></td></tr>';
					}
					if ($upW->getJobStatus()->getStatusName() == 'Unscheduled'){
						echo '<td><a href="/index.php/scheduler/index/mode/edit/ticket/' .$upW->getId().'" >Schedule</a></td></tr>';
					}
				}
			}
		?>
	</table>
<?php
	}
?>
<!-- START REPORT-->
<div>
<!-- pdf reports -->
<div class="clientHeader"><h2>PDF Report(s)</h2></div>
<div style='margin-left: 10px' id='listedReport'>
<?php include_partial('deviceReport', array('finalReport' => $finalReport));  ?>
</div>
</div>

<!-- END REPORT-->
</div>


<?php if ($mode == 'edit')
{ ?>
	<div class="clientDevice"> 
		<?php  
		$deviceid_sort = ($sf_request->getParameter('didsort') == 'asc') ? 'dsc' : 'asc';
		$device_sort = ($sf_request->getParameter('dsort') == 'asc') ? 'dsc' : 'asc';
		$man_sort = ($sf_request->getParameter('msort') == 'asc') ? 'dsc' : 'asc';
		$mod_sort = ($sf_request->getParameter('modsort') == 'asc') ? 'dsc' : 'asc';
		$s_sort = ($sf_request->getParameter('ssort') == 'asc') ? 'dsc' : 'asc';
		
	 
		echo form_tag('clientManager/addDevice?mode=edit&id='.$populateClient->getId()); ?>
	<table><tr>
		<td class='deviceId'><b><u><?php // ?didsort=$device_sort&mode=edit&id=".$populateClient->getId()
		echo link_to("Device ID","/clientManager/index/?mode=edit&id=".$populateClient->getId()."&didsort=$deviceid_sort"); ?></u></b></td>
		<td><b><u><?php  echo link_to("Device","/clientManager/index/?mode=edit&id=".$populateClient->getId()."&dsort=$device_sort"); ?></u></b></td>
		<td><b><u><?php  echo link_to("Manufacturer","/clientManager/index/?mode=edit&id=".$populateClient->getId()."&msort=$man_sort"); ?></u></b></td>
		<td><b><u><?php  echo link_to("Model #","/clientManager/index/?mode=edit&id=".$populateClient->getId()."&modsort=$mod_sort"); ?></u></b></td>
		<td><b><u><?php  echo link_to("Serial #","/clientManager/index/?mode=edit&id=".$populateClient->getId()."&ssort=$s_sort"); ?></u></b></td>
		<td><b><u>Loc.</u></b></td>
		<td><b><u>Status</u></b></td>
		<td><b><u>Last Pm</u></b></td> 
	</tr><tr>
	<?php	
                $count = 1;
		foreach ($populateDevice as $device)
		{ 
            
            if($device->getSpecification() != NULL){
     		$devicesIdOnPage[] = $device->getDevice()->getId();
?>
			<td>
 
				<?php   
				$selectedStyle='';
				if($foundDeviceId==$device->getDevice()->getIdentification()) $selectedStyle = "background-color:yellow";
				echo input_tag('device_update['.$device->getDevice()->getId().'][identification]',  $device->getDevice()->getIdentification(), array('size'=>'13','style'=>$selectedStyle)); 
				echo input_hidden_tag('device_update['.$device->getDevice()->getId().'][specification_id]',$device->getSpecification()->getId()); ?>
			</td>
 			<td><?php echo input_tag('device_update['.$device->getDevice()->getId().'][device_name]', $device->getSpecification()->getDeviceName(),array('size'=>'13','style'=>$selectedStyle)); ?></td>  
			<td><?php echo input_tag('device_update['.$device->getDevice()->getId().'][manufacturer]', $device->getSpecification()->getManufacturer(),array('size'=>'13','style'=>$selectedStyle)); ?></td>
			<td><?php echo input_tag('device_update['.$device->getDevice()->getId().'][model_number]', $device->getSpecification()->getModelNumber(), array('size'=>'13','style'=>$selectedStyle)); //$device->getModelNumber()); ?></td>
			<td><?php echo input_tag('device_update['.$device->getDevice()->getId().'][serial_number]', $device->getDevice()->getSerialNumber(), array('size'=>'13','style'=>$selectedStyle)); ?></td>
			<td><?php echo input_tag('device_update['.$device->getDevice()->getId().'][location]', $device->getDevice()->getLocation(),array('size'=>'8','style'=>$selectedStyle)); ?></td>
			<td><?php 
$dev_status = strtolower($device->getDevice()->getStatus());
$dev_status = empty($dev_status) ? 'missing' : $dev_status;

$statusColor = '';
if($dev_status == 'missing')
    $statusColor = 'background-color: yellow';
elseif($dev_status == 'pass')
    $statusColor = 'background-color: green';
elseif($dev_status == 'fail')
    $statusColor = 'background-color: red';
elseif($dev_status == 'retired')
    $statusColor = 'background-color: orange';

echo select_tag('device_update['.$device->getDevice()->getId().'][status]', options_for_select(array(
				''			=>	'Please Select...',
				'pass'	=>	'Pass',
				'fail'	=>	'Fail',
				'missing'	=>	'Missing',
				'quote'	=>	'Quote',
				'pending repair'	=>	'Pending Repair',
				'pm scheduled'	=>	'PM Scheduled',
				'retired'	=>	'Retired'), $dev_status   ), array('style'=>$statusColor)); ?></td>
<td><input type='text' value='<?php print $device->getLastPmDate(); ?>' size="10" style='<?php print $selectedStyle; ?>'></td>
			<td><?php echo button_to('Delete', 'clientManager/deleteDevice?id='.$device->getDevice()->getId(), array('confirm' => 'Are you sure you want to delete this device?')); ?></td>
	</tr>
	<tr> 
		<?php
}//if
         } //foreach ?>
	<td><?php echo input_tag('new_device_ident','', 'size=12'); ?></td>
	<td><?php echo input_tag('new_device_name', '','size=13'); ?></td>
	<td><?php echo input_tag('new_manufacturer', '','size=13'); ?></td>
	<td><?php echo input_tag('new_model_number','', 'size=8'); ?></td>
	<td><?php echo input_tag('new_serial_number', '','size=8'); ?></td>
	<td><?php echo input_tag('new_location', '', 'size=8'); ?></td>
	<td><?php echo select_tag('new_status', options_for_select(array(
					''			=>	'Please Select...',
				'pass'	=>	'Pass',
				'fail'	=>	'Fail',
				'missing'	=>	'Missing',
				'quote'	=>	'Quote',
				'pending_repair'	=>	'Pending Repair',
				'pm_scheduled'	=>	'PM Scheduled',
					'retired'	=>	'Retired'))); ?></td>
<td><input type='text' value='' size='10'></td>
	<td></td>
</tr></table>
<?php echo submit_tag('Save');  

$allIdsOnPage = implode(',',$devicesIdOnPage);
 ?>

</form>
<input type='hidden' id = 'allIdsOnPage' value="<?php print $allIdsOnPage; ?>" />
</div>
<?php } ?>

<div id="blah">
<?php echo $reportData ?>
</div>
