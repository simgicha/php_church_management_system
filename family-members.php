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
                <div class="caption"><i class="icon-reorder"></i>Church Families
                    <span> >> </span> All Christians with their families
                </div>
                <div class="tools">
                </div>
            </div>
            
            <div class="portlet-body form">
                <div class="tabbable-custom ">

                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_5_1" data-toggle="tab">Church Family Members</a></li>  
                        <li ><a href="#tab_5_2" data-toggle="tab">Add/Change Images</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_5_1">
                        Here we add all families: Husband wife and children
                            <div id="familymembersgrid" style="font-size:12px !important"></div>
                            <script src="scripts/family_members.js"></script>
						</div> 
                         
                        <div class="tab-pane" id="tab_5_2">
                        	Select the member to add photo
                            <form id="member" enctype="multipart/form-data" action="upload2.php" method="post">     
                            <table width="60%" align="center">
                            <tr><td>
                                               <?php
												 include('connect-db.php'); // Database connection using PDO
												
													$result = mysqli_query($connection,"SELECT name,id FROM members order by name ASC") or die("No Buildings are added");  

	
													echo "<select name=member_id value='' class='form-control combobox_ui';>Member</option>"; 								                                                     echo "<option value=''>-- Select --</option>";
												  while($rows=mysqli_fetch_assoc($result))
												  { // Start looping table row
							
													//foreach ($dbo->query($sql) as $row){//Array or records stored in $row
													echo "<option value=$rows[id]>$rows[name]</option>";
													/* Option values are added by looping through the array */
													}
													echo "</select>";// Closing of list box
													
												?>
                               </td></tr>
                               <tr><td>
                                          <br><br>
                            
                            <div id="filediv"><input name="file[]" type="file" id="file"/></div><br/>
                            <input type="button" id="add_more" class="upload" value="Add More Images"/><br><br>
                            <input type="submit" value="Save Data" name="submit" id="upload" class="btn green"/>
                            </td></tr>
                            </table>
							</form>
                        </div>   
                               
                    </div>
               <script type="text/x-kendo-template" id="timeInPhotoTemplate">
            		<a href="#= member_photo #" title="Member Name: #=name#" class="fancybox" data-fancybox-group="family_members">
                	<img src="#= member_photo #" alt="No Photo" height="80" width="80"/>
            		</a>
	
        		</script>
                <script type="text/x-kendo-template" id="memberEditTemplate">			
                                
 			                <table  class="alert-table" width="100%" id="my-editor" >
                                 
                           <tr>
                           <td align="left" valign="top">
                                <table>
                                     <tr>
			                                 <td width="100">Family Name.</td>
		                                     <td><input class="form-control" type="text" name="family_name" value="" size=30/>
		                                      </td>
		                                </tr>
                                        <tr>
			                                 <td>Member Names</td>
		                                     <td><input class="form-control" type="text" name="name" id ="name" value="" size=30/>
		                                      </td>
		                                </tr>
                                        <tr>
                                            <td>Year of birth</td>   
                                            <td><input class="form-control combobox_ui" type="text" name="registration_date" id="registration_date" data-role="datepicker"  value="" size=40/>
		                                    </td>
                                        </tr>   
                                          <tr>
                                            <td>Marital Status</td>   
                                            <td>
                                            <?php
												 include('connect-db.php'); // Database connection using PDO
												
												$result = mysqli_query($connection,"SELECT marital_status,id FROM marital_status order by id") 
										or die("No Buildings are added");  

												echo "<select name=marrital_status id='marrital_status' value='' class='form-control combobox_ui';>Marrital Status</option>"; // list box select command
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
		                                     <td><input class="form-control" type="text" name="phone_number" id = "phone_number" value="" size=40/>
		                                  </td>
		                                </tr>
										
										                                             <tr>
			                                 <td>Gender</td>
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
			                                 <td>Economic Activity</td>
		                                     <td><input class="form-control" type="text" name="economic_activity" id = "economic_activity" value="" size=40/>
		                                  </td>
		                                </tr>
                                </table>
                            </td>

                          
                           <td align="left" valign="top"> 
                                    <table border="0" size=40>


                                        <tr>
			                                 <td width="140">National Id No.</td>
		                                     <td><input class="form-control"  type="text" name="id_number" value="" size=40/>
		                                  </td>
		                                </tr>

                                          <tr>
			                                 <td>Local Church</td>
		                                     <td>
                                             <?php
												 include('connect-db.php'); // Database connection using PDO
												
												$result = mysqli_query($connection,"SELECT name,id FROM local_church order by id") 
										or die("No Buildings are added");  

												echo "<select name='local_church' id='local_church' value='' class='form-control combobox_ui';>Local Church</option>"; // list box select command
											   echo "<option value=''>-- Select --</option>";
											  while($rows=mysqli_fetch_assoc($result))
											  { // Start looping table row
						
												//foreach ($dbo->query($sql) as $row){//Array or records stored in $row
												echo "<option value=$rows[id]>$rows[name]</option>";
												/* Option values are added by looping through the array */
												}
												echo "</select>";// Closing of list box
												
											?>
		                                  </td>
		                                </tr>
                                          <tr>
			                                 <td>Small Christian Community</td>
		                                     <td>
                                             <?php
												 include('connect-db.php'); // Database connection using PDO
												
												$result = mysqli_query($connection,"SELECT name,id FROM small_christian_community order by id") 
										or die("No Buildings are added");  

												echo "<select name='scc' id='scc' value='' class='form-control combobox_ui';>Scc</option>";   			                                                 echo "<option value=''>-- Select --</option>";
											  while($rows=mysqli_fetch_assoc($result))
											  { // Start looping table row
						
												//foreach ($dbo->query($sql) as $row){//Array or records stored in $row
												echo "<option value=$rows[id]>$rows[name]</option>";
												/* Option values are added by looping through the array */
												}
												echo "</select>";// Closing of list box
												
											?>
		                                  </td>
		                                </tr>
										
										<tr>
			                                 <td>No of Children</td>
		                                     <td><input class="form-control" type="text" name="no_of_children" id = "no_of_children" value="" size=40/>
		                                  </td>
		                                </tr>
										
                                        <tr>
                                        <td colspan="2" width="200px" height="200px"><br>
                                        	
