<?php
session_start();
if(isset($_SESSION['myusername'])){
	$user_level = $_SESSION['myusername'];
}
else
{
	$user_level = 2;
}
?>

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
		$rs = mysqli_query($link,"SELECT i.id, i.source, i.amount, i.income_type, i.date_of_income, i.sync_datetime, i.user_id, i.receipt_number, m.income_type as income_type_name, i.quantity  FROM  budget_incomes_expenses i, money_types m WHERE i.income_type = m.id AND i.budget_id = '".$budget."' AND i.type = 2 ORDER BY id DESC");
	
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
			
        $source = mysql_real_escape_string($request_vars["source"]);
        $amount = mysql_real_escape_string($request_vars["amount"]);
        $income_type = mysql_real_escape_string($request_vars["income_type"]);
	    $date_of_income1 = mysql_real_escape_string($request_vars["date_of_income"]);		
	    $date_of_income = date('Y-m-d', strtotime( $date_of_income1));
		$receipt_number = mysql_real_escape_string($request_vars["receipt_number"]);
		$quantity = mysql_real_escape_string($request_vars["quantity"]);	 		 
	    $budget_id = mysql_real_escape_string($_GET["budget_id"]);
		$insert_query = "INSERT INTO budget_incomes_expenses(source, amount, income_type,date_of_income, receipt_number,budget_id, type,quantity) VALUES ('".$source."','".$amount."','".$income_type."','".$date_of_income."','".$receipt_number."','".$budget_id."','2','".$quantity."')";   
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
			$source = mysql_real_escape_string($_POST["source"]);
			$amount = mysql_real_escape_string($_POST["amount"]);	
			$income_type = mysql_real_escape_string($_POST["income_type"]);		
			$date_of_income1 = mysql_real_escape_string($_POST["date_of_income"]);		
			$date_of_income = date('Y-m-d', strtotime( $date_of_income1));
			$quantity = mysql_real_escape_string($_POST["quantity"]);		
			$receipt_number = mysql_real_escape_string($_POST["receipt_number"]);						
			$id = mysql_real_escape_string($_POST["id"]);
			//$budget = mysql_real_escape_string($_REQUEST["filter"]["filters"][0]["value"]);
			
			//-----------check the user level
			

						$rs = mysqli_query($link,"UPDATE budget_incomes_expenses SET source = '" .$source ."',amount = '" .$amount ."',income_type = '" .$income_type ."',date_of_income = '" .$date_of_income ."',quantity = '" .$quantity ."',receipt_number = '" .$receipt_number ."' WHERE id = " .$id);
					 
						if ($rs) {
							echo json_encode($rs);
						}
						else {
							header("HTTP/1.1 500 Internal Server Error");
							echo "Update failed for expenses: " .$id;
						}	

			
			//-----------end check user level
			
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