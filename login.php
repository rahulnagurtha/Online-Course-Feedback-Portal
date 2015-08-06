<?php

require_once('config.php');
require_once(BASE_PATH.'/medoo.min.php');
require_once(BASE_PATH.'/login_handler.php');

$login = new LoginHandler($config);


if(isset($_POST['username'])) {
	//do login verification and redirect back to login
	if($login->user_login($_POST['username'], $_POST['password'])) {
		$login->redirect_login('Logging in');
	}
	else {
		$login->redirect_login('Incorrect username/password');

	}
	
}

else {

//check login and decide redirection / login fields

	//check login status
	if($login->is_logged_in()) {
		$db = new medoo($config['db']);
		$result = $db->select('users', ['type'], ['userid' => $_SESSION['userid'] ]);
		if($result[0]['type']=='student') {
		
			//redirect to course dashboard
			header('Location: '.$config['url']['base_url'].$config['url']['student_dashboard']);
		}
		else if($result[0]['type']=='prof') {
			header('Location: '.$config['url']['base_url'].$config['url']['prof_dashboard']);

		}

		else {
			//redirect to admin panel
			header('Location: '.$config['url']['base_url'].$config['url']['admin_dashboard']);
			

		}
	}

	//show login fields
	else {
		
		
		//login form html
		?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>Login Page</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $config['url']['base_url'].$config['css_includes']['bootstrap'];?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="w.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form action="login.php" method="post" class="form-signin" role="form">
        <h2 class="form-signin-heading" style="text-align:center">
          LOG IN
        </h2>
        <p style="text-align:right;font-style:italic">  <?php if(isset($_GET['msg'])) {
      echo base64_decode($_GET['msg']); }?>
    </p>
        <label for="inputEmail" class="sr-only">USERNAME</label>
        <input name="username" type="text" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">PASSWORD</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->


    
  </body>
</html>


		<?php
		//end login form html
		

	}



}

?>