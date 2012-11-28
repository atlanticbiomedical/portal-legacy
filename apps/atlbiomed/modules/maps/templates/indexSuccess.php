<?php use_helper('Javascript') ?>
<?php use_helper('Object') ?>

<div class="content" style="padding: 5px;">
	<div class="mapsCollapsingPanelContainer">
		<?php echo form_tag('maps/index'); ?>
			<?php include_partial('global/collapsingDivContainer',
								  array('title' => 'Filter by Status',
								  		'uniqueId' => 'filterByStatus',
								  		'content' => object_select_tag($bogusWorkOrder, 'getJobStatusId', 'include_custom=All', ''))); ?>

			<?php include_partial('global/collapsingDivContainer',
								  array('title' => 'Filter by Job Type',
								  		'uniqueId' => 'filterByJType',
								  		'content' => object_select_tag($bogusWorkOrder, 'getJobTypeId', 'include_custom=All', ''))); ?>
								  			
			<?php include_partial('global/collapsingDivContainer',
								  array('title' => 'Filter by Technician',
								  		'uniqueId' => 'filterByTechnician',
								  		'content' => select_tag('technicianId', 
								  								options_for_select($technicians, 
																		 		   $bogusWorkOrder->getTech(), 
																		 		   'include_custom=All')))); ?>

			<?php include_partial('global/collapsingDivContainer',
								  array('title' => 'Filter by Date',
								  		'uniqueId' => 'filterByDate',
								  		'content' => get_partial('mapDateFilterControl', 
								  								 array('initialDate' => $dateFilter,
								  								 	   'dateFilterType' => $dateFilterType)))); ?>
								  			
			<div class="mapsCollapsingPanelContainerControl">
				<?php echo submit_tag('Filter'); ?>				
			</div>
			
			<div class="mapsCollapsingPanelContainerControl">
				<hr />
			</div>
			
			<div class="mapsCollapsingPanelContainerControl">
				<h3><?php echo link_to('View all Client Locations', 'maps/index?viewMode=1'); ?></h3>
			</div>			
		</form>
	</div>
	
	
	<div style="float: left; display: inline; border: 1px solid black;">
		<?php include_component('maps', 'displayTechnicianMap', array('markers' => $markers, 'mapwidth' => '800px')); ?>
	</div>
</div>
