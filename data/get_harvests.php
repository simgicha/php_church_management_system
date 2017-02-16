<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();

		$rs = mysqli_query($link,"SELECT h.id, h.member_id, h.payment_mode, h.amount, h.tithe_id, h.date_paid, m.name, mt.income_type, t.description as description1 From harvests h, members m, money_types mt, ten_percent_configuration t where h.member_id = m.id AND h.payment_mode = mt.id AND t.id = h.tithe_id ORDER BY id DESC");
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
			$member_id = mysql_real_escape_string($request_vars["member_id"]);	
			$tithe_id = mysql_real_escape_string($request_vars["tithe_id"]);
			$amount = mysql_real_escape_string($request_vars["amount"]);
			$date_paid1 = mysql_real_escape_string($request_vars["date_paid"]);
			$date_paid = date('Y-m-d', strtotime( $date_paid1));
			$payment_mode = mysql_real_escape_string($request_vars["payment_mode"]);
			// INSERT COMMAND 
			$insert_query = "INSERT INTO harvests(member_id,tithe_id, amount, date_paid, payment_mode) VALUES ('".$member_id."','".$tithe_id."','".$amount."','".$date_paid."','".$payment_mode."')";
		   
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
			$member_id = mysql_real_escape_string($_POST["member_id"]);
			$tithe_id = mysql_real_escape_string($_POST["tithe_id"]);		
			$amount = mysql_real_escape_string($_POST["amount"]);
			$payment_mode = mysql_real_escape_string($_POST["payment_mode"]);			
	
			$id = mysql_real_escape_string($_POST["id"]);
			
			$rs = mysqli_query($link,"UPDATE harvests SET member_id = '" .$member_id ."',tithe_id = '" .$tithe_id ."',amount = '" .$amount ."',payment_mode = '" .$payment_mode ."' WHERE id = " .$id);
		 
			if ($rs) {
				echo json_encode($rs);
			}
			else {
				header("HTTP/1.1 500 Internal Server Error");
				echo "Update failed for harvests: " .$id;
			}	
	}

	if ($verb == "DELETE") {
		parse_str(file_get_contents('php://input'), $_DELETE);
		$id = mysql_real_escape_string($_DELETE["id"]);
		
		$rs = mysqli_query($link,"DELETE FROM harvests WHERE id = " .$id);
		
		if ($rs) {
			echo true;
		}
		else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		}
	}	
	
?>