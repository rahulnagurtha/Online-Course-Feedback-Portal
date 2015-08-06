<?php
require_once('../config.php');
require_once(BASE_PATH.'/login_handler.php');
require_once(BASE_PATH.'/components/nav.php');
require_once(BASE_PATH.'/medoo.min.php');

//check login status
$login = new LoginHandler($config);
if(!$login->is_logged_in()) {
  $login->redirect_login('Please login');
}

if(isset($_POST['newpwd'])) {
  //check if they are equal
  if($_POST['newpwd'] != $_POST['cnewpwd']) {
    header('Location: '.$config['url']['base_url'].$config['url']['student_settings']);
  }
  $db = new medoo($config['db']);
  $db->update('users', ['password' => password_hash($_POST['newpwd'], PASSWORD_BCRYPT)], ['userid' => $_SESSION['userid']]);


}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Success</title>

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

<div class="col-md-6 col-md-offset-3" style="text-align: center;">
Your password has been changed successfully.
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