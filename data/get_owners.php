<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();

		$rs = mysqli_query($link,"SELECT id, owner_name, description, phone_no, id_no  from assets_owners ORDER BY id DESC");
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
			$owner_name = mysql_real_escape_string($request_vars["owner_name"]);
			$description = mysql_real_escape_string($request_vars["description"]);
			$phone_no = mysql_real_escape_string($request_vars["phone_no"]);
			$id_no = mysql_real_escape_string($request_vars["id_no"]);
			
			$insert_query = "INSERT INTO assets_owners(owner_name, description, phone_no, id_no) VALUES ('".$owner_name."','".$description."','".$phone_no."','".$id_no."')";
		   
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
			$owner_name = mysql_real_escape_string($_POST["owner_name"]);
			$description = mysql_real_escape_string($_POST["description"]);			
			$phone_no = mysql_real_escape_string($_POST["phone_no"]);
			$id_no = mysql_real_escape_string($_POST["id_no"]);
			$id = mysql_real_escape_string($_POST["id"]);
			
			$rs = mysqli_query($link,"UPDATE assets_owners SET owner_name = '".$owner_name."',description = '".$description."',phone_no = '".$phone_no."' ,id_no = '" .$id_no ."' WHERE id = " .$id);
		 
			if ($rs) {
				echo json_encode($rs);
			}
			else {
				header("HTTP/1.1 500 Internal Server Error");
				echo "Update failed for asset owner: " .$id;
			}	
	}

	if ($verb == "DELETE") {
		parse_str(file_get_contents('php://input'), $_DELETE);
		$id = mysql_real_escape_string($_DELETE["id"]);
		
		$rs = mysqli_query($link,"DELETE FROM assets_owners WHERE id = " .$id);
		
		if ($rs) {
			echo true;
		}
		else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		}
	}	
	
?>