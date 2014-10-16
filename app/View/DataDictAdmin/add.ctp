<div class="container">
	<div class="row">
		<div class="col-xs-3">
		</div>
		<div class="col-sm-6">
			<a href="/projectAdmin/viewProject/<?php echo $companyID ?>/<?php echo $projID ?>" class="btn btn-primary"><?php echo __('Back to Project'); ?></a>

			<?php
			echo $this->BootstrapForm->create( 'DataDictionary' );
			echo $this->BootstrapForm->input( 'DataDictionary.company_id', array( 'options' => $companies, 'label' => 'Company', 'empty' => __('Select Company'), 'default' => $companyID ) );
			
			if ( isset ($companyID) ) {
				echo $this->BootstrapForm->input( 'DataDictionary.proj_id', array( 'options' => $projects, 'label' => 'Select Project', 'empty' => __('Select Project'), 'default' => $projID ) );
				
				echo $this->BootstrapForm->input( 'DataDictionary.dept_id', array( 'options' => $departments, 'label' => 'Select Department', 'empty' => __('Select Project Department'), 'default' => $deptID ) );
			}
			
			
			
			if ( isset ($companyID, $projID, $deptID) ) {
				echo $this->BootstrapForm->input( 'DataDictionary.dd_name', array(
																							'label' => __('Description Name'),
																							'error' => false,
																							'placeholder' => __('Description Name'),
																				) );
																				
				echo $this->BootstrapForm->input( 'DataDictionary.dd_desc_th', array(
																							'label' => __('Description in Thai'),
																							'error' => false,
																							'placeholder' => __('Description in Thai'),
																				) );

				echo $this->BootstrapForm->input( 'DataDictionary.dd_desc_en', array(
																							'label' => __('Description in English'),
																							'error' => false,
																							'placeholder' => __('Description in English'),
																				) );											
			
			
				echo $this->BootstrapForm->submit( 'Save', array( 'class' => 'btn btn-primary btn-large' ) );
			}
			
			echo $this->BootstrapForm->end();
			?>
			
			<?php //debug ($dataDicts); ?>
			
			<?php if ( !empty ($dataDicts) ) { ?>

			<div class="row container largeDevicesView">
				<table class="table table-striped" id="ddList">
					<thead>
						<tr>
							<th>#</th>
							<th><?php echo __( 'Name' ); ?></th>
							<th><?php echo __( 'Actions' ); ?></th>
						</tr>
					</thead>
					
					<tfoot>
						<tr>
							<th>#</th>
							<th><?php echo __( 'Name' ); ?></th>
							<th><?php echo __( 'Actions' ); ?></th>
						</tr>
					</tfoot>
					
					<tbody>
					<?php for ( $i=0; $i<count($dataDicts); $i++ ) { ?>
						<tr>
							<td><?php echo $i+1; ?></td>
							<td><?php echo $dataDicts[$i]['DataDictionary']['dd_name']; ?></td>
							<td>
								<a href="#"><span class="glyphicon glyphicon-edit"></span></a>
								<a href="/dataDictionaryAdmin/delete/<?php echo $dataDicts[$i]['DataDictionary']['dd_id']; ?>"><span class="glyphicon glyphicon-remove-circle"></span></a>
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
		var thisController = "/dataDictAdmin/add"
    var s = $( "#DataDictionaryCompanyId" );
    s.change( function () {
      var location = thisController + "/" + s.val();
      window.location.href = location;
    } );
		
		var t = $( "#DataDictionaryProjId" );
    var u = $( "#DataDictionaryDeptId" );
    u.change( function () {
      var location = thisController + "/" + s.val() + "/" + t.val() + "/" + u.val();
      window.location.href = location;
    } );
		
		
		$("#DataDictionaryDdDescTh").val() = "";
		$("#DataDictionaryDdDescEn").val() = "";
		
		$('#ddList').dataTable({
			"paging":   false,
		});
		$('#myTab a').click(function (e) {
			e.preventDefault()
			$(this).tab('show')
		});
		
  });
</script>