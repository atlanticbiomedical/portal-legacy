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

function deleteReport(id, client_id){
	var sure = confirm('Are you sure you want to delete this report?');
	if(!sure){
		return;	
	}

	new Ajax.Updater(
           'listedReport',
             '/index.php/clientManager/deleteReport?id='+id+'&client_id='+client_id,
             {
		method: 'get',
                evalScripts: true,
                asynchronous: false,
                onSuccess: function(transport){ 
		       
                }
              }
	   );
}
function unlockFreq(){
var clientId = $('id').value;
 new Ajax.Request(
             '/index.php/clientManager/unlockFreq?client_id='+clientId,
             {
		method: 'get',
                evalScripts: true,
                asynchronous: false,
                onSuccess: function(transport){ 
			$('frequency_legacy_JAN').disabled = false;
			$('frequency_legacy_FEB').disabled = false;
			$('frequency_legacy_MAR').disabled = false;
			$('frequency_legacy_APR').disabled = false;
			$('frequency_legacy_MAY').disabled = false;
			$('frequency_legacy_JUN').disabled = false;
			$('frequency_legacy_JUL').disabled = false;
			$('frequency_legacy_AUG').disabled = false;
			$('frequency_legacy_SEP').disabled = false;
			$('frequency_legacy_OCT').disabled = false;
			$('frequency_legacy_NOV').disabled = false;
			$('frequency_legacy_DEC').disabled = false;
			$('frequency_annual_JAN').disabled = false;
			$('frequency_annual_FEB').disabled = false;
			$('frequency_annual_MAR').disabled = false;
			$('frequency_annual_APR').disabled = false;
			$('frequency_annual_MAY').disabled = false;
			$('frequency_annual_JUN').disabled = false;
			$('frequency_annual_JUL').disabled = false;
			$('frequency_annual_AUG').disabled = false;
			$('frequency_annual_SEP').disabled = false;
			$('frequency_annual_OCT').disabled = false;
			$('frequency_annual_NOV').disabled = false;
			$('frequency_annual_DEC').disabled = false;
			$('frequency_semi_JAN').disabled = false;
			$('frequency_semi_FEB').disabled = false;
			$('frequency_semi_MAR').disabled = false;
			$('frequency_semi_APR').disabled = false;
			$('frequency_semi_MAY').disabled = false;
			$('frequency_semi_JUN').disabled = false;
			$('frequency_semi_JUL').disabled = false;
			$('frequency_semi_AUG').disabled = false;
			$('frequency_semi_SEP').disabled = false;
			$('frequency_semi_OCT').disabled = false;
			$('frequency_semi_NOV').disabled = false;
			$('frequency_semi_DEC').disabled = false;
			$('frequency_quarterly_JAN').disabled = false;
			$('frequency_quarterly_FEB').disabled = false;
			$('frequency_quarterly_MAR').disabled = false;
			$('frequency_quarterly_APR').disabled = false;
			$('frequency_quarterly_MAY').disabled = false;
			$('frequency_quarterly_JUN').disabled = false;
			$('frequency_quarterly_JUL').disabled = false;
			$('frequency_quarterly_AUG').disabled = false;
			$('frequency_quarterly_SEP').disabled = false;
			$('frequency_quarterly_OCT').disabled = false;
			$('frequency_quarterly_NOV').disabled = false;
			$('frequency_quarterly_DEC').disabled = false;
			$('frequency_sterilizer_JAN').disabled = false;
			$('frequency_sterilizer_FEB').disabled = false;
			$('frequency_sterilizer_MAR').disabled = false;
			$('frequency_sterilizer_APR').disabled = false;
			$('frequency_sterilizer_MAY').disabled = false;
			$('frequency_sterilizer_JUN').disabled = false;
			$('frequency_sterilizer_JUL').disabled = false;
			$('frequency_sterilizer_AUG').disabled = false;
			$('frequency_sterilizer_SEP').disabled = false;
			$('frequency_sterilizer_OCT').disabled = false;
			$('frequency_sterilizer_NOV').disabled = false;
			$('frequency_sterilizer_DEC').disabled = false;
			$('frequency_tg_JAN').disabled = false;
			$('frequency_tg_FEB').disabled = false;
			$('frequency_tg_MAR').disabled = false;
			$('frequency_tg_APR').disabled = false;
			$('frequency_tg_MAY').disabled = false;
			$('frequency_tg_JUN').disabled = false;
			$('frequency_tg_JUL').disabled = false;
			$('frequency_tg_AUG').disabled = false;
			$('frequency_tg_SEP').disabled = false;
			$('frequency_tg_OCT').disabled = false;
			$('frequency_tg_NOV').disabled = false;
			$('frequency_tg_DEC').disabled = false;
			$('frequency_ert_JAN').disabled = false;
			$('frequency_ert_FEB').disabled = false;
			$('frequency_ert_MAR').disabled = false;
			$('frequency_ert_APR').disabled = false;
			$('frequency_ert_MAY').disabled = false;
			$('frequency_ert_JUN').disabled = false;
			$('frequency_ert_JUL').disabled = false;
			$('frequency_ert_AUG').disabled = false;
			$('frequency_ert_SEP').disabled = false;
			$('frequency_ert_OCT').disabled = false;
			$('frequency_ert_NOV').disabled = false;
			$('frequency_ert_DEC').disabled = false;
			$('frequency_rae_JAN').disabled = false;
			$('frequency_rae_FEB').disabled = false;
			$('frequency_rae_MAR').disabled = false;
			$('frequency_rae_APR').disabled = false;
			$('frequency_rae_MAY').disabled = false;
			$('frequency_rae_JUN').disabled = false;
			$('frequency_rae_JUL').disabled = false;
			$('frequency_rae_AUG').disabled = false;
			$('frequency_rae_SEP').disabled = false;
			$('frequency_rae_OCT').disabled = false;
			$('frequency_rae_NOV').disabled = false;
			$('frequency_rae_DEC').disabled = false;
			$('frequency_medgas_JAN').disabled = false;
			$('frequency_medgas_FEB').disabled = false;
			$('frequency_medgas_MAR').disabled = false;
			$('frequency_medgas_APR').disabled = false;
			$('frequency_medgas_MAY').disabled = false;
			$('frequency_medgas_JUN').disabled = false;
			$('frequency_medgas_JUL').disabled = false;
			$('frequency_medgas_AUG').disabled = false;
			$('frequency_medgas_SEP').disabled = false;
			$('frequency_medgas_OCT').disabled = false;
			$('frequency_medgas_NOV').disabled = false;
			$('frequency_medgas_DEC').disabled = false;
			$('frequency_imaging_JAN').disabled = false;
			$('frequency_imaging_FEB').disabled = false;
			$('frequency_imaging_MAR').disabled = false;
			$('frequency_imaging_APR').disabled = false;
			$('frequency_imaging_MAY').disabled = false;
			$('frequency_imaging_JUN').disabled = false;
			$('frequency_imaging_JUL').disabled = false;
			$('frequency_imaging_AUG').disabled = false;
			$('frequency_imaging_SEP').disabled = false;
			$('frequency_imaging_OCT').disabled = false;
			$('frequency_imaging_NOV').disabled = false;
			$('frequency_imaging_DEC').disabled = false;
			$('frequency_neptune_JAN').disabled = false;
			$('frequency_neptune_FEB').disabled = false;
			$('frequency_neptune_MAR').disabled = false;
			$('frequency_neptune_APR').disabled = false;
			$('frequency_neptune_MAY').disabled = false;
			$('frequency_neptune_JUN').disabled = false;
			$('frequency_neptune_JUL').disabled = false;
			$('frequency_neptune_AUG').disabled = false;
			$('frequency_neptune_SEP').disabled = false;
			$('frequency_neptune_OCT').disabled = false;
			$('frequency_neptune_NOV').disabled = false;
			$('frequency_neptune_DEC').disabled = false;			
                        $('frequency_anesthesia_JAN').disabled = false;
                        $('frequency_anesthesia_FEB').disabled = false;
                        $('frequency_anesthesia_MAR').disabled = false;
                        $('frequency_anesthesia_APR').disabled = false;
                        $('frequency_anesthesia_MAY').disabled = false;
                        $('frequency_anesthesia_JUN').disabled = false;
                        $('frequency_anesthesia_JUL').disabled = false;
                        $('frequency_anesthesia_AUG').disabled = false;
                        $('frequency_anesthesia_SEP').disabled = false;
                        $('frequency_anesthesia_OCT').disabled = false;
                        $('frequency_anesthesia_NOV').disabled = false;
                        $('frequency_anesthesia_DEC').disabled = false;
                        $('dom_input').innerHTML =" <input type='button' value='Approve Freq.' id = 'approveFreqButt' onclick='approveFrequency()'>";   
                }
              }
	   ); 
}
function  approveFrequency(){
	var freqLegacy = [];
	var freqAnnual = [];
	var freqSemi = [];
	var freqQuarterly = [];
	var freqSterilizer = [];
	var freqTg = [];
	var freqErt = [];
	var freqRae = [];
	var freqMedgas = [];
	var freqImaging = [];
	var freqNeptune = [];
	var freqAnesthesia = [];

	if ($('frequency_legacy_JAN').checked) freqLegacy.push('JAN');
	if ($('frequency_legacy_FEB').checked) freqLegacy.push('FEB');
	if ($('frequency_legacy_MAR').checked) freqLegacy.push('MAR');
	if ($('frequency_legacy_APR').checked) freqLegacy.push('APR');
	if ($('frequency_legacy_MAY').checked) freqLegacy.push('MAY');
	if ($('frequency_legacy_JUN').checked) freqLegacy.push('JUN');
	if ($('frequency_legacy_JUL').checked) freqLegacy.push('JUL');
	if ($('frequency_legacy_AUG').checked) freqLegacy.push('AUG');
	if ($('frequency_legacy_SEP').checked) freqLegacy.push('SEP');
	if ($('frequency_legacy_OCT').checked) freqLegacy.push('OCT');
	if ($('frequency_legacy_NOV').checked) freqLegacy.push('NOV');
	if ($('frequency_legacy_DEC').checked) freqLegacy.push('DEC');
	if ($('frequency_annual_JAN').checked) freqAnnual.push('JAN');
	if ($('frequency_annual_FEB').checked) freqAnnual.push('FEB');
	if ($('frequency_annual_MAR').checked) freqAnnual.push('MAR');
	if ($('frequency_annual_APR').checked) freqAnnual.push('APR');
	if ($('frequency_annual_MAY').checked) freqAnnual.push('MAY');
	if ($('frequency_annual_JUN').checked) freqAnnual.push('JUN');
	if ($('frequency_annual_JUL').checked) freqAnnual.push('JUL');
	if ($('frequency_annual_AUG').checked) freqAnnual.push('AUG');
	if ($('frequency_annual_SEP').checked) freqAnnual.push('SEP');
	if ($('frequency_annual_OCT').checked) freqAnnual.push('OCT');
	if ($('frequency_annual_NOV').checked) freqAnnual.push('NOV');
	if ($('frequency_annual_DEC').checked) freqAnnual.push('DEC');
	if ($('frequency_semi_JAN').checked) freqSemi.push('JAN');
	if ($('frequency_semi_FEB').checked) freqSemi.push('FEB');
	if ($('frequency_semi_MAR').checked) freqSemi.push('MAR');
	if ($('frequency_semi_APR').checked) freqSemi.push('APR');
	if ($('frequency_semi_MAY').checked) freqSemi.push('MAY');
	if ($('frequency_semi_JUN').checked) freqSemi.push('JUN');
	if ($('frequency_semi_JUL').checked) freqSemi.push('JUL');
	if ($('frequency_semi_AUG').checked) freqSemi.push('AUG');
	if ($('frequency_semi_SEP').checked) freqSemi.push('SEP');
	if ($('frequency_semi_OCT').checked) freqSemi.push('OCT');
	if ($('frequency_semi_NOV').checked) freqSemi.push('NOV');
	if ($('frequency_semi_DEC').checked) freqSemi.push('DEC');
	if ($('frequency_quarterly_JAN').checked) freqQuarterly.push('JAN');
	if ($('frequency_quarterly_FEB').checked) freqQuarterly.push('FEB');
	if ($('frequency_quarterly_MAR').checked) freqQuarterly.push('MAR');
	if ($('frequency_quarterly_APR').checked) freqQuarterly.push('APR');
	if ($('frequency_quarterly_MAY').checked) freqQuarterly.push('MAY');
	if ($('frequency_quarterly_JUN').checked) freqQuarterly.push('JUN');
	if ($('frequency_quarterly_JUL').checked) freqQuarterly.push('JUL');
	if ($('frequency_quarterly_AUG').checked) freqQuarterly.push('AUG');
	if ($('frequency_quarterly_SEP').checked) freqQuarterly.push('SEP');
	if ($('frequency_quarterly_OCT').checked) freqQuarterly.push('OCT');
	if ($('frequency_quarterly_NOV').checked) freqQuarterly.push('NOV');
	if ($('frequency_quarterly_DEC').checked) freqQuarterly.push('DEC');
	if ($('frequency_sterilizer_JAN').checked) freqSterilizer.push('JAN');
	if ($('frequency_sterilizer_FEB').checked) freqSterilizer.push('FEB');
	if ($('frequency_sterilizer_MAR').checked) freqSterilizer.push('MAR');
	if ($('frequency_sterilizer_APR').checked) freqSterilizer.push('APR');
	if ($('frequency_sterilizer_MAY').checked) freqSterilizer.push('MAY');
	if ($('frequency_sterilizer_JUN').checked) freqSterilizer.push('JUN');
	if ($('frequency_sterilizer_JUL').checked) freqSterilizer.push('JUL');
	if ($('frequency_sterilizer_AUG').checked) freqSterilizer.push('AUG');
	if ($('frequency_sterilizer_SEP').checked) freqSterilizer.push('SEP');
	if ($('frequency_sterilizer_OCT').checked) freqSterilizer.push('OCT');
	if ($('frequency_sterilizer_NOV').checked) freqSterilizer.push('NOV');
	if ($('frequency_sterilizer_DEC').checked) freqSterilizer.push('DEC');
	if ($('frequency_tg_JAN').checked) freqTg.push('JAN');
	if ($('frequency_tg_FEB').checked) freqTg.push('FEB');
	if ($('frequency_tg_MAR').checked) freqTg.push('MAR');
	if ($('frequency_tg_APR').checked) freqTg.push('APR');
	if ($('frequency_tg_MAY').checked) freqTg.push('MAY');
	if ($('frequency_tg_JUN').checked) freqTg.push('JUN');
	if ($('frequency_tg_JUL').checked) freqTg.push('JUL');
	if ($('frequency_tg_AUG').checked) freqTg.push('AUG');
	if ($('frequency_tg_SEP').checked) freqTg.push('SEP');
	if ($('frequency_tg_OCT').checked) freqTg.push('OCT');
	if ($('frequency_tg_NOV').checked) freqTg.push('NOV');
	if ($('frequency_tg_DEC').checked) freqTg.push('DEC');
	if ($('frequency_ert_JAN').checked) freqErt.push('JAN');
	if ($('frequency_ert_FEB').checked) freqErt.push('FEB');
	if ($('frequency_ert_MAR').checked) freqErt.push('MAR');
	if ($('frequency_ert_APR').checked) freqErt.push('APR');
	if ($('frequency_ert_MAY').checked) freqErt.push('MAY');
	if ($('frequency_ert_JUN').checked) freqErt.push('JUN');
	if ($('frequency_ert_JUL').checked) freqErt.push('JUL');
	if ($('frequency_ert_AUG').checked) freqErt.push('AUG');
	if ($('frequency_ert_SEP').checked) freqErt.push('SEP');
	if ($('frequency_ert_OCT').checked) freqErt.push('OCT');
	if ($('frequency_ert_NOV').checked) freqErt.push('NOV');
	if ($('frequency_ert_DEC').checked) freqErt.push('DEC');
	if ($('frequency_rae_JAN').checked) freqRae.push('JAN');
	if ($('frequency_rae_FEB').checked) freqRae.push('FEB');
	if ($('frequency_rae_MAR').checked) freqRae.push('MAR');
	if ($('frequency_rae_APR').checked) freqRae.push('APR');
	if ($('frequency_rae_MAY').checked) freqRae.push('MAY');
	if ($('frequency_rae_JUN').checked) freqRae.push('JUN');
	if ($('frequency_rae_JUL').checked) freqRae.push('JUL');
	if ($('frequency_rae_AUG').checked) freqRae.push('AUG');
	if ($('frequency_rae_SEP').checked) freqRae.push('SEP');
	if ($('frequency_rae_OCT').checked) freqRae.push('OCT');
	if ($('frequency_rae_NOV').checked) freqRae.push('NOV');
	if ($('frequency_rae_DEC').checked) freqRae.push('DEC');
	if ($('frequency_medgas_JAN').checked) freqMedgas.push('JAN');
	if ($('frequency_medgas_FEB').checked) freqMedgas.push('FEB');
	if ($('frequency_medgas_MAR').checked) freqMedgas.push('MAR');
	if ($('frequency_medgas_APR').checked) freqMedgas.push('APR');
	if ($('frequency_medgas_MAY').checked) freqMedgas.push('MAY');
	if ($('frequency_medgas_JUN').checked) freqMedgas.push('JUN');
	if ($('frequency_medgas_JUL').checked) freqMedgas.push('JUL');
	if ($('frequency_medgas_AUG').checked) freqMedgas.push('AUG');
	if ($('frequency_medgas_SEP').checked) freqMedgas.push('SEP');
	if ($('frequency_medgas_OCT').checked) freqMedgas.push('OCT');
	if ($('frequency_medgas_NOV').checked) freqMedgas.push('NOV');
	if ($('frequency_medgas_DEC').checked) freqMedgas.push('DEC');
	if ($('frequency_imaging_JAN').checked) freqImaging.push('JAN');
	if ($('frequency_imaging_FEB').checked) freqImaging.push('FEB');
	if ($('frequency_imaging_MAR').checked) freqImaging.push('MAR');
	if ($('frequency_imaging_APR').checked) freqImaging.push('APR');
	if ($('frequency_imaging_MAY').checked) freqImaging.push('MAY');
	if ($('frequency_imaging_JUN').checked) freqImaging.push('JUN');
	if ($('frequency_imaging_JUL').checked) freqImaging.push('JUL');
	if ($('frequency_imaging_AUG').checked) freqImaging.push('AUG');
	if ($('frequency_imaging_SEP').checked) freqImaging.push('SEP');
	if ($('frequency_imaging_OCT').checked) freqImaging.push('OCT');
	if ($('frequency_imaging_NOV').checked) freqImaging.push('NOV');
	if ($('frequency_imaging_DEC').checked) freqImaging.push('DEC');
	if ($('frequency_neptune_JAN').checked) freqNeptune.push('JAN');
	if ($('frequency_neptune_FEB').checked) freqNeptune.push('FEB');
	if ($('frequency_neptune_MAR').checked) freqNeptune.push('MAR');
	if ($('frequency_neptune_APR').checked) freqNeptune.push('APR');
	if ($('frequency_neptune_MAY').checked) freqNeptune.push('MAY');
	if ($('frequency_neptune_JUN').checked) freqNeptune.push('JUN');
	if ($('frequency_neptune_JUL').checked) freqNeptune.push('JUL');
	if ($('frequency_neptune_AUG').checked) freqNeptune.push('AUG');
	if ($('frequency_neptune_SEP').checked) freqNeptune.push('SEP');
	if ($('frequency_neptune_OCT').checked) freqNeptune.push('OCT');
	if ($('frequency_neptune_NOV').checked) freqNeptune.push('NOV');
	if ($('frequency_neptune_DEC').checked) freqNeptune.push('DEC');
        if ($('frequency_anesthesia_JAN').checked) freqAnesthesia.push('JAN');
        if ($('frequency_anesthesia_FEB').checked) freqAnesthesia.push('FEB');
        if ($('frequency_anesthesia_MAR').checked) freqAnesthesia.push('MAR');
        if ($('frequency_anesthesia_APR').checked) freqAnesthesia.push('APR');
        if ($('frequency_anesthesia_MAY').checked) freqAnesthesia.push('MAY');
        if ($('frequency_anesthesia_JUN').checked) freqAnesthesia.push('JUN');
        if ($('frequency_anesthesia_JUL').checked) freqAnesthesia.push('JUL');
        if ($('frequency_anesthesia_AUG').checked) freqAnesthesia.push('AUG');
        if ($('frequency_anesthesia_SEP').checked) freqAnesthesia.push('SEP');
        if ($('frequency_anesthesia_OCT').checked) freqAnesthesia.push('OCT');
        if ($('frequency_anesthesia_NOV').checked) freqAnesthesia.push('NOV');
        if ($('frequency_anesthesia_DEC').checked) freqAnesthesia.push('DEC');


	var clientId = $('id').value;
	var url = '/index.php/clientManager/saveFreqApprove?legacy=' + freqLegacy.join('|') + 
		'&annual=' + freqAnnual.join('|') + 
		'&semi=' + freqSemi.join('|') + 
		'&quarterly=' + freqQuarterly.join('|') + 
		'&sterilizer=' + freqSterilizer.join('|') + 
		'&tg=' + freqTg.join('|') + 
		'&ert=' + freqErt.join('|') + 
		'&rae=' + freqRae.join('|') + 
		'&medgas=' + freqMedgas.join('|') + 
		'&imaging=' + freqImaging.join('|') + 
		'&neptune=' + freqNeptune.join('|') + 
		'&anesthesia=' + freqAnesthesia.join('|') +
		'&client_id='+clientId;
       new Ajax.Request(url, {
		method: 'get',
                evalScripts: true,
                asynchronous: false,
                onSuccess: function(transport){ 
			$('approveFreqButt').disabled = true;
			$('frequency_legacy_JAN').disabled = true;
			$('frequency_legacy_FEB').disabled = true;
			$('frequency_legacy_MAR').disabled = true;
			$('frequency_legacy_APR').disabled = true;
			$('frequency_legacy_MAY').disabled = true;
			$('frequency_legacy_JUN').disabled = true;
			$('frequency_legacy_JUL').disabled = true;
			$('frequency_legacy_AUG').disabled = true;
			$('frequency_legacy_SEP').disabled = true;
			$('frequency_legacy_OCT').disabled = true;
			$('frequency_legacy_NOV').disabled = true;
			$('frequency_legacy_DEC').disabled = true;
			$('frequency_annual_JAN').disabled = true;
			$('frequency_annual_FEB').disabled = true;
			$('frequency_annual_MAR').disabled = true;
			$('frequency_annual_APR').disabled = true;
			$('frequency_annual_MAY').disabled = true;
			$('frequency_annual_JUN').disabled = true;
			$('frequency_annual_JUL').disabled = true;
			$('frequency_annual_AUG').disabled = true;
			$('frequency_annual_SEP').disabled = true;
			$('frequency_annual_OCT').disabled = true;
			$('frequency_annual_NOV').disabled = true;
			$('frequency_annual_DEC').disabled = true;
			$('frequency_semi_JAN').disabled = true;
			$('frequency_semi_FEB').disabled = true;
			$('frequency_semi_MAR').disabled = true;
			$('frequency_semi_APR').disabled = true;
			$('frequency_semi_MAY').disabled = true;
			$('frequency_semi_JUN').disabled = true;
			$('frequency_semi_JUL').disabled = true;
			$('frequency_semi_AUG').disabled = true;
			$('frequency_semi_SEP').disabled = true;
			$('frequency_semi_OCT').disabled = true;
			$('frequency_semi_NOV').disabled = true;
			$('frequency_semi_DEC').disabled = true;
			$('frequency_quarterly_JAN').disabled = true;
			$('frequency_quarterly_FEB').disabled = true;
			$('frequency_quarterly_MAR').disabled = true;
			$('frequency_quarterly_APR').disabled = true;
			$('frequency_quarterly_MAY').disabled = true;
			$('frequency_quarterly_JUN').disabled = true;
			$('frequency_quarterly_JUL').disabled = true;
			$('frequency_quarterly_AUG').disabled = true;
			$('frequency_quarterly_SEP').disabled = true;
			$('frequency_quarterly_OCT').disabled = true;
			$('frequency_quarterly_NOV').disabled = true;
			$('frequency_quarterly_DEC').disabled = true;
			$('frequency_sterilizer_JAN').disabled = true;
			$('frequency_sterilizer_FEB').disabled = true;
			$('frequency_sterilizer_MAR').disabled = true;
			$('frequency_sterilizer_APR').disabled = true;
			$('frequency_sterilizer_MAY').disabled = true;
			$('frequency_sterilizer_JUN').disabled = true;
			$('frequency_sterilizer_JUL').disabled = true;
			$('frequency_sterilizer_AUG').disabled = true;
			$('frequency_sterilizer_SEP').disabled = true;
			$('frequency_sterilizer_OCT').disabled = true;
			$('frequency_sterilizer_NOV').disabled = true;
			$('frequency_sterilizer_DEC').disabled = true;
			$('frequency_tg_JAN').disabled = true;
			$('frequency_tg_FEB').disabled = true;
			$('frequency_tg_MAR').disabled = true;
			$('frequency_tg_APR').disabled = true;
			$('frequency_tg_MAY').disabled = true;
			$('frequency_tg_JUN').disabled = true;
			$('frequency_tg_JUL').disabled = true;
			$('frequency_tg_AUG').disabled = true;
			$('frequency_tg_SEP').disabled = true;
			$('frequency_tg_OCT').disabled = true;
			$('frequency_tg_NOV').disabled = true;
			$('frequency_tg_DEC').disabled = true;
			$('frequency_ert_JAN').disabled = true;
			$('frequency_ert_FEB').disabled = true;
			$('frequency_ert_MAR').disabled = true;
			$('frequency_ert_APR').disabled = true;
			$('frequency_ert_MAY').disabled = true;
			$('frequency_ert_JUN').disabled = true;
			$('frequency_ert_JUL').disabled = true;
			$('frequency_ert_AUG').disabled = true;
			$('frequency_ert_SEP').disabled = true;
			$('frequency_ert_OCT').disabled = true;
			$('frequency_ert_NOV').disabled = true;
			$('frequency_ert_DEC').disabled = true;
			$('frequency_rae_JAN').disabled = true;
			$('frequency_rae_FEB').disabled = true;
			$('frequency_rae_MAR').disabled = true;
			$('frequency_rae_APR').disabled = true;
			$('frequency_rae_MAY').disabled = true;
			$('frequency_rae_JUN').disabled = true;
			$('frequency_rae_JUL').disabled = true;
			$('frequency_rae_AUG').disabled = true;
			$('frequency_rae_SEP').disabled = true;
			$('frequency_rae_OCT').disabled = true;
			$('frequency_rae_NOV').disabled = true;
			$('frequency_rae_DEC').disabled = true;
			$('frequency_medgas_JAN').disabled = true;
			$('frequency_medgas_FEB').disabled = true;
			$('frequency_medgas_MAR').disabled = true;
			$('frequency_medgas_APR').disabled = true;
			$('frequency_medgas_MAY').disabled = true;
			$('frequency_medgas_JUN').disabled = true;
			$('frequency_medgas_JUL').disabled = true;
			$('frequency_medgas_AUG').disabled = true;
			$('frequency_medgas_SEP').disabled = true;
			$('frequency_medgas_OCT').disabled = true;
			$('frequency_medgas_NOV').disabled = true;
			$('frequency_medgas_DEC').disabled = true;
			$('frequency_imaging_JAN').disabled = true;
			$('frequency_imaging_FEB').disabled = true;
			$('frequency_imaging_MAR').disabled = true;
			$('frequency_imaging_APR').disabled = true;
			$('frequency_imaging_MAY').disabled = true;
			$('frequency_imaging_JUN').disabled = true;
			$('frequency_imaging_JUL').disabled = true;
			$('frequency_imaging_AUG').disabled = true;
			$('frequency_imaging_SEP').disabled = true;
			$('frequency_imaging_OCT').disabled = true;
			$('frequency_imaging_NOV').disabled = true;
			$('frequency_imaging_DEC').disabled = true;
			$('frequency_neptune_JAN').disabled = true;
			$('frequency_neptune_FEB').disabled = true;
			$('frequency_neptune_MAR').disabled = true;
			$('frequency_neptune_APR').disabled = true;
			$('frequency_neptune_MAY').disabled = true;
			$('frequency_neptune_JUN').disabled = true;
			$('frequency_neptune_JUL').disabled = true;
			$('frequency_neptune_AUG').disabled = true;
			$('frequency_neptune_SEP').disabled = true;
			$('frequency_neptune_OCT').disabled = true;
			$('frequency_neptune_NOV').disabled = true;
			$('frequency_neptune_DEC').disabled = true;
                        $('frequency_anesthesia_JAN').disabled = true;
                        $('frequency_anesthesia_FEB').disabled = true;
                        $('frequency_anesthesia_MAR').disabled = true;
                        $('frequency_anesthesia_APR').disabled = true;
                        $('frequency_anesthesia_MAY').disabled = true;
                        $('frequency_anesthesia_JUN').disabled = true;
                        $('frequency_anesthesia_JUL').disabled = true;
                        $('frequency_anesthesia_AUG').disabled = true;
                        $('frequency_anesthesia_SEP').disabled = true;
                        $('frequency_anesthesia_OCT').disabled = true;
                        $('frequency_anesthesia_NOV').disabled = true;
                        $('frequency_anesthesia_DEC').disabled = true;

                    $('dom_input').innerHTML ="<input type='button' value='Unlock Freq' id = 'approveFreqButt' onclick='unlockFreq()'>";
                }
              }
	   ); 
}
function checkClientDelete(){
result = confirm('Are you sure you want to delete this client?');
if(result)
    return true;
else
    return false;
}

var display_move = false;
function sureBmove(){
 res = confirm('Are you sure that you want to move device?');
 if(!res)
   return;

 $('moveDeviceCont').show();
}

function sureBmoveHide(){
 $('moveDeviceCont').hide();
}
function moveDevice(){
  $('move_stats').hide();
  clientId = $('move_client_id').selectedIndex;
  deviceId = $('m_device_id').value; 
  new Ajax.Request(
        '/index.php/clientManager/moveDevice?client_id='+clientId+'&device_id='+deviceId,
        {
		method: 'post',
                evalScripts: true,
                asynchronous: false,
		onSuccess: function(transport){
		   d_response = transport.responseText;
    
  		   var json = eval( '(' + d_response + ')' ); 

		   var res = json.status;
                   if(res == 'client_not_found'){
                      $('move_stats').innerHMTL = 'Client not found!!';
                      $('move_stats').show();
                 
                   }else if(res == 'device_not_found'){
                     
                      $('move_stats').innerHMTL = 'Client not found!!';
                      $('move_stats').show();
                     
                   }else
                      sureBmoveHide();
		}
	}//object
        );
}
