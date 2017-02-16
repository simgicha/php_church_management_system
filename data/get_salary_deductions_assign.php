<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();
		$employee_id = mysqli_real_escape_string($link,$_REQUEST["filter"]["filters"][0]["value"]);
		$rs = mysqli_query($link,"SELECT sda.id, sda.employee_id, sda.salary_deduction_id, e.employee_name, sd.deduction_description, sda.amount_deducted FROM  salary_deductions_assign sda, employees e, salary_deductions sd WHERE sda.employee_id = '".$employee_id."' AND e.id = sda.employee_id AND sd.id = sda.salary_deduction_id ORDER BY id DESC");
	
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
        $salary_deduction_id = mysql_real_escape_string($request_vars["salary_deduction_id"]);
        $employee_id = mysql_real_escape_string($request_vars["employee_id"]);
        $amount_deducted = mysql_real_escape_string($request_vars["amount_deducted"]);
		
			// INSERT COMMAND 
		$insert_query = "INSERT INTO salary_deductions_assign(salary_deduction_id,employee_id,amount_deducted) VALUES ('".$salary_deduction_id."','".$employee_id."','".$amount_deducted."')";
		

	   
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
			$salary_deduction_id = mysql_real_escape_string($_POST["salary_deduction_id"]);
			$employee_id = mysql_real_escape_string($_POST["employee_id"]);		
			$amount_deducted = mysql_real_escape_string($_POST["amount_deducted"]);				
			$id = mysql_real_escape_string($_POST["id"]);
			
			$rs = mysqli_query($link,"UPDATE salary_deductions_assign SET employee_id = '" .$employee_id ."',salary_deduction_id = '" .$salary_deduction_id ."',amount_deducted = '" .$amount_deducted ."' WHERE id = " .$id);
		 
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
		
		$rs = mysqli_query($link,"DELETE FROM salary_deductions_assign WHERE id = " .$id);
		
		if ($rs) {
			echo true;
		}
		else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		}
	}	

	
?>