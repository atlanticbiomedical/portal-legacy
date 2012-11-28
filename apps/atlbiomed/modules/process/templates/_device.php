 
          <? if(empty($devices)) {?>
          	  <option value='-1'>No Device</option>
          <? }else{?>
          	  <option value='-2'>Select A Device</option>
          	  <?php
			}?>
			<?php foreach($devices as $device) { ?>
				   <option value='<?print $device->getIdentification(); ?>'><?print $device->getIdentification(); ?></option>
			<?php } ?>
 