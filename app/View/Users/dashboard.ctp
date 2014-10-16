<div class="row">
	<div class="container">
		<div class="row container first-Div">
			<?php if ( $user['Group']['name'] == 'Power Users' ) { ?>
			<div class="row">			
				<div class="col-sm-6">
					<h3><?php echo __( 'List of User You Have to Evaluate' ); ?></h3>
				</div>
				<div class="col-sm-6">
					<h3><?php echo __( 'List of User You Have to Evaluate' ); ?></h3>
				</div>
			</div>
			
			
			<?php } else { ?>
			
			<div class="row">			
				<div class="col-sm-12">
					<h3><?php echo __( 'List of User You Have to Evaluate' ); ?></h3>
					
					<?php if ( !empty($userList) ) {?>
					<ul>
						<?php for ( $i=0; $i<count($userList); $i++ ) { ?>
						<li><a href="/evaluate/evaluation/<?php echo $userList[$i]['Evaluate']['target_id'] ?>/<?php echo $userList[$i]['Evaluate']['token'] ?>"><?php echo $userList[$i]['TargetUser']['first_name'] . ' ' . $userList[$i]['TargetUser']['last_name']; ?></a></li>
						<?php } ?>
					</ul>
					<?php } ?>
					
				</div>
			</div>
			
			<?php } ?>
			
		</div>
	</div>
</div>