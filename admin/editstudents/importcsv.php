<?php

	require_once('../../config.php');
	require_once(BASE_PATH.'/login_handler.php');
	require_once(BASE_PATH.'/medoo.min.php');
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

	if(isset($_FILES['userfile']['name'])) {
		//process upload
		$uploaddir = BASE_PATH.$config['url']['csv_data_students'];
		$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
			//process csv and insert fields
    		$handle = fopen($uploaddir . basename($_FILES['userfile']['name']), "r");
    		$datas = fgetcsv($handle, 1000, ",");
    		//search for correct fields.
    		$fields = ['username', 'name', 'class', 'email'];
    		$result = [];
    		$i = 0; $j = 0;
    		for($j=0;$j<count($datas)&&$i < 4;$j++) {
    			if(strtolower($datas[$j]) == $fields[$i]) {
    				$result[] = $j;
    				$i++;
    			}
    		}
    		//insert into db
    		 while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    		 	$db = new medoo($config['db']);

    		 	//insert into users
    		 	$userid = $db->insert('users',['username' => $data[$result[0]], 
    		 							'password' => password_hash($data[$result[0]], PASSWORD_BCRYPT),
    		 							'type' => 'student'
    		 		]);

    		 	//insert into students
    		 	$db->insert('students', [	'userid' => $userid,
    		 								'username' => $data[$result[0]],
    		 								'name' => $data[$result[1]],
    		 								'class' => $data[$result[2]],
    		 								'email' => $data[$result[3]]
    		 		]);

    		 	//complete redirect back to student edit panel
    		 	header("Location: ".$config['url']['base_url'].$config['url']['edit_students']);
    		 	
    		 }
		} else {
    		header("Location: ".$config['url']['base_url'].$config['url']['error'].'?msg='.base64_encode('Something went wrong with the file upload.'));
		}

		
	}

	else {
		//diplay upload form
		?>

		<!-- The data encoding type, enctype, MUST be specified as below -->
        <center>
        <Br><BR><br><Br><br>
<form enctype="multipart/form-data" action="importcsv.php" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <!-- Name of input element determines name in $_FILES array -->
    Upload file: <input name="userfile" type="file" />
    <input type="submit" value="Import Data" />
</form>
</center>

		<?php


	}


?>