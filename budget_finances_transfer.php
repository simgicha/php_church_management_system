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
                <div class="caption"><i class="icon-reorder"></i>BUDGET
                    <span> >> </span> BUDGET TRANSFER
                </div>
                <div class="tools">
                </div>
            </div>
            
            <div class="portlet-body form">
 				This module is used to transfer money from one budget to another. Transfer is only possible if and only if the amount to be transfered is available from the source<br>
                Select the budget you are transfering the amounts from and indicate to what budget/project they are directed.
                <hr>
                <form id="transfer" name="transfer" action="post-transfer.php" method="post">
                                <table cellspacing="0" cellpadding="2" width="100%"  >

                                        <tr>
			                                 <td>Select the budget you are transfering from(Source)</td>
		                                     <td>
                                            <?php
												 include('connect-db.php'); // Database connection using PDO
												
												$result = mysqli_query($connection,"SELECT id,ref_no FROM budget_ref order by id") 
										or die("No Buildings are added");  

												echo "<select name=budget_from value='' class='form-control combobox_ui';>Budget</option>"; // list box select command
												echo "<option value=''>-- Select --</option>";
											  while($rows=mysqli_fetch_assoc($result))
											  { // Start looping table row
						
												//foreach ($dbo->query($sql) as $row){//Array or records stored in $row
												echo "<option value=$rows[id]>$rows[ref_no]</option>";
												/* Option values are added by looping through the array */
												}
												echo "</select>";// Closing of list box
												
											?>                                             
		                                      </td>
		                                </tr>
                                        <tr>
                                            <td>Enter amount to transfere</td>   
                                            <td><input class="form-control combobox_ui" type="text" name="amount" id="amount"  value="" size=40/>
		                                    </td>
                                        </tr>   
                                          <tr>
                                            <td>Select Destination Budget(Receiving Budget)</td>   
                                            <td>
                                            <?php
												 include('connect-db.php'); // Database connection using PDO
												
												$result = mysqli_query($connection,"SELECT id, ref_no FROM budget_ref order by id") 
										or die("No Buildings are added");  

												echo "<select name=budget_to value='' class='form-control combobox_ui';>Budget To</option>"; // list box select command
												echo "<option value=''>-- Select --</option>";
											  while($rows=mysqli_fetch_assoc($result))
											  { // Start looping table row
						
												//foreach ($dbo->query($sql) as $row){//Array or records stored in $row
												echo "<option value=$rows[id]>$rows[ref_no]</option>";
												/* Option values are added by looping through the array */
												}
												echo "</select>";// Closing of list box
												
											?>
                                             

		                                    </td>
                                        </tr>  
                                        
                                     <tr>
			                                 <td width="40%">Reason for funds transfere.</td>
		                                     <td><input class="form-control" type="text" name="reason" id="reason" value=""  size=40/>
		                                      </td>
		                                </tr>                                                                         
                                        <tr>
                                        <td>
                                        </td>
                                        <td>
                                             <span class="input-group-btn"><br><br>
                                             <input type="submit" class="btn green" value="Save"  >

                                             </span>
                                        </td>
                                        </tr>

                                </table>               
                </form>
            </div>
        </div>      

      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
<?php include("footer.php"); ?>