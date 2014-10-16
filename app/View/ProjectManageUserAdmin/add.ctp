<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<?php	echo $this->Form->input( 'companyID', array( 'options' => $companies, 'label' => __('Select Company'), 'empty' => __('Select Company'), 'default' => $companyID, 'class' => 'form-control' ) ); ?>
		</div>
		
		<div class="col-sm-6">
		<?php
			if ( isset($companyID) ) {
				echo $this->Form->input( 'projID', array( 'options' => $projects, 'label' => __('Select Project'), 'empty' => __('Select Project'), 'default' => $projID, 'class' => 'form-control' ) );
			}
		?>
		</div>
	</div>
	
	
	<?php
	if ( isset($companyID) and isset($projID) ) { ?>
	<div class="row">
		<div class="col-md-12">
		</div>
	</div>
	<?php } ?>
</div>


<?php $thisController = 'ProjectManageUserAdmin'; ?>

<script type='text/javascript'>
  $(document).ready(function () {
    var s = $( "#companyID" );
    s.change( function () {
      var location = "/ProjectManageUserAdmin/add/" + s.val();
      window.location.href = location;
    } );
		
    var t = $( "#projID" );
    t.change( function () {
      var location = "/ProjectManageUserAdmin/add/" + s.val() + "/" + t.val();
      window.location.href = location;
    } );

		
		$('#ddList').dataTable();
		$('#userList').dataTable();
		$('#evaluateList').dataTable();
		$('#workerList').dataTable();
		
		$('#myTab a').click(function (e) {
			e.preventDefault()
			$(this).tab('show')
		});		
		
  });
</script>