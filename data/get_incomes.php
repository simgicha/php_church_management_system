<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();
		
	
		$rs = mysqli_query($link,"SELECT i.id, i.source, i.amount, i.income_type as type_id, i.date_of_income, i.sync_datetime, i.user_id, i.receipt_number, m.income_type  FROM  incomes i, money_types m WHERE i.income_type = m.id");
	
		while($obj = mysqli_fetch_object($rs)) {
	
			$arr[] = $obj;
	
		}
	
		// add the header line to specify that the content type is JSON
		header("Content-type: application/json");
	
		//echo "{\"data\":" .json_encode($arr). "}";
		echo "{\"data\":" .json_encode($arr). "}";

	}
	
	if ($verb == "PUT") {
		$request_vars = Array();
		parse_str(file_get_contents('php://input'), $request_vars );	
			
        $source = mysql_real_escape_string($request_vars["source"]);
        $amount = mysql_real_escape_string($request_vars["amount"]);
        $income_type = mysql_real_escape_string($request_vars["income_type"]);
	    $date_of_income1 = mysql_real_escape_string($request_vars["date_of_income"]);		
	    $date_of_income = date('Y-m-d', strtotime( $date_of_income1));
		$receipt_number = mysql_real_escape_string($request_vars["receipt_number"]);			
		$sql = "INSERT INTO incomes (source, amount, income_type,date_of_income, receipt_number) VALUES ('".$source."','".$amount."','".$income_type."','".$date_of_income."','".$receipt_number."')";
	
	 	$rs = mysqli_query($link,$sql);		
		  if ($rs) {
			echo json_encode($rs);		
		  }
		  else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		  }	   
    }
	
	if ($verb == "POST") {
			$amount = mysql_real_escape_string($_POST["amount"]);
			$source = mysql_real_escape_string($_POST["source"]);	
			$income_type = mysql_real_escape_string($_POST["income_type"]);	
			$receipt_number = mysql_real_escape_string($_POST["receipt_number"]);					
			$id = mysql_real_escape_string($_POST["id"]);		
			$rs = mysqli_query($link,"UPDATE incomes SET amount = '".$amount."',source = '".$source."',income_type = '".$income_type."',receipt_number = '".$receipt_number."' WHERE id = ".$id);		 
			if ($rs) {
				echo json_encode($rs);
			}
			else {
				header("HTTP/1.1 500 Internal Server Error");
				echo "Update failed for income: " .$id;
			}	
	}
	if ($verb == "DELETE") {
		parse_str(file_get_contents('php://input'), $_DELETE);
		$id = mysql_real_escape_string($_DELETE["id"]);
		
		$rs = mysqli_query($link,"DELETE FROM incomes WHERE id = " .$id);
		
		if ($rs) {
			echo true;
		}
		else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		}
	}
?>