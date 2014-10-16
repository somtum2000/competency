<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php	echo $this->Form->input( 'companyID', array( 'options' => $companies, 'label' => __('Select Company'), 'empty' => __('Select Company'), 'default' => $companyID, 'class' => 'form-control' ) ); ?>		
		</div>
	</div>
	
	<?php if ( isset($companyID) ) { ?>
	<div class="row">
			<h3><?php echo $company['Company']['company_name']; ?> - <a href="/companyAdmin/edit/<?php echo $companyID; ?>"><?php echo __( 'Edit' ); ?></a></h3>
	</div>
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

	<hr />
	
	
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li class="active"><a href="#tabProject" role="tab" data-toggle="tab"><?php echo __('Project'); ?></a></li>
				<li><a href="#tabUser" role="tab" data-toggle="tab"><?php echo __('User'); ?></a></li>
				<li><a href="#tabDepartment" role="tab" data-toggle="tab"><?php echo __('Department'); ?></a></li>
				<li><a href="#tabPosition" role="tab" data-toggle="tab"><?php echo __('Position'); ?></a></li>
				<li><a href="#tabSetting" role="tab" data-toggle="tab"><?php echo __('Setting'); ?></a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<?php #### Project ?>
				<div class="tab-pane active" id="tabProject">
					<a href="/projectAdmin/add/<?php echo $companyID; ?>" class="btn btn-primary"><?php echo __( 'Add New Project' ); ?></a>
					<hr />
					
					<div class="row container smallDevicesView">
						<table class="table table-striped">
						<?php for ( $i=0; $i<count($projects); $i++ ) { ?>
							<tr>
								<td><?php echo $i+1; ?></td>
								<td><?php echo $projects[$i]['Project']['proj_name']; ?></td>
							</tr>
						<?php } ?>
						</table>
					</div>
					
					<div class="row container largeDevicesView">
						<table class="table table-striped" id="projList">
							<thead>
								<tr>
									<th>#</th>
									<th><?php echo __( 'Project Name' ); ?></th>
									<th><?php echo __( '#of User' ); ?></th>
									<th><?php echo __( 'Status' ); ?></th>
									<th><?php echo __( 'Created' ); ?></th>
									<th><?php echo __( 'Manager' ); ?></th>
								</tr>
							</thead>
							
							<tbody>
							<?php for ( $i=0; $i<count($projects); $i++ ) { ?>
								<tr>
									<td><?php echo $i+1; ?></td>
									<td><a href="/projectAdmin/viewProject/<?php echo $companyID; ?>/<?php echo $projects[$i]['Project']['proj_id']; ?>"><?php echo $projects[$i]['Project']['proj_name']; ?></a></td>
									<td><?php echo count($projects[$i]['ProjectUser']); ?></td>
									<td><?php echo $projects[$i]['ProjectStatus']['status_name']; ?></td>
									<td><?php echo $projects[$i]['Project']['created']; ?></td>
									<td><?php echo $projects[$i]['ProjectManager']['first_name'] . ' ' . $projects[$i]['ProjectManager']['last_name']; ?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>


				
				
				
				
				<?php #### User ?>
				<div class="tab-pane" id="tabUser">
					<a href="/UserAdmin/add/<?php echo $companyID; ?>" class="btn btn-primary"><?php echo __( 'Add New User' ); ?></a>
					<hr />
					
					<div class="row container smallDevicesView">
						<table class="table table-striped">
							<?php for ( $i=0; $i<count($users); $i++ ) { ?>
								<tr>
									<td><?php echo $i+1; ?></td>
									<td><?php echo $users[$i]['User']['first_name'] . ' ' . $users[$i]['User']['last_name']; ?></td>
									<td><?php echo $users[$i]['Department']['dept_name']; ?></td>
								</tr>
							<?php } ?>
						</table>
					</div>
					
					<div class="row container largeDevicesView">
						<table class="table table-striped" id="userList">
							<thead>
								<tr>
									<th>#</th>
									<th><?php echo __( 'Name' ); ?></th>
									<th><?php echo __( 'Department' ); ?></th>
									<th><?php echo __( 'Position' ); ?></th>
									<th><?php echo __( 'Gender' ); ?></th>
								</tr>
							</thead>
							
							<tbody>
							<?php for ( $i=0; $i<count($users); $i++ ) { ?>
								<tr>
									<td><?php echo $i+1; ?></td>
									<td><?php echo $users[$i]['User']['first_name'] . ' ' . $users[$i]['User']['last_name']; ?></td>
									<td><?php echo $users[$i]['Department']['dept_name']; ?></td>
									<td><?php echo $users[$i]['User']['position']; ?></td>
									<td><?php echo $users[$i]['User']['gender']; ?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>

				
				
				
				
				<?php #### Department ?>
				<div class="tab-pane" id="tabDepartment">
					<a href="/departmentAdmin/add/<?php echo $companyID; ?>" class="btn btn-primary"><?php echo __( 'Add New Department' ); ?></a>
					<hr />
					
					<div class="row container smallDevicesView">
						<table class="table table-striped">
							<?php for ( $i=0; $i<count($departments); $i++ ) { ?>
								<tr>
									<td><?php echo $i+1; ?></td>
									<td><?php echo $departments[$i]['Department']['dept_name']; ?></td>
									<td><?php echo count($departments[$i]['User']); ?></td>
								</tr>
							<?php } ?>
						</table>
					</div>
					
					<div class="row container largeDevicesView">
						<table class="table table-striped" id="deptList">
							<thead>
								<tr>
									<th>#</th>
									<th><?php echo __( 'Department Name' ); ?></th>
									<th><?php echo __( '#of User' ); ?></th>
								</tr>
							</thead>
							
							<tbody>
							<?php for ( $i=0; $i<count($departments); $i++ ) { ?>
								<tr>
									<td><?php echo $i+1; ?></td>
									<td><?php echo $departments[$i]['Department']['dept_name']; ?></td>
									<td><?php echo count($departments[$i]['User']); ?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>

				

				<?php #### Position ?>
				<div class="tab-pane" id="tabPosition">
					<!-- Single button -->
					<div class="btn-group">
						<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><?php echo __('Add New Position'); ?><span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<?php for ($i=0; $i<count($departments); $i++) { ?>
							<li><a href="/positionAdmin/add/<?php echo $companyID; ?>/<?php echo $departments[$i]['Department']['dept_id']; ?>"><?php echo $departments[$i]['Department']['dept_name']; ?></a></li>
							<?php } ?>
						</ul>
					</div>
					<hr />
					
					<div class="row container largeDevicesView">
						<table class="table table-striped display" id="positionList">
							<thead>
								<tr>
									<th>#</th>
									<th><?php echo __( 'Position Name' ); ?></th>
									<th><?php echo __( 'Department' ); ?></th>
									<th><?php echo __( '#of User' ); ?></th>
								</tr>
							</thead>
							
							<tbody>
							<?php for ( $i=0; $i<count($positions); $i++ ) { ?>
								<tr>
									<td><?php echo $i+1; ?></td>
									<td><?php echo $positions[$i]['Position']['position_name']; ?></td>
									<td><?php echo $positions[$i]['Department']['dept_name']; ?></td>
									<td><?php echo count($positions[$i]['User']); ?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				
				
				
				<?php #### Setting ?>
				<div class="tab-pane" id="tabSetting">
				</div>
			</div>
	<?php } ?>
</div>

<?php debug($departments); ?>


<script type='text/javascript'>
  $(document).ready(function () {
	
    var s = $( "#companyID" );
    s.change( function () {
      var location = "/companyAdmin/viewCompany/" + s.val();
      window.location.href = location;
    } );		
		
		$('#projList').dataTable({
			"paging":   false,
		});
		$('#userList').dataTable();
		$('#deptList').dataTable();
		$('#settingList').dataTable();
		
		$('#myTab a').click(function (e) {
			e.preventDefault()
			$(this).tab('show')
		});		
		
  });
</script>