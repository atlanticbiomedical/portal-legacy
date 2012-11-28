
<script type="text/javascript" src="/sf/prototype/js/prototype.js"></script>

<script type="text/javascript" src="/sf/calendar/calendar.js"></script>
<script type="text/javascript" src="/sf/calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="/sf/calendar/calendar-setup.js"></script>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="autotab.js"></script>
<script src="scriptaculous/lib/prototype.js" type="text/javascript"></script>
<script src="scriptaculous/src/effects.js" type="text/javascript"></script>
<script type="text/javascript" src="validation.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="/css/main.css" />

<link rel="stylesheet" type="text/css" media="screen" href="/css/client.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/user.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/theme.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/sf/calendar/skins/aqua/theme.css" />

 
<div id="main">
<center>
<br/>

	<?php echo form_tag('messages/index', array('id'=>'test')) ?>
<fieldset>
  
  <label for="for">For </label>
  <select name="for" class="half">
  <option value="allison.wolcott@atlanticbiomedical.com">Allison Wolcott</option>
  <option value="caendres1@gmail.com">Carl Endres</option>
  <option value="chris.endres@atlanticbiomedical.com"   selected="selected">Chris Endres</option>
  <!--

  <option value="niles.armstrong@atlanticbiomedical.com">Niles Armstrong</option>
  <option value="eric.frasse@atlanticbiomedical.com">Eric Frasse</option>
  -->
  <option value="ryan.foley@atlanticbiomedical.com">Ryan Foley</option>  
  <option value="will.turner@atlanticbiomedical.com">Will Turner</option>
  <option value="kelli.kirk@atlanticbiomedical.com">Kelli Kirk</option>
  </select>
  
  <div class="form-row">
  <label for="name" class="name">Name </label>
  <input type="text" name="name" id="name" class="validate-name half" />
  <div class="form-row-ff"></div>
  </div>
  
  <div class="form-row">
  <label for="company">Company </label>
  <input type="text" name="company" class="validate-company" />
  <div class="form-row-ff"></div>
  </div>
  
  <div class="form-row"><span id="bug">	
  <label for="phone">Phone </label>
  <input type="text" name="phone" onKeyUp="return autoTab(this, 3, event);" maxlength="3" size="3" class="validate-phone phone" />
  <input type="text" name="phone-2" onKeyUp="return autoTab(this, 3, event);" maxlength="3" size="3" class="validate-phone phone" />
  <input type="text" name="phone-3" onKeyUp="return autoTab(this, 4, event);" maxlength="4" size="4" class="validate-phone phone3" />
  <label for="ext" class="ext">ext. </label>
  <input type="text" name="ext" size="4" class="phone" />
  <label for="time_to_call" class="time">Time To Call</label>
  <input type="text" name="time_to_call" class="phone" /></span>
  </div>
  
  <span style="display:inline-block"><label for="mobile">Mobile </label>
  <input type="text" name="mobile" onKeyUp="return autoTab(this, 3, event);" maxlength="3" size="3" class="phone" />
  <input type="text" name="mobile-2" onKeyUp="return autoTab(this, 3, event);" maxlength="3" size="3" class="phone" />
  <input type="text" name="mobile-3" onKeyUp="return autoTab(this, 4, event);" maxlength="4" size="4" class="phone3" />
  <label for="time_to_call_mobile" class="time2">Time To Call</label>
  <input type="text" name="time_to_call_mobile" class="phone" /></span>
  
  <span style="display:inline-block"><label for="fax">Fax </label>
  <input type="text" name="fax" onKeyUp="return autoTab(this, 3, event);" maxlength="3" size="3" class="phone" />
  <input type="text" name="fax-2" onKeyUp="return autoTab(this, 3, event);" maxlength="3" size="3" class="phone" />
  <input type="text" name="fax-3" onKeyUp="return autoTab(this, 4, event);" maxlength="4" size="4" class="phone3" /></span>
  
  <span style="display:inline-block"><div id="checkboxes"> 
  <label for="telephoned" class="row1_label">Telephoned </label>
  <input type="checkbox" name="telephoned" />
  
  <label for="came_to_see_you" class="row2_label">Came To See You </label>
  <input type="checkbox" name="came_to_see_you" />
  
  <label for="wants_to_see_you" class="row3_label">Wants To See You </label>
  <input type="checkbox" name="wants_to_see_you" />
  
  <label for="returned_your_call" class="row1_label">Returned Your Call </label>
  <input type="checkbox" name="returned_your_call" />
  
  <label for="please_call" class="row2_label">Please Call </label>
  <input type="checkbox" name="please_call" />
  
  <label for="will_call_again" class="row3_label">Will Call Again </label>
  <input type="checkbox" name="will_call_again" />
  
  <label for="rush" class="row1_label">Rush </label>
  <input type="checkbox" name="rush" />
  
  <label for="special_attention" class="row2_label">Special Attention </label>
  <input type="checkbox" name="special_attention" />
  </div></span>
  
  <div class="form-row">
  <label for="callers_message" id="message">Message </label>
  <textarea name="callers_message" cols="10" rows="10" class="validate-message"></textarea>
  <div class="form-row-ff"></div>
  </div>
  
  <input type="submit" value="Submit Message" class="button" />
  
  <div class="form-row">
  
  <div class="form-row-ff"></div>
  </div>
  
</fieldset>
</form> 
<script type="text/javascript">
						
						
						var valid = new Validation('test', {immediate : true});
						
						Validation.addAllThese([
							['validate-name', 'A name is required.', function(v){
								return !Validation.get('IsEmpty').test(v);
							}],
							['validate-company', 'A company is required.', function(v){
								return !Validation.get('IsEmpty').test(v);
							}],
							['validate-phone', 'A phone number is required.', function(v){
								return !Validation.get('IsEmpty').test(v);
							}],
							['validate-message', 'A message is required.', function(v){
								return !Validation.get('IsEmpty').test(v);
							}]
						]);
						
					</script>
</center><br/>
</div>
