<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();

		$rs = mysqli_query($link,"SELECT gm.id, gm.member_id, gm.group_id, gm.date_created, gm.is_active, g.name as group_id, m.name as member_id FROM group_members gm, church_groups g, members m WHERE gm.group_id = g.id AND m.id = gm.member_id");
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
			$group_id = mysql_real_escape_string($request_vars["group_id"]);
			$date_created1 = mysql_real_escape_string($request_vars["date_created"]);
			$date_created = date('Y-m-d', strtotime( $date_created1));
			// INSERT COMMAND 
			$insert_query = "INSERT INTO group_members(member_id,group_id, is_active, date_created) VALUES ('".$member_id."','".$group_id."','".$is_active."','".$date_created."')";
		   
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
			$group_id = mysql_real_escape_string($_POST["group_id"]);		
			$is_active = mysql_real_escape_string($_POST["is_active"]);
			
	
			$id = mysql_real_escape_string($_POST["id"]);
			
			$rs = mysqli_query($link,"UPDATE group_members SET member_id = '" .$member_id ."',group_id = '" .$group_id ."',is_active = '" .$is_active ."' WHERE id = " .$id);
		 
			if ($rs) {
				echo json_encode($rs);
			}
			else {
				header("HTTP/1.1 500 Internal Server Error");
				echo "Update failed for member groups: " .$id;
			}	
	}

	if ($verb == "DELETE") {
		parse_str(file_get_contents('php://input'), $_DELETE);
		$id = mysql_real_escape_string($_DELETE["id"]);
		
		$rs = mysqli_query($link,"DELETE FROM group_members WHERE id = " .$id);
		
		if ($rs) {
			echo true;
		}
		else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		}
	}	
	
?>