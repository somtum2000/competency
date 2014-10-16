<?php
App::uses( 'AppController', 'Controller', 'CakeEmail', 'Network/Email' );

class UsersController extends AppController {
	
	public $uses = array( 'Company', 'User', 'Department', 'DataDictionary', 'Evaluate', 'Countries' );
	
	public $paginate = array(
		'limit' => 25,
		'conditions' => array('status' => '1'),
		'order' => array('User.username' => 'asc' ) 
	);
	
	
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(
			'login',
			'signup',
			'signupInfo',
			'signupSuccess',
			'activate',
			'successActivate',
			'successFailed',
			'forgotPassword',
			'resetPassword',
			'test'
		);
	}
	
	
	public function index() {
		$this->paginate = array(
			'limit' => 20,
			'order' => array('User.username' => 'asc' )
		);
		
		$users = $this->paginate('User');
		$this->set(compact('users'));
	}
	
	
	
	public function dashboard() {
		$user = $this->Auth->user();
		
		
		$userList = $this->Evaluate->find( 'all', array (
																									'conditions' => array(
																											'Evaluate.company_id' => $user['company_id'],
																											'Evaluate.source_id' => $user['id'],
																									)
																	) );

		$this->set ( 'user', $user );
		$this->set ( 'userList', $userList );
	}
	

	public function login() {
		// if user already logged in
		if ( $this->Auth->loggedIn() ) {
			$this->redirect( array( 'controller' => 'users', 'action' => 'index' ) );
		} else {
			if ($this->request->is('post')) {
				if ($this->Auth->login()) {
					$user = $this->Auth->user();
					switch( strtolower($user[ 'Group' ][ 'name' ]) ) {
						case 'system admin':
							return $this->redirect( array( 'controller' => 'userAdmin', 'action' => 'index' ) );
							break;

						case 'internal user':
							return $this->redirect( array( 'controller' => 'userAdmin', 'action' => 'index' ) );
							break;

						case 'super users':
							return $this->redirect( array( 'controller' => 'companyAdmin', 'action' => 'index' ) );
							break;

						case 'users':
							return $this->redirect( array( 'controller' => 'users', 'action' => 'dashboard' ) );
							break;
					}
				} else {
					$this->Session->setFlash( __('Invalid user name or password'), 'flashDanger' );
				}
			}
			
			
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}


	public function add() {
		if ($this->request->is('post')) {

			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash( __( 'The user has been created' ) );
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash( __( 'The user could not be created. Please try again.' ) );
			}	
		}
	}

	
	
	
	
	// get company token from user before sign up
	public function signupInfo() {
		$this->set ( 'title_for_layout', __('Sign Up for an Account') );
		$company = array();
		$countries = $this->Countries->getCountryList();
		
		$this->set( 'countries', $countries );
		
		if ($this->request->is('post')) {
			$data = $this->request->data;
			
			// if user enter company token
			if (!empty($data['Company']['token'])) {
				$company = $this->Company->find( 'first', array (
																									'conditions' => array(
																											'Company.token' => $data['Company']['token'],
																									)
																	) );
				if ( !empty($company) ) {
					$this->redirect( array( 'controller' => 'users', 'action' => 'signup', $company['Company']['external_guid'] ) );
				} else {
					$this->Session->setFlash( __('Token you entered is not match with our partners'), 'flashDanger' );
				}
			} else {
				$this->Session->setFlash( __('Please enter your company token'), 'flashInfo' );
			}
		}
		
		$this->set ( 'company', $company );
	}
	
	
	
	
	// after user enter company token, it will redirect to this page
	// user will enter basic infos to signup
	public function signup( $externalGUID = null) {
		$this->set ( 'title_for_layout', __('Sign Up for an Account') );
		if ( empty($externalGUID) ) throw new ForbiddenException();
		
		$company = $this->Company->find( 'first', array (
																									'conditions' => array(
																											'Company.external_guid' => $externalGUID,
																									)
																	) );
																	
		if ( empty($company) ) throw new ForbiddenException();
		
		
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$data[ 'User' ][ 'username' ] = strtolower($data[ 'User' ][ 'username' ]); // set all char to lower case
			$data[ 'User' ][ 'email_hash' ] = $this->generateRandomHash(32);
			$data[ 'User' ][ 'uuid' ] = $this->generateUUID();
			$data[ 'User' ][ 'locale' ] = $this->Countries->getCountryLocale($data['User']['country_id']);
			debug ($data);
			
			$this->User->create();
			if ( $this->User->save( $data ) ) {
				$userID = $this->User->getLastInsertID(); // get last insert ID
				$this->_sendUserAccountActivation($userID); // send email to user
				$this->Session->setFlash( __('Thank you for sign up with CSR'), 'flashSuccess' );
				$this->redirect( array( 'controller' => 'users', 'action' => 'signupSuccess') );
			} else {
				$this->Session->setFlash( __( 'The user could not be created. Please, try again.' ), 'flashDanger' );
			}	
		}
		
		$this->set( 'company', $company );
		$this->set( 'countries', $this->Countries->getCountryList() );
		$this->set( 'departments', $this->Department->getDepartmentList($company['Company']['company_id']) );
	}

	
	
	
	// inform users and display successful message
	public function signupSuccess() {
	}
	
	
	
  // Confirms user got email. We already know the users password.
  public function activate( $emailHash = null ) {
		$this->set ( 'title_for_layout', __('Sign Up for an Account') );
		$errors = array();
		$data = array();
		
		// Find email hash that user enter
    $user = $this->User->findByEmailHash( $emailHash );
		
		// if found email hash
    if ( !empty( $user ) == true ) {
			// get Department list base on company that user belong
			$departments = $this->Department->getDepartmentList( $user['User']['company_id'] );

			$this->set ( 'departments', $departments );
			$this->set ( 'user', $user );
		} else {
			throw new ForbiddenException();
		}
		
		
		if ( $this->request->is('post') ) {
			$data = $this->request->data;
			
      if ( $data[ 'User' ][ 'password' ] != $data[ 'User' ][ 'confirm_password' ] ) {
        $this->Session->setFlash( __('Password is not match'), 'flashDanger' );
			}	else {
				$data[ 'User' ][ 'active' ] = '1';
				$data[ 'User' ][ 'email_hash' ] = $this->generateRandomHash(); // reset email hash value
			
				if ( $this->User->save( $data ) ) {
					$this->Session->setFlash( __('Congratulation, your account is now activated'), 'flashSuccess' );
					$this->redirect( array( 'controller' => 'users', 'action' => 'successActivate' ) );
				} else {
					$errors = array();
					foreach( $this->User->validationErrors AS $field => $errorMessages ) {
						foreach( $errorMessages AS $message )
							$errors[] = $message;
					}
				}
			}
		}
	
		$this->set( 'errors', $errors );
		$this->set( 'data', $data );
  }

	public function successActivate() {
	}
	
  public function forgotPassword() {
		$errors = array();
		$success = false;
		$data = array();
		$user = array();
		
    if ( $this->request->is( 'post' ) && empty( $this->request->data ) == false ) {
			$data = $this->request->data;
			$email = $this->request->data['User'][ 'email' ];
      $user = $this->User->findByEmail( $email );
			
      if ( empty( $user ) == true ) {
					$this->Session->setFlash( __('Email you entered is not registered, please contact your company admin'), 'flashDanger' );
      } else {
			
			
				if ( $this->request->data['User']['confirmResetPWD'] == 0 ) {
					$this->Session->setFlash( __('Please confirm that you want to reset password'), 'flashDanger' );
					return $this->render();
				}
				
        // Now we have a valid user, update the email hash and save.
        $user[ 'User' ][ 'email_hash' ] = $this->generateRandomHash();
        $this->User->set( $user );

				
				
        if ( $this->User->save( $data ) ) {
					// Now send the reset password email. You will need to create that.
					$this->request->data = array();
					//$this->_sendResetPasswordEmail( $this->User->id );

					// Render new view to tell user that password email was sent.
					$this->set( 'email', $email );
					return $this->render( 'password_reset_send_mail' );
        } else {
          foreach( $this->User->validationErrors AS $field => $errorMessages ) {
            foreach( $errorMessages AS $message )
              $errors[] = $message;
          }
				}
      }
    }
		
		
		$this->set( 'data', $data );
		$this->set( 'errors', $errors );
		$this->set( 'user', $user );
  }

	
	
	public function resetPassword( $emailHash = null ) {
		$errors = array();
		$success = false;

		$user = $this->User->findByEmailHash( $emailHash );
		if ( empty( $user ) == true ) {
			throw new NotFoundException();
		}

		if ( empty( $this->request->data ) == false ) {
		  $data = $this->request->data;
		  if ( $data[ 'User' ][ 'password' ] != $data[ 'User' ][ 'confirm_password' ] ) {
				$errors[] = __( 'The passwords you entered do not match' );
		  } else {
				$user[ 'User' ][ 'active' ] = 1;

				$this->User->validator()->remove( 'cell_phone' ); 
				$this->User->validator()->remove( 'hc_grad_year' );

				$this->User->set( $user );
				if ( $this->User->save() == false ) {
					foreach( $this->User->validationErrors AS $field => $errorMessages ) {
						foreach( $errorMessages AS $message )
							$errors[] = $message;
					}
				} else {
					$success = true;
					$this->_sendPasswordChangedEmail( $this->User->id );
				}
			}
		}

		$this->set( 'success', $success );
		$this->set( 'errors', $errors );
		$this->set( 'user', $user );
	}
	
	
	public function test() {
		// create new empty worksheet and set default font
		$this->PhpExcel->createWorksheet()
				->setDefaultFont('Calibri', 12);

		// define table cells
		$table = array(
				array('label' => __('User'), 'filter' => true),
				array('label' => __('Type'), 'filter' => true),
				array('label' => __('Date')),
				array('label' => __('Description'), 'width' => 50, 'wrap' => true),
				array('label' => __('Modified'))
		);

		// add heading with different font and bold text
		$this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true));

		// add data
		foreach ($data as $d) {
				$this->PhpExcel->addTableRow(array(
						$d['User']['name'],
						$d['Type']['name'],
						$d['User']['date'],
						$d['User']['description'],
						$d['User']['modified']
				));
		}

		// close table and output
		$this->PhpExcel->addTableFooter()
				->output();
	}
}
?>