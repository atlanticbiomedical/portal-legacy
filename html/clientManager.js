function getPageScroll(){

	var xScroll, yScroll;

	if (self.pageYOffset) {
		yScroll = self.pageYOffset;
		xScroll = self.pageXOffset;
	} else if (document.documentElement && document.documentElement.scrollTop){	 // Explorer 6 Strict
		yScroll = document.documentElement.scrollTop;
		xScroll = document.documentElement.scrollLeft;
	} else if (document.body) {// all other Explorers
		yScroll = document.body.scrollTop;
		xScroll = document.body.scrollLeft;	
	}

	arrayPageScroll = new Array(xScroll,yScroll) 
	return arrayPageScroll;
}

function getPageSize(){
	
	var xScroll, yScroll;
	
	if (window.innerHeight && window.scrollMaxY) {	
		xScroll = window.innerWidth + window.scrollMaxX;
		yScroll = window.innerHeight + window.scrollMaxY;
	} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
		xScroll = document.body.scrollWidth;
		yScroll = document.body.scrollHeight;
	} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
		xScroll = document.body.offsetWidth;
		yScroll = document.body.offsetHeight;
	}
	
	var windowWidth, windowHeight;
	
//	console.log(self.innerWidth);
//	console.log(document.documentElement.clientWidth);

	if (self.innerHeight) {	// all except Explorer
		if(document.documentElement.clientWidth){
			windowWidth = document.documentElement.clientWidth; 
		} else {
			windowWidth = self.innerWidth;
		}
		windowHeight = self.innerHeight;
	} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
		windowWidth = document.documentElement.clientWidth;
		windowHeight = document.documentElement.clientHeight;
	} else if (document.body) { // other Explorers
		windowWidth = document.body.clientWidth;
		windowHeight = document.body.clientHeight;
	}	
	
	// for small pages with total height less then height of the viewport
	if(yScroll < windowHeight){
		pageHeight = windowHeight;
	} else { 
		pageHeight = yScroll;
	}

//	console.log("xScroll " + xScroll)
//	console.log("windowWidth " + windowWidth)

	// for small pages with total width less then width of the viewport
	if(xScroll < windowWidth){	
		pageWidth = xScroll;		
	} else {
		pageWidth = windowWidth;
	}
//	console.log("pageWidth " + pageWidth)

	arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight) 
	return arrayPageSize;
}

function getScrollCenter()
{
	scroll_info = getPageScroll();
	page_info = getPageSize();

	viewable_width = page_info[2];
	viewable_height = page_info[3];

	scroll_x = scroll_info[0];
	scroll_y = scroll_info[1];

	x_center = (scroll_x + (viewable_width/2))-(400/2);
	y_center = (scroll_y + (viewable_height/2))-(200/2);
	
	return [x_center, y_center];

}

function show_popup2(popup_div){


	thePos = getScrollCenter();
	var x = thePos[0];
	var y = thePos[1];
    
       
	positionAndShowPopUp(x,y,400,popup_div);

}
function saveClient(){
    var tolalFreqForUpdate = $('updatedFreqCount').value;
    var drop='';
    for(var i = 1; i<= tolalFreqForUpdate; i++){
         if(i == 1)
         	drop += $('drop'+i).value;
         else 
                drop += "-" + $('drop'+i).value;
    }
    $('updatedFreqCount').value = drop;
    $('addClientForm').submit();
}
function frequencyCheckDone(){ 
     
	if( $('updatedFreqCount').value > 0 )
		show_popup2('mainFreqContainer');
        else{
          
          $('addClientForm').submit();
        }
}
function checkFrequencyStatus(){
	var months = new Array('JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC');
        var month_arr = new Array();
        var clientId = $('id').value;
        var j =0;
	for(var i = 0; i < months.length; i++){
          if($('frequency_'+months[i]).checked){
          	month_arr[j] = $('frequency_'+months[i]).value;
                j++;
          }//if
        }
       
        new Ajax.Updater(
        'frequencyInner',
        '/index.php/clientManager/frequencyChecks?clientId='+clientId+'&months='+month_arr.toString(),
        {
		method: 'post',
                evalScripts: true,
                asynchronous: false,
                onSuccess: function(){
                   
                  
                }
        }
        ); 

return false;
}

