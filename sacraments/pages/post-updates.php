 <?php    
 	if(isset($_POST['full_name'])){
        include('connect-db.php');

        $member_id = $_POST['m_id'];
		
		$father_name = $_POST['father_name'];
		$mother_name = $_POST['mother_name'];
		$full_name = $_POST['full_name'];
		$clan = $_POST['clan'];
		$dob = $_POST['dob'];
		$date_birth = date('Y-m-d', strtotime($dob));
		$clan = $_POST['clan'];
		$address = $_POST['address'];
		$recident_district = $_POST['recident_district'];
		$born_at = $_POST['born_at'];
		$reg_register_no = $_POST['reg_register_no'];


		$baptism_date = $_POST['baptism_date'];
		//$baptism_date = date('Y-m-d', strtotime($baptism_date1));
		$murugamiriri = $_POST['murugamiriri'];
		$priest_baptism = $_POST['priest_baptism'];
		$baptism_reg_no = $_POST['baptism_reg_no'];
		$godmother = $_POST['godmother'];
		$baptism_parish = $_POST['baptism_parish'];

		
		$eucharist_date = $_POST['first_communion_date'];
		//$eucharist_date = date('Y-m-d', strtotime($eucharist_date1));
		$eucharist_parish = $_POST['communion_parish'];
		//$eucharist_reg_no = $_POST['eucharist_reg_no'];
		//$eucharist_baptism_no = $_POST['eucharist_baptism_no'];


		$confirmation_date = $_POST['confirmation_date'];
		//$confirmation_date = date('Y-m-d', strtotime($confirmation_date1));
		$confirmation_parish = $_POST['confirmation_parish'];
		$confirmation_priest = $_POST['confirmation_priest'];
		$confirmation_register_no = '';
		$confirmation_no = $_POST['confirmation_no'];


		$m_date= $_POST['marriage_date'];
		//$marriage_date = date('Y-m-d', strtotime($marriage_date1));
		$parish_of_marriage= $_POST['parish_of_marriage'];
		$presiding_priest= $_POST['presiding_priest'];
		$spouse= $_POST['spouse'];
		$marriage_certificate_no= $_POST['marriage_certificate_no'];
		$register_no= $_POST['register_no'];


		$death_date= $_POST['death_date'];
		$death_pace= $_POST['death_pace'];
		$burried_at= $_POST['burried_at'];

		$date_ =  $_POST['date_'];
		$place_=  $_POST['place_'];



		

				$d_amount = "";
				$result_hist = mysqli_query($connection,"SELECT id FROM baptism where member_id = '$member_id'") 
                    or die(mysqli_error());
                while($rows=mysqli_fetch_assoc($result_hist))
                { // Start looping table row
                    $d_amount = $rows["id"];
                } 
                if($d_amount ==""){
					$sql="INSERT INTO baptism (id,member_id,baptism_date, sponser,priest ,registration_no, godmother,baptism_parish) VALUES ('', '$member_id', '$baptism_date','$murugamiriri','$priest_baptism','$baptism_reg_no', '$$godmother','$baptism_parish' )";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
					}
					else{
					}
				}
				else{
					$sqlbaptism="UPDATE baptism SET baptism_date = '".$baptism_date."', sponser='".$murugamiriri."' ,priest='".$priest_baptism."',registration_no='".$baptism_reg_no."',godmother='".$godmother."', baptism_parish='".$baptism_parish."' WHERE member_id = '". $member_id."'";
					
					if (!mysqli_query($connection,$sqlbaptism))
					{ 
						echo mysqli_error($connection);
					}
					else{
						//display the last 10 records
					}					
				}






		$sqlucharist="UPDATE eucharist SET date_received = '".$eucharist_date."', parish_received='".$eucharist_parish."' WHERE member_id = '". $member_id."'";
		
		if (!mysqli_query($connection,$sqlucharist))
		{ 
			echo mysqli_error($connection);
		}
		else{
			//display the last 10 records
		}



		$sqlconfirmation="UPDATE confirmation SET place = '".$confirmation_parish."', priest='".$confirmation_priest."', registration_no='".$confirmation_register_no."', confirmation_no='".$confirmation_no."', confirmation_date='".$confirmation_date."' WHERE member_id = '". $member_id."'";
		
		if (!mysqli_query($connection,$sqlconfirmation))
		{ 
			echo mysqli_error($connection);
		}
		else{
			//display the last 10 records
		}

		echo "DDDDD ".$m_date;

		$sqlmarriage="UPDATE marriage SET married_to = '".$spouse."', marriage_date='".$m_date."', marriage_parish='".$parish_of_marriage."', priest='".$presiding_priest."', marriage_no='".$marriage_certificate_no."', marriage_certificate_no='".$marriage_certificate_no."' WHERE member_id = '". $member_id."' ";
		
		if (!mysqli_query($connection,$sqlmarriage))
		{ 
			echo mysqli_error($connection);
		}
		else{
			//display the last 10 records
		}


		$sqldeath="UPDATE death SET death_date = '".$death_date."', death_place='".$death_pace."', buried_at='".$burried_at."' WHERE member_id = '". $member_id."' ";
		
		if (!mysqli_query($connection,$sqldeath))
		{ 
			echo mysqli_error($connection);
		}
		else{
			//display the last 10 records
		}

		$sql_="UPDATE religious_profession SET date = '".$date_."', place='".$place_."' WHERE member_id = '". $member_id."' ";
		
		if (!mysqli_query($connection,$sql_))
		{ 
			echo mysqli_error($connection);
		}
		else{
			//display the last 10 records
		}


			
			
			$father_name = "";
			$mother_name = "";
			$full_name = "";
			$clan = "";
			$dob = "";
			$date_birth = "";
			$birth_district = "";
			$recident_district = "";


			$baptism_date1 = "";
			$baptism_date = "";
			$murugamiriri = "";
			$priest_baptism = "";
			$baptism_reg_no = "";
			$baptism_no = "";
			$baptism_parish = "";

			
			$eucharist_date = "";
			$eucharist_parish = "";
			$eucharist_reg_no ="";
			$eucharist_baptism_no = "";


			$confirmation_date = "";
			$confirmation_parish = "";
			$confirmation_priest = "";
			$confirmation_register_no = "";
			$confirmation_no = "";

			$marriage_date= "";
			$parish_of_marriage= "";
			$presiding_priest= "";
			$spouse= "";
			$marriage_certificate_no="";
			$register_no= "";

			//header("location: member-collections.php");
		
	}  
	else
	echo "not submitted";
?> 