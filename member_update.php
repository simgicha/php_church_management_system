<?php

	include('connect-db.php');
	
	if (isset($_POST['submit'])) {
		
		
		$name = $_POST['name'];
		$local_church = $_POST['local_church'];
		$scc = $_POST['scc'];
		$nat_id = $_POST['nat_id'];
		$marrital_status = $_POST['marrital_status'];
		$phone_number = $_POST['phone_number'];
		$date_now = date("Y-m-d");		
		$member_id = $_POST['member_id'];
		

					$sql="UPDATE members SET name='$name', scc='$scc', phone_number = '$phone_number' WHERE id='$member_id'";

					
			
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
						
					}
					else{
						
						header("location: c_grid.php");
					}			
				
		
	}
	if (isset($_POST['del'])) {
		
			
		$member_id = $_POST['member_id'];
		

					$sql="DELETE FROM members  WHERE id='$member_id'";

					
			
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
						
					}
					else{
						
						header("location: c_grid.php");
					}			
				
		
	}
?>