<input name="file[]" type="file" id="file"/>	
                                        </td>
                                        </tr>
                                        

                                    </table>
                           
                           </td>
                           </tr>
                           
                           </table>
							
 				</script>
 
 
 
 
                 <script type="text/x-kendo-template" id="memberDetailsEditTemplate">			
                                
 			                <table  class="alert-table" width="100%" border="1" id="my-editor" >
                                 
                           <tr>
                           <td align="left" valign="top">
                                <table>
                                 
                                        <tr>
			                                 <td>Member Names</td>
		                                     <td><input class="form-control" type="text" name="name" id ="name" value="" size=30/>
		                                      </td>
		                                </tr>
                                        <tr>
                                            <td>Year of birth</td>   
                                            <td><input class="form-control combobox_ui" type="text" name="registration_date" id="registration_date" data-role="datepicker"  value="" size=40/>
		                                    </td>
                                        </tr>   
                                          <tr>
                                            <td>Marital Status</td>   
                                            <td>
                                            <?php
												 include('connect-db.php'); // Database connection using PDO
												
												$result = mysqli_query($connection,"SELECT marital_status,id FROM marital_status order by id") 
										or die("No Buildings are added");  

												echo "<select name=marrital_status id='marrital_status' value='' class='form-control combobox_ui';>Marrital Status</option>"; // list box select command
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
		                                     <td><input class="form-control" type="text" name="phone_number" id = "phone_number" value="" size=40/>
		                                  </td>
		                                </tr>
										
										                                             <tr>
			                                 <td>Gender</td>
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

                                </table>
                            </td>

                          
                           <td align="left" valign="top"> 
                                    <table border="0" size=40>


                                        <tr>
			                                 <td width="140">National Id No.</td>
		                                     <td><input class="form-control"  type="text" name="id_number" value="" size=40/>
		                                  </td>
		                                </tr>

                                          <tr>
			                                 <td>Local Church</td>
		                                     <td>
                                             <?php
												 include('connect-db.php'); // Database connection using PDO
												
												$result = mysqli_query($connection,"SELECT name,id FROM local_church order by id") 
										or die("No Buildings are added");  

												echo "<select name='local_church' id='local_church' value='' class='form-control combobox_ui';>Local Church</option>"; // list box select command
											   echo "<option value=''>-- Select --</option>";
											  while($rows=mysqli_fetch_assoc($result))
											  { // Start looping table row
						
												//foreach ($dbo->query($sql) as $row){//Array or records stored in $row
												echo "<option value=$rows[id]>$rows[name]</option>";
												/* Option values are added by looping through the array */
												}
												echo "</select>";// Closing of list box
												
											?>
		                                  </td>
		                                </tr>
                                          <tr>
			                                 <td>Small Christian Community</td>
		                                     <td>
                                             <?php
												 include('connect-db.php'); // Database connection using PDO
												
												$result = mysqli_query($connection,"SELECT name,id FROM small_christian_community order by id") 
										or die("No Buildings are added");  

												echo "<select name='scc' id='scc' value='' class='form-control combobox_ui';>Scc</option>";   			                                                 echo "<option value=''>-- Select --</option>";
											  while($rows=mysqli_fetch_assoc($result))
											  { // Start looping table row
						
												//foreach ($dbo->query($sql) as $row){//Array or records stored in $row
												echo "<option value=$rows[id]>$rows[name]</option>";
												/* Option values are added by looping through the array */
												}
												echo "</select>";// Closing of list box
												
											?>
		                                  </td>
		                                </tr>
                                        <tr>
                                        <td colspan="2" width="200px" height="200px"><br>
                                        	
<input name="file[]" type="file" id="file"/>	
                                        </td>
                                        </tr>
                                        

                                    </table>
                           
                           </td>
                           </tr>
                           
                           </table>
							
 				</script>
 
 
               

                </div>

            </div>

        </div>      

      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
<?php include("footer.php"); ?>