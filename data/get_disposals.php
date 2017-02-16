<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();

		$rs = mysqli_query($link,"SELECT a.id, a.item_name, a.local_church_id, l.name, a.purchase_date, a.initial_value, a.item_tag, a.disposal_date, a.disposal_amount, a.status, a.quantity, o.owner_name, o.id as owner_id, a.qty_disposed FROM assets a, local_church l, assets_owners o WHERE a.local_church_id = l.id AND o.id = a.owner_id AND a.qty_disposed <> 0 ORDER BY id DESC");
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
			$item_name = mysql_real_escape_string($request_vars["item_name"]);	
			$local_church_id = mysql_real_escape_string($request_vars["local_church_id"]);
			$purchase_date1 = mysql_real_escape_string($request_vars["purchase_date"]);			
			$initial_value = mysql_real_escape_string($request_vars["initial_value"]);						
			$item_tag = mysql_real_escape_string($request_vars["item_tag"]);
			$quantity = mysql_real_escape_string($request_vars["quantity"]);
			$owner_id = mysql_real_escape_string($request_vars["owner_id"]);
							
			$purchase_date = date('Y-m-d', strtotime( $purchase_date1));
			// INSERT COMMAND 
			$insert_query = "INSERT INTO assets(item_name,local_church_id, purchase_date,initial_value, item_tag, quantity, owner_id, type) VALUES ('".$item_name."','".$local_church_id."','".$purchase_date."','".$initial_value."','".$item_tag."','".$quantity."','".$owner_id."',1)";
		   
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
			
			$qty_disposed = mysql_real_escape_string($_POST["qty_disposed"]);	
			$disposal_amount = mysql_real_escape_string($_POST["disposal_amount"]);	
			//$purchase_date = date('Y-m-d', strtotime( $purchase_date1));			
				
			$id = mysql_real_escape_string($_POST["id"]);
			
			$rs = mysqli_query($link,"UPDATE assets SET disposal_amount = '" .$disposal_amount ."',qty_disposed = '" .$qty_disposed ."' WHERE id = " .$id);
		 
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
		
		$rs = mysqli_query($link,"DELETE FROM assets WHERE id = " .$id);
		
		if ($rs) {
			echo true;
		}
		else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		}
	}	
	
?>