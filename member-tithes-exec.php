
<?php
        include('connect-db.php');
		
		$member_id = $_POST['member_id'];
		$amount = $_POST['amount'];
		$income_type = $_POST['income_type'];
		$tithe_id = $_POST['tithe_id'];
		$payment_date = $_POST['payment_date'];

		
		$sql="INSERT INTO ten_percent_contributions (id,member_id,amount, scc,marrital_status ,phone_number) VALUES ('', '$_POST[name]', '$_POST[local_church]','$_POST[scc]','$_POST[marrital_status]','$_POST[phone_number]')";
		
	if (!mysql_query($sql))
	{ 
		echo mysql_error();
	}
  	else{
		header("location: members.php");
  	}
?>
