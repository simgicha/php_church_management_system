
<?php include("top.php"); ?>
      <!-- BEGIN PAGE -->
      <div class="page-content" style="min-height:590px !important">
  
          <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-reorder"></i>BUDGET
                    <span>>> </span>Budget Balances
                </div>
                <div class="tools">
                </div>
            </div>
            
            

            <div class="portlet-body form">
                <div class="tabbable-custom ">

                    <div class="tab-content">
                        This list shows all assets and livestock in the system\
                        <br>
                        
                            <form id="member" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >        
 			                <table  class="alert-table" cellspacing="0" cellpadding="4" width="100%" border="0" id="my-editor" >
                                 
                           <tr>
                           <td align="left" valign="top">
                                <table>
 
                                          <tr>
                                            <td>Search By item category</td>   
                                            <td>
                                            <?php
												 include('connect-db.php'); // Database connection using PDO
												
												$result = mysqli_query($connection,"SELECT 	category_name,id FROM asset_categories order by category_name ASC") 
										or die("No members");  

												echo "<select name=category_name value='' class='form-control combobox_ui' onchange='this.form.submit()';>Church Member</option>"; // list box select command
												echo "<option value=''>-- Search by category name --</option>";
											  while($rows=mysqli_fetch_assoc($result))
											  { // Start looping table row
						
												//foreach ($dbo->query($sql) as $row){//Array or records stored in $row
												echo "<option value=$rows[id]>$rows[category_name]</option>";
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
                        
                        
<?php
	include('connect-db.php');
	if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
	$start_from = ($page-1) * 20;
	
	if(isset($_POST['category_name']))
	{
		$cat_id = $_POST['category_name'];
         $result = mysqli_query($connection,"SELECT a.id, a.item_name, a.local_church_id, l.name, a.purchase_date, a.initial_value, a.item_tag, a.disposal_date, a.disposal_amount, a.status, a.quantity, a.item_category_id, ac.category_name, o.owner_name, o.id as owner_id, a.qty_disposed FROM assets a, local_church l, assets_owners o, asset_categories ac WHERE ac.id = a.item_category_id AND a.local_church_id = l.id AND o.id = a.owner_id AND a.item_category_id = '$cat_id' ORDER BY id DESC LIMIT $start_from, 20") 
                or die("No orders in the table orders");
        // display data in table
		
        echo"<table width=\"100%\" height='30' border=3 align=center cellpadding=1 cellspacing=1 bgcolor=\"#CCCCCC\">";
        echo "	<tr height=30px>
		<td width=\10%\ align=center bgcolor=\"#666666\"><strong>Name</strong></td>
		<td bgcolor=\"#666666\"><strong>Local Church</strong></td>	
		<td align=center bgcolor=\"#666666\"><strong>Purchase Date</strong></td>
 		<td align=center bgcolor=\"#666666\"><strong>Status</strong></td>	
		<td align=center bgcolor=\"#666666\"><strong>Category</strong></td>		    
		<td align=center bgcolor=\"#666666\"><strong>Purchase Value</strong></td>
		<td align=center bgcolor=\"#666666\"><strong>Owned by</strong></td>
		
	</tr>";	
        while($rows=mysqli_fetch_assoc($result))
	{ // Start looping table row
	echo "<tr>";
		$id = $rows['id'];
		if($id%2==0){
			echo "<td align='center' height='30px' bgcolor='#F3F3F3'>";echo ($rows['item_name']); echo "</td>";
			echo "<td align='center' bgcolor='#F3F3F3'>";echo $rows['name']; echo "</td>";
			echo "<td align='center' bgcolor='#F3F3F3'>";echo $rows['purchase_date']; echo "</td>";
			echo "<td align='center' bgcolor='#F3F3F3'>";echo $rows['status']; echo "</td>";
			echo "<td align='center' bgcolor='#F3F3F3'>";echo $rows['category_name']; echo "</td>";
			echo "<td align='center' bgcolor='#F3F3F3'>";echo $rows['initial_value']; echo "</td>";
			echo "<td align='center' bgcolor='#F3F3F3'>";echo $rows['owner_name']; echo "</td>";
		}
		else
		{

			echo "<td align='center' height='30px' bgcolor='#FFFFFF'>";echo ($rows['item_name']); echo "</td>";
			echo "<td align='center' bgcolor='#FFFFFF'>";echo $rows['name']; echo "</td>";
			echo "<td align='center' bgcolor='#FFFFFF'>";echo $rows['purchase_date']; echo "</td>";
			echo "<td align='center' bgcolor='#FFFFFF'>";echo $rows['status']; echo "</td>";
			echo "<td align='center' bgcolor='#FFFFFF'>";echo $rows['category_name']; echo "</td>";
			echo "<td align='center' bgcolor='#FFFFFF'>";echo $rows['initial_value']; echo "</td>";
			echo "<td align='center' bgcolor='#FFFFFF'>";echo $rows['owner_name']; echo "</td>";			
		}
		
	echo "</tr>	";
	}	
	echo "</table>";	
				include('connect-db.php');
				$sql = "SELECT COUNT(id) FROM assets";
				$rs_result = mysqli_query($connection,$sql);
				$row = mysqli_fetch_row($rs_result);
				$total_records = $row[0];
				$total_pages = ceil($total_records / 20);
				  
				for ($i=1; $i<=$total_pages; $i++) {
							echo "<a href='inventory-report.php?page=".$i."'>".$i."</a> ";
				};echo "pages";
				
				
				
				
	}	
	else
	{

         $result = mysqli_query($connection,"SELECT a.id, a.item_name, a.local_church_id, l.name, a.purchase_date, a.initial_value, a.item_tag, a.disposal_date, a.disposal_amount, a.status, a.quantity, a.item_category_id, ac.category_name, o.owner_name, o.id as owner_id, a.qty_disposed FROM assets a, local_church l, assets_owners o, asset_categories ac WHERE ac.id = a.item_category_id AND a.local_church_id = l.id AND o.id = a.owner_id  ORDER BY id DESC LIMIT $start_from, 20") 
                or die("No orders in the table orders");
        // display data in table
		
        echo"<table width=\"100%\" height='30' border=3 align=center cellpadding=1 cellspacing=1 bgcolor=\"#CCCCCC\">";
        echo "	<tr height=30px>
		<td width=\10%\ align=center bgcolor=\"#666666\"><strong>Name</strong></td>
		<td bgcolor=\"#666666\"><strong>Local Church</strong></td>	
		<td align=center bgcolor=\"#666666\"><strong>Purchase Date</strong></td>
 		<td align=center bgcolor=\"#666666\"><strong>Status</strong></td>	
		<td align=center bgcolor=\"#666666\"><strong>Category</strong></td>	 		    
		<td align=center bgcolor=\"#666666\"><strong>Purchase Value</strong></td>
		<td align=center bgcolor=\"#666666\"><strong>Owned by</strong></td>
		
	</tr>";	
        while($rows=mysqli_fetch_assoc($result))
	{ // Start looping table row
	echo "<tr>";
		$id = $rows['id'];
		if($id%2==0){
			echo "<td align='center' height='30px' bgcolor='#F3F3F3'>";echo ($rows['item_name']); echo "</td>";
			echo "<td align='center' bgcolor='#F3F3F3'>";echo $rows['name']; echo "</td>";
			echo "<td align='center' bgcolor='#F3F3F3'>";echo $rows['purchase_date']; echo "</td>";
			echo "<td align='center' bgcolor='#F3F3F3'>";echo $rows['status']; echo "</td>";
			echo "<td align='center' bgcolor='#F3F3F3'>";echo $rows['category_name']; echo "</td>";		
			echo "<td align='center' bgcolor='#F3F3F3'>";echo $rows['initial_value']; echo "</td>";
			echo "<td align='center' bgcolor='#F3F3F3'>";echo $rows['owner_name']; echo "</td>";
		}
		else
		{

			echo "<td align='center' height='30px' bgcolor='#FFFFFF'>";echo ($rows['item_name']); echo "</td>";
			echo "<td align='center' bgcolor='#FFFFFF'>";echo $rows['name']; echo "</td>";
			echo "<td align='center' bgcolor='#FFFFFF'>";echo $rows['purchase_date']; echo "</td>";
			echo "<td align='center' bgcolor='#FFFFFF'>";echo $rows['status']; echo "</td>";
			echo "<td align='center' bgcolor='#FFFFFF'>";echo $rows['category_name']; echo "</td>";
			echo "<td align='center' bgcolor='#FFFFFF'>";echo $rows['initial_value']; echo "</td>";
			echo "<td align='center' bgcolor='#FFFFFF'>";echo $rows['owner_name']; echo "</td>";			
		}
		
	echo "</tr>	";
	}	
	echo "</table>";	
				include('connect-db.php');
				$sql = "SELECT COUNT(id) FROM assets";
				$rs_result = mysqli_query($connection,$sql);
				$row = mysqli_fetch_row($rs_result);
				$total_records = $row[0];
				$total_pages = ceil($total_records / 20);
				  
				for ($i=1; $i<=$total_pages; $i++) {
							echo "<a href='inventory-report.php?page=".$i."'>".$i."</a> ";
				};echo "pages";
	}
	
	
 ?>
 			
                    </div>
                </div>
            </div>
        </div>


      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
<?php include("footer.php"); ?>