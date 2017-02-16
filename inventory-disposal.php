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
                <div class="caption"><i class="icon-reorder"></i>Church Inventory
                    <span> >> </span> Assets/Livestock Disposal
                </div>
                <div class="tools">
                </div>
            </div>
            
            <div class="portlet-body form">
                <div class="tabbable-custom ">

                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_5_1" data-toggle="tab">All livestock</a></li>  
                        
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_5_1">
                        <h4>Assets/Inventory Disposal</h4>
                        Add item to dispose<br>
                        <fieldset style="border:1px solid #CCC;">
                        
                                       <form id="transfer" name="transfer" action="post-disposal.php" method="post">
                                <table cellspacing="0" cellpadding="2" width="100%"  >

                                        <tr>
			                                 <td>Select the item/livestock you are selling</td>
		                                     <td>
                                            <?php
												 include('connect-db.php'); // Database connection using PDO
												
												$result = mysqli_query($connection,"SELECT id,item_name FROM assets order by item_name") 
										or die("No Buildings are added");  

												echo "<select name=item_name value='' class='form-control combobox_ui';>Item name</option>"; // list box select command
												echo "<option value=''>-- Select --</option>";
											  while($rows=mysqli_fetch_assoc($result))
											  { // Start looping table row
						
												//foreach ($dbo->query($sql) as $row){//Array or records stored in $row
												echo "<option value=$rows[id]>$rows[item_name]</option>";
												/* Option values are added by looping through the array */
												}
												echo "</select>";// Closing of list box
												
											?>                                             
		                                      </td>
		                                </tr>
                                        <tr>
                                            <td>Enter quantity disposing</td>   
                                            <td><input class="form-control combobox_ui" type="text" name="qty_disposing" id="amount"  value="" size=40/>
		                                    </td>
                                        </tr>   
                                        
                                     	<tr>
			                                 <td width="40%">Total value/amount.</td>
		                                     <td><input class="form-control" type="text" name="amount_disposing" id="amount_disposing" value=""  size=40/>
		                                      </td>
		                                </tr>                                                                         
                                        <tr>
                                        <td>
                                        </td>
                                        <td>
                                             <span class="input-group-btn"><br>
                                             <input type="submit" class="btn green" value="Save"  >

                                             </span>
                                        </td>
                                        </tr>

                                </table>               
                </form>
                </fieldset>
                        
                        the below grid shows all items or livestock that has been disposed(sold out). Once an item is disposed or sold its removed from the inventory and deposited as a repository shown below
                            <div id="disposalgrid" style="font-size:12px !important"></div>
                            <script src="scripts/disposal.js"></script>
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