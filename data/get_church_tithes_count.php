<?php
session_start();
	include("db_connect.php");
    // handle a GET 
	// add the header line to specify that the content type is JSON
    header("Content-type: application/json");

    // determine the request type
    $verb = $_SERVER["REQUEST_METHOD"];
	
    if ($verb == "PUT") {
		$tithe_id = $_SESSION['tithe_id'];
		
		$rs = mysqli_query($link,"SELECT  SUM(t.amount) as tithes_amount, m.local_church, l.name FROM ten_percent_contributions t, members m, local_church l WHERE m.id = t.member_id AND l.id = m.local_church AND t.tithe_id = '$tithe_id' GROUP BY m.local_church ORDER BY SUM(t.amount) DESC");
		while($obj = mysqli_fetch_object($rs)) {
			$arr[] = $obj;
		}
	
		// add the header line to specify that the content type is JSON
		header("Content-type: application/json");
	
		echo "{\"data\":" .json_encode($arr). "}";
	}
	

?>