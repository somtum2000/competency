<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<?php	echo $this->Form->input( 'companyID', array( 'options' => $companies, 'label' => __('Select Company'), 'empty' => __('Select Company'), 'default' => $companyID, 'class' => 'form-control' ) ); ?>
		</div>
		
		<div class="col-sm-6">
		<?php
			if ( isset($companyID) ) {
				echo $this->Form->input( 'projID', array( 'options' => $projects, 'label' => __('Select Project'), 'empty' => __('Select Project'), 'default' => $projID, 'class' => 'form-control' ) );
			}
		?>
		</div>
	</div>
	
	
	<?php
	if ( isset($companyID) and isset($projID) ) { ?>
	
	<?php ### Project shortcut menu button ?>
	<div class="row">
		<div class="col-md-12">
			<!-- Single button -->
			<div class="btn-group">
				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><?php echo $project['Project']['proj_name'] ?><span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li><a href="/projectAdmin/edit/<?php echo $companyID ?>/<?php echo $projID ?>"><?php echo __('Edit') ?></a></li>
					<li class="divider"></li>
					<li><a href="/CCAdmin/add/<?php echo $companyID ?>/<?php echo $projID ?>"><?php echo __('Add Core Competency') ?></a></li>
					<li><a href="/MCAdmin/add/<?php echo $companyID ?>/<?php echo $projID ?>"><?php echo __('Add Managerial Competency') ?></a></li>
					<li><a href="/FCAdmin/add/<?php echo $companyID ?>/<?php echo $projID ?>"><?php echo __('Add Functional Competency') ?></a></li>
					<li class="divider"></li>
					<li><a href="/projectUserAdmin/add/<?php echo $companyID ?>/<?php echo $projID ?>"><?php echo __('Add User to This Project') ?></a></li>
					<li><a href="/userAdmin/assignUsers/<?php echo $companyID ?>/<?php echo $projID ?>"><?php echo __('Assign Tasks') ?></a></li>
					<li><a href="/projectAdmin/edit/<?php echo $companyID ?>/<?php echo $projID ?>"><?php echo __('Add Workers') ?></a></li>
				</ul>
			</div>			
			<p><?php echo $project['Project']['proj_desc']; ?></p>
		</div>
	</div>
	
	
	
	
	
	
	<div class="row">
		<div class="col-md-12">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li class="active"><a href="#tabDD" role="tab" data-toggle="tab"><?php echo __('Data Dictionary'); ?></a></li>
				<li><a href="#tabUser" role="tab" data-toggle="tab"><?php echo __('Users'); ?></a></li>
				<li><a href="#tabEvaluate" role="tab" data-toggle="tab"><?php echo __('Evaluate'); ?></a></li>
				<li><a href="#tabProjWorkers" role="tab" data-toggle="tab"><?php echo __('Project Workers'); ?></a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<?php #### Data Dictionary ?>
				<div class="tab-pane active" id="tabDD">
				
					<!-- Core Competencies -->
					<div class="col-md-12">
						<a href="#" id="ccDivLink"><?php echo __('Core Competencies'); ?></a>
					</div>
					<div class="col-md-12 well" id="ccDiv">
						<a href="/CCAdmin/add/<?php echo $companyID ?>/<?php echo $projID ?>" class="btn btn-primary"><?php echo __('Add New'); ?></a>
						<table class="table table-striped display" id="ccList">
							<thead>
								<tr>
									<th>#</th>
									<th><?php echo __( 'Name' ); ?></th>
									<th><?php echo __( 'Thai' ); ?></th>
									<th><?php echo __( 'English' ); ?></th>
									<th><?php echo __( 'Expect' ); ?></th>
								</tr>
							</thead>
							
							<tbody>
							<?php for ( $i=0; $i<count($cc); $i++ ) { ?>
								<tr>
									<td><?php echo $i+1; ?></td>
									<td><?php echo $cc[$i]['CC']['cc_name']; ?></td>
									<td><?php echo $cc[$i]['CC']['cc_desc_th']; ?></td>
									<td><?php echo $cc[$i]['CC']['cc_desc_en']; ?></td>
									<td><?php echo $cc[$i]['CC']['csr_expect']; ?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
					
					
					<!-- Managerial Competencies -->
					<div class="col-md-12">
						<a href="#" id="mcDivLink"><?php echo __('Managerial Competencies'); ?></a>
					</div>
					<div class="col-md-12 well" id="mcDiv">
						<a href="/MCAdmin/add/<?php echo $companyID ?>/<?php echo $projID ?>" class="btn btn-primary"><?php echo __('Add New'); ?></a>
						<table class="table table-striped display" id="mcList">
							<thead>
								<tr>
									<th>#</th>
									<th><?php echo __( 'Name' ); ?></th>
									<th><?php echo __( 'Thai' ); ?></th>
									<th><?php echo __( 'English' ); ?></th>
									<th><?php echo __( 'Expect' ); ?></th>
								</tr>
							</thead>
							
							<tbody>
							<?php for ( $i=0; $i<count($mc); $i++ ) { ?>
								<tr>
									<td><?php echo $i+1; ?></td>
									<td><?php echo $mc[$i]['MC']['mc_name']; ?></td>
									<td><?php echo $mc[$i]['MC']['mc_desc_th']; ?></td>
									<td><?php echo $mc[$i]['MC']['mc_desc_en']; ?></td>
									<td><?php echo $mc[$i]['MC']['csr_expect']; ?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>


					
					
					<!-- Functional Competencies -->
					<div class="col-md-12">
						<a href="#" id="fcDivLink"><?php echo __('Functional Competencies'); ?></a>
					</div>
					<div class="col-md-12 well" id="fcDiv">
						<!-- Single button -->
						<div class="btn-group">
							<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><?php echo __('Add New'); ?><span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<?php foreach ( $positions AS $position => $key ) { ?>
								<li><a href="/FCAdmin/add/<?php echo $companyID; ?>/<?php echo $projID; ?>/<?php echo $position; ?>"><?php echo $key; ?></a></li>
								<?php } ?>
							</ul>
						</div>
						
						<?php debug ($positions); ?>

						<div class="largeDevicesView">
							<table class="table table-striped display" id="ddList">
								<thead>
									<tr>
										<th>#</th>
										<th><?php echo __( 'Department' ); ?></th>
										<th><?php echo __( 'Data Name' ); ?></th>
										<th><?php echo __( 'Thai Description' ); ?></th>
										<th><?php echo __( 'English Description' ); ?></th>
									</tr>
								</thead>
								
								<tfoot>
									<tr>
										<th>#</th>
										<th><?php echo __( 'Department' ); ?></th>
										<th><?php echo __( 'Data Name' ); ?></th>
										<th><?php echo __( 'Thai Description' ); ?></th>
										<th><?php echo __( 'English Description' ); ?></th>
									</tr>
								</tfoot>
								
								<tbody>
								<?php for ( $i=0; $i<count($dd); $i++ ) { ?>
									<tr>
										<td><?php echo $i+1; ?></td>
										<td><?php echo $dd[$i]['Department']['dept_name']; ?></td>
										<td><?php echo $dd[$i]['DataDictionary']['dd_name']; ?></td>
										<td><?php echo $dd[$i]['DataDictionary']['dd_desc_th']; ?></td>
										<td><?php echo $dd[$i]['DataDictionary']['dd_desc_en']; ?></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					
				</div>
				
				
				
				
				
				
				
				<?php #### Users ?>
				<div class="tab-pane" id="tabUser">
					<a href="/projectUserAdmin/add/<?php echo $companyID; ?>/<?php echo $projID; ?>" class="btn btn-primary"><?php echo __( 'Add User To This Project' ); ?></a>
					<hr />
				
					
					<div class="row container largeDevicesView">
						<table class="table table-striped display" id="userList">
							<thead>
								<tr>
									<th>#</th>
									<th><?php echo __( 'Name' ); ?></th>
									<th><?php echo __( 'Department' ); ?></th>
									<th><?php echo __( 'Position' ); ?></th>
									<th><?php echo __( 'Gender' ); ?></th>
								</tr>
							</thead>
							
							<tfoot>
								<tr>
									<th>#</th>
									<th><?php echo __( 'Name' ); ?></th>
									<th><?php echo __( 'Department' ); ?></th>
									<th><?php echo __( 'Position' ); ?></th>
									<th><?php echo __( 'Gender' ); ?></th>
								</tr>
							</tfoot>
							
							<tbody>
							<?php for ( $i=0; $i<count($projectUsers); $i++ ) { ?>
								<tr>
									<td><?php echo $i+1; ?></td>
									<td><?php echo $projectUsers[$i]['User']['first_name'] . ' ' . $projectUsers[$i]['User']['last_name']; ?></td>
									<td><?php echo $projectUsers[$i]['Department']['dept_name'] ?></td>
									<td><?php echo $projectUsers[$i]['User']['position']; ?></td>
									<td><?php echo $projectUsers[$i]['User']['gender']; ?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				
				
				
				
				
				
				
				<?php #### Evaluate ?>
				<div class="tab-pane" id="tabEvaluate">
					<a href="/userAdmin/assignUsers/<?php echo $companyID; ?>/<?php echo $projID; ?>" class="btn btn-primary"><?php echo __( 'Assign Tasks' ); ?></a>
					<hr />

					
					<div class="row container largeDevicesView">
						<table class="table table-striped" id="evaluateList">
							<thead>
								<tr>
									<th>#</th>
									<th><?php echo __( 'Name' ); ?></th>
									<th><?php echo __( 'Department' ); ?></th>
									<th><?php echo __( 'Position' ); ?></th>
									<th><?php echo __( '#of Users' ); ?></th>
								</tr>
							</thead>
							
							<tfoot>
								<tr>
									<th>#</th>
									<th><?php echo __( 'Name' ); ?></th>
									<th><?php echo __( 'Department' ); ?></th>
									<th><?php echo __( 'Position' ); ?></th>
									<th><?php echo __( '#of Users' ); ?></th>
								</tr>
							</tfoot>
							
							<tbody>
							<?php for ( $i=0; $i<count($userAssigned); $i++ ) { ?>
								<tr>
									<td><?php echo $i+1; ?></td>
									<td><?php echo $userAssigned[$i]['User']['first_name'] . ' ' . $userAssigned[$i]['User']['last_name']; ?></td>
									<td><?php echo $userAssigned[$i]['Department']['dept_name']; ?></td>
									<td><?php echo $userAssigned[$i]['User']['position']; ?></td>
									<td><?php echo count($userAssigned[$i]['Evaluate']); ?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				
				
				
				<?php #### Project Workers ?>
				<div class="tab-pane" id="tabProjWorkers">
					<a href="/projectManageUserAdmin/add/<?php echo $companyID; ?>/<?php echo $projID; ?>" class="btn btn-primary"><?php echo __( 'Add Workers' ); ?></a>
					<hr />

					
					<div class="row container largeDevicesView">
						<table class="table table-striped" id="workerList">
							<thead>
								<tr>
									<th>#</th>
									<th><?php echo __( 'Name' ); ?></th>
									<th><?php echo __( 'Department' ); ?></th>
									<th><?php echo __( 'Position' ); ?></th>
									<th><?php echo __( 'Gender' ); ?></th>
								</tr>
							</thead>
							
							<tfoot>
								<tr>
									<th>#</th>
									<th><?php echo __( 'Name' ); ?></th>
									<th><?php echo __( 'Department' ); ?></th>
									<th><?php echo __( 'Position' ); ?></th>
									<th><?php echo __( 'Gender' ); ?></th>
								</tr>
							</tfoot>
							
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
			</div>
			
			
		</div>
	</div>
	<?php } ?>
</div>


<script type='text/javascript'>
  $(document).ready(function () {
	
    var s = $( "#companyID" );
    s.change( function () {
      var location = "/projectAdmin/viewProject/" + s.val();
      window.location.href = location;
    } );
		
    var t = $( "#projID" );
    t.change( function () {
      var location = "/projectAdmin/viewProject/" + s.val() + "/" + t.val();
      window.location.href = location;
    } );
		
		$('#ccDivLink').click(function() {
			$('#ccDiv').slideToggle();
		});

		$('#mcDivLink').click(function() {
			$('#mcDiv').slideToggle();
		});
		
		$('#fcDivLink').click(function() {
			$('#fcDiv').slideToggle();
		});
		
		$('#ccList').dataTable();
		$('#mcList').dataTable();
		$('#fcList').dataTable();
		$('#ddList').dataTable();
		
		$('#userList').dataTable();
		$('#evaluateList').dataTable();
		$('#workerList').dataTable();
		
		$('#myTab a').click(function (e) {
			e.preventDefault()
			$(this).tab('show')
		});		
		
  });
</script>