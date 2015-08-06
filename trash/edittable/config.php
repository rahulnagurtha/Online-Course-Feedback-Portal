<?php
require_once('../config.php');
// Database
define ( 'DB_HOST', $config['db']['server'] );
define ( 'DB_USER', $config['db']['username'] );
define ( 'DB_PASSWORD', $config['db']['password'] );
define ( 'DB_DB', $config['db']['database_name'] );
?>