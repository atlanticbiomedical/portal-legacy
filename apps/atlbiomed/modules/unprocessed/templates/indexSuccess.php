<?php
 
	if($sf_params->get('warning')=='yes'){
	?>
	<div class='alreadyExist'>
	This file has already been uploaded. Please select from the list of unprocessed files below.
	</div>
<?php
	}
?>


<div class='regularCont'>
<div class='titleBar'>Unprocessed Files</div>
<div class='innerCont'>
File Name
<select onchange='gotounprocessed()' id='processedFile'>
<option value='-1'  >Please Select A File</option>
<?php

	foreach($filenamesList as $_filename){
		$selectedItem = ($sf_params->get('fn')==$_filename) ? "selected='selected'" : '';
        	print "<option value='$_filename' $selectedItem >$_filename</option>";
        }
?>
</select>
</div>
</div>

<?php
 

if(empty($filenamesList)){
?>
	<div class='alreadyExist'>
	No unprocessed files were found
	</div>
<?php
}
?>

<div style='font-size: 13px; width: 300px; border: 1px solid black; margin-top: 30px;'>
<div class='titleBar'>Uprocessed File</div>
<div style='padding: 5px;'>
<?php
print "<b>Filename</b>: ".$filename."<br/>";
print "<b>Total Records</b>: ".(count($match)+count($partialMatch)+count($noMatch))." <br/>";
print "<b>Matched</b>: ".count($match)."<br/>";
print "<b>Partial Match</b>: ".count($partialMatch)."<br/>";
print "<b>No Match</b>: ".count($noMatch)."<br/>";
?>
</div>
</div>
<input type='hidden' name='filename' id='filename' value='<?php echo $filename; ?>'/>
<div id='test'></div>
<?php
if(!empty($match))
	include_partial('process_match', array('match' => $match, 'clients'=>$clients)); 
if(!empty($partialMatch))
	include_partial('process_partial_match', array('partialMatch' => $partialMatch, 'clients'=>$clients)); 
if(!empty($noMatch))
	include_partial('process_no_match', array('noMatch' => $noMatch, 'clients'=>$clients)); 
?>
