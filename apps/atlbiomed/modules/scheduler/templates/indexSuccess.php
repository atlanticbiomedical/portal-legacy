<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $google_api_key ?>" type="text/javascript" charset="utf-8"></script>

<script type='text/javascript'>
	String.prototype.trim = function() {
		return this.replace(/^\s+|\s+$/g,"");
	}
	//indicates whether we are editing a job from the client page with previously unscheduled tech
	cameFromClientPage = 'false';
	loadDefaultAddress = false;
	pagemode = '<?php echo $mode; ?>';
	workorderid = '<?php print $ticket; ?>';
</script>

<?php 
	use_helper('Object'); 
	use_helper('Javascript'); 
	echo javascript_include_tag('dropdown');
	

if($error == 'overlap' || $error == 'unavailable')	{
			
			$mode = $sf_user->getAttribute('mode');
			$client_select = $sf_user->getAttribute('client');
			$specification = $sf_user->getAttribute('specification_select');
			$device = $sf_user->getAttribute('device_select');
			$reason = $sf_user->getAttribute('reason_select');
			$status = $sf_user->getAttribute('status');
			$job_status = $sf_user->getAttribute('job_status');
			$job_date = $sf_user->getAttribute('date');
			$start_time = $sf_user->getAttribute('start_time');
			$end_time = $sf_user->getAttribute('end_time');
			$tech_id = $sf_user->getAttribute('technician');
			$stech_id = $sf_user->getAttribute('stech');
			$workorder_id = $sf_user->getAttribute('ticket');
			$edit_client = $sf_user->getAttribute('edit_client');
			$edit_workorder = $sf_user->getAttribute('workorder');
			$edit_workorder_tech = $sf_user->getAttribute('edit_workorder_tech'); //first tech
			$second_tech = $sf_user->getAttribute('second_tech'); //second tech
			$specification_options = $sf_user->getAttribute('device_list');
			$specification_select = $sf_user->getAttribute('specification_id');
			$device_select = $sf_user->getAttribute('selected_device_id');
			$reason_select = $sf_user->getAttribute("reason_select");
			$start_time_hours = $sf_user->getAttribute('start_time_hours');
			$start_time_minutes = $sf_user->getAttribute('start_time_minutes');
			$end_time_hours = $sf_user->getAttribute('end_time_hours');
			$end_time_minutes = $sf_user->getAttribute('end_time_minutes');
			$caller = $sf_user->getAttribute('caller');
			$notes = $sf_user->getAttribute('notes');
			$date = $sf_user->getAttribute('date');
			$is_all_week = $sf_user->getAttribute('is_all_week');
			
			
			
			
			
			try{
				if(method_exists($edit_workorder_tech,'getFirstName')){
					$tech_fname = $edit_workorder_tech->getFirstName();
					$tech_lname = $edit_workorder_tech->getLastName();
				}
			}catch(Exception $e){
				
			}
			try{
				if(method_exists($second_tech,'getFirstName')){
					$second_tech_fname  = $second_tech ->getFirstName();
					$second_tech_lname  = $second_tech ->getLastName();
					$second_tech_fun = "selectSTech($stech_id, \"$second_tech_fname\", \"$second_tech_lname\");";
				}
			}catch(Exception $e){
				
			}
			
			if(!empty($is_all_week) and $error){
				$all_week_fire =  "if($is_all_week == true){
	    		document.getElementById('allWeekTechCheckox').checked = true;
				document.getElementById('allWeekTechCheckox_hidden').value = '1';
				allweekTech($tech_id, \"$tech_fname\", \"$tech_lname\", $start_time_hours, $start_time_minutes, $end_time_hours, $end_time_minutes);
			}";
			
			}
   
		}
  

	
	switch($error)
	{
		case 'unavailable':
			echo javascript_tag("alert('You may not schedule a job before the technicians start time.');");
			$run_on_error = "populateDeviceMenu();$second_tech_fun selectTech($tech_id, \"$tech_fname\", \"$tech_lname\", $start_time_hours, $start_time_minutes)";
			break;
		case 'overlap':
			echo javascript_tag("alert('You may not schedule an overlapping job.');");
			$run_on_error = "populateDeviceMenu();$second_tech_fun selectTech($tech_id, \"$tech_fname\", \"$tech_lname\", $start_time_hours, $start_time_minutes)";
			break;	
	}
   echo javascript_tag("
   function addMarker(location,description , map,icon_image,who){

var icon = new GIcon(G_DEFAULT_ICON, '/images/pins/'+icon_image+'.png'); 

icon.iconSize = new GSize(32, 32);
if(who == 'client')
	icon.iconAnchor = new GPoint(16, 16);
else
	icon.iconAnchor = new GPoint(16, 32);
       
   		var marker = new GMarker(location, icon);
   			GEvent.addListener(marker,'click', function(){marker.openInfoWindowHtml(description)});
   			map.addOverlay(marker);
   			 
	}
   ");
   echo javascript_tag("
    function displayTechOnMap(map){
      
		try{

		var clientid = $('client_select').value;
		theSelectedDate = $('date').value;
    	new Ajax.Request(
    		'scheduler/populateMapWithJobs?clientid='+clientid+'&use_date='+theSelectedDate,
    		{
    		   method: 'get',
    	       onSuccess: function(transport){
    	       
    	       	    var response = transport.responseText;
    	       	   // alert(transport.responseText); //------------------------
    	       	    var json = eval('('+response+')');  
    	       	    var tech = json.info;
    	       	    var lastValidCord = null;
    	       	     
                     
    	       	    try{
    	       	        //the client info 
	    	       	    var clientInfo = json.client;
	    	       	   
                    
	    	       	   
	    	       	   
	    	       	    if(loadDefaultAddress || ((clientInfo.lat == null && clientInfo.lon!=null) || (clientInfo.lat == '' && clientInfo.lon == '')) ){
                            var clientLocation = new GLatLng(39.228231,-76.661482); //atlantic biomedical address
	    	       	    	var description = 'Atlantic Biomedical  <br/> 828 Oregon Avenue Linthicum Heights, MD 21090';
	    	       	    }
	    	       	    else if(clientInfo.lat != null && clientInfo.lon!=null && clientInfo.lat != '' && clientInfo.lon != ''){
	    	       	    	var clientLocation = new GLatLng(clientInfo.lat,clientInfo.lon);
	    	       	    	var description = clientInfo.clientname + ' <br/>'+clientInfo.clientaddress;
	    	       	    	
	    	       	    }  
	    	       	    if((clientInfo.lat != null && clientInfo.lon!=null) || (clientInfo.lat != '' && clientInfo.lon != ''))
	    	       	    	addMarker(clientLocation,description,map,clientInfo.icon,'client');
	    	       	 
    	       	    }catch(e){
    	       	    	alert('Client Date Error');
					}
					   
    	       	    // alert(clientLocation+'--'+description+'--'+map+'--'+clientInfo.icon+'--'+'client');
				   
    	       	    for(var i = 0; i < tech.length; i++){
    	       	    	
    	       	    	if(tech[i].lat != null && tech[i].lon!=null){
    	       	    	    var location = new GLatLng(tech[i].lat,tech[i].lon);
    	       	    	    lastValidCord = location;
    	       	    	   
	    	       	    	if(tech[i].hasjob == 1){
    	       	    	    	var description = 'Tech Name: ' + tech[i].name + '<br/> This Location: Job '+ tech[i].jobnumber +'<br/>Client Name:'+tech[i].clientname+'<br/>' + tech[i].address + '<br/>time: '+ tech[i].jobstart + ' - ' + tech[i].jobend;
							}
    	       	    	    else
    	       	    	        var description = 'Tech Name: ' + tech[i].name + '<br/>This Location: Home<br/>' + tech[i].address;
	    	       	    	
    	       	    	     
    	       	    	        addMarker(location,description,map,tech[i].icon,'tech');
    	       	    	        $('tech_id_'+tech[i].id).style.backgroundColor = tech[i].color;
                               $('techSchedule_color_'+tech[i].id).style.backgroundColor = tech[i].color;
    	       	    	        
    	       	    	}
    	       	    }   
                   
    	       	    map.setCenter(clientLocation,9);
    	 
    	       	    map.addControl(new GSmallMapControl());
    	            map.addControl(new GMapTypeControl());
    	            map.addControl(new GScaleControl());
    		   }
    	   }
    	);
    }catch(e)
    {
     alert('error');
    }
    }
    ");
	
	echo javascript_tag("

	Event.observe(window, 'load', initFunctions, false);

	function initFunctions(evt)
	{
	    if($('client_select').selectedIndex != null){
			if($('client_select').options[$('client_select').selectedIndex].text.trim() == ''){
				loadDefaultAddress = true;
			}else 
			   loadDefaultAddress = false;
   	   }
		 $run_on_error
		 $all_week_fire
		 showFlatCalendar();
		 initGoogleMap();
	}
	function initGoogleMap(){
	  if (GBrowserIsCompatible()) {
	        map = new GMap2(document.getElementById('scheduleGoogleMap'));
	        map.setCenter(new GLatLng(40.632574,-73.942791), 16);
	        displayTechOnMap(map);
	      }
	}
	Event.observe(window,'unload',unInitFunctions);
	function unInitFunctions(evt){
		GUnload();
	}
	
	");

	
	echo javascript_tag("
		function populateDeviceMenu()
		{
		
			var specification_select = document.getElementById('specification_select').value;\t\t\t"."
			var client_select = document.getElementById('client_select').value;\n\t\t\t

			if(specification_select == -1)
			{"."\t\t\t".
				update_element_function('device', array(
						'content' => 'Please Select a Device...'))."
			}
			if(specification_select == -2)
			{"."\t\t\t".
				update_element_function('device', array(
						'content' => 'All Devices Selected'))."
				document.getElementById('reason_select').value = 17;
				var allt = document.getElementById('all_time').value;
				if (allt != ''){document.getElementById('job_inc').value = allt;}

			} else if(specification_select == -1) {"."\t\t\t".
				update_element_function('device', array(
					'content' => 'No Device Selected'))."
			} else if(specification_select == -3) {"."\t\t\t".
				update_element_function('device', array(
					'content' => 'New Device Selected'))."
			} else if(specification_select == 0) {"."\t\t\t".
				update_element_function('device', array(
					'content' => 'Please Select a Device...'))."
			} else {"."\t\t\t\t".
				remote_function(array(
					'update' => 'device',
					'url' => 'scheduler/populateDevice',
					'with' => '"specification_select=" + specification_select + "&client_select=" + client_select')).";"."\t\t\t"."
				if(document.getElementById('reason_select').disabled == true)
				{
					document.getElementById('reason_select').disabled=false;
				}
			}				
		}


		function submitJob()
		{

            if($('reason_select').value == -1){
              alert('Please select reason before continuing');return;
            }

			var message_alert = '';
			var message_confirm = '';
			alert_fail = false;
			confirm_fail = false;

			var reason = document.getElementById('reason_select').value;
			var notes = document.getElementById('notes').value;

			try { var specification = document.getElementById('specification_select').value; } catch(e) { var specification; }
			try { var start_time_hours = document.getElementById('start_time_hours').value; } catch(e) { var start_time_hours; }
			try { var start_time_minutes = document.getElementById('start_time_minutes').value; } catch(e) { var start_time_minutes; }
			try { var end_time_hours = document.getElementById('end_time_hours').value; } catch(e) { var end_time_hours; }
			try { var end_time_minutes = document.getElementById('end_time_minutes').value; } catch(e) { var end_time_minutes; }

			if (document.getElementById('start_time_ampm_am').checked == true)
			{
				var start_time_ampm = 'am';
			} else {
				var start_time_ampm = 'pm';
			}

			if (document.getElementById('end_time_ampm_am').checked == true)
			{
				var end_time_ampm = 'am';
			} else {
				var end_time_ampm = 'pm';
			}

			switch(specification)
			{	
				case undefined:
				case -1:
					alert('Please select a client before continuing.');
					return;
					break;
				case -2:
					break;
				default:
					try { var device = document.getElementById('device_select').value; } catch(e) { var device; }
					if((device == undefined))
					{
						if(specification > -1)
						{
							alert('Please select a Device before continuing');
							return;
						}
					}
					if(device == -1)
					{
						alert('Please select a Device ID before continuing');
						return;
					}
					break;
			}
			
			if (document.getElementById('technician').value == '')
			{
				alert('You have not selected a technician!');
				return;
			}

			if((start_time_hours == '') || (start_time_minutes == ''))
			{
				if(document.getElementById('job_status').value != 'unscheduled')
				{
					if(confirm('You have not set a start time for this job. Would you like to submit this job as unscheduled?') == true)
					{
						document.getElementById('job_status').value = 'unscheduled';
					} else {
						return;
					}
				}
			} else {
				if ((start_time_hours > 12) || (start_time_hours < 1))
				{
					alert('Invalid starting hour. Please enter a valid starting hour.');
					return;
				}

				if((start_time_minutes > 59) || (start_time_minutes < 0))
				{
					alert('Invalid starting minutes. Please enter a valid start time.');
					return;
				}
				var start_time = convertTime(start_time_hours, start_time_minutes, start_time_ampm);
			}	

			if ((end_time_hours == '') || (end_time_minutes == ''))
			{
				if(document.getElementById('job_status').value != 'unscheduled')
				{
					if(confirm('You have not set an end time for this job. Would you like to submit without an end time?') == false)
					{
						return;
					}
				}
			} else {
				if ((end_time_hours > 12) || (end_time_hours < 1))
				{
					alert('Invalid ending hour. Please enter a valid ending hour.');
					return;
				}

				if((end_time_minutes > 59) || (end_time_minutes < 0))
				{
					alert('Invalid ending minutes. Please enter a valid end time.');
					return;
				}
		
				var end_time = convertTime(end_time_hours, end_time_minutes, end_time_ampm);
			}

			if (start_time > end_time)
			{
				alert('You have not entered a valid end time. You can not set a jobs end time before that of the start time');
				return;
			}


			document.getElementById('start_time').value = start_time;
			document.getElementById('end_time').value = end_time;
			
				
			techid = document.getElementById('technician').value;
			stechid = document.getElementById('stech').value;
			var mwf = $('mwf').value;
			var tt = $('tt').value;
			
			try{
			var client_id = $('client_select').options[$('client_select').selectedIndex].value;
			}catch(e){
				var client_id = $('client_edit').options[$('client_edit').selectedIndex].value;
			}
		      
			var pm_reason = $('reason_select').value;
			
           
           checked_day = $('checked_days_hidden').value;
           var using_checked = $('using_checked').value; //whether we are using checkboxes to select the date
/*
         document.location = '/index.php/scheduler/checkEndOfDay?techid='+techid+'&end_time='+end_time+'&start_time='+start_time+'&stechid='+stechid+'&wid='+workorderid+'&client_id='+client_id+'&mwf='+mwf+'&tt='+tt+'&checked_day='+checked_day+'&using_checked='+using_checked+'&use_date='+theSelectedDate;
*/         
            theSelectedDate = $('date').value;
			new Ajax.Request(
				'/index.php/scheduler/checkEndOfDay?techid='+techid+'&end_time='+end_time+'&start_time='+start_time+'&stechid='+stechid+'&wid='+workorderid+'&client_id='+client_id+'&mwf='+mwf+'&tt='+tt+'&checked_day='+checked_day+'&using_checked='+using_checked+'&use_date='+theSelectedDate,
				{
				    asynchronous: false,
					onSuccess: function(transport){
					
					    var response = transport.responseText;
    	       	        var json = eval('('+response+')');
			   
                        //if a pm was scheduled in last 6 months ask if they wanted to do reschedule instead
	    	            if(json.recentPm == 'true' && pm_reason ==17){
						      var ans = confirm('A PM has been scheduled in the last 6 months, are you sure you don\'t mean to reschedule this PM?');
			    	       	  if(ans){
			    	       	  		$('allowScheduleExtension').value = 1;
                                    $('checked_days_hidden').value = json.checked_dates; 
			    	       	  }else{
			    	       	  		$('allowScheduleExtension').value = 0;
							return;
						}
					   }
  
			    	       	   if(json.status == 'unavailable'){
			    	       	        var ans = confirm('Do you want to schedule this job pass '+json.name+'\'s end time?');
			    	       	        if(ans){ 
			    	       	  		   $('allowScheduleExtension').value = 1;
                                       $('checked_days_hidden').value = json.checked_dates; 
			    	       	  	    }else
			    	       	  		   $('allowScheduleExtension').value = 0;
			    	       	   }else if(json.status == 'overlapping'){
			    	       	        alert('Jobs may be overlapping');
			    	       	   	$('allowScheduleExtension').value = 0;
			    	       	   }else if('ok'){
			    	       	   	$('allowScheduleExtension').value = 1;
                                $('checked_days_hidden').value = json.checked_dates; 
			    	       	   }//if
					}//function
				}//object
			); 
            
			if( $('allowScheduleExtension').value == '0')
				return;
			
			document.getElementById('jobScheduler').submit();

		} 

		
		function selectTech(id, first_name, last_name, hours, minutes)
		{
		
			
		   $('using_checked').value = 0; //we are not use the checkboxes to select the date

		   //if its equal to Scheduled, Un then this job has not being assigned to a tech yet
			var current_tech_value = document.getElementById('selectTech').innerHTML;
			current_tech_value = current_tech_value.trim();
			
			
			
			if(current_tech_value == 'Scheduled, Un') 
				cameFromClientPage = 'true';
			
				
			ending_minutes = minutes + 45;
			
			
			if(minutes % 60){
			end_hours  = hours +  parseInt(ending_minutes / 60);
			ending_minutes = (ending_minutes % 60);
			}
			
			
			
			if(minutes == 0) { minutes = '00'; }
			var increm = parseInt(document.getElementById('job_inc').value);
			//end_hours = hours + 0;
			if(minutes == 0){
				ending_minutes = 45;
				end_hours = hours;
			}


			if(hours >= 12)  
			{
				$('start_time_ampm_pm').checked = true;
			} else {
				$('start_time_ampm_am').checked = true;
			}

			if(hours > 12)
			{
				hours = hours - 12;
			}
            
			 
			
			
			if(cameFromClientPage != 'true'){ 
			 
			
				$('start_time_hours').value = hours;
				if(minutes.toString().length<2) minutes = '0' + minutes.toString();
				
				$('start_time_minutes').value = minutes;
			}
            
			if((end_hours >= 12 && end_hours <= 23))
			{
				$('end_time_ampm_pm').checked = true;
			} else {
				$('end_time_ampm_am').checked = true;
			}

			if(end_hours > 12)
			{
				end_hours = end_hours - 12;
			}

			
			if(ending_minutes.toString().length<2) ending_minutes = '0' + ending_minutes.toString();
			
			
			
			document.getElementById('selectTech').innerHTML = last_name + ', ' + first_name;
			document.getElementById('technician').value = id;
			document.getElementById('status').value = 9;
			document.getElementById('allWeekTechCheckox').checked = false;
			document.getElementById('allWeekTechCheckox_hidden').value = '0';
			
			//if job is unschedule return, don't change time
			 
			if(cameFromClientPage == 'true') 
				return false;
				
			document.getElementById('end_time_hours').value = end_hours;
			document.getElementById('end_time_minutes').value = ending_minutes;
		}
		
		function selectSTech(id, first_name, last_name)
		{
			document.getElementById('secondTech').innerHTML = last_name + ', ' + first_name;
			document.getElementById('stech').value = id;
			document.getElementById('allWeekTechCheckox').checked = false;
			document.getElementById('allWeekTechCheckox_hidden').value = '0';
		}
		
		function alldayTech(id, first_name, last_name, s_hour, s_min, e_hour, e_min)
		{
		     $('using_checked').value = 0; //we are not use the checkboxes to select the date

			var hours = s_hour;
			var minutes = s_min;
			if(minutes == 0) { minutes = '00'; }


			if(hours >= 12)  
			{
				$('start_time_ampm_pm').checked = true;
			} else {
				$('start_time_ampm_am').checked = true;
			}

			if(hours > 12)
			{
				hours = hours - 12;
			}

			
			$('start_time_hours').value = hours;
			$('start_time_minutes').value = minutes;
			
			
			var end_hours = e_hour;
			var end_minutes = e_min;
			if(end_minutes == 0) { end_minutes = '00'; }
			
			if(end_hours >= 12 && end_hours <= 23)
			{
				$('end_time_ampm_pm').checked = true;
			} else {
				$('end_time_ampm_am').checked = true;
			}

			if(end_hours > 12)
			{
				end_hours = end_hours - 12;
			}

			document.getElementById('end_time_hours').value = end_hours;

			document.getElementById('end_time_minutes').value = end_minutes;
			document.getElementById('selectTech').innerHTML = last_name + ', ' + first_name;
			document.getElementById('technician').value = id;
			document.getElementById('status').value = 9;
			document.getElementById('allWeekTechCheckox').checked = false;
			document.getElementById('allWeekTechCheckox_hidden').value = '0';
		}
		function allweekTech(id, first_name, last_name, s_hour, s_min, e_hour, e_min)
		{
		    $('using_checked').value = 0; //we are not use the checkboxes to select the date
			var hours = s_hour;
			var minutes = s_min;
			if(minutes == 0) { minutes = '00'; }


			if(hours >= 12)  
			{
				$('start_time_ampm_pm').checked = true;
			} else {
				$('start_time_ampm_am').checked = true;
			}

			if(hours > 12)
			{
				hours = hours - 12;
			}

			$('start_time_hours').value = hours;
			$('start_time_minutes').value = minutes;
			
			
			var end_hours = e_hour;
			var end_minutes = e_min;
			if(end_minutes == 0) { end_minutes = '00'; }
			
			if(end_hours >= 12 && end_hours <= 23)
			{
				$('end_time_ampm_pm').checked = true;
			} else {
				$('end_time_ampm_am').checked = true;
			}

			if(end_hours > 12)
			{
				end_hours = end_hours - 12;
			}

			document.getElementById('end_time_hours').value = end_hours;

			document.getElementById('end_time_minutes').value = end_minutes;
			document.getElementById('selectTech').innerHTML = last_name + ', ' + first_name;
			document.getElementById('technician').value = id;
			document.getElementById('status').value = 9;
			document.getElementById('allWeekTechCheckox').checked = true;
			document.getElementById('allWeekTechCheckox_hidden').value = '1';
		}
		function MWF_TT(id, first_name, last_name, s_hour, s_min, e_hour, e_min, row)
		{
            var d_m = $('d_m_'+row).checked == false ? 0 : 1;
            var d_t = $('d_t_'+row).checked == false ? 0 : 1;
            var d_w = $('d_w_'+row).checked == false ? 0 : 1;
            var d_tt = $('d_tt_'+row).checked == false ? 0 : 1;
            var d_f = $('d_f_'+row).checked == false ? 0 : 1;

            $('using_checked').value = 1; //we are not use the checkboxes to select the date

		    checked_days = new Array(d_m,d_t,d_w,d_tt,d_f);
            checked_str = checked_days.join(',');
            $('checked_days_hidden').value = checked_str;

           /*
			if(action == 'mwf'){
				$('mwf').value = 1;
				$('tt').value = 0;			
			}else{
				$('mwf').value = 0;
				$('tt').value = 1;
			}
			*/

			var hours = s_hour;
			var minutes = s_min;
			if(minutes == 0) { minutes = '00'; }


			if(hours >= 12)  
			{
				$('start_time_ampm_pm').checked = true;
			} else {
				$('start_time_ampm_am').checked = true;
			}

			if(hours > 12)
			{
				hours = hours - 12;
			}

			
			$('start_time_hours').value = hours;
			$('start_time_minutes').value = minutes;
			
			
			var end_hours = e_hour;
			var end_minutes = e_min;
			if(end_minutes == 0) { end_minutes = '00'; }
			
			if(end_hours >= 12 && end_hours <= 23)
			{
				$('end_time_ampm_pm').checked = true;
			} else {
				$('end_time_ampm_am').checked = true;
			}

			if(end_hours > 12)
			{
				end_hours = end_hours - 12;
			}

			document.getElementById('end_time_hours').value = end_hours;

			document.getElementById('end_time_minutes').value = end_minutes;
			document.getElementById('selectTech').innerHTML = last_name + ', ' + first_name;
			document.getElementById('technician').value = id;
			document.getElementById('status').value = 9;
			document.getElementById('allWeekTechCheckox').checked = false;
			document.getElementById('allWeekTechCheckox_hidden').value = '0'; 
		}
		
		
		function selectTechSchedule(id)
		{ 
        theSelectedDate = $('date').value;
        ".
			remote_function(array(
				'update' => 'techDisplay',
				'url' => 'scheduler/populateTechDisplay',
				'with' => '"tech_id=" + id+"&use_date="+theSelectedDate')).
		" } 

		function checkAMPM()
		{
			var starthr = parseInt(document.getElementById('start_time_hours').value);
			var endhr = parseInt(document.getElementById('end_time_hours').value);
			if (starthr <= 7 || starthr == 12) {
				$('start_time_ampm_pm').checked = true;
			}
			if (starthr >= 8 && starthr < 12) {
				$('start_time_ampm_am').checked = true;
			}
			if (endhr <= 7 || endhr == 12) {
				$('end_time_ampm_pm').checked = true;
			}
			if (endhr >= 8 && endhr < 12) {
				$('end_time_ampm_am').checked = true;
			}
		}
			
"); ?>


<!-- Javascript Calander -->
<?php

$x_date = explode('-',$date);
$x_year = $x_date[0];
$x_month = (int)$x_date[1];
$x_day = $x_date[2];


$xx_month = $x_month-1; //... 0 - 11
  		if(!empty($x_date))
  			$javaDate = "var dd = new Date($x_year,$xx_month,$x_day)";
		else
			$javaDate = "var dd = null;";
	
 
echo javascript_tag("

	var MINUTE = 60 * 1000;
	var HOUR = 60 * MINUTE;
	var DAY = 24 * HOUR;
	var WEEK = 7 * DAY;

	function setActiveStyleSheet(link, title) 
	{
		var i, a, main;
		for(i=0; (a = document.getElementsByTagName('link')[i]); i++) 
		{
			if(a.getAttribute('rel').indexOf('style') != -1 && a.getAttribute('title')) 
			{
				a.disabled = true;
				if(a.getAttribute('title') == title) a.disabled = false;
			}
		}

		if (oldLink) oldLink.style.fontWeight = 'normal';
			oldLink = link;

		link.style.fontWeight = 'bold';
		return false;
	}

	function isDisabled(date)
	{
		var today = new Date();
		return (Math.abs(date.getTime() - today.getTime()) / DAY);
	}

	  function dateChanged(calendar) {
	 
	  
	     $('availableTechnicians').innerHTML = \"<div style='margin-left: 100px'><img src='/images/load.gif'></div>\";
		  if (calendar.dateClicked) {
	       var y = calendar.date.getFullYear();
      	 var m = calendar.date.getMonth();     // integer, 0..11
         var d = calendar.date.getDate();      // integer, 1..31
      }
      
      try{
        m = calendar.date.getMonth();
        d = calendar.date.getDate();
        y = calendar.date.getFullYear();
      }catch(e){
      }
            m = (m+1);
            if(m < 10) m = '0' + m.toString(); 
            if(d < 10) d = '0' + d.toString(); 
            date = y + '-'+ m +'-'+d; 
      
			document.getElementById('date').value = date;
			var el = document.getElementById('display_date');
         
			".
			
			
			remote_function(array(
				'update' => 'techDisplay',
				'url' => 'scheduler/populateTechDisplay',
				'with' => '"date=" + date')).";".
			remote_function(array(
				'update' => 'availableTechnicians',
				'url' => 'scheduler/firstAvailable',
				'with' => '"client_id="+$("client_select").value+"&date=" + date')).";"."
				GUnload();
		    initGoogleMap();
 	 };

  function showFlatCalendar(){
 		 $javaDate;
  	   $('availableTechnicians').innerHTML = \"<div style='margin-left: 100px'><img src='/images/load.gif'></div>\";
	".
		//initiate TechDisplay
		remote_function(array(
			'update' => 'techDisplay',
			'url' => 'scheduler/populateTechDisplay',
			'with' => '"date='.$date.'"',
			'complete' => '$("techMap").hide()')).";".
		remote_function(array(
			'update' => 'availableTechnicians',
			'url' => 'scheduler/firstAvailable',
			'with' => '"client_id="+$("client_select").value+"&date='.$date.'"')).";
 
		
		  Calendar.setup(
	    {
	      weekNumbers  : false,
	      flat         : 'display', // ID of the parent element
	      flatCallback : dateChanged,          // our callback function
	      date: dd
	    }
	    );
	  
  };
	
	
	");

		
		?>
<!-- Calendar ends -->

<?php echo javascript_tag("
		function convertTime(hours, minutes, ampm)
		{
			if(ampm == 'pm')
			{
				if(hours != 12)
				{
					hours = Number(hours) + 12;
				}
			} else {
				if(hours == 12)
				{
					hours = Number(hours) + 12;

				}
			}
			
			hours *= 100;

			time = Number(hours) + Number(minutes);

			return time;
		} "); ?>
<?php echo javascript_tag("
		function selectTechSchedule(id)
		{
			date = document.getElementById('date').value

			if(id == 'all')
			{".
				remote_function(array(
					'update' => 'techDisplay',
					'url' => 'scheduler/populateTechDisplay',
					'with' => '"tech_id=" + id + "&date=" + date',
					'complete' => "$('techMap').hide()"))."
			} else {".
				remote_function(array(
					'update' => 'techDisplay',
					'url' => 'scheduler/populateTechDisplay',
					'with' => '"tech_id=" + id + "&date=" + date',
					'complete' => "$('techMapDisplay').src = '".url_for('scheduler/techMap')."' + '/tech_id/' + id + '/date/' + date"))."
			}
				
		} "); ?>
<?php //Sets "edit" mode ?>
<?php echo javascript_tag('
		function populateWorkorder(workorder_id)
		{ 
		
			window.location = "'.url_for('scheduler/index?mode=edit&ticket=').'" + "/" + workorder_id;
		} '); ?>
<?php echo javascript_tag("
		function deleteJob(id)
		{
			if(confirm('Are you sure you want to delete this job?'))
			{".
				remote_function(array(
					'url' => 'scheduler/deleteJob',
					'with' => '"ticket=" + id'))."
			}
		}"); ?>


<div id="main">
<!-- inserted by ryan -->

<div id = 'emailPopUp' style='display:none;height:140px;width:220px;'>

</div>

<!-- end insertion -->
<script type='text' >
</script 

	<div id="scheduler">
		<div class="client_select">
			<?php  ?>
			<table border="0"><tr>
				<td valign='top'><b>Client: </b></td>
				<td><?php
				

			
						if($mode == 'edit')
						{ 
							echo form_tag('scheduler/jobScheduler?mode=edit&ticket='.$edit_workorder->getId().'&client='.$client_select, array('id' => 'jobScheduler'));
							echo select_tag('client_edit', objects_for_select($selectClient,
								'getid',
								'getclientidentification', $client_select),
								array(
									'onFocus' => "this.enteredText=''",
									'onkeydown' => "return handleKey()",
									'onkeyup' => "event.cancelbubble=true;return false",
									'onkeypress' => "return selectItem();"));
							echo '</td></tr>';
							echo '<tr><td></td>';
							echo '<td colspan="2"><b>Attn:</b> '.$edit_client->getAttn().'&nbsp;&nbsp;<b>Phone:</b> '.$edit_client->getPhone();
							if ($edit_client->getExt() != null){ echo ' Ext. '.$edit_client->getExt();}
							echo '</td></tr>';	
							echo '<tr><td></td><td>'.$edit_client->getCity().', '.$edit_client->getState();
						} else {
							if(($sf_params->get('ppage')=='yes' or $sf_params->get('rrpage')=='yes') and is_numeric($sf_params->get('client')))
								$client_select = $sf_params->get('client');
							echo form_tag('scheduler/index');
							echo select_tag('client_select', objects_for_select($selectClient,
								'getid',
								'getclientidentification', $client_select),
								array('onFocus' => "this.enteredText=''",
									'onkeydown' => "return handleKey()",
									'onkeyup' => "event.cancelbubble=true;return false",
									'onkeypress' => "return selectItem();")); 
								
							if(!empty($error) && method_exists($edit_client,'getAttn')){					
							echo "<br/><table border='0' width='100%'>";
							echo '<tr>';
							echo '<td ><b>Attn:</b> '.$edit_client->getAttn().'&nbsp;&nbsp;<b>Phone:</b> '.$edit_client->getPhone();
							if ($edit_client->getExt() != null){ echo ' Ext. '.$edit_client->getExt();}
							echo '</td></tr>';	
							echo "<tr></tr></table>"; 
							}
										
							
								?>
								</td>
								<td valign='top'><?php echo submit_tag('Select');
										echo '</form>';	
										
										
						} ?></td>
				</tr>
				<?php
				if (isset($client_data)){
					echo '<tr><td></td>';
					echo '<td colspan="2"><b>Attn:</b> '.$client_data->getAttn().'&nbsp;&nbsp;<b>Phone:</b> '.$client_data->getPhone();
					if ($client_data->getExt() != null){ echo ' Ext. '.$client_data->getExt();}
					echo '</td></tr>';		
				}
				?>
			</table>
			
		</div>
		<div class="job_details">
			<?php
		
				if(!empty($mode))
				{
					 
					if($mode == 'edit')
					{
						
						echo input_hidden_tag('start_time', $edit_workorder->getJobStart());
						echo input_hidden_tag('end_time', $edit_workorder->getJobEnd());
						echo input_hidden_tag('technician', $edit_workorder->getTech());
						echo input_hidden_tag('mode', 'edit');
						foreach($edit_workorder_stech as $tech)
							{
 								echo input_hidden_tag('stech', $tech->getId());								
							}
						if($edit_workorder_stech == NULL){
							echo input_hidden_tag('stech');
						}
					}
				}
				else {
				
					echo form_tag('scheduler/jobScheduler?client='.$client_select, array('id' => 'jobScheduler'));
					echo input_hidden_tag('start_time');
					echo input_hidden_tag('end_time');
					echo input_hidden_tag('technician');
					
				}
				if($mode != 'edit'){
					echo input_hidden_tag('stech');
			    }
				echo input_hidden_tag('client_select');
				echo input_hidden_tag('date', $date);
				echo input_hidden_tag('job_status', 'scheduled');
 				echo input_hidden_tag('job_inc', '2');
				?>
			<table>
			<tr>
				<td>Device: </td>
				<td colspan="2">
					<?php	
						if($sf_params->get('ppage')=='yes' or $sf_params->get('rrpage')=='yes'){//from process page
							echo select_tag('specification_select', options_for_select($specification_options, -2), array(
											'onChange' => 'populateDeviceMenu();'));
 							echo input_hidden_tag('all_time', $all_time);
						}else if (isset($specification_options)){
							if(empty($specification_select))
							     $specification_select = -1;
							echo select_tag('specification_select', options_for_select($specification_options, $specification_select), array(
											'onChange' => 'populateDeviceMenu();'));
 							echo input_hidden_tag('all_time', $all_time);
						}else {
							echo 'Please Select a Client...';
						} ?>
				</td>
			</tr>
			
			<tr>
				<td>Device ID: </td>
				<td colspan="2">
					<div id=device>
						<?php
							if($sf_params->get('ppage')=='yes' or $sf_params->get('rrpage')=='yes'){//from process page
								echo 'All Devices Selected...';
							}else if($mode == 'edit'){
							//if 'All Devices' is selected
								if ($specification_select == -2){
									echo 'All Devices Selected...';
								} else {
									echo select_tag('device_select', options_for_select($device_options, $device_select));
								}
							} else {
								echo 'Please Select a Device...';
							} 
						?>
					</div>
				</td>
			</tr>
			
			<tr>
				<td>Reason: </td>
				<td colspan="2">
					<?php 
					    if(!empty($error)){
					    	echo select_tag('reason_select', objects_for_select($reason_dropdown, 'getid', 'getvalue', $reason_select));
					    }
						elseif ($mode == 'edit'){
							if ($specification_select == -2)
							{	
								echo select_tag('reason_select', objects_for_select($reason_dropdown, 'getid', 'getvalue', $reason_select, array('disabled'=> true)));
							} else {						
								echo select_tag('reason_select', objects_for_select($reason_dropdown, 'getid', 'getvalue', $reason_select)); 
							}
						}elseif($sf_params->get('ppage')=='yes'){//coming from process page
									echo select_tag('reason_select', objects_for_select($reason_dropdown, 'getid', 'getvalue',23)); 
						}
						elseif($sf_params->get('rrpage')=='yes'){//coming from process page
															echo select_tag('reason_select', objects_for_select($reason_dropdown, 'getid', 'getvalue',20)); 
												}
						else{
							if ($specification_select == -2)
							{	
								echo select_tag('reason_select', objects_for_select($reason_dropdown, 'getid', 'getvalue', array('disabled'=> true)));
							} else {						
								echo select_tag('reason_select', objects_for_select($reason_dropdown, 'getid', 'getvalue')); 
							}
					} 
					?>
				</td>
			</tr>
			
			<tr>
				<td>Job Date:</td>
				<td colspan="2">
					<div id="display_date" style="display: none;">
						<?php 
							echo input_date_tag('job_date', $job_date, 'rich=true'); 
						?>
					</div>
						<div id="calendar">
							<div id="display">
								<?php input_hidden_tag('display_check', true); ?>
							</div>
						</div>
				</td>
			</tr>
			
		</div>
		<div class="tech_details">
			<tr>
				<td>Technician: </td>
				<td colspan="2">
					<div id='selectTech'>
						<?php 
							if($mode == 'edit'){
								echo $edit_workorder_tech->getDisplayName();
							} elseif(!empty($error) and !empty($edit_workorder_tech))
								echo $edit_workorder_tech->getDisplayName();
							else {
								echo ' Please Select ...';
							} ?>
					</div>
				</td>
			</tr>
			
			<tr>
				<td>Extra Tech:</td>
				<td colspan="2">
					<div id='secondTech' >
						<?php 	
							$count = '0';
							if(!empty($error) and !empty($second_tech)){
								echo $second_tech->getDisplayName();
							}else{
								if (!empty($edit_workorder_stech)){
									foreach($edit_workorder_stech as $tech)
									{
										$count++;
	 									echo $tech->getDisplayName() . "<br />";								
									}
								}
								if ($count==0){echo " N/A";}
							}
						?>
					</div>
				</td>
			</tr>
			

			
			<tr>
				<td>Start Time: </td>
				<td><?php 
						echo  input_tag('start_time_hours', $start_time_hours, array(
									'onkeyup' => 'checkAMPM();',
									'size' => '2',
									'maxlength' => '2')).' : '.
								input_tag('start_time_minutes', $start_time_minutes, array(
									'size' => '2',
									'maxlength' => '2')); 
					?>
				</td>
				<td><?php echo radiobutton_tag('start_time_ampm[]','am', $start_time_am).' AM'.' '.
							   radiobutton_tag('start_time_ampm[]','pm', !$start_time_am).' PM'; 
					?>
				</td>
			</tr>
			
			<tr>
				<td>End Time: </td>
				<td><?php echo  input_tag('end_time_hours', $end_time_hours, array(
									'onkeyup' => 'checkAMPM();',
									'size' => '2',
									'maxlength' => '2')).' : '.
								input_tag('end_time_minutes', $end_time_minutes, array(
									'size' => '2',
									'maxlength' => '2')); ?>
				</td>
				<td><?php echo radiobutton_tag('end_time_ampm[]','am', $end_time_am).' AM'.' '.
							   radiobutton_tag('end_time_ampm[]','pm', !$end_time_am).' PM'; ?>
				</td>
			</tr>
			
			
			
				<tr>
				<td>Full Week:</td>
				<td colspan="2">
					<div id='fullWeek' >
					  <input type='hidden' id='allowScheduleExtension' name='allowScheduleExtension' value="0" />
					  <input type='checkbox'  id='allWeekTechCheckox' name='allWeekTechCheckox' disabled/> 
					  <input type='hidden'  id='allWeekTechCheckox_hidden' name='allWeekTechCheckox_hidden' value=''/> 
					  <?$setExact = ($exact_time)? "checked='checked'" : ''; ?>
                        &nbsp;&nbsp;&nbsp;&nbsp; Exact Time <input type='checkbox'  id='exactTime' name='exactTime' value="1" <? print $setExact; ?>/> 
					
					
</div>
<input type='hidden' name = 'mwf' id='mwf' value='0'>
<input type='hidden' name = 'tt' id='tt' value='0'>
				</td>
			</tr>
			
			<tr>

				<td>Requested By: </td>
				<td colspan="2">
				
				<?php if($mode == 'edit') {
							echo input_tag('caller', $caller,  array(
									'size' => '23',
									'maxlength' => '75'));
						}else {
							echo input_tag('caller', "$caller",  array(
									'size' => '23',
									'maxlength' => '75'));
						}
						
				 ?>
				
				</td>
			</tr>
			
			<tr>
				<td>Remarks: </td>
				<td colspan="2">
				
				<?php if($mode == 'edit') {
							echo textarea_tag('notes', $notes, 'size=18x2');
						}else {
							echo textarea_tag('notes', $notes, 'size=18x2');
						}
						
				 ?>
				
				</td>
			</tr>
			
			<tr>
				<td>Status: </td>
				<td colspan="2">
					<?php
					if ($sf_params->get('rrpage')=='yes' || $sf_params->get('ppage')=='yes'){
					 echo select_tag('status', objects_for_select($selectStatus,
								'getid',
								'getstatusname', 9),
								array('onFocus' => "this.enteredText=''",
									'onkeydown' => "return handleKey()",
									'onkeyup' => "event.cancelbubble=true;return false",
									'onkeypress' => "return selectItem();"));
					}else if ($mode == 'edit'){
					 echo select_tag('status', objects_for_select($selectStatus,
								'getid',
								'getstatusname', $status),
								array('onFocus' => "this.enteredText=''",
									'onkeydown' => "return handleKey()",
									'onkeyup' => "event.cancelbubble=true;return false",
									'onkeypress' => "return selectItem();"));
					} else {
					 echo select_tag('status', objects_for_select($selectStatus,
								'getid',
								'getstatusname', 10),
								array(
									'onFocus' => "this.enteredText=''",
									'onkeydown' => "return handleKey()",
									'onkeyup' => "event.cancelbubble=true;return false",
									'onkeypress' => "return selectItem();")
									);
					}
					?>
                    <input type='hidden' id='checked_days_hidden' name='checked_days_hidden'/>
                    <input type='hidden' id='using_checked' name='using_checked' value='0' />
				</td>
			</tr>
			<tr>
				<td colspan="3" align="right">
					<?php 
						if($mode == 'edit'){
							echo button_to_function('Save Job', 'submitJob()');
							echo button_to('Schedule New', 'scheduler/index');
							echo button_to('Delete Job', 'scheduler/deleteJob?id='.$edit_workorder->getId(), array('confirm' => 'Are you sure you want to delete this job?'));
						} else {
							echo button_to_function('Schedule Job', 'submitJob()');
						} 
					?>
				</td>
			</tr>
			
			</table>
		</div>
		</form>
	</div>

	<div id="availableTechnicians"></div>
	<div id="scheduleGoogleMap" style="  width: 490px; height: 500px"></div>


</div>

<div id="techDisplay"></div>

<?php	//Display notes popup
	if (isset($client_source))
	{	
		$noteCheck = $client_source->getNotes();

		if (!empty($noteCheck))
		{
			echo javascript_tag('alert("'.$client_source->getNotes().'")');
		} 
	} 
?>
