<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();
		$e_id = mysqli_real_escape_string($link,$_REQUEST["filter"]["filters"][0]["value"]);
		$rs = mysqli_query($link,"SELECT l.id,l.employee_id, l.start_date, l.no_of_days, l.reason, e.employee_name FROM employee_leave_days l, employees e WHERE e.id = l.employee_id AND l.employee_id = '$e_id' AND l.type = 1 ORDER BY l.id DESC");
	
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
        $employee_id = mysql_real_escape_string($request_vars["employee_id"]);
        $no_of_days = mysql_real_escape_string($request_vars["no_of_days"]);
        $start_date1 = mysql_real_escape_string($request_vars["start_date"]);
        $start_date = date('Y-m-d', strtotime( $start_date1));	
		$reason = mysql_real_escape_string($request_vars["reason"]);					
			// INSERT COMMAND 
		$insert_query = "INSERT INTO employee_leave_days(employee_id,no_of_days,start_date, type,reason) VALUES ('".$employee_id."','".$no_of_days."','".$start_date."',1,'".$reason."')";
		

	   
	  $rs = mysqli_query($link,$insert_query);
	
	  if ($rs) {
		  
		  //header("location: employees-payments.php");	
		echo json_encode($rs);
		
	  }
	  else {
		header("HTTP/1.1 500 Internal Server Error");
		echo false;
	  }	   
	   

    }
	if ($verb == "POST") {
			$employee_id = mysql_real_escape_string($_POST["employee_id"]);
			$no_of_days = mysql_real_escape_string($_POST["no_of_days"]);
			$start_date1 = mysql_real_escape_string($_POST["start_date"]);
			$reason = mysql_real_escape_string($_POST["reason"]);										
			$id = mysql_real_escape_string($_POST["id"]);
			
			$rs = mysqli_query($link,"UPDATE employee_leave_days SET employee_id = '" .$employee_id ."' WHERE id = " .$id);
		 
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