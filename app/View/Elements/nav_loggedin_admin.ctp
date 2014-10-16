	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" id="mobile-menu-button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><?php echo $this->Html->image('csr/logo_header1.png', array( 'height' => '100%', 'alt' => 'CSR Consulting Group' ) ); ?></a>
			</div>
			
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">				
					<?php $thisController = 'userAdmin'; ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo __( 'Users' ); ?><span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="/<?php echo $thisController; ?>/add"><?php echo __( 'Add new' ); ?></a></li>
							<li><a href="/<?php echo $thisController; ?>/activateUsers/"><?php echo __( 'Activate Users' ); ?></a></li>
							<li><a href="/<?php echo $thisController; ?>/deactivateUsers"><?php echo __( 'Deactivate Users' ); ?></a></li>
						</ul>
					</li>
					

					<?php $thisController = 'companyAdmin'; ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo __( 'Company' ); ?><span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="/<?php echo $thisController; ?>/add"><?php echo __( 'Add new' ); ?></a></li>
							<li><a href="/<?php echo $thisController; ?>"><?php echo __( 'Company List' ); ?></a></li>
						</ul>
					</li>
					
					<?php $thisController = 'projectAdmin'; ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo __( 'Project' ); ?><span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="/<?php echo $thisController; ?>/add"><?php echo __( 'Create Project' ); ?></a></li>
							<li><a href="/<?php echo $thisController; ?>/projectList"><?php echo __( 'Project List' ); ?></a></li>
							
							<?php $thisController = 'userAdmin'; ?>
							<li class="divider"></li>
							<li><a href="/<?php echo $thisController; ?>/assignUsers"><?php echo __( 'Assign Users' ); ?></a></li>
							<li><a href="#"><?php echo __( '' ); ?></a></li>
						</ul>
					</li>
					
					
					<?php $thisController = 'userAdmin'; ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo __( 'My Account' ); ?><span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="/<?php echo $thisController; ?>/add"><?php echo __( 'Add new' ); ?></a></li>
							<li><a href="/<?php echo $thisController; ?>/activateUsers/"><?php echo __( 'Activate Users' ); ?></a></li>
							<li><a href="/<?php echo $thisController; ?>/deactivateUsers"><?php echo __( 'Deactivate Users' ); ?></a></li>
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php $actualLink = "http://$_SERVER[HTTP_HOST]" . $this->here; ?>
					<li>
						<a href="<?php echo $actualLink ?>?lang=th" id="thImg"><?php echo $this->Html->image('flags/th.png', array('alt' => 'Thai')); ?></a>
						<a href="<?php echo $actualLink ?>?lang=th" id="thText"><?php echo __('Thai'); ?></a>
					</li>
					<li>
						<a href="<?php echo $actualLink ?>?lang=en" id="enImg"><?php echo $this->Html->image('flags/us.png', array('alt' => 'English')); ?></a>
						<a href="<?php echo $actualLink ?>?lang=en" id="enText"><?php echo __( 'English' ); ?></a>
					</li>
					<li><a href="/users/logout"><?php echo __( 'Log Out' ); ?></a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>