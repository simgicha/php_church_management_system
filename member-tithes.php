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
                                       
                                        table.alert-table tr td{
                                            padding:3px 3px;
                                            font-size: 14px;                                        
                                        }
										fieldset{
											width:40%;
											margin:auto;
											
											background-color:#4B8DF8;
											border:solid #333;
										}
										legend{
										}
                                    </style>

                                       
                                    This part is used to record all the tithes from all christians from the varoius local churches. First select the local church then the member then enter the tithes amount and all the details<br>

                               
                                    
                            <form name = "members-tithes" id="members-tithes" action="member-tithes-new.php" method="post">        
 			                <table  class="alert-table" cellspacing="0" cellpadding="4" width="100%" border="0" id="my-editor" >
                                 
                           <tr>
                           <td align="left" valign="top">
                                <table cellspacing="0" cellpadding="2"  >
                                     <tr>
			                                 <td width="140" border="0">Select Scc</td>
		                                     <td border="0">

                                             
                                                <?php
												 include('connect-db.php'); // Database connection using PDO
												
													$result = mysqli_query($connection,"SELECT l.name as local_church, s.name as scc, s.id as scc_id FROM local_church l, small_christian_community s where l.id = s.local_church_id order by local_church") or die("No Buildings are added");  

	
													echo "<select name=scc_id value='' class='form-control combobox_ui';>Scc</option>"; 	
													echo "<option value='000'>-- Select SCC --</option>";							                                                     echo "<option value=''>-- Select --</option>";
												  while($rows=mysqli_fetch_assoc($result))
												  { // Start looping table row
							
													$da = $rows[local_church]." - ".$rows[scc];
													//foreach ($dbo->query($sql) as $row){//Array or records stored in $row
													echo "<option value=$rows[scc_id]>$da</option>";
													/* Option values are added by looping through the array */
													}
													echo "</select>";// Closing of list box
													
												?>
		                                      </td>
		                                </tr>
                           
                                       
                                          <tr>
                                            <td border="0">Tithe Year</td>   
                                            <td border =  "0">
                                            <?php
												 include('connect-db.php'); // Database connection using PDO
												
												$result = mysqli_query($connection,"SELECT description,id FROM ten_percent_configuration WHERE status ='true' order by id") 
										or die("No Buildings are added");  

												echo "<select name=tithe_id value='' class='form-control combobox_ui';>Tithe Year</option>"; 
												echo "<option value='000'>-- Select tithe --</option>";
											  while($rows=mysqli_fetch_assoc($result))
											  { // Start looping table row
						
												//foreach ($dbo->query($sql) as $row){//Array or records stored in $row
												echo "<option value=$rows[id]>$rows[description]</option>";
												/* Option values are added by looping through the array */
												}
												echo "</select>";// Closing of list box
												
											?>
                                             

		                                    </td>
                                        </tr>                                   
                                 
		                                     <td border="0"><input class="form-control" type="hidden" name="payment_date" value="" size=40/>
		                             
                                        <tr>
                                        <td border="0"></td>
                                        <td align="right" border="0">
                                              <span class="input-group-btn"><br>
                                                    <input type="submit" class="btn green" value="Search"  >

                                                </span>
                                        </td>
                                        </tr>
                                </table>
                            </td>

                          
                           <td align="left" valign="top"> 
                                    <table cellspacing="0" cellpadding="2" border="0" size=40>






                                    </table>
                           
                           </td>
                           </tr>
                           
                           </table>
							</form>
  <script  type="text/javascript">
 var frmvalidator = new Validator("members-tithes");
 

 frmvalidator.addValidation("tithe_id","dontselect=000");
  frmvalidator.addValidation("scc_id","dontselect=000");

</script>
 
 <!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& end form &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& --> 

 <a href="all_tithes.php"><button type="button" class="btn btn-primary">View All</button></a><br> 
 The last 50 contributions 

         <style>

table {
    width: 100%;
    border: thin solid black;
    border-spacing: 0 10px;
}
td {
   
    border-top: thin solid #A3A3A3;
    
}
th, tfoot td {
    border: thin solid black;
    text-align: center;
    font-weight: bold;
}
tbody td {
    font-size: 90%;
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
									$result = mysqli_query($connection,"SELECT t.id, t.member_id, m.name, t.amount, t.sync_datetime, tc.description,s.name as scc_name FROM ten_percent_contributions t, members m, ten_percent_configuration tc,small_christian_community s WHERE m.id = t.member_id AND tc.id = t.tithe_id AND m.scc = s.id order by t.id DESC LIMIT 50") 
											or die(mysqli_error());  
									
									echo"<table width=\"100%\" height='30'  align=left cellpadding=1 cellspacing=1 bgcolor=\"#CCCCCC\">";
									echo "	<tr>
										<td width=\"10%\" height=30 align=left bgcolor=\"#E6E6E6\"><strong>Name</strong></td>
										<td width=\"10%\" height=30 align=left bgcolor=\"#E6E6E6\"><strong>SCC</strong></td>
										<td width=\"5%\" align=left bgcolor=\"#E6E6E6\"><strong>Amount</strong></td>
										<td width=\"7%\" align=left bgcolor=\"#E6E6E6\"><strong>Tithe</strong></td>
										<td width=\"7%\" align=left bgcolor=\"#E6E6E6\"><strong>Date Added</strong></td>

									</tr>";	
									$color_row = 1;			
									while($rows=mysqli_fetch_assoc($result))
									{ // Start looping table row
									?>

                                        <tr>
                                            <td align="left" height="22px" bgcolor="#FFFFFF"><?php {echo ($rows["name"]); }?></td>
                                            <td align="left" bgcolor="#FFFFFF"><?php {echo $rows['scc_name']; }?></td>
                                            <td align="center" bgcolor="#FFFFFF"><?php {echo $rows['amount']; }?></td>
                                            <td align="left" bgcolor="#FFFFFF"><?php {echo $rows['description']; }?></td>
                                            <td align="left" bgcolor="#FFFFFF"><?php {echo $rows['sync_datetime']; }?></td>

                                        </tr>
 
                                     <?php 
									}
									echo "</table>";
									mysqli_close($connection);
									$_POST['amount'] = "";
?>     
<br><br><br><br><br>    

            </div>
        </div>      

      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
<?php include("footer.php"); ?>