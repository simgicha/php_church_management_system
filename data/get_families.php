<?php

	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "GET") {
		$arr = array();

		$rs = mysqli_query($link,"SELECT f.family_id, f.family_name, m.no_of_children, m.id,m.name,m.local_church, m.scc,m.registration_date,m.marrital_status, m.phone_number, mar.marital_status, l.name as local_church_name, s.name as scc_name, m.img as member_photo, m.economic_activity from families f, members m, local_church l, small_christian_community s, marital_status mar WHERE m.local_church = l.id AND s.id = m.scc AND mar.id = m.marrital_status AND f.family_id = m.family_id AND member_position = 1 ORDER BY id DESC");
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
			$local_church = mysql_real_escape_string($request_vars["local_church"]);
			$scc = mysql_real_escape_string($request_vars["scc"]);			
			$marrital_status = mysql_real_escape_string($request_vars["marrital_status"]);						
			$phone_number = mysql_real_escape_string($request_vars["phone_number"]);
					
			$registration_date1 = mysql_real_escape_string($request_vars["registration_date"]);
			$registration_date = date('Y-m-d', strtotime( $registration_date1));			
			$family_name = mysql_real_escape_string($request_vars["family_name"]);
			$economic_activity = mysql_real_escape_string($request_vars["economic_activity"]);
			$no_of_children = mysql_real_escape_string($request_vars["no_of_children"]);
			
			$sql="INSERT INTO families (family_id,family_name,type) VALUES ('', '$family_name', '1')";
		
		

			if (!mysqli_query($link,$sql))
			{ 
				echo mysqli_error($link);
			}
			else{	
        		 $result2 = mysqli_query($link,"SELECT  MAX(family_id) as id FROM families") 
                or die("No orders in the table orders");  

					while($rows=mysqli_fetch_assoc($result2))
				{ // Start looping table row
			
					$family_id = $rows['id'];
				}	

 
			}
			

			// INSERT COMMAND 
			$insert_query = "INSERT INTO members(name,local_church, scc,marrital_status, phone_number,registration_date, family_id, member_position, economic_activity, no_of_children) VALUES ('".$name."','".$local_church."','".$scc."','".$marrital_status."','".$phone_number."','".$registration_date."', '".$family_id."', '1', '".$economic_activity."', '".$no_of_children."')";
		   
		  $rs = mysqli_query($link,$insert_query);
		
		  if ($rs) {
			echo json_encode($rs);
			//header("location:jump.php"); 
		  }
		  else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		  }				
							  
				  
    }
	if ($verb == "POST") {
			$name = mysql_real_escape_string($_POST["name"]);
			$local_church = mysql_real_escape_string($_POST["local_church"]);		
			$scc = mysql_real_escape_string($_POST["scc"]);
			$marrital_status = mysql_real_escape_string($_POST["marrital_status"]);	
			$phone_number = mysql_real_escape_string($_POST["phone_number"]);	
			$economic_activity = mysql_real_escape_string($_POST["economic_activity"]);			
			$no_of_children = mysql_real_escape_string($_POST["no_of_children"]);
			$registration_date1 = mysql_real_escape_string($_POST["registration_date"]);
			$registration_date = date('Y-m-d', strtotime( $registration_date1));			
										
			$id = mysql_real_escape_string($_POST["family_id"]);
			
			$rs = mysqli_query($link,"UPDATE members SET name = '".$name."', local_church = '".$local_church."', scc='".$scc."', marrital_status = '".$marrital_status."', phone_number='".$phone_number."', economic_activity='".$economic_activity."', no_of_children = '".$no_of_children."', registration_date = '".$registration_date."' WHERE member_position = '1' AND family_id = " .$id);
		 
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
		
		$rs = mysqli_query($link,"DELETE FROM members WHERE id = " .$id);
		
		if ($rs) {
			echo true;
		}
		else {
			header("HTTP/1.1 500 Internal Server Error");
			echo false;
		}
	}	
	
?>