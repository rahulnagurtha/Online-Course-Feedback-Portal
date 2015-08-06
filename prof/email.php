<?php

require_once('../config.php');
	require_once(BASE_PATH.'/login_handler.php');
	require_once(BASE_PATH.'/medoo.min.php');
	/*
	Login handling and permission check
	 */
	$login = new loginHandler($config);
	if(!$login->is_logged_in()) {
		$login->redirect_login('Please login');

	}

	if($login->get_user_type() != 'prof') {
		$login->not_authorized_error();
	}

	if(!isset($_GET['courseid'])) {
		header("Location: ".$config['url']['base_url'].$config['url']['error'].'?msg='.base64_encode('Invalid Course id.'));
	}


	ini_set("SMTP", "smtp.gmail.com");
    ini_set("sendmail_from", "midhul.v@gmail.com");

	//select email ids of all students in given course
	$db = new medoo($config['db']);
	$students = $db->select('student_course', ['student'], ['course' => $_GET['courseid']]);
	foreach($students as $key => $student) {
		$res = $db->select('students', ['email'], ['userid' => $student['student']]);
		$students[$key]['email'] = $res[0]['email'];

	}

	$course = $db->select('courses', ['code', 'name'], ['courseid' => $_GET['courseid']]);

	foreach($students as $student) {


		$to      = $student['email'];
		$subject = 'Course Feedback Remainder '.$course[0]['code'];
		$message = 'This is a remainder for feedback submission of '.$course[0]['name'];
		$headers = 'From: midhul.v@gmail.com' . "\r\n" .
    		'Reply-To: midhul.v@gmail.com' . "\r\n" .
    		'X-Mailer: PHP/' . phpversion();


$headers .= 'From: Feedback portal <midhul.v@gmail.com>' . "\r\n";

		if(mail($to, $subject, $message, $headers)) {echo "done";}
		else {echo "fail";}
						//redirect back to course stats
			//header('Location: '.$config['url']['base_url'].$config['url']['feedback_statistics']."?courseid=".$_GET['courseid']);

}

?>