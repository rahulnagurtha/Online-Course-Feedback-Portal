<?php

require_once('config.php');
require_once(BASE_PATH.'/medoo.min.php');


/**
 * This script contains the LoginHandler class description
 */



class LoginHandler {

	public $userid = '';
	private $config;
	/**
	 * Login Handler class constructor method
	 * session is initialized and userid value is set
	 */
	function __construct($config) {
		session_start();
		$this->config = $config;
		if(isset($_SESSION['userid'])) {
			$this->userid = $_SESSION['userid'];
		}


	}

	/**
	 * Checks if a user is already logged in
	 * @return boolean [true if logged in]
	 */
	public function is_logged_in() {
		return isset($_SESSION['userid']);
	}

	/**
	 * Redirects to the login page with given message
	 * WARNING: Make sure page does not output anything
	 * before using this method
	 */
	public function redirect_login($msg) {
		header("Location: ".$this->config['url']['base_url'].$this->config['url']['login'].'?msg='.base64_encode($msg));

	}

	/**
	 * Verifies user login and logs in
	 * returns false if invalid login details
	 * else true
	 */
	public function user_login($username, $password) {
		$db = new medoo($this->config['db']);
		$result = $db->select('users', ['userid','password','type'], ['username' => $username]);
		if(count($result)==0) return False;
		if(password_verify($password, $result[0]['password'])) {
			$_SESSION['userid'] = $result[0]['userid'];
			$_SESSION['user_type'] = $result[0]['type'];
			return True;
		}
		return False;


	}

	/**
	 * logs user out
	 */
	public function user_logout() {
		unset($_SESSION['userid']);
		unset($_SESSION['user_type']);
	}

	/**
	 *
	 * Check user type
	 */
	
	public function get_user_type() {
		return $_SESSION['user_type'];
	}

	/**
	 * Throw un-authorized error
	 * redirects to error page
	 */
	public function not_authorized_error() {
		header("Location: ".$this->config['url']['base_url'].$this->config['url']['error'].'?msg='.base64_encode('You are not authorized to access this page.'));

	}

	
	
}


?>