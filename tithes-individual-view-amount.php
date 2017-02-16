<?php
session_start();
if(!isset($_SESSION['myusername'])){
header('location: index.php');
}
?>
<?php include("top.php"); ?>
      <!-- BEGIN PAGE -->
      <?php 
	  		$scc_id = $_POST['scc_id'];
	   		$tithe_id = $_POST['tithe_id'];
	   ?>
      <div class="page-content" style="min-height:590px !important">
      
           <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>Tithes
                    <span> >> </span>Tithes Report
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
   
                                    
     
    <input type="button" value="Print" onclick="PrintElem('#print_content')"  /><img src="assets/img/print_edit.gif"><br><br>
 
  <div id="print_content"> 
  
              <div class="col-md-6 col-sm-6">
                <!-- BEGIN PORTLET-->
              
                <!-- END PORTLET-->
                <br>	
                
                        <?php
	include('connect-db.php');

    $result = mysqli_query($connection,"SELECT SUM(t.amount) as total, s.name as scc_name FROM ten_percent_contributions t, members m, small_christian_community s WHERE t.member_id = m.id AND t.tithe_id = '$tithe_id' AND m.scc = '$scc_id' AND s.id = m.scc") 
                or die("No orders in the table orders");  
        // display data in table
      
    while($rows=mysqli_fetch_assoc($result))
    { // Start looping table row
    echo "<tr style='border: 1px solid #E6E6E6;'>";
        echo "<br>";
        echo "<b>SCC: ";echo $rows['scc_name']; echo "</b>";
    }  

	
			
		
         $result = mysqli_query($connection,"SELECT t.id, t.member_id, t.amount,t.tithe_id, m.name, s.name as scc_name FROM ten_percent_contributions t, members m, small_christian_community s WHERE t.member_id = m.id AND t.tithe_id = '$tithe_id' AND m.scc = '$scc_id' AND m.scc = s.id") 
                or die("No orders in the table orders");  
        // display data in table
		
        echo"<table width=\"100%\" height='30' style='border: 2px solid #E6E6E6;' align=center cellpadding=1 cellspacing=1 bgcolor=\"#CCCCCC\">";
        echo "	<tr height=30px style='border: 1px solid #E6E6E6;'>
		<td width=\10%\ align=left bgcolor=\"#E6E6E6\"><strong>Christian Name</strong></td>
		<td bgcolor=\"#E6E6E6\"><strong>tithes amount(Ksh)</strong></td>	


	</tr>";	
        while($rows=mysqli_fetch_assoc($result))
	{ // Start looping table row
	echo "<tr style='border: 1px solid #E6E6E6;'>";
		echo "<td align='left' height='30px' bgcolor='#FFFFFF'>";echo ($rows['name']); echo "</td>";

		echo "<td align='left' bgcolor='#FAFAFA'>";echo $rows['amount']; echo "</td>";

	echo "</tr>	";
	}	
	echo "</table>";	
	

    $result = mysqli_query($connection,"SELECT SUM(t.amount) as total, s.name as scc_name FROM ten_percent_contributions t, members m, small_christian_community s WHERE t.member_id = m.id AND t.tithe_id = '$tithe_id' AND m.scc = '$scc_id' AND s.id = m.scc") 
                or die("No orders in the table orders");  
        // display data in table
      
    while($rows=mysqli_fetch_assoc($result))
    { // Start looping table row
    echo "<tr style='border: 1px solid #E6E6E6;'>";
        echo "<br>";
        echo "<b>Total Amount ";echo $rows['total']; echo " Ksh</b>";
    }  
 
       
	
 ?>			
  </div> <!-- End prin_content-->
            
      <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br>      <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br><br><br><br><br> <br><br><br><br>
 
 <!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& end form &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->  

  

            </div>
        </div>      

      </div>
      <!-- END PAGE -->

   </div>
   <!-- END CONTAINER -->
<?php include("footer.php"); ?>