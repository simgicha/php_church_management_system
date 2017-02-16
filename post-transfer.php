
<?php
        include('connect-db.php');
		
		$budget_from = $_POST['budget_from'];
		$amount = $_POST['amount'];
		$budget_to = $_POST['budget_to'];
		$reason = $_POST['reason'];

		$sql="INSERT INTO budget_transfer (id,budget_from,budget_to, amount) VALUES ('', '$_POST[budget_from]', '$_POST[budget_to]','$_POST[amount]')";
		
	if (!mysqli_query($connection,$sql))
	{ 
		echo mysqli_error($connection);
	}
  	else{
		include('connect-db.php');
		$date_now = date("Y-m-d");								
		$sql="INSERT INTO budget_incomes_expenses (source, amount, income_type,date_of_income, receipt_number,budget_id, type,quantity, budget_transfer) VALUES ('Funds Transfered from ', '$_POST[amount]', '1','$date_now', '', '$_POST[budget_to]','1','','$budget_from')";
			
		if (!mysqli_query($connection,$sql))
		{ 
			echo mysqli_error($connection);
		}
		else{
			$sql="INSERT INTO budget_incomes_expenses (source, amount, income_type,date_of_income, receipt_number,budget_id, type,quantity, budget_transfer) VALUES ('Funds Transfered To ', '$_POST[amount]', '1','$date_now', '', '$_POST[budget_from]','2','','$budget_to')";
				
			if (!mysqli_query($connection,$sql))
			{ 
				echo mysqli_error($connection);
			}
			else{
				include('connect-db.php');
	
				header("location: success.php");
			}	
		}										
  	}
?>
