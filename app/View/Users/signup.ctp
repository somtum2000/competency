<div class="container">
	<div class="row">
		<div class="col-sm-8 column padding-u-d-10">
		</div>
		<div class="col-sm-4 column padding-u-d-10">
			<h3><?php echo __( 'Sign Up for an Account' ); ?></h3>
			
			
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
			
			
			<div class="well">
				<?php
        echo $this->BootstrapForm->create( 'User' );
				?>
				<div id = "UserNameStatus"></div>
				<?php
				echo $this->BootstrapForm->hidden( 'company_id', array( 'value' => $company['Company']['company_id'] ) );
        echo $this->BootstrapForm->input( 'username', array( 'error' => false, 'placeholder' => __('username') ) );
				echo $this->BootstrapForm->input( 'email', array( 'error' => false, 'placeholder' => __('Email') ) );
				echo $this->BootstrapForm->input( 'first_name', array( 'error' => false, 'placeholder' => __('First name') ) );
				echo $this->BootstrapForm->input( 'last_name', array( 'error' => false, 'placeholder' => __('Last name') ) );
				echo $this->BootstrapForm->input( 'dept_id', array( 'options' => array($departments), 'empty' => __('Select Department') ) );
				echo $this->BootstrapForm->input( 'position_id', array( 'options' => array($positions), 'empty' => __('Select Position') ) );
				echo $this->BootstrapForm->input( 'gender', array( 'options' => array( 'Male' => __('Male'), 'Female' => __('Female') ),'empty' => __('Select Gender') ) );
				echo $this->BootstrapForm->input( 'country_id', array( 'options' => $countries, 'empty' => __('Select country'), 'default' => $company['Company']['country_id'] ) );
				echo $this->BootstrapForm->input( 'phone', array( 'error' => false, 'placeholder' => __('Phone number') ) );
				
				
        echo $this->Form->submit( __( 'Register' ), array( 'class' => 'btn btn-primary fullwidth' ) );
        echo $this->BootstrapForm->end();
				?>
				<a href="/users/login" class="btn btn-info fullwidth"><?php echo __('Login here'); ?></a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#UserUsername').focus(function(){
			$('#UserNameStatus').hide();
		});
		
		$('#UserUsername').blur(function(){
			$.post('/users/check_username',{username:$('#UserUsername').val()},function(result){
				$('#UserNameStatus').html(result).show('1000');
			});
		});		
	});
</script>