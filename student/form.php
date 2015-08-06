<?php

error_reporting(E_ALL ^ E_DEPRECATED);

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

    if($login->get_user_type() != 'student') {
        $login->not_authorized_error();
    }

    

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>

	<style type="text/css">
	input[type="submit"]{
  background: #00B85C;
  color:white;
  font-size:20px ;
  border: 1px solid #197519;
  height: 46px;
  width: 150px;
  border-radius: 5px;
  /*text-shadow: 1px 1px 1px #000;*/
}
body {
    width: 1200px;
    margin: 40px auto;
    font-family: 'trebuchet MS', 'Lucida sans', Arial;
    font-size: 14px;
    color: #444;
}
/*
table{
    /*border: 1px solid black;*/
    table-layout: fixed;
    width: 1200px;
}*/

.bordered {
    border: solid #ccc 1px;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    border-radius: 6px;
    -webkit-box-shadow: 0 1px 1px #ccc; 
    -moz-box-shadow: 0 1px 1px #ccc; 
    box-shadow: 0 1px 1px #ccc;         
}

.bordered tr:hover {
    background: #fbf8e9;
    -o-transition: all 0.1s ease-in-out;
    -webkit-transition: all 0.1s ease-in-out;
    -moz-transition: all 0.1s ease-in-out;
    -ms-transition: all 0.1s ease-in-out;
    transition: all 0.1s ease-in-out;     
}    
    
.bordered td, .bordered th {
    border-left: 1px solid #ccc;
    border-top: 1px solid #ccc;
    padding: 10px;
    text-align: left;    
}

