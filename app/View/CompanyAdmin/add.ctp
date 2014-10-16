<div class="container">
	<div class="row">
			<?php
			echo $this->BootstrapForm->create( 'Company' );
			echo $this->BootstrapForm->input( 'company_name', array( 'error' => false, 'placeholder' => __('Company Name') ) );
			echo $this->BootstrapForm->input( 'Company.address', array(
																						'error' => false,
																						'placeholder' => __('Address'),
																			) );
			echo $this->BootstrapForm->input( 'country_id', array( 'options' => $countries, 'empty' => __('Select country'), 'default' => 208 ) );
			
			
			echo $this->BootstrapForm->submit( 'Save', array( 'class' => 'btn btn-primary btn-large' ) );
			echo $this->BootstrapForm->end();
			?>
	</div>
</div>