function save_partial_match(id){

        var date = $('date_'+id).value;
	var pass_fail = $('pass_fail_'+id).value;
	var device_id = $('device_id_'+id).value;
	var device_name = $('device_name_'+id).value;
	var manufacturer = $('manufacturer_'+id).value;
	var model = $('model_'+id).value;
	var serial = $('serial_'+id).value;
 	var extra_data = $('extra_data_'+id).value;
	var test_data = $('test_data_'+id).value;
        var filename = $('filename').value;
	var location = $('location_'+id).value;
	var comments = $('comments_'+id).value;
        var assoc_client = $('new_client_partial_'+id).value;
	

        new Ajax.Updater(
        'test',
        '/index.php/process/savePartialMatch?date='+date+'&pass_fail='+pass_fail+'&date'+date+'&device_id='+device_id+'&device_name='+device_name+'&manufacturer='+manufacturer+'&model='+model+'&serial='+ serial+'&filename='+filename+'&location='+location+'&comments='+comments+'&assoc_client='+assoc_client,
         {
		method: 'post',
		parameters: 'extra_data='+extra_data+'&test_data='+test_data,
                evalScripts: true,
                asynchronous: false,
                onSuccess: function(){
			$('device_id_'+id).disabled = true;
			$('device_name_'+id).disabled = true;
			$('manufacturer_'+id).disabled = true;
			$('model_'+id).disabled = true;
			$('serial_'+id).disabled = true;
			$('input_'+id).disabled = true;
                }
         }
	);
}
function optionChanged(id){

 
	var thisSelectedIndex = $('option_'+id).selectedIndex;
        var thisSelectedValue = $('option_'+id).options[thisSelectedIndex].value;	

	//trying to associate device to a client
        if(thisSelectedValue == 2){
		var selectedIndex = $('client_'+id).selectedIndex;
        	var selectedValue = $('client_'+id).options[selectedIndex].value;
		//make sure a client is selected first. if not alert and don't continue
		if(selectedValue == -1)
		{
			$('option_'+id).selectedIndex = 0;
			alert('Please select a client first');
			return;
		}	
	}else{
		//going back to original of just adding a new device
		restoreFields(id)
	  	$('device_id_'+id).show();
                $('get_devices_'+id).hide();
		$('device_id_option_'+id).selectedIndex = 0;
		$('device_id_option_'+id).disabled = true;
                return;
	}
       
	//if we are at this point client is select and associateToClient is selected

	//enable so client may use id from file
	$('device_id_option_'+id).disabled = false;

        new Ajax.Updater(
	 'get_devices_'+id,
        '/index.php/process/getDevices?&client_id='+selectedValue,
         {
		method: 'get',
                evalScripts: true,
                asynchronous: false,
                onSuccess: function(){
                        $('device_id_'+id).hide();
                        $('get_devices_'+id).show();
                }
         }
	);
}
function updateDevices(id){
       var thisSelectedIndex = $('option_'+id).selectedIndex;
       var thisSelectedValue = $('option_'+id).options[thisSelectedIndex].value;	
	
	if(thisSelectedValue == 1)
		return;
        

	var selectedIndex = $('client_'+id).selectedIndex;
        var selectedValue = $('client_'+id).options[selectedIndex].value;
	if(selectedValue == -1)
	{
		$('option_'+id).selectedIndex = 0;
  		$('device_id_'+id).show();
                $('get_devices_'+id).hide();
		return;
	}	
	
        
        	
        new Ajax.Updater(
        'get_devices_'+id,
        '/index.php/process/getDevices?client_id='+selectedValue,
         {
		method: 'get',
                evalScripts: true,
                asynchronous: false,
                onSuccess: function(){
                        $('device_id_'+id).hide();
                        $('get_devices_'+id).show();
                }
         }
	);
}
function save_no_match(id){
	var selectedIndex = $('client_'+id).selectedIndex;
        var selectedValue = $('client_'+id).options[selectedIndex].value;
	if(selectedValue == -1)
	{
		alert('Please select a client first');
		return false;
	}


	var optionSelectedIndex = $('option_'+id).selectedIndex;
        var optionSelectedValue = $('option_'+id).options[optionSelectedIndex].value;
	
	var getdeviceSelectedIndex = $('get_devices_'+id).selectedIndex;
        if(getdeviceSelectedIndex >= 0)
        	var getdeviceSelectedValue = $('get_devices_'+id).options[getdeviceSelectedIndex].value;
        else
            getdeviceSelectedValue == -1;
 
      
	if(optionSelectedValue == 2 && getdeviceSelectedValue == -1){
		alert("No Device Exists for Association");
		return;	
	}else if(optionSelectedValue == 2 && getdeviceSelectedValue == -2){
		alert("Please Select a Device for Association");
		return;	
        }

        var date = $('date_'+id).value;
	var pass_fail = $('pass_fail_'+id).value;
	var client_id = $('client_'+id).value;
	var option = $('option_'+id).value;
        var get_devices = $('get_devices_'+id).value;
	var device_id = $('device_id_'+id).value;
	var device_name = $('device_name_'+id).value;
	var manufacturer = $('manufacturer_'+id).value;
	var model = $('model_'+id).value;
	var serial = $('serial_'+id).value;
	var extra_data = $('extra_data_'+id).value;
	var test_data = $('test_data_'+id).value;
        var filename = $('filename').value;
	var existingId = $('device_id_option_'+id).value;
	var location = $('location_'+id).value;
	var comments = $('comments_'+id).value;

	new Ajax.Updater(
        'test',
        '/index.php/process/saveNoMatch?get_devices='+get_devices+'&date='+date+'&pass_fail='+pass_fail+'&option='+option+'&client_id='+client_id+'&device_id='+device_id+'&device_name='+device_name+'&manufacturer='+manufacturer+'&model='+model+'&serial='+ serial+'&filename='+filename+'&existingId='+existingId+'&location='+location+'&comments='+comments,
         {
		method: 'post',
		parameters: 'extra_data='+extra_data+'&test_data='+test_data,
                evalScripts: true,
                asynchronous: false,
                onSuccess: function(){
                        $('client_'+id).disabled = true;
                        $('get_devices_'+id).disabled = true;
                        $('option_'+id).disabled = true;
			$('device_id_'+id).disabled = true;
			$('device_name_'+id).disabled = true;
			$('manufacturer_'+id).disabled = true;
			$('model_'+id).disabled = true;
			$('serial_'+id).disabled = true;
			$('input_'+id).disabled = true;
			$('device_id_option_'+id).disabled = true;
                }
         }
	);

}
function device_id_changed(id){

    
	
       var h_device_name =  $('hidden_device_name_'+id).value;
       var h_manufacturer = $('hidden_manufacturer_'+id).value;
       var h_model = $('hidden_model_'+id).value;
       var h_serial = $('hidden_serial_'+id).value;


	var getdeviceSelectedIndex = $('get_devices_'+id).selectedIndex;
        var getdeviceSelectedValue = $('get_devices_'+id).options[getdeviceSelectedIndex].value;

 

	  new Ajax.Request(
           //  'test',
             '/index.php/process/deviceIdChanged?existing_device_id='+getdeviceSelectedValue+'&dn='+h_device_name+'&man='+h_manufacturer+'&mod='+h_model+'&ser='+h_serial,
             {
		method: 'get',
                evalScripts: true,
                asynchronous: false,
                onSuccess: function(transport){ 
		   d_response = transport.responseText;

  		   var json = eval('('+d_response+')');  

    	       	   var device_name = json.device_name;
		   var manufacturer = json.manufacturer;
                   var model = json.model;
                   var serial = json.serial; 
                   
		   $('device_name_'+id).innerHTML = json.device_name;
		   $('manufacturer_'+id).innerHTML = json.manufacturer;
		   $('model_'+id).innerHTML = json.model;
	           $('serial_'+id).innerHTML = json.serial;     
                }
              }
	   );
}
function restoreFields(id){
	  var h_device_name =  $('hidden_device_name_'+id).value;
          var h_manufacturer = $('hidden_manufacturer_'+id).value;
          var h_model = $('hidden_model_'+id).value;
          var h_serial = $('hidden_serial_'+id).value;

	   dn_option = "<option value='"+h_device_name+"'>"+h_device_name+"</option";
	   dn_man = "<option value='"+h_manufacturer+"'>"+h_manufacturer+"</option";
 	   dn_mod = "<option value='"+h_model+"'>"+h_model+"</option";
           dn_ser = "<option value='"+h_serial+"'>"+h_serial+"</option";
	   
           $('device_name_'+id).innerHTML = dn_option;
	   $('manufacturer_'+id).innerHTML = dn_man;
	   $('model_'+id).innerHTML = dn_mod;
	   $('serial_'+id).innerHTML = dn_ser;     
}
function generateReport(){ 
	var client_id= $('client').value;
alert(client_id);
	var selected = new Array(); 
	var ob = $('multi_date');
	for (var i = 0; i < ob.options.length; i++) 
		if (ob.options[ i ].selected) {
			selected.push(ob.options[ i ].value); 
	}//for
	var date_str = '';
	for(var i = 0; i< selected.length; i++){
		date_str += selected[i];
		if(i != selected.length - 1) date_str += '||';
	} 
	alert('client_id='+client_id+'&date='+date_str);
}
function gotounprocessed(){
	var selectedIndex = $('processedFile').selectedIndex;
        var selectedValue = $('processedFile').options[selectedIndex].value;
	if(selectedValue == '-1') return;
	document.location= '/index.php/unprocessed/index/fn/'+selectedValue;
}

