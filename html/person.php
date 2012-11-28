<?php
require('GoogleMapAPI.class.php');

   $map = new GoogleMapAPI('map');
   
 $map->setAPIKey('ABQIAAAA-lOCgnfgftWr6pQPbnlcXxT_Zl4PyHT40A5WO2t7T_qjZPUm6hQeiVm00jyZL60QWtXBtvYLMLkmKg');
 $map->addMarkerByAddress('910 east 35th brooklyn ny 11210','Grandpa House','<b>Check it out its grandpa\'s house</b>'); 
 $map->addMarkerIcon('/images/pin_green1.png');
 $map->addMarkerByAddress('1934 hamlet drive tobyhanna pa 18466','Grandpa House','<b>Check it out its grandpa\'s house</b>');
 $map->addMarkerIcon('/images/pin_green2.png');
 $map->addMarkerByAddress('2900 Bedford Avenue, Brooklyn, NY 11210','Grandpa House','<b>Check it out its grandpa\'s house</b>');
 $map->addMarkerIcon('/images/pin_green3.png');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
    <head>
    <?php $map->printHeaderJS(); ?>
    <?php $map->printMapJS(); ?>
    <!-- necessary for google maps polyline drawing in IE -->
    <style type="text/css">
      v\:* {
        behavior:url(#default#VML);
      }
    </style>
    </head>
    <body onload="onLoad()">
    <table border=1>
    <tr><td>
    <?php $map->printMap(); ?>
    </td><td>
    <?php $map->printSidebar(); ?>
    </td></tr>
    </table>
    </body>
    </html>