<?php echo $this->element('dataTables'); ?>

<div class="container">
	<div class="row container">
		<div class="container">
			<h3><?php echo __( 'Company List' ); ?></h3>
			
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
			
		<div class="container">
			<table class="table table-striped display" id="project">
				<thead>
					<tr>
						<th></th>
						<th><?php echo __( 'Project Name' ); ?></th>
						<th><?php echo __( 'Company' ); ?></th>
						<th><?php echo __( '#of User' ); ?></th>
						<th><?php echo __( 'Project Status' ); ?></th>
					</tr>
				</thead>
				
				<tfoot>
					<tr>
						<th></th>
						<th><?php echo __( 'Project Name' ); ?></th>
						<th><?php echo __( 'Company' ); ?></th>
						<th><?php echo __( '#of User' ); ?></th>
						<th><?php echo __( 'Project Status' ); ?></th>
					</tr>
				</tfoot>
				
				<tbody>
				<?php for ( $i=0; $i<count($projects); $i++ ) { ?>
					<tr>
						<td><?php echo $i+1; ?></td>
						<td><a href="/project/viewProject/<?php echo $projects[$i]['Project']['proj_id']; ?>"><?php echo $projects[$i]['Project']['proj_name']; ?></a></td>
						<td></td>
						<td></td>
						<td></td>
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