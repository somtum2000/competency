<div class="container">
			<h3><?php echo __( 'Create New Organization' ); ?></h3>
			
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
			echo $this->BootstrapForm->create( 'Company' );
			echo $this->BootstrapForm->input( 'company_id', array( 'options' => $companies, 'empty' => __('Select company') ) );
			
			
			//echo $this->BootstrapForm->submit( 'Add New', array( 'class' => 'btn btn-primary btn-large' ) );
			echo $this->BootstrapForm->end();
			?>
</div>