<?php echo radiobutton_tag('dateFilterType', 'year', $dateFilterType == 'year') ?>By Selected Year<br />
<?php echo radiobutton_tag('dateFilterType', 'month', $dateFilterType == 'month') ?>By Selected Month<br />
<?php echo radiobutton_tag('dateFilterType', 'week', $dateFilterType == 'week') ?>By Selected Week (selected day plus seven days)<br />
<?php echo radiobutton_tag('dateFilterType', 'day', $dateFilterType == 'day') ?>By Selected Day<br />

<?php echo input_date_tag('jobDate', $initialDate, 'rich=true'); ?>
