<?php echo $this->element('dataTables'); ?>

<div class="container">
	<h3><?php echo __( 'Add New Department' ); ?></h3>
	
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
	

	<?php
	echo $this->BootstrapForm->create( 'Department' );
	echo $this->BootstrapForm->input( 'Department.company_id', array( 'options' => $companies, 'empty' => __('Select Company'), 'label' => __('Company'), 'default' => $companyID ) );
	
	echo $this->BootstrapForm->input( 'Department.dept_name', array( 'error' => false, 'label' => __('Department Name'), 'placeholder' => __('Department Name') ) );
	
	echo $this->BootstrapForm->submit( __( 'Save' ), array( 'class' => 'btn btn-primary btn-large' ) );
	echo $this->BootstrapForm->end();
	?>
	
	
	<?php if ( isset($companyID) ) { ?>
	<div class="row header-bar">
		<h3><?php echo __( 'Departments' ); ?></h3>
	</div>
	
	<div class="row container smallDevicesView">
		<table class="table table-striped">
			<?php for ( $i=0; $i<count($departments); $i++ ) { ?>
				<tr>
					<td><?php echo $i+1; ?></td>
					<td><?php echo $departments[$i]['Department']['dept_name']; ?></td>
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
			
			<tfoot>
				<tr>
					<th>#</th>
					<th><?php echo __( 'Department Name' ); ?></th>
					<th><?php echo __( '#of User' ); ?></th>
				</tr>
			</tfoot>
			
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
	<?php } ?>
	
</div>


<div class="row">
	<div class="container">
		<?php //debug ( $data ); ?>
	</div>
</div>

<script>
	$(document).ready(function() {

    var s = $( "#DepartmentCompanyId" );
    s.change( function () {
      var location = "/departmentAdmin/add/" + s.val();
      window.location.href = location;
    } );
		
		
		$('#deptList').dataTable();
	});
</script>