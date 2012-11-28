<div style='font-size: 13px; width: 300px; border: 1px solid black; margin-top: 30px;'>
<div style='color: #fff; background-color:#08C46E ; font-weight: bold; text-align:center'> UPLOAD STATUS </div>
<div style='padding: 5px;'>
<?php 
print "<b>Filename</b>: ".$filename." <br/>";
print "<b>Total Uploaded</b>: ".(count($match)+count($partialMatch)+count($noMatch))." <br/>";
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
	include_partial('process_partial_match', array('partialMatch' => $partialMatch)); 
if(!empty($noMatch))
	include_partial('process_no_match', array('noMatch' => $noMatch, 'clients'=>$clients)); 
?>
