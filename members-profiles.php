<?php
session_start();
if(!isset($_SESSION['myusername'])){
header('location: index.php');
}
?>
<?php include("top.php"); ?>

      <?php 
	  		

	   		
	   ?>

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
                                    
                                    
                            <form id="member_new" action="member_save.php" method="post" name = "member_new">        
 			                <table  class="alert-table" cellspacing="0" cellpadding="4" width="100%" border="0" id="my-editor" >
                                 
                           <tr>
                           <td align="left" valign="top">
                                <table cellspacing="0" cellpadding="2"  >
                                     <tr>
			                                 <td width="140">Member No.</td>
		                                     <td><input class="form-control" type="text" name="id" value=""  readonly size=40/>
		                                      </td>
		                                </tr>
                                        <tr>
			                                 <td>Fullname</td>
		                                     <td><input class="form-control" type="text" name="name" value="" size=40/>
		                                      </td>
		                                </tr>
                                        <tr>
                                            <td>Year of birth</td>   
                                            <td><input class="form-control combobox_ui" type="text" name="date_of_birth" data-role="datepicker"  value="" size=40/>
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
												 
												 
												
												$result = mysqli_query($connection,"SELECT name,id FROM small_christian_community WHERE local_church_id = '$b_id' order by id") 
										or die("No Buildings are added");  

												echo "<select name=scc value='' class='form-control combobox_ui';>Scc</option>";   			                                                 echo "<option value=''>-- Select --</option>";
											  echo "<option value='000'>-- Select Scc --</option>";
											  while($rows=mysqli_fetch_assoc($result))
											  { // Start looping table row
						
												//foreach ($dbo->query($sql) as $row){//Array or records stored in $row
												echo "<option value=$rows[id]>$rows[name]</option>";
												/* Option values are added by looping through the array */
												}
												echo "</select>";// Closing of list box
												
											?>
											<input class="form-control"  type="hidden" name="local_church" id="local_church" value='<?php echo $b_id; ?>' size=40/>
		                                  </td>
		                                </tr>
                                  
                                        
                                        <tr>
                                        <td>
                                             <span class="input-group-btn">
                                                    <br><br>
                                                    <input type="submit" value="Save Data" name="submit" id="save" class="btn green"/>

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