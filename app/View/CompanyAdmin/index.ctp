<?php echo $this->element('dataTables'); ?>

<div class="container">
		<div class="row container">			
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
		</div>
		
		
		<div class="row container smallDevicesView">
			<a href="/companyAdmin/add" class="btn btn-primary fullwidth"><?php echo __( 'Add New Company' ); ?></a>
			<table class="table table-striped">
				<?php for ( $i=0; $i<count($companies); $i++ ) { ?>
					<tr>
						<td><?php echo $i+1; ?></td>
						<td><a href="/companyAdmin/viewCompany/<?php echo $companies[$i]['Company']['company_id']; ?>"><?php echo $companies[$i]['Company']['company_name']; ?></a></td>
					</tr>
				<?php } ?>
			</table>
		</div>
		
		<div class="row container largeDevicesView">
			<table class="table table-striped" id="company">
				<thead>
					<tr>
						<th></th>
						<th><?php echo __( 'Company name' ); ?></th>
						<th><?php echo __( 'Contact person' ); ?></th>
						<th><?php echo __( '#of Emp' ); ?></th>
						<th><?php echo __( '#of Proj' ); ?></th>
						<th><?php echo __( 'Country' ); ?></th>
					</tr>
				</thead>
				
				<tfoot>
					<tr>
						<th></th>
						<th><?php echo __( 'Company name' ); ?></th>
						<th><?php echo __( 'Contact person' ); ?></th>
						<th><?php echo __( '#of Emp' ); ?></th>
						<th><?php echo __( '#of Proj' ); ?></th>
						<th><?php echo __( 'Country' ); ?></th>
					</tr>
				</tfoot>
				
				<tbody>
				<?php for ( $i=0; $i<count($companies); $i++ ) { ?>
					<tr>
						<td><?php echo $i+1; ?></td>
						<td><a href="/companyAdmin/viewCompany/<?php echo $companies[$i]['Company']['company_id']; ?>"><?php echo $companies[$i]['Company']['company_name']; ?></a></td>
						<td></td>
						<td><?php echo count( $companies[$i]['User'] ); ?></td>
						<td><?php echo count( $companies[$i]['Project']); ?></td>
						<td><?php echo $companies[$i]['Company']['country_name']; ?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
</div>


<script type='text/javascript'>
  $(document).ready(function () {
		$('#company').dataTable();
  });
</script>