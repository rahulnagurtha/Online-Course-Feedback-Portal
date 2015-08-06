<?php

error_reporting(E_ALL ^ E_DEPRECATED);

date_default_timezone_set('Indian/Maldives');
require_once('../config.php');
require_once(BASE_PATH.'/login_handler.php');
require_once(BASE_PATH.'/medoo.min.php');

//check login status
$login = new LoginHandler($config);
if(!$login->is_logged_in()) {
	$login->redirect_login('Please login');
}

  if($login->get_user_type() != 'prof') {
    $login->not_authorized_error();
  }

  	if(isset($_GET['operation'])) {
				header('Content-Type: text/csv; charset=utf-8');
				header('Content-Disposition: attachment; filename='.date('j\-m\-Y\-\f\e\e\d\b\a\c\k').'.csv');

					$con = mysql_connect($config['db']['server'],$config['db']['username'],$config['db']['password']); //change configs
			$db = mysql_select_db($config['db']['database_name'], $con); //change database
			$c_id = $_GET['courseid'];
			$result=mysql_query("SELECT * FROM questions WHERE courseid='$c_id'") or die(mysql_error());
			$t=0;
			while($row = mysql_fetch_array($result)) {
		    	$question[]=$row['question'];
		    	$q_id[]=$row['q_id'];
		    	$type[]=$row['type'];
		 		$t++;
		 	}
			$k=0;

			$output = fopen('php://output', 'w');
			// output the column headings
			fputcsv($output, array('Question', 'Strongly Disagree', 'Disagree', 'Neutral', 'Agree', 'Strongly agree', 'Cannot judge'));

			$p=1;
			while($k<$t) {
				$result=mysql_query("SELECT * FROM feedback WHERE question_id='$q_id[$k]'") or die(mysql_error());
				$resp = array("question" => $question[$k],"one"=>"0", "two"=>"0", "three"=>"0" , "four"=>"0", "five"=>"0", "six"=>"0");
				if( $type[$k] == "radio" ) {

					while ($row = mysql_fetch_array($result)) {
				 		$resp[$row['answer']]++;
					}
					$p++;

					fputcsv($output, $resp);

						}
				$k++;
			}

				//reset feedback data
				$db = new medoo($config['db']);
				$db->delete('feedback', ['courseid' => $_GET['courseid']]);
				$db->update('student_course', ['done' => 0], ['course' => $_GET['courseid']]);


			}

			else {

?>

<!doctype html>
<html>
	<head>
		<title>Feedback Statistics</title>
		<script src="<?php echo $config['url']['base_url'].$config['js_includes']['jquery']; ?>"></script>
		<script src="Chart.js"></script>
	
		<link rel="stylesheet" href="accr.css" />

		<script src="accr.js"></script>
		<script>
		  $(function() {
		    $( "#accordion" ).accordion();
		  });
		</script>



		<link rel="stylesheet" href="<?php echo $config['url']['base_url'].$config['css_includes']['jquery-ui']; ?>">
  <script src="<?php echo $config['url']['base_url'].$config['js_includes']['jquery']; ?>"></script>
  <script src="<?php echo $config['url']['base_url'].$config['js_includes']['jquery-ui']; ?>"></script>

  <script>
  $(function() {
    $( "#speed" ).selectmenu();
 
    $( "#files" ).selectmenu();
 
    $( "#number" )
      .selectmenu()
      .selectmenu( "menuWidget" )
        .addClass( "overflow" );
  });
  </script>

  <script type="text/javascript">
    
  </script>
  <style>
    fieldset {
      border: 0;
    }
    label {
      display: block;
      margin: 30px 0 0 0;
    }
    select {
      width: 200px;
    }
    .overflow {
      height: 200px;
    }
    li {
      list-style: square;
      /*content: "40";*/
      font-size: 18px ;
    }

    #top1{
    background: #2184A6;
    color:white;
    font-size:20px ;
    border: 1px solid #197519;
    height: 46px;
    width: 150px;
    border-radius: 5px;
}

#top2{
    background: #2184A6;
    color:white;
    font-size:20px ;
    border: 1px solid #197519;
    height: 46px;
    width: 150px;
    border-radius: 5px;
}

#top3{
    background: #2184A6;
    color:white;
    font-size:20px ;
    border: 1px solid #197519;
    height: 46px;
    width: 150px;
    border-radius: 5px;
}


  </style>

<script type="text/javascript">
	function tot(i) {
		document.getElementById("total").innerHTML="Total Responses:"+i;
	}
</script>

	</head>
	<body style="background-color:#EFEFF9;">

