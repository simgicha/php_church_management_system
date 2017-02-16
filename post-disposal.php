
<?php
        include('connect-db.php');
		
		$item_name = $_POST['item_name'];
		$qty_disposing = $_POST['qty_disposing'];
		$amount_disposing = $_POST['amount_disposing'];
		$date_now = date("Y-m-d");	
		
		$sql = "UPDATE assets SET disposal_amount = '" .$amount_disposing ."',qty_disposed = '" .$qty_disposing ."',disposal_date = '" .$date_now ."' WHERE id = " .$item_name;
		 
		
	if (!mysqli_query($connection,$sql))
	{ 
		echo mysqli_error($connection);
	}
  	else{
		header("location: inventory-disposal.php");	
  	}
?>
