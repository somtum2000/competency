<?php

App::uses( 'AppModel', 'Model' );

class Group extends AppModel
{
	public $primaryKey = 'group_id';
	
  public $hasMany = array(
		'User' => array (
			'className' => 'User',
			'foreignKey' => 'group_id'
		),
	);
	
	
	public function getUserGroup( $companyID ) {
		if ( $companyID == 1 ) {
			$groups = $this->find( 'list', array (
																								'conditions' => array ( 'type' => 'Internal' ),
																								'fields' => array( 'group_id', 'name' ),
																								'order'  => array( 'name')
																		) );
		} else {
			$groups = $this->find( 'list', array (
																								'conditions' => array ( 'type' => 'External' ),
																								'fields' => array( 'group_id', 'name' ),
																								'order'  => array( 'name')
																		) );
		}

		return $groups;
	}
}