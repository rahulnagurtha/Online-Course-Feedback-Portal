<?php
	error_reporting(E_ALL ^ E_DEPRECATED);


require_once(dirname(dirname(__FILE__)) . '\edittable\config.php');

class ajax_table {
     
  public function __construct($in_data){
	$this->dbconnect();
	$this->db_table = "questions";
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
	$this->res = mysql_query("select * from $this->db_table where courseid = ". $this->in_data['courseid']." AND type = 'open'");
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
		$values = implode("','", array_values($data));
		mysql_query("insert into $this->db_table (".implode(",",array_keys($data)).") values ('".$values."')");
		
		if(mysql_insert_id()) return mysql_insert_id();
		return 0;
	}
	else return 0;	
  }	

  function delete_record($id){
	 if($id){
		mysql_query("delete from $this->db_table where q_id = $id limit 1");
		return mysql_affected_rows();
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
		$sql = "update $this->db_table set $str where q_id = $id limit 1";

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
		$sql = "update $this->db_table set ".key($data)."='".$data[key($data)]."' where q_id = $id limit 1";
		$res = mysql_query($sql);
		if(mysql_affected_rows()) return $id;
		return 0;
		
	}	
  }

  function error($act){
	 return json_encode(array("success" => "0","action" => $act));
  }

}
?>