<div class="container">
	<h3><?php echo __( 'Edit Company Information' ); ?></h3>
	
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
	<?php echo $this->Form->input('companyID', array (
																								'options' => $companies,
																								'class' => 'form-control',
																								'label' => __( 'Select Company' ),
																								'name' => 'CompanyID',
																								'id' => 'CompanyID',
																								'default' => $companyID,
																) );
	?>
	</div>

	<?php
	echo $this->BootstrapForm->create( 'Company' );
	echo $this->BootstrapForm->hidden( 'Company.company_id', array( 'value' => $company[ 'Company' ][ 'company_id' ] ) );
	echo $this->BootstrapForm->input( 'Company.company_name', array(
																				'error' => false,
																				'placeholder' => __('Company Name'),
																				'value' => $company['Company']['company_name']
																	) );
	echo $this->BootstrapForm->input( 'country_id', array( 'options' => $countries, 'empty' => __('Select country'), 'default' => $company['Company']['country_id'] ) );
	
	echo $this->BootstrapForm->input( 'CompanySetting.token', array(
																				'error' => false,
																				'placeholder' => __('Company Token'),
																				'value' => $company['Company']['token'],
																				'disabled' => 'disabled',
																	) );
																	
	echo $this->BootstrapForm->input( 'Company.pin_code', array(
																				'error' => false,
																				'placeholder' => __('Pin Code'),
																				'value' => $company['Company']['pin_code'],
																				'disabled' => 'disabled',
																	) );
	
	echo $this->BootstrapForm->submit( __('Update'), array( 'class' => 'btn btn-primary btn-large' ) );
	echo $this->BootstrapForm->end();
	?>
</div>

<script type='text/javascript'>
  $(document).ready(function () {
    var s = $( "#CompanyID" );
    s.change( function () {
      var location = "/companyAdmin/edit/" + s.val();
      window.location.href = location;
    } );

		$('#targetAssigned').dataTable();
  });
</script>