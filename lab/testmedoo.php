<?php

require_once('../medoo.min.php');

echo "medoo php test";

$database = new medoo([
	'database_type' => 'mysql',
	'database_name' => 'devsquare',
	'server' => 'localhost',
	'username' => 'devsquare',
	'password' => 'hashdevsquare',
]);

$database->insert('users', [
	'username' => 'admin',
	'password' => password_hash('hashadmin', PASSWORD_BCRYPT),
	'type' => 'admin'
]);




?>