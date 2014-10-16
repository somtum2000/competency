<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	public $uses = array( 'Country', 'SendEmailSetting' );
	
	public $components = array(
			'DebugKit.Toolbar',
			'Session',
			'Auth' => array(
					'loginRedirect' => array(
							'controller' => 'userAdmin',
							'action' => 'index'
					),
					'logoutRedirect' => array(
							'controller' => 'users',
							'action' => 'index',
					),
					'authenticate' => array(
							'Form' => array(
									'passwordHasher' => 'Blowfish',
									'fields' => array('username' => 'username')
							)
					)
			),
	);
	
	
	// only allow the login controllers only
	public function beforeFilter() {
		parent::beforeFilter();
	
		// Locale String translation 
    $locale = Configure::read('Config.language');
    if ($locale && file_exists(APP . 'View' . DS . $locale . DS . $this->viewPath)) {
        // e.g. use /app/View/fra/Pages/tos.ctp instead of /app/View/Pages/tos.ctp
        $this->viewPath = $locale . DS . $this->viewPath;
    }
		
		if (!empty($this->request->query['lang'])) {
			$this->Session->write( 'Config.language', $this->request->query['lang'] );
		}
		
		if( $this->Session->check( 'Config.language' ) == true ) {
			Configure::write( 'Config.language', $this->Session->read( 'Config.language' ) );
		}
	
		
		
		
		
		if ( $this->Auth->loggedIn() == true ) {
			$this->set( 'isLoggedIn', $this->Auth->user() );
		}
		
		$projectName = 'Competency System';
    $this->Auth->allow( 'index' );
		
		$expectValue = array (
					0.5 => '0.5',
					1.0 => '1.0',
					1.5 => '1.5',
					2.0 => '2.0',
					2.5 => '2.5',
					3.0 => '3.0',
					3.5 => '3.5',
					4.0 => '4.0',
					4.5 => '4.5',
					5.0 => '5.0'
		);
		
		$this->set ( 'projectName', $projectName );
		$this->set ( 'expectValue', $expectValue );
	}

	
	
  protected function isAdmin() {
    $user = $this->Auth->user();
		$groupName = strtolower($user['Group']['name']);
    if ( $groupName == 'system admin' ) {
			return true;
		} else {
			throw new ForbiddenException();
		}
  }
	
	
	// internal group name will be static value, 'system admin' OR 'internal users'
	protected function isInternalUser() {
    $user = $this->Auth->user();
		$groupName = strtolower($user['Group']['name']);
    if ( $groupName == 'system admin' OR $groupName == 'internal users' ) {
      return true;
		} else {
			throw new ForbiddenException();
			return false;
		}
	}
	
	
	public function isAuthorized($user) {
			// Admin can access every action
			if (isset($user['is_admin']) && $user['is_admin'] === 1) {
					return true;
			}

			// Default deny
			return false;
	}
	

	## Protected functions
  protected function generateRandomHash( $length = 20 ) {
    $result = "";		
    $charPool = '0123456789abcdefghijklmnopqrstuvwxyz';
    for( $p = 0; $p < $length; $p++ )
      $result .= $charPool[ mt_rand( 0, strlen( $charPool ) -1 ) ];
    
    return sha1( md5( sha1( $result ) ) );
  }
	
  protected function generateRandomString( $length = 8 ) {
    $result = "";
    $charPool = '0123456789abcdefghijklmnopqrstuvwxyz';
    for( $p = 0; $p < $length; $p++ )
      $result .= $charPool[ mt_rand( 0, strlen( $charPool ) -1 ) ];
    
    return $result;
  }
	
  protected function generateRandomPinCode() {
		$length = 4;
    $result = "";
    $charPool = '0123456789';
    for( $i = 0; $i < $length; $i++ )
      $result .= $charPool[ mt_rand( 0, strlen( $charPool ) -1 ) ];
			
    return $result;
  }
	
	protected function generateUUID( $withOutDash = true ) {
		$uuid = array(
			'time_low'  => 0,
			'time_mid'  => 0,
			'time_hi'  => 0,
			'clock_seq_hi' => 0,
			'clock_seq_low' => 0,
			'node'   => array()
		);
		
		$uuid['time_low'] = mt_rand(0, 0xffff) + (mt_rand(0, 0xffff) << 16);
		$uuid['time_mid'] = mt_rand(0, 0xffff);
		$uuid['time_hi'] = (4 << 12) | (mt_rand(0, 0x1000));
		$uuid['clock_seq_hi'] = (1 << 7) | (mt_rand(0, 128));
		$uuid['clock_seq_low'] = mt_rand(0, 255);
		
		for ($i = 0; $i < 6; $i++) {
			$uuid['node'][$i] = mt_rand(0, 255);
		}
		
		if ( $withOutDash ) {
			$uuid = sprintf('%08x%04x%04x%02x%02x%02x%02x%02x%02x%02x%02x',
			$uuid['time_low'],
			$uuid['time_mid'],
			$uuid['time_hi'],
			$uuid['clock_seq_hi'],
			$uuid['clock_seq_low'],
			$uuid['node'][0],
			$uuid['node'][1],
			$uuid['node'][2],
			$uuid['node'][3],
			$uuid['node'][4],
			$uuid['node'][5] );
		} else {
			$uuid = sprintf('%08x-%04x-%04x-%02x%02x-%02x%02x%02x%02x%02x%02x',
			$uuid['time_low'],
			$uuid['time_mid'],
			$uuid['time_hi'],
			$uuid['clock_seq_hi'],
			$uuid['clock_seq_low'],
			$uuid['node'][0],
			$uuid['node'][1],
			$uuid['node'][2],
			$uuid['node'][3],
			$uuid['node'][4],
			$uuid['node'][5] );
		}

		return $uuid;
	}

	
	protected function getCountryList() {
		$countries = $this->Country->find( 'list', array (
																											'fields' => array( 'country_id', 'name' ),
																											'order'  => array( 'name')
																									) );
		
		return $countries;
	}

	
	
	
	protected function _sendUserAccountActivation ( $userID ) {
    App::uses('CakeEmail', 'Network/Email');
    $user = $this->User->findById( $userID );
    if ( empty( $user ) == true )
      return;

    $email = new CakeEmail();
    $email->from( 'somtum2000@gmail.com' );
    $email->sender( 'somtum2000@gmail.com', 'CSR Group' );
    $email->to( $user[ 'User' ][ 'email' ] );
    $email->subject( __( 'Account Activation', true ) );
    $email->emailFormat( 'html' );
    $email->template( 'account_activation' );
    $email->viewVars( array( 'user' => $user ) );
    $email->send();
  }
}