.bordered th {
    background-color: #dce9f9;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#ebf3fc), to(#dce9f9));
    background-image: -webkit-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:    -moz-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:     -ms-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:      -o-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:         linear-gradient(top, #ebf3fc, #dce9f9);
    -webkit-box-shadow: 0 1px 0 rgba(255,255,255,.8) inset; 
    -moz-box-shadow:0 1px 0 rgba(255,255,255,.8) inset;  
    box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;        
    border-top: none;
    text-shadow: 0 1px 0 rgba(255,255,255,.5); 
}

.bordered td:first-child, .bordered th:first-child {
    border-left: none;
}

.bordered th:first-child {
    -moz-border-radius: 6px 0 0 0;
    -webkit-border-radius: 6px 0 0 0;
    border-radius: 6px 0 0 0;
}

.bordered th:last-child {
    -moz-border-radius: 0 6px 0 0;
    -webkit-border-radius: 0 6px 0 0;
    border-radius: 0 6px 0 0;
}

.bordered th:only-child{
    -moz-border-radius: 6px 6px 0 0;
    -webkit-border-radius: 6px 6px 0 0;
    border-radius: 6px 6px 0 0;
}

.bordered tr:last-child td:first-child {
    -moz-border-radius: 0 0 0 6px;
    -webkit-border-radius: 0 0 0 6px;
    border-radius: 0 0 0 6px;
}

.bordered tr:last-child td:last-child {
    -moz-border-radius: 0 0 6px 0;
    -webkit-border-radius: 0 0 6px 0;
    border-radius: 0 0 6px 0;
}



/*----------------------*/

.zebra td, .zebra th {
    padding: 10px;
    border-bottom: 1px solid #f2f2f2;    
}

.zebra tbody tr:nth-child(even) {
    background: #f5f5f5;
    -webkit-box-shadow: 0 1px 0 rgba(255,255,255,.8) inset; 
    -moz-box-shadow:0 1px 0 rgba(255,255,255,.8) inset;  
    box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;        
}

.zebra th {
    text-align: left;
    text-shadow: 0 1px 0 rgba(255,255,255,.5); 
    border-bottom: 1px solid #ccc;
    background-color: #eee;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#f5f5f5), to(#eee));
    background-image: -webkit-linear-gradient(top, #f5f5f5, #eee);
    background-image:    -moz-linear-gradient(top, #f5f5f5, #eee);
    background-image:     -ms-linear-gradient(top, #f5f5f5, #eee);
    background-image:      -o-linear-gradient(top, #f5f5f5, #eee); 
    background-image:         linear-gradient(top, #f5f5f5, #eee);
}

.zebra th:first-child {
    -moz-border-radius: 6px 0 0 0;
    -webkit-border-radius: 6px 0 0 0;
    border-radius: 6px 0 0 0;  
}

.zebra th:last-child {
    -moz-border-radius: 0 6px 0 0;
    -webkit-border-radius: 0 6px 0 0;
    border-radius: 0 6px 0 0;
}

.zebra th:only-child{
    -moz-border-radius: 6px 6px 0 0;
    -webkit-border-radius: 6px 6px 0 0;
    border-radius: 6px 6px 0 0;
}

.zebra tfoot td {
    border-bottom: 0;
    border-top: 1px solid #fff;
    background-color: #f1f1f1;  
}

.zebra tfoot td:first-child {
    -moz-border-radius: 0 0 0 6px;
    -webkit-border-radius: 0 0 0 6px;
    border-radius: 0 0 0 6px;
}

.zebra tfoot td:last-child {
    -moz-border-radius: 0 0 6px 0;
    -webkit-border-radius: 0 0 6px 0;
    border-radius: 0 0 6px 0;
}

.zebra tfoot td:only-child{
    -moz-border-radius: 0 0 6px 6px;
    -webkit-border-radius: 0 0 6px 6px
    border-radius: 0 0 6px 6px
}

.bordered {
  table-layout: fixed;
  width: 100%;
  white-space: nowrap;
}
.bordered td {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: auto;
  overflow-x:hidden;
  overflow-y:hidden;
  word-wrap:break-word; 
}

  
</style>
	<link rel="stylesheet" type="text/css" href="radios-to-slider.css">
	<script src="<?php echo $config['url']['base_url'].$config['js_includes']['jquery']; ?>"></script>
	<link rel="stylesheet" href="<?php echo $config['url']['base_url'].$config['css_includes']['jquery-ui']; ?>">
  	<script src="<?php echo $config['url']['base_url'].$config['js_includes']['jquery-ui']; ?>"></script>
	<!-- <link rel="stylesheet" type="text/css" href="radios-to-slider.min.css"> -->
</head>
<body>
 	<script>
  		$(function() {
    		$( "#accordion" ).accordion();
  		});
  	</script>
	<script src="jquery.radios-to-slider.js"></script>
	
	<?php


			$con = mysql_connect($config['db']['server'],$config['db']['username'],$config['db']['password']); //change configs
			$db = mysql_select_db($config['db']['database_name'], $con); //change database
			$c_id = $_GET['courseid'];
			$result=mysql_query("SELECT * FROM questions WHERE courseid='$c_id'") or die(mysql_error());
			// $result=mysql_query("SELECT * FROM t_password WHERE state='$State'");
			$t=0;
			$radio=0;
			$comment=0;
			while($row = mysql_fetch_array($result)) {
		    	$question[]=$row['question'];
		    	$q_id[]=$row['q_id'];
		    	if ( $row['type'] == "radio") {
		    		$rtype[]=$row['question'];
		    		$r_id[]=$row['q_id'];
		    		$radio++;
		    	}
		    	else {
		    		$ctype[]=$row['question'];
		    		$cm_id[]=$row['q_id'];
		    		$comment++;
		    	}
		 		$t++;
		 	}
	?>
<h2>PREFERENCE QUESTIONS</h2>


<form action="feedback2.php" method="post">

<table class="bordered">
    <thead>
	    <tr>
	        <th style="width:10%">#</th>        
	        <th style="width:50%">QUESTIONS</th>
	        <th style="width:40%"></th>
	    </tr>
    </thead>
    <tr>
        <td></td>
        <td>Please select the appropriate option for each statement<br> with the help of the corresponding radio slider.</td>
        <td><img src="<?php echo $config['url']['base_url']."/img/columns.png" ?>"></td>
    </tr>
    <?php
    	$k=0;
    	while ( $k < $radio) {
    ?>
    		<tr>
    			<td><?php echo ($k+1); ?></td>        
	        	<td><?php echo $rtype[$k]; ?></td>
	        	<td>
	        		<div id="radios_<?php echo ($k+1); ?>" style="left:5%">
					    <input id="option1" name="<?php echo $r_id[$k]; ?>[]" type="radio" value="one">
					    <input id="option2" name="<?php echo $r_id[$k]; ?>[]" type="radio" value="two">
					    <input id="option3" name="<?php echo $r_id[$k]; ?>[]" type="radio" value="three" checked>
					    <input id="option4" name="<?php echo $r_id[$k]; ?>[]" type="radio" value="four"> 
					    <input id="option5" name="<?php echo $r_id[$k]; ?>[]" type="radio" value="five">
					    <input id="option6" name="<?php echo $r_id[$k]; ?>[]" type="radio" value="six">
					    <input type="hidden" name="<?php echo $r_id[$k]; ?>[]" value="emptyyy"/>
					</div>
				</td>
			</tr>
    <?php
    		$k++;
    	}       
	?>
</table>
<br><br><br><br>
<center>
<h2>OPEN ANSWER QUESTIONS</h2>
			<div id="accordion" style="width:70%">
				<h3>Responses To Comment Type Questions</h3>
				<div>
					<p>
						Please click on the bar corresponding to the question to write an answer for it
			    	</p>
				</div>
		<?php
			$k=0;
			while($k<$comment) {
				$result=mysql_query("SELECT * FROM feedback WHERE question_id='$q_id[$k]'") or die(mysql_error());
		?>
					<h2> <?php echo $ctype[$k]; ?> </h2>
					<div style="font-family:Times New Roman, Times, serif;font-size:18px">
						<input type="hidden" name="<?php echo $cm_id[$k]; ?>[]" value="emptyyy" />
						<textarea name="<?php echo $cm_id[$k]; ?>[]" rows="5" cols="40"></textarea>
					</div>
		<?php
				// }
				$k++;
			}
		?>
			</div>

<input type="hidden" name="courseid" value="<?php echo $c_id; ?>" />
<br><br><br>
<input type="submit">
</center>
</form>

<script>
		$(document).ready( function(){

			<?php
				$k=0;
				while ( $k < $radio ) {
			?>
					$("#radios_<?php echo ($k+1); ?>").radiosToSlider();
			<?php	
					$k++;
				}
			?>
		});
</script>
</body>
</html>

