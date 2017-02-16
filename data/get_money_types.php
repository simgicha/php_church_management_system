<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();
		
	
		$rs = mysqli_query($link,"SELECT id, income_type  FROM  money_types");
	
		while($obj = mysqli_fetch_object($rs)) {
	
			$arr[] = $obj;
	
		}
	
		// add the header line to specify that the content type is JSON
		header("Content-type: application/json");
	
		//echo "{\"data\":" .json_encode($arr). "}";
		echo "{\"data\":" .json_encode($arr). "}";

	}
	
	if ($verb == "POST1") {
		
        $source = mysql_real_escape_string($_POST["source"]);
        $amount = mysql_real_escape_string($_POST["amount"]);
        $type = mysql_real_escape_string($_POST["type"]);
	    $date_of_income = mysql_real_escape_string($_POST["date_of_income"]);		
	    
				
		$sql = "INSERT INTO incomes (source, amount, type,date_of_income) VALUES ('".$source."','".$amount."','".$type."','".$date_of_income."')";
	
	 	$rs = mysqli_query($link,$sql);
		
		  if ($rs) {
			echo json_encode($rs);
			
		  }
		  else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		  }	   
    }
	
	if ($verb == "PUT1") {
		$request_vars = Array();
		parse_str(file_get_contents('php://input'), $request_vars );
	
		// DISCLAIMER: It is better to use PHP prepared statements to communicate with the database.
		//             this provides better protection against SQL injection.
		//             [http://php.net/manual/en/pdo.prepared-statements.php][4]
	
		// get the parameters from the get. escape them to protect against sql injection.
	
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