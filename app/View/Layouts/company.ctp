<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $projectName; ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array('bootstrap.min', 'custom', 'custom-menu' ));
		echo $this->Html->script( array( 'jquery-2.1.1.js', 'bootstrap.min.js' ) );

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');		
	?>
</head>
<body>

	<!-- Fixed navbar -->
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" id="mobile-menu-button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><?php echo $projectName; ?></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#"><?php echo __( 'Home' ); ?></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo __( 'Company' ); ?><span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="/company/add"><?php echo __( 'Add new' ); ?></a></li>
							<li><a href="/company/companyList"><?php echo __( 'List' ); ?></a></li>
							<li><a href="/company/admin"><?php echo __( 'Company Admins' ); ?></a></li>
							<li class="divider"></li>
							<li class="dropdown-header">Nav header</li>
							<li><a href="#">Separated link</a></li>
							<li><a href="#">One more separated link</a></li>
						</ul>
					</li>
					<li><a href="#about"><?php echo __( 'Company' ); ?></a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><?php echo __( 'ภาษาไทย' ); ?></a></li>
					<li><a href="#"><?php echo __( 'English' ); ?></a></li>
					<li class="active"><a href="./">Fixed top</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>

	<div id="container">		
		<div class="container top-header">
			<div class="container">
				<div id="mobile-header" class="col-md-12">
					<center><h4><?php echo __('Competency System Analyst'); ?></h4></center>
				</div>
				<div id="larger-header" class="row clearfix padding-u-d-10">
					<div class="col-sm-4 column">
						<a href="http://csrgroup.co.th" target="_blank"><?php echo $this->Html->image('csr/csr-logo.png', array('width' => '100px', 'height' => '81', 'alt' => 'CSR Consulting Group' ) ); ?></a>
					</div>
					<div class="col-sm-8 column">
						<h2><?php echo __('Competency System Analyst'); ?></h2>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container">
			<div id="flash" class="row container">
				<div class='col-md-12'>
					<?php echo $this->Session->flash(); ?>
				</div>
			</div>
		</div>

		<?php echo $this->fetch('content'); ?>
	</div>
	<div class="container">
		<div class="well">
			<?php echo $this->element('sql_dump'); ?>
		</div>
	</div>
</body>
</html>
