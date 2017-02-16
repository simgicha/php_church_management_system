<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();

		$rs = mysqli_query($link,"SELECT m.id,m.name,m.local_church, m.scc,m.registration_date,m.marrital_status, m.phone_number, mar.marital_status, l.name as local_church_name, s.name as scc_name from members m, local_church l, small_christian_community s, marital_status mar WHERE m.local_church = l.id AND s.id = m.scc AND mar.id = m.marrital_status ORDER BY id DESC");
		while($obj = mysqli_fetch_object($rs)) {
			$arr[] = $obj;
		}
	
		// add the header line to specify that the content type is JSON
		header("Content-type: application/json");
	
		echo "{\"data\":" .json_encode($arr). "}";
	}
	
	if ($verb == "PUT") {
		
			$request_vars = Array();
			parse_str(file_get_contents('php://input'), $request_vars );
			$name = mysql_real_escape_string($request_vars["name"]);	
			$local_church = mysql_real_escape_string($request_vars["local_church"]);
			$scc = mysql_real_escape_string($request_vars["scc"]);			
			$marrital_status = mysql_real_escape_string($request_vars["marrital_status"]);						
			$phone_number = mysql_real_escape_string($request_vars["phone_number"]);
			
			$registration_date1 = mysql_real_escape_string($request_vars["registration_date"]);
			$registration_date = date('Y-m-d', strtotime( $registration_date1));
			// INSERT COMMAND 
			$insert_query = "INSERT INTO members(name,local_church, scc,marrital_status, phone_number) VALUES ('".$name."','".$local_church."','".$scc."','".$marrital_status."','".$phone_number."')";
		   
		  $rs = mysqli_query($link,$insert_query);
		
		  if ($rs) {
			echo json_encode($rs);
		  }
		  else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		  }	   
    }
	if ($verb == "POST") {
			$name = mysql_real_escape_string($_POST["name"]);
			$local_church = mysql_real_escape_string($_POST["local_church"]);		
			$scc = mysql_real_escape_string($_POST["scc"]);
			$marrital_status = mysql_real_escape_string($_POST["marrital_status"]);	
			$phone_number = mysql_real_escape_string($_POST["phone_number"]);	
			
				
			$id = mysql_real_escape_string($_POST["id"]);
			
			$rs = mysqli_query($link,"UPDATE members SET name = '" .$name ."',local_church = '" .$local_church ."',marrital_status = '" .$marrital_status ."',phone_number = '" .$phone_number."' WHERE id = " .$id);
		 
			if ($rs) {
				echo json_encode($rs);
			}
			else {
				header("HTTP/1.1 500 Internal Server Error");
				echo "Update failed for member: " .$id;
			}	
	}

	if ($verb == "DELETE") {
		parse_str(file_get_contents('php://input'), $_DELETE);
		$id = mysql_real_escape_string($_DELETE["id"]);
		
		$rs = mysqli_query($link,"DELETE FROM members WHERE id = " .$id);
		
		if ($rs) {
			echo true;
		}
		else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		}
	}	
	
?>