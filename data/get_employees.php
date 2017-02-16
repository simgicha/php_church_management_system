<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();
	
		$rs = mysqli_query($link,"SELECT id,kra_pin,nssf,nhif,date_of_employment,active,employee_name FROM employees");
	
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
        $kra_pin = mysql_real_escape_string($request_vars["kra_pin"]);
        $nssf = mysql_real_escape_string($request_vars["nssf"]);
        $nhif = mysql_real_escape_string($request_vars["nhif"]);
	    $date_of_employment1 = mysql_real_escape_string($request_vars["date_of_employment"]);
		$date_of_employment = date('Y-m-d', strtotime($date_of_employment1));
        $active = mysql_real_escape_string($request_vars["active"]);
	    $employee_name = mysql_real_escape_string($request_vars["employee_name"]);
				
			// INSERT COMMAND 
		$insert_query = "INSERT INTO employees(kra_pin,nssf,nhif,date_of_employment,active,employee_name) VALUES ('".$kra_pin."','".$nssf."','".$nhif."','".$date_of_employment."','".$active."','".$employee_name."')";
		

	   
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
			$kra_pin = mysql_real_escape_string($_POST["kra_pin"]);
			$nssf = mysql_real_escape_string($_POST["nssf"]);		
			$nhif = mysql_real_escape_string($_POST["nhif"]);
			$active = mysql_real_escape_string($_POST["active"]);	
			$employee_name = mysql_real_escape_string($_POST["employee_name"]);		
			$id = mysql_real_escape_string($_POST["id"]);
			
			$rs = mysqli_query($link,"UPDATE employees SET kra_pin = '" .$kra_pin ."',nssf = '" .$nssf ."',nhif = '" .$nhif ."',active = '" .$active ."',employee_name = '" .$employee_name ."' WHERE id = " .$id);
		 
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
		
		$rs = mysqli_query($link,"DELETE FROM employees WHERE id = " .$id);
		
		if ($rs) {
			echo true;
		}
		else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		}
	}	

	
?>