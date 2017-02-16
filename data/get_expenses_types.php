<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();
		
	
		$rs = mysqli_query($link,"SELECT id, expense_name  FROM  expenses_types");
	
		while($obj = mysqli_fetch_object($rs)) {
	
			$arr[] = $obj;
	
		}
	
		// add the header line to specify that the content type is JSON
		header("Content-type: application/json");
	
		//echo "{\"data\":" .json_encode($arr). "}";
		echo "{\"data\":" .json_encode($arr). "}";

	}
	
	if ($verb == "POST") {
		
        $expense_name = mysql_real_escape_string($_POST["expense_name"]);
	
		$sql = "INSERT INTO expenses_types (expense_name) VALUES ('".$expense_name."')";
	
	 	$rs = mysqli_query($link,$sql);
		
		  if ($rs) {
			echo json_encode($rs);
			
		  }
		  else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		  }	   
    }
	
	if ($verb == "PUT") {
		$request_vars = Array();
		parse_str(file_get_contents('php://input'), $request_vars );
	

		$building_name = mysql_real_escape_string($request_vars["building_name"]);
		$id = mysql_real_escape_string($request_vars["id"]);
		$Town = mysql_real_escape_string($request_vars["Town"]);
	
		$sql = "INSERT INTO buildings (id, building_name, Town) VALUES (" .$id ."," .$building_name ."," .$Town .")";
	
		$rs = mysqli_query($link,$sql);
	
		if ($rs) {
			echo true;
		}
		else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		}
	}
?>