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
	
	<?php if ( isset($companyID) ) { ?>
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li><a href="/companyAdmin/viewCompany/<?php echo $companyID; ?>"><?php echo $companies[$companyID]; ?></a></li>
				
				<?php if (isset($projID)) { ?>
				<li><a href="/projectAdmin/viewProject/<?php echo $companyID; ?>/<?php echo $projID; ?>"><?php echo $projects[$projID]; ?></a></li>
				<?php } ?>
				
				<?php if (isset($evaluatorID)) { ?>
				<li><a href="#"><?php echo $evaluator['User']['first_name']. ' ' . $evaluator['User']['last_name']; ?></a></li>
				<?php } ?>
			</ol>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<?php if ( isset($companyID) and isset($projID) ) { ?>
			<a href="/projectAdmin/viewProject/<?php echo $companyID ?>/<?php echo $projID ?>" class="btn btn-primary"><?php echo __('Back to Project'); ?></a>
			<?php } ?>
		</div>
	</div>
	<?php } ?>
	
	
	<?php
	############### Show evaluators table
	if ( isset($projID) ) {		
		if ( !isset($evaluatorID) ) { // if evaluator selected, do not show this table list {
	?>
	<div class="row largeDevicesView">
		<div class="col-md-12">
			<table class="table table-striped display" id="evaluator">
				<thead>
					<tr>
						<th><?php echo __( 'First name' ); ?></th>
						<th><?php echo __( 'Last name' ); ?></th>
						<th><?php echo __( 'Department' ); ?></th>
						<th><?php echo __( 'Position' ); ?></th>
						<th></th>
					</tr>
				</thead>
				
				<tfoot>
					<tr>
						<th><?php echo __( 'First name' ); ?></th>
						<th><?php echo __( 'Last name' ); ?></th>
						<th><?php echo __( 'Department' ); ?></th>
						<th><?php echo __( 'Position' ); ?></th>
						<th></th>
					</tr>
				</tfoot>
				
				<tbody>
				<?php for ( $i=0; $i<count($evaluators); $i++ ) { ?>
					<tr>
						<td><?php echo $evaluators[$i]['User']['first_name'] ?></td>
						<td><?php echo $evaluators[$i]['User']['last_name'] ?></td>
						<td><?php echo $evaluators[$i]['Department']['dept_name'] ?></td>
						<td><?php echo $evaluators[$i]['User']['position'] ?></td>
						
						<td>
							<a href="#" class="btn btn-primary selectedEvaluator" id="<?php echo $evaluators[$i]['User']['id']; ?>"><?php echo __( 'Select' ); ?></a>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	
	<div class="row header-bar">
		<h3><?php echo __('List of Evaluators has been assigned') . ' - ' . count($sourceAssigned) . ' ' . __( 'User(s)' ); ?></h3>
	</div>
	
	
	<div class="row largeDevicesView">
		<div class="col-md-12">
			<table class="table table-striped display" id="sourceAssigned">
				<thead>
					<tr>
						<th><?php echo __( 'First name' ); ?></th>
						<th><?php echo __( 'Last name' ); ?></th>
						<th><?php echo __( 'Department' ); ?></th>
						<th><?php echo __( 'Position' ); ?></th>
						<th></th>
					</tr>
				</thead>
				
				<tfoot>
					<tr>
						<th><?php echo __( 'First name' ); ?></th>
						<th><?php echo __( 'Last name' ); ?></th>
						<th><?php echo __( 'Department' ); ?></th>
						<th><?php echo __( 'Position' ); ?></th>
						<th></th>
					</tr>
				</tfoot>
				
				<tbody>
				<?php for ( $i=0; $i<count($sourceAssigned); $i++ ) { ?>
					<tr>
						<td><?php echo $sourceAssigned[$i]['User']['first_name'] ?></td>
						<td><?php echo $sourceAssigned[$i]['User']['last_name'] ?></td>
						<td><?php echo $sourceAssigned[$i]['Department']['dept_name'] ?></td>
						<td><?php echo $sourceAssigned[$i]['User']['position'] ?></td>
						
						<td>
							<a href="#" class="btn btn-primary selectedEvaluator" id="<?php echo $evaluators[$i]['User']['id']; ?>"><?php echo __( 'Select' ); ?></a>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	
	
	
	
	<?php	}	else { ############### Show employees table ?>
	<?php echo $this->BootstrapForm->create( 'userList' ); ?>
	<div class="row header-bar">
		<h3><?php echo __( 'Select users for' ) . ' ' . $evaluator['User']['first_name'] . ' ' . $evaluator['User']['last_name']; ?></h3>
	</div>
	<a href="#" class="btn btn-primary" id="btnSelectNewEvaluator"><?php echo __( 'Select Another Evaluators' ); ?></a>

	
	<div class="container largeDevicesView">
		<table class="table table-striped display" id="availableUsers">
			<thead>
				<tr>
					<th></th>
					<th><?php echo __( 'First name' ); ?></th>
					<th><?php echo __( 'Last name' ); ?></th>
					<th><?php echo __( 'Department' ); ?></th>
					<th><?php echo __( 'Position' ); ?></th>
					<th><?php echo __( 'User relation' ); ?></th>
				</tr>
			</thead>
			
			<tfoot>
				<tr>
					<th></th>
					<th><?php echo __( 'First name' ); ?></th>
					<th><?php echo __( 'Last name' ); ?></th>
					<th><?php echo __( 'Department' ); ?></th>
					<th><?php echo __( 'Position' ); ?></th>
					<th><?php echo __( 'User relation' ); ?></th>
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
					<td><input type="text" name="userRelation[]" id="userRelation[<?php echo $availableUsers[$i]['User']['id']; ?>]" class="form-control fullwidth" /></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
	<button type="submit" class="btn btn-large btn-success">
		<?php echo __('Assign'); ?>
	</button>
	

	
	<?php if ( count($targetAssigned) > 0 ) { ?>
	<div class="row header-bar">
		<h3><?php echo __( 'Assigned Users' ) . ' (' . count($targetAssigned) . ' ' . __('Users') . ')'; ?></h3>
	</div>
	
	
	<div class="container smallDevicesView">
		<table class="table table-striped">
			<?php for ( $i=0; $i<count($targetAssigned); $i++ ) { ?>
				<tr>
					<td><input type="checkbox" value="<?php echo $targetAssigned[$i]['User']['id']; ?>" name="userList[]" id="userList[<?php echo $targetAssigned[$i]['User']['id']; ?>]"></td>
					<td><?php echo $targetAssigned[$i]['User']['first_name'] ?></td>
					<td><?php echo $targetAssigned[$i]['User']['last_name'] ?></td>
					<td><?php echo $targetAssigned[$i]['User']['dept_id'] ?></td>
					<td><?php echo $targetAssigned[$i]['User']['position'] ?></td>
				</tr>
			<?php } ?>
		</table>
	</div>
	
	<div class="container largeDevicesView">
		<table class="table table-striped" id="targetAssigned">
			<thead>
				<tr>
					<th></th>
					<th><?php echo __( 'First name' ); ?></th>
					<th><?php echo __( 'Last name' ); ?></th>
					<th><?php echo __( 'Department' ); ?></th>
					<th><?php echo __( 'Position' ); ?></th>
					<th><?php echo __( 'User relation' ); ?></th>
				</tr>
			</thead>
			
			<tfoot>
				<tr>
					<th></th>
					<th><?php echo __( 'First name' ); ?></th>
					<th><?php echo __( 'Last name' ); ?></th>
					<th><?php echo __( 'Department' ); ?></th>
					<th><?php echo __( 'Position' ); ?></th>
					<th><?php echo __( 'User relation' ); ?></th>
				</tr>
			</tfoot>
			
			<tbody>
			<?php for ( $i=0; $i<count($targetAssigned); $i++ ) { ?>
				<tr>
					<td><input type="checkbox" value="<?php echo $targetAssigned[$i]['Evaluate']['target_id']; ?>" name="userList[]" id="userList[<?php echo $targetAssigned[$i]['Evaluate']['target_id']; ?>]"></td>
					<td><?php echo $targetAssigned[$i]['TargetUser']['first_name'] ?></td>
					<td><?php echo $targetAssigned[$i]['TargetUser']['last_name'] ?></td>
					<td><?php echo $targetAssigned[$i]['TargetUser']['dept_id'] ?></td>
					<td><?php echo $targetAssigned[$i]['TargetUser']['position'] ?></td>
					<td><?php echo $targetAssigned[$i]['Evaluate']['user_relation'] ?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
	<button type="submit" class="btn btn-large btn-danger">
		<?php echo __('Remove'); ?>
	</button>
	
	<?php } ?>
	<?php	echo $this->BootstrapForm->end(); ?>
	<?php	}	?>
	<?php	}	?>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php
			?>
		</div>
	</div>
</div>


<script type='text/javascript'>
  $(document).ready(function () {
    var s = $( "#companyID" );
    s.change( function () {
      var location = "/userAdmin/assignUsers/" + s.val();
      window.location.href = location;
    } );
		
    var t = $( "#projID" );
    t.change( function () {
      var location = "/userAdmin/assignUsers/" + s.val() + "/" + t.val();
      window.location.href = location;
    } );
		
    var u = $( ".selectedEvaluator" );
    u.click( function () {
      var location = "/userAdmin/assignUsers/" + s.val() + "/" + t.val() + "/" + $(this).attr('id');
			window.location.href = location;
    } );
		
    var b = $( "#btnSelectNewEvaluator" );
    b.click( function () {
      var location = "/userAdmin/assignUsers/" + s.val() + "/" + t.val();
			window.location.href = location;
    } );
		
		$('#evaluator').dataTable();
		$('#availableUsers').dataTable();
		$('#sourceAssigned').dataTable();
		$('#targetAssigned').dataTable();
  });
</script>