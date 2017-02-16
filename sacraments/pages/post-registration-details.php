 <?php    
 	if(isset($_POST['full_name'])){
        include('connect-db.php');
		
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
		if($baptism_date =="")
			$baptism_date = null;
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


		$marriage_date= $_POST['marriage_date'];
		//$marriage_date = date('Y-m-d', strtotime($marriage_date1));
		$parish_of_marriage= $_POST['parish_of_marriage'];
		$presiding_priest= $_POST['presiding_priest'];
		$spouse= $_POST['spouse'];
		$marriage_certificate_no= $_POST['marriage_certificate_no'];
		$register_no= $_POST['register_no'];


		$death_date = $_POST['death_date'];
		$death_pace= $_POST['death_pace'];
		$burried_at= $_POST['burried_at'];


		$date_ = $_POST['date_'];
		$place_= $_POST['date_'];
		


		
		$sql="INSERT INTO all_members (id,full_name,dob ,district_of_birth,father,mother,resident_district, address, tribe, register_no) VALUES ('', '$_POST[full_name]','$date_birth','$_POST[born_at]','$_POST[father_name]','$_POST[mother_name]','$_POST[recident_district]','$address','$clan', '$reg_register_no')";
		
		if (!mysqli_query($connection,$sql))
		{ 
			echo mysqli_error($connection);
		}
		else{
			//display the last 10 records
			$last_id = mysqli_insert_id($connection);

	
				$sqlbaptism="INSERT INTO baptism (id,member_id,baptism_date, sponser, priest ,registration_no,godmother,baptism_parish) 
				VALUES ('', '$last_id', '$baptism_date','$murugamiriri','$priest_baptism','$baptism_reg_no','$godmother','$baptism_parish')";
				
				if (!mysqli_query($connection,$sqlbaptism))
				{ 
					echo mysqli_error($connection); 
				}
				else
				{
				}
		
				$sqleucharist="INSERT INTO eucharist (id,member_id,date_received, parish_received, baptism_no ,registration_no) 
				VALUES ('', '$last_id', '$eucharist_date','$eucharist_parish','','')";
					
				if (!mysqli_query($connection,$sqleucharist))
				{ 
					echo mysqli_error($connection);
				}
				else{

				}   
			

				$sqlconfirmation="INSERT INTO confirmation (id,member_id,place, priest, registration_no ,confirmation_no,confirmation_date) 
				VALUES ('', '$last_id', '$confirmation_parish','$confirmation_priest','$confirmation_register_no','$confirmation_no','$confirmation_date')";
					
				if (!mysqli_query($connection,$sqlconfirmation))
				{ 
					echo mysqli_error($connection);
				}
				else{

				}    						


				$sqlmarriage="INSERT INTO marriage (id,member_id,married_to, marriage_date, marriage_parish ,priest,register_no,marriage_certificate_no) 
				VALUES ('', '$last_id', '$spouse','$marriage_date','$parish_of_marriage','$presiding_priest','$register_no','$marriage_certificate_no')";
					
				if (!mysqli_query($connection,$sqlmarriage))
				{ 
					echo mysqli_error($connection);
				}
				else{

				}   



				$sqldeath="INSERT INTO death (id,member_id,death_date, death_place, buried_at) 
				VALUES ('', '$last_id', '$death_date','$death_pace','$burried_at')";
					
				if (!mysqli_query($connection,$sqldeath))
				{ 
					echo mysqli_error($connection);
				}
				else{

				}  


				$sqldeath="INSERT INTO religious_profession (id,member_id,date, place) 
				VALUES ('', '$last_id', '$date_','$place_')";
					
				if (!mysqli_query($connection,$sqldeath))
				{ 
					echo mysqli_error($connection);
				}
				else{

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

			//
		}header("location: member-collections.php");
	}  
	else
	echo "not submitted";
?> 