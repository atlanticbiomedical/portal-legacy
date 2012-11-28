<div class='regularCont'>
<div class='innerCont'><table border="0">
<tr>
<td style='width: 100px'>Report
</td>
<td style='width: 100px'>Status
</td>
<td style='width: 200px'>
Date
</td>
<td >
Action
</td>
</tr>
<?php 
foreach($finalReport as $report){
?>
<tr>
<td>
<a target='_blank' href='/index.php/process/createPdf/id/<?php print $report->getId(); ?>'>View</a>
</td>
<td>
<?php print ucwords($report->getPassFail()); ?>
</td>
<td>
<?php print $report->formattedDate(); ?>
</td>
<td>
<a href='javascript:void(0)' onclick='deleteReport(<?php print $report->getId(); ?>,<?php print $report->getClientId(); ?>)' >Delete</a>
</td>
</tr>
<?php
}
if(empty($finalReport)){
?>
<tr><td colspan='4'><div style='text-align:center;font-weight:bold;'>No Reports Found</div></td></tr>
<?php
}
?>
</table>
</div>
</div>
