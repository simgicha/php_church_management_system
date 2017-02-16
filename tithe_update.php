<?php

	include('connect-db.php');
	
	if (isset($_POST['submit'])) {
		
		
		$tithe_id = $_POST['tithe_id'];
		$amount = $_POST['amount'];
		
		
		$tithe_id_row = $_POST['tithe_id_row'];
		

					$sql="UPDATE ten_percent_contributions SET amount='$amount' WHERE id='$tithe_id_row'";

					
			
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
						
					}
					else{
						
						header("location: all_tithes.php");
					}			
				
		
	}
	if (isset($_POST['del'])) {
		
			
		$tithe_id_row = $_POST['tithe_id_row'];
		

					$sql="DELETE FROM ten_percent_contributions  WHERE id='$tithe_id_row'";

					
			
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
						
					}
					else{
						
						header("location: all_tithes.php");
					}			
				
		
	}
?>