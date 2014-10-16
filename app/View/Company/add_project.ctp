<div class="container">
	<h3><?php echo __( 'Create New Project' ); ?></h3>
	
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
	echo $this->BootstrapForm->create( 'Project' );
	echo $this->BootstrapForm->input( 'company_id', array( 'options' => $companies, 'label' => 'Company', 'empty' => __('Select Company') ) );
	echo $this->BootstrapForm->input( 'proj_name', array( 'label' => __( 'Project Name' ), 'error' => false, 'placeholder' => __('Project Name') ) );
	echo $this->BootstrapForm->input( 'proj_desc', array( 'label' => __( 'Project Description' ), 'error' => false, 'placeholder' => __('Project Description') ) );
	echo $this->BootstrapForm->input( 'proj_start', array( 'label' => __( 'Start Date' ), 'error' => false, 'placeholder' => __('Start Date') ) );
	
	
	echo $this->BootstrapForm->submit( 'Add New', array( 'class' => 'btn btn-primary btn-large' ) );
	echo $this->BootstrapForm->end();
	?>
</div>