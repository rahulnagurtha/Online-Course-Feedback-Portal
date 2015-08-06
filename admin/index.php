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




?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <!-- Bootstrap -->
    <link href="<?php echo $config['url']['base_url']; ?>/css/bootstrap.min.css" rel="stylesheet">

    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    .menutext {
      margin-left: 5px;
    }
    </style>
  </head>
  <body>
  <div class="container">
  <?php $nav = new Nav($config, ['admin_dashboard','logout'], __FILE__); ?>
   

    <div class="row">
    <div class="col-md-12" style="text-align: center;">
    <h1>Admin Dashboard</h1>
    </div>
    <br><br><br><Br>
    </div>
    <div class="row">

<div class="col-md-6 col-md-offset-3">

<div class="btn-group btn-group-justified" role="group" aria-label="...">
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default" style="font-size: 15pt;"><a href="<?php echo $config['url']['base_url'].$config['url']['edit_students']; ?>" style="color: #333;"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><div class="menutext">Students</div></a></button>
  </div>
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default" style="font-size: 15pt;"><a target="_blank" href="<?php echo $config['url']['base_url'].$config['url']['edit_profs']; ?>" style="color: #333;"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span><div class="menutext">Teachers</div></a></button>
  </div>
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default" style="font-size: 15pt;"><a href="<?php echo $config['url']['base_url'].$config['url']['admin_course_list']; ?>" style="color: #333;"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span><div class="menutext">Courses</div></a></button>
  </div>
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