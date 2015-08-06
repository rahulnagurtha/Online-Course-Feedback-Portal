<?php


require_once('../config.php');
require_once(BASE_PATH.'/login_handler.php');

$login = new LoginHandler($config);

if(!($login->is_logged_in())) {
	$login->redirect_login('Please login');

}
else {
	echo "Hello";
}

?>