<?php use_helper('Javascript') ?>
<div><h2>Mon:<img src='/images/pins/pin_red1.png' /> Tue:<img src='/images/pins/pin_blue1.png' /> Wed: <img src='/images/pins/pin_orange1.png' /> Thu:<img src='/images/pins/pin_green1.png' /> Fri: <img src='/images/pins/pin_grey1.png' /> </h2></div>
<?php 

echo $map->getMapJS();

echo javascript_tag("
	
Event.observe(window, 'load', showMap, false);

function showMap(evt)
{
	onLoad();
}
");

echo $map->getMapHtml();

?>
