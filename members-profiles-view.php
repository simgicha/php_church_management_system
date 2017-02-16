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
                <div class="tabbable-custom ">

                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_5_1" data-toggle="tab">Church Members Profile</a></li>  
                    </ul>
                    <div class="tab-content">
<!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& form &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->
                                     <style>
                                       
                                        table.alert-table tr td{
                                            padding:3px 3px;
                                            font-size: 14px;
                                          
                                            
                                        }
                                    </style>
                                   Select on a member to view profile
                                    
                            <form id="member" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >        
 			                <table  class="alert-table" cellspacing="0" cellpadding="4" width="100%" border="0" id="my-editor" >
                                 
                           <tr>
                           <td align="left" valign="top">
                                <table>
 
                                          <tr>
                                            <td>Search By name</td>   
                                            <td>
                                            <?php
												 include('connect-db.php'); // Database connection using PDO
												
												$result = mysqli_query($connection,"SELECT name,id FROM members order by name ASC") 
										or die("No members");  

												echo "<select name=church_member value='' class='form-control combobox_ui' onchange='this.form.submit()';>Church Member</option>"; // list box select command
												echo "<option value=''>-- Select Member name --</option>";
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


                                </table>
                            </td>

                          
                           <td align="left" valign="top"> 
                                    <table cellspacing="0" cellpadding="2" border="0" size=40>
                                        <tr>
			                                 <td>Search By Id No</td>
		                                     <td><input class="form-control" type="text" name="name" value="" placeholder="Enter Id No" size=40/>
		                                      </td>
		                                </tr>

                                    </table>
                           
                           </td>
                           </tr>
                           
                           </table>
							</form>
                            <?php		
								if(!isset($_POST['church_member'])){
									echo "No member selected";
								}	
								else{
									echo "Member Profile ";
									$member_no = $_POST['church_member'];
									include('connect-db.php');
									if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
									$start_from = ($page-1) * 4;
									
									 $result = mysqli_query($connection,"SELECT m.id, m.name, m.local_church, l.name as l_name, s.name as scc_name, m.scc,m.registration_date,m.marrital_status,m.phone_number,m.id_number, mar.marital_status, m.img FROM members m, local_church l, small_christian_community s, marital_status mar WHERE m.id = $member_no AND l.id = m.local_church AND m.scc = s.id AND mar.id = m.marrital_status ORDER BY m.id DESC LIMIT $start_from, 4") 
											or die(mysqli_error());  
									
									echo"<table width=\"100%\" height='30' style='border:1px solid #666;' align=center cellpadding=1 cellspacing=1 bgcolor=\"#CCCCCC\">";
									echo "	<tr>
										<td width=\"8%\" style='border:1px solid #666;' height=30 align=center bgcolor=\"#E6E6E6\"><strong>Name</strong></td>
										<td width=\"10%\" style='border:1px solid #666;' align=center bgcolor=\"#E6E6E6\"><strong>Id number</strong></td>
										<td width=\"13%\" style='border:1px solid #666;' align=center bgcolor=\"#E6E6E6\"><strong>Local Church</strong></td>
										<td width=\"13%\" style='border:1px solid #666;' align=center bgcolor=\"#E6E6E6\"><strong>Scc</strong></td>
										<td width=\"13%\" style='border:1px solid #666;' align=center bgcolor=\"#E6E6E6\"><strong>Registration Date</strong></td>
										<td width=\"13%\" style='border:1px solid #666;' align=center bgcolor=\"#E6E6E6\"><strong>Marital Starus</strong></td>
										<td width=\"13%\" style='border:1px solid #666;' align=center bgcolor=\"#E6E6E6\"><strong>Phone number</strong></td>

									</tr>";							
									while($rows=mysqli_fetch_assoc($result))
									{ // Start looping table row
										
										echo "<img src='".$rows["img"]."' alt='no image' width='200px' height='200px'>";
									?> 
                                        <tr>
                                            <td align="center" height="22px" bgcolor="#FFFFFF" style='border:1px solid #666;'><?php {echo ($rows["name"]); }?></td>
                                            <td align="center" bgcolor="#FFFFFF" style='border:0.5px solid #666;'><?php {echo $rows['id_number']; }?></td>
                                            <td align="center" bgcolor="#FFFFFF" style='border:0.5px solid #666;'><?php {echo $rows['l_name']; }?></td>
                                            <td align="center" bgcolor="#FFFFFF" style='border:0.5px solid #666;'><?php {echo $rows['scc_name']; }?></td>
                                            <td align="center" bgcolor="#FFFFFF" style='border:0.5px solid #666;'><?php {echo $rows['registration_date']; }?></td>
                                            <td align="center" bgcolor="#FFFFFF" style='border:0.5px solid #666;'><?php {echo $rows['marital_status']; }?></td>
                                            <td align="center" bgcolor="#FFFFFF" style='border:0.5px solid #666;'><?php {echo $rows['phone_number']; }?></td>
                                        </tr>
                                     <?php 
									}
									echo "</table>";
									mysqli_close($connection);
									echo "<br><br>";
									
									//------------------------------------------- next table stages----------------
									echo "<table width='100%'>";
									echo "<tr>";
									echo "<td width='45%'>";
										echo "Sacraments Received";
										echo "<br>";

										include('connect-db.php');
										if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
										$start_from = ($page-1) * 4;
										
										 $result = mysqli_query($connection,"SELECT sm.id, sm.member_id, sm.stage_id, sm.date_created, sm.is_active, m.name, s.stage_name FROM stages_members sm, members m, church_stages s WHERE sm.member_id = $member_no AND sm.member_id = m.id AND s.id = sm.stage_id ORDER BY sm.id DESC") or die(mysqli_error());  
										
										echo"<table width=\"99%\" height='30' border=1 align=top bgcolor=\"#CCCCCC\">";
										echo "	<tr>
											<td width=\"25%\" height=30 align=center bgcolor=\"#E6E6E6\"><strong>Name</strong></td>
											<td width=\"25%\" align=center bgcolor=\"#E6E6E6\"><strong>Sacrament</strong></td>
											<td width=\"25%\" align=center bgcolor=\"#E6E6E6\"><strong>Date Received</strong></td>
											<td width=\"25%\" align=center bgcolor=\"#E6E6E6\"><strong>Place</strong></td>
	
										</tr>";							
										while($rows=mysqli_fetch_assoc($result))
										{ // Start looping table row
										?>
											<tr>
												<td align="center" height="22px" bgcolor="#FFFFFF"><?php {echo ($rows["name"]); }?></td>
												<td align="center" bgcolor="#FFFFFF"><?php {echo $rows['stage_name']; }?></td>
												<td align="center" bgcolor="#FFFFFF"><?php {echo $rows['date_created']; }?></td>
												<td align="center" bgcolor="#FFFFFF"><?php {echo $rows['is_active']; }?></td>
											</tr>
										 <?php 
										}
										echo "</td>";
									
										echo "</table>";
										mysqli_close($connection);											
															
									echo "</td>";		
										
																
									echo "<td width='45%'>";
										echo "Tithes Contribution";
										echo "<br>";

										include('connect-db.php');
										if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
										$start_from = ($page-1) * 4;
										
										 $result = mysqli_query($connection,"SELECT t.id, t.member_id, m.name, t.amount, t.sync_datetime FROM ten_percent_contributions t, members m WHERE m.id = t.member_id AND t.member_id = $member_no ORDER BY t.id DESC") or die(mysql_error());  
										
										echo"<table width=\"100%\" height='30' border=1 align=left bgcolor=\"#CCCCCC\">";
										echo "	<tr>
											<td width=\"25%\" height=30 align=center bgcolor=\"#E6E6E6\"><strong>Name</strong></td>
											<td width=\"25%\" align=center bgcolor=\"#E6E6E6\"><strong>Amount</strong></td>
											<td width=\"25%\" align=center bgcolor=\"#E6E6E6\"><strong>Date Contributed</strong></td>
	
										</tr>";							
										while($rows=mysqli_fetch_assoc($result))
										{ // Start looping table row
										?>
											<tr>
												<td align="center" height="22px" bgcolor="#FFFFFF"><?php {echo ($rows["name"]); }?></td>
												<td align="center" bgcolor="#FFFFFF"><?php {echo $rows['amount']; }?></td>
												<td align="center" bgcolor="#FFFFFF"><?php {echo $rows['sync_datetime']; }?></td>
											</tr>
										 <?php 
										}
										echo "</td>";
									
										echo "</table>";
										mysqli_close($connection);	

									echo "</td>";	
									echo "</tr>";
									echo "</table>";	
									//----------------------------------end ---------------------------------------
								
									
								}
														
							 ?>

 
 
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