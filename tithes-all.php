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

    <input type="button" value="Print" onclick="PrintElem('#sururu')"  /><img src="assets/img/print_edit.gif"><br><br>
 

<div class="sururu" id ="sururu">
<?php
  include('connect-db.php');

  $tithe_id = $_POST['tithe_id'];
  $month = $_POST['month'];

    $result = mysqli_query($connection,"SELECT distinct(id), name from local_church") 
                or die("No orders in the table orders");  
    while($rows=mysqli_fetch_assoc($result))
    {
    echo "<tr style='border: 1px solid #E6E6E6;'>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<h5><b>Local Church: ";echo $rows['name']; echo "</b></h5>";
        
        $local_church_id =  $rows['id'];
        $local_church_name =  $rows['name'];
        echo "<br>";



        //scc
        $result_scc = mysqli_query($connection,"SELECT distinct(id), name from small_christian_community WHERE local_church_id = '$local_church_id'") 
                    or die("No orders in the table orders");  
        while($rows=mysqli_fetch_assoc($result_scc))
        {
        echo "<tr style='border: 1px solid #E6E6E6;'>";
            
            
            $scc_id =  $rows['id'];
            $scc_name = $rows['name'];


            //getting amounts
              $result_count = mysqli_query($connection,"SELECT COUNT(*) as num FROM ten_percent_contributions t, members m, small_christian_community s WHERE t.member_id = m.id AND t.tithe_id = '$tithe_id' AND m.scc = '$scc_id' AND m.scc = s.id AND t.month = '$month'") 
                or die("No orders in the table orders");
                while($rows=mysqli_fetch_assoc($result_count))
                { // Start looping table row
                    $recs = $rows['num'];
                }

                if($recs >=1)
                {
                   echo "<br>";
                  echo "<b>SCC: ";echo $scc_name; echo "</b><br>";

                    $result_tithes = mysqli_query($connection,"SELECT t.id, t.member_id, t.amount,t.tithe_id, m.name, s.name as scc_name FROM ten_percent_contributions t, members m, small_christian_community s WHERE t.member_id = m.id AND t.tithe_id = '$tithe_id' AND m.scc = '$scc_id' AND m.scc = s.id AND t.month = '$month'") 
                      or die("No orders in the table orders");

                    echo"<table width=\"100%\" height='30' style='border: 2px solid #E6E6E6;' align=center cellpadding=1 cellspacing=1 bgcolor=\"#CCCCCC\">";
                    echo "  <tr height=30px style='border: 1px solid #E6E6E6;'>
                    <td width=\10%\ align=left bgcolor=\"#E6E6E6\"><strong>Christian Name</strong></td>
                    

                    </tr>"; 
                     while($rows=mysqli_fetch_assoc($result_tithes))
                    { // Start looping table row
                    echo "<tr style='border: 1px solid #E6E6E6;'>";
                      echo "<td align='left' height='30px' bgcolor='#FFFFFF'>";echo ($rows['name']); echo "</td>";
                      
                      echo "</tr> ";
                    } 
                    echo "</table>"; 


                    $result_sum = mysqli_query($connection,"SELECT SUM(t.amount) as total FROM ten_percent_contributions t, members m, small_christian_community s WHERE t.member_id = m.id AND t.tithe_id = '$tithe_id' AND m.scc = '$scc_id' AND m.scc = s.id AND t.month = '$month'") 
                      or die("No orders in the table orders");
                       while($rows=mysqli_fetch_assoc($result_sum))
                      { // Start looping table row
                          echo "<b>Total Amount ";echo $rows['total']; echo " Ksh</b>";
                      }
                      echo "<br>";
                } 

        } 

        $result_sum = mysqli_query($connection,"SELECT COALESCE(SUM(t.amount),0) as total FROM ten_percent_contributions t, members m, small_christian_community s, local_church l WHERE l.id = s.local_church_id AND t.member_id = m.id AND t.tithe_id = '$tithe_id' AND l.id = '$local_church_id' AND m.scc = s.id AND t.month = '$month'") 
          or die("No orders in the table orders");
         while($rows=mysqli_fetch_assoc($result_sum))
            { // Start looping table row
              echo "<b>Total  "; echo $local_church_name ; echo ": ";echo $rows['total']; echo " Ksh</b>";
            }
            echo "<br>";
    }  
echo "<br><br><br>";

            $result_sum = mysqli_query($connection,"SELECT SUM(t.amount) as total FROM ten_percent_contributions t, members m, small_christian_community s, local_church l WHERE l.id = s.local_church_id AND t.member_id = m.id AND t.tithe_id = '$tithe_id' AND m.scc = s.id AND t.month = '$month'") 
          or die("No orders in the table orders");
         while($rows=mysqli_fetch_assoc($result_sum))
            { // Start looping table row
              echo "<h4><b>Total PARISH Amount ";echo $rows['total']; echo " Ksh</b></h4>";
            }
            echo "<br>";

 ?> 
</div>
            <br><br><br><br><br>    

            </div>
        </div>      

      </div>
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
<?php include("footer.php"); ?>