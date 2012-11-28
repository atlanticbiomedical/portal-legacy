<?php use_helper('Object'); ?>
<?php use_helper('Validation'); ?>
<?php use_helper('Javascript'); ?>

<?php 
	
	$validation_error = '';	

/*	echo javascript_tag("
		function submitForm()
		{
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
		}

		function getQualifications(id)
		{
			alert('Shit\'s Wurkin\'');
			".

			remote_function(array(
				'update' => 'qualifications',
				'url' => 'userManager/qualifications',
				'with' => '"tech_id=" + id')).
		" } 

");*/

/*	echo javascript_tag("
		function getQualifications(user)
		{".
			remote_function(array(
				'update' => 'qualifications',
				'url' => 'userManager/qualifications',
				'with' => '"techId=" + user'))."
		} ");*/ ?>
	

<?php 

	if ($sf_request->hasErrors())
	{
		/*foreach($sf_request->getErrors() as $name => $error)
		{
			$validation_error .= $error;
//			echo '-'.$error."<br />";
		}
		echo javascript_tag("alert('".$validation_error."');");*/
	} else {
		if($saveStatus == 'success')
		{
			echo javascript_tag("alert('User information saved successfully')");
		}
	}
?>


<div class="userForm">

<?php echo form_tag('userManager/addUser'); ?>
<?php echo input_hidden_tag('mode', $mode); ?>
<?php echo input_hidden_tag('id', $populateUser->getId()); ?>


