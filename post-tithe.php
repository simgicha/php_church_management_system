 <?php    
 	if(isset($_POST['amount'])){
        include('connect-db.php');
		
		$member_id = $_POST['member_id'];
		$amount = $_POST['amount'];
		$income_type = $_POST['income_type'];
		$tithe_id = $_POST['tithe_id'];
		$payment_date = $_POST['payment_date'];

		
		$sql="INSERT INTO ten_percent_contributions (id,member_id,amount, date,payment_mode ,tithe_id) VALUES ('', '$_POST[member_id]', '$_POST[amount]','$_POST[payment_date]','$_POST[income_type]','$_POST[tithe_id]')";
		
		if (!mysqli_query($connection,$sql))
		{ 
			echo mysqli_error($connection);
		}
		else{
			//display the last 10 records
			header("location: member-tithes.php");
		}
	}  
	else
	echo "not submitted";
?> 