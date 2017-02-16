
<?php
        include('connect-db.php');
		
		$name = $_POST['name'];
		$local_church = $_POST['local_church'];
		$scc = $_POST['scc'];
		$registration_date = $_POST['registration_date'];
		$marrital_status = $_POST['marrital_status'];
		$phone_number = $_POST['phone_number'];
		
		$sql="INSERT INTO members (id,name,local_church, scc,marrital_status ,phone_number) VALUES ('', '$_POST[name]', '$_POST[local_church]','$_POST[scc]','$_POST[marrital_status]','$_POST[phone_number]')";
		
	if (!mysqli_query($connection,$sql))
	{ 
		echo mysqli_error();
	}
  	else{
		header("location: members.php");
  	}
?>
