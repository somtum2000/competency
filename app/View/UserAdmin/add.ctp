	<div class="container">
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
		
		<div class="container first-Div">
			<?php
			echo $this->BootstrapForm->create( 'User' );
			echo $this->BootstrapForm->input( 'User.company_id', array( 'options' => $companies, 'empty' => __('Select Company'), 'label' => __('Company'), 'default' => $companyID ) );
			echo $this->BootstrapForm->input( 'User.email', array( 'error' => false, 'label' => __('Email Address'), 'placeholder' => __('Email Address') ) );
			echo $this->BootstrapForm->input( 'User.first_name', array( 'error' => false, 'label' => __('First Name'), 'placeholder' => __('First Name') ) );
			echo $this->BootstrapForm->input( 'User.last_name', array( 'error' => false, 'label' => __('Last Name'), 'placeholder' => __('Last Name') ) );
			echo $this->BootstrapForm->input( 'User.dept_id', array( 'options' => $departments, 'empty' => __('Select Department'), 'label' => __('Department') ) );
			echo $this->BootstrapForm->input( 'User.position', array( 'error' => false, 'label' => __('Position'), 'placeholder' => __('Position') ) );
			
			echo $this->BootstrapForm->input( 'User.group_id', array( 'options' => $userGroups, 'empty' => __('Select Group'), 'label' => __('User Group') ) );
			
			echo $this->BootstrapForm->submit( __('Save'), array( 'class' => 'btn btn-primary btn-large' ) );
			echo $this->BootstrapForm->end();
			?>
		</div>
	</div>




<script>
	$(document).ready(function() {
    var s = $( "#UserCompanyId" );
    s.change( function () {
      var location = "/userAdmin/add/" + s.val();
      window.location.href = location;
    } );
	});
</script>