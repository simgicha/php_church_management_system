
<?php
        include('connect-db.php');
		
		$employee_id = $_POST['employee_id'];
		$month_id = $_POST['month_id'];
		$amount = $_POST['amount'];
		$total_deductions = '$_POST[amount]';
		$date_now = date("Y-m-d");	
		
		$sql="INSERT INTO monthly_salaries (id,employee_id,month_id, year, amount,total_deductions, actual_amount_to_be_paid) VALUES ('', '$_POST[employee_id]', '$_POST[month_id]','$date_now','$_POST[amount]','$_POST[total_deductions]','$_POST[basic_pay]')";
		
	if (!mysqli_query($connection,$sql))
	{ 
		echo mysqli_error($connection);
	}
  	else{
		header("location: employees-payments.php");	
  	}
?>
