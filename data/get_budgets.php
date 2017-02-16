<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();
	
		$rs = mysqli_query($link,"SELECT b.id, b.ref_no, b.description,b.date_created,b.sync_datetime from budget_ref b ORDER BY id DESC");
	
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
        $ref_no = mysql_real_escape_string($request_vars["ref_no"]);
        $description = mysql_real_escape_string($request_vars["description"]);
        $date_created1 = mysql_real_escape_string($request_vars["date_created"]);	
	    $date_created = date('Y-m-d', strtotime( $date_created1));
		
			// INSERT COMMAND 
		$insert_query = "INSERT INTO budget_ref(ref_no, description, date_created) VALUES ('".$ref_no."','".$description."','".$date_created."')";
		

	   
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
			$ref_no = mysql_real_escape_string($_POST["ref_no"]);
			$description = mysql_real_escape_string($_POST["description"]);			
			$id = mysql_real_escape_string($_POST["id"]);
			
			$rs = mysqli_query($link,"UPDATE budget_ref SET ref_no = '" .$ref_no ."',description = '" .$description ."' WHERE id = " .$id);
		 
			if ($rs) {
				echo json_encode($rs);
			}
			else {
				header("HTTP/1.1 500 Internal Server Error");
				echo "Update failed for budget: " .$id;
			}	
	}
	if ($verb == "DELETE") {
		parse_str(file_get_contents('php://input'), $_DELETE);
		$id = mysql_real_escape_string($_DELETE["id"]);
		
		$rs = mysqli_query($link,"DELETE FROM budget_ref WHERE id = " .$id);
		
		if ($rs) {
			echo true;
		}
		else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		}
	}		
?>