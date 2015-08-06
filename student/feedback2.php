<?php
error_reporting(E_ALL ^ E_DEPRECATED);

require_once('../config.php');
require_once(BASE_PATH.'/login_handler.php');
require_once(BASE_PATH.'/components/nav.php');
require_once(BASE_PATH.'/medoo.min.php');

//check login status
$login = new LoginHandler($config);
if(!$login->is_logged_in()) {
	$login->redirect_login('Please login');
}


	$userid = $_SESSION['userid'];

		$con = mysql_connect($config['db']['server'],$config['db']['username'],$config['db']['password']); //change configs
			$db = mysql_select_db($config['db']['database_name'], $con); //change database
	$c_id=$_POST["courseid"];
	foreach($_POST as $key => $value)
	{
		if($key!="courseid") {
			
		    	// echo "$key"."-->"."$value[0]"."<br>";
		    	// echo "$key"."-->"."$value[1]"."<br>";
		    	// echo "<br>"."<br>";
	    		mysql_query("INSERT INTO `feedback` (`question_id`,`answer`,`comment`,`courseid`) VALUES ('$key','$value[0]','$value[1]','$c_id')") or die(mysql_error());
			
		}
	}

	//update student course linkage
	$db = new medoo($config['db']);
	$db->update('student_course', ['done' => 1], ["AND" => ['student' => $userid, 'course' => $c_id]]);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback successful</title>

    <!-- Bootstrap -->
    <link href="<?php echo $config['url']['base_url']; ?>/css/bootstrap.min.css" rel="stylesheet">

    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <div class="container">
  <?php $nav = new Nav($config, ['student_dashboard','student_settings','logout'], __FILE__); ?>
   

    <div class="row">
    <div class="col-md-12" style="text-align: center;">
    <div class="row" style="font-size: 42pt; text-align: center;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></div>
    <h1>Success</h1>
    </div>
    
    </div>
    <br><br>
    <div class="row">

<div class="col-md-6 col-md-offset-3">
Your feedback has been submitted successfuly. Thank you for taking the time to do this, it will definately help in future improvement.
We guarantee that your feedback will remain anonymous.
<br><Br>
<div class="row" style="text-align: center;">
<a href="<?php echo $config['url']['base_url'].$config['url']['student_dashboard']; ?>">Return to Dashboard</a>
</div>
</div>

</div>
</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo $config['url']['base_url']; ?>/js/jquery-2.1.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo $config['url']['base_url']; ?>/js/bootstrap.min.js"></script>
  </body>
</html>