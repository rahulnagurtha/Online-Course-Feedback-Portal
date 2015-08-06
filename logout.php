<?php

require_once('config.php');
require_once(BASE_PATH.'/login_handler.php');

$login = new LoginHandler($config);
if($login->is_logged_in()) {
	$login->user_logout();
	$login->redirect_login('Logged out Successfully');
}
else {
	$login->redirect_login('You are not logged in');

}

?>
