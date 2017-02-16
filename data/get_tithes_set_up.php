<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();

		$rs = mysqli_query($link,"SELECT id, Year, description, target, status FROM ten_percent_configuration");
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
			$start_date1 = mysql_real_escape_string($request_vars["Year"]);	
					
			$description = mysql_real_escape_string($request_vars["description"]);
			$target = mysql_real_escape_string($request_vars["target"]);
			$status = mysql_real_escape_string($request_vars["status"]);			
			$start_date = date('Y-m-d', strtotime( $start_date1));
			
			// INSERT COMMAND 
			$insert_query = "INSERT INTO ten_percent_configuration(Year, description, target, status) VALUES ('".$start_date."','".$description."','".$target."','".$status."')";
		   
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
			//$ = mysql_real_escape_string($_POST["member_id"]);
			$description = mysql_real_escape_string($_POST["description"]);		
			$target = mysql_real_escape_string($_POST["target"]);
			$status = mysql_real_escape_string($_POST["status"]);		
			$id = mysql_real_escape_string($_POST["id"]);
			$Year = mysql_real_escape_string($_POST["Year"]);	
			$end_date = date('Y-m-d', strtotime( $end_date1));
			
			$rs = mysqli_query($link,"UPDATE ten_percent_configuration SET status = '" .$status ."',description = '" .$description ."',target = '" .$target ."' WHERE id = " .$id);
		 
			if ($rs) {
				echo json_encode($rs);
			}
			else {
				header("HTTP/1.1 500 Internal Server Error");
				echo "Update failed for tithe stages: " .$id;
			}	
	}

	if ($verb == "DELETE") {
		parse_str(file_get_contents('php://input'), $_DELETE);
		$id = mysql_real_escape_string($_DELETE["id"]);
		
		$rs = mysqli_query($link,"DELETE FROM ten_percent_configuration WHERE id = " .$id);
		
		if ($rs) {
			echo true;
		}
		else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		}
	}	
	
?>