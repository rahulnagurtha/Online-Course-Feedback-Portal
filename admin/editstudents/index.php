
<?php
	require_once('../../config.php');
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


	require_once("ajax_table.class.php");
	$obj = new ajax_table([]);
	$records = $obj->getRecords();
	//echo phpinfo();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <title>Ajax Table Inline Edit</title>
  <link href="<?php echo $config['url']['base_url']; ?>/css/bootstrap.min.css" rel="stylesheet">
  <script>
	 // Column names must be identical to the actual column names in the database, if you dont want to reveal the column names, you can map them with the different names at the server side.
	 var columns = new Array("username","name","class","email");
	 var placeholder = new Array("Enter username","Enter name","Select class","Enter email");
	 var inputType = new Array("text","text","select","text");
	 var table = "tableDemo";
	 var selectOpt = new Array("btech 13","btech 14");


	 // Set button class names 
	 var savebutton = "ajaxSave";
	 var deletebutton = "ajaxDelete";
	 var editbutton = "ajaxEdit";
	 var updatebutton = "ajaxUpdate";
	 var cancelbutton = "cancel";
	 
	 var saveImage = "images/save.png"
	 var editImage = "images/edit.png"
	 var deleteImage = "images/remove.png"
	 var cancelImage = "images/back.png"
	 var updateImage = "images/save.png"

	 // Set highlight animation delay (higher the value longer will be the animation)
	 var saveAnimationDelay = 3000; 
	 var deleteAnimationDelay = 1000;
	  
	 // 2 effects available available 1) slide 2) flash
	 var effect = "flash"; 
  
  </script>
  <script src="js/jquery-1.11.0.min.js"></script>	
  <script src="js/jquery-ui.js"></script>	
  <script src="js/script.js"></script>	
  <link rel="stylesheet" href="css/style.css">
 </head>
 <body>
 <div class="container" style="text-align: center;">
 <?php $nav = new Nav($config, ['admin_dashboard','logout'], __FILE__); ?>
 
 <button type="button" class="btn btn-default">
 <a href="importcsv.php" style="color: #333;"> <span class="glyphicon glyphicon-star" aria-hidden="true"></span> Intelligent Import</a>
 
</button>
<br><Br>
 	<center>
 	<i>(Double click entry to edit)</i>
	<table border="0" class="tableDemo bordered">
		<tr class="ajaxTitle">
			<th width="2%">Sr</th>
			
			<th width="24%">Username</th>
			<th width="16%">Name</th>
			<th width="12%">Class</th>
			<th width="30%">Email</th>
			
		</tr>
		<?php
		if(count($records)){
		 $i = 1;	
		 $eachRecord= 0;
		 foreach($records as $key=>$eachRecord){
		?>
		<tr id="<?php echo $eachRecord['userid']; ?>">
			<td><?=$i++;?></td>
			
			<td class="username"><?php echo $eachRecord['username'];?></td>
			<td class="name"><?php echo $eachRecord['name'];?></td>
			<td class="class"><?php echo $eachRecord['class'];?></td>
			<td class="email"><?php echo $eachRecord['email'];?></td>
			
			<td>
				
				<a href="javascript:;" id="<?php echo $eachRecord['userid'];?>" class="ajaxDelete"><img src="" class="dimage"></a>
			</td>
		</tr>
		<?php }
		}
		?>
	</table>
	</center>  
	</div>
	<script src="<?php echo $config['url']['base_url']; ?>/js/bootstrap.min.js"></script>
 </body>
</html>
