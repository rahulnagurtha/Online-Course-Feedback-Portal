<?php

require_once('../config.php');
require_once(BASE_PATH.'/medoo.min.php');
require_once(BASE_PATH.'/login_handler.php');


  /*
  Login handling and permission check
   */
  $login = new loginHandler($config);
  if(!$login->is_logged_in()) {
    $login->redirect_login('Please login');

  }

  if($login->get_user_type() != 'admin') {
    $login->not_authorized_error();
  }


if(isset($_GET['courseid'])) {
	$courseid = $_GET['courseid'];
	//delete from courses
	$db = new medoo($config['db']);
	$db->delete('courses', ['courseid' => $courseid]);
	//delete from student course linkage
	$db->delete('student_course', ['course' => $courseid]);
  //delete question
  $db->delete('questions', ['courseid' => $courseid]);
  //delete feedback
  $db->delete('feedback', ['courseid' => $courseid]);


}

//redirect to course list
header('Location: '.$config['url']['base_url'].$config['url']['admin_course_list']);


?>