<div class="container forgotPassword">
	<div class="row">
		<div class="col-md-8">
		</div>
		<div class="col-md-4">
			<div class="well">
				<?php echo $this->BootstrapForm->create( 'User' ); ?>
				<?php 
				echo $this->Form->input ( 'User.email', array(
																			'error' => false,
																			'placeholder' => __('Enter your email address'),
																			'class' => array('form-control'),
																) );
				?>
				<div class="margin-bottom">
				<?php
				echo $this->Form->input ( 'User.confirmResetPWD', array (
																			'type' => 'checkbox',
																			'error' => false,
																			'label' => __( 'I confirm, I want to reset my password' ),
																) );
				
				?>
				</div>
				<?php echo $this->Form->submit( __( 'Send Me a Link' ), array( 'class' => 'btn btn-primary fullwidth' ) ); ?>
				<?php echo $this->BootstrapForm->end();	?>
				<a href="/users/login"><button type="button" class="btn btn-success fullwidth"><?php echo __('Cancel'); ?></button></a>
			</div>
		</div>
	</div>
</div>