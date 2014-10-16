<div class="container">
	<div class="row">
		<div class="col-xs-3">
		</div>
		<div class="col-sm-6">
			<a href="/projectAdmin/viewProject/<?php echo $companyID ?>/<?php echo $projID ?>" class="btn btn-primary"><?php echo __('Back to Project'); ?></a>

			<?php
			echo $this->BootstrapForm->create( 'CC' );
			echo $this->BootstrapForm->input( 'CC.company_id', array( 'options' => $companies, 'label' => 'Company', 'empty' => __('Select Company'), 'default' => $companyID ) );
			
			if ( isset ($companyID) ) {
				echo $this->BootstrapForm->input( 'CC.proj_id', array( 'options' => $projects, 'label' => 'Select Project', 'empty' => __('Select Project'), 'default' => $projID ) );
			}
			
			
			
			if ( isset ($companyID, $projID) ) {
				echo $this->BootstrapForm->input( 'CC.cc_name', array(
																							'label' => __('Name'),
																							'error' => false,
																							'placeholder' => __('Description Name'),
																				) );
																				
				echo $this->BootstrapForm->input( 'CC.cc_desc_th', array(
																							'label' => __('Description in Thai'),
																							'error' => false,
																							'placeholder' => __('Description in Thai'),
																				) );

				echo $this->BootstrapForm->input( 'CC.cc_desc_en', array(
																							'label' => __('Description in English'),
																							'error' => false,
																							'placeholder' => __('Description in English'),
																				) );

				echo $this->BootstrapForm->input( 'CC.csr_expect', array(
																							'options' => $expectValue,
																							'label' => 'Expect Value',
																							'empty' => __('Set Expect Value'),
																							'default' => $csrExpect
																				) );																				
			
			
				echo $this->BootstrapForm->submit( 'Save', array( 'class' => 'btn btn-primary btn-large' ) );
			}
			
			echo $this->BootstrapForm->end();
			?>
			
	
			
			<?php if ( !empty ($cc_list) ) { ?>

			<div class="row largeDevicesView">
				<table class="table table-striped display" id="ccList">
					<thead>
						<tr>
							<th>#</th>
							<th><?php echo __( 'Name' ); ?></th>
							<th><?php echo __( 'Expect Value' ); ?></th>
							<th><?php echo __( 'Actions' ); ?></th>
						</tr>
					</thead>
					
					<tbody>
					<?php for ( $i=0; $i<count($cc_list); $i++ ) { ?>
						<tr>
							<td><?php echo $i+1; ?></td>
							<td><?php echo $cc_list[$i]['CC']['cc_name']; ?></td>
							<td><?php echo $cc_list[$i]['CC']['csr_expect']; ?></td>
							<td>
								<a href="#"><span class="glyphicon glyphicon-edit"></span></a>
								<a href="/CCAdmin/delete/<?php echo $cc_list[$i]['CC']['cc_id']; ?>"><span class="glyphicon glyphicon-remove-circle"></span></a>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
			<?php } ?>
		</div>
		<div class="col-xs-3">
		</div>
	</div>
</div>


<script type='text/javascript'>
  $(document).ready(function () {
		var thisController = "/CCAdmin/add"
    var s = $( "#CCCompanyId" );
    s.change( function () {
      var location = thisController + "/" + s.val();
      window.location.href = location;
    } );
		
    var t = $( "#CCProjId" );
    t.change( function () {
      var location = thisController + "/" + s.val() + "/" + t.val();
      window.location.href = location;
    } );
		
		
		$("#CCDdDescTh").val() = "";
		$("#CCDdDescEn").val() = "";
		
		$('#ccList').dataTable({
			"paging":   false,
		});
		$('#myTab a').click(function (e) {
			e.preventDefault()
			$(this).tab('show')
		});
		
  });
</script>