function positionAndShowPopUp(x,y,width,popup_div)
{
	var a = document.getElementById(popup_div);
	a.style.position = "absolute";
	a.style.left = x + 'px';
	a.style.top = y + 'px';
	a.style.display = "block";
}
function pass_fail_date_changed(){

	var selectedIndex = $('p_f_dates').selectedIndex;
        var selectedValue = $('p_f_dates').options[selectedIndex].value;
        if(selectedIndex == 0)
	{
		  clearAllColors();
		  return;
	}
 
        date_and_id = selectedValue;
	new Ajax.Request(
        '/index.php/clientManager/getPassFailByDate?date_and_id='+date_and_id,
        {
		method: 'post',
                evalScripts: true,
                asynchronous: false,
		onSuccess: function(transport){ 
		   d_response = transport.responseText;
  		   var json = eval('('+d_response+')'); 
		   var main = json.main;
               
		  for(var i = 0; i < main.length; i++){
			if(main[i][1] == 'PASS' || main[i][1] == 'pass'){
		  		var cell = $('device_update_'+main[i][0]+'_device_name').style.backgroundColor = 'green';
				var cell = $('device_update_'+main[i][0]+'_manufacturer').style.backgroundColor = 'green';
				var cell = $('device_update_'+main[i][0]+'_model_number').style.backgroundColor = 'green';
				var cell = $('device_update_'+main[i][0]+'_serial_number').style.backgroundColor = 'green';
				var cell = $('device_update_'+main[i][0]+'_identification').style.backgroundColor = 'green';
			}
			else{
				var cell = $('device_update_'+main[i][0]+'_device_name').style.backgroundColor = 'red';
				var cell = $('device_update_'+main[i][0]+'_manufacturer').style.backgroundColor = 'red';
				var cell = $('device_update_'+main[i][0]+'_model_number').style.backgroundColor = 'red';
				var cell = $('device_update_'+main[i][0]+'_serial_number').style.backgroundColor = 'red';
				var cell = $('device_update_'+main[i][0]+'_identification').style.backgroundColor = 'red';
			}//if
		  }//for
			
                }//if
        }
        );
  
}
function clearAllColors(){
    var allIds = $('allIdsOnPage').value;
    arr_ids = allIds.split(',');
    for(var i = 0; i < arr_ids.length; i++){
	var cell = $('device_update_'+arr_ids[i]+'_device_name').style.backgroundColor = '#ffffff'
	var cell = $('device_update_'+arr_ids[i]+'_manufacturer').style.backgroundColor = '#ffffff';
	var cell = $('device_update_'+arr_ids[i]+'_model_number').style.backgroundColor = '#ffffff';
	var cell = $('device_update_'+arr_ids[i]+'_serial_number').style.backgroundColor = '#ffffff';
	var cell = $('device_update_'+arr_ids[i]+'_identification').style.backgroundColor = '#ffffff';
    }
}
function saveSecondaryAddress(){
	var address = $('secondary_address').value;
	var address2 = $('secondary_address2').value;
	var city = $('secondary_city').value;
	var state = $('secondary_state').value;
	var zip = $('secondary_zip').value;
	var attn = $('secondary_attn').value;
        var clientId = $('id').value;
	alert('/index.php/clientManager/saveSecondaryAddress?client_id='+clientId+'&address='+address+'&address2='+address2+'&city='+city+'&state='+state+'&zip='+zip+'&attn='+attn);
	new Ajax.Request(
        '/index.php/clientManager/saveSecondaryAddress?client_id='+clientId+'&address='+address+'&address2='+address2+'&city='+city+'&state='+state+'&zip='+zip+'&attn='+attn,
        {
		method: 'post',
                evalScripts: true,
                asynchronous: false,
		onSuccess: function(transport){ 
			$('secondary_info').hide();
		}
	}//object
        );
}
