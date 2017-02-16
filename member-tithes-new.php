<?php
session_start();
if(!isset($_SESSION['myusername'])){
header('location: index.php');
}
?>
<?php include("top.php"); ?>
      <!-- BEGIN PAGE -->
      <div class="page-content" style="min-height:590px !important">
      
           <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>Church Members
                    <span> >> </span>Church Member Profiles
                </div>
                <div class="tools">
                </div>
            </div>
            
            <div class="portlet-body form">

<!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& form &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->
                  <style>
                                       
										fieldset{
											width:40%;
											margin:auto;
											
											background-color:#4B8DF8;
											border:solid #333;
										}
										legend{
										}
                  </style>
        <style>

table {
    width: 100%;
    border: thin solid black;
    border-spacing: 0 10px;
}
td {
   
    border-top: thin solid #E6E6E6;
    
}
th, tfoot td {
    border: thin solid black;
    text-align: center;
    font-weight: bold;
}
tbody td {
    font-size: 120%;
}
caption {
    font-size: 90%;
    text-align: right;
}
td, th, caption {
    padding: 5px;
}
        
        </style>         
              <?php 
               

              ?>
 
 

<form method="post" action="collect-values.php">
<?php

                if(isset($_POST['scc_id'])){
                  
                  $scc_id = $_POST['scc_id'];

                  $tithe_id = $_POST['tithe_id'];

                   include('connect-db.php'); // Database connection using PDO
                  $result = mysqli_query($connection,"SELECT * FROM small_christian_community where id = '$scc_id'") 
                      or die(mysqli_error());
                  while($rows=mysqli_fetch_assoc($result))
                  { // Start looping table row
                    $scc_name = $rows["name"];
                    echo "<b>".$scc_name."</b>. Small Christian Community Members";
                  }    
                }

                include('connect-db.php'); // Database connection using PDO
									$result = mysqli_query($connection,"SELECT * FROM members where scc = '$scc_id'") 
											or die(mysqli_error());  		
                  echo "<font size='0.3px'>";    							
									echo"<table bgcolor=\"#CCCCCC\">";
                  echo "	<tr>
										<td  height=20 align=center bgcolor=\"#E6E6E6\"><strong>Name</strong></td>
										<td  align=center bgcolor=\"#E6E6E6\"><strong>JAN</strong></td>
                    <td  align=center bgcolor=\"#E6E6E6\"><strong>FEB</strong></td>
                    <td  align=center bgcolor=\"#E6E6E6\"><strong>MARCH</strong></td>
                    <td  align=center bgcolor=\"#E6E6E6\"><strong>APRIL</strong></td>
                    <td  align=center bgcolor=\"#E6E6E6\"><strong>MAY</strong></td>
                    <td  align=center bgcolor=\"#E6E6E6\"><strong>JUNE</strong></td>
                    <td  align=center bgcolor=\"#E6E6E6\"><strong>JULY</strong></td>
                    <td  align=center bgcolor=\"#E6E6E6\"><strong>AUG</strong></td>
                    <td  align=center bgcolor=\"#E6E6E6\"><strong>SEPT</strong></td>
                    <td  align=center bgcolor=\"#E6E6E6\"><strong>Oct</strong></td>
                    <td  align=center bgcolor=\"#E6E6E6\"><strong>NOV</strong></td>
                    <td  align=center bgcolor=\"#E6E6E6\"><strong>DEC</strong></td>
									</tr>";	
									$color_row = 1;			
									while($rows=mysqli_fetch_assoc($result))
									{ // Start looping table row
									?>
                    <tr>
                      <td align="left"  height="25px" bgcolor="#FFFFFF"><?php {echo ($rows["name"]); }?></td>

                      <?php 
                        $color_row = $rows["id"]; 
                      ?>
                      <?php
                        include('connect-db.php'); // Database connection using PDO
                        $d_amount = "";
                        $result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$color_row' AND tithe_id = '$tithe_id' AND month = '1'") 
                            or die(mysqli_error());
                        while($rows=mysqli_fetch_assoc($result_hist))
                        { // Start looping table row
                          $d_amount = $rows["amount"];
                        }   
                      ?>
                      <td align="center" bgcolor="#FFFFFF"><?php {echo "<input name='jan[$color_row ]' value='$d_amount' type='text' size='3' />"; }?></td>
                      

                      <?php
                        include('connect-db.php'); // Database connection using PDO
                        $d_amount = "";
                        $result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$color_row' AND tithe_id = '$tithe_id' AND month = '2'") 
                            or die(mysqli_error());
                        while($rows=mysqli_fetch_assoc($result_hist))
                        { // Start looping table row
                          $d_amount = $rows["amount"];
                        }   
                      ?>                      
                      <td align="center" size = "5" bgcolor="#FFFFFF"><?php {echo "<input name='feb[$color_row ]' value='$d_amount' type='text' size='3' />"; }?></td>
                      

                      <?php
                        include('connect-db.php'); // Database connection using PDO
                        $d_amount = "";
                        $result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$color_row' AND tithe_id = '$tithe_id' AND month = '3'") 
                            or die(mysqli_error());
                        while($rows=mysqli_fetch_assoc($result_hist))
                        { // Start looping table row
                          $d_amount = $rows["amount"];
                        }   
                      ?>   
                      <td align="center" size = "5" bgcolor="#FFFFFF"><?php {echo "<input name='march[$color_row ]' value='$d_amount' type='text' size='3' />"; }?></td>
                      


                      <?php
                        include('connect-db.php'); // Database connection using PDO
                        $d_amount = "";
                        $result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$color_row' AND tithe_id = '$tithe_id' AND month = '4'") 
                            or die(mysqli_error());
                        while($rows=mysqli_fetch_assoc($result_hist))
                        { // Start looping table row
                          $d_amount = $rows["amount"];
                        }   
                      ?>  
                      <td align="center" size = "5" bgcolor="#FFFFFF"><?php {echo "<input name='april[$color_row ]' value='$d_amount' type='text' size='3' />"; }?></td>
                      


                      <?php
                        include('connect-db.php'); // Database connection using PDO
                        $d_amount = "";
                        $result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$color_row' AND tithe_id = '$tithe_id' AND month = '5'") 
                            or die(mysqli_error());
                        while($rows=mysqli_fetch_assoc($result_hist))
                        { // Start looping table row
                          $d_amount = $rows["amount"];
                        }   
                      ?>  
                      <td align="center" size = "5" bgcolor="#FFFFFF"><?php {echo "<input name='may[$color_row ]' value='$d_amount' type='text' size='3' />"; }?></td>
                      



                      <?php
                        include('connect-db.php'); // Database connection using PDO
                        $d_amount = "";
                        $result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$color_row' AND tithe_id = '$tithe_id' AND month = '6'") 
                            or die(mysqli_error());
                        while($rows=mysqli_fetch_assoc($result_hist))
                        { // Start looping table row
                          $d_amount = $rows["amount"];
                        }   
                      ?> 
                      <td align="center" size = "5" bgcolor="#FFFFFF"><?php {echo "<input name='june[$color_row ]' value='$d_amount' type='text' size='3' />"; }?></td>
                      


                      <?php
                        include('connect-db.php'); // Database connection using PDO
                        $d_amount = "";
                        $result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$color_row' AND tithe_id = '$tithe_id' AND month = '7'") 
                            or die(mysqli_error());
                        while($rows=mysqli_fetch_assoc($result_hist))
                        { // Start looping table row
                          $d_amount = $rows["amount"];
                        }   
                      ?> 
                      <td align="center" size = "5" bgcolor="#FFFFFF"><?php {echo "<input name='july[$color_row ]' value='$d_amount' type='text' size='3' />"; }?></td>
                      


                      <?php
                        include('connect-db.php'); // Database connection using PDO
                        $d_amount = "";
                        $result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$color_row' AND tithe_id = '$tithe_id' AND month = '8'") 
                            or die(mysqli_error());
                        while($rows=mysqli_fetch_assoc($result_hist))
                        { // Start looping table row
                          $d_amount = $rows["amount"];
                        }   
                      ?> 
                      <td align="center" size = "5" bgcolor="#FFFFFF"><?php {echo "<input name='aug[$color_row ]' value='$d_amount' type='text' size='3' />"; }?></td>
                      

                      <?php
                        include('connect-db.php'); // Database connection using PDO
                        $d_amount = "";
                        $result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$color_row' AND tithe_id = '$tithe_id' AND month = '9'") 
                            or die(mysqli_error());
                        while($rows=mysqli_fetch_assoc($result_hist))
                        { // Start looping table row
                          $d_amount = $rows["amount"];
                        }   
                      ?> 
                      <td align="center" size = "5" bgcolor="#FFFFFF"><?php {echo "<input name='sept[$color_row ]' value='$d_amount' type='text' size='3' />"; }?></td>
                      


                      <?php
                        include('connect-db.php'); // Database connection using PDO
                        $d_amount = "";
                        $result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$color_row' AND tithe_id = '$tithe_id' AND month = '10'") 
                            or die(mysqli_error());
                        while($rows=mysqli_fetch_assoc($result_hist))
                        { // Start looping table row
                          $d_amount = $rows["amount"];
                        }   
                      ?> 
                      <td align="center" size = "5" bgcolor="#FFFFFF"><?php {echo "<input name='oct[$color_row ]' value='$d_amount' type='text' size='3' />"; }?></td>
                      



                      <?php
                        include('connect-db.php'); // Database connection using PDO
                        $d_amount = "";
                        $result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$color_row' AND tithe_id = '$tithe_id' AND month = '11'") 
                            or die(mysqli_error());
                        while($rows=mysqli_fetch_assoc($result_hist))
                        { // Start looping table row
                          $d_amount = $rows["amount"];
                        }   
                      ?> 
                      <td align="center" size = "5" bgcolor="#FFFFFF"><?php {echo "<input name='nov[$color_row ]' value='$d_amount' type='text' size='3' />"; }?></td>
                      


                      <?php
                        include('connect-db.php'); // Database connection using PDO
                        $d_amount = "";
                        $result_hist = mysqli_query($connection,"SELECT amount FROM ten_percent_contributions where member_id = '$color_row' AND tithe_id = '$tithe_id' AND month = '12'") 
                            or die(mysqli_error());
                        while($rows=mysqli_fetch_assoc($result_hist))
                        { // Start looping table row
                          $d_amount = $rows["amount"];
                        }   
                      ?> 
                      <td align="center" size = "5" bgcolor="#FFFFFF"><?php {echo "<input name='dec[$color_row ]' value='$d_amount' type='text' size='3' />"; }?></td>
                     </tr>
<?php               //$color_row = $color_row +1;
									}
									echo "</table>";
                  echo "</font>";
									mysqli_close($connection);				
?>  
<input type="hidden" name="tithe_id" id="tithe_id" value = '<?php echo $tithe_id;?>' >
<input type="submit" class="btn green" value="Save Tithes"  >
</form>

<br><br><br><br><br>    

            </div>
        </div>      

      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
<?php include("footer.php"); ?>