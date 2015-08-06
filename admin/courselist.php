<?php

require_once('../config.php');
require_once(BASE_PATH.'/medoo.min.php');
require_once(BASE_PATH.'/login_handler.php');
require_once(BASE_PATH.'/components/nav.php');


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


//get course list from db
$db = new medoo($config['db']);
$courses = $db->select('courses', ['courseid','code','name','instructor']);

//populate extra required data
foreach($courses as $key => $course) {
	$result = $db->select('profs', ['name'], ['userid' => $courses[$key]['instructor']]);
  if(count($result)) {
	$courses[$key]['instructor'] = $result[0]['name'];
}


}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Course List</title>

    <!-- Bootstrap -->
    <link href="<?php echo $config['url']['base_url']; ?>/css/bootstrap.min.css" rel="stylesheet">

    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <div class="container">
  <?php $nav = new Nav($config, ['admin_dashboard','logout'], __FILE__); ?>
   

    <div class="row">
    <div class="col-md-12" style="text-align: center;">
    <h1>Course List</h1>
    </div>
    <br><br><br><Br>
    </div>
    
    <div class="row">

<div class="col-md-6 col-md-offset-3">
<button type="button" class="btn btn-default"><a href="<?php echo $config['url']['base_url'].$config['url']['admin_course_add']; ?>" style="color: #333;">
  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new course
</a>
</button>

<div class="list-group">
  <?php 
  	foreach($courses as $course) {

  ?>
  <a target="_blank" href="<?php echo $config['url']['base_url'].$config['url']['admin_course_edit']."?courseid=".$course['courseid']; ?>" class="list-group-item list-group-item-warning">
  	  <div class="row">
        <div class="col-md-7">
            <h4 class="list-group-item-heading"><?php echo $course['code']; ?>: <?php echo $course['name']; ?></h1>
            <p class="list-group-item-text"><?php echo $course['instructor']; ?></p>
         </div>
        <div class="col-md-2 pull-right">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
        </div>
    </div>
  </a>
  <?php
	}
  ?>
 
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