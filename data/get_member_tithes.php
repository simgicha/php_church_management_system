<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();

		$rs = mysqli_query($link,"SELECT m.id as m_id, m.name as member_name, s.id, s.name, s.local_church_id as l_id, l.name as local_church_name, l.id as local_church_id from small_christian_community s, local_church l, members m WHERE s.local_church_id = l.id AND m.scc=s.id ORDER BY l.name ASC");
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
			$name = mysql_real_escape_string($request_vars["models[0]"].["member_name"]);	
			//$local_church_id = mysql_real_escape_string($request_vars["local_church_id"]);
			
						
			$rs = mysqli_query($link,"UPDATE small_christian_community SET name = '" .$name ."' WHERE id = 1");
		 
			if ($rs) {
				echo json_encode($rs);
			}
			else {
				header("HTTP/1.1 500 Internal Server Error");
				echo "Update failed for church: " .$id;
			}
    }
	if ($verb == "POST") {
			
			$name = mysql_real_escape_string($_POST["models[0][member_name]"]);
			//$local_church_id = mysql_real_escape_string($_POST["local_church_id"]);			
			//$id = mysql_real_escape_string($_POST["id"]);
			
			$rs = mysqli_query($link,"UPDATE small_christian_community SET name = '" .$name ."' WHERE id = 1");
		 
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
		
		$rs = mysqli_query($link,"DELETE FROM small_christian_community WHERE id = " .$id);
		
		if ($rs) {
			echo true;
		}
		else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		}
	}	
	
?>