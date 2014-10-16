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

// $cakeDescription = __d('cake_dev', 'Competency System by CSR Consulting Group');
// $cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $projectName; ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array('bootstrap.min', 'custom', 'custom-menu' ));
		echo $this->Html->script( array(
																	'jquery-2.1.1.js',
																	'bootstrap.min.js',
														) );

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');		
	?>
</head>
<body>

	<div class="container top-header">
		<div class="container">
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
	
	
	<div id="container">		
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
			<?php echo $this->element('sql_dump'); ?>
	</div>
</body>
</html>
