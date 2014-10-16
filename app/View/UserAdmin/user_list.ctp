<div class="container">	
	<div class="row">
		<div class="largeDevicesView">
			<table class="table table-striped display" id="userList">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo __( 'Name' ); ?></th>
						<th><?php echo __( 'Username' ); ?></th>
						<th><?php echo __( 'Company' ); ?></th>
						<th><?php echo __( 'Action' ); ?></th>
					</tr>
				</thead>
				
				<tfoot>
					<tr>
						<th>#</th>
						<th><?php echo __( 'Name' ); ?></th>
						<th><?php echo __( 'Username' ); ?></th>
						<th><?php echo __( 'Company' ); ?></th>
						<th><?php echo __( 'Action' ); ?></th>
					</tr>
				</tfoot>
				
				<tbody>
				<?php for ( $i=0; $i<count($users); $i++ ) { ?>
					<tr>
						<td><?php echo $i+1; ?></td>
						<td><?php echo $users[$i]['User']['first_name'] . ' ' . $users[$i]['User']['last_name']; ?></td>
						<td><?php echo $users[$i]['User']['username']; ?></td>
						<td><?php echo $users[$i]['Company']['company_name']; ?></td>
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
		$('#userList').dataTable();		
  });
</script>