<?php
session_start();
if(!isset($_SESSION['myusername'])){
header('location: index.php');
}
?>
<?php include("top.php"); ?>
      <!-- BEGIN PAGE -->
      <?php 
	  		$local_church_id = $_POST['local_church_id'];
	   		$tithe_id = $_POST['tithe_id'];
        $month = $_POST['month'];
	   ?>
      <div class="page-content" style="min-height:590px !important">
      
           <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>Tithes
                    <span> >> </span>Tithes Per Scc
                </div>
                <div class="tools">
                </div>
            </div>
            
            <div class="portlet-body form">

     
    <input type="button" value="Print" onclick="PrintElem('#print_content')"  /><img src="assets/img/print_edit.gif"><br><br>
 
  <div id="print_content"> 
  
              
                <!-- BEGIN PORTLET-->
              
                <!-- END PORTLET-->
                <br>	
                
                        <?php
	include('connect-db.php');

    $result = mysqli_query($connection,"SELECT name from local_church where id ='$local_church_id'") 
                or die("No orders in the table orders");  
        // display data in table
      
    while($rows=mysqli_fetch_assoc($result))
    { // Start looping table row
    echo "<tr style='border: 1px solid #E6E6E6;'>";
        echo "<br>";
        echo "<b>Local Church: ";echo $rows['name']; echo "</b>";
    }  
    
    
    $result = mysqli_query($connection,"SELECT id as scc_id, name as scc_name from small_christian_community WHERE local_church_id = '$local_church_id'") 
                or die("No orders in the table orders");  
        // display data in table
    
  
        while($rows=mysqli_fetch_assoc($result))
  { // Start looping table row
        echo "<br>";
        $scc_id = $rows['scc_id'];
        


              $result_total_scc = mysqli_query($connection,"SELECT SUM(t.amount) as total, s.name as scc_name FROM ten_percent_contributions t, members m, small_christian_community s WHERE t.member_id = m.id AND t.tithe_id = '$tithe_id' AND m.scc = '$scc_id' AND s.id = m.scc AND t.month = '$month'") 
                or die("No orders in the table orders");  

                
        // display data in table
      
              while($rows=mysqli_fetch_assoc($result_total_scc))
              { // Start looping table row
              echo "<tr style='border: 1px solid #E6E6E6;'>";
                  echo "<br>";
                  if($rows['scc_name'] != ""){
                  echo $rows['scc_name']."<b> Total Amount ";echo $rows['total']; echo " Ksh</b>";
                }
              }  
             
   
  } 
 
	
			echo "<br><br>";
 
      $result = mysqli_query($connection,"SELECT SUM(t.amount) as total FROM ten_percent_contributions t, members m WHERE t.member_id = m.id AND t.tithe_id = '$tithe_id' AND m.local_church = '$local_church_id'  AND t.month = '$month'") 
                or die("No orders in the table orders");  
        // display data in table
      
    while($rows=mysqli_fetch_assoc($result))
    { // Start looping table row
    echo "<tr style='border: 1px solid #E6E6E6;'>";
        echo "<br>";
        echo "<b>Grand Total Amount ";echo $rows['total']; echo " Ksh</b>";
    }  
 
	
 ?>			
  </div> <!-- End prin_content-->

            
      <br><br><br><br> <br><br><br><br> <br>   <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br> <br><br><br><br><br><br><br><br> <br><br><br><br>
 
 <!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& end form &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->  

  

            </div>
        </div>      

      </div>
      <!-- END PAGE -->

   </div>
   <!-- END CONTAINER -->
<?php include("footer.php"); ?>