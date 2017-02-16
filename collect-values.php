 <?php    
 	if(isset($_POST['jan'])){
        include('connect-db.php');
		
		foreach ( $_POST['jan'] as $key=>$value ) {

			$values = mysqli_escape_string($connection,$value);
			//$values = mysql_escape_string(addslashes($value));
			$key = mysqli_real_escape_string($connection,$key);
			
			$tithe_id = $_POST['tithe_id'];

			echo $key." -- ".$values."--tithe ".$tithe_id."<br>";

			if($values != ''){

				$d_amount = "";
				$result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$key' AND tithe_id = '$tithe_id' AND month = '1'") 
                    or die(mysqli_error());
                while($rows=mysqli_fetch_assoc($result_hist))
                { // Start looping table row
                    $d_amount = $rows["amount"];
                } 
                if($d_amount ==""){
					$sql="INSERT INTO ten_percent_contributions (id,member_id,amount, date,payment_mode ,tithe_id, month) VALUES ('', '$key', '$values','',1,'$tithe_id', '1')";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
					else{
					}
				}
				else{
					$sql = "UPDATE ten_percent_contributions SET amount = '" .$d_amount ."' WHERE  member_id = '$key' AND tithe_id = '$tithe_id' AND month = '1'";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
				  	else{
						
				  	}
				}
			}

		}

		foreach ( $_POST['feb'] as $key=>$value ) {

			$values = mysqli_escape_string($connection,$value);
			//$values = mysql_escape_string(addslashes($value));
			$key = mysqli_real_escape_string($connection,$key);

			echo $key." -- ".$values."<br>";
			
			$tithe_id = $_POST['tithe_id'];
			if($values != ''){

				$d_amount = "";
				$result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$key' AND tithe_id = '$tithe_id' AND month = '2'") 
                    or die(mysqli_error());
                while($rows=mysqli_fetch_assoc($result_hist))
                { // Start looping table row
                    $d_amount = $rows["amount"];
                } 
                if($d_amount ==""){
					$sql="INSERT INTO ten_percent_contributions (id,member_id,amount, date,payment_mode ,tithe_id, month) VALUES ('', '$key', '$values','',1,'$tithe_id', '2')";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
					else{
					}
				}
				else{
					$sql = "UPDATE ten_percent_contributions SET amount = '" .$values ."' WHERE  member_id = '$key' AND tithe_id = '$tithe_id' AND month = '2'";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
				  	else{
						
				  	}
				}
			}

		}

		foreach ( $_POST['march'] as $key=>$value ) {
			$values = mysqli_escape_string($connection,$value);
			$key = mysqli_real_escape_string($connection,$key);
			//echo $key." -- ".$values."<br>";
			$tithe_id = $_POST['tithe_id'];
			if($values != ''){
				$d_amount = "";
				$result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$key' AND tithe_id = '$tithe_id' AND month = '3'") 
                    or die(mysqli_error());
                while($rows=mysqli_fetch_assoc($result_hist))
                { // Start looping table row
                    $d_amount = $rows["amount"];
                } 
                if($d_amount ==""){
					$sql="INSERT INTO ten_percent_contributions (id,member_id,amount, date,payment_mode ,tithe_id, month) VALUES ('', '$key', '$values','',1,'$tithe_id', '3')";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
					else{
					}
				}
				else{
					$sql = "UPDATE ten_percent_contributions SET amount = '" .$d_amount ."' WHERE  member_id = '$key' AND tithe_id = '$tithe_id' AND month = '3'";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
				  	else{
						
				  	}
				}
			}
		}

		foreach ( $_POST['april'] as $key=>$value ) {
			$values = mysqli_escape_string($connection,$value);
			$key = mysqli_real_escape_string($connection,$key);
			//echo $key." -- ".$values."<br>";
			$tithe_id = $_POST['tithe_id'];
			if($values != ''){
				$d_amount = "";
				$result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$key' AND tithe_id = '$tithe_id' AND month = '4'") 
                    or die(mysqli_error());
                while($rows=mysqli_fetch_assoc($result_hist))
                { // Start looping table row
                    $d_amount = $rows["amount"];
                } 
                if($d_amount ==""){
					$sql="INSERT INTO ten_percent_contributions (id,member_id,amount, date,payment_mode ,tithe_id, month) VALUES ('', '$key', '$values','',1,'$tithe_id', '4')";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
					else{
					}
				}
				else{
					$sql = "UPDATE ten_percent_contributions SET amount = '" .$d_amount ."' WHERE  member_id = '$key' AND tithe_id = '$tithe_id' AND month = '4'";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
				  	else{
						
				  	}
				}
			}
		}

		foreach ( $_POST['may'] as $key=>$value ) {
			$values = mysqli_escape_string($connection,$value);
			$key = mysqli_real_escape_string($connection,$key);
			//echo $key." -- ".$values."<br>";
			$tithe_id = $_POST['tithe_id'];
			if($values != ''){
				$d_amount = "";
				$result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$key' AND tithe_id = '$tithe_id' AND month = '5'") 
                    or die(mysqli_error());
                while($rows=mysqli_fetch_assoc($result_hist))
                { // Start looping table row
                    $d_amount = $rows["amount"];
                } 
                if($d_amount ==""){
					$sql="INSERT INTO ten_percent_contributions (id,member_id,amount, date,payment_mode ,tithe_id, month) VALUES ('', '$key', '$values','',1,'$tithe_id', '5')";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
					else{
					}
				}
				else{
					$sql = "UPDATE ten_percent_contributions SET amount = '" .$d_amount ."' WHERE  member_id = '$key' AND tithe_id = '$tithe_id' AND month = '5'";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
				  	else{
						
				  	}
				}
			}
		}

		foreach ( $_POST['june'] as $key=>$value ) {
			$values = mysqli_escape_string($connection,$value);
			$key = mysqli_real_escape_string($connection,$key);
			//echo $key." -- ".$values."<br>";
			$tithe_id = $_POST['tithe_id'];
			if($values != ''){
				$d_amount = "";
				$result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$key' AND tithe_id = '$tithe_id' AND month = '6'") 
                    or die(mysqli_error());
                while($rows=mysqli_fetch_assoc($result_hist))
                { // Start looping table row
                    $d_amount = $rows["amount"];
                } 
                if($d_amount ==""){
					$sql="INSERT INTO ten_percent_contributions (id,member_id,amount, date,payment_mode ,tithe_id, month) VALUES ('', '$key', '$values','',1,'$tithe_id', '6')";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
					else{
					}
				}
				else{
					$sql = "UPDATE ten_percent_contributions SET amount = '" .$d_amount ."' WHERE  member_id = '$key' AND tithe_id = '$tithe_id' AND month = '6'";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
				  	else{
						
				  	}
				}
			}
		}



		foreach ( $_POST['july'] as $key=>$value ) {
			$values = mysqli_escape_string($connection,$value);
			$key = mysqli_real_escape_string($connection,$key);
			//echo $key." -- ".$values."<br>";
			$tithe_id = $_POST['tithe_id'];
			if($values != ''){
				$d_amount = "";
				$result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$key' AND tithe_id = '$tithe_id' AND month = '7'") 
                    or die(mysqli_error());
                while($rows=mysqli_fetch_assoc($result_hist))
                { // Start looping table row
                    $d_amount = $rows["amount"];
                } 
                if($d_amount ==""){
					$sql="INSERT INTO ten_percent_contributions (id,member_id,amount, date,payment_mode ,tithe_id, month) VALUES ('', '$key', '$values','',1,'$tithe_id', '7')";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
					else{
					}
				}
				else{
					$sql = "UPDATE ten_percent_contributions SET amount = '" .$d_amount ."' WHERE  member_id = '$key' AND tithe_id = '$tithe_id' AND month = '7'";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
				  	else{
						
				  	}
				}
			}
		}



		foreach ( $_POST['aug'] as $key=>$value ) {
			$values = mysqli_escape_string($connection,$value);
			$key = mysqli_real_escape_string($connection,$key);
			//echo $key." -- ".$values."<br>";
			$tithe_id = $_POST['tithe_id'];
			if($values != ''){
				$d_amount = "";
				$result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$key' AND tithe_id = '$tithe_id' AND month = '8'") 
                    or die(mysqli_error());
                while($rows=mysqli_fetch_assoc($result_hist))
                { // Start looping table row
                    $d_amount = $rows["amount"];
                } 
                if($d_amount ==""){
					$sql="INSERT INTO ten_percent_contributions (id,member_id,amount, date,payment_mode ,tithe_id, month) VALUES ('', '$key', '$values','',1,'$tithe_id', '8')";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
					else{
					}
				}
				else{
					$sql = "UPDATE ten_percent_contributions SET amount = '" .$d_amount ."' WHERE  member_id = '$key' AND tithe_id = '$tithe_id' AND month = '8'";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
				  	else{
						
				  	}
				}
			}
		}

		foreach ( $_POST['sept'] as $key=>$value ) {
			$values = mysqli_escape_string($connection,$value);
			$key = mysqli_real_escape_string($connection,$key);
			//echo $key." -- ".$values."<br>";
			$tithe_id = $_POST['tithe_id'];
			if($values != ''){
				$d_amount = "";
				$result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$key' AND tithe_id = '$tithe_id' AND month = '9'") 
                    or die(mysqli_error());
                while($rows=mysqli_fetch_assoc($result_hist))
                { // Start looping table row
                    $d_amount = $rows["amount"];
                } 
                if($d_amount ==""){
					$sql="INSERT INTO ten_percent_contributions (id,member_id,amount, date,payment_mode ,tithe_id, month) VALUES ('', '$key', '$values','',1,'$tithe_id', '9')";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
					else{
					}
				}
				else{
					$sql = "UPDATE ten_percent_contributions SET amount = '" .$d_amount ."' WHERE  member_id = '$key' AND tithe_id = '$tithe_id' AND month = '9'";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
				  	else{
						
				  	}
				}
			}
		}



		foreach ( $_POST['oct'] as $key=>$value ) {
			$values = mysqli_escape_string($connection,$value);
			$key = mysqli_real_escape_string($connection,$key);
			//echo $key." -- ".$values."<br>";
			$tithe_id = $_POST['tithe_id'];
			if($values != ''){
				$d_amount = "";
				$result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$key' AND tithe_id = '$tithe_id' AND month = '10'") 
                    or die(mysqli_error());
                while($rows=mysqli_fetch_assoc($result_hist))
                { // Start looping table row
                    $d_amount = $rows["amount"];
                } 
                if($d_amount ==""){
					$sql="INSERT INTO ten_percent_contributions (id,member_id,amount, date,payment_mode ,tithe_id, month) VALUES ('', '$key', '$values','',1,'$tithe_id', '10')";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
					else{
					}
				}
				else{
					$sql = "UPDATE ten_percent_contributions SET amount = '" .$d_amount ."' WHERE  member_id = '$key' AND tithe_id = '$tithe_id' AND month = '10'";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
				  	else{
						
				  	}
				}
			}
		}


		foreach ( $_POST['nov'] as $key=>$value ) {
			$values = mysqli_escape_string($connection,$value);
			$key = mysqli_real_escape_string($connection,$key);
			//echo $key." -- ".$values."<br>";
			$tithe_id = $_POST['tithe_id'];
			if($values != ''){
				$d_amount = "";
				$result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$key' AND tithe_id = '$tithe_id' AND month = '11'") 
                    or die(mysqli_error());
                while($rows=mysqli_fetch_assoc($result_hist))
                { // Start looping table row
                    $d_amount = $rows["amount"];
                } 
                if($d_amount ==""){
					$sql="INSERT INTO ten_percent_contributions (id,member_id,amount, date,payment_mode ,tithe_id, month) VALUES ('', '$key', '$values','',1,'$tithe_id', '11')";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
					else{
					}
				}
				else{
					$sql = "UPDATE ten_percent_contributions SET amount = '" .$d_amount ."' WHERE  member_id = '$key' AND tithe_id = '$tithe_id' AND month = '11'";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
				  	else{
						
				  	}
				}
			}
		}

		foreach ( $_POST['dec'] as $key=>$value ) {
			$values = mysqli_escape_string($connection,$value);
			$key = mysqli_real_escape_string($connection,$key);
			//echo $key." -- ".$values."<br>";
			$tithe_id = $_POST['tithe_id'];
			if($values != ''){
				$d_amount = "";
				$result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$key' AND tithe_id = '$tithe_id' AND month = '12'") 
                    or die(mysqli_error());
                while($rows=mysqli_fetch_assoc($result_hist))
                { // Start looping table row
                    $d_amount = $rows["amount"];
                } 
                if($d_amount ==""){
					$sql="INSERT INTO ten_percent_contributions (id,member_id,amount, date,payment_mode ,tithe_id, month) VALUES ('', '$key', '$values','',1,'$tithe_id', '12')";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
					else{
					}
				}
				else{
					$sql = "UPDATE ten_percent_contributions SET amount = '" .$d_amount ."' WHERE  member_id = '$key' AND tithe_id = '$tithe_id' AND month = '12'";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
				  	else{
						
				  	}
				}
			}

			header('location: member-tithes.php');
		}


	}  
	else
	echo "not new records saved .";
echo "<a href='member-tithes.php'>Go back</a>"
?> 