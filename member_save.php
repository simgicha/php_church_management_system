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
		$file_name = "";
		

					$sql="INSERT INTO members (id,name,local_church, scc,id_number,marrital_status ,phone_number,registration_date, img) VALUES ('', '".$name."','".$local_church."','".$scc."','".$nat_id."','".$marrital_status."','".$phone_number."','$date_now','$file_name')";
					
			
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
						
					}
					else{
						
						header("location: c_grid.php");
					}			
				
		
	}
?>