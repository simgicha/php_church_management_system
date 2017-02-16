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
		$rs = mysqli_query($link,"SELECT ec.id, ec.employee_id,ec.category_id,ec.start_date,ec.is_active, e.employee_name, c.category_name FROM employee_category_assign ec, employees e, employee_categories c WHERE ec.employee_id = e.id AND ec.category_id = c.id AND ec.employee_id = '".$employee_id."' ORDER BY ec.id DESC");
	
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
        $category_id = mysql_real_escape_string($request_vars["category_id"]);
        $is_active = mysql_real_escape_string($request_vars["is_active"]);
        $start_date1 = mysql_real_escape_string($request_vars["start_date"]);	
		$start_date = date('Y-m-d', strtotime($start_date1));			
			// INSERT COMMAND 
		$insert_query = "INSERT INTO employee_category_assign(employee_id,category_id,start_date,is_active ) VALUES ('".$employee_id."','".$category_id."','".$start_date."','".$is_active."')";
		

	   
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
			$employee_id = mysql_real_escape_string($_POST["employee_id"]);
			$category_id = mysql_real_escape_string($_POST["category_id"]);		
			$is_active = mysql_real_escape_string($_POST["is_active"]);	
			$start_date1 = mysql_real_escape_string($_POST["start_date"]);	
		    $start_date = date('Y-m-d', strtotime($start_date1));				
			$id = mysql_real_escape_string($_POST["id"]);
			
			$rs = mysqli_query($link,"UPDATE employee_category_assign SET employee_id = '" .$employee_id ."',category_id = '" .$category_id ."',is_active = '" .$is_active ."',start_date = '" .$start_date ."' WHERE id = " .$id);
		 
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
		
		$rs = mysqli_query($link,"DELETE FROM employee_category_assign WHERE id = " .$id);
		
		if ($rs) {
			echo true;
		}
		else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		}
	}	

	
?>