function process_client_change(){
	var selectedIndex = $('current_client').selectedIndex;
        var selectedValue = $('current_client').options[selectedIndex].value;
 
	new Ajax.Updater(
           'listedDevices',
             '/index.php/process/listDevices?client_id='+selectedValue,
             {
		method: 'get',
                evalScripts: true,
                asynchronous: false,
                onSuccess: function(transport){ 
		       
                }
              }
	   );

	new Ajax.Updater(
           'listedReport',
             '/index.php/process/getReports?client_id='+selectedValue,
             {
		method: 'get',
                evalScripts: true,
                asynchronous: false,
                onSuccess: function(transport){ 
		       
                }
              }
	   );
}

function quoted(){
	
	var listedDevices = $('hidden_device_id').value; //comma seperated string of ids
	var checkedItems = new Array();
	listedDevicesArr = listedDevices.split(',');
	checkItemCount = 0;
	for(var i=0; i < listedDevicesArr.length; i++){
		if($('checkbox_'+listedDevicesArr[i]).checked){
			checkedItems[checkItemCount] = listedDevicesArr[i];
			checkItemCount++;
		}
	}
	var checkedItemString = checkedItems.join(',');

	var selectedIndex = $('current_client').selectedIndex;
        var selectedValue = $('current_client').options[selectedIndex].value;
  
	new Ajax.Updater(
           'listedDevices',
             '/index.php/process/quotes?client_id='+selectedValue+'&checkedItems='+checkedItemString,
             {
		method: 'get',
                evalScripts: true,
                asynchronous: false,
                onSuccess: function(transport){ 
		       
                }
              }
	   );
}

