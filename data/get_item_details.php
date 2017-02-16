<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();
		
		$rs = mysqli_query($link,"SELECT id, item_name, item_code  from item_details");
	
		while($obj = mysqli_fetch_object($rs)) {
	
			$arr[] = $obj;
	
		}
	
		// add the header line to specify that the content type is JSON
		header("Content-type: application/json");
	
		echo "{\"data\":" .json_encode($arr). "}";
	}
	
	if ($verb == "POST") {

        $item_id = mysql_real_escape_string($_POST["item_id"]);
        $quantity = mysql_real_escape_string($_POST["quantity"]);
        $unit_price = mysql_real_escape_string($_POST["unit_price"]);
	    $total = mysql_real_escape_string($_POST["total"]);
	    $budget_ref_id = mysql_real_escape_string($_POST["budget_ref_id"]);		
			// INSERT COMMAND 
		$insert_query = "INSERT INTO budget_items(item_id, quantity, unit_price, total, budget_ref_id) VALUES ('".$item_id."','".$quantity."','".$unit_price."','".$total."',,'".$budget_ref_id."')";
		

	   
	  $rs = mysqli_query($link,$insert_query);
	
	  if ($rs) {
		echo json_encode($rs);
	  }
	  else {
		header("HTTP/1.1 500 Internal Server Error");
		echo false;
	  }	   
	   

    }
	if ($verb == "PUT") {
	// INSERT COMMAND 
		$insert_query = "INSERT INTO rent_payments(room_id, amount_paid, paid_by, month_paying) VALUES ('1','".$_GET['amount_paid']."','".$_GET['paid_by']."','".$_GET['month_paying']."')";
		
	   $result = mysqli_query($link,$insert_query) or die("SQL Error 1: " . mysql_error());
	   echo $result;
	  
	   //header("location:index.php");
	}
	
?>