<?php
	echo $this->Html->css( array('/../DataTables-1.10.2/media/css/jquery.dataTables.css'));
	echo $this->Html->script( array( '/../DataTables-1.10.2/media/js/jquery.js', '/../DataTables-1.10.2/media/js/jquery.dataTables.js', '/../DataTables-1.10.2/media/js/dataTables.bootstrap.js' ) );
	
	echo $this->fetch('css');
	echo $this->fetch('script');
?>