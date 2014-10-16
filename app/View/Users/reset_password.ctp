<div class="container">
	<div class="row container">
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
		<?php
			echo $this->BootstrapForm->create( 'ResetPassword' );
			echo $this->Form->input ( 'password', array(
																'error' => false,
																'placeholder' => __('Enter your new password'),
																'class' => 'form-control',
															) );
															
			echo $this->Form->input ( 'confirm_password', array(
																'error' => false,
																'placeholder' => __('Confirm password'),
																'label' => null,
																'class' => 'form-control',
															) );
		?>
		<?php echo $this->Form->submit( __( 'Reset Password' ), array( 'class' => 'btn btn-primary fullwidth' ) ); ?>
		<?php echo $this->BootstrapForm->end();	?>

		
			<a href="/users/login"><button type="button" class="btn btn-success fullwidth"><?php echo __('Cancel'); ?></button></a>
		</div>
		<div class="col-md-4">
		</div>
	</div>
</div>