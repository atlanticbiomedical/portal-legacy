<?php use_helper('Javascript'); ?>
<?php use_helper('Object'); ?>

<?php 
	$api_key = sfConfig::get('app_google_maps_api_key');
	echo javascript_include_tag('http://maps.google.com/maps?file=api&amp;v=2&amp;key='.$api_key); ?>

<!-- Javascript Calander -->
<?php 
	echo javascript_include_tag('jscalendar/calendar'); 
	echo javascript_include_tag('jscalendar/lang/calendar-en');

	echo javascript_tag("

	Event.observe(window, 'load', initFunctions, false);

	function initFunctions(evt)
	{
    	showFlatCalendar();
        load()
	}"); ?>

<?php echo javascript_tag("

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

	function flatSelected(cal, date)
	{
		document.getElementById('date').value = date;
		var el = document.getElementById('display_date');
		el.innerHTML = date;".
		remote_function(array(
			'update' => 'techDisplay',
			'url' => 'scheduler/populateTechDisplay',
			'with' => '"date=" + date')).";"."

	}

	function showFlatCalendar()
	{".
		//initiate TechDisplay
		remote_function(array(
			'update' => 'techDisplay',
			'url' => 'scheduler/populateTechDisplay',
			'with' => '"date='.$date.'"')).";"."

		var parent = document.getElementById('display');

		// construct a calendar giving only the 'selected' handler.
		var cal = new Calendar(0, null, flatSelected);

		// hide week numbers
		cal.weekNumbers = false;

		// We want some dates to be disabled; see function isDisabled above
		//cal.setDisabledHandler(isDisabled);
		//cal.setDateFormat('%A, %B %e');

		// this call must be the last as it might use data initialized above; if
		// we specify a parent, as opposite to the 'showCalendar' function above,
		// then we create a flat calendar -- not popup.  Hidden, though, but...
		cal.create(parent);

		// ... we can show it here.
		cal.show();
	}
"); ?>


<!--////////////////Map stuff///////////////-->
<?php echo javascript_tag("

	function load() 
	{
		if (GBrowserIsCompatible())
		{
			var map = new GMap2(document.getElementById('map'));
			map.setCenter(new GLatLng(37.4419, -122.1419), 13);
		}

		if (window.XMLHttpRequest) 
		{
			xmlhttp = new XMLHttpRequest();
        	xmlhttp.overrideMimeType('text/xml');
	    } else if (window.ActiveXObject) 
		{
        	xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
		}
		
	}

"); ?>

<?php echo input_hidden_tag('date', $date); ?>

<div id = 'emailPopUp' style='display:none'>

</div>	
<div id="leftCol">
	<div id="dashMap">
		<div id="map" style="width: 350px; height: 250px"></div>
	</div>

	<div id="dashTech">
		<div id="techDisplay">
	</div>
</div>

<div id="rightCol">
	<div id="dashCal">
		<div id="display"></div>
		<div id="preview"></div>
	</div>

	<div id="dashPendingJobs">
	</div>
</div>

