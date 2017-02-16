<?php
session_start();
if(!isset($_SESSION['myusername'])){
header('location: index.php');
}
?>
<?php include("top.php"); ?>

      <?php 
	  		$b_id = $_GET['id'];
	  		include('connect-db.php'); // Database connection using PDO
                        
            $result = mysqli_query($connection,"SELECT m.id,m.name,m.local_church, m.scc,m.registration_date,m.marrital_status, m.phone_number, mar.marital_status, l.name as local_church_name, s.name as scc_name, s.id as scc_id from members m, local_church l, small_christian_community s, marital_status mar WHERE m.local_church = l.id AND s.id = m.scc AND mar.id = m.marrital_status AND m.id = '$b_id' ORDER BY id DESC") or die("No Chirstians");  

            while($rows=mysqli_fetch_assoc($result))
            { // Start looping table row
                                  
                
                $id = $rows['id'];
                $full_name = $rows['name'];
                $local_church_name = $rows['local_church_name'];
                $scc_name = $rows['scc_name'];
                $marrital_status = $rows['marital_status'];
                $phone_number = $rows['phone_number'];
                $registration_date = $rows['registration_date'];
                $scc_id = $rows['scc_id'];
                
            }

	   		
	   ?>

      <!-- BEGIN PAGE -->
      <div class="page-content" style="min-height:590px !important">
      
           <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>Member Profile
                    <span> >> </span>Church Member Profiles
                </div>
                <div class="tools">
                </div>
            </div>
            
            <div class="portlet-body form">
                <div class="tabbable-custom ">

                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_5_1" data-toggle="tab">Church Members</a></li>  
                    </ul>
                    <div class="tab-content">
<!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& form &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->
                                     <style>
                                       
                                        table.alert-table tr td{
                                            padding:3px 3px;
                                            font-size: 14px;
                                          
                                            
                                        }
                                    </style>
                                    
                                    
                            <form id="member_new" action="member_update.php" method="post" name = "member_new">        
 			                <table  class="alert-table" cellspacing="0" cellpadding="4" width="100%" border="0" id="my-editor" >
                                 
                           <tr>
                           <td align="left" valign="top">
                                <table cellspacing="0" cellpadding="2"  >
                                     <tr>
			                                 <td width="140">Member No.</td>
		                                     <td><input class="form-control" type="text" value = "<?php echo $id; ?>" name="id" value=""  readonly size=40/>
		                                      </td>
		                                </tr>
                                        <tr>
			                                 <td>Fullname</td>
		                                     <td><input class="form-control" type="text" value ="<?php echo $full_name; ?>" name="name" value="" size=40/>
		                                      </td>
		                                </tr>
                                        <tr>
                                            <td>Year of birth</td>   
                                            <td><input class="form-control combobox_ui" value="<?php echo $registration_date; ?>" type="text" name="date_of_birth" data-role="datepicker" size=40/>
		                                    </td>
                                        </tr>   
                                          <tr>
                                            <td>Marital Status</td>   
                                            <td>
                                            <?php
												 include('connect-db.php'); // Database connection using PDO
												
												$result = mysqli_query($connection,"SELECT marital_status,id FROM marital_status order by id") 
										or die("No Buildings are added");  

												echo "<select name=marrital_status value='' class='form-control combobox_ui';>Marrital Status</option>"; // list box select command
											  while($rows=mysqli_fetch_assoc($result))
											  { // Start looping table row
						
												//foreach ($dbo->query($sql) as $row){//Array or records stored in $row
												echo "<option value=$rows[id]>$rows[marital_status]</option>";
												/* Option values are added by looping through the array */
												}
												echo "</select>";// Closing of list box
												
											?>
                                             

		                                    </td>
                                        </tr>                                   
                                         <tr>
			                                 <td>Phone Number</td>
		                                     <td><input class="form-control" type="text" name="phone_number" value="" size=40/>
		                                  </td>
		                                </tr>

                                </table>
                            </td>

                          
                           <td align="left" valign="top"> 
                                    <table cellspacing="0" cellpadding="2" border="0" size=40>
                                             <tr>
			                                 <td width="140">Gender</td>
		                                     <td>
                                              <?php
												 include('connect-db.php'); // Database connection using PDO
												
												$result = mysqli_query($connection,"SELECT gender_name,id FROM gender order by id") 
										or die("No Buildings are added");  

												echo "<select name=gender_name value='' class='form-control combobox_ui';>Gender</option>"; // list box select command
											  while($rows=mysqli_fetch_assoc($result))
											  { // Start looping table row
						
												//foreach ($dbo->query($sql) as $row){//Array or records stored in $row
												echo "<option value=$rows[id]>$rows[gender_name]</option>";
												/* Option values are added by looping through the array */
												}
												echo "</select>";// Closing of list box
												
											?>
		                                  </td>
		                                </tr>
                                        <tr>
			                                 <td>Email</td>
                                             
		                                     <td><input class="form-control" type="text" name="email" value=""  class="email" size=40/>
		                                  </td>
		                                </tr>
                                        <tr>
			                                 <td>National Id No.</td>
		                                     <td><input class="form-control"  type="text" name="nat_id" value="" size=40/>
		                                  </td>
		                                </tr>
										
                                          
                                          <tr>
			                                 <td>Small Christian Community</td>
		                                     <td>
                                             <?php
												 include('connect-db.php'); // Database connection using PDO

												 $b_id = $_GET['id'];
												 
												 
												
												$result = mysqli_query($connection,"SELECT name,id FROM small_christian_community order by id") 
										or die("No Buildings are added");  

												echo "<select name=scc value='' class='form-control combobox_ui';>Scc</option>";   			                                                 echo "<option value=''>-- Select --</option>";
											  echo "<option value='$scc_id'></option>";
											  while($rows=mysqli_fetch_assoc($result))
											  { // Start looping table row
						
												//foreach ($dbo->query($sql) as $row){//Array or records stored in $row
												echo "<option value=$rows[id]>$rows[name]</option>";
												/* Option values are added by looping through the array */
												}
												echo "<option value='$scc_id' selected='selected'>$scc_name</option>";
												
												echo "</select>";// Closing of list box
												
											?>
											<input class="form-control"  type="hidden" name="member_id" id="member_id" value='<?php echo $b_id; ?>' size=40/>
		                                  </td>
		                                </tr>
                                  
                                        
                                        <tr>
                                        <td>
                                             <span class="input-group-btn">
                                                    <br><br>
                                                    <input type="submit" value="Update Member" name="submit" id="save" class="btn green"/><br><br>
													<input type="submit" value="Delete Member" name="del" id="save" class="btn red"/>
                                                </span>
                                        </td>
                                        </tr>
                                    </table>
                           
                           </td>
                           </tr>
                           
                           </table>
							</form>
   <script  type="text/javascript">
 var frmvalidator = new Validator("member_new");
 

 frmvalidator.addValidation("scc","dontselect=000");
  
</script>
 
 <!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& end form &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->                              
                    </div>

                </div>
            </div>
        </div>      

      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
<?php include("footer.php"); ?>