<?php use_helper('Validation') ?>
<?php echo form_tag('security/index'); ?>
	<div class="loginForm">
		<div class="loginFormInner">
			<?php echo form_error('username') ?><br />
			<?php echo form_error('password') ?><br />
			<fieldset >
				<legend>Please Log In</legend>
				<div class="loginFormInnerRow">
					<div>
						<label for="username">Username:</label>
					</div>
					<div>
						<?php echo input_tag('username'); ?>
					</div>
				</div>
				<div class="loginFormInnerRow">
					<div>
						<label for="password">Password:</label>
					</div>
					<div>
						<?php echo input_password_tag('password'); ?>
					</div>
				</div>
				<div class="loginFormInnerRow">
					<div></div>
					<div><?php echo submit_tag('Login'); ?></div>
				</div>
			</fieldset>
		</div>
	</div>
</form>