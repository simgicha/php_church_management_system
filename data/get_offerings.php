<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();

		$rs = mysqli_query($link,"SELECT o.id,o.local_church_id,o.contribution_date,o.amount, l.name as local_church_name FROM offerings o, local_church l WHERE o.local_church_id = l.id");
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
			$local_church_id = mysql_real_escape_string($request_vars["local_church_id"]);	
			$amount = mysql_real_escape_string($request_vars["amount"]);
			$contribution_date1 = mysql_real_escape_string($request_vars["contribution_date"]);	
			$contribution_date = date('Y-m-d', strtotime( $contribution_date1));		
						
			
			// INSERT COMMAND 
			$insert_query = "INSERT INTO offerings(local_church_id, amount,contribution_date) VALUES ('".$local_church_id."','".$amount."','".$contribution_date."')";
		   
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
			$local_church_id = mysql_real_escape_string($_POST["local_church_id"]);
			$amount = mysql_real_escape_string($_POST["amount"]);	
			$contribution_date1 = mysql_real_escape_string($_POST["contribution_date"]);	
			$contribution_date = date('Y-m-d', strtotime( $contribution_date1));			
			$id = mysql_real_escape_string($_POST["id"]);
			
			$rs = mysqli_query($link,"UPDATE offerings SET local_church_id = '" .$local_church_id ."',amount = '" .$amount ."',contribution_date = '" .$contribution_date ."' WHERE id = " .$id);
		 
			if ($rs) {
				echo json_encode($rs);
			}
			else {
				header("HTTP/1.1 500 Internal Server Error");
				echo "Update failed for church: " .$id;
			}	
	}

	if ($verb == "DELETE") {
		parse_str(file_get_contents('php://input'), $_DELETE);
		$id = mysql_real_escape_string($_DELETE["id"]);
		
		$rs = mysqli_query($link,"DELETE FROM offerings WHERE id = " .$id);
		
		if ($rs) {
			echo true;
		}
		else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		}
	}	
	
?>