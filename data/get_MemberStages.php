<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();

		$rs = mysqli_query($link,"SELECT ms.id, ms.member_id, ms.stage_id, ms.date_created, ms.is_active, ms.parish_received,  m.name, s.stage_name FROM stages_members ms, church_stages s, members m WHERE ms.stage_id = s.id AND m.id = ms.member_id ORDER BY id DESC");
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
			$member_id = mysql_real_escape_string($request_vars["member_id"]);	
			$is_active = mysql_real_escape_string($request_vars["is_active"]);
			$stage_id = mysql_real_escape_string($request_vars["stage_id"]);
			$parish_received = mysql_real_escape_string($request_vars["parish_received"]);
			$date_created1 = mysql_real_escape_string($request_vars["date_created"]);
			$date_created = date('Y-m-d', strtotime( $date_created1));
			// INSERT COMMAND 
			$insert_query = "INSERT INTO stages_members(member_id,stage_id, is_active, date_created,parish_received) VALUES ('".$member_id."','".$stage_id."','".$is_active."','".$date_created."','".$parish_received."')";
		   
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
			$member_id = mysql_real_escape_string($_POST["member_id"]);
			$stage_id = mysql_real_escape_string($_POST["stage_id"]);		
			$is_active = mysql_real_escape_string($_POST["is_active"]);
			$parish_received = mysql_real_escape_string($_POST["parish_received"]);
			$id = mysql_real_escape_string($_POST["id"]);
			
			$rs = mysqli_query($link,"UPDATE stages_members SET member_id = '" .$member_id ."',stage_id = '" .$stage_id ."',is_active = '" .$is_active ."', parish_received='".$parish_received."' WHERE id = " .$id);
		 
			if ($rs) {
				echo json_encode($rs);
			}
			else {
				header("HTTP/1.1 500 Internal Server Error");
				echo "Update failed for member stages: " .$id;
			}	
	}

	if ($verb == "DELETE") {
		parse_str(file_get_contents('php://input'), $_DELETE);
		$id = mysql_real_escape_string($_DELETE["id"]);
		
		$rs = mysqli_query($link,"DELETE FROM stages_members WHERE id = " .$id);
		
		if ($rs) {
			echo true;
		}
		else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		}
	}	
	
?>