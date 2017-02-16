<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();
	
		$rs = mysqli_query($link,"SELECT e.id, e.expense_type_id as expense_id, e.paid_to, e.date_paid, e.amount_paid, e.reason, e.sync_datetime, e.user_id, e.payment_type as pay_type, m.income_type as payment_type, et.expense_name as expense_type_id from expenses e, expenses_types et, money_types m WHERE e.expense_type_id = et.id AND m.id = e.payment_type");
	
		while($obj = mysqli_fetch_object($rs)) {
	
			$arr[] = $obj;
	
		}
	
		// add the header line to specify that the content type is JSON
		header("Content-type: application/json");
	
		echo "{\"data\":" .json_encode($arr). "}";
	}
	
	if ($verb == "POST") {

        $expense_type_id = mysql_real_escape_string($_POST["expense_type_id"]);
        $paid_to = mysql_real_escape_string($_POST["paid_to"]);
        $date_paid1 = mysql_real_escape_string($_POST["date_paid"]);
		$date_paid = date('Y-m-d', strtotime( $date_paid1));
	    $amount_paid = mysql_real_escape_string($_POST["amount_paid"]);
        $reason = mysql_real_escape_string($_POST["reason"]);
        $user_id = 1;
	    $payment_type = mysql_real_escape_string($_POST["payment_type"]);
		
			// INSERT COMMAND 
		$insert_query = "INSERT INTO expenses(expense_type_id, paid_to, date_paid, amount_paid,reason,payment_type,user_id) VALUES ('".$expense_type_id."','".$paid_to."','".$date_paid."','".$amount_paid."','".$reason."','".$user_id."','".$payment_type."')";
		

	   
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
		
	   $result = mysqli_query($link,$insert_query) or die("SQL Error 1: " . mysqli_error());
	   echo $result;
	  
	   //header("location:index.php");
	}
	
?>