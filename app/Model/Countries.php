<?php
App::uses( 'AppModel', 'Model' );

class Countries extends AppModel {

	public $useTable = 'countries';
  public $primaryKey = 'country_id';
	
	public $hasMany = array (
		'User' => array (
			'className' => 'User',
			'foreignKey' => 'country_id'
		),
	);
	
	public function getCountryList() {
		$countries = $this->find( 'list', array (
																							'fields' => array( 'country_id', 'name' ),
																							'order'  => array( 'name')
																	) );
		return $countries;
	}
	

	public function getCountryInfo( $countryID ) {
		$country = $this->find( 'first', array (
																							'fields' => array( 'locale' ),
																							'conditions' => array ( 'country_id' => $countryID ),
																	) );
		return $country;
	}	
	
	
	public function getCountryLocale( $countryID ) {
		$country = $this->find( 'first', array (
																							'fields' => array( 'locale' ),
																							'conditions' => array ( 'country_id' => $countryID ),
																	) );
		return $country['Countries']['locale'];
	}	
	
}
