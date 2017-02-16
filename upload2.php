<?php

	include('connect-db.php');
	
	if (isset($_POST['submit'])) {
		$j = 0;     // Variable for indexing uploaded image.
		$target_path = "uploads/";     // Declaring Path for uploaded images.
		$name = $_POST['member_id'];
			echo $name;
		
		for ($i = 0; $i < count($_FILES['file']['name']); $i++) 
		{
			// Loop to get individual element from the array
			$validextensions = array("jpeg", "jpg", "png","JPG");      // Extensions which are allowed.
			$ext = explode('.', basename($_FILES['file']['name'][$i]));   // Explode file name from dot(.)
			$file_extension = end($ext); // Store extensions in the variable.
			$image_name = md5(uniqid()) . "." . $ext[count($ext) - 1];
			$target_path = $target_path .$image_name ;     // Set the target path with a new name of image.
			$j = $j + 1;      // Increment the number of uploaded images according to the files in array.
			if (($_FILES["file"]["size"][$i] < 100000000)     // Approx. 100kb files can be uploaded.
			&& in_array($file_extension, $validextensions)) {
				if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) 
				{
					// If file moved to uploads folder.
					$file_name = "uploads/".$image_name;
					echo "<br><br>";
					echo $j. ').<span id="noerror">Image uploaded and member added successfully!.</span><br/><br/>';
					
					$sql = "UPDATE members SET img = '".$file_name."' WHERE id = '".$name."'";
					if (!mysqli_query($connection,$sql))
					{ 
						echo mysqli_error($connection);
						$image_name = "";
						$target_path = "uploads/";
					}
					else{
						$image_name = "";
						$target_path = "uploads/";
						header("location: family-members.php");
						
					}			
				} 
				else 
				{     //  If File Was Not Moved.
					echo $j. ').<span id="error">please try again!.</span><br/><br/>';
				}
			} 
			else 
			{     //   If File Size And File Type Was Incorrect.
				echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
			}
		}
	}
?>