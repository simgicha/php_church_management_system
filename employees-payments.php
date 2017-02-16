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
                <div class="caption"><i class="icon-reorder"></i>Employees
                    <span> >> </span> Employee Salaries
                </div>
                <div class="tools">
                </div>
            </div>
            
            <div class="portlet-body form">
                <div class="tabbable-custom ">

                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_5_1" data-toggle="tab">Employee Salaries</a></li>
                        <li ><a href="#tab_5_2" data-toggle="tab">Overtime Payments</a></li>
                        <li ><a href="#tab_5_3" data-toggle="tab">Salary Advances</a></li>
                         
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_5_1">
                        
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
												
												$result = mysqli_query($connection,"SELECT month,id FROM months order by id ASC") 
										or die("No Months");  

												echo "<select name=month value='' class='form-control combobox_ui' onchange='this.form.submit()';>Month</option>"; // list box select command
												echo "<option value=''>-- Select Month --</option>";
											  while($rows=mysqli_fetch_assoc($result))
											  { // Start looping table row
						
												//foreach ($dbo->query($sql) as $row){//Array or records stored in $row
												echo "<option value=$rows[id]>$rows[month]</option>";
												/* Option values are added by looping through the array */
												}
												echo "</select>";// Closing of list box
												
											?>
                                             

		                                    </td>
                                        </tr>                                   


                                </table>
                            </td>

                           </tr>
                           
                           </table>
							</form>                        
                        
                        
                            This shows list of all pending payments FOR THE MONTH OF 
                            <?php
								if(!isset($_POST['month'])){																	    
									
									$now   = new DateTime();
									$month = (int)$now->format("m");
								}
								else{
									$month = $_POST['month'];
								}
								echo $month;
								include('connect-db.php');
							
									 $result = mysqli_query($connection,"SELECT e.id, e.employee_name FROM employees e WHERE active = 'true'") 
											or die("No pending payments");
									// display data in table
									
									echo"<table width=\"100%\" height='30' border=3 align=center cellpadding=1 cellspacing=1 bgcolor=\"#CCCCCC\">";
									echo "	<tr height=30px>
									<td width=\10%\ align=center bgcolor=\"#E6E6E6\"><strong>id</strong></td>
									<td bgcolor=\"#E6E6E6\"><strong>Employee</strong></td>	
									<td bgcolor=\"#E6E6E6\"><strong>Payment Status</strong></td>	
									<td align=center bgcolor=\"#E6E6E6\"><strong>Basic Pay</strong></td>
									
								</tr>";	
									while($rows=mysqli_fetch_assoc($result))
								{ // Start looping table row
								echo "<tr>";
									$id = $rows['id'];
									$already_paid = 0;
									
									 $result2 = mysqli_query($connection,"SELECT id, month_id, employee_id, year, COALESCE(SUM(amount),0) as amount, total_deductions as total_deductions, actual_amount_to_be_paid FROM monthly_salaries WHERE month_id = '".$month."' AND employee_id = '".$id."'") 
											or die("No pending payments");
									while($rows2=mysqli_fetch_assoc($result2))
									{ // Start looping table row	
										$amount_paying = $rows2['amount'];
										if($amount_paying == 0){
											$already_paid = 0;
										}
										else
											$already_paid = 1;
									 
										$amount_paid = $rows2['amount'] + $rows2['total_deductions'];
										$actual_amount_to_be_paid = $rows2['actual_amount_to_be_paid'];
									}
									if($already_paid == 0){
										echo "<td align='center' height='30px' bgcolor='#FFFFFF'>";echo ($rows['id']); echo "</td>";
										echo "<td align='center' bgcolor='#FFFFFF'>";echo $rows['employee_name']; echo "</td>";
										echo "<td align='center' bgcolor='#FFFFFF'>";echo "NOT PAID"; echo "</td>";	
										echo "<td align='center' bgcolor='#FFFFFF'>";echo "<a href='pay-employee.php?id=$id&month_paying=$month'>Pay Employee</a>"; echo "</td>";										
									}
									else
									{
										if($amount_paid <= ($actual_amount_to_be_paid-10))
										{
											echo "<td align='center' height='30px' bgcolor='#FF99FF'>";echo ($rows['id']); echo "</td>";
											echo "<td align='center' bgcolor='#FF99FF'>";echo $rows['employee_name']; echo "</td>";
											echo "<td align='center' bgcolor='#FF99FF'>";echo "PARTIALLY PAID"; echo "</td>";	
											echo "<td align='center' bgcolor='#FF99FF'>";echo "<a href='pay-employee.php?id=$id&month_paying=$month'>View Details</a>"; echo "</td>";														
										}
										else
										{
											echo "<td align='center' height='30px' bgcolor='#B3B3B3'>";echo ($rows['id']); echo "</td>";
											echo "<td align='center' bgcolor='#B3B3B3'>";echo $rows['employee_name']; echo "</td>";
											echo "<td align='center' bgcolor='#B3B3B3'>";echo "PAID"; echo "</td>";	
											echo "<td align='center' bgcolor='#B3B3B3'>";echo "<a href='pay-employee.php?id=$id&month_paying=$month'>View Details</a>"; echo "</td>";								
										}				
									}

								echo "</tr>	";
								}	
								echo "</table>";	
							 ?>
						</div>  
 
                               
                    </div>

                </div>
            </div>
        </div>      

      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
<?php include("footer.php"); ?>