<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();
		$local_church_id = mysqli_real_escape_string($link,$_REQUEST["filter"]["filters"][0]["value"]);
		$rs = mysqli_query($link,"SELECT l.id, l.member_id, l.position_id, l.start_date, l.is_active, l.local_church_id, m.name, p.position FROM leadership_assignments l, members m, leadership_positions p WHERE m.id = l.member_id AND p.id = l.position_id AND l.local_church_id = '".$local_church_id."'");
	
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
		 $position_id = mysql_real_escape_string($request_vars["position_id"]);	
		 $start_date1 = mysql_real_escape_string($request_vars["start_date"]);	
		 $is_active = mysql_real_escape_string($request_vars["is_active"]);			 		 
	    $local_church_id = mysql_real_escape_string($_GET["local_church_id"]);
		$start_date = date('Y-m-d', strtotime( $start_date1));		
		
		$insert_query = "INSERT INTO leadership_assignments(member_id, position_id, start_date, is_active, local_church_id) VALUES ('".$member_id."','".$position_id."','".$start_date."','".$is_active."','".$local_church_id."')";   
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
			$position_id = mysql_real_escape_string($_POST["position_id"]);	
			$start_date1 = mysql_real_escape_string($_POST["start_date"]);	
			$start_date = date('Y-m-d', strtotime( $start_date1));	
			$is_active = mysql_real_escape_string($_POST["is_active"]);	
			$local_church_id = mysql_real_escape_string($_POST["local_church_id"]);					
			$id = mysql_real_escape_string($_POST["id"]);
			
			$rs = mysqli_query($link,"UPDATE leadership_assignments SET member_id = '" .$member_id ."',position_id = '" .$position_id ."',is_active = '" .$is_active ."',local_church_id = '" .$local_church_id ."' WHERE id = " .$id);
		 
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
		
		$rs = mysqli_query($link,"DELETE FROM leadership_assignments WHERE id = " .$id);
		
		if ($rs) {
			echo true;
		}
		else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		}
	}	
?>