<div class="container">
	<div class="row">
		
		<?php if ( !empty ($errors) ): ?>
			<div class="alert alert-error">
				<?php foreach ($errors as $error): ?>
					<div>
						<strong><?php echo __('Error!'); ?> </strong>
						<br /><?php echo $error; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
	
	<a href="/projectAdmin/add/" class="btn btn-primary hidden-print"><?php echo __('Add New Project'); ?></a>
	<div class="smallDevicesView">
		<table class="table table-striped display">
			<thead>
				<tr>
					<th></th>
					<th><?php echo __( 'Project Name' ); ?></th>
					<th><?php echo __( 'Status' ); ?></th>
					<th><?php echo __( 'Manager' ); ?></th>
					<th><?php echo __( 'Company' ); ?></th>
				</tr>
			</thead>
			<tbody>
			<?php for ( $i=0; $i<count($projects); $i++ ) { ?>
				<tr>
					<td><?php echo $i+1; ?></td>
					<td><a href="/projectAdmin/viewProject/<?php echo $projects[$i]['Company']['company_id']; ?>/<?php echo $projects[$i]['Project']['proj_id']; ?>"><?php echo $projects[$i]['Project']['proj_name']; ?></a></td>
					<td><?php echo $projects[$i]['ProjectStatus']['status_name']; ?></td>
					<td><?php echo $projects[$i]['ProjectManager']['first_name']; ?></td>
					<td><?php echo $projects[$i]['Company']['company_name']; ?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
			
	<div class="largeDevicesView">
		<table class="table table-striped display" id="project">
			<thead>
				<tr>
					<th></th>
					<th><?php echo __( 'Project Name' ); ?></th>
					<th><?php echo __( 'Description' ); ?></th>
					<th><?php echo __( 'Status' ); ?></th>
					<th><?php echo __( 'Manager' ); ?></th>
					<th><?php echo __( 'Company' ); ?></th>
				</tr>
			</thead>
			
			<tfoot>
				<tr>
					<th></th>
					<th><?php echo __( 'Project Name' ); ?></th>
					<th><?php echo __( 'Description' ); ?></th>
					<th><?php echo __( 'Status' ); ?></th>
					<th><?php echo __( 'Manager' ); ?></th>
					<th><?php echo __( 'Company' ); ?></th>
				</tr>
			</tfoot>
			
			<tbody>
			<?php for ( $i=0; $i<count($projects); $i++ ) { ?>
				<tr>
					<td><?php echo $i+1; ?></td>
					<td><a href="/projectAdmin/viewProject/<?php echo $projects[$i]['Company']['company_id']; ?>/<?php echo $projects[$i]['Project']['proj_id']; ?>"><?php echo $projects[$i]['Project']['proj_name']; ?></a></td>
					<td><?php echo $projects[$i]['Project']['proj_desc']; ?></td>
					<td><?php echo $projects[$i]['ProjectStatus']['status_name']; ?></td>
					<td><?php echo $projects[$i]['ProjectManager']['first_name']; ?></td>
					<td><?php echo $projects[$i]['Company']['company_name']; ?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
	</div>
</div>


<script type='text/javascript'>
  $(document).ready(function () {		
		$('#project').dataTable();
  });
</script>