function pendingRepair(){

	var listedDevices = $('hidden_device_id').value; //comma seperated string of ids
	var checkedItems = new Array();
	listedDevicesArr = listedDevices.split(',');
	checkItemCount = 0;
	for(var i=0; i < listedDevicesArr.length; i++){
		if($('checkbox_'+listedDevicesArr[i]).checked){
			checkedItems[checkItemCount] = listedDevicesArr[i];
			checkItemCount++;
		}
	}
	var checkedItemString = checkedItems.join(',');

	var selectedIndex = $('current_client').selectedIndex;
        var selectedValue = $('current_client').options[selectedIndex].value;
 
	new Ajax.Updater(
           'listedDevices',
             '/index.php/process/pendingRepair?client_id='+selectedValue+'&checkedItems='+checkedItemString,
             {
		method: 'get',
                evalScripts: true,
                asynchronous: false,
                onSuccess: function(transport){ 
		       
                }
              }
	   );
}

function generateReport(){
	var selectedIndex = $('current_client').selectedIndex;
        var selectedValue = $('current_client').options[selectedIndex].value;
 
	var contact = $('theContact').value;
	new Ajax.Updater(
           'listedReport',
             '/index.php/process/generateReport?client_id='+selectedValue+'&contact='+contact,
             {
		method: 'get',
                evalScripts: true,
                asynchronous: false,
                onSuccess: function(transport){ 
		       
                }
              }
	   );
}
function deleteReport(id, client_id){

	var sure = confirm('Are you sure you want to delete this report?');
	if(!sure){
		return;	
	}
	new Ajax.Updater(
           'listedReport',
             '/index.php/process/deleteReport?id='+id+'&client_id='+client_id,
             {
		method: 'get',
                evalScripts: true,
                asynchronous: false,
                onSuccess: function(transport){ 
		       
                }
              }
	   );
}
function save_comments(el,id){
	
	new Ajax.Request(
             '/index.php/process/saveComments?device_id='+id+'&comments='+el.value,
             {
		method: 'get',
                evalScripts: true,
                asynchronous: false,
                onSuccess: function(transport){ 
		       
                }
              }
	   ); 
}
function scheduleRepair(id){
	
	var listedDevices = $('hidden_device_id').value; //comma seperated string of ids
	var checkedItems = new Array();
	listedDevicesArr = listedDevices.split(',');
	checkItemCount = 0;

	for(var i=0; i < listedDevicesArr.length; i++){
		if($('checkbox_'+listedDevicesArr[i]).checked){
			checkedItems[checkItemCount] = listedDevicesArr[i];
			checkItemCount++;
		}
	}
	
	var checkedItemString = checkedItems.join(',');
	if(checkItemCount < 1){
		alert('Please Select a Device First');
		return;	
	}

	document.location='/index.php/scheduler/index/rrpage/yes/client_select/'+id+'/checkeditems/'+checkedItemString;
}
function rescheduleMissing(id){

	
	var listedDevices = $('hidden_device_id').value; //comma seperated string of ids
	var checkedItems = new Array();
	listedDevicesArr = listedDevices.split(',');
	checkItemCount = 0;

	for(var i=0; i < listedDevicesArr.length; i++){
		if($('checkbox_'+listedDevicesArr[i]).checked){
			checkedItems[checkItemCount] = listedDevicesArr[i];
			checkItemCount++;
		}
	}
	var checkedItemString = checkedItems.join(',');
	var checkedItemString = checkedItems.join(',');
	//if(checkItemCount < 1){
	//	alert('Please Select a Device First');
	//	return;	
	//}

	document.location='/index.php/scheduler/index/ppage/yes/client_select/'+id+'/checkeditems/'+checkedItemString;
}

function toggle_matched(){
	if($('toggle_matched_but').innerHTML == 'Show'){

		$('toggle_matched_but').innerHTML = 'Hide';
		$('matched_cont').show();

	}
	else{
		$('toggle_matched_but').innerHTML = 'Show';
		$('matched_cont').hide();
	}
	
}
function insertContact(contact){
	$('theContact').value = contact;
}
function saveFullMatchUpdate(device_id,random_id){
        var client_id = $('new_client_match_'+random_id).value;

	new Ajax.Request(
             '/index.php/process/updateFullMatch?device_id='+device_id+'&client_id='+client_id,
             {
		method: 'get',
                evalScripts: true,
                asynchronous: false,
                onSuccess: function(transport){ 
		        $('new_client_match_'+random_id).disabled = true;
			$('device_id_match_'+random_id).disabled = true;
			$('device_name_match_'+random_id).disabled = true;
			$('manufacturer_match_'+random_id).disabled = true;
			$('model_match_'+random_id).disabled = true;
			$('serial_match_'+random_id).disabled = true;
                }
              }
	   ); 
}
