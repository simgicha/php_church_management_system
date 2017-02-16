<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();
		
		$rs = mysqli_query($link,"SELECT id,deduction_description FROM salary_deductions ORDER BY id DESC");
	
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
        $deduction_description = mysql_real_escape_string($request_vars["deduction_description"]);
			
			// INSERT COMMAND 
		$insert_query = "INSERT INTO salary_deductions(deduction_description) VALUES ('".$deduction_description."')";
		

	   
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
			$deduction_description = mysql_real_escape_string($_POST["deduction_description"]);
				
			$id = mysql_real_escape_string($_POST["id"]);
			
			$rs = mysqli_query($link,"UPDATE salary_deductions SET deduction_description = '" .$deduction_description ."' WHERE id = " .$id);
		 
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
		
		$rs = mysqli_query($link,"DELETE FROM salary_deductions WHERE id = " .$id);
		
		if ($rs) {
			echo true;
		}
		else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		}
	}	

	
?>