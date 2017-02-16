<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();

		$rs = mysqli_query($link,"SELECT id, name, Location, Address  from local_church ORDER BY id");
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
			$name = mysql_real_escape_string($request_vars["name"]);	
			$Location = mysql_real_escape_string($request_vars["Location"]);
			$Address = mysql_real_escape_string($request_vars["Address"]);	
						
			//$name = mysql_real_escape_string($_POST["name"]);
			//$Location = mysql_real_escape_string($_POST["Location"]);
			//$Address = mysql_real_escape_string($_POST["Address"]);	
			
			// INSERT COMMAND 
			$insert_query = "INSERT INTO local_church(name, Location, Address) VALUES ('".$name."','".$Location."','".$Address."')";
		   
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
			$name = mysql_real_escape_string($_POST["name"]);
			$Location = mysql_real_escape_string($_POST["Location"]);			
			$Address = mysql_real_escape_string($_POST["Address"]);
			$id = mysql_real_escape_string($_POST["id"]);
			
			$rs = mysqli_query($link,"UPDATE local_church SET name = '" .$name ."',Location = '" .$Location ."',Address = '" .$Address ."' WHERE id = " .$id);
		 
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
		
		$rs = mysqli_query($link,"DELETE FROM local_church WHERE id = " .$id);
		
		if ($rs) {
			echo true;
		}
		else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		}
	}	
	
?>