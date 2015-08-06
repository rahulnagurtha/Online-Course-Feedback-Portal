<?php
	error_reporting(E_ALL ^ E_DEPRECATED);

	/*
	* Add edit delete rows dynamically using jquery and php
	* http://www.amitpatil.me/
	*
	* @version
	* 2.0 (4/19/2014)
	* 
	* @copyright
	* Copyright (C) 2014-2015 
	*
	* @Auther
	* Amit Patil
	* Maharashtra (India)
	*
	* @license
	* This file is part of Add edit delete rows dynamically using jquery and php.
	* 
	* Add edit delete rows dynamically using jquery and php is freeware script. you can redistribute it and/or 
	* modify it under the terms of the GNU Lesser General Public License as published by
	* the Free Software Foundation, either version 3 of the License, or
	* (at your option) any later version.
	* 
	* Add edit delete rows dynamically using jquery and php is distributed in the hope that it will be useful,
	* but WITHOUT ANY WARRANTY; without even the implied warranty of
	* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	* GNU General Public License for more details.
	* 
	* You should have received a copy of the GNU General Public License
	* along with this script.  If not, see <http://www.gnu.org/copyleft/lesser.html>.
	*/

require_once(dirname(dirname(__FILE__)) . '\editprofs\config.php');

class ajax_table {
     
  public function __construct($in_data){
	$this->dbconnect();
	$this->db_table = "profs";
	$this->in_data = $in_data;
  }
   
  private function dbconnect() {
    $conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
      or die ("<div style='color:red;'><h3>Could not connect to MySQL server</h3></div>");
         
    mysql_select_db(DB_DB,$conn)
      or die ("<div style='color:red;'><h3>Could not select the indicated database</h3></div>");
     
    return $conn;
  }
   
  function getRecords(){
	$this->res = mysql_query("select * from profs");
	if(mysql_num_rows($this->res)){
		while($this->row = mysql_fetch_assoc($this->res)){
			$record = array_map('stripslashes', $this->row);
			$this->records[] = $record; 
		}
		return $this->records;
	}
	//else echo "No records found";
  }	

  function save($data){
	if(count($data)){
		//data for profs table
		$student_data = $data;
		unset($data['name']);
		unset($data['email']);

		//set password
		$data['password'] = password_hash($data['username'], PASSWORD_BCRYPT);
		$data['type'] = 'prof';
		$values = implode("','", array_values($data));
		mysql_query("insert into users (".implode(",",array_keys($data)).") values ('".$values."')");

		//setting userid
		$student_data['userid'] = mysql_insert_id();
		$values = implode("','", array_values($student_data));
		mysql_query("insert into profs (".implode(",",array_keys($student_data)).") values ('".$values."')");
		
		return $student_data['userid'];
	}
	else return 0;	
  }	

  function delete_record($id){
	 if($id){
	 	//delete from use table
		mysql_query("delete from users where userid = $id limit 1");
		//delete from student table
		mysql_query("delete from profs where userid = $id limit 1");
		$res = mysql_affected_rows();
		
		return $res;
	 }
  }	

  function update_record($data){
	if(count($data)){
		$id = $data['rid'];
		unset($data['rid']);
		$values = implode("','", array_values($data));
		$str = "";
		foreach($data as $key=>$val){
			$str .= $key."='".$val."',";
		}
		$str = substr($str,0,-1);
		$sql = "update profs set $str where userid = $id limit 1";

		//update user table
		unset($data['name']);
		unset($data['email']);

		$values = implode("','", array_values($data));
		$str = "";
		foreach($data as $key=>$val){
			$str .= $key."='".$val."',";
		}
		$str = substr($str,0,-1);
		$sql = "update users set $str where userid = $id limit 1";



		$res = mysql_query($sql);
		
		if(mysql_affected_rows()) return $id;
		return 0;
	}
	else return 0;	
  }	

  function update_column($data){
	if(count($data)){
		$id = $data['rid'];
		unset($data['rid']);
		$sql = "update profs set ".key($data)."='".$data[key($data)]."' where userid = $id limit 1";
		$res = mysql_query($sql);

		//update user table is username affected
		if(key($data)=='username') {
		$sql = "update users set ".key($data)."='".$data[key($data)]."' where userid = $id limit 1";
		$res = mysql_query($sql);
		}
		if(mysql_affected_rows()) return $sql;
		return 0;
		
	}	
  }

  function error($act){
	 return json_encode(array("success" => "0","action" => $act));
  }

}
?>