<center>
    <div>
        <button id="top1"><a target="_blank" href="<?php echo $config['url']['base_url'].$config['url']['prof_add_question']."?courseid=".$_GET['courseid']; ?>" style="color: #ffffff; text-decoration: none;">Add Questions</a></button>
        <button id="top2"><a href="<?php echo $config['url']['base_url'].$config['url']['feedback_statistics']."?courseid=".$_GET['courseid']."&operation=t"; ?>" style="color: #ffffff; text-decoration: none;">Archive</a></button>
        <button id="top3"><a href="<?php echo $config['url']['base_url'].$config['url']['course_email']."?courseid=".$_GET['courseid']; ?>" style="color: #ffffff; text-decoration: none;">Email notif</a></button>
    </div>
    </center>

	<center>



		<h1>PREFERENCE QUESTIONS</h1>
		<div style="width:700px;">
			<ul>
			   <li style="color:#FF0000;display:inline;margin-left:12px;margin-right:12px;">Strongly-Disagree</li>
			   <li style="color:#FF9900;display:inline;margin-left:12px;margin-right:12px">Disagree</li>
			   <li style="color:#8A2E00;display:inline;margin-left:12px;margin-right:12px">Neutral</li>
			   <li style="color:#99CC00;display:inline;margin-left:12px;margin-right:12px">Agree</li>
			   <li style="color:#001D00;display:inline;margin-left:12px;margin-right:12px">Strongly-Agree</li>
			   <li style="color:#003399;display:inline;margin-left:12px;margin-right:12px">Can't Judge</li>
			</ul>
		</div>
		<div id="canvas-holder">
			<canvas id="chart-area" width="300" height="300"/></canvas>
		</div>
		<br><br>
		<div id="total" style="font-size:20px">
			
		</div>
		<br><br>
		<script>
			
			var stats=[[
						{
							value: 1,
							color:"#F7464A",
							highlight: "#FF5A5E",
							label: "Strongly Disagree"
						},
						{
							value: 1,
							color: "#46BFBD",
							highlight: "#5AD3D1",
							label: "Disagree"
						},
						{
							value: 1,
							color: "#FDB45C",
							highlight: "#FFC870",
							label: "Neutral"
						},
						{
							value: 1,
							color: "#949FB1",
							highlight: "#A8B3C5",
							label: "Agree"
						},
						{
							value: 1,
							color: "#4D5360",
							highlight: "#616774",
							label: "Strongly Agree"
						},
						{
							value: 1,
							color: "#4D5360",
							highlight: "#616774",
							label: "Can't judge"
						}
						
					]];
			var sum=[0];
		</script>
		<?php
		
			$con = mysql_connect($config['db']['server'],$config['db']['username'],$config['db']['password']); //change configs
			$db = mysql_select_db($config['db']['database_name'], $con); //change database
			$c_id = $_GET['courseid'];
			$result=mysql_query("SELECT * FROM questions WHERE courseid='$c_id'") or die(mysql_error());
			$t=0;
			while($row = mysql_fetch_array($result)) {
		    	$question[]=$row['question'];
		    	$q_id[]=$row['q_id'];
		    	$type[]=$row['type'];
		 		$t++;
		 	}
			$k=0;
		?>
			<fieldset>
			    <select style="width: 450px;" name="files" id="files">
			        <option selected="selected">Select a Question</option>
		<?php
			$p=1;
			while($k<$t) {
				$result=mysql_query("SELECT * FROM feedback WHERE question_id='$q_id[$k]'") or die(mysql_error());
				$resp = array("one"=>"0", "two"=>"0", "three"=>"0" , "four"=>"0", "five"=>"0", "six"=>"0");
				if( $type[$k] == "radio" ) {
		?>
					<option value="<?php echo $p ?>"><?php echo $question[$k];?></option>
		<?php
					while ($row = mysql_fetch_array($result)) {
				 		$resp[$row['answer']]++;
					}
					$p++;
		?>
					<script type="text/javascript">
						var pieData = [
						{
							value: <?php echo $resp["one"];?>,
							color:"#FF0000",
							highlight: "#FF4D4D",
							label: "Strongly Disagree"
						},
						{
							value: <?php echo $resp["two"];?>,
							color: "#FF9900",
							highlight: "#FFB84D",
							label: "Disagree"
						},
						{
							value: <?php echo $resp["three"];?>,
							color: "#8A2E00",
							highlight: "#A15833",
							label: "Neutral"
						},
						{
							value: <?php echo $resp["four"];?>,
							color: "#99CC00",
							highlight: "#B8DB4D",
							label: "Agree"
						},
						{
							value: <?php echo $resp["five"];?>,
							color: "#001D00",
							highlight: "#193419",
							label: "Strongly Agree"
						},
						{
							value: <?php echo $resp["six"];?>,
							color: "#003399",
							highlight: "#335CAD",
							label: "Can't Judge"
						}

					];
					stats.push(pieData);
					var a=<?php echo $resp["one"] ?>+<?php echo $resp["two"] ?>+<?php echo $resp["three"] ?>+<?php echo $resp["four"] ?>+<?php echo $resp["five"] ?>+<?php echo $resp["six"] ?>;
					console.log(a);
					sum.push(a);
					</script>
		<?php
				}
				$k++;
			}
		?>
				</select>
		    </fieldset>
		    <h1>OPEN ANSWER QUESTIONS</h1>
			<div id="accordion" style="width:50%">
				<h3>Responses To Comment Type Questions</h3>
				<div>
					<p>
						Please click on the bar corresponding to the question to view the responses for it
			    	</p>
				</div>
		<?php
			$k=0;
			while($k<$t) {
				$result=mysql_query("SELECT * FROM feedback WHERE question_id='$q_id[$k]'") or die(mysql_error());
				$p=0;
				if( $type[$k] == "comment" || $type[$k] == "open" ) {
		?>
					<h2> <?php echo $question[$k]; ?> </h2>
					<div style="font-family:Times New Roman, Times, serif;font-size:18px">
		<?php
					$p=0;
					while ($row = mysql_fetch_array($result)) {
				 		// echo ($p+1).".".$row['comment']."<br>";
						echo $row['comment']."<br>";
				 		$p++;
				 		echo "<hr>";
					}
		?>
					</div>
		<?php
				}
				$k++;
			}
		?>
			</div>
		</center>
		<script type="text/javascript">
			$('#files').on( "selectmenuselect", function( event, ui ) {
						console.log(ui.item.value);
				        $('#chart-area').remove(); // this is my <canvas> element
		  				$('#canvas-holder').append('<canvas id="chart-area" width="300" height="300"><canvas>');
						var ctx = document.getElementById("chart-area").getContext("2d");
						window.myPie = new Chart(ctx).Pie(stats[ui.item.value]);
						tot(sum[ui.item.value]);
				    } );
		</script>>
	</body>
</html>


<?php
}

?>
