<div class="container">
	<?php if ( !empty($user) ) { ?>
	<div class="row">
		<div class="col-xs-3">
		</div>
		<div class="col-sm-6">
	<?php
		$genders = array( 'Male' => 'Male', 'Female' => 'Female' );
		echo $this->BootstrapForm->create( 'User' );
		echo $this->BootstrapForm->hidden( 'User.id', array( 'value' => $user[ 'User' ][ 'id' ] ) );
		
		echo $this->Form->input ( 'User.username', array(
																'error' => false,
																'label' => __('Username'),
																'placeholder' => __('Username'),
																'class' => 'form-control',
																'value' => $user['User']['username']
														) );
		
		echo $this->Form->input ( 'User.password', array(
																'error' => false,
																'type' => 'password',
																'label' => __('Password'),
																'placeholder' => __('Password'),
																'class' => 'form-control',
														) );
		
		echo $this->Form->input ( 'User.confirm_password', array(
																'error' => false,
																'type' => 'password',
																'label' => __('Confirm Password'),
																'placeholder' => __('Confirm Password'),
																'class' => 'form-control',
														) );
														
		echo $this->Form->input ( 'User.email', array(
																'error' => false,
																'label' => __('Email'),
																'placeholder' => __('Email'),
																'class' => 'form-control',
																'value' => $user['User']['email'],
														) );
														
		echo $this->Form->input ( 'User.first_name', array(
																'error' => false,
																'label' => __('First name'),
																'placeholder' => __('First name'),
																'class' => 'form-control',
																'value' => $user['User']['first_name'],
														) );

														
		echo $this->Form->input ( 'User.last_name', array(
																'error' => false,
																'label' => __('Last name'),
																'placeholder' => __('Last name'),
																'class' => 'form-control',
																'value' => $user['User']['last_name'],
														) );
														

		echo $this->Form->input ( 'User.dept_id', array(
																'error' => false,
																'label' => __('Department'),
																'placeholder' => __('Department'),
																'class' => 'form-control',
																'empty' => __('Select Department'),
																'options' => $departments,
																'default' => $user['User']['dept_id'],
														) );

														
		echo $this->Form->input ( 'User.position', array(
																'error' => false,
																'label' => __('Position'),
																'placeholder' => __('Position'),
																'class' => 'form-control',
																'value' => $user['User']['position'],
														) );

														
		echo $this->Form->input ( 'User.gender', array(
																'error' => false,
																'label' => __('Gender'),
																'placeholder' => __('Gender'),
																'class' => 'form-control',
																'empty' => __('Select Gender'),
																'options' => $genders,
																'default' => $user['User']['gender'],
														) );
														
		echo $this->Form->input ( 'User.cell_phone', array(
																'error' => false,
																'label' => __('Phone'),
																'placeholder' => __('Phone'),
																'class' => 'form-control',
																'value' => $user['User']['cell_phone'],
														) );

		echo $this->Form->submit( __('Activate My Account'), array( 'class' => 'btn btn-primary btn-lg' ) );
		echo $this->BootstrapForm->end();
	?>
		</div>
		<div class="col-xs-3">
		</div>
	</div>
	<?php } else { ?>
		<div class="row header-bar"><h1><?php echo __( 'Sorry, link your provided not available' ); ?></h1></div>
	<?php } ?>
</div>



<script>
	$(document).ready(function() {
		//$("#UserPhone").mask("999-999-9999");
	});
</script>