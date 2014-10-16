<div class="container">
	<div class="row container">
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
				
	<div class="row">
		<div class="col-xs-3">
		</div>
		<div class="col-sm-6">
			<?php
			echo $this->BootstrapForm->create( 'Project' );
			echo $this->BootstrapForm->input( 'company_id', array( 'options' => $companies, 'label' => 'Company', 'empty' => __('Select Company'), 'default' => $companyID ) );
			
			if ( isset($companyID) ) {
				echo $this->BootstrapForm->input( 'proj_name', array( 'label' => __( 'Project Name' ), 'error' => false, 'placeholder' => __('Project Name') ) );
				echo $this->BootstrapForm->input( 'proj_desc', array( 'label' => __( 'Project Description' ), 'error' => false, 'placeholder' => __('Project Description') ) );
				
				echo $this->BootstrapForm->input( 'proj_start', array( 'label' => __( 'Start Date' ), 'error' => false, 'placeholder' => __('Start Date') ) );
				echo $this->BootstrapForm->input( 'proj_status', array( 'error' => false, 'options' => $projStatusList, 'label' => 'Project Status', 'empty' => __('Select Status'), 'default' => 1 ) );
				echo $this->BootstrapForm->input( 'proj_manager', array( 'error' => false, 'options' => $projManagerList, 'label' => 'Project Manager', 'empty' => __('Select Project Manger') ) );
				echo $this->BootstrapForm->submit( 'Save', array( 'class' => 'btn btn-primary btn-large' ) );
			}
			echo $this->BootstrapForm->end();
			?>
		</div>
		<div class="col-xs-3">
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
  });
</script>