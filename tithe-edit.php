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
                        
            $result = mysqli_query($connection,"SELECT t.id, t.member_id, m.name, t.amount, t.sync_datetime,tc.id as t_id, tc.description,s.name as scc_name FROM ten_percent_contributions t, members m, ten_percent_configuration tc,small_christian_community s WHERE m.id = t.member_id AND tc.id = t.tithe_id AND m.scc = s.id AND t.id = '$b_id' order by t.id DESC") or die("No Chirstians");  

            while($rows=mysqli_fetch_assoc($result))
            { // Start looping table row
                                  
                
                $id = $rows['id'];
                $full_name = $rows['name'];
                $tithe_id_row = $rows['t_id'];
                $amount = $rows['amount'];
                $tithe_desc = $rows['description'];
               
                
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
                                    
                                    
                            <form id="member_new" action="tithe_update.php" method="post" name = "member_new">        
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
			                                 <td>Tithe</td>
		                                     <td>
                                             <?php
												 include('connect-db.php'); // Database connection using PDO

												 $b_id = $_GET['id'];
												 
												 
												
												$result = mysqli_query($connection,"SELECT description,id FROM ten_percent_configuration order by id") 
										or die("No Buildings are added");  

												echo "<select name=tithe value='' class='form-control combobox_ui';>Tithe</option>";   			                                                 echo "<option value=''>-- Select --</option>";
											  echo "<option value='$tithe_id'></option>";
											  while($rows=mysqli_fetch_assoc($result))
											  { // Start looping table row
						
												//foreach ($dbo->query($sql) as $row){//Array or records stored in $row
												echo "<option value=$rows[id]>$rows[description]</option>";
												/* Option values are added by looping through the array */
												}
												echo "<option selected='selected'>$tithe_desc</option>";
												
												echo "</select>";// Closing of list box
												
											?>
											<input class="form-control"  type="hidden" name="tithe_id_row" id="tithe_id_row" value='<?php echo $b_id; ?>' size=40/>
		                                  </td>
		                                </tr>
                                  
                                       
                                                                    
                                         <tr>
			                                 <td>Amount</td>
		                                     <td><input class="form-control" type="text" name="amount" value="<?php echo $amount; ?>" size=40/>
		                                  </td>
		                                </tr>

                                </table>
                            </td>

                          
                           <td align="left" valign="top"> 
                                    <table cellspacing="0" cellpadding="2" border="0" size=40>
                                           
                               
										
                                          
                                          
                                        
                                        <tr>
                                        <td>
                                             <span class="input-group-btn">
                                                    <br><br>
                                                    <input type="submit" value="Update Tithe" name="submit" id="save" class="btn green"/><br><br>
													<input type="submit" value="Delete Tithe" name="del" id="save" class="btn red"/>
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