<?php



$config = [

"url" => [
	"base_url" => "http://localhost/devsquare",
	"login" => "/login.php",
	"student_dashboard" => "/student/dashboard.php",
	"logout" => "/logout.php",
	"student_settings" => "/student/settings.php",
	"error" => "/error.php",
	"edit_students" => "/admin/editstudents",
	"csv_data_students" => "/admin/editstudents/data",
	"admin_course_list" => "/admin/courselist.php",
	"admin_course_edit" => "/admin/edittable",
	"admin_course_del" => "/admin/delcourse.php",
	"admin_dashboard" => "/admin/index.php",
	"edit_profs" => "/admin/editprofs",
	"admin_course_add" => "/admin/addcourse.php",
	"feedback_form" => "/student/form.php",
	"prof_dashboard" => "/prof/index.php",
	"feedback_statistics" => "/prof/piee.php",
	"prof_add_question" => "/prof/edittable",
	"course_email" => "/prof/email.php"

],

"db" => [ 'database_type' => 'mysql',
	'database_name' => 'devsquare',
	'server' => 'localhost',
	'username' => 'root',
	'password' => '' ],

"name" => [ 'institution' => 'devsquare',
			'student_dashboard' => 'Dashboard',
			'login' => 'Login',
			'logout' => 'Log out',
			'student_settings' => 'Settings',
			"admin_course_list" => 'Course List',
			'admin_course_del' => 'Delete Course',
			'admin_dashboard' => 'Dashboard',
			'prof_dashboard' => 'Dashboard'
	

],

"js_includes" => [ 'jquery' => '/js/jquery-2.1.1.min.js',
				'jquery-ui' => '/js/jquery-ui.js',
				'bootstrap' => '/js/bootstrap.min.js'

],

"css_includes" => [ 'bootstrap' => '/css/bootstrap.min.css',
					'jquery-ui' => '/css/jquery-ui.css'

]

];

defined('BASE_PATH') or define('BASE_PATH', realpath(dirname(__FILE__)));

?>