<?php use_helper('Object'); ?>
<?php use_helper('Javascript'); ?>
<?php use_helper('DateForm'); ?>

	<div class="client_select">
		<?php echo form_tag('scheduler/index'); ?>
			<table><tr>
				<td width=50><b>Client: </b></td>
				<td><?php echo $client->getClientName(); ?></td>
			</tr></table>
			</form> 
		</div>
		<div class="job_details">
			<?php echo form_tag('scheduler/jobScheduler', array('id' => 'jobScheduler')); ?>
			<?php echo input_hidden_tag('client_select', $client->getId()); ?>
			<?php echo input_hidden_tag('start_time'); ?>
			<?php echo input_hidden_tag('end_time'); ?>
			<?php echo input_hidden_tag('date', $date); ?>
			<?php echo input_hidden_tag('workorder_id', $workorder_id); ?>
			<?php echo input_hidden_tag('job_status', 'scheduled'); ?>
			<?php echo input_hidden_tag('job_date', $date); ?>
			<?php echo input_hidden_tag('edit', $mode); ?>
			<?php echo input_hidden_tag('technician'); ?>
			<table><tr>
				<td>Device: </td>
				<td><?php   if (isset($specification_options))
							{
								echo select_tag('specification_select', options_for_select($specification_options, $specification_select), array(
											'onChange' => 'populateDeviceMenu()'));
		
							} else {
								echo 'Please Select a Client...';
							} ?></td>
			</tr><tr>
				<td>Device ID: </td>
				<td><div id=device><?php echo select_tag('device_select', options_for_select($device_options)); ?></div></td>
			</tr><tr>
				<td>Reason: </td>
				<td><?php echo select_tag('reason_select', objects_for_select($reason_dropdown, 'getid', 'getvalue'), $edit_workorder->getReason()); ?></td>
			</tr><tr>
				<td>Notes: </td>
				<td><?php echo textarea_tag('notes', $edit_workorder->getRemarks() , 'size=25x3'); ?></td>
			</tr></table>
		</div>
		<div class="tech_details">
			<table><tr>
				<td>Technician: </td>
				<td colspan=2><div id='selectTech'><?php echo $technician->getLastName().', '.$technician->getFirstName(); ?></div></td>
			</tr><tr>
				<td>job date:</td>
				<td><div id="display_date"><?php echo input_date_tag('job_date', $date); ?></div></td>
			</tr><tr>
				<td>start time: </td>
				<td><?php echo  input_tag('start_time_hours', $start_time_hours , array(
									'size' => '2',
									'maxlength' => '2')).' : '.
								input_tag('start_time_minutes', $start_time_minutes, array(
									'size' => '2',
									'maxlength' => '2')); ?></td>
				<td><?php echo radiobutton_tag('start_time_ampm[]','am', true).'am '.' '.
							   radiobutton_tag('start_time_ampm[]','pm', false).'pm'; ?></td>
			</tr><tr>
				<td>end time: </td>
				<td><?php echo 	input_tag('end_time_hours', $end_time_hours, array(
									'size' => '2',
									'maxlength' => '2')).' : '.
								input_tag('end_time_minutes', $end_time_minutes, array(
									'size' => '2', 
									'maxlength' => '2')); ?></td>
				<td><?php echo radiobutton_tag('end_time_ampm[]','am', true).'am '.' '.
							   radiobutton_tag('end_time_ampm[]','pm', false).'pm'; ?></td>
			</tr><tr>
				<td><?php echo button_to('Schedule New', 'scheduler/index'); ?></td>
				<td><?php echo button_to('Delete Job', 'scheduler/deleteJob?id='.$edit_workorder->getId(), array('confirm' => 'Are you sure you want to delete this job?')); ?></td> 
<?php //				<td><?php echo button_to('Delete Job', 'scheduler/deleteJob?workorder_id='.$edit_workorder->getId(), array('onClick' => "confirm('Are you sure you want to delete this job?')")); </td> ?>
				<td><?php echo submit_tag('Save Job'); ?></td>
			</tr></table>
		</div>
		</form>
