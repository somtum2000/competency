<?php echo $this->element('dataTables'); ?>
<div class="row">
	<div class="container">
		<div class="row container first-Div">
			<a href="/projectAdmin/viewProject/<?php echo $companyID ?>/<?php echo $projID ?>" class="btn btn-primary"><?php echo __('Back to Project'); ?></a>
			<?php echo $this->BootstrapForm->create( 'userList' ); ?>
			<div class="row container display largeDevicesView">
				<table class="table table-striped" id="availableUsers">
					<thead>
						<tr>
							<th></th>
							<th><?php echo __( 'First name' ); ?></th>
							<th><?php echo __( 'Last name' ); ?></th>
							<th><?php echo __( 'Department' ); ?></th>
							<th><?php echo __( 'Position' ); ?></th>
						</tr>
					</thead>
					
					<tfoot>
						<tr>
							<th></th>
							<th><?php echo __( 'First name' ); ?></th>
							<th><?php echo __( 'Last name' ); ?></th>
							<th><?php echo __( 'Department' ); ?></th>
							<th><?php echo __( 'Position' ); ?></th>
						</tr>
					</tfoot>
					
					<tbody>
					<?php for ( $i=0; $i<count($availableUsers); $i++ ) { ?>
						<tr>
							<td><input type="checkbox" value="<?php echo $availableUsers[$i]['User']['id']; ?>" name="userList[]" id="userList[<?php echo $availableUsers[$i]['User']['id']; ?>]"></td>
							<td><?php echo $availableUsers[$i]['User']['first_name'] ?></td>
							<td><?php echo $availableUsers[$i]['User']['last_name'] ?></td>
							<td><?php echo $availableUsers[$i]['Department']['dept_name'] ?></td>
							<td><?php echo $availableUsers[$i]['User']['position'] ?></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		<button type="submit" class="btn btn-large btn-success">
			<?php echo __('Add Users to Project'); ?>
		</button>
		<?php	echo $this->BootstrapForm->end(); ?>


		
		<?php debug ($availableUsers); ?>
		<?php debug ($userAssigned); ?>
		</div>
	</div>
</div>




<script type='text/javascript'>
  $(document).ready(function () {
    var s = $( "#ProjectCompanyId" );
    s.change( function () {
      var location = "/projectAdmin/add/" + s.val();
      window.location.href = location;
    } );
		
		$('#availableUsers').dataTable();
		
  });
</script>