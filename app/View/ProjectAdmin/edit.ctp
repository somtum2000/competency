<div class="container">
	<div class="row">
		<div class="col-xs-3">
		</div>
		<div class="col-sm-6">
			<?php
			echo $this->BootstrapForm->create( 'Project' );
			echo $this->BootstrapForm->hidden( 'Project.proj_id', array( 'value' => $project['Project']['proj_id'] ) );
			//echo $this->BootstrapForm->input( 'company_id', array( 'options' => $companies, 'label' => 'Company', 'empty' => __('Select Company'), 'default' => $companyID ) );
			
			if ( isset($companyID) ) {
				echo $this->BootstrapForm->input( 'Project.proj_name', array( 'label' => __( 'Project Name' ), 'error' => false, 'placeholder' => __('Project Name'), 'value' => $project['Project']['proj_name'] ) );
				echo $this->BootstrapForm->input( 'Project.proj_desc', array( 'label' => __( 'Project Description' ), 'error' => false, 'placeholder' => __('Project Description'), 'value' => $project['Project']['proj_desc'] ) );
				
				echo $this->BootstrapForm->input( 'Project.proj_start', array( 'label' => __( 'Start Date' ), 'error' => false, 'placeholder' => __('Start Date'), 'value' => $project['Project']['proj_start'] ) );
				echo $this->BootstrapForm->input( 'Project.proj_status', array( 'error' => false, 'options' => $projStatusList, 'label' => 'Project Status', 'empty' => __('Select Status'), 'default' => $project['Project']['proj_status'] ) );
				echo $this->BootstrapForm->input( 'Project.proj_manager', array( 'error' => false, 'options' => $projManagerList, 'label' => 'Project Manager', 'empty' => __('Select Project Manger'), 'default' => $project['Project']['proj_manager'] ) );
				echo $this->BootstrapForm->submit( 'Update', array( 'class' => 'btn btn-primary btn-large' ) );
			}
			echo $this->BootstrapForm->end();
			?>
		</div>
		<div class="col-xs-3">
		</div>
	</div>
</div>