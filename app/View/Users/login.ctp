<div class="container">
	<div class="row">
		<div class="col-sm-4">
		</div>
		<div class="col-sm-4">
				<?php
				echo $this->BootstrapForm->create( 'User', array( 'action' => 'login' ) );
				echo $this->Form->input ( 'User.username', array(
																		'error' => false,
																		'placeholder' => __('Enter your email address'),
																		'class' => array('form-control'),
															) );
															
				echo $this->Form->input ( 'User.password', array(
																		'error' => false,
																		'placeholder' => __('Password'),
																		'class' => 'form-control margin-bottom',
															) );
															
				?>
				<div class="row container margin-bottom">
					<a href="/users/forgotPassword"><?php echo __( 'Forgot Username or Password?' ); ?></a>
				</div>
				<?php

				echo $this->Form->submit( __( 'Log In' ), array( 'class' => 'btn btn-primary' ) );
				?>
				<a href="/users/signupInfo"><?php echo __('Sign Up Here'); ?></a>
				<?php echo $this->BootstrapForm->end();	?>
		</div>
		<div class="col-sm-4">
		</div>
	</div>
</div>