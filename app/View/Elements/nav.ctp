	<?php #### When user IS NO log in, show this NAV ?>
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
				<ul class="nav navbar-nav navbar-right">
					<?php $actualLink = "http://$_SERVER[HTTP_HOST]" . $this->here; ?>
					<li>
						<a href="<?php echo $actualLink ?>?lang=th" id="thImg"><?php echo $this->Html->image('flags/th.png', array('alt' => 'Thai')); ?></a>
						<a href="<?php echo $actualLink ?>?lang=th" id="thText"><?php echo __( 'Thai' ); ?></a>
					</li>
					<li>
						<a href="<?php echo $actualLink ?>?lang=en" id="enImg"><?php echo $this->Html->image('flags/us.png', array('alt' => 'English')); ?></a>
						<a href="<?php echo $actualLink ?>?lang=en" id="enText"><?php echo __( 'English' ); ?></a>
					</li>
					<li><a href="/users/login"><?php echo __( 'Login' ); ?></a></li>
					<!-- <li class="active"><a href="./">Fixed top</a></li> -->
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>