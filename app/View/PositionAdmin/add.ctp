<div class="container">
	<div class="row">
		<div class="col-xs-3">
		</div>
		<div class="col-sm-6">
			<a href="/projectAdmin/viewProject/<?php echo $companyID ?>/<?php echo $projID ?>" class="btn btn-primary"><?php echo __('Back to Project'); ?></a>

			<?php
			echo $this->BootstrapForm->create( 'Position' );
			echo $this->BootstrapForm->input( 'Position.company_id', array( 'options' => $companies, 'label' => 'Company', 'empty' => __('Select Company'), 'default' => $companyID ) );
			
			if ( isset ($companyID) ) {
				echo $this->BootstrapForm->input( 'Position.proj_id', array( 'options' => $projects, 'label' => 'Select Project', 'empty' => __('Select Project'), 'default' => $projID ) );
				echo $this->BootstrapForm->input( 'Position.dept_id', array( 'options' => $departments, 'label' => 'Select Department', 'empty' => __('Select Department'), 'default' => $deptID ) );
			}
			
			
			
			if ( isset ($companyID, $projID, $deptID) ) {
				echo $this->BootstrapForm->input( 'Position.position_name', array(
																							'label' => __('Position Name'),
																							'error' => false,
																							'placeholder' => __('Position Name'),
																				) );																
			
			
				echo $this->BootstrapForm->submit( 'Save', array( 'class' => 'btn btn-primary btn-large' ) );
			}
			
			echo $this->BootstrapForm->end();
			?>
			
	
			
			<?php if ( !empty ($positions) ) { ?>

			<div class="row largeDevicesView">
				<table class="table table-striped display" id="positionList">
					<thead>
						<tr>
							<th>#</th>
							<th><?php echo __( 'Position Name' ); ?></th>
							<th><?php echo __( 'Actions' ); ?></th>
						</tr>
					</thead>
					
					<tbody>
					<?php for ( $i=0; $i<count($positions); $i++ ) { ?>
						<tr>
							<td><?php echo $i+1; ?></td>
							<td><?php echo $positions[$i]['Position']['position_name']; ?></td>
							<td>
								<a href="#"><span class="glyphicon glyphicon-edit"></span></a>
								<a href="/PositionAdmin/delete/<?php echo $positions[$i]['Position']['position_id']; ?>"><span class="glyphicon glyphicon-remove-circle"></span></a>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
			<?php } ?>
		</div>
		<div class="col-xs-3">
		</div>
	</div>
</div>


<script type='text/javascript'>
  $(document).ready(function () {
		var thisController = "/PositionAdmin/add"
    var s = $( "#PositionCompanyId" );
    s.change( function () {
      var location = thisController + "/" + s.val();
      window.location.href = location;
    } );
		
    var t = $( "#PositionProjId" );
    t.change( function () {
      var location = thisController + "/" + s.val() + "/" + t.val();
      window.location.href = location;
    } );
		
    var u = $( "#PositionDeptId" );
    u.change( function () {
      var location = thisController + "/" + s.val() + "/" + t.val() + "/" + u.val();
      window.location.href = location;
    } );
		
		$('#positionList').dataTable();
		
		$('#myTab a').click(function (e) {
			e.preventDefault()
			$(this).tab('show')
		});
		
  });
</script>