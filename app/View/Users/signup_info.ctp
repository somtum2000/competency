<div class="container">
	<div class="row">
		<div class="col-sm-4">
		</div>
		<div class="col-sm-4">
			<?php
				echo $this->BootstrapForm->create( 'Company' );
				echo $this->Form->input ( 'Company.token', array(
																		'error' => false,
																		'label' => __('Company Token'),
																		'placeholder' => __('Enter your company token'),
																		'class' => array('form-control'),
															) );
				echo $this->Form->submit( __( 'Submit' ), array( 'class' => 'btn btn-primary fullwidth' ) );
				echo $this->BootstrapForm->end();
			?>
		</div>
		<div class="col-sm-4">
		</div>
	</div>
</div>