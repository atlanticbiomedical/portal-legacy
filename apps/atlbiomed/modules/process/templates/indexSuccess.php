<div class='regularCont'>
<div class='titleBar'>New File Upload</div>
<div class='innerCont'>
<form name='uploadForm' id='uploadForm' action='process/processUpload' method='post' enctype='multipart/form-data'>
<input type='file' name='upload'>
<input type='submit' name='submit' value='Upload'>
<input type='button' name='unprocessed' value='View Unprocessed' onclick="document.location='/index.php/unprocessed/index'">
</form>

</div>
</div>

<iframe name='iframe' id='iframe' width="0" height="0" border="0" style='visibility:hidden'>
</iframe>

<div class='regularCont'>
<div class='titleBar'>Reporting</div>
<div class='innerCont'>
<table style='margin: 4px;float:left'>
<tr><td>Client</td></tr>
<tr>
<td>
<?php echo select_tag('client', options_for_select($clients, $client_id,'include_custom=Please Select a Client'), array('id'=>'current_client','onchange'=>'process_client_change()') );?> 
</td>
</tr>
<tr><td>Contact</td></tr>
<tr>
<td>
<input type='text' value='' id='theContact'>
</td>
</tr>
</table>
<table  style='float:left; margin-left:20px;'>
<tr><td> <div id='listedReport'></div>
</td></tr></table>
<div style='clear:both'></div>
</div>
</div>



<div id='listedDevices'>
</div>

