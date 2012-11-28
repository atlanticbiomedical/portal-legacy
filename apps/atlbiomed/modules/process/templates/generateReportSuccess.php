<div class='regularCont'>
<div class='innerCont'><table>
<tr>
<td style='width: 100px'>Report
</td>
<td style='width: 100px'>Status
</td>
<td style='width: 200px'>
Date
</td>
<td style='width: 50px'>
Pass
</td>
<td style='width: 50px'>
Fail
</td>
<td style='width: 50px'>
Missed
</td>
<td style='width: 50px'>
Bp
</td>
<td style='width: 50px'>
Trace
</td>
<td style='width: 50px'>
Outlets
</td>
<td style='width: 200px'>
Action
</td>
</tr>
<?php 
foreach($finalReport as $report){
?>
<tr>
<td>
<a target='_blank' href='/index.php/process/createPdf/id/<?php print $report->getId(); ?>'>View Report</a>
</td>
<td>
<?php print ucwords($report->getPassFail()); ?>
</td>
<td>
<?php print $report->formattedDate(); ?>
</td>
<td> 
<?php print (int)$report->getTotalPassed(); ?>
</td>
<td> 
<?php print (int)$report->getTotalFailed(); ?>
</td>
<td> 
<?php print (int)$report->getTotalMissed(); ?>
</td>
<td> 
<?php print (int)$report->getTotalBp(); ?>
</td>
<td> 
<?php print (int)$report->getTotalTrace(); ?>
</td>
<td> 
<?php print (int)$report->getTotalOutlets(); ?>
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
