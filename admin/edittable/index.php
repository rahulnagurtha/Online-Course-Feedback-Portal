
<?php
	require_once('../../config.php');
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

	if(!isset($_GET['courseid'])) {
		header("Location: ".$config['url']['base_url'].$config['url']['error'].'?msg='.base64_encode('Invalid Course id.'));
	}

	require_once("ajax_table.class.php");
	$obj = new ajax_table(['courseid'=>$_GET['courseid']]);
	$records = $obj->getRecords();
	//echo phpinfo();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <title>Ajax Table Inline Edit</title>
  <script>
	 // Column names must be identical to the actual column names in the database, if you dont want to reveal the column names, you can map them with the different names at the server side.
	 var columns = new Array("question","type");
	 var placeholder = new Array("Enter Question","Select Type");
	 var inputType = new Array("text","select");
	 var table = "tableDemo";
	 var selectOpt = new Array("radio","comment");;


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
 <center>
 <a href="<?php echo $config['url']['base_url'].$config['url']['admin_course_del']."?courseid=".$_GET['courseid']; ?>">Delete Course(-)</a> <i>(Double click field to edit)</i>
	<table border="0" class="tableDemo bordered">
		<tr class="ajaxTitle">
			<th width="2%">Sr</th>
			
			<th width="70%">question</th>
			<th width="20%">type</th>
			
		</tr>
		<?php
		if(count($records)){
		 $i = 1;	
		 $eachRecord= 0;
		 foreach($records as $key=>$eachRecord){
		?>
		<tr id="<?php echo $eachRecord['q_id']; ?>">
			<td><?php echo $i++; ?></td>
			
			<td class="question"><?php echo $eachRecord['question'];?></td>
			<td class="type"><?php echo $eachRecord['type'];?></td>
			
			<td>
				
				<a href="javascript:;" id="<?php echo $eachRecord['q_id'];?>" class="ajaxDelete"><img src="" class="dimage"></a>
			</td>
		</tr>
		<?php }
		}
		?>
	</table>  
	<input type="hidden" id="courseid" value="<?php echo $_GET['courseid'] ?>">

	</center>
 </body>
</html>