<table>
	<tr>
		<td colspan=2><?php echo form_error('user_name'); ?></td>
	</tr>
	<tr>
		<td width="100">User Name</td>
		<td><?php echo input_tag('user_name', $populateUser->getUserName()); ?></td>
	</tr>
	<tr>
		<td colspan=2><?php echo form_error('first_name'); ?></td>
	</tr>
	<tr>
		<td>First Name</td>
		<td><?php echo input_tag('first_name', $populateUser->getFirstName()); ?></td>
	</tr>
	<tr>
		<td colspan=2><?php echo form_error('last_name'); ?></td>
	</tr>
	<tr>
		<td>Last Name</td>
		<td><?php echo input_tag('last_name', $populateUser->getLastName()); ?></td>
	</tr>
	<tr>
		<td colspan=2><?php echo form_error('email'); ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><?php echo input_tag('email', $populateUser->getEmail()); ?></td>
	</tr>
	<tr>
		<td colspan=2><?php echo form_error('verify_email'); ?></td>
	</tr>
	<tr>
		<td>Verify Email</td>
		<td><?php echo input_tag('verify_email', $populateUser->getEmail()); ?></td>
	</tr>
	<tr>
		<td colspan=2><?php echo form_error('phone'); ?></td>
	</tr>
	<tr>
		<td>Phone</td>
		<td><?php echo input_tag('phone', $populateUser->getPhone()); ?></td>
	</tr>
	<tr>
		<td colspan=2><?php echo form_error('address'); ?></td>
	</tr>
	<tr>
		<td>Address</td>
		<td><?php echo input_tag('address', $populateUser->getAddress()); ?></td>
	</tr>
	<tr>
		<td colspan=2></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo input_tag('address_2'); ?></td>
	</tr>
	<tr>
		<td colspan=2><?php echo form_error('city', $populateUser->getAddress2()); ?></td>
	</tr>
	<tr>
		<td>City</td>
		<td><?php echo input_tag('city', $populateUser->getCity()); ?></td>
	</tr>
	<tr>
		<td colspan=2><?php echo form_error('state'); ?></td>
	</tr>
	<tr>
		<td>State</td>
		<td><?php echo select_tag('state', options_for_select(array(
					'' => 'Please Select...',
					'AL' => 'Alabama',
					'AK' => 'Alaska',
					'AZ' => 'Arizona',
					'AR' => 'Arkansas',
					'CA' => 'California',
					'CO' => 'Colorado',
					'CT' => 'Connecticut',
					'DE' => 'Delaware',
					'DC' => 'District of Columbia',
					'FL' => 'Florida',
					'GA' => 'Georgia',
					'HI' => 'Hawaii',
					'ID' => 'Idaho',
					'IL' => 'Illinois',
					'IN' => 'Indiana',
					'IA' => 'Iowa',
					'KS' => 'Kansas',
					'KY' => 'Kentucky',
					'LA' => 'Louisiana',
					'ME' => 'Maine',
					'MD' => 'Maryland',
					'MA' => 'Massachusetts',
					'MI' => 'Michigan',
					'MN' => 'Minnesota',
					'MS' => 'Mississippi',
					'MO' => 'Missouri',
					'MT' => 'Montana',
					'NE' => 'Nebraska',
					'NV' => 'Nevada',
					'NH' => 'New Hampshire',
					'NJ' => 'New Jersey',
					'NM' => 'New Mexico',
					'NY' => 'New York',
					'NC' => 'North Carolina',
					'ND' => 'North Dakota',
					'OH' => 'Ohio',
					'OK' => 'Oklahoma',
					'OR' => 'Oregon',
					'PA' => 'Pennsylvania',
					'RI' => 'Rhode Island',
					'SC' => 'South Carolina',
					'SD' => 'South Dakota',
					'TN' => 'Tennessee',
					'TX' => 'Texas',
					'UT' => 'Utah',
					'VT' => 'Vermont',
					'VA' => 'Virginia',
					'WA' => 'Washington',
					'WV' => 'West Virginia',
					'WI' => 'Wisconsin',
					'WY' => 'Wyoming'), $populateUser->getState())); ?></td>
	</tr>
	<tr>
		<td colspan=2><?php echo form_error('zip'); ?></td>
	</tr>
	<tr>
		<td>Zip</td>
		<td><?php echo input_tag('zip', $populateUser->getZip()); ?></td>
	</tr>
	<tr>
	<?php 
	if ($mode != 'edit') 
	{	  
	?>
		<td colspan=2><?php echo form_error('password'); ?></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><?php echo input_password_tag('password', $populateUser->getPassword()); ?></td>
	</tr>
	<tr>
		<td colspan=2><?php echo form_error('verify_password'); ?></td>
	</tr>
	<tr>
		<td>Verify password</td>
		<td><?php echo input_password_tag('verify_password', $populateUser->getPassword()); ?></td>
	</tr>
	<tr>
	<?php 
	}
	 ?>
		<td colspan=2><?php echo form_error('user_type'); ?></td>
	</tr>
	<tr>
		<td>User type</td>
		<td><?php echo select_tag('user_type_id', objects_for_select($userTypes, 'getId', 'getTypeName', $populateUser->getUserTypeId()));
			//select_tag('user_type_id', objects_for_select($user_type_request,'getvalue'), $populateUser->getUserTypeId()); ?>		</td>
	</tr>
	<tr>
		<td>Start time</td>
		<td><?php echo input_tag('start_time_hours', $start_time_hours, array('size' => '1', 'maxlength' => '2')).' : '
		.input_tag('start_time_minutes' , $start_time_minutes , array('size' => '1', 'maxlength' => '2'))
		.' '.radiobutton_tag('start_time_ampm','am', $start_time_am).'am '.' '
		.radiobutton_tag('start_time_ampm','pm', $start_time_pm).'pm'; ?></td>
	</tr>
	<tr>
		<td>End Time</td>
		<td><?php echo input_tag('end_time_hours', $end_time_hours, array('size' => '1', 'maxlength' => '2')).' : '
		.input_tag('end_time_minutes' , $end_time_minutes , array('size' => '1', 'maxlength' => '2'))
		.' '.radiobutton_tag('end_time_ampm','am', $end_time_am).'am '.' '
		.radiobutton_tag('end_time_ampm','pm', $end_time_pm).'pm'; ?></td> 
	</tr>
	<tr>
		<td>Order Weight</td>
		<td><?php echo select_tag('order_weight', options_for_select(array(
					'' => 'Select...',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5','6' => '6','7' => '7','8' => '8','9' => '9','10' => '10','11' => '11','12' => '12',
'13' => '13','14' => '14','15' => '15','16' => '16','17' => '17','18' => '18','19' => '19','20' => '20'
                                         ), $populateUser->getWeight())); ?></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><?php echo submit_tag('Save'); ?></td>
	</tr>
</table>
</form>
</div>

<div class="currentUsers">

<?php echo form_tag('userManager/deleteUser'); ?>
<!-- Display all current users -->
<table cellspacing='10'><tr>
<!--	<td></td> -->
	<td><b><u>Name</u></b></td>
	<td><b><u>User Type</u></b></td>
</tr><tr>
	<?php foreach ($current_user as $user){ ?>
<!--		<td><?php //echo radiobutton_tag('delete_user', $user->getId(), false); ?></td> -->
		<td><?php echo link_to(ucfirst($user->getLastName()).', '.ucfirst($user->getFirstName()), 'userManager/index?mode=edit&id='.$user->getId()); ?></td> 
<?php //		<td><?php echo link_to_function(ucfirst($user->getLastName()).', '.ucfirst($user->getFirstName()), 'getQualifications('.$user->getId().')'); </td> ?>
		<td><?php echo $user->getUserType()->getTypeName(); ?></td>
		</tr><tr>
		<?php } ?>
</tr>
	<td><?php echo button_to('New User', 'userManager/index');echo input_hidden_tag('delete_user', $populateUser->getId()); ?></td>
	<td><?php echo submit_tag('Delete User'); ?></td>
</tr></table>
</form>	

</div>

<div id="qualifications">
<?php
?>
</div>
