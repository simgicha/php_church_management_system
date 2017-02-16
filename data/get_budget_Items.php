<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();
		$budget = mysqli_real_escape_string($link,$_REQUEST["filter"]["filters"][0]["value"]);
		$rs = mysqli_query($link,"SELECT i.id, i.item_id as item, i.quantity, i.unit_price, i.budget_ref_id, i.total, item.item_name as item_id  from budget_items i, item_details item WHERE i.item_id = item.id AND i.budget_ref_id = '".$budget."'");
	
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
		 $item_id = mysql_real_escape_string($request_vars["item_id"]);	
		 $quantity = mysql_real_escape_string($request_vars["quantity"]);	
		 $unit_price = mysql_real_escape_string($request_vars["unit_price"]);	
		 $total = mysql_real_escape_string($request_vars["total"]);			 		 
	    $budget_ref_id = mysql_real_escape_string($_GET["budget_ref_id"]);		
		$insert_query = "INSERT INTO budget_items(item_id, quantity, unit_price, total, budget_ref_id) VALUES ('".$item_id."','".$quantity."','".$unit_price."','".$total."','".$budget_ref_id."')";   
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
			$item_id = mysql_real_escape_string($_POST["item_id"]);
			$quantity = mysql_real_escape_string($_POST["quantity"]);	
			$unit_price = mysql_real_escape_string($_POST["unit_price"]);	
			$total = mysql_real_escape_string($_POST["total"]);					
			$id = mysql_real_escape_string($_POST["id"]);
			
			$rs = mysqli_query($link,"UPDATE budget_items SET item_id = '" .$item_id ."',quantity = '" .$quantity ."',unit_price = '" .$unit_price ."',total = '" .$total ."' WHERE id = " .$id);
		 
			if ($rs) {
				echo json_encode($rs);
			}
			else {
				header("HTTP/1.1 500 Internal Server Error");
				echo "Update failed for church: " .$id;
			}	
	}
	
	if ($verb == "DELETE") {
		parse_str(file_get_contents('php://input'), $_DELETE);
		$id = mysql_real_escape_string($_DELETE["id"]);
		
		$rs = mysqli_query($link,"DELETE FROM budget_items WHERE id = " .$id);
		
		if ($rs) {
			echo true;
		}
		else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		}
	}	
?>